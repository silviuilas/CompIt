<?php
require_once ('../configure/config.php');

if($_SERVER["REQUEST_METHOD"] == "POST") {
    require_once('../PHP/Database.php');
    if ($_POST["type"] == "Submit") {
        if (isset($_POST["name"]) == NULL or isset($_POST["mes"]) == NULL) {
            echo "Name or textarea BUG";
            die();
        }
        $db = new Database();
        $db->connect();
        $name = trim($_POST["name"]);
        $userId=0;
        $itemId=0;
        if(isset($_SESSION['userId'])){
            $userId=$_SESSION['userId'];
        }
        $comm = trim($_POST["mes"]);
        $date= date("Y/m/d");
        if($db->query("INSERT INTO comms (id_user,titlu,mesaj,id_item,date_created) VALUES ('$userId','$name','$comm','$itemId','$date')"))
            echo "Realizat";

    }
}
$_SESSION['header']->show_file_modified();
$opinion = new CustomTemp('html_files/opinion.html',array('URL' => _SITE_URL));
$opinion->show_file_modified();
$_SESSION['footer']->show_file_modified();
?>