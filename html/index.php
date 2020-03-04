<?php require_once ('configure/config.php')?>
<?php
$_SESSION['header']->show_file_modified();
$index = new CustomTemp('html_files/index.php',array('URL' => _SITE_URL));
$index->show_file_modified();
$_SESSION['footer']->show_file_modified();


?>
