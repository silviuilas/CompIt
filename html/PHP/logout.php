<?php
require_once('../configure/config.php');

$_SESSION['header']->update_array(array('NAME'=>"Oaspete"));
$_SESSION['header']->update_array(array('NOTLOGGED'=>""));
$_SESSION['header']->update_array(array('LOGGED'=>"display:none"));
$_SESSION['username']=null;
$_SESSION['userId']=null;

header('Location: '._SITE_URL);