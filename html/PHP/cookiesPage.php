<?php
require_once ('../configure/config.php');
?>
<?php
$_SESSION['header']->show_file_modified();
$cookiesPage = new CustomTemp('html_files/cookiesPage.html',array('URL'=>_SITE_URL));
$cookiesPage->show_file_modified();
$_SESSION['footer']->show_file_modified()
?>
