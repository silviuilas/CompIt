<?php require_once ('configure/config.php')?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$header = new CustomTemp('html_files/header.php',array('URL' => _SITE_URL));
//$header->show_file_modified();
$_SESSION['header']=$header;
$_SESSION['header']->show_file_modified();
$index = new CustomTemp('html_files/index.php',array('URL' => _SITE_URL));
$index->show_file_modified();
$footer =new CustomTemp('html_files/footer.php',array('URL' => _SITE_URL));
$footer->show_file_modified();
$_SESSION['footer']=$footer;

?>
