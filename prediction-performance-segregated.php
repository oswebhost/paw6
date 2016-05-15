<?php
session_start();


require_once("config.ini.php");
require_once("function.ini.php");

$parts = explode(",",$_GET['PARA']);
$cur   = $parts[0];
$bet   = $parts[1];
$sele4 = $parts[2];
$db    = $parts[3];


if (!isset($cur)):
	$cur = curseason($db);
endif;



if ($sele4=="AD" and $bet=="E"): 
    $page_title = "Prediction Performance Records ". s_title($db) ." $cur " .  prt_bet($sele4) ;
else:
    $page_title = "Prediction Performance Records ". s_title($db) . " $cur " .  prt_bet($bet) . " - " . prt_bet($sele4) ;
endif;

require_once("header.ini.php");



?>
<style>
	#t1 {border-left:2px solid #555555; text-align:center;}
</style>

<?php page_header("Prediction Performance Records") ;  ?>

<table border="0" width="100%" cellpadding="3" cellspacing="0" style='margin-bottom:5px;'>
 <tr>
    <td width="25%"><a class='sbar' href="soccer-segregated-selections-performance.php?db=<?php echo $db;?>&<?php echo $cur; ?>"><img border="0" src="images/header/blue-dot.gif" >Back</a></td>

   <td width="25%" height="20" align='center' colspan='3' valign="bottom">
	
	 </td>
	<td width="25%" align="right"> <?php echo  printscr(); ?></td>
	</tr>
 </table>

<div class="report_blue_heading" style="float:left;width: 560px;"><?php echo  site($db);?></div>
<div class='clear'></div>
<div class="report_blue_heading" style="width: 560px;height:32px;margin:0 auto 5px auto;">
    Prime Home Win Calls (Top 6)<br />
    <?php echo  prt_bet($bet);?> 
</div>





<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:10px auto 10px auto;" bordercolor="#CDCDCD" width="70%">

<tr  bgcolor="#d3ebab">
	<td rowspan="2" width='80' align="center"><img src="images/tbcap/weekno.gif"  border="0" alt=""/></td>
	<td align="center" colspan="3"><img src="images/tbcap/noofbets.gif"  border="0" alt=""/></td>
	<td align="center" colspan="2"><img src="images/tbcap/noofunit.gif"  border="0" alt=""/></td>
</tr>
<tr  bgcolor="#d3ebab" >
  <td align="center" width='90'><img src="images/tbcap/laid.gif"  border="0" alt=""/></td>
  <td align="center" width='90'><img src="images/tbcap/won.gif"  border="0" alt=""/></td>
  <td align="center" width='90'><img src="images/tbcap/perbig.gif"  border="0" alt=""/></td>
  <td align="center" width='90'><img src="images/tbcap/lost.gif"  border="0" alt=""/></td>
  <td align="center" width='90'><img src="images/tbcap/won.gif"  border="0" alt=""/></td>
</tr>


<?php
   $number=1; $laid=0;$won=0; $unit_lost=0; $unit_won=0;
   
   if ($cur==curseason($db)){    
      $max_week=cur_week($db)-1 ;  
   }else{
      $max_week= find_last_week_of_season($cur,$db) ;
   }
   
   
   for ($week=1; $week<=$max_week; $week++) {
    $call1x2 = segcalls($week, $bet, $sele4, $cur,$db) ;
     
    
    $rowcol = rowcol($number);
    $laid += $call1x2->laid ; $won += $call1x2->win ;
    $unit_lost += $call1x2->net_lost ; $unit_won += $call1x2->net_win ;
    $number++;
    $week_url= $week ;
    
    if ($call1x2->laid>0) { 
		$week_url = "<a class='pp' href=\"javascript:sele_win('selections-details.php?PARA=$cur,$bet,$week,$sele4,$db')\">$week</a>" ; 
   ?>	
	
   <tr <?php echo  $rowcol ?>>
      <td class='ctd tdper'><?php echo  $week_url; ?></td>
      <td class='ctd tdper'><?php echo  prt_0($call1x2->laid); ?></td>
      <td class='ctd tdper'><?php echo  prt_0($call1x2->win);  ?></td>
      <td class='ctd tdper'><?php echo  prt($call1x2->win / ($call1x2->laid >0? $call1x2->laid : 1 ) * 100 );  ?></td>
      <td class='ctd tdper red0'><?php echo  prt($call1x2->net_lost);?></td>
      <td class='ctd tdper'><?php echo  prt($call1x2->net_win); ?></td>
   </tr> 

<?php }else{ ?>   
    
   <tr <?php echo  $rowcol ?>>
      <td class='ctd tdper'><?php echo  $week_url; ?></td>
      <td class='ctd tdper'>-</td>
      <td class='ctd tdper'>-</td>
      <td class='ctd tdper'>-</td>
      <td class='ctd tdper'>-</td>
      <td class='ctd tdper'>-</td>
   </tr> 




<?php  }

  } 
?>


<?php
 if ($cur == curseason($db)){
  $start = cur_week($db);
  $end   = 44;
 }else{
  $start = $week+1;
  $end = $max_week;
 }
 
 for ($week=$start; $week<=$end; $week++) {
 
 $rowcol = rowcol($number);
 $number++; 
?>
 <tr <?php echo  $rowcol ?>>
      <td class='ctd tdper'><?php echo  $week; ?></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper red0'></td>
      <td class='ctd tdper'></td>
   </tr> 
<?php } ?>
  




  <tr bgcolor='#f4f4f4' height='22'>
    <td class='ctd credit'>TOTAL:</td>
    <td class='ctd credit'><?php echo  prt_0($laid); ?></td>
    <td class='ctd credit'><?php echo  prt_0($won);  ?></td>
    <td class='ctd credit'><?php echo  prt($won/($laid>0? $laid :1) * 100);  ?>%</td>
    <td class='ctd red0 credit'><?php echo  prt($unit_lost);?></td>
    <td class='ctd credit'><?php echo  prt($unit_won); ?></td>
  </tr> 

  <tr bgcolor='#cccccc' height='22'>
    <td colspan='5' class='rtd credit'>NET RETURN:</td>
    <td class='ctd credit'><?php echo  prtno($unit_won-$unit_lost); ?></td>
  </tr> 


</table>


<?php require_once("footer.ini.php"); ?>
