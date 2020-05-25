<?php
define("_ROOT_URL",'https://www.compit.dev');
define("_SITE_URL", _ROOT_URL . '/admin');
define("_FULL_PATH","/home/silviu/PhpstormProjects/Web/html/admin");
require_once(_FULL_PATH.'/PHP/DatabaseA.php');
include(_FULL_PATH.'/PHP/CustomTempA.php');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$arrContextOptions=array(
    "ssl"=>array(
        "verify_peer"=>false,
        "verify_peer_name"=>false,
    )
);
$_SESSION['ssl']=$arrContextOptions;
if(!isset($_SESSION['headerA'])) {
    $header = new CustomTempA('html_files/header.html', array('URL' => _SITE_URL,'ROOT_URL'=>_ROOT_URL));
    $_SESSION['headerA'] = $header;
}

if(!isset($_SESSION['footerA'])) {
    $footer = new CustomTempA('html_files/footer.html', array('URL' => _SITE_URL));
    $_SESSION['footerA']=$footer;
}
