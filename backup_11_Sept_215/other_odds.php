<? 
$Qddd = "select * from other_odds where season='$sea' and matchno='$_GET[id]'";
$Qahb = "select * from ahcap_odds where season='$sea' and matchno='$_GET[id]'";


if ($db=='eu'){
   $temp2 = $eu->prepare($Qddd) ;
}else{
   $temp2 = $sa->prepare($Qddd);
}
$temp2->execute();
$ddd = $temp2->fetch() ;

if ($db=='eu'){
   $temp3 = $eu->prepare($Qahb) ;
}else{
   $temp3 = $sa->prepare($Qahb);
}
$temp3->execute();
$ahb = $temp3->fetch() ;



  
?>
  
<style >
  #xtd{width:50%;padding:0px;font-weight:bold;border-bottom:0px solid gray;text-align:right;}
  #ytd {width:50%;padding:1px;padding-left:5px;font-weight:bold;border-bottom:0px solid gray;}
  #tdxx {border:1px solid gray;border-bottom:0px;font-weight:bold;}
  #ctd {font-weight:normal;border:1px solid gray;text-align:center;background:#ffffff;}

  #tdxht{width:50%;padding-right:5px;font-weight:bold;border-bottom:0px solid gray;text-align:right;}
  #tdyht {width:50%;padding:0px;padding-left:5px;font-weight:bold;border-bottom:0px solid gray;}

</style>
<center>
<table width='100%' border='0' cellpadding='2' cellspacing='0' style="border-collapse: collapse;" bordercolor="black">
 <tr>
	<td width='33%' valign='top' style='border-bottom:1px solid gray;border-right:1px solid gray;text-align:center;' bgcolor='#FFFFEC'><b>Double Chance </b></td>
 
	<td width='33%' bgcolor='#ECFFEC' valign='top' style='border-bottom:1px solid gray;text-align:center;border-right:1px solid gray;'><b>Win Only (Draw = No Bet)</b></td>
 
	<td width='33%' valign='top' bgcolor='#FFFFEC' style='border-bottom:1px solid gray;text-align:center;'><b>Under/Over 2.5 Goals</b> </td>
 </tr>

 <tr>
	 <td valign='top' bgcolor='#FFFFEC' style='border-right:1px solid gray;border-bottom:1px solid gray;'> 
		<? if ($ddd['hw_x']>0): ?>
		  <table width='100%' border='0' cellspacing='0'>
			<tr>	
		       <td id='xtd'>1 or X</td>
		       <td id='ytd'><? echo num2($ddd["hw_x"]); ?>  </td>
			</tr>
			<tr>	
		       <td id='xtd'>2 or X</td>
		       <td id='ytd'><? echo num2($ddd["aw_x"]); ?>  </td>
			</tr>
			<tr>	
		       <td id='xtd'>1 or 2</td>
		       <td id='ytd'><? echo num2($ddd["hw_aw"]); ?>  </td>
			</tr>
		  </table>

		 <? endif; ?>
	 
	 
	 </td>

	<td  valign='top' bgcolor='#ECFFEC'  style='border-right:1px solid gray;border-bottom:1px solid gray;'>

		<? if ($ddd['hw_odd']>0): ?>
		<table width='100%' border='0'>
			<tr>	
			   <td id='xtd'><font color='blue'>Home Win</font></td>
			   <td id='ytd'><? echo num2($ddd["hw_odd"]); ?>  </td>
			</tr>
			<tr>	
			   <td id='xtd'><font color='red'>Away Win</font></td>
			   <td id='ytd'><? echo num2($ddd["aw_odd"]); ?>  </td>
			</tr>
			

		</table>

	 <? endif; ?>
	
	</td>
	<td  valign='top' bgcolor='#FFFFEC' style='border-bottom:1px solid gray;'>
		<? if ($ddd['un_odd']>0): ?>
			<table width='100%' border='0'>
			<tr>	
			   <td id='xtd'>Under</td>
			   <td id='ytd'>
			   <? 
			    if ($DIV<>'S1' and $DIV<>'S2' and $DIV<>'S3'):
					echo  num2($ddd["un_odd"]); 
			    else:
					echo  num2($ddd["un_odd"]); 
			    endif;
			   ?>  
			  </td>
			</tr>
			<tr>	
			   <td id='xtd'>Over</td>
			   <td id='ytd'><? 
			   if ($DIV<>'S1' and $DIV<>'S2' and $DIV<>'S3'):
				   echo num2($ddd["ov_odd"]); 
			   else:
				   echo num2($ddd["ov_odd"]); 
			   endif;
			   
			   
			   ?>  </td>
			</tr>
			
			
		</table>
	 <? endif; ?>
	
	</td>
 </tr>
 <tr>
	<td id='ctd' style='border-left:0'><? echo bookie_name($ddd['dchance']); ?> </td>
	<td id='ctd'><? echo bookie_name($ddd['winonly']); ?> </td>
	<td id='ctd' style='border-right:0'><? echo bookie_name($ddd['underover']); ?> </td>
 </tr>

<? if ($ddd["ht_hh"]>0): ?>

<tr>
	<td colspan='3' bgcolor="#f4f4f4" style="text-align:center;border-bottom:1px solid #ccc;padding:5px;">
	
	<font class='credit'>Half-Time/Full-Time Odds</font>
		
	</td>
 </tr>

 <tr>
	<td  valign='top' align='center'  style='border-left:0' bgcolor='#FFFFEC'>
		
		 <table width='100%' border='0' cellspacing='0'>
			<tr>	
		       <td id='tdxht'>1 / 1</td>
		       <td id='tdyht'><? echo num2($ddd["ht_hh"]); ?>  </td>
			</tr>
			<tr>	
		       <td id='tdxht'>1 / X</td>
		       <td id='tdyht'><? echo num2($ddd["ht_hd"]); ?>  </td>
			</tr>
			<tr>	
		       <td id='tdxht'>1 / 2</td>
		       <td id='tdyht'><? echo num2($ddd["ht_ha"]); ?>  </td>
			</tr>
		  </table>
	</td>
	<td  valign='top' align='center'  style='border-left:1px solid #ccc;' bgcolor='#ECFFEC'>
		
		 <table width='100%' border='0' cellspacing='0'>
			<tr>	
		       <td id='tdxht'>X / 1</td>
		       <td id='tdyht'><? echo num2($ddd["ht_dh"]); ?>  </td>
			</tr>
			<tr>	
		       <td id='tdxht'>X / X</td>
		       <td id='tdyht'><? echo num2($ddd["ht_dd"]); ?>  </td>
			</tr>
			<tr>	
		       <td id='tdxht'>X / 2</td>
		       <td id='tdyht'><? echo num2($ddd["ht_da"]); ?>  </td>
			</tr>
		  </table>
	</td>
		<td  valign='top' align='center' style='border-left:1px solid #ccc;' bgcolor='#FFFFEC'>
		
		 <table width='100%' border='0' cellspacing='0'>
			<tr>	
		       <td id='tdxht'>2 / 1</td>
		       <td id='tdyht'><? echo num2($ddd["ht_ah"]); ?>  </td>
			</tr>
			<tr>	
		       <td id='tdxht'>2 / X</td>
		       <td id='tdyht'><? echo num2($ddd["ht_ad"]); ?>  </td>
			</tr>
			<tr>	
		       <td id='tdxht'>2 / 2</td>
		       <td id='tdyht'><? echo num2($ddd["ht_aa"]); ?>  </td>
			</tr>
		  </table>
	</td>
 </tr>
  <tr>
		<td colspan='3' class='ctd' style='border-top:1px solid #ccc;'>Odds provided courtesy of <? echo bookie_name($ddd['ht_book']); ?></td>
  </tr>
<? endif; ?>

</table>



<?  if ($ahb['hteam']<>''): ?>
<div style='padding:2px;'></div>
<table width='80%' border='0' cellpadding='4' cellspacing='0' style="border-collapse: collapse;" bordercolor="gray">
 <tr bgcolor="#f4f4f4">

	<td id='tdxx' style='text-align:center;font-weight:normal' colspan='3'>
		<span class='credit'>Asian Handicap Odds</span><br>
		<FONT SIZE="1" >Odds provided courtesy of <? echo bookie_name('BET'); ?> </font>
	</td>
	
	<tr bgcolor='#FFFFEC'>
		 <td width='30%' id='tdxx' style='text-align:right'><?echo $_SESSION['home'] .  ' (' . num2($ahb['ht_hcap']) . ')';  ?> </td>
		 <td width='20%' id='tdxx' style='text-align:center;'><? echo num2($ahb["ht_odd"]) . ' - ' . num2($ahb["at_odd"]); ?></td>
		 <td width='30%' id='tdxx'><?echo $_SESSION['away'] .  ' (' . num2($ahb['at_hcap']) . ')';   ?> </td>

	</tr>
  </tr>
 </table>

<? endif; ?>

</center>