<?php
include("config.ini.php");
include("function.ini.php");
include("overround-class.php");

$or2 = new overround();

page_header("Over-Round for Specific Call Type (1X2) ");

$db= $_GET['db'];
$id= $_GET['id'];

$sea = curseason($db);

$qry = "SELECT *, date_format(match_date,'%d-%b-%Y') as mdate FROM fixtures where season='$sea' and mid='$id'";

if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
$row = $temp->fetch() ;     

// find over-round...
$or2->find_or($row['h_odd'], $row['d_odd'], $row['a_odd'], $row['hwinpb'],$row['drawpb'],$row['awinpb']);


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title>Soccer-Predictions.com : Orver-Round</title>
	<link rel="stylesheet" type="text/css" href="css/style_v4.css" media="screen" />

</head>

<body style='background:#fff;padding:0 10px 0 10px;'>

<!-- startprint -->

<table border="1" style="border-collapse: collapse;margin:auto auto;border:1px solid #ccc;" bordercolor="#cdcdcd"  width="100%" cellpadding='3'>
	<tr'>	
		<td  bgcolor='#f4f4f4' class='ctd padd' width='20%'><?php echo $row['mdate']; ?> </td>
		<td class='padd credit ctd' width='80%'>
			<span class='bb'><?php echo $row['hteam'] ;?></span> v <span style='color:red'><?php echo $row['ateam'] ;?></span>
		</td>
	</tr>
	
</table>	
<br/>

<table border="1" style="border-collapse: collapse;margin:auto auto;border:1px solid #ccc;" bordercolor="#cdcdcd"  width="100%" cellpadding='3'>
	<tr bgcolor="#d3ebab">
		<td width='50%' class='padd bold'>Actual "MATCH" Over-Round = <?php echo num20($or2->match_or)?>%</td>
		<td width='13%' class='ctd padd credit'>Home</td>
		<td width='13%' class='ctd padd credit'>Draw</td>
		<td width='13%' class='ctd padd credit'>Away</td>
	</tr>

	<tr>
		<td class='padd bold odds'><?php echo bookie_name("BET");?> Odds</td>
		<td class='padd ctd odds'><?php echo num2($or2->hodd);?></td>
		<td class='padd ctd odds'><?php echo num2($or2->dodd);?></td>
		<td class='padd ctd odds'><?php echo num2($or2->aodd);?></td>
	</tr>
<!--
	<tr>
		<td class='padd bold odds'>Bookie Over Round Chance</td>
		<td class='padd ctd odds'><?php echo num2(1/$row['h_odd']*100);?>%</td>
		<td class='padd ctd odds'><?php echo num2(1/$row['d_odd']*100);?>%</td>
		<td class='padd ctd odds'><?php echo num2(1/$row['a_odd']*100);?>%</td>
	</tr>

	<tr>
		<td class='padd bold odds'>Bookie REAL Chance w/o Over Round</td>
		<td class='padd ctd odds'><?php echo num2($bookie_real_home);?>%</td>
		<td class='padd ctd odds'><?php echo num2($bookie_real_draw);?>%</td>
		<td class='padd ctd odds'><?php echo num2($bookie_real_away);?>%</td>
	</tr>
-->
	<tr>
		<td class='padd bold odds'>PaW Probabilities</td>
		<td class='padd ctd odds'><?php echo num2($or2->hpb);?>%</td>
		<td class='padd ctd odds'><?php echo num2($or2->dpb);?>%</td>
		<td class='padd ctd odds'><?php echo num2($or2->apb);?>%</td>
	</tr>
	<tr bgcolor='#f4f4f4'>
		<td class='padd bold odds rtd'>Specific Over-Rounds</td>
		<td class='padd ctd bold odds'><?php echo num20($or2->home_or)?>%</td>
		<td class='padd ctd bold odds'><?php echo num20($or2->draw_or);?>%</td>
		<td class='padd ctd bold odds'><?php echo num20($or2->away_or);?>%</td>
	</tr>
</table>

<p style='padding:0;margin:0;font-size:12px;padding:8px'>
	The above figures are the PaW Program's "Probabilities" outputs, and so must be treated with caution (because the teams may not perform as expected). They are relative figures for comparison with the figures for other matches. 
	<br/><br/>
	 The actual "MATCH" Over-Round may well vary considerably from the specific Call Type Over-Rounds!
</p>

<!-- stopprint -->

	<div style="margin:15px;padding:8px;border:1px solid #ccc;font-size:13px;color:#0000ff;background:#f4f4f4;text-align:center;">
		<a class='sbar' href='javascript:window.close();'>Close Window</a>
	</div>
	
</body>
</html>