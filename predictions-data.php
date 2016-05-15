<?php

$page_title="Predictions Data";

require_once("config.ini.php");
require_once("function.ini.php");
require_once("header.ini.php");



$PAGE_TITLE="Predictions Data";
//
page_header($PAGE_TITLE);

?>

<p>Under the above heading on the Members Area screen we post the current season's prediction data and all associated Odds data in a variety of different ways: </p>


<ul style='padding-left:40px;margin-top:10px;list-style:none;'>
	
	<li class='ddarrow'><strong>1X2 Predictions by Division</strong>, comprising the current week's detailed predictions data for all the Divisions we cover (20 for Europe and 3 for the Americas), broken down by Division, then by match date and, finally, alphabetical order of Home Team name).</li>
 
	<li class='ddarrow'><strong>Current Week's Odds</strong>, showing the <b>Bookie's Odds</b> for the current week right alongside our PaW Program's predictions, across a variety of different Bet Types (for 1X2, Double Chance, Win Only (Draw = No Bet), Asian Handicap and Under/Over betting), plus we also provide Half-Time/Full-Time and Correct Scores Odds in separate full Odds tables for each match.  The Odds are added to on a daily basis as and when any outstanding Odds become available, and we let you know which Bookies we obtained the Odds from.
		<br/>
		<br/>
		If you want to concentrate on particular PaW "call types" for your selections (such as "Home Win Calls" or "Away Win Calls"), then you can check out our separate table called <strong>"By Predict-A-Win Call Type (1X2)"</strong>, which will identify our Program's calls and show the Bookie's Odds for the limited scenario you have selected.
		<br/>
		<br/>
		Conversely, if you want to see what happens with the Bookie's expectations and how our Program's predictions fare alongside those Bookie expectations, then you can check out the separate <strong>"Bookie v PaW Expectations"</strong> table.
		<br/>
		<br/>
		Also, if you are interested in such things as the value of the Bookie's <strong>Over-Rounds</strong> contained inside the Odds and where potential so called "Value Bets" might be sitting, then we even have tables to show those under the "Current Week's Odds" menu, namely the following sub-menus: <strong>"Specific Call Type Over-Rounds - All Matches Combined"</strong> and <strong>"Possible Value Calls"</strong> (both of which should be treated with caution, as they depend to a great extent on the PaW Program's ability to calculate the match <strong>"Probabilities"</strong> accurately).  

</li>
	
	<li class='ddarrow'><strong>Current Probabilities</strong>, comprising the following data for all posted matches:
			
			<ul style="margin-left:40px;">
				<li>Match Probabilities,</li>
				<li>Current 1X2 Reliabilities, </li>
				<li>Double Chance Reliabilities, and</li>
				<li>Hedge Betting Reliance Factors.</li>
				
			</ul>	
	
	</li>
	
	<li class='ddarrow'><strong>Prime Home Win Calls (Top 6)</strong>, comprising our PaW Program's Top 6 "Home Win" selections (provided there are that many matches meeting our very strict selections criteria for the week in question) divided up into Midweek, Weekend Short Odds, Weekend Medium Odds and Weekend Long Shot categories <b>(where you should seriously view the Medium Odds and Long Shots calls as "Double Chance" or "Win Only" betting options, <span class='red'>and not as "Outright Win" calls</span>).</b> Furthermore, whatever else you do, never trust the PRIME "<span class='red'>Short Odds</span>" selections to make you money! </li>
	
	
</ul>

<p>You can see the prediction records for past seasons going back many years (and corresponding 100% to all the above mentioned Predictions Data) in the menu titled "<b>Prediction Performance Records</b>" under the section  headed "<b>General Data</b>" in the right-hand menu in the Members Area.  </p>

<?php 

$ptopic="#"; $ntopic="wklout.php";
$msg=$PAGE_TITLE;
require_once("icons.ini.php") ;

require_once("footer.ini.php"); 

?>
