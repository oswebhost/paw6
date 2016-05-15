<?
$show_key =1 ;
    session_start(); 
    
    if ($_GET['ref']=='YM'){
        $_SESSION['ref'] = $_GET['ref'];
    }
    
    
    
    
    include("config.ini.php");
    include("function.ini.php");
    include("reguser.php");
    
    //$show_key=1;
    $page_title = "Quality Soccer Predictions Data";
    
    include("header.ini.php");


/*  

    Page 1 Alternatives rev 07 (04Jan13)
    page 4
    4-jan-2013
*/


page_header("<font color='#26529B'>QUALITY SOCCER PREDICTIONS DATA!</font>");





$wtype ="WEEKEND SHORT ODDS » HOME WIN CALLS"; $WEEKNO=41;
$sql_string = "weekno='$WEEKNO' and season='2011-2012' and matchtype='HW' and bettype='E'";



include("hypes/2012-2013/week24.html") ;

echo "<div style='padding-top:11px;'></div>";



?>
<link rel="stylesheet" href="tips/jquery.cluetip.css" type="text/css" />
<script src="tips/jquery.cluetip.js"></script>
<script src="tips/demo/demo.js"></script>

<!-- alternative 2: 20-Apr-2012 -->

<div class="salespage" style="margin-top:2px;">
	

 
 

<p style="padding-top: 0;">

<a class="custom-width mblue" rel="ajax3.html" href="team-performance-chart.php?id=4137&amp;site=eu" target="_blank" onMouseover="ddrivetip('Performance Indicator Chart - click to see full chart.', 150)"  onMouseout="hideddrivetip()"><img src="images/pics/eu/4137.gif" border="0" align="left" vspace="0" hspace="15" style="margin-left:-2px;" alt=""></a>

We provide <span class='bb'>first-class soccer predictions data</span> generated from running a superb piece of software that we have steadily 
improved over the course of the past 12 years.  That data tells you what the outcome ought to be in terms of the <span class='bb'>expected 
result</span> and also the <span class='bb'>anticipated score-line for each match</span>.  

</p>


<p style="padding-top: 12px;">Our soccer predictions data is like nothing you have seen from any other source.  
    It is laid out in straightforward fashion, and is <span class='bb'>highly informative and easy to understand</span>.  
    If you click on the image to the left of this paragraph you will see an example of our Team Performance data 
    for a match where we predicted the actual score-line correctly. <span class='bb'>And that is only one of the many different 
    reports we provide!</span></p>  


<p style='margin-top:12px;padding-top:0;color:red;'><b>The price we charge for all our data is less than £1 per week!</b></p>

<p style='margin-top:14px;padding-top:0'>Since <span class='bb'>our data quality is second-to-none</span> (we have a better success rate 
    than the Bookies for picking <a class='sales' href='soccer-prediction-comparisons.php?submitted=1&db=eu&season=2012-2013&callfor=1&PERIOD=1'><u>Home Wins</u></a>), you may be wondering why we charge so little.  Well, we know how 
    difficult it is to make money from the Bookies, even though our success rate is greater.  And that is all 
    due to the mark-up (Over-Round) the Bookies build into their Odds.</p>

<p style='margin-top:13px;padding-top:0'>Running at 10% on outright win calls, and up to 40% for correct score calls, 
    the Over-Rounds ensure that the fat cats involved in soccer betting will always be the Bookies.  
    And that is why it is <span class='bb'>so essential for you to have access to first-class soccer predictions data</span> such as we produce.  
    Without it, the Bookies will have an even greater edge over you! </p>

<p style='margin-top:13px;padding-top:0'><span class='bb'>So don't delay, join us today!</span></p>


<div class="reg_botton">
  <a title='Get Soccer Predictions Data Now!' href="register-aweber.php">
    <img src='images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
</div>




<div style="text-align: center;border:0px solid black; height:20px; width:125px; margin:auto auto;">

    <ul id="pagination-flickr">
        <li class="active">1</li>
        <li><a href='quality-soccer-prediction-tools.php'>2</a></li>
        <li><a href='soccer-correct-scores-betting.php'>3</a></li>
        <li><a href='soccer-betting-odds-over-rounds.php'>4</a></li>
    </ul>

</div>

<div class="clear"></div>



<p style='margin-top:12px;padding-top:0'>&nbsp;</p>

<div style='text-align:center;width:490px; margin:auto auto;border:1px solid #23488C;background:#E9EFFF;padding:5px;font-size:13px;line-height:140%'>

        Every New Member (whether a Registered or Susbcribing Member) will be given access to our updated version of "<b>8 GOLDEN RULES for
        SUCCESSFUL SOCCER BETTING</b>", which will be available for downloading immediately after joining.  
</div>

</div>





<? include("footer.ini.php"); ?>