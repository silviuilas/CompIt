<?php
define("_SITE_URL","http://www.compit.dev");
define("_FULL_PATH","/home/silviu/PhpstormProjects/Web/html");
require_once(_FULL_PATH.'/PHP/Database.php');
include(_FULL_PATH.'/PHP/CustomTemp.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['header'])) {
    $header = new CustomTemp('html_files/header.html', array('URL' => _SITE_URL, 'NAME' => "Oaspete"));
    $_SESSION['header'] = $header;
}

if(!isset($_SESSION['footer'])) {
    $footer = new CustomTemp('html_files/footer.html', array('URL' => _SITE_URL));
    $_SESSION['footer']=$footer;
}
