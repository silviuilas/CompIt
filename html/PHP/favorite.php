<?php
require_once ('../configure/config.php');
$_SESSION['header']->show_file_modified();
?>
<script>
    var fav_items=<?php echo (json_encode(array_reverse($_SESSION['fav'])));?>;
</script>
<?php


$favorite = new CustomTemp('html_files/favorite.php',array('URL'=>_SITE_URL));
$favorite->show_file_modified();
$_SESSION['footer']->show_file_modified()
?>
