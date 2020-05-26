<?php
require_once("FacebookApi.php");

$access_token = "";
$facebookData = array();
$facebookData['consumer_key'] = "";
$facebookData['consumer_secret'] = "";

$title = "First post";
$targetUrl = "https://p1.akcdn.net/thumb/602281215.dji-mavic-2-part-1-fly-more-kit.jpg";
$imgUrl = "https://images.unsplash.com/photo-1494253109108-2e30c049369b?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&w=1000&q=80";
$description = "Post_Description";

$facebook = new FacebookApi($facebookData);
echo " etst";
echo $facebook->share($title, $targetUrl, $imgUrl, $description, $access_token);

