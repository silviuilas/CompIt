<?php require_once('html_files/header.php'); ?>
<?php include('html_files/index.php'); ?>
<?php include('html_files/footer.php'); ?>
<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
