<?php
require_once('../../configure/config.php');
$db = Database::getDatabaseObj();
$db->connect();
$result = $db->select("select id from items where name like '%".$_GET['name']."%'");
$id=$result[0]['id'];
$result = $db->select("Select * from item_history ih where ih.id_item=".$id." order by created_at DESC");
if(sizeof($result)==0){
    return;
}
$max=0;
$pointsMap[]=array();
foreach ($result as $item){
    if($item['old_price']>$max)
        $max=$item['old_price'];
    $item_date = strtotime($item['created_at']);
    $item_date = date("Y-m-d",$item_date);
    if($item_date>=date("Y-m-d",strtotime("-6 days"))) {
        $pointsMap[$item_date]=round($item['old_price']);
    }
    else{
        $pointsMap[0]=round($item['old_price']);
        break;
    }
}
//put on the svg the points that we know are ok
$points[]=array();
for ($i=0;$i<7;$i++){
    $date=date("Y-m-d",strtotime("-".(6-$i)." days"));
    if(isset($pointsMap[$date])){
        $points['POINT'.$i]=200-($pointsMap[$date]/$max)*200+10;
    }
}
//if this point isn't set we will take the last available price
if(!isset($points['POINT0']) && isset($pointsMap[0])){
    $points['POINT0']=200-($pointsMap[0]/$max)*200+10;
}
//fill the prices that aren't with those behind them
for ($i=6;$i>=0;$i--){
    if(!isset($points['POINT'.$i])){
        $j=$i-1;
        for(;$j>=0;$j--){
            if(isset($points['POINT'.$j])){
                $points['POINT'.$i]=$points['POINT'.$j];
                break;
            }
        }
        if($j==-1){
            $points['POINT'.$i]=200-($pointsMap[0]/$max)*200+10;
        }
    }
}

$offset=$max/6;
$priceLabel[] = array();
for($i=0;$i<7;$i++){
    $priceLabel["PRICE".$i]=round($offset*$i);
}
$datesLabel[]=array();
for($i=0;$i<7;$i++){
    $datesLabel['DATE'.$i]=date('m/d',strtotime("-".(6-$i)." days"));
}

$svg = new CustomTemp('API/SVG/svg.html',array('URL' => _SITE_URL));
$svg->update_array($datesLabel);
$svg->update_array($priceLabel);
$svg->update_array($points);
$svg->show_file_modified();