











<?php 

	$wk = ($cur_wk-1); ?>

<div style="padding-bottom:10px"></div>
<!-- Chart of Rebilaibities -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #0080C0;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td width='100%' style='text-align:center' bgcolor="#f4f4f4"><FONT class='credit'>
		Current Season's Prediction Reliabilities </font></td>
		
	</tr>
	<tr height='20'>
		<td width='100%' style='text-align:center'><FONT class='credit' color='blue'><?php echo $home;?> </font> 
		<?php 
			if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
		    if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
		<FONT class='credit'> at Home</font></td>
		
	</tr>
	<tr>
		<td style='text-align:center' valign='top'><img src="Rb-Chart.php" border="0">  </td>
		
	</tr>	

	<tr height='20'>
		<td width='100%' style='text-align:center'><FONT class='credit' color='red'><?php echo $away;?></font> 
		<?php 

			if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
		    if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
		<FONT class='credit'>Away</FONT></td>
		
	</tr>
	<tr>
		<td style='text-align:center' valign='top'> <img src="Rb-Chart2.php" border="0">  </td>
		
	</tr>
</table>
<div style="padding-bottom:10px"></div>



<div style="padding-bottom:10px"></div>
<!-- Chart of Rebilaibities -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid red;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td width='100%' style='text-align:center' bgcolor="#f4f4f4">  <b><FONT class='credit'>
		Last Season's Prediction Reliabilities </b></td>
		
	</tr>
	
	<tr>
		<td style='text-align:center' valign='top'>
		 <?php 

		 	if ( ($hrank=="rel" or $hrank=="prom") and ($arank=="rel" or $arank=="prom") ){ 
				
				echo "<font size='2'><br>Last Season's Prediction Reliabilities data not avaliable for either team.</font><br><br>";
		    }else{
			
		 ?>
			<img src="Rb-Chart-last.php" border="0">   
		 <?php } ?>


		</td>
		
	</tr>

</table>




<div style="padding-bottom:10px"></div>
<!-- Prediction Accuracy  LAST SEASON-->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #666600;' width='98%' style="border-collapse: collapse"> 

	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>Prediction Accuracy Last Season for Home Team <font color='blue'><?php echo $home;?></font></font>
		<?php 
			if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
		    if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
		</td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top'>
			<?php   require_once("prediction-accuracy-last.php");  ?> </td>
		</td>
	</tr>
	
	<tr height='5'><td></td></tr>

	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>Prediction Accuracy Last Season for Away Team <FONT COLOR="red"><?php echo $away;?></FONT> </font> 
		<?php if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;?>
		</td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top'>
			<?php require_once("prediction-accuracy-away-last.php");  ?> </td>
		</td>
	</tr>

</table>




<div style="padding-bottom:10px"></div>
<!-- Predictin/Gls LAST SEASON-->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #660000;' width='98%' style="border-collapse: collapse"> 
	<tr>
		 <td width='50%' style='text-align:center; border-right:1px solid #555555;'>
			<font class='credit'>Home Team <FONT COLOR="blue"><?php echo $home; ?></font></font>
			<?php 
				if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
			    if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
			?>
		</td>

		  
		  
		  <td width='50%' style='text-align:center'>
			  <font class='credit'>Away Team <FONT COLOR="red"><?php echo $away; ?></font></font>
			  <?php 
			  	 if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
				 if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;
			   ?>
		  </td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top' colspan='3'>
			<?php  require_once("last-season-pred-gls.php"); ?> </td>
		</td>
	</tr>
	

</table>


<div style="padding-bottom:10px"></div>
<!-- Resutls to Date -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #FF9900;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>
		 LAST SEASON'S DETAILED MATCH OUTCOMES</font> </td>
	</tr>
	
	<tr>
		<td style='text-align:center' valign='top'> 
			<?php $loc ="Home"; require_once("results-by-team-last.php"); ?> 
		</td>
		<td > </td>
		<td style='text-align:center' valign='top'> 
			<?php $loc ="Away"; require_once("results-by-team-last.php"); ?> 
		</td>
	</tr>
	
	<?php if ($DIV=='NC'): ?>
		<tr height='20'>
			<td colspan='3' style='text-align:center' > 
				Ebbsfleet U - formerly Gravesend 
			</td>
		</tr>
	<?endif;?>

	<tr height='20'>
		<td colspan='3' style='text-align:center' > 
		<font color='red'> Act. Score</font> = Actual Score</font>&nbsp;&nbsp;|&nbsp;&nbsp;
		<font color='red'> RT</font> = Match Result</font>&nbsp;&nbsp;|&nbsp;&nbsp; 
		<font color='red'> ASL</font> = Anticipated Score-Line</font> 
		</td>
	</tr>
</table>

<div style="padding-bottom:10px"></div>
<!-- Resutls to Date -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #FF9900;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>
		 LAST SEASON'S DETAILED MATCH OUTCOMES</font> </td>
	</tr>
	
	<tr>
		<td style='text-align:center' valign='top'> 
			<?php $loc ="Home"; require_once("results-by-team-last2.php"); ?> 
		</td>
		<td > </td>
		<td style='text-align:center' valign='top'>
			<?php $loc ="Away"; require_once("results-by-team-last2.php"); ?> 
		</td>
	</tr>
	
	<?php if ($DIV=='NC'){ ?>
		<tr height='20'>
			<td colspan='3' style='text-align:center' > 
				Ebbsfleet U - formerly Gravesend 
			</td>
		</tr>
	<?php } ;?>

	<tr height='20'>
		<td colspan='3' style='text-align:center' > 
		<font color='red'> Act. Score</font> = Actual Score</font>&nbsp;&nbsp;|&nbsp;&nbsp;
		<font color='red'> RT</font> = Match Result</font>&nbsp;&nbsp;|&nbsp;&nbsp; 
		<font color='red'> ASL</font> = Anticipated Score-Line</font> 
		</td>
	</tr>
</table>

<div style="padding-bottom:10px"></div>

<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #FF9900;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td colspan='5' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>
		Last Season's Frequency of Goals For/Against </font> </td>
	</tr>
	<tr>
		<td style='text-align:center' colspan='5' width='100%'><font style='font-weight:bold;font-size:12px;'>Score-Lines</font></td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top' colspan='2' width='49%'>
			<?php $loc = "Home"; require_once("lastseason-goals-lines-by-team.php"); ?>
		</td>
		<td width='2%'></td>
		<td style='text-align:center' valign='top' colspan='2' width='49%'>
			<?php $loc = "Away"; require_once("lastseason-goals-lines-by-team.php"); ?>
		</td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top' colspan='2' width='49%'>
			<?php $loc = "Home"; require_once("last-season-goals-by-team.php"); ?>
		</td>
		<td width='2%'></td>
		<td style='text-align:center' valign='top' colspan='2' width='49%'>
			<?php $loc = "Away"; require_once("last-season-goals-by-team.php"); ?>
		</td>
	</tr>
	
</table>


<div style="padding-bottom:10px"></div>


</div>

