<?	
session_start();

if ($loc =="Home" ): 
	$TEAM = $_SESSION['home'] ; $cap="<font color='blue'>". strtoupper($_SESSION[home]) ."</font>" ;
else: 
	$TEAM = $_SESSION['away']; $cap="<font color='red'>". strtoupper($_SESSION[away]) ."</font>" ; 
endif;

$myStyle ="style='font-weight:bold;background:#D5D5FF' ";
$myStyle2 ="style='font-weight:bold;background:#FFD2D2' ";
?>

<div align='center'> 

<? if ($loc =="Home" ): ?>
	  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#CDCDCD" width="100%">
	   <tr><td colspan='3' class='ctd'><B>When Home: <?=$cap?></B>
	   <? if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
	   </td></tr>
	  <tr bgcolor="#D3EBAB">
	    <td width="33%" class='ctd padd'><b>Goals</b></td>
		<td width="33%" class='ctd'><b>For</b></td>
		<td width="33%" class='ctd'><b>Against</b></td>
	  </tr>
	  <?
	  $query1 = "SELECT h_s, a_s FROM fixtures WHERE hteam=\"$TEAM\" and season='$sea' and `div`='$home_div'  and h_s<>'P' and h_s>''";
	
		if ($db=='eu'){
		    $temp = $eu->prepare($query1) ;
		}else{
		    $temp = $sa->prepare($query1);
		}
		$temp->execute();				
		// set to zero
		for ($i=0; $i<=6; $i++):
			$gf[$i]= 0;
			$ga[$i]= 0;
		endfor;
		
		while ($d2 = $temp->fetch() ):
				
			switch ($d2["h_s"]) {
				case 0:	$gf[0]++ ; break;
				case 1:	$gf[1]++ ; break;
				case 2:	$gf[2]++ ; break;
				case 3:	$gf[3]++ ; break;
				case 4:	$gf[4]++ ; break;
				case 5:	$gf[5]++ ; break;
				default: $gf[6]++; break;
			}

			switch ($d2["a_s"]) {
				case 0:	$ga[0]++ ; break;
				case 1:	$ga[1]++ ; break;
				case 2:	$ga[2]++ ; break;
				case 3:	$ga[3]++ ; break;
				case 4:	$ga[4]++ ; break;
				case 5:	$ga[5]++ ; break;
				default: $ga[6]++; break;
			}
		endwhile;
		//find max gf, ga
		$Max_Gf = max($gf);
		$Max_Ga = max($ga);
		
		for ($i=0; $i<=6; $i++):
			echo "<tr " . rowcol($i) . ">\n";
			echo "<td class='ctd'>" . ($i==6? ">5" : $i) . "</td>\n";
			echo "<td class='ctd' ". ($Max_Gf==$gf[$i]? $myStyle : "") . ">" . $gf[$i] . "</td>";
			echo "<td class='ctd' ". ($Max_Ga==$ga[$i]? $myStyle2 : "") .">" . $ga[$i] . "</td>";
			echo "</tr>\n";
		endfor;
	  ?>
	</table>

<? else: ?>

	  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#CDCDCD" width="100%">
	   
	   <tr><td colspan='3' class='ctd'><B>When Away: <?=$cap?></B>
	   <? if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
	   </td></tr>
	  <tr bgcolor="#D3EBAB">
	  	<td width="33%" class='ctd padd'><b>Goals</b></td>
		<td width="33%" class='ctd'><b>For</b></td>
		<td width="33%" class='ctd'><b>Against</b></td>
	  </tr>
	  <?
	  $query1 = "SELECT h_s, a_s FROM fixtures WHERE ateam=\"$TEAM\" and season='$sea' and `div`='$away_div'  and a_s<>'P' and a_s>''";
		
		if ($db=='eu'){
		    $temp = $eu->prepare($query1) ;
		}else{
		    $temp = $sa->prepare($query1);
		}
		$temp->execute();			  
		
		// set to zero
		for ($i=0; $i<=6; $i++):
			$gf[$i]= 0;
			$ga[$i]= 0;
		endfor;
		
		while ($d2 = $temp->fetch() ):
				
			switch ($d2["a_s"]) {
				case 0:	$gf[0]++ ; break;
				case 1:	$gf[1]++ ; break;
				case 2:	$gf[2]++ ; break;
				case 3:	$gf[3]++ ; break;
				case 4:	$gf[4]++ ; break;
				case 5:	$gf[5]++ ; break;
				default: $gf[6]++; break;
			}

			switch ($d2["h_s"]) {
				case 0:	$ga[0]++ ; break;
				case 1:	$ga[1]++ ; break;
				case 2:	$ga[2]++ ; break;
				case 3:	$ga[3]++ ; break;
				case 4:	$ga[4]++ ; break;
				case 5:	$ga[5]++ ; break;
				default: $ga[6]++; break;
			}
		endwhile;
		//find max gf, ga
		$Max_Gf = max($gf);
		$Max_Ga = max($ga);
		
		for ($i=0; $i<=6; $i++):
			echo "<tr " . rowcol($i) . ">\n";
			echo "<td class='ctd'>" . ($i==6? ">5" : $i) . "</td>\n";
			echo "<td class='ctd' ". ($Max_Gf==$gf[$i]? $myStyle : "") . ">" . $gf[$i] . "</td>";
			echo "<td class='ctd' ". ($Max_Ga==$ga[$i]? $myStyle2 : "") .">" . $ga[$i] . "</td>";
			echo "</tr>\n";
		endfor;
	  ?>
	</table>

			 

<? endif;?>

</div>