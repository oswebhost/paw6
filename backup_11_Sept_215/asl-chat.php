<style>
	.mytd  {text-align:center; padding:5px; font-size:12px; border:1px solid green; width:10%;font-weight:bold;} 
	.mytd2 {text-align:center; padding:5px; font-size:12px; border:1px solid green; width:10%;font-weight:bold;} 
	.mytd3 {text-align:center; padding:0px; font-size:12px; border:1px solid green; width:10%;font-weight:bold;width:50;} 
	.mytd4 {vertical-align:bottom;text-align:center;} 
	.mytd5 {text-align:center; padding:3px; font-size:12px; border:1px solid green;width:80px;font-weight:bold;} 
	.mytd6 {text-align:center; padding:3px; font-size:12px; border:1px solid green; font-weight:bold;} 
	.mytd7 {text-align:center; padding:4x; font-size:12px; font-weight:bold;} 
	.mytd8 {text-align:right; padding:4x; font-size:12px; font-weight:bold;} 

	.rank_0{text-align:center; padding:5px; font-size:12px; border:1px solid green; width:10%;font-weight:bold;} 
	.rank_1{text-align:center; padding:5px; font-size:12px; border:1px solid green; width:10%;font-weight:bold; background:#B5CC84} 
	.rank_2{text-align:center; padding:5px; font-size:12px; border:1px solid green; width:10%;font-weight:bold; background:#CDDDAE;} 
	.rank_3{text-align:center; padding:5px; font-size:12px; border:1px solid green; width:10%;font-weight:bold; background:#E0EBCB} 
	.rank_4{text-align:center; padding:5px; font-size:12px; border:1px solid green; width:10%;font-weight:bold; background:#EEF3E2;} 
</style>

<div align="center">
<div style='padding:2px;'></div>

<? // 
	
   
    
	$match_asl = ($h_asl>5? 5:$h_asl) ."-" .$a_asl;

    $odd_cat = Find_RT_Odd_Cat($h_asl, $a_asl, $homepb, $drawpb, $awaypb);
	//echo $odd_cat;
	//echo " $homepb  -- $drawpb  -- $awaypb ASL $h_asl - $a_asl <BR>";
?>


<?
	$row = 0;
//	echo "select * from csodd_table where odds='$odd_cat' and asl='$match_asl' order by outcome";

	$asl_q = "select * from csodd_table where odds='$odd_cat' and asl='$match_asl' order by outcome";

    if ($db=='eu'){
        $temp = $eu->prepare($asl_q);
    }else{
        $temp = $sa->prepare($asl_q);
    }
    $temp->execute();

	$info = matrix();
	$info = ereg_replace("%match_asl%", "$h_asl-$a_asl", $info);
    $content='';
	$col = 0;
	while ($asld = $temp->fetch() ):
		
		$content .= "<td class='$asld[tdclass]'>". num2($asld[probs]). "%</td>\n";

		$col++;
		if ($col>=6): 
			$col=0; $row++;
			$content .= "</tr>";
			if ($row<6):
				$content .= "<tr><td class='mytd2' " . row_bg($row) .">$row</td>\n\n";
			endif;
		endif;
	endwhile;

	echo $info . $content . "</table>";
?>


<div style='padding:2px;'></div>

<table border="0" cellpadding="0" style="border-collapse: collapse" width="500" bordercolor="#008000">
	<tr>
		<td colspan="11" bgcolor="#F4F4F4" height="25" style='text-align:center'><font class='credit'>Goals Advantage</font></td>
	</tr>
	<tr>
		<td colspan='11' height='100' style='padding-top:2px;'>
			<?
	 
			//$datay=array(0.60, 1.30, 5.50, 11.05, 21.20, 27.50, 18.60, 9.00, 3.45, 1.25, 0.55);
			$asl_q = "select adv, sum(probs) as probs from csodd_table where odds='$odd_cat' and asl='$match_asl' group by adv order by adv desc";
		    
		    if ($db=='eu'){
		        $temp = $eu->prepare($asl_q);
		    }else{
		        $temp = $sa->prepare($asl_q);
		    }			
			$temp->execute();

			$value_total=0;$h_value=0;$a_value=0;

			while ($asl_d = $temp->fetch()):
				$datay[] = $asl_d['probs'] ;
				$value_total += $asl_d['probs'] ;
			endwhile;

			$data_x = array("+5","+4", "+3", "+2", "+1", "0", "-1","-2","-3","-4","-5") ;
			

			$_SESSION['cs_y'] = $datay;
			$_SESSION['cs_x'] = $data_x;

			if ($h_asl>$a_asl):
				$h_value = 100 - $value_total;
			elseif ($a_asl>$h_asl):
				$a_value = 100 - $value_total;
			else:
				$h_value = (100 - $value_total)/2;
				$a_value = (100 - $value_total)/2;
			endif;
			?>
			<img src="cs-bar.php" border="0" alt=''> 

		</td>
	</tr>
	<tr>
		<td class="mytd3 ctd" bgcolor="#75A4DD"><?=num2($datay[0]);?>%</td>
		<td class="mytd3 ctd" bgcolor="#95B3D7"><?=num2($datay[1]);?>%</td>
		<td class="mytd3 ctd" bgcolor="#8DB4E3"><?=num2($datay[2]);?>%</td>
		<td class="mytd3 ctd" bgcolor="#B8CCE4"><?=num2($datay[3]);?>%</td>
		<td class="mytd3 ctd" bgcolor="#C5D9F1"><?=num2($datay[4]);?>%</td>
		<td class="mytd3 ctd" bgcolor="#DFFFDF"><?=num2($datay[5]);?>%</td>
		<td class="mytd3 ctd" bgcolor="#F2DDDC"><?=num2($datay[6]);?>%</td>
		<td class="mytd3 ctd" bgcolor="#FCD5B4"><?=num2($datay[7]);?>%</td>
		<td class="mytd3 ctd" bgcolor="#E6B9B8"><?=num2($datay[8]);?>%</td>
		<td class="mytd3 ctd" bgcolor="#FAC090"><?=num2($datay[9]);?>%</td>
		<td class="mytd3 ctd" bgcolor="#D99795"><?=num2($datay[10]);?>%</td>
	</tr>
	<tr>
		<td class="mytd3 ctd" bgcolor="#75A4DD">+5</td>
		<td class="mytd3 ctd" bgcolor="#95B3D7">+4</td>
		<td class="mytd3 ctd" bgcolor="#8DB4E3">+3</td>
		<td class="mytd3 ctd" bgcolor="#B8CCE4">+2</td>
		<td class="mytd3 ctd" width="37" bgcolor="#C5D9F1">+1</td>
		<td class="mytd3 ctd" width="44" bgcolor="#DFFFDF">0</td>
		<td class="mytd3 ctd" bgcolor="#F2DDDC">-1</td>
		<td class="mytd3 ctd" bgcolor="#FCD5B4">-2</td>
		<td class="mytd3 ctd" bgcolor="#E6B9B8">-3</td>
		<td class="mytd3 ctd" bgcolor="#FAC090">-4</td>
		<td class="mytd3 ctd" bgcolor="#D99795">-5</td>
	</tr>
	<tr>
		<td colspan="5" height="25" style='text-align:center;border:1px solid #008000;font-size:12px;'>
		Likelihood of HT Goal Advantage</td>
		<td height="25" style='text-align:center;border:1px solid #008000;font-size:12px;'>
		Draw</td>
		<td colspan="5" height="25" style='text-align:center;border:1px solid #008000;font-size:12px;'>
		Likelihood of AT Goal Advantage</td>
	</tr>
	
</table>

<div style='padding:2px;'></div>



</div>




<div align="center">
	<table border="1" cellpadding="0" style="border-collapse: collapse" width="300" bordercolor="#008000" cellspacing="0" class="mytd6">
		<tr>
			<td colspan="3" class="mytd" bgcolor="#EFF5FA">Likelihood of Goal Difference for <?="$h_asl-$a_asl"; ?> Prediction</td>
		</tr>
		<tr>
			<td colspan="3" class="mytd" bgcolor="#F6F6F6">Likelihood of a Draw = <?=$datay[5];?>%</td>
		</tr>
		<tr>
			<td class="mytd6" width="48%" bgcolor="#EAF7EA">Likelihood of Win by at least:</td>
			<td class="mytd5" width="36%" bgcolor="#EAF7EA">Home<br>
			Team</td>
			<td class="mytd5" width="23%" bgcolor="#EAF7EA">Away<br>
			Team</td>
		</tr>
		<tr>
			<td class="mytd8">1 Goal =</td>
			<td class="mytd7"><?= num2($h_value+$datay[4]+$datay[3]+$datay[2]+$datay[1]+$datay[0]); ?>%</td>
			<td class="mytd7"><?= num2($a_value+$datay[6]+$datay[7]+$datay[8]+$datay[9]+$datay[10]); ?>%</td>
		</tr>
		<tr>
			<td class="mytd8" bgcolor="#EFF5FA">2 Goals =</td>
			<td class="mytd7" bgcolor="#EFF5FA"><?= num2($h_value+$datay[3]+$datay[2]+$datay[1]+$datay[0]); ?>%</td>
			<td class="mytd7" bgcolor="#EFF5FA"><?= num2($a_value+$datay[7]+$datay[8]+$datay[9]+$datay[10]); ?>%</td>
		</tr>
		<tr>
			<td class="mytd8">3 Goals =</td>
			<td class="mytd7"><?= num2($h_value+$datay[2]+$datay[1]+$datay[0]); ?>%</td>
			<td class="mytd7"><?=  num2($a_value+$datay[8]+$datay[9]+$datay[10]); ?>%</td>
		</tr>
		<tr>
			<td class="mytd8" bgcolor="#EFF5FA">4 Goals =</td>
			<td class="mytd7" bgcolor="#EFF5FA"><?= num2($h_value+$datay[1]+$datay[0]); ?>%</td>
			<td class="mytd7" bgcolor="#EFF5FA"><?= num2($a_value+$datay[9]+$datay[10]); ?>%</td>
		</tr>
		<tr>
			<td class="mytd8">5 Goals =</td>
			<td class="mytd7"><?= num2($h_value+$datay[0]); ?>%</td>
			<td class="mytd7"><?= num2($a_value+$datay[10]);?>%</td>
		</tr>
		<?
			if ($h_value+$a_value>0):
				
				echo "<tr bgcolor=\"#EFF5FA\">
						<td class=\"mytd8\">6 or more Goals = </td>
						<td class=\"mytd7\">" . num2($h_value) ."%</td>
						<td class=\"mytd7\">" . num2($a_value) ."%</td>
					 </tr>";
					
			endif;

		?>

	</table>
</div>




</body>

</html>

<?

function Find_RT_Odd_Cat($h_asl, $a_asl, $homepb, $drawpb, $awaypb)
{
	
  if ($h_asl > $a_asl):
 
	  if ($homepb >= 50):
		$char ="HSO";
	  elseif($homepb <= 40):
		$char ="HLS";
	  else:
		$char ="HMO";
	  endif;

  elseif($h_asl < $a_asl):
 	  
	  if ($awaypb >= 50):
		$char ="ASO";
	  elseif($awaypb <= 40):
		$char ="ALS";
	  else:
		$char ="AMO";
	  endif;
  
  else:
	$char ="DRW";
  endif;
 return $char;
}


function matrix()
{
return "
<table width='300' cellpadding='0' border='1' style='border-collapse: collapse'  bordercolor='#008800'>
<tr >
	<td rowspan='2' colspan='2' class='mytd2'><b><font size='2'>ASL<br>
	</font><font size='2' color='#FF0000'>%match_asl%</font></b></td>
	<td colspan='6' style='text-align:right;' bgcolor='#FFD2D2'><img src='images/away-head.gif' border='0' alt=''></td>
</tr>
 <tr bgcolor='#FFD2D2'>
	<td class='mytd2' bgcolor='#FDE9D9'>0</td>
	<td class='mytd2' bgcolor='#F2DDDC'>1</td>
	<td class='mytd2' bgcolor='#FCD5B4'>2</td>
	<td class='mytd2' bgcolor='#E6B9B8'>3</td>
	<td class='mytd2' bgcolor='#FAC090'>4</td>
	<td class='mytd2' bgcolor='#D99795'>5</td>
 </tr>

  <tr>
	<td align='center' bgcolor='#EAEAFF' rowspan='6'><img src='images/home-head.gif' border='0' alt=''></td>
	<td class='mytd2' bgcolor='#DBE5F1'><img border='0' src='images/zero.gif' alt=''></td>";

}

function row_bg($row)
{
	switch ($row):
		case 1: $cap = "bgcolor='#C5D9F1'" ; break;
		case 2: $cap = "bgcolor='#B8CCE4'" ; break;
		case 3: $cap = "bgcolor='#8DB4E3'" ; break;
		case 4: $cap = "bgcolor='#95B3D7'" ; break;
		case 5: $cap = "bgcolor='#75A4DD'" ; break;
	endswitch;
  return $cap;
}
?>