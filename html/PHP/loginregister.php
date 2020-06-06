<?php
function logIn($name,$pass){
    $db = Database::getDatabaseObj();
    $db->connect();
    $result = $db->query("Select * from users_info where username='$name'");
    if(($row = mysqli_fetch_row($result))!=NULL) {
        if ($row[1] == $name)
            if ($row[2] == $pass) {
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
?>
<?php
require_once('../configure/config.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

$loginError="style=display:none";
$registerError="style=display:none";
if($_SERVER["REQUEST_METHOD"] == "POST") {
    //TODO MAKE IT SECURE FOR HTML INJECTIONS
    if($_POST["type"]=="SignUp") {
        $username=$_POST["usrname"];
        $password=$_POST["paswd"];
        $email = $_POST["email"];
        if (isset($username)==NULL or isset($password)==NULL)
        {
            echo "Username sau password bug";
            die();
        }
        $db = Database::getDatabaseObj();
        $db->connect();
        $name=trim($username);
        $pass=trim($password);
        if(isset($email))
            $email=trim($email);
        else
            $email=NULL;
        $result = $db->query("Select * from users_info where username='$name'");
        if(($row = mysqli_fetch_row($result))!=NULL) {
            if ($row[1] == $username) {
                $registerError="";
            }
        }
        $db->query("INSERT INTO users_info (username,password,email) VALUES ('$name','$pass','$email')");
        logIn($username,$password);
    }
    else if($_POST["type"]=="LogIn"){
        if (isset($_POST["usrname"])==NULL or isset($_POST["paswd"])==NULL) {

        }
        logIn($_POST["usrname"],$_POST["paswd"]);
        $loginError="";
    }
}
$_SESSION['header']->show_file_modified();
$loginregister = new CustomTemp('html_files/loginregister.html',array('URL' => _SITE_URL,'loginError'=>$loginError,'registerError'=>$registerError));
$loginregister->show_file_modified();
$_SESSION['footer']->show_file_modified();
?>