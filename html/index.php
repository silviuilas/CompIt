<?php require_once ('configure/config.php')?>
<?php

$db = Database::getDatabaseObj();
$db->connect();
$php_array = $db->queryArray("Select * from items order by views desc",30);
$rec_js_array = json_encode($php_array);
$php_array = $db->queryArray("Select * from items i join rec_items r on i.id=r.id_items order by r.item_order",30);
$admin_rec_js_array=json_encode($php_array);
$php_array = $db->queryArray("Select * from items i join td_deals td on i.id=td.id_item order by created_at DESC,td.percent",30);
$today_deal_js_array=json_encode($php_array);
if(!isset($_SESSION['last_viewed_items']))
    $_SESSION['last_viewed_items']=[];

$_SESSION['header']->show_file_modified();
$index = new CustomTemp('html_files/index.html',array('URL' => _SITE_URL));
$index->show_file_modified();
?>
<script> var rec_items_array= <?php echo $rec_js_array;?>;
        var admin_rec_items_array= <?php echo $admin_rec_js_array;?>;
        var today_deal_items_array= <?php echo $today_deal_js_array;?>;
        var last_items_viewed=[];
        last_items_viewed=<?php echo (json_encode(array_reverse($_SESSION['last_viewed_items'])));?>;
</script>
<?php
$_SESSION['footer']->show_file_modified();
?>
