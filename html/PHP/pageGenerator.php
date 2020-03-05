<?php require_once('../configure/config.php');
$_SESSION['header']->show_file_modified()?>

<?php
$command = escapeshellcmd('../Python/Scraper/scrapeOnePage.py https://www.compari.ro/telefoane-mobile-c3277/allview/x4-soul-lite-16gb-p377956263/');
$output = shell_exec($command);
$array = json_decode($output,true);
var_dump($array);
echo $array['name']."<br>";
$item = new CustomTemp('html_files/item.php',$array);
$item->show_file_modified();
?>

.<?php $_SESSION['footer']->show_file_modified(); ?>
