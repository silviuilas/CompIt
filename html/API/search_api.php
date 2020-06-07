<?php
require_once ('../configure/config.php');

$db = Database::getDatabaseObj();
$db->connect();
$search_for=$_GET['search'];
if(!empty($_GET['limit']))
    $limit = $_GET['limit'];
else
    $limit=25;
if(!empty($_GET['offset']))
    $offset= $_GET['offset'];
else
    $offset=0;
if(!empty($_GET['site']))
    $siteAnd=" site='".$_GET['site']."' and ";
else
    $siteAnd="";
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['search_query']));{
    $_SESSION['search_query'] = $db->query("Select * from items where".$siteAnd." name LIKE '%".$search_for."%' limit ".$limit." offset ".$offset);
}
$query=$_SESSION['search_query'];
$i=0;
$table=[];
while(($row=mysqli_fetch_row($query))!=NULL) {
    $table[$i]=$row;
    $i++;
}
$php_array['data'] = $table;
$search_js_array = json_encode($php_array);
echo $search_js_array;
