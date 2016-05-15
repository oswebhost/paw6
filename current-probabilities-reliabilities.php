<?php
session_start();

include("config.ini.php");
include("function.ini.php");


if (!isset($_GET['db'])){
  $db= 'eu';
  $page_title="Soccer Betting Odds";
}else{
  $db= $_GET['db'];
  $page_title="Soccer Betting Odds " . site($_GET['db']);
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



page_header("Current Probabilities/Reliabilities") ;

?> 
<div style="padding-bottom:2px"></div>


  
 <?php if (!isset($_SESSION["userid"])){ ?>

	 		<div class='errordiv' style='text-align:center; margin-bottom:0px;font-size:14px;border-bottom:none;background:#ccffff'>
	 				Our past data records are just one example of the fantastic tools we provide for helping you decide your current week's betting selections.
	 		</div>
		
	 		<div class='errordiv'>
	 		   
			   <b>NOTE:</b> Because we show our match Predictions Data against the Probabilities/Reliabilities Data, you will <span class='red'>NOT</span> be able to access the Current Week's Data in this section <span class='red'>if you are not registered</span>, but you will be able to review the data for all Past Weeks.<br />
	 			 <div style='margin-top:10px;text-align:center'>
				  <a title='Get Soccer Predictions Data Now!' href="<?=$domain?>/register.php">	
				  <img src='<?=$domain?>/images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
				</div>
	 		</div>
	
<?php }else{ echo "<br/ >"; } ?>  


<br />

  
<table width='95%' align='center'  border='0' cellpadding="4" cellspacing="0">
    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-win-probability-data.php"><span class='big'>Match Probabilities Data</span></a></td>
    </tr>

    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-team-reliability-data.php"><span class='big'>Current 1X2 Reliabilities</span></a></td>
    </tr>


    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-double-chance-reliability.php"  title=""><span class='big'>Double Chance Reliabilities</span></a></td>
    </tr>


    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'><a class='sbar' href="<?=$domain?>/soccer-correct-score-hedge-betting.php"  title=""><span class='big'>Hedge Betting Reliance Factors</span></a></td>
    </tr>

</table>

<?php

include("footer.ini.php"); 

?>