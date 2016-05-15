<?php	
include("config.ini.php");

include("function.ini.php");

$page_title="Latest Soccer Headlines";

include("header.ini.php");

page_header("Latest Soccer Headlines") ; 

?>
<style>
	.newsbox3 {font-size:11px;border:1px solid #ccc;padding:3px; width:214px;float:left; margin:8px;height:220px;overflow:hidden;}
	.newsbox3:hover {background:#ccc;border:1px solid #333;}
</style>

<?

$url = "http://www.teamtalk.com/rss/1765";

$res = file_get_contents($url);

$res = str_replace("<![CDATA[","", $res);
$res = str_replace("]]>","", $res);
$res = str_replace("&","and", $res);
$res = str_replace("'","\'", $res);
$res = $res;

$xml = simplexml_load_string($res);


$ncount = count($xml->channel->item);
if ($ncount >= 24) $ncount = 24;

for ($i=0; $i<$ncount; $i++){
	
	$links = "<a class='newstitle' href='". trim($xml->channel->item[$i]->link) ."'>"; ;
	$image= $xml->channel->item[$i]->enclosure;
	$image= ereg_replace("/84/","/402x210/", $image);
	
	echo "<div class='newsbox3' style='width:260px;'><img src='$image' border='0' width='260' /><br/>\n\n";
	echo "<center>". stripslashes($links . $xml->channel->item[$i]->title) . "</a><center><br />";
	echo stripslashes($xml->channel->item[$i]->description) . "<br />";
	echo "</div>";

}


$url = "http://www.teamtalk.com/rss/12878";

$res = file_get_contents($url);

$res = str_replace("<![CDATA[","", $res);
$res = str_replace("]]>","", $res);
$res = str_replace("&","and", $res);
$res = str_replace("'","\'", $res);
$res = $res;

$xml = simplexml_load_string($res);


$ncount = count($xml->channel->item);
if ($ncount >= 24) $ncount = 24;

for ($i=0; $i<$ncount; $i++){
	
	$links = "<a class='newstitle' href='". trim($xml->channel->item[$i]->link) ."'>"; ;
	$image= $xml->channel->item[$i]->enclosure;
	$image= ereg_replace("/84/","/402x210/", $image);
	
	echo "<div class='newsbox3' style='width:260px;'><img src='$image' border='0' width='260' /><br/>\n\n";
	echo "<center>". stripslashes($links . $xml->channel->item[$i]->title) . "</a><center><br />";
	echo stripslashes($xml->channel->item[$i]->description) . "<br />";
	echo "</div>";

}

include("footer.ini.php"); 

?>