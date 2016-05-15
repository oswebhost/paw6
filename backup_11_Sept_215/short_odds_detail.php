<?php
 session_start();

  include("config.ini.php") ;
  include("function.ini.php") ;
 
  $max_hodd = 1.75;
  $max_aodd = 1.75;
  $caption = ($_REQUEST[ID]=='A'? "AWAY" : "HOME") ;
  $call    = ($_REQUEST[ID]=='A'? "Away" : "Home") ;
  $order   = ($_REQUEST[ID]=="A"? "a_odd" : "h_odd") ;
  
  if ($_REQUEST[ID]=="H"){
    $sql = "select *,date_format(match_date,'%d-%b-%Y') as m_date from fixtures where season='$_REQUEST[season]' and weekno='$_REQUEST[WK]' " ;
    $sql.= " and `div`<>'RP' and `div`<>'MP' and `div`<>'UP' and mvalue>0 and h_odd>0 and h_odd<='$max_hodd' order by $order" ; 
  }else{
    $sql = "select *,date_format(match_date,'%d-%b-%Y') as m_date from fixtures where season='$_REQUEST[season]' and weekno='$_REQUEST[WK]' " ;
    $sql.= " and `div`<>'RP' and `div`<>'MP' and `div`<>'UP' and mvalue>0 and a_odd>0 and a_odd<='$max_aodd' order by $order" ; 
  }

  
  $temp = $eu->prepare($sql);
  $temp->execute();
  
 
  
  
  

?>


<link rel="stylesheet" type="text/css" href="css/style_v4.css">
<title>Bookies 'Short Odds' Betting Outcomes </title>

<? page_header("Bet on Short Odds") ; ?>

<div style="width:200px;margin:5px auto 10px auto;text-align:center;padding:8px;border:1px solid #ccc;font-size:13px;color:#0000ff;background:#fff;">
	<a class='sbar' href='javascript:window.close();'>Go Back</a>
</div>    


<table border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse" bordercolor="#d6d6d6" width="90%" id="AutoNumber6" align='center' bgcolor="#D3EBAB">
	   <tr height='25'>
		<td colspan="9"  align='center'><span class='big'><? echo "Season " . $_REQUEST[season] . " Week No. " . $_REQUEST[WK] . " " . $caption ?> SHORT ODDS</span></td>
		</tr>
		<tr>
			<td height="40" align="center" width="31" rowspan="2">
			<img src="images/tbcap/refno.gif"  border="0" alt=""></td>
			<td width="100" align="center" width="79" rowspan="2">
			<img src="images/tbcap/date.gif"  border="0" alt=""></td>
			<td height="40" align="center" width="220" rowspan="2">
			<img src="images/tbcap/match.gif"  border="0" alt="">
			</td>
			<td height="40" align="center" width="57" rowspan="2">
			<img src="images/tbcap/div.gif" border="0" alt="">
			</td>
			<td height="20" align="center" colspan="3">
			<img src="images/tbcap/odd.gif" border="0" alt="">
			</td>
						
			</td>

			<td width="80" align="center" width="77" rowspan="2">
			<img src="images/tbcap/actual.gif"  border="0" alt="">	
			</td>
			<td height="40" align="center" width="83" rowspan="2">
			<img src="images/tbcap/correctcall.gif" border="0" alt="">
			</td>
		</tr>
		<tr>
			<td height="20" align="center" width="56"><img src="images/tbcap/home.gif"  border="0" alt=""></td>
			<td height="20" align="center" width="55"><img src="images/tbcap/d.gif"  border="0" alt=""></td>
			<td height="20" align="center" width="60"><img src="images/tbcap/a.gif"  border="0" alt=""></td>
		</tr>

<?
   $n=0; 
	$hw_no=$hw_ct=$hw_rt=$hw_net=$aw_no=$aw_ct=$aw_rt=$aw_net=0;
	
	
	
while ($d = $temp->fetch()){
		$n++;
		$rowcol = rowcol($n);
		$tdh ="";$tda =""; 
		if ($d["gotit"]>0 and $call=='Home'): $tdh =" class='win'"; endif;
		if ($d["gotit"]>0 and $call=='Away'): $tda =" class='win'"; endif;
		
		
		echo "<tr $rowcol>\n" ;
		echo "    <td class='ctd padd'>$n</td>\n" ;
		echo "    <td class='ctd padd'>{$d[m_date]}</td>\n" ;
		echo "    <td class='padd'>&nbsp;{$d[hteam]}"  . red(' v ')  ." {$d[ateam]}</td>\n" ;
		echo "    <td class='ctd padd'>{$d[div]}</td>\n" ;
		echo "    <td class='ctd padd' $tdh>{$d[h_odd]}</td>\n" ;
		echo "    <td class='ctd padd'>{$d[d_odd]}</td>\n" ;
		echo "    <td class='ctd padd' $tda>{$d[a_odd]}</td>\n" ;
		echo "    <td class='ctd padd'>{$d[h_s]}" . '-' ."{$d[a_s]}</td>\n" ;
		if ($d["gotit"]==1) :
			$data = '<IMG SRC="images/tbcap/chked.gif" BORDER="0" ALT="half">' ;
		else:
			$data = 'x' ;
		endif;
		echo "    <td class='ctd padd'>$data</td>\n" ;
		echo "</tr>\n";
		$nc += $d['gotit'];
		if ($d['gotit']>0):
			$total += ($call=='Home'? $d['h_odd'] : $d['a_odd']) ;
		endif;
}

	$td = "class='total'";
	echo "<tr bgcolor='#f4f4f4' height='25'>\n";
	echo "    <td align='right' colspan='4' $td>TOTAL RETURN ON CORRECT CALLS&nbsp;</td>\n" ;

	echo "    <td align='center' colspan='3' $td>$total</td>\n" ;
	
	echo "    <td align='right' $td></td>\n" ;
	echo "    <td align='center' $td>$nc</td>\n" ;
	echo "</tr>";


?>
				  

</table>
        
<div style="width:200px;margin:20px auto 0 auto;text-align:center;padding:8px;border:1px solid #ccc;font-size:13px;color:#0000ff;background:#fff;">
	<a class='sbar' href='javascript:window.close();'>Go Back</a>
</div>         
  
