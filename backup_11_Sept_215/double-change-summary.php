<? session_start();

include("config.ini.php");

include("function.ini.php");
	
	

$parts = explode(',',$_GET['BET']) ;

$BET   = $parts[0] ;
$RESULT= $parts[1] ;
$SEASON= $parts[2] ;

$db = $_GET['db'];



if ($RESULT=='H') :  
	$cap = " HOMES "; 
	$c = "HW";
elseif ($RESULT=='A'):  
	$cap = " AWAYS "; $c = "AW";
else :
	 $cap = " DRAWS ";  $c = "AD";
endif;


$seleURL = "cur-double-sele.php?PARA=$SEASON,$BET,$c," ;

$pageURL = "?BET=$BET,$RESULT,$SEASON";

$prtURL = "print.php?msg=Prediction Performance"; 

$cur = cur_week($db);


$page_title = s_title($db). " Season $SEASON " .  selection_type($BET) . " $cap Double Chance Hit Rate";
include("header.ini.php");


page_header("Analysis of Previous Predictions") ;

$string  = "`season`='$SEASON' and `bettype`='$BET' and `matchtype`='$RESULT'";


$mywin = "mywin";
$window ='<a class="pp" href="javascript:sele_win(';
$window .= "'" ;



?>

<!-- startprint -->

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;"><?echo site($db);?></div>

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;padding-top:10px;padding-bottom:10px;">DOUBLE CHANCE HIT RATE</div>

<table  width="100%" align="center">
<tr>
	<td><?php echo back();?></td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"><? echo printscr(); ?></td>
</tr>
</table>



<? if ($RESULT<>"D"): ?>

<p style="padding-top:0">This shows you the "hit rate" associated with calling the "Double Chance" option in respect of the Segregated Selection's Top 6 matches.</p>
<br />

<table border="1" width="500" align="center" cellpadding="3" cellspacing="0"  style="border-collapse: collapse" bgcolor="#F6F6F6" bordercolor="#cccccc">
 <tr>

     <td align='center' height="12"  bgcolor="#D3EBAB" colspan="5">
		 <b><span class='big'>
     <?   
      
          echo selection_type($BET) . $cap . $SEASON  ;
       
        
     ?>
    </span>
	  </td>
	</tr>
    <tr bgcolor="#D3EBAB">
		<td align="center" width='80' ><b>Week No</b></td>
		<td align="center" width='100'><b>Total Calls</b></td>
		<td align="center" width='100'><b>Correct Calls</b></td>
		<td align="center" width='100'><b>Actual Result<br>Was Draw</b></td>
		<td align="center" width='120'><b>Total "DC"<br>Correct Calls</b></td>
     
    </tr>
	<?
		$n=0; $col1=0; $col2=0; $col3=0; $col4=0;
		$qry = "select * from cur_double where $string order by weekno";
        
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
			echo "</tr>\n\n\n" ;
			
			$col1 += $data['total_call'];
			$col2 += $data['1st_correct'];
			$col3 += $data['2nd_correct'];
			$col4 += $data['total_correct'];

		endwhile;

		$nMx = 42;
		for ($j=$num_of_rows+1; $j<=$nMx; $j++):
			 $n++;
			 $rowcol = rowcol($n);
			 echo "<tr $rowcol>";
			 echo "<td class='tdper ctd'>$j</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "</tr>\n\n";
		endfor;

		 echo "<tr bgcolor='#f4f4f4'>";
		 echo "<td align='center'><span class='credit'>TOTAL</span></td>";
		 echo "<td align='center'><span class='credit'>" . num0($col1) .  "</span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num0($col2) .  "</span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num0($col3). "</span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num0($col4). "</span></td>"; 
		 echo "</tr>\n\n";

		 echo "<tr bgcolor='#f4f4f4'>";
		 echo "<td align='center'><span class='credit'></span></td>";
		 echo "<td align='center'><span class='credit'></span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num2( ($col2/$col1)*100) .  "%</span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num2( ($col3/$col1)*100) . "%</span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num2( ($col4/$col1)*100). "%</span></td>"; 
		 echo "</tr>\n\n";


	?>

		<tr bgcolor="#D3EBAB">
		<td align="center" width='80' ><b>Week No</b></td>
		<td align="center" width='100'><b>Total Calls</b></td>
		<td align="center" width='100'><b>Correct Calls</b></td>
		<td align="center" width='100'><b>Actual Result<br>Was Draw</b></td>
		<td align="center" width='120'><b>Total "DC"<br>Correct Calls</b></td>
     
    </tr>
</table>
<BR><BR>
<? endif; ?>


<? if ($RESULT=="D"): ?>

<p style="padding-top:0">This shows you the "hit rate" associated with calling the "Double Chance" option in respect of the Segregated Selection's Top 6 matches, where the Bookies' Lowest "Standard 1X2 Odds" decide the alternative call (Home or Away).</p>
<br />

<table border="1" width="500" align="center" cellpadding="3" cellspacing="0" id="AutoNumber4" height="30" style="border-collapse: collapse" bgcolor="#F6F6F6" align="center" bordercolor="#cccccc">
 <tr>

     <td align='center' height="12"  bgcolor="#D3EBAB" colspan="5">
		 <b><span class='big'>
     <? echo "Weekend DRAWS " . $SEASON ;?>
     </span>
	  </td>
	</tr>
    <tr bgcolor="#D3EBAB">
		<td align="center" width='80' ><b>Week No</b></td>
		<td align="center" width='100'><b>Total Calls</b></td>
		<td align="center" width='100'><b>Actual Draws</b></td>
		<td align="center" width='100'><b>Home/Away "DC" Correct Calls</b></td>
		<td align="center" width='120'><b>Total "DC"<br>Correct Calls</b></td>
     
    </tr>
	<?
		$n=0; $col1=0; $col2=0; $col3=0; $col4=0;
		$qry = mysql_query("select * from cur_double where $string order by weekno") or die(mysql_error());
		while ($data= mysql_fetch_array($qry)):
			$n++;
		    $rowcol = rowcol($n);
			$num_of_rows = $data["weekno"];

			echo "<tr $rowcol>\n\n";
			echo "<td class='tdper ctd'>" . $data["weekno"] . "</td>\n" ;

			echo "<td class='tdper ctd'>"; 
			
			if ($data["total_call"]>0):
				echo $window ;
				echo $seleURL . $data["weekno"]. "')\">". num0($data["total_call"]) . "</a></td>";
			else:
				echo num0($data["total_call"]) . "</td>";
			endif;

			echo "<td class='tdper ctd'>" . num0($data['1st_correct']) .  "</td>"; 
			echo "<td class='tdper ctd'>" . num0($data['2nd_correct']) .  "</td>"; 
			echo "<td class='tdper ctd'>" . num0($data['total_correct']). "</td>"; 
			echo "</tr>\n\n\n" ;
			
			$col1 += $data['total_call'];
			$col2 += $data['1st_correct'];
			$col3 += $data['2nd_correct'];
			$col4 += $data['total_correct'];

		endwhile;

		$nMx = 42;
		for ($j=$num_of_rows+1; $j<=$nMx; $j++):
			 $n++;
			 $rowcol = rowcol($n);
			 echo "<tr $rowcol>";
			 echo "<td align='center'>$j</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "</tr>\n\n";
		endfor;

		 echo "<tr bgcolor='#f4f4f4'>";
		 echo "<td align='center'><span class='credit'>TOTAL</span></td>";
		 echo "<td align='center'><span class='credit'>" . num0($col1) .  "</span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num0($col2) .  "</span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num0($col3). "</span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num0($col4). "</span></td>"; 
		 echo "</tr>\n\n";

		 echo "<tr bgcolor='#f4f4f4'>";
		 echo "<td align='center'><span class='credit'></span></td>";
		 echo "<td align='center'><span class='credit'></span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num2( ($col2/$col1)*100) .  "%</span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num2( ($col3/$col1)*100) . "%</span></td>"; 
		 echo "<td align='center'><span class='credit'>" . num2( ($col4/$col1)*100). "%</span></td>"; 
		 echo "</tr>\n\n";


	?>

		<tr bgcolor="#D3EBAB">
		<td align="center" width='80' ><b>Week No</b></td>
		<td align="center" width='100'><b>Total Calls</b></td>
		<td align="center" width='100'><b>Actual Draws</b></td>
		<td align="center" width='100'><b>Home/Away "DC" Correct Calls</b></td>
		<td align="center" width='120'><b>Total "DC"<br>Correct Calls</b></td>
     
    </tr>
	
</table>
<BR><BR>
<? endif; ?>


 <!-- stopprint -->

<? include("footer.ini.php"); 



?>
