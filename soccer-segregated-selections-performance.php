<?php

session_start();


require_once("config.ini.php");
require_once("function.ini.php");

if (!isset($db)){
  $db = 'eu';
}else{
  $db= $_GET['db'];
}



if (!isset($_REQUEST['cur'])):
	$cur = curseason($db);
else:
	$cur = $_REQUEST['cur'] ;
endif;

if (isset($_GET['db'])){
  $page_title = "Prime Home Win Calls (Top 6) Performance " . s_title($db) . " Season $cur ";
}else{
  $page_title = "Prime Home Win Calls (Top 6) Performance";
}

$bluebox_message = 100;

require_once("header.ini.php");

?>
<style>
	#t1 {border-left:2px solid #555555; text-align:center;}
</style>

<?php page_header("Prediction Performance Records") ; 

if (isset($_GET['db'])){ 

?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?php echo  site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?php echo  site_other($db);?></div>
<div class='clear'></div>
<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Prime Home Win Calls (Top 6) </div>


<table border="0" width="100%" cellpadding="0" cellspacing="0">
 <tr>
    <td width="25%"><a class='sbar' href="soccer-segregated-selections-performance.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a></td>

   <td width="25%" height="20" align='center' colspan='3' valign="bottom">
		<form method='get' style='padding:0;margin:0;'>	
		
	 </td>
	<td width="25%" align="right"> </td>
	</tr>
 </table>
 
<div style="padding-bottom:5px"></div>


<form method="get" action="<?php echo  $PHP_SELEF;?>" style="padding:0;margin:0;">
<input type="hidden" name="db" value="<?php echo  $_GET['db'];?>" />   

 <table border="0" width="20%" cellpadding="3" style="border-collapse: collapse" bordercolor="#f4f4f"  >
 
 <tr>
			  
  <td  height="22" width="20%"  >
	<span class='credit'><font  color="#0000ff">Season:</font></span></td>

  <td  height="22"  >
	   <select size="1" name="cur" style="font-size:12px;width:120px;font-weight:bold;"  onChange="this.form.submit();">
	  
	 <?php 
	 
	
	
	  $sql = "SELECT distinct(season) as season from quickpick order by season desc limit 3";
	  if ($db=='eu'){
        $temp = $eu->prepare($sql) ;
        }else{
            $temp = $sa->prepare($sql);
        }
        $temp->execute();
        
	    while ($sr = $temp->fetch()) : 
	    ?>
		  <option value="<?php echo  $sr["season"] ?>" <?php echo  selected($cur,$sr["season"])?>><?php echo  $sr["season"] ?></option>
	     <?php endwhile; ?>
        </select>
  </td>
</tr >
</table>
</form>

<br />

<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="98%">

<tr bgcolor="#D3EBAB">
	<td  rowspan="2" align="center"><img src="images/tbcap/predtype2.gif"  border="0" alt=""/></td>
	<td align="center"  bgcolor="#d3ebab"  colspan="3"><img src="images/tbcap/noofbets.gif" border="0" alt=""/></td>
	<td align="center"  bgcolor="#d3ebab"  colspan="2"><img src="images/tbcap/noofunit.gif" border="0" alt=""/></td>
</tr>
<tr bgcolor="#d3ebab">
	<td align="center"><img src="images/tbcap/laid.gif"  border="0" alt=""/></td>
	<td align="center"><img src="images/tbcap/won.gif"  border="0" alt=""/></td>
	<td align="center"><img src="images/tbcap/perbig.gif"  border="0" alt=""/></td>
	<td align="center"><img src="images/tbcap/lost.gif"  border="0" alt=""/></td>
	<td align="center"><img src="images/tbcap/won.gif"  border="0" alt=""/></td>
</tr>

<?php
$bet  = array("F","E","V","L") ;

$number=0;

for ($i=0; $i<count($bet); $i++)
{ 
  if ($i==0){ $class= array("HW") ; }else{$class= array("HW") ; }
   
  for ($j=0; $j<count($class); $j++)
    {
       $number++;
       $rowcol = rowcol($number);   
       $segdata = All_SegCalls($bet[$i], $class[$j], $cur,$db);
       
?>
     <tr <?php echo  $rowcol ?> height='22'>
        <td class='ltd tdper' style="padding:10px 0 10px 5px;" ><a href='prediction-performance-segregated.php?PARA=<?php echo  "$cur,$bet[$i],$class[$j],$db" ?>' class='sbar2'><?php echo   prt_bet($bet[$i]) . " - " . prt_bet($class[$j]) ?></a></td>
        <td class='ctd tdper'><?php echo  prt_0($segdata->laid); ?></td>  
        <td class='ctd tdper'><?php echo  prt_0($segdata->win);  ?></td>
        <td class='ctd tdper'><?php echo  prt($segdata->win / ($segdata->laid >0? $segdata->laid : 1 ) * 100 );  ?></td>
        <td class='ctd tdper red0'><?php echo  prt($segdata->net_lost);?></td>
        <td class='ctd tdper' ><?php echo  prt($segdata->net_win); ?></td>  
     </tr>
         
<?php    
   }
}

$number++;
 $rowcol = rowcol($number);   
 $segdata = All_SegCalls("E", "AD", $cur,$db);

?>
<!--
  <tr <?php echo  $rowcol ?> height='22'>
        <td class='ltd tdper'><a href='prediction-performance-segregated.php?PARA=<?php echo  "$cur,E,AD" ?>' class='sbar2'>Weekend - Draw Calls</a></td>
        <td class='ctd tdper'><?php echo  prt_0($segdata->laid); ?></td>  
        <td class='ctd tdper'><?php echo  prt_0($segdata->win);  ?></td>
        <td class='ctd tdper'><?php echo  prt($segdata->win / ($segdata->laid >0? $segdata->laid : 1 ) * 100 );  ?></td>
        <td class='ctd tdper red0'><?php echo  prt($segdata->net_lost);?></td>
        <td class='ctd tdper'><?php echo  prt($segdata->net_win); ?></td>  
     </tr>
  -->
</table>

<?php }else{
   
    echo ' <div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Prime Home Win Calls (Top 6)</div>';

    require_once("select-option.ini.php");
    
} ?>



<div style='font-size:12px;padding:30px 30px'> 
<span class='red' style='font-size:18px;'>WARNING NOTICE:</span>

<ol>
	<li style='padding-bottom:10px;'>This is a warning about our website's "Prime Home Win Calls", which are most definitely <span class='red'>NOT RECOMMENDATIONS</span> from us about what to bet on but, instead, are specifically to show how <b>the low Odds against so-called "Prime" selections will generally lead to you losing more than you will make!</b></li>
	
	<li style='padding-bottom:10px;'>We show here what our "Predict-A-Win" Program assessed were the most likely 6 Home Team winners in each Odds range for past weeks.  For all but the "Long Shots" our PRIME SELECTIONS in all cases matched what the Bookie expected the outcome to be.  But the chances of you having made money if you had bet on all 6 matches in each Odds range were next to impossible, if not <b>actually</b> impossible!  <span class='red'>So you have been warned!</span> </li>
	
	<li style='padding-bottom:10px;'>Some weeks it would have been better by far to have bet on the Away Team win coming through on all matches!  You can check out the outcome of all the alternative (REVERSE) betting options by using our "<span class='bb'>SoccerPAT</span>" facility..... so please don't be lazy about it, otherwise you will continue to lose if you insist on betting on all those matches we post in the "Prime Home Win Calls" section, even though the Bookie believed that the outcome would be exactly the same as our postings! </li>
	
	<li style='padding-bottom:10px;'>In addition, we recommend using the "Medium Odds" and "Long Shots" selections only for alternative "Correct Scores" hedge betting purposes, because you can expect actual Draws to result all too often, as well as the occasional Away Win coming through for those higher Odds ranges.  Selective "Double Chance" or "Win Only" betting may help you win something from the selected matches, but don't ever rely on it! </li>
	
	<li style='padding-bottom:10px;'>As we tell you above - <span class='red'>YOU HAVE BEEN DULY WARNED</span> about relying on so-called "Prime" calls so, as Nike might say:  <span class='red'>JUST DON'T DO IT!!</span> </li>
	
	

</ol>
</div>



<?php
// getting data for weekly review ....
function All_SegCalls($bet, $class, $season,$db)
{
    global $eu, $sa;
    
    unset($wkdata);
    $laid = 0; $win = 0; $net_lost = "-"; $net_won = "-" ; $total_win = 0;

    if ($season == curseason($db)){
    	$cur_wk = cur_week($db);
    	 $sql= "select * from quickpick where weekno<>'$cur_wk' and season='$season' and matchtype='$class' and bettype='$bet'" ;
    }else{
    	 $sql="select * from quickpick where season='$season' and matchtype='$class' and bettype='$bet'" ;
    }
   
    if ($db=='eu'){
        $temp = $eu->prepare($sql) ;
    }else{
        $temp = $sa->prepare($sql);
    }
    $temp->execute();

     while ($data = $temp->fetch() )
     {
        if ($data[gotit]>=0 and $data['h_s']<>'P')
        {
            $laid += 1;
            $win  += $data[gotit];
            if ($data[h_s]>$data[a_s] and $data[gotit]==1)
            {
              $total_win += $data[h_odds];
            }elseif ($data[h_s]<$data[a_s] and $data[gotit]==1)
            {
              $total_win += $data[a_odds];
            }elseif ($data[h_s]==$data[a_s] and $data[gotit]==1)
            {
              $total_win += $data[d_odds];
            }
        } 
     }
     
     if ($total_win > $laid) { $net_win = $total_win - $laid ; }
     if ($total_win < $laid) { $net_lost= $laid - $total_win ; }
     
     $wkdata = new stdClass();
     $wkdata->laid = $laid ;
     $wkdata->win  = $win ;
     $wkdata->net_lost = $net_lost ;
     $wkdata->net_win  = $net_win ;
     
     return $wkdata;
}

?>



<?php require_once("footer.ini.php"); ?>