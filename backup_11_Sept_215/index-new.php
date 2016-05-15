<?
$show_key =1 ;
    session_start(); 
    
    if ($_GET['ref']=='YM'){
        $_SESSION['ref'] = $_GET['ref'];
    }
    
    
    
    
    include("config.ini.php");
    include("function.ini.php");
    include("reguser.php");
    
    $show_key= meta_index() . meta_football() . meta_freepred() ;
    $show_key2 = 1;
    $page_title = "Free Soccer Predictions Data";
    
    include("header.ini.php");


/*  
    Updated: 27-mar-2013
    
    Page 1 Alternatives rev 09 (27Feb13)
    page 7
    27-feb-2013
*/


$tmp = $sa->prepare('select week_begin from setting');
$tmp->execute();
$ddd = $tmp->fetch();
$week_perid = $ddd['week_begin'];

page_header("<font color='#26529B'>FREE SOCCER PREDICTIONS!</font>");






$wtype ="WEEKEND SHORT ODDS � HOME WIN CALLS"; $WEEKNO=41;
$sql_string = "weekno='$WEEKNO' and season='2011-2012' and matchtype='HW' and bettype='E'";

include("hypes/2013-2014/fifa2014.html");




// pic details //

$pic_id = 314;
$pic_db = "sa";
$pictitle  ="04-Jun-2014<br/>CA Bragantino v Fortaleza 1-2";
$pic_alt = "04-Jun-2014 - CA Bragantino v Fortaleza 1-2";
$pic_url = "team-performance-chart.php?id=$pic_id&amp;site=$pic_db";



?>

<div style='float:left;width:200px;text-align:left;padding-left:5px;'>
  <div class="fb-like" data-href="http://www.facebook.com/pages/Soccer-Predictions/384175711609209?fref=ts" data-layout="button_count" data-action="like" data-show-faces="true" data-share="true"></div>
</div>

<div style='float:right;width:200px;text-align:right;'>
  <span class='st_sharethis' displayText='ShareThis'></span>
</div>
<div class='clear'></div>

<div class="salespage" style="margin-top:2px;">
	


<!--
<div style="text-align:center">
<img src="images/wk19v21.gif" border="0" />
</div>
-->

<?php include("freeprediction-index.php"); ?>
 

	



<div class="clear"></div>





<a name="video"></a>
<div class="clear"></div>




<table border="0">
<tr>
    <td valign="top">
    <a  class="custom-width mblue" rel="ajax3.html" title="<?= $pictitle?>" href="<?php echo $pic_url;?>" target="_blank" onMouseover="ddrivetip('Performance Indicator Chart - click to see full chart.', 150)"  onMouseout="hideddrivetip()"><img src="images/pics/<?php echo $pic_db;?>/<?php echo $pic_id;?>.gif" border="0" align="left" vspace="0" hspace="15" style="margin-left:-2px;" alt="<?= $pic_alt;?>"></a>
    </td>
    
    <td style='width:50px'>&nbsp;&nbsp;</td>
    <td valign="top">
   
    
        <div style='text-align:center;width:310px; margin:4px auto 0 auto;border:0px solid #23488C;'>
        <? // include("hypes/2012-2013/week24.html"); ?>
        
        <a class='none' href="javascript:bigwin('soccer-predictions-analysis-tool.php?<?php echo $toolurl;?>')"><img src="images/soccerpatbox4.gif" border="0" alt="Interactive Analysis Tool -- Soccer Predictions Analysis Tool There you will be able to play with the data and check out many what if scenarios based on the Odds range you select and our computer Program�s Probabilities and Reliabilities, etc. If you ever wanted proof of how everything is slanted in the Bookies favour, this fabulous tool provides it! "></a>
    </div>
    <div style="padding-left: 5px;padding-top:6px;">
      <iframe width="300" height="160" src="//www.youtube.com/embed/Y42pJ0Z0hFw" frameborder="0" allowfullscreen></iframe>
    </div>
    
    
      <div style='text-align:center;width:310px; margin:10px auto 0 auto;'>
           <img src="images/8box.gif" border="0" alt="Every New Registered Member will be given access to our specially prepared document \�8 GOLDEN RULES for SUCCESSFUL SOCCER BETTING\�, which will be available for downloading immediately after completing registration.">  
    </div>
   

    
    </td>
    </tr>
    
  
</tr>
</table>

 <?php if (!isset($_SESSION["userid"])){ ?>
			<div class="reg_botton" style="margin-top: 10px;">
              <a title='Get Soccer Predictions Data Now!' href="register-aweber.php">
                <img src='images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
            </div>
            
            <?}?>

<div class="clear"></div>

<?  
include("hypes/2013-2014/week40.html"); 
?>



</div>

<p style='margin-top:1px;padding-top:0'>&nbsp;&nbsp;</p>






<? 


 include("footer2.ini.php"); 
 
 	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>