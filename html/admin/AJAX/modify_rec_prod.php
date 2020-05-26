<?php
require_once ('../configure/configAdmin.php');

$db = new DatabaseA();
$db->connect();

if(isset($_POST['function'])){
    switch ($_POST['function']) {
        case 'remove':
            if(!isset($_POST['id'])){
                echo "Error,no id specified";
                return;
            }
            $id_item = $_POST['id'];
            $rec = $db->query("Select * from rec_items where id=".$id_item);
            $row=mysqli_fetch_row($rec);
            $rec2=$db->query("UPDATE rec_items SET item_order=item_order-1 where item_order>".$row[2]);
            $rec = $db->query("DELETE FROM rec_items where id=".$id_item);
            echo "item removed";
            break;
        case 'insert':
        case 'show':
            if($_POST['function']==='insert')
                $rec = $db->query("Select * from rec_items order by item_order");
            else if($_POST['function']==='show')
                $rec = $db->query("Select * from rec_items r join items i on r.id_items=i.id order by item_order");
            $i=0;
            $table=[];
            while(($row=mysqli_fetch_row($rec))!=NULL) {
                $table[$i]=$row;
                if($row[2]!=$i)
                    break;
                $i++;
            }
            if(isset($_POST['id'])) {
                $id_item = $_POST['id'];
                $rec = $db->query("INSERT INTO rec_items (id_items,item_order,date_from,date_to) values (" . $id_item . "," . $i . ",sysdate(),sysdate())");
                if (!$rec)
                    echo mysqli_error($db->getDbconnect());
            }
            break;
        case 'switch':
            if(!isset($_POST['id'])){
                echo "Error,no id specified";
                return;
            }
            $id_item = $_POST['id'];
            $sign = $_POST['sign']; //can be -1 or 1
            $item1Query = $db->query("Select * from rec_items where id=".$id_item);
            $item1=mysqli_fetch_row($item1Query);
            $item2Query = $db->query("Select * from rec_items where item_order=".($item1[2]+$sign));
            $item2=mysqli_fetch_row($item2Query);
            $maxOrd=$db->query("Select max(item_order) from rec_items");
            $maxOrdRow=mysqli_fetch_row($maxOrd);
            if($item1[2]+$sign>=0 and $item1[2]+$sign<=$maxOrdRow[0]) {
                $rec2 = $db->query("UPDATE rec_items SET item_order=" . $item1[2] . " where id=" . $item2[0]);
                $rec2 = $db->query("UPDATE rec_items SET item_order=item_order+" . $sign . " where id=" . $id_item);
                $table[0]=$item1;
                $table[1]=$item2;
            }
            else{
                echo "You can't do that";
            }
            break;
    }
}
$php_array['data'] = $table;
$search_js_array = json_encode($php_array);
echo $search_js_array;
return;