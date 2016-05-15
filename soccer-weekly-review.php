<?php

session_start();

include("config.ini.php");
include("function.ini.php");

$bluebox_message = 200;

$page_title="Soccer Weekly Predictions Betting Reviews";

include("header.ini.php");
?>

<? page_header("Soccer Weekly Reviews") ; ?>
<div style="padding-bottom:2px"></div>

<?

if(isset($_GET['db'])){ 
	$db= $_GET['db'];



$last_week = cur_week($db) - 1;

if (!isset($_GET['ID'])){
	$ID = $last_week;
}else{
	$ID = $_GET['ID'];
}

if (!isset($_GET['seas'])){
	$seas= curseason($db) ;
}else{
	$seas= $_GET['seas'];
}

$weekly_data = 0;
$weekly_data = segcall_count($ID,$seas,$db); // count available selection data for week


$cfile = "hypes/" .$seas ."/week" . $ID . ".html" ;

$errormsg = "No matches available for selection in Week $ID Season $seas.";


?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>
		


<form name="review" method="get" action="soccer-weekly-review.php" style="padding:0;margin:0;">
	<input type='hidden' name='db' value="<?php echo $_GET['db'];?>"/>

<table width="500" style='margin:auto auto;' border='0'>
<tr>
	<td width="20"><span class='credit'><font  color="#0000ff">Season:</font></span></td>
	<td width="100">
		<select size="1" name="seas" class="text" style='padding:1px 4px;'>
		 		  <option value="<?php echo curseason($db);?>"><?php echo curseason($db);?></option>
		</select>
	</td>
	<td width="20"><span class='credit'><font  color="#0000ff">Week:</font></span></td>
	<td width="250">
		<select size="1" name="ID" class="text" style='padding:1px 4px;' onChange="this.form.submit();">
		<?
		  for ($j=$last_week; $j>=1; $j--):
				echo "<option value='$j'" ;
					if ($j==$ID): echo " selected"; endif;
				echo ">$j</option>\n\n";
		  endfor;
		?>
		</select>
	</td>

</tr>
</table>
</form>

<BR>
<!-- startprint -->

<?php if ($weekly_data==0){

	echo "<div class='errordiv ctd' style='text-align:center;'><b>$errormsg</div>";

}else{?>

		<table width="99%"  style='border-top:1px solid #cccccc;'>
		<tr>
			<td ><span class='credit'><FONT COLOR="#000000"><?=$seas;?></font> Week <FONT COLOR="#0000ff"><?=$ID?></FONT> Review</span>
			</td>
			<td width="80" align='right'><?=  printscr() ;?></td>
		</tr>
		</table>
		 

		<p class="review" style="padding:0px 30px 10px 20px;">We show you below how you would have fared in <b>Week <? echo $ID ?></b> if you had placed just 1 Unit on a "singles" bet for all the various Bet Types available to you in respect of our posted Selections. Please note that we would not expect to win consistently using such a wide bet base, and we show this information for interest only. Remember, we recommend Correct Scores betting, not 1X2 betting! Details as to how each ranked prediction performed for the week can be found by accessing the "Prediction Performance Records" on the right-hand side of the screen.</p>




	<center>
		 <!-- RT 5 -->
		<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#CDCDCD" width="90%">

			<tr bgcolor="#d3ebab">
				<td colspan="2" rowspan="2" class='ctd' style="width: 350px;"><img src="images/tbcap/predtype2.gif"  border="0" alt=""></td>
				<td class='ctd' colspan="2"><img src="images/tbcap/noofbets.gif"  border="0" alt=""></td>
				<td class='ctd' colspan="2"><img src="images/tbcap/noofunit.gif"  border="0" alt=""></td>
			</tr>
			<tr bgcolor="#d3ebab">
				<td class='ctd'><img src="images/tbcap/laid.gif"  border="0" alt=""></td>
				<td class='ctd'><img src="images/tbcap/won.gif"  border="0" alt=""></td>
				<td class='ctd'><img src="images/tbcap/lost.gif"  border="0" alt=""></td>
				<td class='ctd'><img src="images/tbcap/won.gif"  border="0" alt=""></td>
			</tr>
			


		<? $number=1; $rowcol = rowcol($number); ?>

		    
		   

		<tr <? echo $rowcol ?>>
		    <td colspan='6' style='padding:3px;'><img src='images/segselecttop6.png' border='0' /></td>
		</tr>

		<?
		$bet  = array("F","E","V","L") ;
		 

		for ($i=0; $i<count($bet); $i++)
		{ 
		  if ($i==0) {$class= array("HW");}else{$class= array("HW"); }
		   
		  $number++;
		  $rowcol = rowcol($number);
		?>  
		    <tr <? echo $rowcol ?> height='22'>
		    <td colspan='6' class='tdper' style='padding:6px;'><b><? echo prt_bet($bet[$i]) ;?></b></td>
		    </tr>
		<?  
		    for ($j=0; $j<count($class); $j++)
		    {
		       $number++;
		       $rowcol = rowcol($number);   
		       $segdata = segcalls($ID,$bet[$i], $class[$j], $seas,$db);
		       
		       $laid += $segdata->laid ; $won += $segdata->win ;
		       $unit_lost += $segdata->net_lost ; $unit_won += $segdata->net_win ;
		    ?>
		     <tr <? echo $rowcol ?> height='22'>
		        <td width='130' style='padding:3px;width:180px'></td>
		        <td class='tdper' style="padding-left: 5px;"><? echo prt_bet($class[$j]) ?></td>
				<? if($segdata->laid>0){ 
					$week_url = "<a class='pp' href=\"javascript:sele_win('selections-details.php?PARA=$seas,$bet[$i],$ID,$class[$j],$db')\">". prt_0($segdata->laid) ."</a>" ;
				?>
			        <td class='ctd tdper'><? echo $week_url; ?></td>  
				<? } else { ?>
					<td class='ctd tdper'><? echo prt_0($segdata->laid); ?></td>  
				<? }?>
		        
				<td class='ctd tdper'><? echo prt_0($segdata->win);  ?></td>
		        <td class='ctd tdper red0'><? echo prt($segdata->net_lost);?></td>
		        <td class='ctd tdper'><? echo prt($segdata->net_win); ?></td>  
		     </tr>
		         
		<?    
		    }
		}
		 

		       $number++;
		       $rowcol = rowcol($number);   
		       $segdata = segcalls($ID,"E", "AD", $seas,$db);
		       
		       $laid += $segdata->laid ; $won += $segdata->win ;
		       $unit_lost += $segdata->net_lost ; $unit_won += $segdata->net_win ;
		    ?>
		  
		     
		<?     
		if ($unit_lost>$unit_won) : $nlost= prt($unit_lost-$unit_won) ;
		else: $nlost=  prt(0); endif;
		if ($unit_won>$unit_lost) : $nwon= prt($unit_won-$unit_lost) ;
		else: $nwon=  prt(0); endif;



		?>

		<tr>
		      <td bgcolor="#F6F6F6"   colspan="2" style="text-align: right;padding:3px;" class="total">
		      <b>Sub-totals</b></td>
		      <td class="total ctd" bgcolor="#F6F6F6" ><b><? echo prt_0($laid) ?></b></td>
		      <td class="total ctd" bgcolor="#F6F6F6">
		      <b><? echo prt_0($won) ?></b></td>
		      <td class="total ctd" bgcolor="#F6F6F6" ><b>
		      <font color="#FF0000"><? echo prt($unit_lost) ?></font></b></td>
		      <td class="total ctd" bgcolor="#F6F6F6"><b><? echo prt($unit_won) ?></b></td>
		</tr>
		    
		 <tr>
		      <td bgcolor="#EFF5FA"   colspan="4" style="text-align: right;padding:3px;" class="total">
		      <b>TOTAL:</b></td>
		      <td class="total ctd" bgcolor="#EFF5FA" ><b>
		      <font color="#FF0000"><? echo  $nlost ?></font></b></td>
		      <td class="total ctd" bgcolor="#EFF5FA" ><b><? echo $nwon ?></b></td>
		</tr> 

		</table>
	</center>




<?php } ?>

<div style="padding-left:15px;margin-bottom:20px;"></div>


 <!-- stopprint -->        



<?}else{

	include("select-option.ini.php");
}


include("footer.ini.php")  ; 

?>