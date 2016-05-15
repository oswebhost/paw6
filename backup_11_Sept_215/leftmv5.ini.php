<!--
<div style='text-align:center;border:1px solid green;background:#ECFAD4;padding:8px;font-size:12px;font-family: tahoma;line-height:130%;margin-right:4px;margin-top:0px;'>
Under "<strong>DATA for MEMBERS</strong>", non-paying visitors can use all our fabulous research tools for all past weeks (available in the "<strong>Weekly Odds v Predictions</strong>" section).  But only Subscribers can view the current week's soccer predictions too.  

</div>
-->

<?php 
	session_start();
	
	if (!isset($_SESSION['db'])){
		$_SESSION['db'] = 'eu';
	}
	//$_SESSION['db'] = 'sa';
	$ui = "?db=".$_SESSION['db'];
	

?>


			
<!-- Main menu Start -->

<script language="JavaScript" type="text/javascript">

function showMsg()
{
  alert ("Under Construction - Coming Soon!");
  return;
}
</script>

<div id="google_translate_element" style='border:1px solid #32701D;background:#fff;padding:5px;margin-top:8px;'></div>
<script language="JavaScript" type="text/javascript">

function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en'
  }, 'google_translate_element');
}
</script>

<script language="JavaScript" type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



<div style='margin-bottom:5px;border:0'></div>


<?php if (!isset($_SESSION["userid"])){ ?>
<div class="reg_botton" style='border:1px solid #fff;width:188px;margin:4px 0 4px 0;'>
  <a title='Get Soccer Predictions Data Now!' href="<?=$domain?>/register.php<?php echo $ui; ?>">
    <img src='<?=$domain?>/images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
</div>


<?}

//print_r($_SESSION);

?>



<div style='font-size:12px;widht:100%;border:1px solid #FFCC00;padding:5px;background:#fff9dd;margin-bottom:5px;'>
	<b>Default Database</b><br/>
	<table>
		<tr>
			<td><input type='radio' name='dbs' <?php echo ($_SESSION['db']== 'eu'? 'checked' : ''); ?> onclick="javascript:location.href='<?=$domain;?>/setdefault.php?db=eu&file=<?php echo $PHP_SELF;?>'"></td>
			<td>European Divisions</td>
		</tr>
		<tr>
			<td><input type='radio' name='dbs' <?php echo ($_SESSION['db']=='sa'? 'checked' : ''); ?> onclick="javascript:location.href='<?=$domain;?>/setdefault.php?db=sa&file=<?php echo $PHP_SELF;?>'"></td>
			<td>Americas Divisions</td>
		</tr>
	</table>
	
</div>


<style type="text/css">
	#accordion ol {padding:0; margin:0; list-style:none;text-align:left;}
</style>


<div id="accordion" class="MainMenu">
  <h3><img src='<?php echo $domain; ?>/images/prediction_data-02.jpg' border='0' alt='Predictions Data'></h3>
  <div>
  	<ol>
  		<li><a href='soccer-predictions-by-division.php<?php echo $ui; ?>'>1X2 Predictions by Division</a></li>
  		<li><a href='#' onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'weeklyodds')">Current Week's Odds</a></li>
  		<li><a href='#' onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'curProbs')">Current Probabilities / Reliabilities</a></li>
  
        <li><a href="<?=$domain?>/soccer-home-win-predictions.php<?php echo $ui; ?><?php echo $ui; ?><?php echo $ui; ?>"  title="">Prime Home Win Calls (Top 6)</a></li>
  
       
  	</ol>
  </div>
 <a class='none' href="javascript:bigwin('<?php echo $domain;?>/soccer-predictions-analysis-tool.php?<?php echo $toolurl;?>')"><img src="<?php echo $domain;?>/images/newtool10.gif" border="0" alt="Soccer Selections Analysis Tool"></a>   
  
  <div></div>
  <a class='none' title="Link to Have Your Say Page" href="<?php echo $domain?>/haveyoursay.php"><img src='<?php echo $domain?>/images/gotsamethingtosay.jpg' border='0' alt='Got Samething To Say?'></a>
  <div></div>
  

  <h3><img src='<?php echo $domain; ?>/images/general_data-02.jpg' border='0' alt='General Data'></h3>
  <div>
  	<ol>
  		<li><a href='<?php echo $domain; ?>/current-soccer-fixtures.php<?php echo $ui; ?>'  title="Current Soccer Fixtures for following Divisions:<?php echo divlist();?>">Fixtures List</a></li>
  		<li><a href='<?php echo $domain; ?>/current-soccer-outright-win.php<?php echo $ui; ?>'  title="">Jump The Gun!</a></li>
  			
  		<li><a href='<?php echo $domain; ?>/soccer-league-tables.php<?php echo $ui; ?>' title="League Tables comprising the following Divisions:<?php echo divlist();?>">League Tables</a></li>
  		<li><a href='<?php echo $domain; ?>/soccer-results-matrices.php<?php echo $ui; ?>'  title="Results Matrices comprising the following Divisions: <?php echo divlist();?>">Results Matrices</a></li>
  		<li><a href='#' onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'predPreformance')">Prediction Performance Records</a></li>
  		<!-- <li><a href='#' onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'analysisofpredictions')">Analysis of Previous Predictions</a></li> 
  		<li><a href="<?=$domain?>/fifa-world-cup-2014.php<?php echo $ui; ?><?php echo $ui; ?>"  title="FIFA World Cup 2014">FIFA World Cup 2014</a></li>-->
  		<li><a href='#' onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'bettingadvice')">Betting Advice</a></li>
  	</ol>
  </div>

  <h3><img src='<?php echo $domain; ?>/images/downloadables-02.jpg' border='0' alt='Downloadables'></h3>
  <div>
  	<ol>
  		<li><a href='<?php echo $domain; ?>/soccer-predictions-EASE6-CS.php<?php echo $ui; ?>'>"EASE 6" Spreadsheet</a></li>
  		<li><a href='<?php echo $domain; ?>/soccer-predictions-backup-data.php<?php echo $ui; ?>'>Blank "EASE" Spreadsheet</a></li>
		<li><a href='<?php echo $domain; ?>/soccerpat-record-templates.php<?php echo $ui; ?>'>SoccerPAT Record Templates</a></li>
  		<li><a href='<?php echo $domain; ?>/soccer-bettingadvice-downloadable.php<?php echo $ui; ?>'>Excel Betting Files</a></li>
  	</ol>
  </div>
 
</div>
<a href="javascript:calmsg('<?=$domain?>/soccer-winnings-jackpot-calculator.php<?php echo $ui; ?>')"  title="Jackpot Winnings Calculator"><img src='<?php echo $domain; ?>/images/jackpot_calculator-02.jpg' border='0' alt='Jackpot Calculator'></a>
<div style='margin-bottom:13px;border:0'></div>


	
<div id="weeklyodds" class="anylinkcss">
	<a href="<?=$domain?>/odds-listing.php<?php echo $ui; ?>">1X2 Odds by Division</a>
	<a href="<?=$domain?>/full-odds-listing.php<?php echo $ui; ?>">1X2 Odds All Divisions Combined</a>
	<a href="<?=$domain?>/full-dcodds-listing.php<?php echo $ui; ?>">Double Chance Odds All Divisions Combined</a>
	<a href="<?=$domain?>/full-winonly-listing.php<?php echo $ui; ?>">Win Only Odds (Draw = No Bet) All Divisions Combined</a>
	<a href="<?=$domain?>/full-asian-listing.php<?php echo $ui; ?>">Asian Handicap Odds All Divisions Combined</a>
	<a href="<?=$domain?>/full-underover-listing.php<?php echo $ui; ?>">Under/Over Odds All Divisions Combined</a>
	<a href="<?=$domain?>/calltype-listing.php<?php echo $ui; ?>">By Predict-A-Win Call Type (1X2)</a>
	<a href="<?=$domain?>/bookie-paw-expectations.php<?php echo $ui; ?>">Bookie v PaW Expectations</a>
	<a href="<?=$domain?>/full-overround-listing.php<?php echo $ui; ?>">Specific Call Type Over-Rounds - All Matches Combined</a>
	<a href="<?=$domain?>/soccer-1X2-value-bets.php<?php echo $ui; ?>"  title='Possible Value Calls'>Possible Value Calls</a>
</div>

<div id="curProbs" class="anylinkcss">
	<a href="<?=$domain?>/soccer-win-probability-data.php<?php echo $ui; ?>">Match Probabilities</a>
	<a href="<?=$domain?>/soccer-team-reliability-data.php<?php echo $ui; ?>">Current 1X2 Reliabilities</a>
	<a href="<?=$domain?>/soccer-double-chance-reliability.php<?php echo $ui; ?>"  title="">Double Chance Reliabilities</a>
	<a href="<?=$domain?>/soccer-correct-score-hedge-betting.php<?php echo $ui; ?>"  title="">Hedge Betting Reliance Factors</a>
</div>


<div id="predPreformance" class="anylinkcss">
	
	<a href="<?=$domain?>/soccer-prediction-performance-by-division.php<?php echo $ui; ?>">Predictions by Division</a>
	<a href="<?=$domain?>/soccer-prediction-performance-all-divisions.php<?php echo $ui; ?>">Predictions All Divisions Combined</a>
	<a href="<?=$domain?>/soccer-prediction-performance-double-chance.php<?php echo $ui; ?>">Double Chance All Divisions Combined</a>
	<a href="<?=$domain?>/soccer-prediction-performance-winonly.php<?php echo $ui; ?>">Win Only Odds (Draw = No Bet) All Divisions Combined</a>
	<a href="<?=$domain?>/soccer-prediction-performance-asianhandicap.php<?php echo $ui; ?>">Asian Handicap Odds All Divisions Combined</a>
	<a href="<?=$domain?>/soccer-prediction-performance-underover.php<?php echo $ui; ?>">Under/Over Odds All Divisions Combined (PAW)</a>
	<a href="<?=$domain?>/soccer-prediction-performance-underover-bookie.php<?php echo $ui; ?>">Under/Over Odds All Divisions Combined (Bookie)</a>
	<a href="<?=$domain?>/soccer-predictions-performance-1X2.php<?php echo $ui; ?>">By Predict-A-Win Call Type (1X2)</a>
	<a href="<?=$domain?>/soccer-predictions-performance-bookie-expectations.php<?php echo $ui; ?>">Bookie v PaW Expectations</a>
	<a href="<?=$domain?>/soccer-predictions-performance-value-bets.php<?php echo $ui; ?>">Possible Value Calls</a>
	<a href="<?=$domain?>/soccer-segregated-selections-performance.php<?php echo $ui; ?>">Prime Home Win Calls  (Top 6)</a>	

</div>

<div id="analysisofpredictions" class="anylinkcss">
	<a href="<?=$domain?>/win-only-soccer-predictions.php<?php echo $ui; ?>" title="Analysis of the Betting Outcome for the Wins Only (Draw = No Bet) option for the Segregated Selections Home and Away Calls">Win Only Betting Outcome</a>
	<a href="<?=$domain?>/double-chance-soccer-predictions.php<?php echo $ui; ?>" title="Analysis of the success or otherwise of selecting the Double Chance option for the Segregated Selections 1X2 Calls">Double Chance Hit Rate</a>
	<a href="<?=$domain?>/soccer-double-chance-betting.php<?php echo $ui; ?>" title="Analysis of the Betting Outcome for the Double Chance option for the Segregated Selections 1X2 Calls">Double Chance Betting Outcome</a>
	<a href="<?=$domain?>/soccer-anticipated-score-line-hit-miss-data.php<?php echo $ui; ?>" title="Detailed Hit/Miss Analysis for the Segregated Selections 1X2 (Result Type) Calls">Score-Line Hit/Miss Data</a>
</div>

<div id="bettingadvice" class="anylinkcss">
	<a href="<?=$domain?>/soccer-bettingadvice-for-novices.php<?php echo $ui; ?>">for Novices</a>
	<a href="<?=$domain?>/soccer-bettingadvice-for-advanced-bettors.php<?php echo $ui; ?>">for Advanced Bettors</a>
	<a href="<?=$domain?>/soccer-bettingadvice-for-academics.php<?php echo $ui; ?>">for Academics</a>
</div>


<div style="padding-top:0px;text-align:center;">

<img name="facebox" src="<?=$domain?>/facebox.gif"  border="0" id="facebox" usemap="#m_facebox" alt="Social Media">

<map name="m_facebox" id="m_facebox">
<area shape="rect" coords="123,84,153,114" href="https://twitter.com/SoccPredictions" title="Follow us on Twitter" alt="Follow us on Twitter">
<area shape="rect" coords="54,84,84,114" href="http://www.facebook.com/pages/Soccer-Predictions/384175711609209?fref=ts" title="Facebook" alt="Facebook">
</map>                
 
</div>    

		
<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Home_RHC -->
<ins class="adsbygoogle"
     style="display:inline-block;width:200px;height:200px"
     data-ad-client="ca-pub-5098673027102346"
     data-ad-slot="2038934716"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
