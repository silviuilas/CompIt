
<?php
    require_once('../configure/config.php');
    $search_for=$_GET['search'];
    $search = new CustomTemp('html_files/search.php',array('SEARCH' => $search_for,'URL'=>_SITE_URL));
    $search->show_file_modified();
?>