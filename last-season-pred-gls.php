<?php

$home = ($home=='Ebbsfleet U'? "Gravesend": $home);
$away = ($away=='Ebbsfleet U'? "Gravesend": $away);

$qry = "select * from asl_gls where season='$last_season' and team=\"$home\" and side='H'";

if ($db=='eu'){
	$tempw = $eu->prepare($qry);
}else{
	$tempw = $sa->prepare($qry);
}
$tempw->execute();
$hq = $tempw->fetch();

$qry = "select * from asl_gls where season='$last_season' and team=\"$away\" and side='A'";
if ($db=='eu'){
	$tempw = $eu->prepare($qry);
}else{
	$tempw = $sa->prepare($qry);
}
$tempw->execute();
$aq = $tempw->fetch();

?>


<table border="0" width="100%" style="border-collapse: collapse;" class="tb">
<tr>
	
	<td class='ctd chattd' colspan="9"  bgcolor="#D2D2FF"><b>PROGRAM`s GOAL PREDICTION ACCURACY LAST SEASON</b></td>
	
</tr>
	
	<td class='ctd chattd' colspan="2" width="22%"><img border="0" src="../pic_images/gf.gif"></td>
	<td class='ctd chattd' colspan="2" width="22%"><img border="0" src="../pic_images/ga.gif"></td>
	<td style="text-align: center;width:3%;"></td>
	<td class='ctd prob chattd' colspan="2" width="22%"><img border="0" src="../pic_images/gf.gif"></td>
	<td class='ctd prob chattd' colspan="2" width="22%"><img border="0" src="../pic_images/ga.gif"></td>
	
</tr>
<tr>
	
	<td class='ctd prob chattd'><img border="0" src="../pic_images/act.gif" alt='' ></td>
	<td class='ctd prob chattd'><img border="0" src="../pic_images/pred.gif" alt='' ></td>
	<td class='ctd prob chattd'><img border="0" src="../pic_images/act.gif" alt='' ></td>
	<td class='ctd prob chattd'><img border="0" src="../pic_images/pred.gif" alt='' ></td>
	<td class='ctd' width="4">&nbsp;</td>
	<td class='ctd prob chattd'><img border="0" src="../pic_images/act.gif" alt='' ></td>
	<td class='ctd prob chattd'><img border="0" src="../pic_images/pred.gif" alt='' ></td>
	<td class='ctd prob chattd'><img border="0" src="../pic_images/act.gif" alt='' ></td>
	<td class='ctd prob chattd'><img border="0" src="../pic_images/pred.gif" alt='' ></td>
	
</tr>
<tr>
	
	<td class='ctd prob chattd'><?php echo  num0($hq['actgf']);?></td>
	<td class='ctd prob chattd'><?php echo  num0($hq['aslgf']);?></td>
	<td class='ctd prob chattd'><?php echo  num0($hq['actga']);?></td>
	<td class='ctd prob chattd'><?php echo  num0($hq['aslga']);?></td>
	<td class='ctd' width="4">&nbsp;</td>
	<td class='ctd prob chattd'><?php echo  num0($aq['actgf']);?></td>
	<td class='ctd prob chattd'><?php echo  num0($aq['aslgf']);?></td>
	<td class='ctd prob chattd'><?php echo  num0($aq['actga']);?></td>
	<td class='ctd prob chattd'><?php echo  num0($aq['aslga']);?></td>
	
</tr>

</table>


<table border="1" width="100%" style="border-collapse: collapse" class="tb">
<tr>
	<td class='ctd' bgcolor="#FFCCCC" colspan="11"><b>PROGRAM`s OVERALL PREDICTION RESULT CORRECTNESS LAST SEASON</b></td>
</tr>
<tr>
	<td class='ctd' width="3%"  rowspan="2" bgcolor="#FFCCCC"><img border="0" src="../pic_images/htotal.gif" ></td>
	<td class='ctd ctd' colspan="3"  width='33%'><img border="0" src="../pic_images/hcs.gif" ></td>
	<td style="text-align: center;width:62px" rowspan="2" class="prob"><img border="0" src="../pic_images/htoo.gif"></td>
	<td style="text-align: center;width:14px;" bgcolor="#FFCCCC"></td>
	<td colspan="3"  width='32%' class="prob ctd"><img border="0" src="../pic_images/acs.gif"></td>
	<td style="text-align: center;" rowspan="2" class="prob"><img border="0" src="../pic_images/atoo.gif"></td>
	<td class='ctd' width="3%" rowspan="2" bgcolor="#FFCCCC"><img border="0" src="../pic_images/atotal.gif"></td>
</tr>
<tr>
	<td class='ctd prob'><img border="0" src="../pic_images/h_cs.gif"></td>
	<td class='ctd prob'><img border="0" src="../pic_images/h_cr.gif"></td>
	<td class='ctd prob'><img border="0" src="../pic_images/h_cs-cr.gif"></td>
	<td class='ctd' bgcolor="#FFCCCC" style='border-bottom:0;' >&nbsp;</td>
	<td class='ctd prob'><img border="0" src="../pic_images/a_cs.gif"></td>
	<td class='ctd prob'><img border="0" src="../pic_images/a_cr.gif"></td>
	<td class='ctd prob'><img border="0" src="../pic_images/acs-cr.gif"></td>
</tr>
<tr>
	<td class='ctd prob' bgcolor="#FFCCCC"><?php echo  num0($hq['game']);?></td>
	<td class='ctd prob' ><?php echo  num0($hq['gls4']);?></td>
	<td class='ctd prob' ><?php echo  num0($hq['rt']);?></td>
	<td class='ctd prob' ><?php echo  num0($hq['rtgls']);?></td>
	<td class='ctd prob' ><?php echo  num0($hq['thigh']);?> / <?php echo  num0($hq['tlow']);?></td>
	<td class='ctd' bgcolor="#FFCCCC" ></td>
	<td class='ctd prob' ><?php echo  num0($aq['gls4']);?></td>
	<td class='ctd prob' ><?php echo  num0($aq['rt']);?></td>
	<td class='ctd prob' ><?php echo  num0($aq['rtgls']);?></td>
	<td class='ctd prob' ><?php echo  num0($aq['thigh']);?> / <?php echo  num0($aq['tlow']);?></td>
	<td class='ctd prob' bgcolor="#FFCCCC"><?php echo  num0($aq['game']);?></td>
</tr>
</table>


<table border="0" width="100%" id="table5" cellspacing="0" class="tb">

<tr>
	<td width="6" bgcolor="#FFECD9">&nbsp;</td>
	<td class='ctd' bgcolor="#FFECD9"><b>KEY for data shown above</b></td>
	<td width="4" bgcolor="#FFECD9">&nbsp;</td>
</tr>
<tr>
	<td width="6" bgcolor="#FFECD9">&nbsp;</td>
	<td class="key" class='ctd'><img src="../pic_images/keys2.gif"></td>
	<td width="4" bgcolor="#FFECD9">&nbsp;</td>
</tr>
</table>