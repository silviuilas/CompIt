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
if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('../PHP/Database.php');
    if ($_POST["type"] == "Submit") {
        if (isset($_POST["name"]) == NULL or isset($_POST["mes"]) == NULL) {
            echo "Name or textarea BUG";
            die();
        }
        $db = Database::getDatabaseObj();
        $db->connect();
        $name = trim($_POST["name"]);
        $userId=null;
        if(isset($_SESSION['userId'])){
            $userId=$_SESSION['userId'];
        }
        $comm = trim($_POST["mes"]);
        $date= date("Y/m/d");
        if($db->query("INSERT INTO comms (id_user,titlu,mesaj,date_created) VALUES ('$userId','$name','$comm','$date')"))
            echo "Realizat";
    }
}
?>

