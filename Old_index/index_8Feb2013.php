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
    page 5
    25-jan-2013
*/


page_header("<font color='#26529B'>ROCK SOLID SOCCER PREDICTIONS!</font>");





$wtype ="WEEKEND SHORT ODDS » HOME WIN CALLS"; $WEEKNO=41;
$sql_string = "weekno='$WEEKNO' and season='2011-2012' and matchtype='HW' and bettype='E'";



  include("hypes/2012-2013/week27.html"); 
echo "<div style='padding-top:11px;'></div>";



?>
<link rel="stylesheet" href="tips/jquery.cluetip.css" type="text/css" />
<script src="tips/jquery.cluetip.js"></script>
<script src="tips/demo/demo.js"></script>

<!-- alternative 2: 20-Apr-2012 -->



<div class="salespage" style="margin-top:2px;">
	


 

<p style="padding-top: 0;">

<a class="custom-width mblue" rel="ajax3.html" href="team-performance-chart.php?id=4768&amp;site=eu" target="_blank" onMouseover="ddrivetip('Performance Indicator Chart - click to see full chart.', 150)"  onMouseout="hideddrivetip()"><img src="images/pics/eu/4768.gif" border="0" align="left" vspace="0" hspace="15" style="margin-left:-2px;" alt=""/></a>

Too many websites are willing to take your money by offering <span class="red">false promises</span> about the fortunes to be made by using their soccer predictions.  They don’t care if you don’t use them again once your subscription has run out, because it seems there are plenty of other people willing to put their trust in such <span class="red">con-artists</span>, week-after week.
</p>


<p style="padding-top: 12px;">The Over-Round applied by the Bookies makes sure that most weeks they will be the winners, not you.  And there is no way someone can consistently supply you with 65% winners at Odds of 1.55, which is the level of success you will need just to break even each week.</p>  


<p style='margin-top:12px;padding-top:0;'>We can see why some people may be tempted to have faith in those websites that promote themselves aggressively and <span class="red">hype their soccer prediction ability</span>.  But before you lay out the hundreds of pounds you will need for betting in order to make yourself a reasonable amount of money plus cover the high charges of those websites, why don’t you invest the <span class="red" style="color:purple;">less than £1 per week</span> needed to get quality soccer predictions backup data from us? </p>

<p style='margin-top:14px;padding-top:0'>To see just one example of the data you get for all the matches for <span class="bb">23 Divisions across Europe and the Americas</span>, just click on the image above, on the left-hand side.  You might also like our new interactive "<a class='sales' href="javascript:bigwin('soccer-selections-analysis-tool.php?db=eu&season=2012-2013&weekno=<?php echo cur_week('eu')-1;?>&DIV=0&CALL=1&SORTBY=10&ordered=1&PERIOD=1&min_odd=&max_odd=&B1=View+Data')"><ins>Soccer Selections Analysis Tool</ins></a>". </p>


<p style='margin-top:13px;padding-top:0'>With our data you will easily be able to decide for yourself exactly how much (or how little) confidence you have in the expensive picks you are being fed.  That way,<strong> you can avoid making even more expensive betting mistakes!</strong></p>

<p style='margin-top:13px;padding-top:0'>For <span class="bb">less than £1 a week</span>, can you afford <strong>NOT</strong> to have access to our soccer predictions data?   </p>



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