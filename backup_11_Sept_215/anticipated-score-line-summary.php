<? 

include("config.ini.php");
$java_ = -1 ;
include("function.ini.php");

if (isset($_GET['BET'])):
	$parts = explode(",", $_GET['BET']);
	$BET= $parts[0];
	$RESULT= $parts[1];
endif;
if ( count($parts)>2):
	$SEASON= $parts[2] ;
else:
	$SEASON= $season;
endif;

if (isset($_GET['season'])):
	$SEASON=$_GET['season'];
endif;

$db = $_GET['db'];

if ($RESULT=='HW') :  
	$cap = " HOMES "; 
elseif ($RESULT=='AW'):  
	$cap = " AWAYS ";
else :
	 $cap = " DRAWS ";
endif;

$pageURL = "?BET=$BET,$RESULT,$SEASON";

$string  = "`season`='$SEASON' and `bettype`='$BET' and `matchtype`='$RESULT'";

$seleURL = "selections-details.php?PARA=$SEASON,$BET," ;

$mywin = "mywin";
$window ='&nbsp;<a class="sbar" href="javascript:sele_win(';
$window .= "'" ;

include("page-header.ini.php");

?>
<link rel="stylesheet" type="text/css" href="css/style_v4.css">
<title>Analysis of Previous Predictions</title>

<? page_header("Analysis of Previous Predictions") ; ?>


<!-- startprint -->


<style>
	#td  {text-align:center;font-weight:bold;vertical-align:bottom;}
	#td3 {text-align:center;font-weight:bold;vertical-align:top;}
	#td2 {text-align:center;}
</style>

<center>
<div style='width:850px;padding:5px;margin:5px;font-size:12px;border:1px solid #78CC00;background:#fEfffdf;font-weight:bold;'>
	This shows you the running outcome to date of the nearness (or otherwise) of 
	the posted score-lines in respect of the Segregated Selection's Top 6 "1X2" ("Result Type") calls.
	</div>


<table border="1" width="100%" align="center" cellpadding="1" cellspacing="0" style="border-collapse: collapse" bgcolor="#F6F6F6"  bordercolor="#cccccc">
 <tr>

  <? if ($RESULT=="AD"): ?>
     <td align='center' height="12"  bgcolor="#D3EBAB" colspan="16">
   <? else: ?>
	 <td align='center' height="12"  bgcolor="#D3EBAB" colspan="15">
	<? endif;?>

		 <b><span class='big'><? echo selection_type($BET) . " 1X2 Score-Line Hit/Miss Data - " . $cap . $SEASON ;?></span>
	  </td>
	</tr>
    <tr bgcolor="#D3EBAB">
		<td id='td'><img src='images/cols/wkno.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col1.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col22.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col3.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col4.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col5.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col6.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col7.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col8.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col9.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col10.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col11.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col12.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col13.gif' border='0' alt=''></td>
		<? if ($RESULT=="AD"): ?>
			<td id='td'><img src='images/cols/col14.gif' border='0' alt=''></td>
			<td id='td'><img src='images/cols/col15.gif' border='0' alt=''></td>
		<? elseif ($RESULT=="HW") : ?>
			<td id='td'><img src='images/cols/col15.gif' border='0' alt=''></td>
		<? elseif ($RESULT=="AW"): ?>
			<td id='td'><img src='images/cols/col14.gif' border='0' alt=''></td>
		<? endif; ?>
    </tr>


<?		
		$n=0; $col1=0; $col2=0; $col3=0; $col4=0;$col5=0;$col5=0;$col6=0;$col7=0;$col8=0;$col9=0;
		$col10=0;$col11=0;$col12=0;$col13=0;$col14=0;$col15=0;

		$qry = "select * from cur_cshit where $string order by weekno";
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
			echo "<td id='td2'>" . $window . $seleURL . $data["weekno"]. ",$RESULT,$db')\">" . $data["weekno"] . "</a></td>\n" ;

			echo "<td id='td2'>" . num0($data['col1']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col2']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col3']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col4']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col5']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col6']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col7']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col8']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col9']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col10']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col11']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col12']) .  "</td>"; 
			echo "<td id='td2'>" . num0($data['col15']) .  "</td>"; 

			if ($RESULT=='AD'):
				echo "<td id='td2'>" . num0($data['col13']) .  "</td>"; 
				echo "<td id='td2'>" . num0($data['col14']) .  "</td>"; 
			elseif ($RESULT=="HW"):
				echo "<td id='td2'>" . num0($data['col14']) .  "</td>"; 
			elseif ($RESULT=="AW"):
				echo "<td id='td2'>" . num0($data['col13']) .  "</td>"; 
			endif;
			echo "</tr>\n\n\n" ;
			
			$col1  += $data['col1'];
			$col2  += $data['col2'];
			$col3  += $data['col3'];
			$col4  += $data['col4'];
			$col5  += $data['col5'];
			$col6  += $data['col6'];
			$col7  += $data['col7'];
			$col8  += $data['col8'];
			$col9  += $data['col9'];
			$col10 += $data['col10'];
			$col11 += $data['col11'];
			$col12 += $data['col12'];
			$col13 += $data['col13'];
			$col14 += $data['col14'];
			$col15 += $data['col15'];
		
		endwhile;

		$nMx = 50;
		for ($j=$num_of_rows+1; $j<=$nMx; $j++):
			 $n++;
			 $rowcol = rowcol($n);
			 echo "<tr $rowcol>";
			 echo "<td align='center'>$j</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 echo "<td align='center'>&nbsp;</td>";
			 if ($RESULT=='AD'):
				 echo "<td id='td2'></td>"; 
			 endif;
			 echo "<td align='center'>&nbsp;</td>";
			 echo "</tr>\n\n";
		endfor;

		echo "<tr bgcolor='#f4f4f4'>";
		echo "<td align='center'><span class='credit'>TOTAL</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col1) .  "</span></td>"; 
		echo "<td align='center'><span class='credit'>" . num0($col2) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col3) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col4) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col5) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col6) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col7) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col8) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col9) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col10) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col11) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col12) .  "</span></td>";
		echo "<td align='center'><span class='credit'>" . num0($col15) .  "</span></td>";
		if ($RESULT=="AD") : 
			echo "<td align='center'><span class='credit'>" . num0($col13) .  "</span></td>";
			echo "<td align='center'><span class='credit'>" . num0($col14) .  "</span></td>";
		elseif($RESULT=="HW"):
			echo "<td align='center'><span class='credit'>" . num0($col14) .  "</span></td>";
		elseif($RESULT=="AW"):
			echo "<td align='center'><span class='credit'>" . num0($col13) .  "</span></td>";
		endif;
		echo "</tr>\n\n";

		echo "<tr bgcolor='#f4f4f4'>";
		echo "<td align='center'><span class='credit'></span></td>";
		echo "<td align='center'><span class='credit'></span></td>";

		if ($col1==0){ $col1=1;}

		echo "<td align='center'  bgcolor='#ffffff'><span class='credit'>" . num2( ($col2/$col1)*100) .  "%</span></td>"; 
		echo "<td align='center' bgcolor='#DBEEF3'><span class='credit'>" . num2( ($col3/$col1)*100) .  "%</span></td>"; 
		echo "<td align='center' bgcolor='#FDE9D9'><span class='credit'>" . num2( ($col4/$col1)*100) .  "%</span></td>"; 
		echo "<td align='center' bgcolor='#DBEEF3'><span class='credit'>" . num2( ($col5/$col1)*100) .  "%</span></td>"; 
		echo "<td align='center' bgcolor='#DBEEF3'><span class='credit'>" . num2( ($col6/$col1)*100) .  "%</span></td>"; 
		echo "<td align='center' bgcolor='#FDE9D9'><span class='credit'>" . num2( ($col7/$col1)*100) .  "%</span></td>"; 
		echo "<td align='center' bgcolor='#FDE9D9'><span class='credit'>" . num2( ($col8/$col1)*100) .  "%</span></td>"; 
		echo "<td align='center' bgcolor='#DBEEF3'><span class='credit'>" . num2( ($col9/$col1)*100) .  "%</span></td>"; 
		echo "<td align='center' bgcolor='#DBEEF3'><span class='credit'>" . num2( ($col10/$col1)*100) .  "%</span></td>"; 
		echo "<td align='center' bgcolor='#FDE9D9'><span class='credit'>" . num2( ($col11/$col1)*100) .  "%</span></td>"; 
		echo "<td align='center' bgcolor='#FDE9D9'><span class='credit'>" . num2( ($col12/$col1)*100) .  "%</span></td>"; 
		
		if ($RESULT=="HW") : 
			echo "<td align='center' bgcolor='#D3EBAB'><span class='credit'>" . num2( ($col15/$col1)*100) .  "%</span></td>"; 
			echo "<td align='center' bgcolor='#FDE9D9'><span class='credit'>" . num2( ($col13/$col1)*100) .  "%</span></td>"; 
		endif;

		if ($RESULT=="AW") : 
			echo "<td align='center' bgcolor='#D3EBAB'><span class='credit'>" . num2( ($col15/$col1)*100) .  "%</span></td>"; 

			echo "<td align='center' bgcolor='#DBEEF3'><span class='credit'>" . num2( ($col13/$col1)*100) .  "%</span></td>"; 
		endif;


		if ($RESULT=="AD") : 
			echo "<td align='center' bgcolor='#D3EBAB'><span class='credit'>" . num2( ($col15/$col1)*100) .  "%</span></td>"; 

			echo "<td align='center' bgcolor='#DBEEF3'><span class='credit'>" . num2( ($col13/$col1)*100) .  "%</span></td>"; 

			echo "<td align='center' bgcolor='#FDE9D9'><span class='credit'>" . num2( ($col14/$col1)*100) .  "%</span></td>"; 
		endif;


		echo "</tr>\n\n";

 ?>
  <tr bgcolor="#D3EBAB">
		<td id='td'><img src='images/cols/wkno-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col1-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col22-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col3-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col4-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col5-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col6-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col7-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col8-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col9-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col10-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col11-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col12-b.gif' border='0' alt=''></td>
		<td id='td'><img src='images/cols/col13-b.gif' border='0' alt=''></td>

		<? if ($RESULT=="AD"): ?>
			<td id='td'><img src='images/cols/col14-b.gif' border='0' alt=''></td>
			<td id='td'><img src='images/cols/col15-b.gif' border='0' alt=''></td>
		<? elseif ($RESULT=="HW") : ?>
			<td id='td'><img src='images/cols/col15-b.gif' border='0' alt=''></td>
		<? elseif ($RESULT=="AW"): ?>
			<td id='td'><img src='images/cols/col14-b.gif' border='0' alt=''></td>
		<? endif; ?>
    </tr>

</table>

 <!-- stopprint -->

<!-- END OF Info Box--->
<div style="padding-bottom:8px"></div>
<TABLE   width="98%" align="center" border='0'>
<TR>
	<TD width='95%' align='center'><A HREF="javascript:close()" class='sbar'>x Close this window x</A> </TD> 
	<TD align="right"> <? echo printscr(); ?></TD>
</TR>
</TABLE>


</center>

<!-- END OF other division box--->