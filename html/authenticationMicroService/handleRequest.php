<?php
require_once "Database.php";

if (isset($_POST["type"])) {
    if (!isset($_POST["usrname"]) or !isset($_POST["paswd"])) {
        echo "Introdu numele si parola";
        die();
    }
    $db = Database::getDatabaseObj();
    $db->connect();
    $username = $_POST["usrname"];
    $password = $_POST["paswd"];
    $user=$db->queryArray("SELECT * from user_info where username='$username'",100);
    if ($_POST["type"] == "Intra") {
        if(password_verify($password,$user[0][2])){
            response("200","Congrats","");
        }
        else{
            response("202","Error","");
        }
    } else if ($_POST["type"] == "Inregistrare") {
        if(count($user)==0){
            if(isset($_POST["email"]))
                $email=trim($_POST["email"]);
            else
                $email=NULL;
            $hashedPass=password_hash($password, PASSWORD_BCRYPT, array('cost'=>12));
            $db->query("INSERT INTO user_info (username,password,email) VALUES ('$username','$hashedPass','$email')");
            //echo $db->connect()->error;
            response("200","Congrats","");
        }
        else{
            response("202","Error","");
        }
    } else {
        response("202","Error","");
    }
} else {
    response("202","Error","");
}

function response($status, $status_message, $data)
{
    header("HTTP/1.1 " . $status);

    $response['status'] = $status;
    $response['status_message'] = $status_message;
    $response['data'] = $data;

    $json_response = json_encode($response);
    echo $json_response;
    die();
}