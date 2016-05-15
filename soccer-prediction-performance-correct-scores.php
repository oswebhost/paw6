<? session_start();


include("config.ini.php");
include("function.ini.php");

if (!isset($db)){
  $db = 'eu';
}else{
  $db= $_GET['db'];
}

$bluebox_message  = 200;

if (!isset($_GET['cur'])){
	$cur = curseason($db);
}else{
    $cur = $_GET['cur'];
}

if (isset($_GET['db'])){
  $page_title = "Prediction Performance Correct Scores Selections (\"EASE 6\") " . s_title($db) . " Season $cur "; 
}else{
  $page_title = "Prediction Performance Correct Scores Selections (\"EASE 6\")"; 
}

include("header.ini.php");


?>
<style>
	#t1 {border-left:2px solid #555555; text-align:center;}
</style>

<? page_header("Soccer Prediction Performance Records") ; 

if (!isset($_GET['db'])){ ?>
  <div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Correct Scores Selections ("ease 6")</div>

<?}

if (isset($_GET['db'])){ 

?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>
<div class="report_blue_heading"  style="width: 560px;margin:0 auto 5px auto;">correct scores selections ("ease 6")</div>

<table border="0" width="100%" cellpadding="0" cellspacing="0">
 <tr>
    <td width="25%"><a class='sbar' href="soccer-prediction-performance-correct-scores.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a></td>

   <td width="25%" height="20" align='center' colspan='3' valign="bottom">
		<form method='get' style='padding:0;margin:0;'>	
		
	 </td>
	<td width="25%" align="right"> <? echo printscr(); ?></td>
	</tr>
 </table>
 <br/>


<form method="get" action="<?= $PHP_SELEF;?>" style="padding:0;margin:0;">
  <input type="hidden" name="db" value="<?echo $_GET['db'];?>" />   
  
 <table border="0" width="88%" cellpadding="3" style="border-collapse: collapse;margin:auto auto;" bordercolor="#f4f4f"  >
 <tr>
  <td  height="22" width="10%"  >
	<span class='credit'><font  color="#0000ff">Season</font></span></td>
  <td  height="22"  >
	   <select size="1" name="cur" style="font-size:12px;width:120px;font-weight:bold;"  onChange="this.form.submit();">
          <?if ($db=='eu'){?>
              <option value="2012-2013" <?echo selected($_GET['cur'],"2012-2013")?>>2012-2013</option>
              <option value="2011-2012" <?echo selected($_GET['cur'],"2011-2012")?>>2011-2012</option>
    		  <option value="2010-2011" <?echo selected($_GET['cur'],"2010-2011")?>>2010-2011</option>
	      <?}?>
          
          <?if ($db=='sa'){?>
              <option value="2012" <?echo selected($_GET['cur'],"2012")?>>2012</option>
              <option value="2011" <?echo selected($_GET['cur'],"2011")?>>2011</option>
    		      <option value="2010" <?echo selected($_GET['cur'],"2010")?>>2010</option>
          <?}?> 

    </select>
  </td>
  </tr >

  <tr>
     <td colspan='2' style='font-size:12px;padding-top:12px;'>
      The table below shows the No of Units Won or Lost based on 1 Unit per Bet, 
      and the bottom summary rows show the overall impact. 
      Note that although the <span class='bb'>CORRECT SCORES</span> percentage loss may be high, 
      the actual number of Units lost would always be <b><i>so very much lower</i></b> than 
      all other Bet Types, with far more to gain if 6, 5, 4 or even just 3 
      Correct Score calls come through in Line 1!
    </td>   
  </tr>  
</table>

</form>


<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:10px auto 10px auto;" bordercolor="#CDCDCD" width="70%">

	<tr  bgcolor="#D3EBAB">
		<td align="center"><img src="images/tbcap/weekno.gif"    border="0" alt=""/></td>
		<td align="center"><img src="images/tbcap/1x2calls.gif"  border="0" alt=""/></td>
        <td align="center"><img src="images/tbcap/underover.gif" border="0" alt=""/></td>
        <td align="center"><img src="images/tbcap/ahbcall.gif"   border="0" alt=""/></td>
		<td align="center"><img src="images/tbcap/cspline.gif"   border="0" alt=""/></td>
		<td align="center"><img src="images/tbcap/netwin.gif"    border="0" alt=""/></td>
	</tr>

<? $number=1; $outright=0; $underover=0; $ahb=0; $cspline=0; $net=0; $x12stake=0; $uostake=0; $ahbstake=0; $csstake=0; $netstake=0;
    
    
    
   if ($cur==curseason($db)){    
      $max_week=cur_week($db)-1 ;  
   }else{
      $max_week= find_last_week_of_season($cur,$db) ;
   }
   
   for ($week=1; $week<=$max_week; $week++) {
    
     // DC
    $ease = callEASE($week, $cur,$db) ;
     
    $outright += $ease->outright;
    $underover+= $ease->underover;
    $ahb      += $ease->ahb;
    $cs       += $ease->cs;
    $net      += $ease->net;
    
	$x12stake += $ease->x12_stake; 
	$uostake  += $ease->uo_stake; 
	$ahbstake += $ease->ahb_stake;
	$csstake  += $ease->cs_stake;
    $netstake += $ease->x12_stake + $ease->uo_stake + $ease->ahb_stake + $ease->cs_stake;
	
	$rowcol = rowcol($number);

    $number++;
    $week_url= $week ;
    
    if ($ease->net<>0) { 
      $week_url = "<a class='pp' href=\"javascript:sele_win('ease-details.php?PARA=$cur,$week,$db')\">$week</a>" ; 
    ?>
      <tr <? echo $rowcol ?>>
        <td class='ctd tdper'><? echo $week_url; ?></td>
        <td class='ctd tdper'><? echo prtno($ease->outright); ?></td>
        <td class='ctd tdper'><? echo prtno($ease->underover); ?></td>
        <td class='ctd tdper'><? echo prtno($ease->ahb); ?></td>
        <td class='ctd tdper'><? echo prtno($ease->cs); ?></td>
        <td class='ctd tdper'><b><? echo prtno($ease->net); ?></b></td>
     </tr>
    <?   
    }else{
    ?>
       <tr <? echo $rowcol ?>>
        <td class='ctd tdper'><? echo $week; ?></td>
        <td class='ctd tdper' colspan="5">-</td>
     </tr>
    
    
    <?
    }
    
?>   
    
    
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
   </tr> 
<? } ?>

<tr bgcolor='#cccccc' height='22'>
  <td class='rtd credit'>RETURNS:</td>
  <td class='ctd credit'><? echo prtno($outright); ?></td>
  <td class='ctd credit'><? echo prtno($underover); ?></td>
  <td class='ctd credit'><? echo prtno($ahb); ?></td>
  <td class='ctd credit'><? echo prtno($cs); ?></td>
  <td class='ctd credit'><? echo prtno($net); ?></td>
  
</tr> 

<tr bgcolor='#f4f4f4' height='22'>
  <td class='rtd credit'>STAKED:</td>
  <td class='ctd credit'><? echo prtno($x12stake); ?></td>
  <td class='ctd credit'><? echo prtno($uostake); ?></td>
  <td class='ctd credit'><? echo prtno($ahbstake); ?></td>
  <td class='ctd credit'><? echo prtno($csstake); ?></td>
  <td class='ctd credit'><? echo prtno($netstake); ?></td>
</tr> 

<tr bgcolor='#bbbbbb' height='22'>
  <td class='rtd credit'>% RETURN:</td>
  <td class='ctd credit'><? echo ($x12stake>0? prtno( ($outright/$x12stake)*100) ."%" : ""); ?></td>
  <td class='ctd credit'><? echo ($uostake>0 ? prtno( ($underover/$uostake)*100) ."%" : ""); ?></td>
  <td class='ctd credit'><? echo ($ahbstake>0? prtno( ($ahb/$ahbstake)*100) ."%" : ""); ?></td>
  <td class='ctd credit'><? echo ($csstake>0 ? prtno( ($cs/$csstake)*100) ."%"   : "") ; ?></td>
  <td class='ctd credit'><? echo ($netstake>0? prtno( ($net/$netstake)*100) ."%" : "") ; ?></td>
</tr> 

	<tr  bgcolor="#D3EBAB">
		<td align="center"></td>
		<td align="center"><img src="images/tbcap/1x2calls.gif"  border="0" alt=""/></td>
        <td align="center"><img src="images/tbcap/underover.gif" border="0" alt=""/></td>
        <td align="center"><img src="images/tbcap/ahbcall.gif"   border="0" alt=""/></td>
		<td align="center"><img src="images/tbcap/cspline.gif"   border="0" alt=""/></td>
		<td align="center"><img src="images/tbcap/netwin.gif"    border="0" alt=""/></td>
	</tr>
  

</table>

<?}else{
    
    include("select-option.ini.php");
    
} ?>


<? include("footer.ini.php"); ?>
