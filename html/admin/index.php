<?php require_once ('configure/configAdmin.php')?>
<?php
$db = new DatabaseA();
$db->connect();
$_SESSION['headerA']->show_file_modified();
$index = new CustomTempA('html_files/mainPage.html',array('URL' => _SITE_URL));
$index->show_file_modified();
$_SESSION['footerA']->show_file_modified();
?>
