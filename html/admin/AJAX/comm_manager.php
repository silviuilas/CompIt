<?php

require_once ('../configure/configAdmin.php');

$db = new DatabaseA();
$db->connect();
$table =[];
if(isset($_POST['function'])) {
    switch ($_POST['function']) {
        case  "show":
        {
            if(!isset($_POST['itemId'])) {
                echo "Error";
                break;
            }
            $itemId=$_POST['itemId'];
            $rec = $db->query("Select c.id,c.id_user,c.titlu,c.mesaj,c.id_item,c.date_created,ui.id,ui.username,ui.email from comms c left join users_info ui on c.id_user=ui.id where id_item=$itemId");
            $i=0;
            $table=[];
            while(($row=mysqli_fetch_row($rec))!=NULL) {
                $table[$i]=$row;
                $i++;
            }
            break;
        }
        case "remove":
            if(!isset($_POST['id'])){
                echo "Error,no id specified";
                return;
            }
            $id = $_POST['id'];
            $db->query("DELETE FROM comms where id=".$id);
            break;
        default;
    }
}
$php_array['data'] = $table;
$search_js_array = json_encode($php_array);
echo $search_js_array;