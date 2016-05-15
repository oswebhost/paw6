<? session_start();

include("config.ini.php");

include("function.ini.php");
	
	

$parts = explode(',',$_GET['BET']	) ;
$BET   = $parts[0] ;
$RESULT= $parts[1] ;
$SEASON= $parts[2] ;
$db    = $parts[3];


if ($RESULT=='H') :  
	$cap = " HOME CALLS "; 
	$c = "HW";
elseif ($RESULT=='A'):  
	$cap = " AWAY CALLS "; $c = "AW";
else :
	 $cap = " DRAWS ";  $c = "AD";
endif;


$seleURL = "cur-double-bet-sele.php?PARA=$SEASON,$BET,$c," ;

$pageURL = "?BET=$BET,$RESULT,$SEASON";

$prtURL = "print.php?msg=Prediction Performance"; 

$cur = cur_week($db);


$page_title = "$SEASON ". selection_type($BET) . " " . s_title($db) ." Double Chance Betting Outcome";


include("header.ini.php");


page_header("Analysis of Previous Predictions");


$string  = "`season`='$SEASON' and `bettype`='$BET' and `matchtype`='$RESULT'";


$mywin = "mywin";
$window ='<a class="pp" href="javascript:sele_win(';
$window .= "'" ;



?>
<TABLE  width="98%" class='ctd'>
<TR>
	<TD><?php echo back();?></TD>
	<TD align="right"> <? echo printscr(); ?></TD>
</TR>
</TABLE>

<div style="padding-bottom:5px"></div>

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;"><?echo site($db);?></div>
<div style="padding-bottom:5px"></div>
<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">DOUBLE CHANCE BETTING OUTCOME</div>


<!-- startprint -->

<? if ($RESULT<>"D"): ?>

<p>This shows you the running financial outcome to date if you had bet each week on the "Double Chance" option in respect of the Segregated Selection's Top 6 matches.</p>


<BR>
<table border="1" width="90%" class='ctd' cellpadding="3" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bgcolor="#F6F6F6"  bordercolor="#cccccc">
 <tr>

     <td class='ctd' height="12"  bgcolor="#D3EBAB" colspan="6">
		 <b><span class='big'><? echo selection_type($BET) . $cap . $SEASON ;?></span>
	  </td>
	</tr>
    <tr bgcolor="#D3EBAB">
		<td class='ctd' width='80' ><b>Week No</b></td>
		<td class='ctd' width='100'><b>Total Calls</b></td>
		<td class='ctd' width='100'><b>Correct Calls</b></td>
		<td class='ctd' width='100'><b>Actual Result<br>Was Draw</b></td>
		<td class='ctd' width='120'><b>Totals "DC"<br>Correct Calls</b></td>
		<td class='ctd' width='120'><b>Net Return (Units)</b></td>
    </tr>
	<?  
		$n=0; $col1=0; $col2=0; $col3=0; $col4=0; $col5=0;
		$qry = "select * from cur_double_bet where $string order by weekno";
		 if ($db=='eu'){
		    $temp = $eu->prepare($qry) ;
		 }else{
		    $temp = $sa->prepare($qry);
		 }
		 $temp->execute();

		while ($data= $temp->fetch()):
			$n++;
		    $rowcol = rowcol($n);
			$num_of_rows = $data["weekno"];

			echo "<tr $rowcol>\n\n";
			echo "<td class='tdper ctd'>" . $data["weekno"] . "</td>\n" ;

			echo "<td class='tdper ctd'>"; 
			
			if ($data["total_call"]>0):
				echo $window ;
				echo $seleURL . $data["weekno"]. "&db=$db')\">". num0($data["total_call"]) . "</a></td>";
			else:
				echo num0($data["total_call"]) . "</td>";
			endif;

			echo "<td class='tdper ctd'>" . num0($data['1st_correct']) .  "</td>"; 
			echo "<td class='tdper ctd'>" . num0($data['2nd_correct']) .  "</td>"; 
			echo "<td class='tdper ctd'>" . num0($data['total_correct']). "</td>"; 
			echo "<td class='tdper ctd'>" . num20($data['odd_return'] - $data["total_call"]). "</td>"; 
			echo "</tr>\n\n\n" ;
			
			$col1 += $data['total_call'];
			$col2 += $data['1st_correct'];
			$col3 += $data['2nd_correct'];
			$col4 += $data['total_correct'];
			$col5 += $data['odd_return'] - $data["total_call"];

		endwhile;

		$nMx = 50;
		for ($j=$num_of_rows+1; $j<=$nMx; $j++):
			 $n++;
			 $rowcol = rowcol($n);
			 echo "<tr $rowcol>";
			 echo "<td class='tdper ctd'>$j</td>";
			 echo "<td>&nbsp;</td>";
			 echo "<td>&nbsp;</td>";
			 echo "<td>&nbsp;</td>";
			 echo "<td>&nbsp;</td>";
			 echo "<td>&nbsp;</td>";
			 echo "</tr>\n\n";
		endfor;

		 echo "<tr bgcolor='#f4f4f4'>";
		 echo "<td class='ctd'><span class='credit'>TOTAL</span></td>";
		 echo "<td class='ctd'><span class='credit'>" . num0($col1) .  "</span></td>"; 
		 echo "<td class='ctd'><span class='credit'>" . num0($col2) .  "</span></td>"; 
		 echo "<td class='ctd'><span class='credit'>" . num0($col3). "</span></td>"; 
		 echo "<td class='ctd'><span class='credit'>" . num0($col4). "</span></td>"; 
		  echo "<td class='ctd'><span class='credit'>" . num20($col5). "</span></td>";
		 echo "</tr>\n\n";

		 echo "<tr bgcolor='#f4f4f4'>";
		 echo "<td class='ctd' ><span class='credit'></span></td>";($_rt_get==1? 1 : 0 ) ;
		 echo "<td class='ctd' ><span class='credit'></span></td>"; 
		 echo "<td class='ctd' ><span class='credit'>" . num2( ($col2/($col1>1? $col1 :1))*100). "%</span></td>"; 
		 echo "<td class='ctd' ><span class='credit'>" . num2( ($col3/($col1>1? $col1 :1))*100). "%</span></td>"; 
		 echo "<td class='ctd' ><span class='credit'>" . num2( ($col4/($col1>1? $col1 :1))*100). "%</span></td>"; 
		 echo "</tr>\n\n";


	?>
	
	

		<tr bgcolor="#D3EBAB">
		<td class='ctd' width='80' ><b>Week No</b></td>
		<td class='ctd' width='100'><b>Total Calls</b></td>
		<td class='ctd' width='100'><b>Correct Calls</b></td>
		<td class='ctd' width='100'><b>Actual Result<br>Was Draw</b></td>
		<td class='ctd' width='120'><b>Total "DC"<br>Correct Calls</b></td>
		<td class='ctd' width='120'><b>Net Return (Units)</b></td>
     
    </tr>
</table>
<BR><BR>
<? endif; ?>


<? if ($RESULT=="D"): ?>


<p>
This shows you the running outcome to date if you had bet each week on the "Double Chance" against the Segregated Selections, where the Bookies' Lowest "Standard 1X2" Odds decide the alternative call (Home or Away).
</p>
<br>

<table border="1" width="90%" class='ctd' cellpadding="3" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bgcolor="#F6F6F6" bordercolor="#cccccc">
 <tr>

     <td class='ctd' height="12"  bgcolor="#D3EBAB" colspan="6">
		 <b><span class='big'>Weekend DRAWS <? echo $SEASON ;?></span>
	  </td>
	</tr>
    <tr bgcolor="#D3EBAB">
		<td class='ctd' width='80' ><b>Week No</b></td>
		<td class='ctd' width='100'><b>Total Calls</b></td>
		<td class='ctd' width='100'><b>Actual Draws</b></td>
		<td class='ctd' width='100'><b>Home/Away "DC" Correct Calls</b></td>
		<td class='ctd' width='120'><b>Total "DC"<br>Correct Calls</b></td>
		<td class='ctd' width='120'><b>Net Return (Units)</b></td>
    </tr>
	<?
		$n=0; $col1=0; $col2=0; $col3=0; $col4=0; $col5=0;
		$qry = "select * from cur_double_bet where $string order by weekno";
		 if ($db=='eu'){
		    $temp = $eu->prepare($qry) ;
		 }else{
		    $temp = $sa->prepare($qry);
		 }
		 $temp->execute();

		while ($data= $temp->fetch()):
			$n++;
		    $rowcol = rowcol($n);
			$num_of_rows = $data["weekno"];

			echo "<tr $rowcol>\n\n";
			echo "<td class='tdper ctd'>" . $data["weekno"] . "</td>\n" ;

			echo "<td class='tdper ctd'>"; 
			
			if ($data["total_call"]>0):
				echo $window ;
				echo $seleURL . $data["weekno"]. "&db=$db')\">". num0($data["total_call"]) . "</a></td>";
			else:
				echo num0($data["total_call"]) . "</td>";
			endif;

			echo "<td class='tdper ctd'>" . num0($data['1st_correct']) .  "</td>"; 
			echo "<td class='tdper ctd'>" . num0($data['2nd_correct']) .  "</td>"; 
			echo "<td class='tdper ctd'>" . num0($data['total_correct']). "</td>"; 
			echo "<td class='tdper ctd'>" . num20($data['odd_return'] - $data["total_call"]). "</td>"; 
			echo "</tr>\n\n\n" ;
			
			$col1 += $data['total_call'];
			$col2 += $data['1st_correct'];
			$col3 += $data['2nd_correct'];
			$col4 += $data['total_correct'];
			$col5 += $data['odd_return'] - $data["total_call"];

		endwhile;

		$nMx = 50;
		for ($j=$num_of_rows+1; $j<=$nMx; $j++):
			 $n++;
			 $rowcol = rowcol($n);
			 echo "<tr $rowcol>";
			 echo "<td class='tdper ctd'>$j</td>";
			 echo "<td class='ctd'>&nbsp;</td>";
			 echo "<td class='ctd'>&nbsp;</td>";
			 echo "<td class='ctd'>&nbsp;</td>";
			 echo "<td class='ctd'>&nbsp;</td>";
			 echo "<td class='ctd'>&nbsp;</td>";
			 echo "</tr>\n\n";
		endfor;

		 echo "<tr bgcolor='#f4f4f4'>";
		 echo "<td class='ctd'><span class='credit'>TOTAL</span></td>";
		 echo "<td class='ctd'><span class='credit'>" . num0($col1) .  "</span></td>"; 
		 echo "<td class='ctd'><span class='credit'>" . num0($col2) .  "</span></td>"; 
		 echo "<td class='ctd'><span class='credit'>" . num0($col3). "</span></td>"; 
		 echo "<td class='ctd'><span class='credit'>" . num0($col4). "</span></td>"; 
		 echo "<td class='ctd'><span class='credit'>" . num20($col5). "</span></td>";
		 echo "</tr>\n\n";

		 echo "<tr bgcolor='#f4f4f4'>";
		 echo "<td class='ctd'><span class='credit'></span></td>";
		 echo "<td class='ctd'><span class='credit'></span></td>"; 
		 echo "<td class='ctd'><span class='credit'>" . num2( ($col2/$col1)*100) .  "%</span></td>"; 
		 echo "<td class='ctd'><span class='credit'>" . num2( ($col3/$col1)*100) . "%</span></td>"; 
		 echo "<td class='ctd'><span class='credit'>" . num2( ($col4/$col1)*100). "%</span></td>"; 
		 echo "</tr>\n\n";


	?>

		<tr bgcolor="#D3EBAB">
		<td class='ctd' width='80' ><b>Week No</b></td>
		<td class='ctd' width='100'><b>Total Calls</b></td>
		<td class='ctd' width='100'><b>Actual Draws</b></td>
		<td class='ctd' width='100'><b>Home/Away "DC" Correct Calls</b></td>
		<td class='ctd' width='120'><b>Total "DC"<br>Correct Calls</b></td>
		<td class='ctd' width='120'><b>Net Return (Units)</b></td>
     
    </tr>
</table>
<BR><BR>
<? endif; ?>


 <!-- stopprint -->

<? include("footer.ini.php"); 



?>
