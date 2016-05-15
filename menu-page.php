<?php

include("config.ini.php");
include("function.ini.php");

$page_title = "Soccer Predictions";

include("header.ini.php");
//page_header("Copyright");

?>


<div style='border:1px solid #DE231E;padding:0;margin:0;float:left;width:240px;'>
	<ul>
        <li><h3><a style="padding-left:6px;color:blue;" href="<?=$domain?>/soccer-predictions-by-division.php"  title="Predictions comprising the following Divisions:<?php echo divlist();?>" >1X2 Predictions by Division</a></h3></li>
		<li><h2><a style="padding-left:6px;" href="<?=$domain?>/bookies-odds-soccer-betting.php"  title="Weekly Odds, Soccer 1X2 Odds, Double Chance Odds, Win Only Odds (Draw = No Bet), Asian Handicap Odds, Soccer Under/Over Odds, By Predict-A-Win Call Type (1X2), Bookie v PaW Expectations">Current Week's Odds</a></h2></li>
        
        
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/#"  title="" onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'dataanalysis')">Current Probabilities/Reliabilities</a></h2></li>
        
       
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/fifa-world-cup-2014.php"  title="">FIFA World Cup 2014</a></h2></li>
        
      
       <? if ($_SESSION['userid']=='wally' or $_SESSION['userid']=='imran'){ ?>
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/soccer-home-win-predictions.php"  title="">Segregated Selections (Top 6)</a></h2></li>
        
        
       <?}?>
       
        
        
		
	

      
    </ul>    

  </div>	
  



<? include("footer.ini.php"); ?>