<?
 //prediction-accuracy.php

$w = " bgcolor='#EAEAFF'";
$l = " bgcolor='#FFD2D2'";
$d = " bgcolor='#DFFFDF'";
$wk= cur_week($db);

?>

<table width='99%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#008800'>
 <tr>
	<td colspan='3' class="ctd" <?=$w?>><b>Home Win Called</b></td>
	<td colspan='3' class="ctd" <?=$d?>><b>Home Draw Called</b></td>
	<td colspan='3' class="ctd" <?=$l?>><b>Home Loss Called</b></td>
 </tr>
 <tr>
	<td style='width:10%' class="ctd" <?=$w?>>Was<br>Home<br>Win</td>
	<td style='width:10%' class="ctd" <?=$d?>>Was<br>Home<br>Draw</td>
	<td style='width:10%' class="ctd" <?=$l?>>Was<br>Home<br>Loss</td>

	<td style='width:10%' class="ctd" <?=$w?>>Was<br>Home<br>Win</td>
	<td style='width:10%' class="ctd" <?=$d?>>Was<br>Home<br>Draw</td>
	<td style='width:10%' class="ctd" <?=$l?>>Was<br>Home<br>Loss</td>

	<td style='width:10%' class="ctd" <?=$w?>>Was<br>Home<br>Win</td>
	<td style='width:10%' class="ctd" <?=$d?>>Was<br>Home<br>Draw</td>
	<td style='width:10%' class="ctd" <?=$l?>>Was<br>Home<br>Loss</td>
 </tr>

<!-- data row -->
<?



$_Wins=0;$_Draws=0;$_Losses=0;
// wins to win
if ($home=='Ebbsfleet U'){
 $q = "select count(hteam) as cNo, hteam from fixtures where hgoal>agoal and h_s>a_s  and hteam='Gravesend' and season='$last_season' and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}else{
    $q = "select count(hteam) as cNo, hteam from fixtures where hgoal>agoal and h_s>a_s  and hteam=\"$home\" and season='$last_season' and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}

if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();

$_Wins=$dd["cNo"];

 // win 2 draw
if ($home=='Ebbsfleet U'){
	$q = "select count(hteam) as cNo, hteam from fixtures where hgoal>agoal and h_s=a_s  and hteam='Gravesend'  and season='$last_season' and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}else{
	$q = "select count(hteam) as cNo, hteam from fixtures where hgoal>agoal and h_s=a_s  and hteam=\"$home\"  and season='$last_season' and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();

$_Draws=$dd["cNo"];

// win 2 loss
if ($home=='Ebbsfleet U'){
	$q = "select count(hteam) as cNo, hteam from fixtures where hgoal>agoal and h_s<a_s  and hteam='Gravesend'  and season='$last_season' and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}else{
	$q = "select count(hteam) as cNo, hteam from fixtures where hgoal>agoal and h_s<a_s  and hteam=\"$home\"  and season='$last_season' and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();

$_Losses=$dd["cNo"];

$total = $_Wins+$_Draws+$_Losses ;
unset($per);

$per[] = ($total>0? ($_Wins   /$total)*100 : 0) ;
$per[] = ($total>0? ($_Draws  /$total)*100 : 0)  ;
$per[] = ($total>0? ($_Losses /$total)*100 : 0)  ;

?>
  <tr>
	<td style='width:10%' class="ctd" <?=$w?>><?= ($_Wins>0  ? num0($_Wins): 'n/a')  ;?></td>
	<td style='width:10%' class="ctd" <?=$d?>><?= ($_Draws>0 ? num0($_Draws): 'n/a') ;?></td>
	<td style='width:10%' class="ctd" <?=$l?>><?= ($_Losses>0? num0($_Losses): 'n/a');?></td>

<?
$_Wins=0;$_Draws=0;$_Losses=0;
// Draw to win
if ($home=='Ebbsfleet U'){
     $q = "select count(hteam) as cNo, hteam from fixtures where hgoal=agoal and h_s>a_s  and hteam='Gravesend'  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}else{
     $q = "select count(hteam) as cNo, hteam from fixtures where hgoal=agoal and h_s>a_s  and hteam=\"$home\"  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();

$_Wins=$dd["cNo"];

 // draw 2 draw
if ($home=='Ebbsfleet U'){
 $q = "select count(hteam) as cNo, hteam from fixtures where hgoal=agoal and h_s=a_s  and hteam='Gravesend'  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}else{
    $q = "select count(hteam) as cNo, hteam from fixtures where hgoal=agoal and h_s=a_s  and hteam=\"$home\"  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();

$_Draws=$dd["cNo"];

 // draw 2 loss
if ($home=='Ebbsfleet U'){
    $q = "select count(hteam) as cNo, hteam from fixtures where hgoal=agoal and h_s<a_s  and hteam='Gravesend'  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}else{
    $q = "select count(hteam) as cNo, hteam from fixtures where hgoal=agoal and h_s<a_s  and hteam=\"$home\"  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();

$_Losses=$dd["cNo"];

$total = $_Wins+$_Draws+$_Losses ;
$per[] = ($total>0? ($_Wins   /$total)*100 : 0) ;
$per[] = ($total>0? ($_Draws  /$total)*100 : 0)  ;
$per[] = ($total>0? ($_Losses /$total)*100 : 0)  ;


?>
	<td style='width:10%' class="ctd" <?=$w?>><?= ($_Wins>0  ? num0($_Wins): 'n/a')  ;?></td>
	<td style='width:10%' class="ctd" <?=$d?>><?= ($_Draws>0 ? num0($_Draws): 'n/a') ;?></td>
	<td style='width:10%' class="ctd" <?=$l?>><?= ($_Losses>0? num0($_Losses): 'n/a');?></td>

<?

$_Wins=0;$_Draws=0;$_Losses=0;
// loss to win
if ($home=='Ebbsfleet U'){
    $q = "select count(hteam) as cNo, hteam from fixtures where hgoal<agoal and h_s>a_s  and hteam='Gravesend'  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off'  group by hteam";
}else{
    $q = "select count(hteam) as cNo, hteam from fixtures where hgoal<agoal and h_s>a_s  and hteam=\"$home\"  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off'  group by hteam";
}
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();

$_Wins=$dd["cNo"];

 // loss 2 draw
if ($home=='Ebbsfleet U'){
    $q = "select count(hteam) as cNo, hteam from fixtures where hgoal<agoal and h_s=a_s  and hteam='Gravesend'  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}else{
    $q = "select count(hteam) as cNo, hteam from fixtures where hgoal<agoal and h_s=a_s  and hteam=\"$home\"  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();

$_Draws=$dd["cNo"];

 // loss 2 loss
if ($home=='Ebbsfleet U'){
    $q = "select count(hteam) as cNo, hteam from fixtures where hgoal<agoal and h_s<a_s  and hteam='Gravesend'  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}else{
    $q = "select count(hteam) as cNo, hteam from fixtures where hgoal<agoal and h_s<a_s  and hteam=\"$home\"  and `season`='$last_season'  and a_s<>'P' and a_s>'' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' and `playoff`<>'Play-Off' group by hteam";
}
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();

$_Losses=$dd["cNo"];

$total = $_Wins+$_Draws+$_Losses ;
$per[] = ($total>0? ($_Wins   /$total)*100 : 0) ;
$per[] = ($total>0? ($_Draws  /$total)*100 : 0)  ;
$per[] = ($total>0? ($_Losses /$total)*100 : 0)  ;


?>
	<td style='width:10%' class="ctd" <?=$w?>><?= ($_Wins>0  ? num0($_Wins): 'n/a')  ;?></td>
	<td style='width:10%' class="ctd" <?=$d?>><?= ($_Draws>0 ? num0($_Draws): 'n/a') ;?></td>
	<td style='width:10%' class="ctd" <?=$l?>><?= ($_Losses>0? num0($_Losses): 'n/a');?></td>
  </tr>

<!-- percentage row -->
   <tr>
	<td class="ctd bold" <?=$w?>><? echo ($per[0]>0? num0($per[0]).'%' : 'n/a'); ?></td>
	<td class="ctd bold" <?=$d?>><? echo ($per[1]>0? num0($per[1]).'%' : 'n/a'); ?></td>
	<td class="ctd bold" <?=$l?>><? echo ($per[2]>0? num0($per[2]).'%' : 'n/a'); ?></td>

	<td class="ctd bold" <?=$w?>><? echo ($per[3]>0? num0($per[3]).'%' : 'n/a'); ?></td>
	<td class="ctd bold" <?=$d?>><? echo ($per[4]>0? num0($per[4]).'%' : 'n/a'); ?></td>
	<td class="ctd bold" <?=$l?>><? echo ($per[5]>0? num0($per[5]).'%' : 'n/a'); ?></td>

	<td class="ctd bold" <?=$w?>><? echo ($per[6]>0? num0($per[6]).'%' : 'n/a'); ?></td>
	<td class="ctd bold" <?=$d?>><? echo ($per[7]>0? num0($per[7]).'%' : 'n/a'); ?></td>
	<td class="ctd bold" <?=$l?>><? echo ($per[8]>0? num0($per[8]).'%' : 'n/a'); ?></td>

  </tr>

</table>