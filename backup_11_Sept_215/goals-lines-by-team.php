<?	
session_start();
$lines = array("0", "1", "2", "3", "4", "5",">5");

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
	   <tr><td colspan='8' class='ctd'><B>When Home: <?=$cap?></B>
	   <? if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
	   </td></tr>
	  <tr bgcolor="#f4f4f4">
	   <td width='16%'>&nbsp;</td>
	   <?
		for ($i=0; $i<count($lines); $i++):
			echo "<td width='12%' style='color:red;text-align:center;font-weight:bold'>". $lines[$i] ."</td>\n";
		endfor;
	   ?>
	  </tr>
	  <?
	  $query1 = "SELECT h_s, a_s FROM fixtures WHERE hteam=\"$TEAM\" and season='$sea' and `div`='$home_div'  and h_s<>'P' and h_s>''";
	  		// set to zero
		for ($i=0; $i<=count($lines)-1; $i++):
			for ($j=0; $j<=count($lines)-1; $j++):
			   $gline[$i][$j] = 0;	
			endfor;
		endfor;
		
		if ($db=='eu'){
		    $temp = $eu->prepare($query1) ;
		}else{
		    $temp = $sa->prepare($query1);
		}
		$temp->execute();
		
		while ($d = $temp->fetch() ) :
			$hs = $d["h_s"] ; $as= $d["a_s"];
	
			$gline[ ($hs>5? 6: $hs)][ ($as>5? 6 : $as)] ++ ;
	
		endwhile;
		
		for ($i=0; $i<=count($lines)-1; $i++):
			echo "<tr>";
			echo "<td  style='color:blue;text-align:center;font-weight:bold;background:#f4f4f4;'>" . $lines[$i] . "</td>\n";
			for ($j=0; $j<=count($lines)-1; $j++):
				echo "<td class='ctd'><b>" . num00($gline[$i][$j])  . "</b></td>\n";
			endfor;
			echo "</tr>\n";
		endfor;
	 ?>
	</table>

<? else: ?>

	  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#CDCDCD" width="100%">
	   
	   <tr><td colspan='8' class='ctd'><B>When Away: <?=$cap?></B>
	   <? if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
	   </td></tr>
	   <tr bgcolor="#f4f4f4">
	   <td width='16%'>&nbsp;</td>
	   <?
		for ($i=0; $i<count($lines); $i++):
			echo "<td width='12%' style='color:red;text-align:center;font-weight:bold'>". $lines[$i] ."</td>\n";
		endfor;
	   ?>
	  </tr>
	  <?
	  $query1 = "SELECT h_s, a_s FROM fixtures WHERE ateam=\"$TEAM\" and season='$sea' and `div`='$away_div'  and a_s<>'P' and a_s>''";
		
				// set to zero
		for ($i=0; $i<=count($lines)-1; $i++):
			for ($j=0; $j<=count($lines)-1; $j++):
			   $gline[$i][$j] = 0;	
			endfor;
		endfor;

		if ($db=='eu'){
		    $temp = $eu->prepare($query1) ;
		}else{
		    $temp = $sa->prepare($query1);
		}
		$temp->execute();		

		while ($d = $temp->fetch() ) :
			$hs = $d["h_s"] ; $as= $d["a_s"];
	
			$gline[ ($hs>5? 6: $hs)][ ($as>5? 6 : $as)] ++ ;
	
		endwhile;
		
		for ($i=0; $i<=count($lines)-1; $i++):
			echo "<tr>";
			echo "<td  style='color:blue;text-align:center;font-weight:bold;background:#f4f4f4;'>" . $lines[$i] . "</td>\n";
			for ($j=0; $j<=count($lines)-1; $j++):
				echo "<td class='ctd'><b>" . num00($gline[$i][$j])  . "</b></td>\n";
			endfor;
			echo "</tr>\n";
		endfor;
		

	  ?>
	</table>

			 

<? endif;?>

</div>