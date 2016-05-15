<?php
$page_title="Soccer Predictions Analysis Tool";

require_once("config.ini.php");
require_once("function.ini.php");
require_once("header.ini.php");



$PAGE_TITLE="Soccer Predictions Analysis Tool";
//
page_header($PAGE_TITLE);

?>

<p>Our Soccer Predictions Analysis Tool ("<span class='bb'>SoccerPAT</span>") is an online, interactive piece of wizardry that took us a lot longer to develop than we had ever imagined. But that's only because <b>it is chock-a-block full of data</b> that will allow you to <b>run many different "what-if" scenarios</b> so you can see what would have happened had you bet this way, that way or the other way. Plus it has a "<span class='bb'>reverse call</span>" option to allow you to immediately see what the outcome would have been if you had called all matches identified as possible "Home Wins" as "Away Wins" or "Draws" instead!  </p>

<p>To introduce you to how you can use "<span class='bb'>SoccerPAT</span>" we have produced two short <b>YouTube videos</b> that are available on this website.  Later we will produce a few more videos to show you the different ways we hope "<span class='bb'>SoccerPAT</span>" will make good money for us this season.  </p>

<?php 

$ptopic="#"; $ntopic="wklout.php";
$msg=$PAGE_TITLE;
require_once("icons.ini.php") ;

require_once("footer.ini.php"); 

?>
