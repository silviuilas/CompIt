<?php require_once ('../configure/configAdmin.php')?>
<?php
$str=substr($_GET['page'],-4);
if($str=="html")
    $showPage = new CustomTempA('html_files/'.$_GET['page'],array('URL' => _SITE_URL));
else if($str==".php")
    $showPage = new CustomTempA('PHP/'.$_GET['page'],array('URL' => _SITE_URL));
$showPage->show_file_modified();
