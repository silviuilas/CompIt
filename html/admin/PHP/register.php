<?php
require_once('configure/configAdmin.php');

$loginError="style=display:none";
$registerError="style=display:none";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($_POST["type"] == "Inregistrare") {
        echo("test");
        $username = $_POST["usrname"];
        $password = $_POST["paswd"];
        $email = $_POST["email"];
        if (isset($username) == NULL or isset($password) == NULL) {
            echo "Username sau password bug";
            die();
        }
        echo("test1");
        $db = DatabaseA::getDatabaseObj();
        $db->connect();
        $name = trim($username);
        $pass = trim($password);

        if (isset($email))

            $email = trim($email);
        else
            $email = NULL;
        echo("test3");
        $result = $db->query("Select * from admins_info where username='$name'");
        if (($row = mysqli_fetch_row($result)) != NULL) {
            if ($row[1] == $username) {
                $registerError = "";
            }
            echo("test4");
        }
        echo("test5");
        $hashedPass=password_hash($pass, PASSWORD_BCRYPT, array('cost'=>12));
        $db->query("INSERT INTO users_info (username,password,email) VALUES ('$name','$hashedPass','$email')");

    }
}
