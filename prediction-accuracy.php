<?php
 //prediction-accuracy.php

$w = " bgcolor='#EAEAFF'";
$l = " bgcolor='#FFD2D2'";
$d = " bgcolor='#DFFFDF'";
$wk= $cur_wk;

?>

<table width='99%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#008800'>
 <tr>
	<td colspan='3' class='ctd' <?php echo $w?>><b>Home Win Called</b></td>
	<td colspan='3' class='ctd' <?php echo $d?>><b>Home Draw Called</b></td>
	<td colspan='3' class='ctd' <?php echo $l?>><b>Home Loss Called</b></td>
 </tr>
 <tr>
	<td class='ctd' style="width:10%" <?php echo $w?>>Was<br>Home<br>Win</td>
	<td class='ctd' style="width:10%" <?php echo $d?>>Was<br>Home<br>Draw</td>
	<td class='ctd' style="width:10%" <?php echo $l?>>Was<br>Home<br>Loss</td>

	<td class='ctd' style="width:10%" <?php echo $w?>>Was<br>Home<br>Win</td>
	<td class='ctd' style="width:10%" <?php echo $d?>>Was<br>Home<br>Draw</td>
	<td class='ctd' style="width:10%" <?php echo $l?>>Was<br>Home<br>Loss</td>

	<td class='ctd' style="width:10%" <?php echo $w?>>Was<br>Home<br>Win</td>
	<td class='ctd' style="width:10%" <?php echo $d?>>Was<br>Home<br>Draw</td>
	<td class='ctd' style="width:10%" <?php echo $l?>>Was<br>Home<br>Loss</td>
 </tr>

<!-- data row -->
<?php
$_Wins=0;$_Draws=0;$_Losses=0;
// wins to win

$q = "select count(hteam) as cNo, hteam from fixtures where hgoal>agoal and h_s>a_s and `div`='$home_div' and hteam=\"$home\" and `weekno`<'$wk' and season='$sea' group by hteam";

if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();
$_Wins=$dd["cNo"];

 // win 2 draw
$q = "select count(hteam) as cNo, hteam from fixtures where hgoal>agoal and h_s=a_s and `div`='$home_div' and hteam=\"$home\"  and `weekno`<'$wk' and season='$sea' group by hteam";

if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();
$_Draws=$dd["cNo"];

 // win 2 loss
$q = "select count(hteam) as cNo, hteam from fixtures where hgoal>agoal and h_s<a_s and `div`='$home_div' and hteam=\"$home\"  and `weekno`<'$wk' and season='$sea' group by hteam";
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
  <tr>
	<td class='ctd' style="width:10%" <?php echo $w?>><?php echo  ($_Wins>0  ? num0($_Wins): 'n/a')  ;?></td>
	<td class='ctd' style="width:10%" <?php echo $d?>><?php echo  ($_Draws>0 ? num0($_Draws): 'n/a') ;?></td>
	<td class='ctd' style="width:10%" <?php echo $l?>><?php echo  ($_Losses>0? num0($_Losses): 'n/a');?></td>

<?php
$_Wins=0;$_Draws=0;$_Losses=0;
// Draw to win
$q = "select count(hteam) as cNo, hteam from fixtures where hgoal=agoal and h_s>a_s and `div`='$home_div' and hteam=\"$home\"  and `weekno`<'$wk' and season='$sea' group by hteam";
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();
$_Wins=$dd["cNo"];

// draw 2 draw
$q = "select count(hteam) as cNo, hteam from fixtures where hgoal=agoal and h_s=a_s and `div`='$home_div' and hteam=\"$home\"  and `weekno`<'$wk' and season='$sea' group by hteam";
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();
$_Draws=$dd["cNo"];

// draw 2 loss
$q = "select count(hteam) as cNo, hteam from fixtures where hgoal=agoal and h_s<a_s and `div`='$home_div' and hteam=\"$home\"  and `weekno`<'$wk' and season='$sea' group by hteam";
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
	<td class='ctd' style="width:10%" <?php echo $w?>><?php echo  ($_Wins>0  ? num0($_Wins): 'n/a')  ;?></td>
	<td class='ctd' style="width:10%" <?php echo $d?>><?php echo  ($_Draws>0 ? num0($_Draws): 'n/a') ;?></td>
	<td class='ctd' style="width:10%" <?php echo $l?>><?php echo  ($_Losses>0? num0($_Losses): 'n/a');?></td>

<?php

$_Wins=0;$_Draws=0;$_Losses=0;
// loss to win
 $q = "select count(hteam) as cNo, hteam from fixtures where hgoal<agoal and h_s>a_s and `div`='$home_div' and hteam=\"$home\"  and `weekno`<'$wk' and season='$sea' group by hteam";
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();
 $_Wins=$dd["cNo"];

 // loss 2 draw
$q = "select count(hteam) as cNo, hteam from fixtures where hgoal<agoal and h_s=a_s and `div`='$home_div' and hteam=\"$home\"  and `weekno`<'$wk' and season='$sea' group by hteam";
if ($db=='eu'){
    $temp = $eu->prepare($q) ;
}else{
    $temp = $sa->prepare($q);
}
$temp->execute();
$dd = $temp->fetch();
$_Draws=$dd["cNo"];

 // loss 2 loss
$q = "select count(hteam) as cNo, hteam from fixtures where hgoal<agoal and h_s<a_s and `div`='$home_div' and hteam=\"$home\"  and `weekno`<'$wk' and season='$sea' group by hteam";
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
	<td class='ctd' style="width:10%" <?php echo $w?>><?php echo  ($_Wins>0  ? num0($_Wins): 'n/a')  ;?></td>
	<td class='ctd' style="width:10%" <?php echo $d?>><?php echo  ($_Draws>0 ? num0($_Draws): 'n/a') ;?></td>
	<td class='ctd' style="width:10%" <?php echo $l?>><?php echo  ($_Losses>0? num0($_Losses): 'n/a');?></td>
 
  
  
  </tr>

<!-- percentage row -->
   <tr>
	<td class='ctd bold' <?php echo $w?>><?php echo ($per[0]>0? num0($per[0]).'%' : 'n/a'); ?></td>
	<td class='ctd bold' <?php echo $d?>><?php echo ($per[1]>0? num0($per[1]).'%' : 'n/a'); ?></td>
	<td class='ctd bold' <?php echo $l?>><?php echo ($per[2]>0? num0($per[2]).'%' : 'n/a'); ?></td>

	<td class='ctd bold' <?php echo $w?>><?php echo ($per[3]>0? num0($per[3]).'%' : 'n/a'); ?></td>
	<td class='ctd bold' <?php echo $d?>><?php echo ($per[4]>0? num0($per[4]).'%' : 'n/a'); ?></td>
	<td class='ctd bold' <?php echo $l?>><?php echo ($per[5]>0? num0($per[5]).'%' : 'n/a'); ?></td>

	<td class='ctd bold' <?php echo $w?>><?php echo ($per[6]>0? num0($per[6]).'%' : 'n/a'); ?></td>
	<td class='ctd bold' <?php echo $d?>><?php echo ($per[7]>0? num0($per[7]).'%' : 'n/a'); ?></td>
	<td class='ctd bold' <?php echo $l?>><?php echo ($per[8]>0? num0($per[8]).'%' : 'n/a'); ?></td>

  </tr>

</table>