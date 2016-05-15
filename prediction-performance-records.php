<?php
session_start();

include("config.ini.php");
include("function.ini.php");

$active_mtab = 1;

if (!isset($_GET['db'])){
  $db= 'eu';
  $page_title="Prediction Performance Records";
}else{
  $db= $_GET['db'];
  $page_title="Prediction Performance Records " . site($_GET['db']);
}


$qry = "SELECT * FROM setting";
if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
$row = $temp->fetch() ;   

$updating = $row["updating"];
$sended=$row["seasonended"];
$lastweek = $row["weekno"];
$season  =$row["season"];

/*
if ($LOG=="N"): $lastweek = $lastweek - 1; endif;
if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;
*/



$show_key= meta_bettingdata();
$desc = "Current week's Odds collected from reputable Bookies covering a wide range of betting scenarios from 1X2 betting, through Double Chance, Outright Wins, Asian Handicap, Under/Over and Correct Scores betting.";

include("header.ini.php");



page_header("Prediction Performance Records") ;

?> 
<div style="padding-bottom:2px"></div>




  
 


<br />
<br />


 
<table width='95%' align='center'  border='0' cellpadding="4" cellspacing="0">
    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-predictions-performance-1X2.php"><span class='big'>By Predict-A-Win Call Type (1X2)</span></a></td>
    </tr>

    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-prediction-performance-by-division.php"><span class='big'>Predictions by Division</span></a></td>
    </tr>


	<tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-prediction-performance-all-divisions.php"><span class='big'>Predictions All Divisions Combined</span></a></td>
    </tr>


	<tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-segregated-selections-performance.php"><span class='big'>Prime Home Win Calls  (Top 6)</span></a></td>
    </tr>

</table>

<?

include("footer.ini.php"); 

?>