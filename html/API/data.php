<?php
require_once('../configure/config.php');

function push_api_helper($array, $id, $db, $site)
{
    $query = $db->query("Select count(*) from items_links where id_items = " . $id);
    $row = mysqli_fetch_row($query);
    if ($row[0] == 0) {
        foreach ($array['items'] as $item) {
            if ($site == 'compari.ro') {
                $command = escapeshellcmd('python3 ../Python/Scraper/getLinkFromJumpTo.py ' . $item['link']);
            } else if ($site == 'compara.ro') {
                $command = escapeshellcmd('python3 ../Python/Scraper/getLinkFromJumpToCompara.py ' . $item['link']);
            }
            $output = shell_exec($command);
            $array = json_decode($output, true);
            $db->query("Insert into items_links (id_items,link) values(" . $id . ",'" . $array['acc_link'] . "')");
        }
    }
}

function get_price($name, $filter)
{
    $db = Database::getDatabaseObj();
    $db->connect();
    $query = $db->query("Select * from items where name like '%" . $name . "%'");
    $row = mysqli_fetch_row($query);
    $db->query("Update items set views=" . ($row[6] + 1) . " where id=" . $row[0]);
    if ($row != NULL) {
        if ($row[7] == 'compari.ro') {
            $command = escapeshellcmd('../Python/Scraper/scrapeOnePage.py ' . $row[5]);
        } else if ($row[7] == 'compara.ro') {
            $command = escapeshellcmd('../Python/Scraper/scrapeOnePageCompara.py ' . $row[5]);
        }
        $output = shell_exec($command);
        $array = json_decode($output, true);
        push_api_helper($array, $row[0], $db, $row[7]);
        if (!empty($filter)) {
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