<?php include('../html_files/header.php'); ?>

<?php
$command = escapeshellcmd('../Python/Scraper/scrapeOnePage.py https://www.compari.ro/telefoane-mobile-c3277/allview/x4-soul-lite-16gb-p377956263/');
$output = shell_exec($command);
$array = json_decode($output,true);
var_dump($array);
echo $array['name']."<br>";

?>

.<?php include('../html_files/footer.php'); ?>
