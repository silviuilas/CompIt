<?php
define("_SITE_URL","http://compit.dev");
define("_FULL_PATH","/home/silviu/PhpstormProjects/Web/html");
require_once(_FULL_PATH.'/PHP/Database.php');

function get_price($name,$filter)
{
    $db = new Database();
    $db->connect();
    $query = $db->query("Select * from items where name like '%".$name."%'");
    $row=mysqli_fetch_row($query);
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