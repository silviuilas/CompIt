<?php require_once ('configure/config.php')?>
<?php

$db = new Database();
$db->connect();
$query = $db->query("Select * from items");
$i=0;
$table=[];
while(($row=mysqli_fetch_row($query))!=NULL && $i<50)
{$table[$i]=$row;
    $i++;
}
$php_array = $table;
$js_array = json_encode($php_array);

$_SESSION['header']->show_file_modified();
$index = new CustomTemp('html_files/index.php',array('URL' => _SITE_URL));
$index->show_file_modified();
$_SESSION['footer']->show_file_modified();
?>
<script> var items_array= <?php echo $js_array; ?> </script>