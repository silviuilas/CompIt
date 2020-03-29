<?php
header("Content-Type:application/json");
require "data.php";


if(!empty($_GET['name']))
    $name=$_GET['name'];
if(!empty($_GET['uri'])) {
    $uri = $_GET['uri'];
    $db = new Database();
    $db->connect();
    $query = $db->query("Select id_items from items_links where link ='".$uri."'");
    if(mysqli_num_rows($query)){
        $row=mysqli_fetch_row($query);
        $query = $db->query("Select name from items where id =".$row[0]);
        $row=mysqli_fetch_row($query);
        $name = $row[0];
    }
    else{
        $name="";
    }
}

if($name)
{
    if(!empty($_GET['filters']))
        $filters=$_GET['filters'];
    else
        $filters="";
    $price = get_price($name,$filters);

    if(empty($price))
    {
        response(201,"Product Not Found",NULL);
    }
    else
    {
        response(200,"Product Found",$price);
    }

}
else
{
    response(400,"Invalid Request",NULL);
}

function response($status,$status_message,$data)
{
    header("HTTP/1.1 ".$status);

    $response['status']=$status;
    $response['status_message']=$status_message;
    $response['data']=$data;

    $json_response = json_encode($response);
    echo $json_response;
}