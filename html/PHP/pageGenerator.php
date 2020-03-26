<?php require_once('../configure/config.php'); ?>

<?php
$name = $_GET['name'];
$db = new Database();
$db->connect();
$query = $db->query("Select * from items where name ='".$name."'");
$row=mysqli_fetch_row($query);
//TODO make the items unique
array_push($_SESSION['last_viewed_items'],$row);
$subcategory=$row[1];
$query = $db->query("Select * from subcategory as sub join category as cat on sub.id_category=cat.id where sub.id='".$subcategory."'");
$row1=mysqli_fetch_row($query);
$array=array('URL'=>_SITE_URL,'name'=>$row[2],'minprice'=>$row[3],'imglink'=>$row[4],'categori'=>$row1[4]);
$item = new CustomTemp('html_files/item.php',$array);
$item->show_file_modified();
?>