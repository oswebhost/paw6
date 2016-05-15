<?php

   
require_once("config.ini.php");
require_once("function.ini.php");

$db = $_GET['site'];
$TEAM = $_GET['TEAM'];

$cur = cur_week($db);

$div = '';


if (!isset($cur_season))
{
 	$cur_season=curseason($db);
}

$res = "select team, `div` from matrix where team='$TEAM' limit 1";
if ($db=='eu'){
	$tempw = $eu->prepare($res);
}else{
	$tempw = $sa->prepare($res);
}
$tempw->execute();
$d = $tempw->fetch();
$div = $d['div'];


$page_title = "$cur_season $TEAM ". divname($div) . " Results to Date";

require_once("header.ini.php");
?>

<link rel="stylesheet" type="text/css" href="style.css">
<?php page_header("Results to Date") ; ?>


<TABLE width="100%" align="center" border='0'>
<TR>
	<TD > <?php echo back(); ?> </TD>
	<TD align="center"><span class='bot'></span></TD>
	<TD align="right"> <?php echo printscr(); ?></TD>
</TR>
</TABLE>
<div style="padding-bottom:5px"></div>

		
			

	
<!-- startprint -->

<?php infoboxTeam($TEAM, cur_week($db),last_update($db), curseason($db)); ?>


<br/>

<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#CDCDCD" width="560">
<tr bgcolor='#f4f4f4'>
	<td colspan='5'><span class='credit'>When HOME:</span></td>
</tr>
<tr bgcolor="#D3EBAB">
	<td width="15%" class='ctd'><b>Date</b></td>
	<td width="20%" class='ctd'><b>Opponent</b></td>
	<td width="15%" class='ctd'><b>Actual<BR>Score</b></td>
	<td width="10%" class='ctd'><b>Result</b></td>
	<td width="10%" class='ctd'><b>ASL</b></td>
</tr>


<?php

if ($_SESSION['expire']< $_SESSION['cur_week']){
	$query1 = "SELECT *,date_format(match_date ,'%d-%b-%Y') as m_date FROM fixtures WHERE 
		hteam='$_GET[TEAM]' and `div`='$div' and season='$cur_season'  and `weekno`< '$cur' ORDER BY weekno,mdate ";
}else{
	$query1 = "SELECT *,date_format(match_date ,'%d-%b-%Y') as m_date FROM fixtures WHERE 
		hteam='$_GET[TEAM]' and `div`='$div' and season='$cur_season' ORDER BY weekno,mdate ";
}

//echo $query1;

if ($db=='eu'){
	$temp = $eu->prepare($query1);
}else{
	$temp = $sa->prepare($query1);
}
$temp->execute();
$number=0;

$played = 0;
while ($row = $temp->fetch()){
   $number ++;
   $char  = ResultChar($row['h_s'],$row['a_s'],"H");
   if ($char<>"P"){
	   $played++;
   }
?>
<tr <?php echo rowcol($number);?> class='hovers'>
	<td class='ctd padd'><?php echo $row['m_date'];?></td>
	<td class='ltd'><?php echo $row['ateam'];?></td>
	<td class='ctd'><?php echo $row['hgoal'] . dash() . $row['agoal']; ?></td>
	<td class='ctd'><?php echo $char ; ?></td>
	<td class='ctd'><?php echo $row['h_s'] . dash() . $row['a_s']; ?></td>
</tr>

<?php }?>
<tr bgcolor='#cccccc'>
	<td class='rtd padd credit' colspan='4'>Played:</td>
	<td class='ctd padd credit'><?php echo $played; ?></td>
</tr>
</table>

<br>



<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#CDCDCD" width="560">
<tr bgcolor='#f4f4f4'>
	<td colspan='5'><span class='credit'>When AWAY:</span></td>
</tr>
<tr bgcolor="#D3EBAB">
	<td width="15%" class='ctd'><b>Date</b></td>
	<td width="20%" class='ctd'><b>Opponent</b></td>
	<td width="15%" class='ctd'><b>Actual<BR>Score</b></td>
	<td width="10%" class='ctd'><b>Result</b></td>
	<td width="10%" class='ctd'><b>ASL</b></td>
</tr>


<?php

if ($_SESSION['expire']< $_SESSION['cur_week']){
	$query1 = "SELECT *,date_format(match_date ,'%d-%b-%Y') as m_date FROM fixtures WHERE 
		ateam='$_GET[TEAM]' and `div`='$div' and season='$cur_season'  and `weekno`< '$cur' ORDER BY weekno,mdate ";
}else{
	$query1 = "SELECT *,date_format(match_date ,'%d-%b-%Y') as m_date FROM fixtures WHERE 
		ateam='$_GET[TEAM]' and `div`='$div' and season='$cur_season' ORDER BY weekno,mdate ";
}

if ($db=='eu'){
	$temp = $eu->prepare($query1);
}else{
	$temp = $sa->prepare($query1);
}
$temp->execute();
$number=0;
$played= 0;

while ($row = $temp->fetch()){
   $number ++;
   $char = ResultChar($row['h_s'],$row['a_s'],"A");
   if ($char<>"P"){
	$played++;
   }
?>
<tr <?php echo rowcol($number);?> class='hovers'>
	<td class='ctd padd'><?php echo $row['m_date'];?></td>
	<td class='ltd'><?php echo $row['hteam'];?></td>
	<td class='ctd'><?php echo $row['hgoal'] . dash() . $row['agoal']; ?></td>
	<td class='ctd'><?php echo $char; ?></td>
	<td class='ctd'><?php echo $row['h_s'] . dash() . $row['a_s']; ?></td>
</tr>

<?php }?>	
<tr bgcolor='#cccccc'>
	<td class='rtd padd credit' colspan='4'>Played:</td>
	<td class='ctd padd credit'><?php echo $played; ?></td>
</tr>
</table>



<div style='padding-left:0px;padding-top:5px;font-size:11px;'><FONT  Color="#000000"><b>ASL</b>&nbsp;=&nbsp;</FONT>Anticipated Score-Line</div>

	 
<!-- stopprint -->
<BR>



<?php otherteams($div,$cur_season,$db); 

require_once("footer.ini.php"); 

?>