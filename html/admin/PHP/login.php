<?php
require_once('../configure/configAdmin.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    //TODO MAKE IT SECURE FOR HTML INJECTIONS
    require_once('../PHP/DatabaseA.php');
    if (isset($_POST["usrname"]) == NULL or isset($_POST["paswd"]) == NULL) {
        echo "Username sau password bug";
        die();
    }
    $db = Database::getDatabaseObj();
    $db->connect();
    $name = $_POST["usrname"];
    $pass = $_POST["paswd"];

    $result = $db->query("Select * from users_info where username='$name'");
    if (($row = mysqli_fetch_row($result)) != NULL) {
        if ($row[1] == $_POST['usrname'])
            if ($row[2] == $_POST['paswd']) {
                $_SESSION['header']->update_array(array('NAME' => $_POST['usrname']));
                $_SESSION['header']->update_array(array('NOTLOGGED' => "display:none"));
                $_SESSION['header']->update_array(array('LOGGED' => ""));
                $_SESSION['username'] = $_POST['usrname'];
                $_SESSION['adminId'] = $row[0];
                header('Location: ' . _SITE_URL);

                die();
            }
    }
}
echo("SAlult");
?>