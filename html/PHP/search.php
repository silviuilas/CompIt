
<?php
    require_once('../configure/config.php');
    $db = new Database();
    $db->connect();
    $search_for=$_GET['search'];
    $query = $db->query("Select * from items where name LIKE '%".$search_for."%'");
    $i=0;
    $table=[];
    while(($row=mysqli_fetch_row($query))!=NULL) {
        $table[$i]=$row;
        $i++;
    }
    $php_array = $table;
    $search_js_array = json_encode($php_array);

    $search = new CustomTemp('html_files/search.php',array('SEARCH' => $search_for,'NUMAR_PRODUSE'=>$i,'URL'=>_SITE_URL));
    $search->show_file_modified();
?>
<script> var search_items_array= <?php echo $search_js_array; ?> </script>