<?php
require_once ('../configure/config.php');

$db = Database::getDatabaseObj();
$db->connect();
$result = $db->query("SELECT * FROM `td_deals` left join `items` on id_item = items.id ORDER BY `created_at`");

header("Content-Type: text/xml;charset=iso-8859-1");

echo "<?xml version='1.0' encoding='UTF-8' ?>" . PHP_EOL;
echo "<rss version='2.0'>".PHP_EOL;
echo "<channel>".PHP_EOL;
echo "<title>Feed Title | RSS</title>".PHP_EOL;
echo "<link>"._SITE_URL."</link>".PHP_EOL;
echo "<description>Cloud RSS</description>".PHP_EOL;
echo "<language>en-us</language>".PHP_EOL;

while(($row = mysqli_fetch_row($result))!=NULL) {
    $image_size_array = get_headers($row[8], 1);
    $image_size = $image_size_array["Content-Length"];
    $image_mime_array = getimagesize($row[8]);
    $image_mime = $image_mime_array["mime"];
    echo "<item xmlns:dc='ns:1'>".PHP_EOL;
    echo "<title>".$row[6]."</title>".PHP_EOL;
    echo "<link>"._SITE_URL."/PHP/pageGenerator.php?name=".$row[6]."</link>".PHP_EOL;
    echo "<guid>".md5($row[0])."</guid>".PHP_EOL;
    echo "<description>Min Price ".substr($row[7], 0, 300) ." RON</description>".PHP_EOL;
    echo "<enclosure url='".$row[8]."' length='".$image_size."' type='".$image_mime."' />".PHP_EOL;
    echo "<category>PHP tutorial</category>".PHP_EOL;
    echo "</item>".PHP_EOL;
}

echo '</channel>'.PHP_EOL;
echo '</rss>'.PHP_EOL;
