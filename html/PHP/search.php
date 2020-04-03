<?php
    require_once('../configure/config.php');
    $_SESSION['header']->show_file_modified();
    $search_for=$_GET['search'];
    $search = new CustomTemp('html_files/search.html',array('SEARCH' => $search_for,'URL'=>_SITE_URL));
    $search->show_file_modified();
    $_SESSION['footer']->show_file_modified() ;
?>