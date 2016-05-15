<?php
session_start();

include("config.ini.php") ;
include("function.ini.php") ;

if (!isset($_SESSION['match_ids'])):
   $_SESSION['match_ids'][] = $_POST['mid'] ;
else:
	if (!in_array($_POST['mid'], $_SESSION["match_ids"],TRUE)):
		if (isset($_POST['mid'])) $_SESSION['match_ids'][] = $_POST['mid'] ;
	endif;
endif;

if ($_POST['d']=='del'):
	unset($_SESSION["match_ids"][$_POST["id"]]);
endif;


if (count($_SESSION['match_ids'])>0) :


?>

<form name='cal' style="padding:0;margin:0">

<table border="1" style="border-collapse: collapse" bordercolor="#CDCDCD"   width="380" align="center" bgcolor="#F6F6F6" cellpadding='2'>
<tr bgcolor="#FBD200">
	<td style='text-align:center' colspan='7'>
		<span class='credit'>CORRECT SCORES<br>JACKPOT WINNINGS CALCULATOR</span>
	</td>
</tr>

<tr bgcolor="#fbd200">
	<td  class='ctd'><img src="images/tbcap/del-y.gif"  border="0" alt=""/></td>
	<td width="5%" class='ctd'><img src="images/tbcap/refno-y.gif" border='0' alt=""/></td>
	<td class='ctd'><img src="images/tbcap/date-y.gif" border="0" alt=""/></td>
	<td class='ctd'><img src="images/tbcap/match-y.gif"  border="0" alt=""/></td>
	<td class='ctd'><img src="images/tbcap/div-y.gif"  border="0" alt=""/></td>
	<td class='ctd'><img src="images/tbcap/asl-y.gif"  border="0" alt=""/></td>
	<td class='ctd'><img src='images/tbcap/odd-y.gif' border='0' alt=''/></td>
</tr>

<?
	$match = new Match();
	$x = 0; 
	
	$char = printv('v');
	//for ($i=0; $i<count($_SESSION['match_ids']); $i++):
	
	foreach ($_SESSION['match_ids'] as $key => $value ){
		$match->getMatch($value);
		$odds = $match->getCSOdss($value,$key);
		$x++;
		$rowcol = rowcol($x);
		echo "<tr $rowcol>";
		echo "<td style='text-align:center'><a href='#' class='sbar' onClick='delMatch(". $key .");'> X </a></td>";
		
		echo "<td style='text-align:center'>$x</td>";
		echo "<td style='text-align:center'>" . $match->mdate  . " <font size='1'>" . substr($match->mtime,0,5) . "</font></td>";
		echo "<td style='text-align:left'>" . $match->hteam  . " $char " . $match->ateam . "</td>";
		echo "<td style='text-align:center'>$match->div</td>\n";
		echo "<td style='text-align:center'>". $odds ."</td>\n";
		echo "<td style='text-align:center'><input type='text' style='width:35px;' readonly name='odds$key' id='odd$key'></td>\n";
		echo "</tr>\n\n\n";
	}
?>


<!--
<tr>
	<td colspan='4'></td>
	<td colspan='3'><input name='final' readonly id='final' style='width:100%;height:25px;font-size:18px;text-align:center;'></td>
</tr>
-->
</table>

<div id="go" style="padding-top:10px;padding-bottom:10px;text-align:center;">
	<a href='#' onClick = 'show_total();' class="sbar"><img src='images/go.jpg' border='0' alt=''></a>
</div>

</form>

<?
endif; 

class Match
{
	
	
	var $hteam ='';
	var $ateam ='';
	var $mdate ='';
	var $mtime ='';
	var $div   ='';
	var $week  ='';

	function Match() {

	}

	function getMatch($id)
	{
		global $eu, $sa;
		$q = "SELECT * FROM fixtures WHERE weekno='$_SESSION[cur_wk]' and season='$_SESSION[cur_sea]' and mid='$id'"; 
		if ($_SESSION['db']=='eu'){
			$tempw = $eu->prepare($q);
		}else{
			$tempw = $sa->prepare($q);
		}
		
		$tempw->execute();
		$d = $tempw->fetch();

		$this->hteam = $d["hteam"];
		$this->ateam = $d["ateam"];
		$this->mdate = $d["mdate"];
		$this->mtime = $d["match_time"];
		$this->div   = $d["div"];
		$this->week  = $d["weekno"] ;

	}

	function getCSOdss($id,$key) 
	{
		global $eu, $sa;	
		$q = "select * from full_csodds where season='$_SESSION[cur_sea]' and weekno='$_SESSION[cur_wk]' and matchno='$id' order by rid";
		
		if ($_SESSION['db']=='eu'){
			$tempw2 = $eu->prepare($q);
		}else{
			$tempw2 = $sa->prepare($q);
		}
		$tempw2->execute();
		$data = $tempw2->rowcount();
	    
	    if ($tempw2->rowcount()>0 ){
		  	$content= "<select id='asl$key' name='asl$key' style='width:42px;font-size:11px;' onChange='show_odd(this,$key);'><option></option>\n";
		  	while ($data = $tempw2->fetch() )
		  	{
		  		$content .= "<option value='". $data[odds] ."'>" . $data[caption] . "</option>\n\n";
		  	}
		  	$content.="</select>\n";
		}else{ 
		 	$content = "No odds available" ;
		}
		 
		 return $content;
	}

}

?>