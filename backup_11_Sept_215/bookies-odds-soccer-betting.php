<?php
session_start();

include("config.ini.php");
include("function.ini.php");


if (!isset($_GET['db'])){
   $page_title="Soccer Betting Odds";
}else{
   $page_title="Soccer Betting Odds " . site($_GET['db']);
}


$qry = "SELECT * FROM setting";
$db= $_GET['db'];
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

/*
if ($LOG=="N"): $lastweek = $lastweek - 1; endif;
if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;
*/



$show_key= meta_bettingdata();
$desc = "Current week's Odds collected from reputable Bookies covering a wide range of betting scenarios from 1X2 betting, through Double Chance, Outright Wins, Asian Handicap, Under/Over and Correct Scores betting.";

include("header.ini.php");



page_header("Current Week's Odds") ;

?> 
<div style="padding-bottom:2px"></div>




 <?php if (!isset($_SESSION["userid"])){ ?>
	     		
	 		<div class='errordiv'>
	 			
	 		   
			   <b>NOTE:</b> Because we show our match Predictions Data against the Odds being offered, you will <span class="red">NOT</span> be able to access the Current Week's Data in this section <span class='red'>if you are not registered</span>, but you will be able to review the data for all Past Weeks.<br />
	 			 <div style='margin-top:10px;text-align:center'>
				  <a title='Get Soccer Predictions Data Now!' href="<?=$domain?>/register.php">	
				  <img src='<?=$domain?>/images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
				</div>
	 		</div>
	
<?php }else{ echo "<br/ >"; } ?>  

<table border="0" width="100%" cellpadding="0" cellspacing="0" >
<tr>
   <td width="25%"><a class='sbar' href="bookies-odds-soccer-betting.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a></td>
   <td width="25%" align='center' colspan='3' valign="bottom"></td>
   <td width="25%" align="right"> </td>
</tr>
</table>
<br />



<table width='95%' align='center'  border='0' cellpadding="4" cellspacing="0">
    <tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'> <a class='sbar' href="odds-listing.php" ><span class='big'>1X2 Odds by Division</span></a>
		
		<div style="padding-bottom:15px;padding-top:5px;font-size:12px;">
        	Listed for each Division in order of Date/Time and Home Team name (alphabetical). 
    	</div>
    	
		</td>    		
    </tr>

    

    
<tr class="hovers">
	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" width='95%'> <a class='sbar' href="full-odds-listing.php" ><span class='big'>1X2 Odds All Divisions Combined </span></a>
		
		<div style="padding-bottom:15px;padding-top:5px;font-size:12px;">
        	Listed by lowest Home Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical). 
    	</div>
	</td>
</tr>



<tr class="hovers">
	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" width='95%'> <a class='sbar' href="full-dcodds-listing.php" ><span class='big'>Double Chance Odds All Divisions Combined </span></a>
		
		<div style="padding-bottom:15px;padding-top:5px;font-size:12px;">
        	Listed by lowest 1/X Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical). 
    	</div>
	</td>
</tr>


<tr class="hovers">
	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" width='95%'> <a class='sbar' href="full-winonly-listing.php" ><span class='big'>Win Only Odds (Draw = No Bet) All Divisions Combined </span></a>
    
    	<div style="padding-bottom:15px;padding-top:5px;font-size:12px;">
        	Listed by lowest Home Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical).
    	</div>
    	
    </td>
</tr>

<tr class="hovers">
	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" width='95%'> <a class='sbar' href="full-asian-listing.php" ><span class='big'>Asian Handicap Odds All Divisions Combined </span></a>
    	
    	<div style="padding-bottom:15px;padding-top:5px;font-size:12px;">
        	Listed by lowest Home Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical).  
    	</div>
    	
    </td>
</tr>

<tr class="hovers">
	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" width='95%'> <a class='sbar' href="full-underover-listing.php" ><span class='big'> Under/Over Odds All Divisions Combined </span></a>
    	
    	<div style="padding-bottom:15px;padding-top:5px;font-size:12px;">
        	Listed by lowest Under Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical).  
    	</div>
    
    </td>
</tr>

<tr class="hovers">
    <td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'> <a class='sbar' href="calltype-listing.php" ><span class='big'>By Predict-A-Win Call Type (1X2)</span></a>
        
        <div style="padding-bottom:15px;padding-top:5px;font-size:12px;">
        	Split into PaW's Home, Win and Draw calls, then listed by lowest Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical). 
    	</div>
    	
    	</td>
</tr>

<tr class="hovers">
    	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
    	<td valign="top" width='95%'> <a class='sbar' href="bookie-paw-expectations.php" ><span class='big'>Bookie v PaW Expectations</span></a>
        
    	<div style="padding-bottom:15px;padding-top:5px;font-size:12px;">
        	Split into Bookie's Home, Win and Draw calls, then listed by lowest Odds first and then, where identical Odds occur, in order of Date/Time and Home Team name (alphabetical).  
    	</div>
    	
    	</td>


</tr>

<tr class="hovers">
	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" > <a class='sbar' href="full-overround-listing.php" ><span class='big'>Specific Call Type Over-Rounds - All Matches Combined</span></a>
		
		<div style="padding-bottom:15px;padding-top:5px;font-size:12px;">
        	 
    	</div>
    	
	</td>
</tr>

<tr class="hovers">
	<td valign='top' style="padding-top:5px;"><img src="images/bbullet.gif" border="0" alt="" /></td>
	<td valign="top" ><a class='sbar' href="<?=$domain?>/soccer-1X2-value-bets.php"  title='"Possible Value Calls'><span class='big'>Possible Value Calls</span></a>
		
		<div style="padding-bottom:15px;padding-top:5px;font-size:12px;">
        	 
    	</div>
	</td>
</tr>

</table>

<?php
include("footer.ini.php"); 

?>