<?php

$qry2 = "select * from cs_odds where  season='$sea' and matchno='$_GET[id]'";

if ($db=='eu'){
   $temp2 = $eu->prepare($qry2) ;
}else{
   $temp2 = $sa->prepare($qry2);
}
$temp2->execute();
$ro = $temp2->rowcount();
$ddd = $temp2->fetch() ;





?>
<style >
	#xtd2{text-align:center; width:51px;font-weight:bold;border-right:1px solid gray;}
	#xtd3{text-align:center; width:51px;font-weight:bold;border-right:1px solid gray;border-top:1px solid gray;}
	#xtd4{text-align:center; width:51px;font-weight:bold;border-right:0px solid gray;}
	#xtd5{text-align:center; width:51px;font-weight:bold;border-right:0px solid gray;border-top:1px solid gray;}

</style>

<center>

<table width='100%' border='0' cellpadding='2' cellspacing='0' style="border-collapse: collapse;" bordercolor="gray">
 <tr>
	<td id='xtd2' bgcolor='#EAEAFF'>1-0</td>
	<td id='xtd2' bgcolor='#EAEAFF'>2-1</td>
	<td id='xtd2' bgcolor='#EAEAFF'>2-0</td>
	<td id='xtd2' bgcolor='#EAEAFF'>3-1</td>
	<td id='xtd2' bgcolor='#EAEAFF'>3-0</td>
	<td id='xtd2' bgcolor='#DFFFDF'>1-1</td>
	<td id='xtd2' bgcolor='#DFFFDF'>0-0</td>
	<td id='xtd2' bgcolor='#DFFFDF'>2-2</td>
	<td id='xtd2' bgcolor='#FFD2D2'>0-1</td>
	<td id='xtd2' bgcolor='#FFD2D2'>1-2</td>
	<td id='xtd2' bgcolor='#FFD2D2'>0-2</td>
	<td id='xtd2' bgcolor='#FFD2D2'>1-3</td>
	<td id='xtd4' bgcolor='#FFD2D2'>0-3</td>
</tr>

 <tr>
	<td id='xtd3' bgcolor='#EAEAFF'><?php echo($ro>0? num2($ddd['col1']):'&nbsp;');?></td>
	<td id='xtd3' bgcolor='#EAEAFF'><?php echo($ro>0? num2($ddd['col2']):'');?></td>
	<td id='xtd3' bgcolor='#EAEAFF'><?php echo($ro>0? num2($ddd['col3']):'');?></td>
	<td id='xtd3' bgcolor='#EAEAFF'><?php echo($ro>0? num2($ddd['col4']):'');?></td>
	<td id='xtd3' bgcolor='#EAEAFF'><?php echo($ro>0? num2($ddd['col5']):'');?></td>
	<td id='xtd3' bgcolor='#DFFFDF'><?php echo($ro>0? num2($ddd['col6']):'');?></td>
	<td id='xtd3' bgcolor='#DFFFDF'><?php echo($ro>0? num2($ddd['col7']):'');?></td>
	<td id='xtd3' bgcolor='#DFFFDF'><?php echo($ro>0? num2($ddd['col8']):'');?></td>
	<td id='xtd3' bgcolor='#FFD2D2'><?php echo($ro>0? num2($ddd['col9']):'');?></td>
	<td id='xtd3' bgcolor='#FFD2D2'><?php echo($ro>0? num2($ddd['col10']):'');?></td>
	<td id='xtd3' bgcolor='#FFD2D2'><?php echo($ro>0? num2($ddd['col11']):'');?></td>
	<td id='xtd3' bgcolor='#FFD2D2'><?php echo($ro>0? num2($ddd['col12']):'');?></td>
	<td id='xtd5' bgcolor='#FFD2D2'><?php echo($ro>0? num2($ddd['col13']):'');?></td>
</tr>
 
</table>



</center>


