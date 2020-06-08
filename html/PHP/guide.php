<?php
require_once ('../configure/config.php');
$_SESSION['header']->show_file_modified();
$guide = new CustomTemp('html_files/guide.html',array('URL' => _SITE_URL));
$guide->show_file_modified();
$_SESSION['footer']->show_file_modified();