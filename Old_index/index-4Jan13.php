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

    PaW Sales Page 12Aug11 rev 06
    
    Last updates: 23-Feb-2011
    
    Europe Page 1 rev 1 09Aug12
    page 3
*/


page_header("<font color='#26529B'>MAKING GOOD SOCCER PREDICTIONS!</font>");





$wtype ="WEEKEND SHORT ODDS » HOME WIN CALLS"; $WEEKNO=41;
$sql_string = "weekno='$WEEKNO' and season='2011-2012' and matchtype='HW' and bettype='E'";


echo "<div style='padding-bottom:2px;'></div>";



?>
<link rel="stylesheet" href="tips/jquery.cluetip.css" type="text/css" />
<script src="tips/jquery.cluetip.js"></script>
<script src="tips/demo/demo.js"></script>

<!-- alternative 2: 20-Apr-2012 -->

<div class="salespage" style="margin-top:2px;">
	

 
 

<p style="padding-top: 0;">

<a class="custom-width mblue" rel="ajax3.html" href="team-performance-chart.php?id=3514&amp;site=eu" target="_blank" onMouseover="ddrivetip('Performance Indicator Chart - click to see full chart.', 150)"  onMouseout="hideddrivetip()"><img src="images/pics/eu/3514.gif" border="0" align="left" vspace="0" hspace="15" style="margin-left:-2px;" alt=""></a>



<strong><font style="font-size:16px;">What does it take to beat the Bookies at 1X2 soccer betting?</font></strong> </p>


<p style="padding-top: 12px;"><span class="redi" style="color: red;">Well, without first-class soccer prediction data at your fingertips you won't stand a chance!</span></p>  


<p style='margin-top:12px;padding-top:0'>You see, for any "outright win" soccer predictions to be worthwhile, they have to be based on a solid foundation of facts that can provide valid answers to the following questions:   </p>


<ul>
    <li style='padding-left:10px;margin-left:260px;'><em>Were the current and past predictions compiled in a consistent and systematic manner?</em></li>
    
    <li style='padding-left:10px;margin-left:260px;'><em>Can it be seen very clearly that the supposedly stronger teams are consistently reliable for betting purposes?</em></li>
    
</ul>


<p style='margin-top:14px;padding-top:0'>If the answer is "<strong>NO</strong>" to either of the above questions, then those soccer predictions will almost certainly lose you money!</p>

<p style='margin-top:13px;padding-top:0'>Quality soccer prediction data doesn't have to cost an arm and a leg. <span class="red"> We give it to you for less than £1 per week!</span> </p>


<p style='margin-top:14px;padding-top:0'>Trying to tell you about all the data we give you would take up too much space.  So, instead, let me direct you to the image above on the left-hand side, where all you need to do is click on it to see just one of the novel reports we produce.  And there are many more, covering all the matches in <span class="bb"><strong>12 UK Divisions, 8 European Divisions and 3 Americas Divisions!</strong></span></p>


<p style='margin-top:14px;padding-top:0'>Even if you only use our data to check out those supposedly “sure-fire” tips you paid others an arm-and-leg for, <span class="bb">you could save yourself a further fortune</span> by avoiding betting on potential losers.</p>

<p style='margin-top:14px;padding-top:0'><strong>That alone is a great reason for joining us today!</strong> </p>


<div class="reg_botton">
  <a title='Get Soccer Predictions Data Now!' href="register-aweber.php">
    <img src='images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
</div>




<div style="text-align: center;border:0px solid black; height:20px; width:125px; margin:auto auto;">

  <ul id="pagination-flickr">
        <li class="active">1</li>
        <li><a href='index_2.php'>2</a></li>
        <li><a href='index_3.php'>3</a></li>
        <li><a href='index_4.php'>4</a></li>
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