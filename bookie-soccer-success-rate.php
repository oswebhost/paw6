<? session_start();


include("config.ini.php");
include("function.ini.php");

$db= $_GET['db'];


if (!isset($_GET['cur'])):
	$cur = curseason($db);
endif;

$page_title = "Bookie " . (isset($_GET['db'])? s_title($db) : "") . " Top 6 Success Rate ";


include("header.ini.php");


?>
<style>
	#t1 {border-left:2px solid #555555; text-align:center;}
</style>

<? page_header("Bookie Top 6 Success Rate") ; ?>

<? if (isset($_GET['db'])){ ?>
<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>

<table  width="100%" align="center">
<tr>
	<td><a class='sbar' href="bookie-success-level.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"></td>
</tr>
</table>
<br />


<p style="padding-top: 0;padding-bottom:0px;">The data below shows how successful the Bookies were in fixing the Odds for what they considered were the matches that offered the most obvious Home, Away and Draw calls (up to 6 matches, if available, for each category).</p>

<p style="padding-top: 10px;padding-bottom:0px;font-size: 11px;">Note:</p>
<ul><li style="margin-left:50px;padding-top: 0px;padding-left:5px;font-size: 11px;">The maximum Decimal Odds for deciding the Bookies' Home & Away Win Favourites are 1.50 in both cases.</li>
<li style="margin-left:50px;padding-top: 0px;padding-left:5px;font-size: 11px;">The Bookies' Draw expectations represent those matches where the DIFFERENCE between the Home and Away Win Odds is a maximum of 20%, ranked by the lowest Draw Odds offered.</li>
</ul>


<div style="padding-top:10px;"></div>


<form method="get" action="<?= $PHP_SELEF;?>" style="padding:0;margin:0;">
    <input type="hidden" name="db" value="<?echo $_GET['db'];?>" />

 <table border="0" width="70%" cellpadding="3" style="border-collapse: collapse;" bordercolor="#f4f4f"  >
 <tr>
  <td  height="22" width="10%" style="padding-left:20px;" >
	<span class='credit'><font  color="#0000ff">Season</font></span></td>
  <td  height="22"  >
	   <select size="1" name="cur" onChange="this.form.submit();">
	  <? 
		  $sqry = "SELECT distinct(season) as season from quickpick order by season desc";
            if ($db=='eu'){
               $temp = $eu->prepare($sqry) ;
            }else{
               $temp = $sa->prepare($sqry);
            }
            $temp->execute();
       
       while ($sr = $temp->fetch()) : 
	  ?>
		  <option value="<?= $sr["season"] ?>" <?echo selected($cur,$sr["season"])?>><?= $sr["season"] ?></option>
	  <? endwhile; ?>
    </select>
   </td>
  </tr >
  <tr>
    <td colspan='2' style='font-size:12px;padding-top:12px;padding-left:20px;'></td>
  </tr>
 </table>

</form>


<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:0px auto 0px auto;" bordercolor="#cdcdcd" width="70%">

	<tr  bgcolor="#d3ebab">
		<td  rowspan="2" width='80' align="center" style="padding:0;"><img src="images/tbcap/weekno.gif"  border="0" alt="" /></td>
		<td align="center" colspan="3" style="padding:0;"><img src="images/tbcap/bkhwin.gif"  border="0" alt="" /></td>
        <td align="center" colspan="3" style="padding:0;"><img src="images/tbcap/bkawin.gif"  border="0" alt="" /></td>
        <td align="center" colspan="3" style="padding:0;"><img src="images/tbcap/bkdraw.gif"  border="0" alt="" /></td>
		
	</tr>
	<tr  bgcolor="#D3EBAB" >
		<td align="center" style="padding:0;"><img src="images/tbcap/bkcall.gif"  border="0" alt="" /></td>
        <td align="center" style="padding:0;"><img src="images/tbcap/bkcorrect.gif"  border="0" alt="" /></td>
        <td align="center" style="padding:0;"><img src="images/tbcap/bkgain.gif"  border="0" alt="" /></td>
		<td align="center" style="padding:0;"><img src="images/tbcap/bkcall.gif"  border="0" alt="" /></td>
        <td align="center" style="padding:0;"><img src="images/tbcap/bkcorrect.gif"  border="0" alt="" /></td>
        <td align="center" style="padding:0;"><img src="images/tbcap/bkgain.gif"  border="0" alt="" /></td>
		<td align="center" style="padding:0;"><img src="images/tbcap/bkcall.gif"  border="0" alt="" /></td>
        <td align="center" style="padding:0;"><img src="images/tbcap/bkcorrect.gif"  border="0" alt="" /></td>
        <td align="center" style="padding:0;"><img src="images/tbcap/bkgain.gif"  border="0" alt="" /></td>
	</tr>


<? $number=1; $Hlaid=0;$Hwin=0;$Alaid=0;$Awin=0;$Dlaid=0;$Dwin=0; $HGain=0; $AGain=0; $DGain=0;
    
    
   if ($cur==curseason($db)){    
      $max_week=cur_week($db)-1 ;  
   }else{
      $max_week= find_last_week_of_season($cur,$db) ;
   }
   
 
   
   for ($week=1; $week<=$max_week; $week++) {
    
     // 
    $bkHWin = bookie_success_level($week, $cur,1,$db) ;
    $bkAWin = bookie_success_level($week, $cur,2,$db) ;
    $bkDraw = bookie_success_level($week, $cur,3,$db) ; 
    
    $rowcol = rowcol($number);
    
    $Hlaid += $bkHWin->laid ; $Hwin += $bkHWin->win ; $HGain += $bkHWin->gain ;
    $Alaid += $bkAWin->laid ; $Awin += $bkAWin->win ; $AGain += $bkAWin->gain ;
    $Dlaid += $bkDraw->laid ; $Dwin += $bkDraw->win ; $DGain += $bkDraw->gain ;
    
    $h_url = "<a class='pp' href=\"javascript:sele_win('bookie-success-details.php?PARA=$cur,$week,1,$db')\">";
    $a_url = "<a class='pp' href=\"javascript:sele_win('bookie-success-details.php?PARA=$cur,$week,2,$db')\">";
    $d_url = "<a class='pp' href=\"javascript:sele_win('bookie-success-details.php?PARA=$cur,$week,3,$db')\">";
    
    $number++;
    $week_url= $week ;
    
    ?>   
   <tr <? echo $rowcol ?>>
      <td class='ctd tdper'><? echo $week_url; ?></td>
      
      <td class='ctd tdper'><? echo prtZero($bkHWin->laid); ?></td>
      <td class='ctd tdper'><? echo $h_url . prtZero($bkHWin->win); ?></a></td>
      <td class='ctd tdper'><? echo prtno($bkHWin->gain); ?></td>
        
      <td class='ctd tdper'><? echo prtZero($bkAWin->laid); ?></td>
      <td class='ctd tdper'><? echo $a_url . prtZero($bkAWin->win);  ?></a></td>
      <td class='ctd tdper'><? echo prtno($bkAWin->gain); ?></td>

      <td class='ctd tdper'><? echo prtZero($bkDraw->laid); ?></td>
      <td class='ctd tdper'><? echo $d_url . prtZero($bkDraw->win);  ?></a></td>
      <td class='ctd tdper'><? echo prtno($bkDraw->gain); ?></td>
      
   </tr> 
    
<? } ?>


<?
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
 <tr <? echo $rowcol ?>>
      <td class='ctd tdper'><? echo $week; ?></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
      <td class='ctd tdper'></td>
   </tr> 
<? } ?>

<tr bgcolor='#f4f4f4'>
  <td class='ctd credit padd'>TOTAL:</td>
  <td class='ctd credit'><? echo prtZero($Hlaid); ?></td>
  <td class='ctd credit'><? echo prtZero($Hwin); ?></td>
  <td class='ctd credit'><? echo prtno($HGain); ?></td>
  <td class='ctd credit'><? echo prtZero($Alaid); ?></td>
  <td class='ctd credit'><? echo prtZero($Awin); ?></td>
  <td class='ctd credit'><? echo prtno($AGain); ?></td>
  <td class='ctd credit'><? echo prtZero($Dlaid); ?></td>
  <td class='ctd credit'><? echo prtZero($Dwin); ?></td>
  <td class='ctd credit'><? echo prtno($DGain); ?></td>
</tr> 
<tr bgcolor='#cccccc'>
  <td class='ctd credit padd'></td>
  <td class='ctd credit'></td>
  <td class='ctd credit'><? echo prtno(($Hwin/($Hlaid>0? $Hlaid : 1))*100) ; ?>%</td>
  <td class='ctd credit'></td>
  <td class='ctd credit'></td>
  <td class='ctd credit'><? echo prtno(($Awin/($Alaid>0? $Alaid : 1))*100) ; ?>%</td>
  <td class='ctd credit'></td>
  <td class='ctd credit'></td>
  <td class='ctd credit'><? echo prtno(($Dwin/($Dlaid>0? $Dlaid : 1))*100) ; ?>%</td>
  <td class='ctd credit'></td>
</tr> 

  

</table>

<?}else{
    
    include("select-option.ini.php");
    
} ?>



<? include("footer.ini.php"); ?>
