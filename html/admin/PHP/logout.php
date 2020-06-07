<?php
require_once('../configure/configAdmin.php');

$_SESSION['headerA']->update_array(array('NAME'=>""));
$_SESSION['username']=null;
$_SESSION['adminId']=null;

header('Location: '._SITE_URL.'/index.php');