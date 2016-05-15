<?php
session_start();

include("config.ini.php");
include("function.ini.php");


if (!isset($db)){
  $db = 'eu';
}else{
  $db= $_GET['db'];
}

$ID = $_GET['season'];

$qry = "SELECT * from setting"; 

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
        


if (!isset($weekno)) $weekno = $lastweek ;
    


$errlog = "";

//if (check_season()=='1'){ header('Location: commences.php'); exit; }
if (isset($_SESSION['userid']) ):
	if ($_SESSION['expire'] < cur_week($db) ):
		if ( $weekno == cur_week($db) ) :
			$weekno=$lastweek-1;
			$errlog = "You will only be able to see the current week's data if you are logged in. To be able to log in you must be a fully subscribed member.";
		endif;
	endif;
elseif (!isset($_SESSION['userid']) and ($weekno==cur_week($db))) :
		//header("location: authorization.php");
		$errlog = "You will only be able to see the current week's data if you are logged in. To be able to log in you must be a fully subscribed member.";
		$weekno=$lastweek-1;
endif;



if (isset($_GET['db'])){
  $page_title = "Soccer Score-Line Hit/Miss Data " . s_title($db) . " Season $season";
}else{
  $page_title = "Soccer Score-Line Hit/Miss Data";
}

$active_mtab = 1;

include("header.ini.php");
?>


<? page_header("Analysis of Previous Soccer Predictions") ; ?>
<div style="padding-bottom:5px"></div>




<?if (isset($_GET['db'])){
    
	 if (strlen($errlog)>0):
			echo "<div class='errordiv'>$errlog</div>";
	 endif;


?>
<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>


<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">SCORE-LINE HIT/MISS DATA</div>



<p>Each of the various Analysis Sheets viewable under this section will show you the running outcome to date of
 the nearness (or otherwise) of the posted predictions in respect of the Segregated Selection's Top 6 
 ("Result Type") calls.</p>


<div style="padding-bottom:15px"></div>

<table  width="100%" align="center">
<tr>
	<td> <a class='sbar' href="analysis-of-previous-predictions.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"></td>
</tr>
</table>

<center>

<form method="get" action="anticipated-score-line-summary.php" onSubmit="popup3(this)" style="padding:0;margin:0;">
		<input type='hidden' name='db' value='<?php echo $_GET['db'];?>' />

		 <table border="1" cellpadding="5" cellspacing="0" style="border-collapse: collapse" bordercolor="#f4f4f4" width="420" >

				<tr>
                          
                      <td  height="22"  width='80'>
                        <span class='credit'><font  color="#0000ff">Season</font></span></td>

                      <td  height="22"  width='300' >
						   <select size="1" name="season" class="text">
						  
						  <? 
						
							$sqry = "SELECT distinct(season) as season from cur_cshit order by season desc";

							if ($db=='eu'){
						        $temp = $eu->prepare($sqry);
						    }else{
						        $temp = $sa->prepare($sqry);
						    }
						    $temp->execute();
						
						   while ($sr = $temp->fetch()) : 
						  ?>
							  <option value="<?= $sr["season"] ?>" <?echo selected($ID,$sr["season"])?>><?= $sr["season"] ?></option>
						  
						  <? endwhile; ?>
					</select>
                        
						
					</td>

                   </tr >

                  <td width="300" ><b><font size="2" color="#0000FF">Prediction Type</font></b></td>
		  <td>
		  
		  <select size="1" name="BET" class="text" style='width:250px;'  alt="selecti|0" emsg="Select Prediction Type">
			  
				<option style="color:black" value="F,HW" >Midweek Preferences - Homes</option>
				<option style="color:black" value="E,HW" >Weekend Short Odds - Homes</option>
				<option style="color:black" value="V,HW" >Weekend Medium Odds - Homes </option>
				<option style="color:black" value="L,HW" >Weekend Long Shots - Homes</option>
        
		  </select>
		  </td>
		  </tr>
					
					<tr>		
						<td align="center" height="30" colspan="2">
							<input type="submit" value="View Data" name="B1" class="bt" style='padding:8px 15px'>
						</td>
					</tr>
			</table>		  
	</form>

</center>

<?  
     

}else{
    
    
    echo '<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Score-Line Hit/Miss Data</div>';
    echo "<br>";
    include("select-option.ini.php");
    
} 

include("footer.ini.php"); 
?>