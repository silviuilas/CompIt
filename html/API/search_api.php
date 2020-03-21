
<?php
define("_SITE_URL","http://compit.dev");
define("_FULL_PATH","/home/silviu/PhpstormProjects/Web/html");
require_once(_FULL_PATH.'/PHP/Database.php');

$db = new Database();
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
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['search_query']));{
    $_SESSION['search_query'] = $db->query("Select * from items where name LIKE '%".$search_for."%' limit ".$limit." offset ".$offset);
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
