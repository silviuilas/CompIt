<?php
require_once ('../configure/config.php');

function get_price($name,$filter)
{
    $db = new Database();
    $db->connect();
    $query = $db->query("Select * from items where name like '%".$name."%'");
    $row=mysqli_fetch_row($query);
    $update= $db->query("Update items set views=".($row[6]+1)." where id=".$row[0]);
    if($row!=NULL) {
        $command = escapeshellcmd('../Python/Scraper/scrapeOnePage.py '.$row[5]);
        $output = shell_exec($command);
        $array = json_decode($output,true);

        if(!empty($filter)) {
            $filter_array = explode(" ", $filter);
            $temp_var = [];
            foreach ($filter_array as $fil) {
                if (!empty($array[$fil]))
                    array_push($temp_var, $array[$fil]);
            }
            if (!empty($temp_var))
                return $temp_var;
        }
        return $array;

    }
}