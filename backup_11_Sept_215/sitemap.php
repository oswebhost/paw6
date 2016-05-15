<?php	
session_start();

include("config.ini.php");

include("function.ini.php");

$page_title="Site Map";
include("header.ini.php");
page_header("Site Map");

$ui = "?db=".$_SESSION['db'];

?>


<div class='site-map'>
  
  <ul>
  	<li><h1>PREDICTIONS DATA</h1>

		  <li><a style="padding-left:6px;" href="<?=$domain?>/soccer-predictions-by-division.php"  title="Predictions comprising the following Divisions: English Barclays Premiership, English Championship, English Leagues 1 & 2, National League (Conference), Isthmian Premier, English Northern & Southern Premiers, Scottish Premier, Scottish Championship, Scottish Leagues 1 & 2, French Ligue 1, German Bundesliga, Greek Super League, Dutch Eredivisie, Italian Serie A, Portuguese Liga, Spanish Primera Liga, Turkish Super Lig, Brazil Serie A & B, and USA MLS." >1X2 Predictions by Division</a></li>

          <li style='color:#000'><h2>Current Week's Odds</h2>

	        	<ul style='padding:0;margin:0;'>
					<li><a href="<?=$domain?>/odds-listing.php<?php echo $ui; ?>">1X2 Odds by Division</a></li>
					<li><a href="<?=$domain?>/full-odds-listing.php<?php echo $ui; ?>">1X2 Odds All Divisions Combined</a></li>
					<li><a href="<?=$domain?>/full-dcodds-listing.php<?php echo $ui; ?>">Double Chance Odds All Divisions Combined</a></li>
					<li><a href="<?=$domain?>/full-winonly-listing.php<?php echo $ui; ?>">Win Only Odds (Draw = No Bet) All Divisions Combined</a></li>
					<li><a href="<?=$domain?>/full-asian-listing.php<?php echo $ui; ?>">Asian Handicap Odds All Divisions Combined</a></li>
					<li><a href="<?=$domain?>/full-underover-listing.php<?php echo $ui; ?>">Under/Over Odds All Divisions Combined</a></li>
					<li><a href="<?=$domain?>/calltype-listing.php<?php echo $ui; ?>">By Predict-A-Win Call Type (1X2)</a></li>
					<li><a href="<?=$domain?>/bookie-paw-expectations.php<?php echo $ui; ?>">Bookie v PaW Expectations</a></li>
					<li><a href="<?=$domain?>/full-overround-listing.php<?php echo $ui; ?>">Specific Call Type Over-Rounds - All Matches Combined</a></li>
					<li><a href="<?=$domain?>/soccer-1X2-value-bets.php<?php echo $ui; ?>"  title='Possible Value Calls'>Possible Value Calls</a></li>
			    
	        	</ul>
	        </li>
	       

	        <li style='color:#000'><h2>Current Probabilities/Reliabilities</h2>
	        	<ul style='padding:0;margin:0;'>
					<li><a href="<?=$domain?>/soccer-win-probability-data.php<?php echo $ui; ?>">Match Probabilities</a></li>
					<li><a href="<?=$domain?>/soccer-team-reliability-data.php<?php echo $ui; ?>">Current 1X2 Reliabilities</a></li>
					<li><a href="<?=$domain?>/soccer-double-chance-reliability.php<?php echo $ui; ?>"  title="">Double Chance Reliabilities</a></li>
					<li><a href="<?=$domain?>/soccer-correct-score-hedge-betting.php<?php echo $ui; ?>"  title="">Hedge Betting Reliance Factors</a></li>
				</ul>	        	
	        </li>

         
        
	</li>		  
 
 
	
	<li style='color:#000'><h2><a href='<?=$domain?>/soccer-home-win-predictions.php'>Prime Home Win Calls (Top 6)</a></h2></li>

	<li><a href="javascript:bigwin('soccer-predictions-analysis-tool.php<?php echo $ui; ?>')" title=" Client Interface Tool for Analysing Past Predictions and Determining Own Soccer Selections">Soccer Predictions Analysis Tool</a></li>
	
	<li><h1>GENERAL DATA</h1>
		<ul style='padding:0;margin:0;'>
        
            <li><a style="padding-left:6px;" href="<?=$domain?>/current-soccer-fixtures.php<?php echo $ui; ?>"  title="Current Soccer Fixtures for following Divisions:<?php echo divlist();?>">Fixtures List</a></li>
			
			<li><a style="padding-left:6px;" href="<?=$domain?>/current-soccer-outright-win.php<?php echo $ui; ?>"  title="Outright winning odds for following Divisions:<?php echo divlist();?>">Jump The Gun!</a></li>
			
		    <li><a style="padding-left:6px;" href="<?=$domain?>/soccer-league-tables.php<?php echo $ui; ?>" title="League Tables comprising the following Divisions:<?php echo divlist();?>">League Tables</a></li>
		    <li><a style="padding-left:6px;" href="<?=$domain?>/soccer-results-matrices.php<?php echo $ui; ?>"  title="Results Matrices comprising the following Divisions: <?php echo divlist();?>">Results Matrices</a></li>
        
		    <li style='color:#000'><h2>Prediction Performance Records</h2>
		    	<ul style='padding:0;margin:0;'>
					<li><a href="<?=$domain?>/soccer-prediction-performance-by-division.php<?php echo $ui; ?>">Predictions by Division</a></li>
					<li><a href="<?=$domain?>/soccer-prediction-performance-all-divisions.php<?php echo $ui; ?>">Predictions All Divisions Combined</a></li>
					<li><a href="<?=$domain?>/soccer-prediction-performance-double-chance.php<?php echo $ui; ?>">Double Chance All Divisions Combined</a></li>
					<li><a href="<?=$domain?>/soccer-prediction-performance-winonly.php<?php echo $ui; ?>">Win Only Odds (Draw = No Bet) All Divisions Combined</a></li>
					<li><a href="<?=$domain?>/soccer-prediction-performance-asianhandicap.php<?php echo $ui; ?>">Asian Handicap Odds All Divisions Combined</a></li>
					<li><a href="<?=$domain?>/soccer-prediction-performance-underover.php<?php echo $ui; ?>">Under/Over Odds All Divisions Combined (PAW)</a></li>
					<li><a href="<?=$domain?>/soccer-prediction-performance-underover-bookie.php<?php echo $ui; ?>">Under/Over Odds All Divisions Combined (Bookie)</a></li>
					<li><a href="<?=$domain?>/soccer-predictions-performance-1X2.php<?php echo $ui; ?>">By Predict-A-Win Call Type (1X2)</a></li>
					<li><a href="<?=$domain?>/soccer-predictions-performance-bookie-expectations.php<?php echo $ui; ?>">Bookie v PaW Expectations</a></li>
					<li><a href="<?=$domain?>/soccer-predictions-performance-value-bets.php<?php echo $ui; ?>">Possible Value Calls</a></li>
					<li><a href="<?=$domain?>/soccer-segregated-selections-performance.php<?php echo $ui; ?>">Prime Home Win Calls  (Top 6)</a></li>	
		    		
	    		</ul>
		    </li>
        	
        	<li style='color:#000'><h2><a href='<?=$domain?>/fifa-world-cup-2014.php'>FIFA World Cup 2014 Brazil</a></h2></li>
        	
        	<li style='color:#000'><h2>Betting Advice</h2>
			 	<ul style='padding:0;margin:0;'>
					<li><a href="<?=$domain?>/soccer-bettingadvice-for-novices.php">for Novices</a></li>
					<li><a href="<?=$domain?>/soccer-bettingadvice-for-advanced-bettors.php">for Advanced Bettors</a></li>
					<li><a href="<?=$domain?>/soccer-bettingadvice-for-academics.php">for Academics</a></li>
					<li><a href="<?=$domain?>/soccer-bettingadvice-downloadable.php">Downloadable Excel Files</a></li>
			 	</ul>
			
			</li>

			<li style='color:#000'><h2>Downloadables</h2>
				<ul style='padding:0;margin:0;'>
				   <li><a style="padding-left:6px;" href="<?=$domain?>/soccer-predictions-backup-data.php?db=eu"  title=""> "EASE 6" Spreadsheet</a></li>
				
			        <li><a style="padding-left:6px;" href="<?=$domain?>/soccer-predictions-backup-data.php"  title="">Blank "EASE" Spreadsheet</a></li>
					
					<li><a style="padding-left:6px;" href="<?=$domain?>/soccerpat-record-templates.php?db=eu"  title="">SoccerPAT Record Templates</a></li>
					
					<li><a style="padding-left:6px;" href="<?=$domain?>/soccer-bettingadvice-downloadable.php"  title="">Excel Betting Files</a></li>

			    </ul>

   
		        <li><a  href="javascript:calmsg('<?=$domain?>/soccer-winnings-jackpot-calculator.php<?php echo $ui?>')"  title="Jackpot Winnings Calculator">Jackpot Winnings Calculator</a></li>
	
			




       </ul> 

	</li>	
 </ul>

 <ul>
	<li><a href="<?=$domain?>/index.php">Home</a></li>
	<li><a href="<?=$domain?>/ba/aboutus.php">About Us</a></li>
	<li style='color:#000'><h2>Services Information</h2>
		<ul style='padding:0;margin:0;'>
			<li><a href="<?=$domain?>/ba/about-predictawin-services.php" >About Our Services</a></li>
			<li><a href="<?=$domain?>/ba/about-posting.php" >Postings (Dates/Times/Content)</a></li>
			<li><a href="<?=$domain?>/ba/thepic.php" >Performance Indicator Chart (PIC)</a></li>
			<li><a href="<?=$domain?>/ba/compliepic.php" >PIC Compilation</a></li>
			<li><a href="<?=$domain?>/ba/upic.php" >Utilising the PIC Backup Data</a></li>
			<li><a href="<?=$domain?>/ba/using-the-blank-ease-spreadsheets.php">Using the "Blank" EASE Spreadsheet</a></li>
			<li><a href="<?=$domain?>/ba/aboutodds.php" >About Our Odds Postings</a></li>
			<li><a href="<?=$domain?>/ba/paw.php" >About the PaW Program</a></li>
			<li><a href="<?=$domain?>/ba/aboutfaqs.php" >About Our FAQs</a></li>
			<li><a href="<?=$domain?>/ba/bettingadvice.php" >Betting Advice</a></li>
		</ul>
	</li>
	<li><a href="<?=$domain?>/register.php">Register</a></li>
	<li><a href="<?=$domain?>/faq.php">FAQs</a></li>
	
  <li><a href="<?=$domain?>/soccer-reviews.php">Site News & Soccer Reviews</a></li>
  <li><a href="<?=$domain?>/free-soccer-predictions-history.php">Free Soccer Predictions History</a></li>
	<li><a href="<?=$domain?>/contactus.php">Contact Us</a></li>
	<li><a href="<?=$domain?>/userinfo.php">My Account</a></li>
	<li><a href="<?=$domain?>/disclaimer.php">Legal/Disclaimer</a></li>
	<li><a href="<?=$domain?>/privacy.php">Privacy Policy</a></li>
	<li><a href="<?=$domain?>/commenting-rules.php">Commenting Rules</a></li>  
	<li><a href="<?=$domain?>/copyright.php">Copyright</a></li>
 </ul>

</div>

<? include("footer.ini.php"); ?>
	


