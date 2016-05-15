<?php
session_start();

include("config.ini.php");
include("function.ini.php");

$active_mtab = 1;

if (!isset($_GET['db'])){
  $db= 'eu';
  $page_title="PAnalysis of Previous Predictions";
}else{
  $db= $_GET['db'];
  $page_title="Analysis of Previous Predictions " . site($_GET['db']);
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



page_header("Analysis of Previous Predictions") ;

?> 
<div style="padding-bottom:2px"></div>





<table border="0" width="100%" cellpadding="0" cellspacing="0" >
<tr>
   <td width="25%"><a class='sbar' href="bookies-odds-soccer-betting.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a></td>
   <td width="25%" align='center' colspan='3' valign="bottom"></td>
   <td width="25%" align="right"> </td>
</tr>
</table>
<br />
<br />


 
<table width='95%' align='center'  border='0' cellpadding="4" cellspacing="0">
    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/win-only-soccer-predictions.php" title="Analysis of the Betting Outcome for the Wins Only (Draw = No Bet) option for the Segregated Selections Home and Away Calls"><span class='big'>Win Only Betting Outcome</span></a></td>
    </tr>

    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/double-chance-soccer-predictions.php" title="Analysis of the success or otherwise of selecting the Double Chance option for the Segregated Selections 1X2 Calls"><span class='big'>Double Chance Hit Rate</span></a></td>
    </tr>


    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-double-chance-betting.php" title="Analysis of the Betting Outcome for the Double Chance option for the Segregated Selections 1X2 Calls"><span class='big'>Double Chance Betting Outcome</span></a></td>
    </tr>

    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-anticipated-score-line-hit-miss-data.php" title="Detailed Hit/Miss Analysis for the Segregated Selections 1X2 (Result Type) Calls"><span class='big'>Score-Line Hit/Miss Data</span></a></td>
    </tr>


</table>


<?php 
include("footer.ini.php"); 

?>