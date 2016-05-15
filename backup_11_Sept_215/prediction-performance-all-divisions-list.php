<?	include("config.ini.php");

include("function.ini.php");

$db= $_GET['db'];

if (!isset($_GET['season'])):
	$cur = curseason($db);
else:
	$cur = $_GET['season'];
endif;

$wk = cur_week($db);

$pageURL = "?PARA=$cur";

if (isset($_GET['db'])){
  $page_title = "Soccer Prediction Performance Records All Divisions Combined " . s_title($db) . " Season $cur";
}else{
  $page_title="Soccer Prediction Performance Records All Divisions Combined"; 

}

$sql = " and `div`<>'SA' and `div`<>'FA' and `div`<>'IN' and `div`<>'EU' ";


include("header.ini.php");

page_header("Prediction Performance Records") ; 


?>
<style>
	#t1 {border-left:2px solid #555555; text-align:center;}
</style>
<div style="padding-bottom:5px"></div>
<!-- startprint -->

<? if (isset($_GET['db'])){ ?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>
<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Predictions ALL DIVISIONS COMBINED</div>

 <form method="get" action="<?=$PHP_SELF?>" style="padding:0;margin:0;"  >
  <input type="hidden" name="db" value="<?echo $_GET['db'];?>" />   
	  
	  <table border="0" width="100%"  align='center' cellpadding="3" style="border-collapse: collapse" bordercolor="#f4f4f"  >
	  
		<tr>
		 <td width="10%" ><b><font size="2" color="#0000FF">Season</font></b></td>
		 <td width="80%">
			<select size="1" name="season" class="text" style="font-size:12px;width:150px;font-weight:bold;"  onChange="this.form.submit();">
		  <? 
		  
			$sqry = "SELECT distinct(season) as season from fixtures order by season desc" ;
            if ($db=='eu'){
               $temp = $eu->prepare($sqry) ;
            }else{
               $temp = $sa->prepare($sqry);
            }
            $temp->execute();
              
			 while ($sr = $temp->fetch()) : 
		  ?>
		      <option value="<?= $sr["season"] ?>" <?echo selected($cur,$sr["season"])?>><?= $sr["season"] ?></option>
		  
		  <? endwhile; ?>
		  </select>

		 </td>
		</tr>
</table>
</form>
<? 

echo tb_header( strtoupper($season)) ; 

if ($cur == curseason($db)) {
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$cur' and weekno<'$wk' group by weekno order by weekno";
}else{
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$cur' group by weekno order by weekno";
}
if ($db=='eu'){
   $tempw = $eu->prepare($q) ;
}else{
   $tempw = $sa->prepare($q);
}
$tempw->execute();

$data=''; $ht=0; $hc=0; $at=0; $ac=0; $dt=0; $dc=0;


$n=1;

$mywin = "mywin";
$window ='<a class="pp" href="javascript:sele_win(';
$window .= "'" ;
$seleURL = "cur_freedetails-all.php?PARA=$cur," ;

while ($d = $tempw->fetch() ):

	$cwk = $d["weekno"];
	if ($cwk>$last+1):
		for ($j=$last+1; $j<$cwk; $j++) :
			$data .= blank_line($j,'-');
		endfor;
	endif;



	$rowcol = rowcol($d["weekno"]);
	$data .= "<tr $rowcol>\n";
	
	$x	  = $window . $seleURL . $d["weekno"]. ",$db')\">" ;
	$data .= "<td align='center'>\n $x" . num0($d[weekno]) . "</a></td>\n"; 

	// homes
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$cur' and weekno='$cwk' and hgoal>agoal $sql group by weekno order by weekno";
    if ($db=='eu'){
       $temp = $eu->prepare($q) ;
    }else{
       $temp = $sa->prepare($q);
    }
    $temp->execute();	
    $dr = $temp->fetch();
	
	if ($dr['totalm']>0){
		$data .= "<td align='center' id='t1'>$window" . $seleURL . $cwk . ",$db,H')\") style='font-size:11px;'>" . num0($dr[totalm]) . "</a></td>\n"; 
	}else{
		$data .= "<td align='center' id='t1'>0</td>\n"; 
	}

	$data .= "<td align='center'>\n" . num0($dr[correct]) . "</td>\n";
	$data .= "<td align='center'>\n<b>". num2(($dr[correct]/($dr[totalm]>0?$dr[totalm]:1))*100) . "%</b></td>\n";

	$ht += $dr["totalm"]; $hc += $dr["correct"];

	// Draws
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$cur' and weekno='$cwk' and hgoal=agoal $sql group by weekno order by weekno";
   if ($db=='eu'){
       $temp = $eu->prepare($q) ;
    }else{
       $temp = $sa->prepare($q);
    }
    $temp->execute();	
    $dr = $temp->fetch();

	if ($dr['totalm']>0){
		$data .= "<td align='center' id='t1'>$window" . $seleURL . $cwk . ",$db,D')\") style='font-size:11px;'>" . num0($dr[totalm]) . "</a></td>\n"; 
	}else{
		$data .= "<td align='center' id='t1'>0</td>\n"; 
	}

	$data .= "<td align='center'>\n" . num0($dr[correct]) . "</td>\n";
	$data .= "<td align='center'>\n<b>". num2(($dr[correct]/($dr[totalm]>0?$dr[totalm]:1))*100) . "%</b></td>\n";

	$dt += $dr["totalm"]; $dc += $dr["correct"];

	// Away
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$cur' and weekno='$cwk' and hgoal<agoal $sql group by weekno order by weekno";
   if ($db=='eu'){
       $temp = $eu->prepare($q) ;
    }else{
       $temp = $sa->prepare($q);
    }
    $temp->execute();
	$dr = $temp->fetch();

	if ($dr['totalm']>0){
		$data .= "<td align='center' id='t1'>$window" . $seleURL . $cwk . ",$db,A')\") style='font-size:11px;'>" . num0($dr[totalm]) . "</a></td>\n"; 
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

for ($i=$cwk+1; $i<43; $i++):
	$data .= blank_line($i,'');
endfor;

echo $data ;
echo "<tr height='25'>\n";
echo "<td align='center'>\n<span class='credit'>Total</span></td>\n";
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

}else{
    echo '<div class="report_blue_heading">Predictions All Divisions combined</div>';
    include("select-option.ini.php");
    
} 

include("footer.ini.php");	

function tb_header($caption) 
{
return '
<table border="1" width="100%" align="center" cellpadding="2" cellspacing="0"  style="border-collapse: collapse" bordercolor="#D1D1D1" bgcolor="#F6F6F6">

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