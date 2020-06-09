<?php require_once('../configure/config.php'); ?>

<?php
function push_last_viewed_item($item){
    $item[6]=0;
    if(!isset($_SESSION['last_viewed_items']))
        $_SESSION['last_viewed_items']=[];
    array_push($_SESSION['last_viewed_items'],$item);
    $_SESSION['last_viewed_items']=array_reverse(array_unique(array_reverse($_SESSION['last_viewed_items']),SORT_REGULAR));
    if(count($_SESSION['last_viewed_items'])>=30)
        unset($_SESSION['last_viewed_items'][0]);
}
function check_fav($currItem){
    if(isset($_SESSION['fav'])) {
        foreach ($_SESSION['fav'] as $item) {
            if($item[0]==$currItem[0])
                return "fa-heart";
        }
    }
    return "fa-heart-o";
}
?>
<?php
$name = $_GET['name'];
$db = Database::getDatabaseObj();
$db->connect();
$query = $db->query("Select * from items where name ='".$name."'");
$row=mysqli_fetch_row($query);
push_last_viewed_item($row);
$_SESSION['itemId']=$row[0];
$subcategory=$row[1];
$query = $db->query("Select * from subcategory as sub join category as cat on sub.id_category=cat.id where sub.id='".$subcategory."'");
$row1=mysqli_fetch_row($query);
$array=array('URL'=>_SITE_URL,'name'=>$row[2],'minprice'=>$row[3],'imglink'=>$row[4],'categori'=>$row1[4],'heart'=>check_fav($row));
$_SESSION['header']->show_file_modified();
$item = new CustomTemp('html_files/item.html',$array);
$item->show_file_modified();
$opinion = new CustomTemp('html_files/opinion.html',array('URL' => _SITE_URL));
$opinion->show_file_modified();
$_SESSION['footer']->show_file_modified();
require_once ('postComm.php');
?>

