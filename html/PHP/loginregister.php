<?php
function logIn($name,$pass){
    $db = Database::getDatabaseObj();
    $db->connect();
    $result = $db->query("Select * from users_info where username='$name'");
    if(($row = mysqli_fetch_row($result))!=NULL) {
        if ($row[1] == $name)
            if (password_verify($pass,$row[2])) {
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
    if($_POST["type"]=="Inregistrare") {
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
        $hashedPass=password_hash($pass, PASSWORD_BCRYPT, array('cost'=>12));
        $db->query("INSERT INTO users_info (username,password,email) VALUES ('$name','$hashedPass','$email')");
        logIn($username,$pass);
    }
    else if($_POST["type"]=="Intra"){
        if (isset($_POST["usrname"])==NULL or isset($_POST["paswd"])==NULL) {
        }
        logIn(trim($_POST["usrname"]),trim($_POST["paswd"]));
        $loginError="";
    }
}
function httpPost($url, $data)
{
    try{
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_POST, true);
        curl_setopt($curl, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_CAINFO, "/home/silviu/Downloads". '/cacert.pem');
        curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($curl);
        if ($response === false) {
            throw new Exception(curl_error($curl), curl_errno($curl));
        }
        curl_close($curl);
    }
    catch(Exception $e) {
        trigger_error(sprintf(
            'Curl failed with error #%d: %s',
            $e->getCode(), $e->getMessage()),
            E_USER_ERROR);

    }
    return $response;
}
$url = 'https://www.compit.dev/authenticationMicroService/handleRequest.php';
$data = array('type' => 'Intra', 'usrname' => 'silviuilas', 'paswd' => 'qazqazqaz1');
//$var=httpPost($url,$data);
//var_dump($var);
$_SESSION['header']->show_file_modified();
$loginregister = new CustomTemp('html_files/loginregister.html',array('URL' => _SITE_URL,'loginError'=>$loginError,'registerError'=>$registerError));
$loginregister->show_file_modified();
$_SESSION['footer']->show_file_modified();
?>