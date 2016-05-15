<?php

session_start() ;

$q1=""; $q2="";$q3="";

if ($loc =="Home" ){ 

	$team = $_SESSION['home'];
	$q1= "select season,mdate,ateam,`div`,h_s,a_s from fixtures where hteam=\"$home\" and ateam=\"$away\" and mvalue<>'0' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by season desc, mid desc";
	
	$q3 = "select season, mdate,ateam,`div`,h_s,a_s from old_fixt where hteam=\"$home\" and ateam=\"$away\" and `div`<>'FA' and `div`<>'SA' and `div`<>'IN'  order by season desc, mdate desc";


}elseif($loc =="Away" ){ 
	
	$team = $_SESSION['away'] ; 

    $q1= "select season,mdate,ateam,`div`,h_s,a_s from fixtures where hteam=\"$away\" and ateam=\"$home\" and mvalue<>'0' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by season desc, mid desc";
	
	$q3 = "select season,ateam,mdate, `div`,h_s,a_s from old_fixt where hteam=\"$away\" and ateam=\"$home\" and `div`<>'FA' and `div`<>'SA' and `div`<>'IN'  order by season desc, mdate desc";
    
    
}



?>





<table border='1' cellpadding='2' cellspacing='0' width='99%' align='center'  style="border-collapse: collapse"  bordercolor="#cccccc">
	<tr bgcolor="#D3EBAB">
		<td width='13%'  class='ctd padd'><B>Sea.</B></td>
		<td width='10%'  class='ctd'><B>Div</B></td>
		<td width='30%'  class='ctd'><B>Away Team</B></td>
		<td width='15%'  class='ctd'><B>Score</B></td>
		<td width='15%'  class='ctd'><B>Result</B></td>
	</tr>
	
	<?php

		$curwk = cur_week($db);
		$h=$a=$d=$th=$ta=$td=0;
		// current season data
		if ($db=='eu'){
			$temp = $eu->prepare($q1);
		}else{
			$temp = $sa->prepare($q1);
		}
		$temp->execute();		
		$n =0 ;	

		while ($d = $temp->fetch()) {
			$n++; 
			$rowcol = rowcol($n);
			
			echo "<tr $rowcol>\n";

			if ($db=='eu'){
				echo "<td class='ctd padd'>" . substr($d['season'],2,2) ."-".substr($d['season'],7,2) . "</td>\n";
			}else{
				echo "<td class='ctd padd'>" . $d['season'] . "</td>\n";
			}
			
			echo "<td class='ctd'>" . $d[div] . "</td>\n";
			echo "<td class='ltd'>" . $d[ateam] . "</td>\n";
			echo "<td class='ctd'>" . $d[h_s] ."-". $d[a_s] . "</td>\n";
			echo "<td class='ctd'>" . res(trim($d['h_s']), trim($d['a_s'])) . "</td>\n";
			echo "</tr>\n";
            
			$h += $d['h_s']; 
			$a += $d['a_s'];
			$th += (res(trim($d['h_s']), trim($d['a_s']))=="<b>Win</b>"? 1: 0) ;
			$ta += (res(trim($d['h_s']), trim($d['a_s']))=="Loss"? 1: 0) ;
			$td += (res(trim($d['h_s']), trim($d['a_s']))=="Draw"? 1: 0) ;
		}

		// Past season data
		unset($q);
		unset($d);

		if ($db=='eu'){
			$temp = $eu->prepare($q2);
		}else{
			$temp = $sa->prepare($q2);
		}
		$temp->execute();			

		while ($d2 = $temp->fetch()) {
			$n++; 
			$rowcol = rowcol($n);
			
			echo "<tr $rowcol>\n";
			echo "<td class='ctd padd' >" . substr($d2['season'],2,2) ."-".substr($d2['season'],7,2) . "</td>\n";
			echo "<td class='ctd'>" . $d2[div] . "</td>\n";
			echo "<td align='left'>" . $d2[ateam] . "</td>\n";
			echo "<td class='ctd'>" . $d2[h_s] ."-". $d2[a_s] . "</td>\n";
			echo "<td class='ctd'>" . res(trim($d2['h_s']), trim($d2['a_s'])) . "</td>\n";
			echo "</tr>\n";
			$h += $d2['h_s']; 
			$a += $d2['a_s'];
			$th += (res(trim($d2['h_s']), trim($d2['a_s']))=="<b>Win</b>"? 1: 0) ;
			$ta += (res(trim($d2['h_s']), trim($d2['a_s']))=="Loss"? 1: 0) ;
			$td += (res(trim($d2['h_s']), trim($d2['a_s']))=="Draw"? 1: 0) ;
		}
        
        
        // Past season data
		unset($q);
		unset($d);

		if ($db=='eu'){
			$temp = $eu->prepare($q3);
		}else{
			$temp = $sa->prepare($q3);
		}
		$temp->execute();			
		
		while ($d2 = $temp->fetch()) {
			$n++; 
			$rowcol = rowcol($n);
			
			echo "<tr $rowcol>\n";
			echo "<td class='ctd padd' >" . substr($d2['season'],2,2) ."-".substr($d2['season'],7,2) . "</td>\n";
			echo "<td class='ctd'>" . $d2[div] . "</td>\n";
			echo "<td align='left'>" . $d2[ateam] . "</td>\n";
			echo "<td class='ctd'>" . $d2[h_s] ."-". $d2[a_s] . "</td>\n";
			echo "<td class='ctd'>" . res(trim($d2['h_s']), trim($d2['a_s'])) . "</td>\n";
			echo "</tr>\n";
		
			$h += $d2['h_s']; 
			$a += $d2['a_s'];
			$th += (res(trim($d2['h_s']), trim($d2['a_s']))=="<b>Win</b>"? 1: 0) ;
			$ta += (res(trim($d2['h_s']), trim($d2['a_s']))=="Loss"? 1: 0) ;
			$td += (res(trim($d2['h_s']), trim($d2['a_s']))=="Draw"? 1: 0) ;
		}
        
		echo "<tr bgoclor='#ccccc' height='22'>\n"  ;
		echo "<td colspan='5' align='right'> ";
		
		echo "<table width='100%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#999999'>\n\n";
		echo "<tr  >\n";
		echo "<td width='20%' bgcolor='#FFD2FF' class='ctd'><B>GF</B></td>\n";
		echo "<td width='20%' bgcolor='#FFEACA' class='ctd'><B>GA</B></td>\n";
		echo "<td width='20%' bgcolor='#EAEAFF' class='ctd'><B>Win</B></td>\n";
		echo "<td width='20%' bgcolor='#DFFFDF' class='ctd'><B>Draw</B></td>\n";
		echo "<td width='20%' bgcolor='#FFD2D2' class='ctd'><B>Loss</B></td>\n";
		echo "</tr>\n";

		echo "<tr>\n";
		
		echo "<td width='20%' bgcolor='#FFD2FF' class='ctd'><b> $h </b></td>\n";
		echo "<td width='20%' bgcolor='#FFEACA' class='ctd'><b> $a </b></td>\n";
		echo "<td width='20%' bgcolor='#EAEAFF' class='ctd'><b> $th </b></td>\n";
		echo "<td width='20%' bgcolor='#DFFFDF' class='ctd'><b> $td </b></td>\n";
		echo "<td width='20%' bgcolor='#FFD2D2' class='ctd'><b> $ta </b></td>\n";

		echo "</tr>\n";

		echo "</table>\n";

		echo "</td> \n" ;

				
		echo "</tr>\n";

	?>
</table>