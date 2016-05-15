<?php

$page_title="Soccer Teams Data Compilation";
require_once("config.ini.php");
require_once("function.ini.php");


$show_key= meta_tools();
$desc = "The PIC is a specially devised chart, pictorially showing the immediate past and current scoring records for the two teams, and its purpose is to assist you to fully understand the relevance of our Program's predictions for each and every match. ";



require_once("header.ini.php");

$PAGE_TITLE="PIC Compilation";
?>

<style>
li {padding-bottom:8px;line-height:150%;}
ul, ol {padding:0;margin-bottom:0px;}

</style>
<!-- startprint -->

<?php page_header($PAGE_TITLE);?>


<p>Right from the very first week of a new season we produce a <span class="green">Performance Indicator Chart</span> (or <span class="green">PIC</span>) for every match, regardless of whether or not the two teams involved had played each other last season. We do this by basing the predictions for the first few weeks of each season principally on the historical data available (making reference to the totality of the match results and performance for the previous season). The detailed explanation as to how we manage to do that is as follows:</p> 

<ol style='padding-left:50px;'>

  <li>Each of our 9 different "Standard Type" Prediction Methods provides us with an indication of the exact score anticipated for each team in a match, in addition to calculating the probabilities for the three possible results (Home Win, Away Win and Draw). To be able to do this effectively at the start of the season, we have to create some worthwhile statistical "operating" data for each team.</li>
 
  <li>From the previous season's data we first calculate each team's Home and Away "Win Quotients" (WQ's), together with their respective "Scoring Abilities" (SA's) and "Vulnerabilities" (VU's) - (the meanings of these terms being, we hope, reasonably obvious). </li>
  
  <li>For very sound statistical reasons, we do not use data from any further back than the previous season for match prediction purposes. And don't let anyone try to convince you that data from 2 or more seasons back is relevant, because it isn't and never could be!</li>

  <li>For all relegated and promoted teams, we artificially "re-rank" them within their respective new Divisions, again based purely on their previous season's "relational" performance.</li>
 
  <li>Having artificially positioned the relegated and promoted teams in their new Divisions, we then derive a matrix of matches with which to commence the new season. We do this by first cloning the results for the relegated and promoted teams and then creating artificial match results for those matches where the teams did not play each other last season, with a "smoothing" process built in.</li>
  
  <li>All the calculations carried out by the Program are based on pure statistics. This ensures that the key predictive elements (WQ's, SA's  and VU's) for all those teams remaining in any given Division maintain the same general ratios as were evidenced at the end of the previous season. Equally, the relegated and promoted teams are ranked in order in their new Divisions in the same order as they finished in their former Divisions. <B>This adherence to statistical integrity is, we believe, the key to the success of the PaW Program.</B></li>
 
  <li>On a weekly basis, as the season progresses, the artificial data in the starting match matrix for the new season is replaced with the current data. The Program then recalculates the key predictive elements for use in processing the following week's set of predictions (statistically enhancing the data wherever significantly changed performance is observed).</li>
   
  <li>For the opening weeks of the season the <span class="green">PIC</span> therefore displays both "artificial" and "true" match results data, for which purpose we employ 3 different shades of the same colour in the following manner:

 <ol style="list-style-type:lower-roman;padding-top:10px;padding-left:30px;">
    <li>The lightest shade is used to represent the "artificial" match results derived to start the new season off.</li> 

    <li>The middle shade is used to represent the "true" past results for all matches played in the previous season where those fixtures have yet to be played in the new season.</li>

    <li>The darkest shade is used to represent the actual results for all matches played so far in the new season.</li>
  </ol>
  
  </li>

    <li>In addition to the coloured "disbursement" display, the data under the <span class="green">PIC</span> provides you with the following "background" information:
 
 <ol style="list-style-type:lower-roman;padding-top:10px;padding-left:30px;">
    
	<li>the "Unrounded Goals" values computed by our Program;</li>

    <li>the score when the two teams last played each other (but only as far back as the previous season's result - and for certain Scottish matches it may later (after the new season is under way) refer to an earlier match in the current season);</li>

    <li>the WQ's, SA's and VU's for each team, showing (a) the Current Value (which our Program uses for calculating the predictions), (b) the Starting Value and (c) the Projected Value;</li>

    <li>the Probabilities for each of the three Prediction "Type" outcome possibilities (Home Win, Away Win or Draw); </li> 
 
    <li>the prediction's ranking in the list of "Probabilities" for the particular Win Call made (Home Win Call or Away Win Call);</li>

    <li>for both teams: (a) the actual number of goals (both "for" and "against") compared with the number of goals predicted, (b) the success rates of the score-lines and results predicted, and (c) where our Program was too high or too low in its previous expectations of the team's performance;</li>

    <li>tables showing the comparative prediction accuracy for each individual team;</li>

    <li>Head-to-Head stats (going back some 20 years for all UK Divisions and up to 14 years  for other European Divisions);    </li>   

    <li>the current season's results to date for the Home Team at Home and when Away and for the Away Team when Away and at Home, together with a comparison with (and successes of) our Program's "Anticipated Score-Line" (ASL) predictions;</li>

    <li>a table to show the chances of the ASL occurring;</li>

    <li>the strength of the goal "advantage" for the 'stronger' team (as our Program perceives it) and the possibilities for other levels of "goal difference" occurring (useful for Correct Scores and Asian Handicap betting);</li>

    <li>the incidence of the actual Home, Draw and Away results for each team, both for this season and last season;</li>

    <li>the current League Standings for both teams (you can separately call up Overall, Home & Away standings);</li>

    <li>charts to show the reliabilities of the Program's predictions for each team, both for this season and last season, and</li>

    <li>similar information as above but relating to the <B>previous  season</B>: (1) for both teams - (a) a comparison of the actual number of goals ("for" and "against") with the number of goals predicted, (b) the success rates of the score-lines and results predicted, and (c) where our Program was too high or too low in its previous expectations of the team's performance; (2) tables showing the comparative prediction accuracy for each individual team and (3)	the results for the Home Team at Home and when Away and the Away Team when Away and at Home, together with a comparison with (and successes of) the Anticipated Score-Lines (ASL).</li>  
</ol>
</li>

</ul>


<p style='padding-top:0'>We believe that the above information covers the full range of material you ought to have in your possession when trying to make the decision as to which matches to bet on. But we are always open to suggestions as to how to improve the level and quality of the data we provide on this website, so if you have any useful suggestions please don't hesitate to <a class="prv" href="contactus.php">contact us</a>  about them.</p> 

<p>As we have also observed elsewhere, if you look back at the PIC for a previous week, all reports AFTER the "PREDICTION BACKUP & USEFULNESS DATA" (i.e. from "Prediction Accuracy This Season for Home Team" on and downwards) will require_once all the FIXTURES and RESULTS information right up to the current week (sorry, but this is due to a server storage limitation problem).</p>


<!-- stopprint -->
 
<?php 
	$ptopic="ggexplained.php"; $ntopic="compilingpic.php";
	$msg=$PAGE_TITLE;
	require_once("icons.ini.php") ;
	require_once("footer.ini.php");
?>
