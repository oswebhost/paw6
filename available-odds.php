<?php
session_start();

include("config.ini.php");
include("function.ini.php");


if (!isset($_GET['db'])){
  $db= 'eu';
  $page_title="Soccer Betting Odds";
}else{
  $db= $_GET['db'];
  $page_title="Soccer Betting Odds " . site($_GET['db']);
}


$qry = "SELECT * FROM setting";
if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
$row = $temp->fetch() ;   

$updating = $row["updating"];
$sended=$row["seasonended"];
$lastweek = $row["weekno"];
$season  =$row["season"];

if ($LOG=="N"): $lastweek = $lastweek - 1; endif;
if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;





include("header.ini.php");



page_header("Weekly Odds v Predictions") ;

?> 
<div style="padding-bottom:2px"></div>


<?php if(isset($_GET['db'])){ 
	
	$db= $_GET['db'];
	

?>

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;"><?echo site($db);?></div>

  

<table border="0" width="100%" cellpadding="0" cellspacing="0" >
<tr>
   <td width="25%"><a class='sbar' href="bookies-odds-soccer-betting.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a></td>
   <td width="25%" align='center' colspan='3' valign="bottom"></td>
   <td width="25%" align="right"> </td>
</tr>
</table>

<? if (!isset($_SESSION["userid"])){ ?>
<div style='text-align:center;width:490px; margin:auto auto;border:1px solid #23488C;background:#E9EFFF;padding:5px;font-size:13px;line-height:120%'>
Our past data records are just one example of the fantastic tools we provide for helping you decide your current week’s betting selections.  Non-paying visitors can view the historic data by clicking on the headings shown below.    
</div>
<br />
<?}?>


<table width='95%' align='center'  border='0'>
    <tr>
    	<td align='center' width='20'><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'> <a class='sbar' href="odds-listing.php?db=<?php echo $db;?>" ><span class='big'>Soccer 1X2 Odds by Division</span></a>
    	</td>
    </td>

    <tr>
       <td colspan="2">
    	<div style="padding-bottom:10px;padding-left:30px;">
    	<p style="font-size:11px;padding:0;">Listed for each Division in order of Date/Time and Home Team name (alphabetical). 
    	</div>
    	</td>
    </tr>
    

    
<tr>
	<td align='center' width='20'><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" width='95%'> <a class='sbar' href="full-odds-listing.php?db=<?php echo $db;?>" ><span class='big'>Soccer 1X2 Odds All Divisions Combined </span></a>
	</td>
</td>
<tr>
   <td colspan="2">
	<div style="padding-bottom:10px;padding-left:30px;">
		<p style="font-size:11px;padding:0;">Listed by lowest Home Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical). 
			
</p>
				
	</div>
	
</td>
</tr>
 



<tr>
	<td align='center' width='20'><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" width='95%'> <a class='sbar' href="full-dcodds-listing.php?db=<?php echo $db;?>" ><span class='big'>Double Chance Odds All Divisions Combined </span></a>
	</td>
</td>
<tr>
   <td colspan="2">
	<div style="padding-bottom:10px;padding-left:30px;">
		<p style="font-size:11px;padding:0;">Listed by lowest 1/X Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical). 
			
</p>
				
	</div>
	
</td>
</tr>



<tr>
	<td align='center' width='20'><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" width='95%'> <a class='sbar' href="full-winonly-listing.php?db=<?php echo $db;?>" ><span class='big'>Win Only Odds (Draw = No Bet) All Divisions Combined </span></a>
	</td>
</td>
<tr>
   <td colspan="2">
	<div style="padding-bottom:10px;padding-left:30px;">
		<p style="font-size:11px;padding:0;">Listed by lowest Home Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical). 
			
</p>
				
	</div>
	
</td>
</tr>

<tr>
	<td align='center' width='20'><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" width='95%'> <a class='sbar' href="full-asian-listing.php?db=<?php echo $db;?>" ><span class='big'>Asian Handicap Odds All Divisions Combined </span></a>
	</td>
</td>
<tr>
   <td colspan="2">
	<div style="padding-bottom:10px;padding-left:30px;">
		<p style="font-size:11px;padding:0;">Listed by lowest Home Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical). 
			
</p>
				
	</div>
	
</td>
</tr>

<tr>
	<td align='center' width='20'><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" width='95%'> <a class='sbar' href="full-underover-listing.php?db=<?php echo $db;?>" ><span class='big'>Soccer Under/Over Odds All Divisions Combined </span></a>
	</td>
</td>

</tr>


<tr>
   <td colspan="2">
	<div style="padding-bottom:10px;padding-left:30px;">
		<p style="font-size:11px;padding:0;">Listed by lowest Under Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical). 
			
</p>
				
	</div>
	
</td>
</tr>

<tr>
    	<td align='center' width='20'><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'> <a class='sbar' href="calltype-listing.php?db=<?php echo $db;?>" ><span class='big'>By Predict-A-Win Call Type (1X2)</span></a>
    	</td>
    </td>
</tr>
    <tr>
       <td colspan="2">
    	<div style="padding-bottom:10px;padding-left:30px;">
    			<p style="font-size:11px;padding:0;"> Split into PaW's Home, Win and Draw calls, then listed by lowest Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical). </p>
    	</div>
    	
    </td>
 </tr>
 <tr>
    	<td align='center' width='20'><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'> <a class='sbar' href="bookie-paw-expectations.php?db=<?php echo $db;?>&PARA=" ><span class='big'>Bookie v PaW Expectations</span></a>
    	</td>
    </td>

</tr>
 
    <tr>
       <td colspan="2">
    	<div style="padding-bottom:10px;padding-left:30px;">
    			<p style="font-size:11px;padding:0;">Split into Bookie's Home, Win and Draw calls, then listed by lowest Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical).  </p>
    	</div>
    	
    </td>
 </tr>

<tr>
	<td align='center' ><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" > <a class='sbar' href="full-overround-listing.php?db=<?php echo $db;?>" ><span class='big'>Specific Call Type Over-Rounds - All Matches Combined</span></a>
	</td>
</td>
<tr>
   <td colspan="2">
	<div style="padding-bottom:10px;padding-left:30px;">
		<p style="font-size:11px;padding:0;">
			
		</p>
						
	</div>
	
</td>
</tr>


</table>

<?}else{

	include("select-option.ini.php");
}


include("footer.ini.php"); 

?>