<?	

include("config.ini.php");

include("function.ini.php");

$page_title="Soccer Prediction Data ";
include("header.ini.php");
page_header($page_title);

?>


<div class='site-map2'>
  
  <ul>
  	<li style='color:#000'><h2>PREDICTION DATA</h2>
			<ul style='padding:0;margin:0;'>
				<li><a style="padding-left:6px;" href="<?=$domain?>/soccer-predictions-by-division.php"  title="Predictions comprising the following Divisions:<?php echo divlist();?>" >1X2 Predictions by Division</a></li>
			</ul>
          <li style='color:#000'><h2>Current Week's Odds</h2>

	        	<ul style='padding:0;margin:0;'>
	        		<li><a href="<?=$domain?>/odds-listing.php?db=eu">Soccer 1X2 Odds by Division</a></li>	
	        		<li><a href="<?=$domain?>/full-odds-listing.php?db=eu">Soccer 1X2 Odds All Divisions Combined</a></li>
	        		<li><a href="<?=$domain?>/full-overround-listing.php?db=eu">Specific Call Type Over-Rounds - All Matches Combined</a></li>
	        		<li><a href="<?=$domain?>/full-dcodds-listing.php?db=eu">Double Chance Odds All Divisions Combined</a></li>
	        		<li><a href="<?=$domain?>/full-winonly-listing.php?db=eu">Win Only Odds (Draw = No Bet) All Divisions Combined</a></li>
	        		<li><a href="<?=$domain?>/full-asian-listing.php?db=eu">Asian Handicap Odds All Divisions Combined</a></li>
	        		<li><a href="<?=$domain?>/full-underover-listing.php?db=eu">Soccer Under/Over Odds All Divisions Combined</a></li>
	        		<li><a href="<?=$domain?>/calltype-listing.php?db=eu">By Predict-A-Win Call Type (1X2)</a></li>
					<li><a href="<?=$domain?>/bookie-paw-expectations.php?db=eu">Bookie v PaW Expectations</a>
					<li><a href="<?=$domain?>/full-overround-listing.php?db=eu">Specific Call Type Over-Rounds - All Matches Combined</a>
	        	</ul>
	        </li>
	       

	        <li style='color:#000'><h2>Current Probabilities/Reliabilities</h2>
	        	<ul style='padding:0;margin:0;'>
					<li><a href="javascript:bigwin('soccer-predictions-analysis-tool.php')" title=" Client Interface Tool for Analysing Past Predictions and Determining Own Soccer Selections">Soccer Predictions Analysis Tool</a></li>
					<li><a href="<?=$domain?>/soccer-win-probability-data.php">Match Probabilities Data</a></li>
					<li><a href="<?=$domain?>/soccer-team-reliability-data.php">Current 1X2 Reliabilities</a></li>
					<li><a href="<?=$domain?>/soccer-double-chance-reliability.php"  title="">Double Chance Reliabilities</a></li>
					<li><a href="<?=$domain?>/soccer-correct-score-hedge-betting.php"  title="">Hedge Betting Reliance Factors</a></li>
				</ul>	        	
	        </li>

         
        
	</li>		  
 
 
	

	<li style='color:#000'><h2>OTHER DATA</h2>
		<ul style='padding:0;margin:0;'>
        
            <li><a style="padding-left:6px;" href="<?=$domain?>/current-soccer-fixtures.php"  title="Current Soccer Fixtures for following Divisions:<?php echo divlist();?>">Current Fixtures List</a></li>
		    <li><a style="padding-left:6px;" href="<?=$domain?>/soccer-league-tables.php" title="League Tables comprising the following Divisions:<?php echo divlist();?>">Soccer League Tables</a></li>
		    <li><a style="padding-left:6px;" href="<?=$domain?>/soccer-results-matrices.php"  title="Results Matrices comprising the following Divisions: <?php echo divlist();?>">Soccer Results Matrices</a></li>
        
		    <li style='color:#000'><h2>Prediction Performance Records</h2>
		    	<ul style='padding:0;margin:0;'>
					<li><a href="<?=$domain?>/soccer-predictions-performance-1X2.php">By Predict-A-Win Call Type (1X2)</a></li>
					<li><a href="<?=$domain?>/soccer-prediction-performance-by-division.php">Predictions by Division</a></li>
					<li><a href="<?=$domain?>/soccer-prediction-performance-all-divisions.php">Predictions All Divisions Combined</a></li>
				</ul>			    		

		    </li>        
		    <li style='color:#000'><h2>Analysis of Previous Predictions</h2>
		    	<ul style='padding:0;margin:0;'>
					<li><a href="javascript:bigwin('soccer-predictions-analysis-tool.php')" title="Visitor Interface Tool for Analysis of Past Soccer Predictions">Soccer Predictions Analysis Tool</a></li>
					<li><a href="<?=$domain?>/win-only-soccer-predictions.php" title="Analysis of the Betting Outcome for the Wins Only (Draw = No Bet) option for the Segregated Selections Home and Away Calls">Win Only Betting Outcome</a></li>
					<li><a href="<?=$domain?>/double-chance-soccer-predictions.php" title="Analysis of the success or otherwise of selecting the Double Chance option for the Segregated Selections 1X2 Calls">Double Chance Hit Rate</a></li>
					<li><a href="<?=$domain?>/soccer-double-chance-betting.php" title="Analysis of the Betting Outcome for the Double Chance option for the Segregated Selections 1X2 Calls">Double Chance Betting Outcome</a></li>
					<li><a href="<?=$domain?>/soccer-anticipated-score-line-hit-miss-data.php" title="Detailed Hit/Miss Analysis for the Segregated Selections 1X2 (Result Type) Calls">Score-Line Hit/Miss Data</a></li>
	    		</ul>
		    </li>
        


	        <li><a style="padding-left:6px;" href="<?=$domain?>/soccer-predictions-backup-data.php"  title="">Blank "EASE" Spreadsheet</a></li>

	        <li><a style="padding-left:6px;" href="<?=$domain?>/soccer-1X2-value-bets.php"  title='"Possible Value Calls'>Possible Value Calls</a></li>

    <?php  if (!isset($_SESSION['userid'])){ ?>
	        <li><a href="login.php"  title="Jackpot Winnings Calculator">Jackpot Winnings Calculator</a></li>
	<?php }else{ ?>
	        <li><a style="padding-left:6px;" href="javascript:calmsg('<?=$domain?>/soccer-winnings-jackpot-calculator.php')"  title="Jackpot Winnings Calculator">Jackpot Winnings Calculator</a></li>
	<?php } ?>

			<li style='color:#000'><h2>Soccer Betting Advice</h2>
			 	<ul style='padding:0;margin:0;'>
					<li><a href="<?=$domain?>/soccer-bettingadvice-for-novices.php">for Novices</a></li>
					<li><a href="<?=$domain?>/soccer-bettingadvice-for-advanced-bettors.php">for Advanced Bettors</a></li>
					<li><a href="<?=$domain?>/soccer-bettingadvice-for-academics.php">for Academics</a></li>
					<li><a href="<?=$domain?>/soccer-bettingadvice-downloadable.php">Downloadable Excel Files</a></li>
			 	</ul>
			
			</li>




       </ul> 

	</li>	
 </ul>



</div>

<? include("footer.ini.php"); ?>
	


