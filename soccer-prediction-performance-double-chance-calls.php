<? session_start();


include("config.ini.php");
include("function.ini.php");

if (!isset($cur)):
	$cur = curseason();
endif;
$page_title = "Prediction Performance 1x2 Calls $cur ";

include("header.ini.php");


?>
<style>
	#t1 {border-left:2px solid #555555; text-align:center;}
</style>

<? page_header("Prediction Performance Records") ; ?>

<div class="report_blue_heading">Double Chance Calls (1X)</div>


<div style="padding-bottom:5px"></div>


<form method="post" action="<?= $PHP_SELEF;?>" style="padding:0;margin:0;">

 <table border="0" width="70%" cellpadding="3" style="border-collapse: collapse;margin:auto auto;" bordercolor="#f4f4f"  >
 <tr>
  <td  height="22" width="10%"  >
	<span class='credit'><font  color="#0000ff">Season</font></span></td>
  <td  height="22"  >
	   <select size="1" name="cur" onChange="this.form.submit();">
	  <? 
		  $sqry = mysql_query("SELECT distinct(season) as season from quickpick order by season desc") or die (mysql_error()) ;
	   while ($sr = mysql_fetch_array($sqry)) : 
	  ?>
		  <option value="<?= $sr["season"] ?>" <?echo selected($cur,$sr["season"])?>><?= $sr["season"] ?></option>
	  <? endwhile; ?>
    </select>
   </td>
  </tr >
  <tr>
    <td colspan='2' style='font-size:12px;padding-top:12px;'>The No of Units Lost and Won is calculated based on 1 Unit per Bet.</td>
  </tr>
 </table>

</form>


<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:10px auto 10px auto;" bordercolor="#CDCDCD" width="70%">

	<tr  bgcolor="#D3EBAB">
		<td  rowspan="2" width='80' align="center"><IMG SRC="images/tbcap/weekno.gif"  BORDER="0" ALT=""></td>
		<td align="center" colspan="3"><IMG SRC="images/tbcap/noofbets.gif"  BORDER="0" ALT=""></td>
		<td align="center" colspan="2"><IMG SRC="images/tbcap/noofunit.gif"  BORDER="0" ALT=""></td>
	</tr>
	<tr  bgcolor="#D3EBAB" >
		<td align="center" width='90'><IMG SRC="images/tbcap/laid.gif"  BORDER="0" ALT=""></td>
    <td align="center" width='90'><IMG SRC="images/tbcap/won.gif"  BORDER="0" ALT=""></td>
    <td align="center" width='90'><IMG SRC="images/tbcap/perbig.gif"  BORDER="0" ALT=""></td>
		<td align="center" width='90'><IMG SRC="images/tbcap/lost.gif"  BORDER="0" ALT=""></td>
		<td align="center" width='90'><IMG SRC="images/tbcap/won.gif"  BORDER="0" ALT=""></td>
	</tr>


<? $number=1; $laid=0;$won=0; $unit_lost=0; $unit_won=0;
    
    
   if ($cur==curseason()){    
      $max_week=cur_week()-1 ;  
   }else{
      $max_week= find_last_week_of_season($cur) ;
   }
   
   for ($week=1; $week<=$max_week; $week++) {
    
     // DC
    $call1x2 = callDC($week, $cur) ;
     
    
    $rowcol = rowcol($number);
    $laid += $call1x2->laid ; $won += $call1x2->win ;
    $unit_lost += $call1x2->net_lost ; $unit_won += $call1x2->net_win ;
    $number++;
    $week_url= $week ;
    
    if ($call1x2->laid>0) { $week_url = "<a class='pp' href=\"javascript:sele_win('selections-details.php?PARA=$cur,V,$week,DC')\">$week</a>" ; }
    
?>   
   <tr <? echo $rowcol ?>>
      <td class='ctd tdper'><? echo $week_url; ?></td>
      <td class='ctd tdper'><? echo prt_0($call1x2->laid); ?></td>
      <td class='ctd tdper'><? echo prt_0($call1x2->win);  ?></td>
      <td class='ctd tdper'><? echo prt($call1x2->win / ($call1x2->laid >0? $call1x2->laid : 1 ) * 100 );  ?></td>
      <td class='ctd tdper red0'><? echo prt($call1x2->net_lost);?></td>
      <td class='ctd tdper'><? echo prt($call1x2->net_win); ?></td>
   </tr> 
    
<? } ?>


<?
  if ($cur == curseason()){
  $start = cur_week();
  $end   = 44;
 }else{
  $start = $week+1;
  $end = $max_week;
 }
 
 for ($week=$start; $week<=$end; $week++) {
 
 
 $rowcol = rowcol($number);
  $number++; 
?>
 <tr <? echo $rowcol ?>>
      <td class='ctd tdper'><? echo $week; ?></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper red0'></td>
      <td class='ctd tdper'></td>
   </tr> 
<? } ?>

<tr bgcolor='#f4f4f4' height='22'>
  <td class='ctd credit'>TOTAL:</td>
  <td class='ctd credit'><? echo prt_0($laid); ?></td>
  <td class='ctd credit'><? echo prt_0($won);  ?></td>
  <td class='ctd credit'><? echo prt($won/($laid>0? $laid :1) * 100);  ?>%</td>
  <td class='ctd red0 credit'><? echo prt($unit_lost);?></td>
  <td class='ctd credit'><? echo prt($unit_won); ?></td>
</tr> 

  <tr bgcolor='#cccccc' height='22'>
    <td colspan='5' class='rtd credit'>NET RETURN:</td>
    <td class='ctd credit'><? echo prtno($unit_won-$unit_lost); ?></td>
  </tr> 

  

</table>




<? include("footer.ini.php"); ?>
