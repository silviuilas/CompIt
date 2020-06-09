<?php
require_once ('../configure/config.php');

require_once ('postComm.php');
$_SESSION['header']->show_file_modified();
$opinion = new CustomTemp('html_files/opinion.html',array('URL' => _SITE_URL));
$opinion->show_file_modified();
$_SESSION['footer']->show_file_modified();
?>