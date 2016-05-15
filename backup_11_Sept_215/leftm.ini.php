<!--
<div style='text-align:center;border:1px solid green;background:#ECFAD4;padding:8px;font-size:12px;font-family: tahoma;line-height:130%;margin-right:4px;margin-top:0px;'>
Under "<strong>DATA for MEMBERS</strong>", non-paying visitors can use all our fabulous research tools for all past weeks (available in the "<strong>Weekly Odds v Predictions</strong>" section).  But only Subscribers can view the current week's soccer predictions too.  

</div>
-->


			
<!-- Main menu Start -->

<script language="JavaScript" type="text/javascript">

function showMsg()
{
  alert ("Under Construction - Coming Soon!");
  return;
}
</script>



<!--
 <div style='padding:6px 0 3px 0;margin:auto auto;width:200px;'><a href="http://soccer-predictions.com/competition.php"><img src='<?=$domain?>/images/comp-icon-eu2.gif' border='0'/></a></div>
-->



<div style="padding-top:0px;text-align:center;">

<img name="facebox" src="<?=$domain?>/facebox.gif"  border="0" id="facebox" usemap="#m_facebox" alt="Social Media">

<map name="m_facebox" id="m_facebox">
<area shape="rect" coords="123,84,153,114" href="https://twitter.com/SoccPredictions" title="Follow us on Twitter" alt="Follow us on Twitter">
<area shape="rect" coords="54,84,84,114" href="http://www.facebook.com/pages/Soccer-Predictions/384175711609209?fref=ts" title="Facebook" alt="Facebook">
</map>                
 
</div>    


<div id="google_translate_element" style='border:1px solid #32701D;background:#fff;padding:5px;margin-top:8px;'></div>
<script language="JavaScript" type="text/javascript">

function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en'
  }, 'google_translate_element');
}
</script>

<script language="JavaScript" type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>

<div style='margin-bottom:10px;border:0'></div>



<a class='none' href="javascript:bigwin('<?php echo $domain;?>/soccer-predictions-analysis-tool.php?<?php echo $toolurl;?>')"><img src="<?php echo $domain;?>/images/newtool7.gif" border="0" alt="Soccer Selections Analysis Tool"></a>


<div style='margin-bottom:5px;border:0'></div>


<?php if (!isset($_SESSION["userid"])){ ?>
<div class="reg_botton" style='border:1px solid #fff;width:188px;margin:4px 0 4px 0;'>
  <a title='Get Soccer Predictions Data Now!' href="<?=$domain?>/register.php">
    <img src='<?=$domain?>/images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
</div>


<?}?>

<div style="font-size:10px;border:1px solid #32701D;background:#ccc;height:235px;padding:2px;margin-right:2px;margin-top:8px;">
    <?php include ("mynews.php"); ?>
</div>








<div id="betadv" class="anylinkcss">
  <a href="<?=$domain?>/soccer-bettingadvice-for-novices.php">for Novices</a>
  <a href="<?=$domain?>/soccer-bettingadvice-for-advanced-bettors.php">for Advanced Bettors</a>
  <a href="<?=$domain?>/soccer-bettingadvice-for-academics.php">for Academics</a>
  <a href="<?=$domain?>/soccer-bettingadvice-downloadable.php">Downloadable Excel Files</a>
  
</div>     



<div id="bookieslevel" class="anylinkcss">
  <a href="<?=$domain?>/bookie-soccer-success-rate.php">Bookie Top 6 Success Rate</a>
  <a href="<?=$domain?>/soccer-prediction-comparisons.php">Bookie v PaW Overall Success Compared</a>
</div>     

     

<div id="predperformance" class="anylinkcss">
  <a href="<?=$domain?>/soccer-predictions-performance-1X2.php">By Predict-A-Win Call Type (1X2)</a>
  <a href="<?=$domain?>/soccer-prediction-performance-by-division.php">Predictions by Division</a>
  <a href="<?=$domain?>/soccer-prediction-performance-all-divisions.php">Predictions All Divisions Combined</a>
  
   <? if ($_SESSION['userid']=='wally' or $_SESSION['userid']=='imran'){ ?>
    <a href="<?=$domain?>/soccer-segregated-selections-performance.php">Segregated Selections (Top 6 HOME CALLS)</a>
  <?}?>
  
</div> 



     
<div style='margin-bottom:10px;border:0'></div>


<div class="MainMenu" style="width:200px;padding-left:0px;">

   <h2 style="text-align:center;height:35px;background:url(<?=$domain?>/images/v4/advdata2.jpg) no-repeat;margin:0;padding:0;"><span style='display:none'>Detailed Data</span></h2>


<div style='border:1px solid #DE231E;padding:0;margin:0'>
	<ul>
        <li><h2><a style="padding-left:6px;color:blue;" href="<?=$domain?>/soccer-predictions-by-division.php"  title="Predictions comprising the following Divisions:<?php echo divlist();?>" >1X2 Predictions by Division</a></h2></li>
		<li><h2><a style="padding-left:6px;" href="<?=$domain?>/bookies-odds-soccer-betting.php"  title="Weekly Odds, Soccer 1X2 Odds, Double Chance Odds, Win Only Odds (Draw = No Bet), Asian Handicap Odds, Soccer Under/Over Odds, By Predict-A-Win Call Type (1X2), Bookie v PaW Expectations">Current Week's Odds</a></h2></li>
        
        
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/#"  title="" onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'dataanalysis')">Current Probabilities/Reliabilities</a></h2></li>
        
       
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/fifa-world-cup-2014.php"  title="">FIFA World Cup 2014</a></h2></li>
        
      
       <? if ($_SESSION['userid']=='wally' or $_SESSION['userid']=='imran'){ ?>
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/soccer-home-win-predictions.php"  title="">Segregated Selections (Top 6)</a></h2></li>
        
        
       <?}?>
       
        
        
		
	

      
    </ul>    

  </div>	
  
</div>

<div style='margin-bottom:10px;border:0'></div>

<div class="MainMenu" style="width:200px;padding-left:0px;">

<h2 style="text-align:center;margin:0;height:35px;background: #fff url('<?=$domain?>/images/v4/freedata3.jpg') no-repeat;">&nbsp;<span style='display:none'>Soccer data</span></h2>

    <div style='border:1px solid #006C00;padding:0;margin:0'>
    	<ul>
    	<li><h2><a style="padding-left:6px;" href="<?=$domain?>/current-soccer-fixtures.php"  title="Current Soccer Fixtures for following Divisions:<?php echo divlist();?>">Current Fixtures List</a></h2></li>
        	
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/soccer-league-tables.php" title="League Tables comprising the following Divisions:<?php echo divlist();?>">Soccer League Tables</a></h2></li>
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/soccer-results-matrices.php"  title="Results Matrices comprising the following Divisions: <?php echo divlist();?>">Soccer Results Matrices</a></h2></li>
        
       
        
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/"  title="Prediction Performance Records" onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'predperformance')">Prediction Performance Records</a></h2></li>        
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/"  title="Analysis of Previous Predictions" onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'analysispp')"> Analysis of Previous Predictions</a></h2></li>
        
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/soccer-predictions-backup-data.php"  title="">Blank "EASE" Spreadsheet</a></h2></li>
        <li><h2><a style="padding-left:6px;" href="<?=$domain?>/soccer-1X2-value-bets.php"  title='"Possible Value Calls'>Possible Value Calls <div style="margin-right:5px;float:right;width:28x;height:14px;border:0;color:blue;font-size:10px;">NEW!</div></a></h2></li>
        <li style='border:0;margin-bottom:0'><h2><a style="padding-left:6px;" href="javascript:calmsg('<?=$domain?>/soccer-winnings-jackpot-calculator.php')"  title="Jackpot Winnings Calculator">Jackpot Winnings Calculator</a></h2></li>


        <li style='border:0;margin-bottom:0'><h2><a style="padding-left:6px;" href="<?=$domain?>/"  title="Soccer Betting Advice" onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'betadv')">Soccer Betting Advice</a></h2></li>

        <li style='border:0;margin-bottom:0'><h2><a style="padding-left:6px;" href="javascript:Matrix('<?=$domain?>/short_odds_summary.php')"  title="Short Odds Betting Outcome">Short Odds Betting Outcomes</a></h2></li>
        
        <li style='border:0;margin-bottom:0'><h2><a style="padding-left:6px;color:blue;" href="<?=$domain?>/bookielinks.php"  title="Bookie Links">Bookie Links</a></h2></li>
        
         <? if ($_SESSION['userid']=='wally' or $_SESSION['userid']=='imran'){ ?>
            <li><h2><a style="padding-left:6px;" href="<?=$domain?>/"  title="Bookie v PaW Successes" onClick="return clickreturnvalue()" onMouseover="dropSide(this, event, 'bookieslevel')">Bookie v PaW Successes</a></h2></li>
        <?}?>
        
     </ul>
    </div>	
  
 </div>
 
<div id="dataanalysis" class="anylinkcss" style="border:1px solid #DE231E;">
  <a href="<?=$domain?>/soccer-win-probability-data.php">Match Probabilities Data</a>
  <a href="<?=$domain?>/soccer-team-reliability-data.php">Current 1X2 Reliabilities</a>
  <a href="<?=$domain?>/soccer-double-chance-reliability.php"  title="">Double Chance Reliabilities</a>
  <a href="<?=$domain?>/soccer-correct-score-hedge-betting.php"  title="">Hedge Betting Reliance Factors</a>
</div>

<div id="analysispp" class="anylinkcss">
 <a href="<?=$domain?>/win-only-soccer-predictions.php" title="Analysis of the Betting Outcome for the Wins Only (Draw = No Bet) option for the Segregated Selections Home and Away Calls">Win Only Betting Outcome</a>
 <a href="<?=$domain?>/double-chance-soccer-predictions.php" title="Analysis of the success or otherwise of selecting the Double Chance option for the Segregated Selections 1X2 Calls">Double Chance Hit Rate</a>
 <a href="<?=$domain?>/soccer-double-chance-betting.php" title="Analysis of the Betting Outcome for the Double Chance option for the Segregated Selections 1X2 Calls">Double Chance Betting Outcome</a>
 <a href="<?=$domain?>/soccer-anticipated-score-line-hit-miss-data.php" title="Detailed Hit/Miss Analysis for the Segregated Selections 1X2 (Result Type) Calls">Score-Line Hit/Miss Data</a>
</div>

<div style='margin-bottom:10px;border:0'></div>


<?php if ($show_key2<>1){?> 

<div style="text-align: center;padding-top: 10px;">
<object type="application/x-shockwave-flash"
id="a6c48f23a32b643559ed36a2470902c7e"
data="http://imstore.bet365affiliates.com/?AffiliateCode=365_154673&amp;CID=354&amp;DID=145&amp;TID=2&amp;PID=149&amp;LNG=1&amp;ClickTag=http%3a%2f%2fimstore.bet365affiliates.com%2fTracker.aspx%3fAffiliateId%3d54790%26AffiliateCode%3d365_154673%26CID%3d354%26DID%3d145%26TID%3d2%26PID%3d149%26LNG%3d1&amp;Popup=true"
width="180"
height="150">
<param name="movie" value="http://imstore.bet365affiliates.com/?AffiliateCode=365_154673&amp;CID=354&amp;DID=145&amp;TID=2&amp;PID=149&amp;LNG=1&amp;ClickTag=http%3a%2f%2fimstore.bet365affiliates.com%2fTracker.aspx%3fAffiliateId%3d54790%26AffiliateCode%3d365_154673%26CID%3d354%26DID%3d145%26TID%3d2%26PID%3d149%26LNG%3d1&amp;Popup=true" />
<param name="quality" value="high" />
<param name="wmode" value="transparent" />
<param name="allowScriptAccess" value="always" />
<param name="allowNetworking" value="external" />
<a href="http://imstore.bet365affiliates.com/Tracker.aspx?AffiliateId=54790&amp;AffiliateCode=365_154673&amp;CID=194&amp;DID=145&amp;TID=1&amp;PID=149&amp;LNG=1" target="_blank">
<img src="http://imstore.bet365affiliates.com/?AffiliateCode=365_154673&amp;CID=194&amp;DID=145&amp;TID=1&amp;PID=149&amp;LNG=1" style="border:0;" alt="bet365"></img></a>
</object>
</div>
<?}?>
<div style='margin-bottom:13px;border:0'></div>


<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Home_RHC -->
<ins class="adsbygoogle"
     style="display:inline-block;width:200px;height:200px"
     data-ad-client="ca-pub-5098673027102346"
     data-ad-slot="2038934716"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
