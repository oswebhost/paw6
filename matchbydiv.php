<?php
session_start();

require_once("config.ini.php") ;
require_once("function.ini.php") ;

$db = $_SESSION['db'];


if ($db=='eu'){
	$divs = array("EP", "C0", "C1", "C2", "NC", "SP", "S1", "S2", "S3", "FL", "G0", "GB", "HK", "IS", "P0", "SL","T0");
}else{
	$divs = array("BRA", "BRB", "MLS");
}  

$div = $divs[$_POST['content']];
$cur_wk = $_POST['week'];

$cur_sea= curseason($db);
$wdate  = wdate($cur_wk,$cur_sea,$db);

$_SESSION['cur_wk'] = $cur_wk;
$_SESSION['cur_sea'] = $cur_sea;

function wdate($w,$s,$db)
{  
   global $eu, $sa;
   $r = "SELECT * FROM fixtures WHERE `weekno`='$w'  and season='$s'"; 
	if ($db=='eu'){
	   $tempw = $eu->prepare($r) ;
	}else{
	   $tempw = $sa->prepare($r);
	}
	$tempw->execute();
	$d = $tempw->fetch();
	return $d["wdate"];
}


//week_box_new(divname($div), $cur_wk, $wdate, $cur_sea)
?>

<table border="1"  width="320" align="center" cellpadding="2" cellspacing="0" id="AutoNumber4"  style="border-collapse: collapse" bordercolor="#D3EBAB" bgcolor="#F6F6F6" align='center'>
<tr>
	<td width="150" height="15">Week Beginning:</td>
	<td width="150" height="15" align="center"><?php echo $wdate ;?></td>

	<td width='300' height="30" rowspan="2" align="center">Season: <? echo $cur_sea; ?></td>
	</tr>
	<tr>
	<td  height="15"><span class='credit'>Week No:</span></td>
	<td  height="15" align="center"><span class='credit'><? echo $cur_wk ;?></span></td>
	</tr>
	<tr>
	<td colspan="3" height="20" align="center" >
	<font SIZE="2"><b><? echo divname($div) ?></b></font></td>
	
</tr>
</table>


<div style="padding-bottom:5px"></div>


<table border="1" style="border-collapse: collapse" bordercolor="#CDCDCD"   width="320" align="center" bgcolor="#F6F6F6" cellpadding='2'>

<tr bgcolor="#d3ebab">
	<td width="5%" class='ctd'><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>
	<td class='ctd'><img src="images/tbcap/datepic.gif" border="0" alt=""/></td>
	<td width="60%" class='ctd'><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
	<td width='100' class='ctd'><img src='images/tbcap/select.gif' border='0' alt=''></td>
</tr>

<?php

$q = "SELECT * FROM fixtures WHERE `div`='$div' AND weekno='$cur_wk'  and season='$cur_sea' ORDER BY match_date,hteam,ateam"; 

	if ($db=='eu'){
	   $temp = $eu->prepare($q) ;
	}else{
	   $temp = $sa->prepare($q);
	}
	$temp->execute();

$number=0;

while ($d = $temp->fetch()){
   $number++;
   $rowcol = rowcol($number);
   $char = printv('v');
   $matchno = $d[mid];
	
	if ($d['div']=='FA' or $d['div']=='IN' or $d['div']=='SA'){
	$data = "<a $hsss class='md2' href='team-performance-other.php?id=$matchno&db=$db' target='_blank'>". $d["mdate"]. "&nbsp;<font size='1'>" . substr($d['match_time'],0,5) . "</font></a>";
	}else{
	$data = "<a $hsss class='md2' href='team-performance-chart.php?id=$matchno&db=$db' target='_blank'>". $d["mdate"]. "&nbsp;<font size='1'>" . substr($d['match_time'],0,5) . "</font></a>";
	}
       
   echo "<tr $rowcol>";
   echo "<td style=\"text-align: center; padding:3px 0px;\">$number</td>";
   echo "<td style=\"text-align: center\">". $data ."</td>";
   echo "<td>" . $d["hteam"] . "&nbsp;$char&nbsp;" . $d["ateam"] . "</td>";
   echo "<td style='text-align:center'><a href='#' onclick='loadMatch($d[mid]);' class='sbar'>select</a></td>";
   echo "</tr>";

}
?>


</table>

<table width='45%' border='0' cellpadding='0' cellspacing='0' style="margin-left: 15px;">
<tr>
<td style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?php echo $fff ?>
</td>
</tr>
</table>