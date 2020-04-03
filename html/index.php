<?php require_once ('configure/config.php')?>
<?php

$db = new Database();
$db->connect();
$query = $db->query("Select * from items order by views desc");
$i=0;
$table=[];
while(($row=mysqli_fetch_row($query))!=NULL && $i<30)
{$table[$i]=$row;
    $i++;
}
$php_array = $table;
$rec_js_array = json_encode($php_array);
if(!isset($_SESSION['last_viewed_items']))
    $_SESSION['last_viewed_items']=[];

$_SESSION['header']->show_file_modified();
$index = new CustomTemp('html_files/index.html',array('URL' => _SITE_URL));
$index->show_file_modified();
?>
<script> var rec_items_array= <?php echo $rec_js_array;?>;
        var last_items_viewed=[];
        last_items_viewed=<?php echo (json_encode(array_reverse($_SESSION['last_viewed_items'])));?>;
</script>
<?php
$_SESSION['footer']->show_file_modified();
?>
