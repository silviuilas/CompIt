<?php
require_once('../configure/config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if($_SERVER["REQUEST_METHOD"] == "POST") {
    //TODO MAKE IT SECURE FOR HTML INJECTIONS
    require_once('../PHP/Database.php');
    if($_POST["type"]=="Register") {
        if (isset($_POST["usrname"])==NULL or isset($_POST["paswd"])==NULL)
        {
            echo "Username sau password bug";
            die();
        }
        $db = new Database();
        $db->connect();
        $name=trim($_POST["usrname"]);
        $pass=trim($_POST["paswd"]);
        if(isset($_POST["email"]))
            $email=trim($_POST["email"]);
        else
            $email=NULL;
        $result = $db->query("Select * from users_info where username='$name'");
        if(($row = mysqli_fetch_row($result))!=NULL) {
            if ($row[1] == $_POST['usrname']) {
                //To do throw exeption
                die();
            }
        }
        $db->query("INSERT INTO users_info (username,password,email) VALUES ('$name','$pass','$email')");
    }
    else {
        if (isset($_POST["usrname"])==NULL or isset($_POST["paswd"])==NULL) {
            echo "Username sau password bug";
            die();
        }
        $db = new Database();
        $db->connect();
        $name=$_POST["usrname"];
        $pass=$_POST["paswd"];

        $result = $db->query("Select * from users_info where username='$name'");
        if(($row = mysqli_fetch_row($result))!=NULL) {
            if ($row[1] == $_POST['usrname'])
                if ($row[2] == $_POST['paswd']) {
                    $_SESSION['header']->update_array(array('NAME'=>$_POST['usrname']));
                    $_SESSION['header']->update_array(array('NOTLOGGED'=>"display:none"));
                    $_SESSION['header']->update_array(array('LOGGED'=>""));
                    $_SESSION['username']=$_POST['usrname'];
                    $_SESSION['userId']=$row[0];
                    header('Location: '._SITE_URL);
                    die();
                }
        }
    }
}
$_SESSION['header']->show_file_modified();
$loginregister = new CustomTemp('html_files/loginregister.html',array('URL' => _SITE_URL));
$loginregister->show_file_modified();
$_SESSION['footer']->show_file_modified();
?>