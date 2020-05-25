<?php
require_once ('../configure/configAdmin.php');

$db = new DatabaseA();
$db->connect();
$search_for=$_GET['search'];
if(!empty($_GET['limit']))
    $limit = $_GET['limit'];
else
    $limit=100;
if(!empty($_GET['offset']))
    $offset= $_GET['offset'];
else
    $offset=0;
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['search_query']));{
    $_SESSION['search_query'] = $db->query("Select * from items i where id NOT IN (select id_items from rec_items r where r.id_items=i.id ) and i.name LIKE '%".$search_for."%' limit ".$limit." offset ".$offset);
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
