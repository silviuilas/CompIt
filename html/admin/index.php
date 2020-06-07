<?php require_once('configure/configAdmin.php') ?>
<?php require_once('PHP/login.php') ?>
<?php
$db = new DatabaseA();
$db->connect();

if (!isset($_SESSION['adminId'])) {
    $_SESSION['headerA']->update_array(array('IS_LOGGED_IN'=>"style='display:none'"));
    $index = new CustomTempA('html_files/login.html', array('URL' => _SITE_URL));
} else {
    $_SESSION['headerA']->update_array(array('IS_LOGGED_IN'=>""));
    $index = new CustomTempA('html_files/mainPage.html', array('URL' => _SITE_URL));
}
$_SESSION['headerA']->show_file_modified();
$index->show_file_modified();
$_SESSION['footerA']->show_file_modified();

?>
