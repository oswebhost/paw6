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

    Page 1 Alternatives rev 08 (08feb13)
    page 7
    8-feb-2013
*/


page_header("<font color='#26529B'>SEE HOW THE BOOKIE’S ODDS STACK UP!</font>");





$wtype ="WEEKEND SHORT ODDS » HOME WIN CALLS"; $WEEKNO=41;
$sql_string = "weekno='$WEEKNO' and season='2011-2012' and matchtype='HW' and bettype='E'";



  include("hypes/2012-2013/week30.html"); 
echo "<div style='padding-top:11px;'></div>";



?>
<link rel="stylesheet" href="tips/jquery.cluetip.css" type="text/css" />
<script src="tips/jquery.cluetip.js"></script>
<script src="tips/demo/demo.js"></script>



<div class="salespage" style="margin-top:2px;">
	


 

<p style="padding-top: 0;">

<a class="custom-width mblue" rel="ajax3.html" href="team-performance-chart.php?id=5410&amp;site=eu" target="_blank" onMouseover="ddrivetip('Performance Indicator Chart - click to see full chart.', 150)"  onMouseout="hideddrivetip()"><img src="images/pics/eu/5410.gif" border="0" align="left" vspace="0" hspace="15" style="margin-left:-2px;" alt=""/></a>


</p>


<p style="padding-top: 12px;">Sure, you can find out for yourself what the Bookie’s Odds are for every match out there this week – <span class="redin">it will just take you ages to do it, that’s all</span>.  But what you can’t do is work out whether or not the Bookie’s Odds are offering good value for money.  Well, you don’t have to do that for yourself, because <span class="bb">for less than £1 a week</span> we show you not just the match Over-Rounds for every single match but also the Over-Rounds for the individual Call Types too (Home Win, Away Win or Draw).</p>  

<p style="padding-top: 12px;">Plus we list out <span class="bb">all the matches with their Odds</span> and show you what our specialised computer Program thinks the results will be, and why!  You can compare all our past predictions and see where our Program gets it right and where the Bookies get it wrong!</p>

<p style="padding-top: 12px;">You have never before seen the depth and quality of the soccer betting data that we provide you with.  So take a look now at all our reports to prove to yourself that you can’t afford <strong>not</strong> to subscribe – especially when it’s <span class="bb">for less than £1 a week!</span></p>

<p style="padding-top: 12px;">Added to that, <span class="bb">the first 2 months come at half price</span>, and there is no obligation to continue thereafter if you decide that our service just isn’t for you – although we are confident that you will be more than happy with what we deliver.</p>

<p style="padding-top: 12px;">And those reports we mentioned?  Well, for starters please take a look at our new interactive "<a class='sales' href="javascript:bigwin('soccer-selections-analysis-tool.php?db=eu&season=2012-2013&weekno=<?php echo cur_week('eu')-1;?>&DIV=0&CALL=1&SORTBY=10&ordered=1&PERIOD=1&min_odd=&max_odd=&B1=View+Data')"><ins>Soccer Selections Analysis Tool</ins></a>", as well as all the <a class='sales' href="bookies-odds-soccer-betting.php?db=eu"><ins>Weekly Odds v Predictions</ins></a>  data under the "DATA for MEMBERS" (accessible too for visitors). </p>

<p style="padding-top: 12px;">To produce the same amount of valuable data by yourself for just one Division would take you far more hours a week than you could ever spare.  So, <strong>when we charge so little</strong>, <span class="red">is it really worth you putting all that effort in, just to end up with an inferior product?</span>  <span class="bb">Of course not!</span>   </p>


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

<br />



<? 
include("hypes/2012-2013/week24.html") ;

 include("footer.ini.php"); ?>