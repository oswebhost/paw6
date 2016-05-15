<?php
session_start();

include("config.ini.php");
include("function.ini.php");

$active_mtab = 1;

if (!isset($_GET['db'])){
  $db= 'eu';
  $page_title="Soccer Betting Advice";
}else{
  $db= $_GET['db'];
  $page_title="Betting Advice " . site($_GET['db']);
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



$show_key= meta_bettingdata();
$desc = "Current week's Odds collected from reputable Bookies covering a wide range of betting scenarios from 1X2 betting, through Double Chance, Outright Wins, Asian Handicap, Under/Over and Correct Scores betting.";

include("header.ini.php");



page_header("Betting Advice") ;

?> 
<div style="padding-bottom:2px"></div>



 

<br />
<br />

<table width='95%' align='center'  border='0' cellpadding="4" cellspacing="0">
    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-bettingadvice-for-novices.php"><span class='big'>for Novices</span></a></td>
    </tr>

    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-bettingadvice-for-advanced-bettors.php"><span class='big'>for Advanced Bettors</span></a></td>
    </tr>

    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-bettingadvice-for-academics.php"><span class='big'>for Academics</span></a></td>
    </tr>

</table>

<?php

include("footer.ini.php"); 

?>