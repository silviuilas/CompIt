<?php
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
        $userId=0;
        $itemId=$_SESSION['itemId'];
        if(isset($_SESSION['userId'])){
            $userId=$_SESSION['userId'];
        }
        $comm = trim($_POST["mes"]);
        $date= date("Y/m/d");
        $db->query("INSERT INTO comms (id_user,titlu,mesaj,id_item,date_created) VALUES ('$userId','$name','$comm','$itemId','$date')");
    }
}