<?php
require_once ('../configure/config.php');
?>
<script>
    var fav_items=<?php echo (json_encode(array_reverse($_SESSION['fav'])));?>;
</script>
<?php
$_SESSION['header']->show_file_modified();
$favorite = new CustomTemp('html_files/favorite.html',array('URL'=>_SITE_URL));
$favorite->show_file_modified();
$_SESSION['footer']->show_file_modified()
?>
