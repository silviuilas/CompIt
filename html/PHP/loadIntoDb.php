<?php
require_once "../configure/config.php";
//TODO uncoment
$command = escapeshellcmd('python3 ../Python/Scraper/getCategoriLinks.py ');
$strJsonFileContents = shell_exec($command);
echo "contents recived";
$array = json_decode($strJsonFileContents, true);
$db = Database::getDatabaseObj();
$db->connect();
$category=$array[0];
$db->query("INSERT INTO category (name) VALUES ('Electronice')");
$query = $db->query("Select id from category where name='Electronice'");
$id_category = mysqli_fetch_row($query)[0];
foreach($category['category_links'] as $subcategory) {
    $subcategory_name=$subcategory['subcategory_name'];
    $db->query("INSERT INTO subcategory (id_category,name) VALUES ($id_category,'$subcategory_name')");
    $query = $db->query("Select id from subcategory where name='$subcategory_name'");
    $id_subcategory=mysqli_fetch_row($query)[0];
    foreach($subcategory['subcategory_items'] as $subcategory_item)
    {
        $item_name=$subcategory_item['name'];
        $item_img=($subcategory_item['img']);
        $item_minprice=($subcategory_item['minprice']);
        $item_link=$subcategory_item['link'];
        $item_cur=null;
        $query=$db->query("select `id`,`minprice` from items where link='".$item_link."'");
        $item_cur=mysqli_fetch_row($query);
        if($item_cur[0]==null)
            $db->query("INSERT INTO items (id_subcategory,name,img,minprice,link) VALUES ($id_subcategory,'$item_name','$item_img',$item_minprice,'$item_link')");
        else if($item_cur[1]!=$item_minprice){
            $percent= floatval(((floatval($item_cur[1])-floatval($item_minprice))/(floatval($item_cur[1])))*100.0);
            if($percent>10.0) {
                echo "WOW,such a great price";
                $db->query("INSERT INTO td_deals (id_item,percent,created_at) VALUES(".$item_cur[0].",".$percent.",sysdate())");
            }
            echo $item_cur[0].' '.$item_cur[1].' '.$item_minprice.'<br>';
            $db->query("INSERT INTO item_history (id_item,old_price,created_at) VALUES(".$item_cur[0].",".$item_minprice.",sysdate())");
            $db->query("UPDATE items SET minprice=".intval($item_minprice)." where id=".intval($item_cur[0]));
        }
    }
}