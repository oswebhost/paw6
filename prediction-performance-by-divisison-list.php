<?	include("config.ini.php");

include("function.ini.php");

$season = $_GET["season"];

if (isset($_GET['PARA'])):
	 $parts  = explode(",", $_GET['PARA']);
	 $DIV    =  $parts[0];
	 $season =  $parts[1];
     $db =  $parts[2];
endif;

$wk = cur_week($db);

$pageURL = "?PARA=$season";

$page_title="Prediction Performance Records " . divname($DIV)  . " Season $season"; 


include("header.ini.php");

page_header("Prediction Performance Records") ; 


?>
<style>
	#t1 {border-left:2px solid #555555; text-align:center;}
</style>


<div class="report_blue_heading">BY DIVISION</div>

<!-- startprint -->

<table width="100%" align="center">
<tr>
	<td><a class='sbar' href="soccer-prediction-performance-by-division.php?season=<?php echo $season; ?>&db=<?php echo $db;?>"><img border="0" src="images/header/blue-dot.gif" >Back</a></td> 
	<td align="right"> <? echo printscr(); ?></td>
</tr>
</table>

<div style="padding-bottom:5px"></div>
<? 

echo tb_header( strtoupper(divname($DIV)) . " " . $season) ; 

if ($season <> curseason()){
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$season' and `div`='$DIV' group by weekno order by weekno";
}else{
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$season' and weekno<'$wk' and `div`='$DIV' group by weekno order by weekno";
}

if ($db=='eu'){
   $temp = $eu->prepare($q) ;
}else{
   $temp = $sa->prepare($q);
}
$temp->execute();
        
$data=''; $ht=0; $hc=0; $at=0; $ac=0; $dt=0; $dc=0;
$n=1;

$mywin = "mywin";
$window ='<a class="pp" href="javascript:sele_win(';
$window .= "'" ;
$seleURL = "cur_freedetails.php?PARA=$season," ;

while ($d = $temp->fetch() ):

	$cwk = $d["weekno"];
	if ($cwk>$last+1):
		for ($j=$last+1; $j<$cwk; $j++) :
			$data .= blank_line($j,'-');
		endfor;
	endif;



	$rowcol = rowcol($d["weekno"]);
	$data .= "<tr $rowcol>\n";
	
	$x	  = $window . $seleURL . $d["weekno"]. ",$DIV,$db')\">" ;
	$data .= "<td align='center'>\n $x" . num0($d[weekno]) . "</a></td>\n"; 

	// homes
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$season' and `div`='$DIV' and weekno='$cwk' and hgoal>agoal group by weekno order by weekno";
    if ($db=='eu'){
       $tempw = $eu->prepare($q) ;
    }else{
       $tempw = $sa->prepare($q);
    }
    $tempw->execute();

	$dr = $tempw->fetch();

	if ($dr['totalm']>0){
		$data .= "<td align='center' id='t1'>$window" . $seleURL . "$cwk,$DIV,$db,H". "')\") style='font-size:11px;'>" . num0($dr[totalm]) . "</a></td>\n"; 
	}else{
		$data .= "<td align='center' id='t1'>0</td>\n"; 
	}
	$data .= "<td align='center'>\n" . num0($dr[correct]) . "</td>\n";
	$data .= "<td align='center'>\n<b>". num2(($dr[correct]/($dr[totalm]>0?$dr[totalm]:1))*100) . "%</b></td>\n";

		$ht += $dr["totalm"]; $hc += $dr["correct"];
	

	// Draws
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$season' and `div`='$DIV' and weekno='$cwk' and hgoal=agoal group by weekno order by weekno";
    if ($db=='eu'){
       $tempw = $eu->prepare($q) ;
    }else{
       $tempw = $sa->prepare($q);
    }
    $tempw->execute();
	$dr = $tempw->fetch();

	if ($dr['totalm']>0){
		$data .= "<td align='center' id='t1'>$window" . $seleURL . "$cwk,$DIV,$db,D". "')\") style='font-size:11px;'>" . num0($dr[totalm]) . "</a></td>\n"; 
	}else{
		$data .= "<td align='center' id='t1'>0</td>\n"; 
	}
	$data .= "<td align='center'>\n" . num0($dr[correct]) . "</td>\n";
	$data .= "<td align='center'>\n<b>". num2(($dr[correct]/($dr[totalm]>0?$dr[totalm]:1))*100) . "%</b></td>\n";

	$dt += $dr["totalm"]; $dc += $dr["correct"];

    // aways
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$season' and `div`='$DIV' and weekno='$cwk' and hgoal<agoal group by weekno order by weekno";
    if ($db=='eu'){
       $tempw = $eu->prepare($q) ;
    }else{
       $tempw = $sa->prepare($q);
    }
    $tempw->execute();
	$dr = $tempw->fetch();

	if ($dr['totalm']>0){
		$data .= "<td align='center' id='t1'>$window" . $seleURL . "$cwk,$DIV,$db,A". "')\") style='font-size:11px;'>" . num0($dr[totalm]) . "</a></td>\n"; 
	}else{
		$data .= "<td align='center' id='t1'>0</td>\n"; 
	}
	$data .= "<td align='center'>\n" . num0($dr[correct]) . "</td>\n";
	$data .= "<td align='center'>\n<b>". num2(($dr[correct]/($dr[totalm]>0?$dr[totalm]:1))*100) . "%</b></td>\n";
	$at += $dr["totalm"]; $ac += $dr["correct"];

	$data .= "</tr>\n";
	$last = $cwk ;
	$n++;
	

endwhile;

for ($i=$cwk+1; $i<45; $i++):
	$data .= blank_line($i,'');
endfor;

echo $data ;
echo "<tr height='25'>\n";
echo "<td align='center' >\n<span class='credit'>Total</span></td>\n";
echo "<td align='center'  id='t1'>\n<span class='credit'>". num0($ht) ."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num0($hc)."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num2(($hc/($ht>0?$ht:1))*100) . "%</span></td>\n";

echo "<td align='center'  id='t1'>\n<span class='credit'>". num0($dt) ."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num0($dc)."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num2(($dc/($dt>0?$dt:1))*100) . "%</span></td>\n";

echo "<td align='center'  id='t1'>\n<span class='credit'>". num0($at) ."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num0($ac)."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num2(($ac/($at>0?$at:1))*100) . "%</span></td>\n";

echo "</tr>\n";
echo "</table>\n" ;

echo '<!-- stopprint --><div style="padding-bottom:10px"></div>';


include("footer.ini.php");	

function tb_header($caption) 
{
return '
<table border="1" width="100%" align="center" cellpadding="2" cellspacing="0"  style="border-collapse: collapse" bordercolor="#D1D1D1" bgcolor="#F6F6F6">
	<tr height="28"><td colspan="10" align="center" bgcolor="#D3EBAB"><SPAN class="credit">'. $caption .'</span></td></tr>
	<tr bgcolor="#D3EBAB" height="20">
		<td rowspan="2" align="center" ><b>Week No<b></td>
		<td colspan="3" align="center" id="t1"><b>Home Win Calls</b></td>
		<td colspan="3" align="center" id="t1"><b>Draw Calls</b></td>
		<td colspan="3" align="center" id="t1"><b>Away Win Calls</b></td>
	</tr>
	<tr bgcolor="#D3EBAB" height="20">
		<td align="center"  id="t1"><img src="images/tbcap/total.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/correct.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/success.gif" border="0"></td>
		<td align="center"  id="t1"><img src="images/tbcap/total.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/correct.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/success.gif" border="0"></td>
		<td align="center"  id="t1"><img src="images/tbcap/total.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/correct.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/success.gif" border="0"></td>
 	</tr>';
}

function blank_line($start_week,$ch)
{
    $rowcol = rowcol($start_week);
	$data .= "<tr $rowcol >\n";
	$data .= "<td align='center' >\n$start_week</td>\n"; 
	$data .= "<td align='center' id='t1'>$ch\n</td>\n"; 
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'  id='t1'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center' id='t1'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";

	$data .= "</tr>\n";

	return $data;
}