<?php require_once('configure/configAdmin.php') ?>
<?php require_once('PHP/login.php') ?>
<?php
$db = new DatabaseA();
$db->connect();
$_SESSION['headerA']->show_file_modified();

if (isset($_SESSION['adminId'])) {
    $index = new CustomTempA('html_files/login.html', array('URL' => _SITE_URL));
} else {
    $index = new CustomTempA('html_files/mainPage.html', array('URL' => _SITE_URL));
    echo("SAlult");
}

$index->show_file_modified();
$_SESSION['footerA']->show_file_modified();

?>
