<?php require_once ('configure/config.php')?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if(!isset($_SESSION['header'])) {
    $header = new CustomTemp('html_files/header.php', array('URL' => _SITE_URL, 'NAME' => "Oaspete"));
    $_SESSION['header'] = $header;
}
if(!isset($_SESSION['footer'])) {
    $footer = new CustomTemp('html_files/footer.php', array('URL' => _SITE_URL));
    $_SESSION['footer']=$footer;
}
$_SESSION['header']->show_file_modified();
$index = new CustomTemp('html_files/index.php',array('URL' => _SITE_URL));
$index->show_file_modified();
$_SESSION['footer']->show_file_modified();


?>
