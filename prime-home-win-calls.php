<?php

session_start();
require_once("config.ini.php");
require_once("function.ini.php");


$n_max = 0 ;


if (isset($_GET['PARA'])){
    $parts = explode(",",$_GET['PARA']);
    $BET   = $parts[0];
    $RESULT= $parts[1];
    $weekno=$parts[2];
    $db = $parts[3];
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
    


if (!isset($weekno)) $weekno = $lastweek ;
    
$errlog = "";

//if (check_season()=='1'){ header('Location: commences.php'); exit; }
if (isset($_SESSION['userid']) ):

  if ($_SESSION['expire'] < cur_week($db) ):
    if ( $weekno == cur_week($db) ) :
      $weekno=$lastweek-1;
      $errlog = limited_asscess_message($db);
    endif;
  endif;
elseif (!isset($_SESSION['userid']) and ($weekno==cur_week($db))) :
    //header("location: authorization.php");
    $errlog = limited_asscess_message($db);
    $weekno=$lastweek-1;
endif;




$page_title="Prime Home Win Calls (Top 6)";



if ($RESULT=="AD" and $BET=="E"){
    $cbet ="weekend"; $type="draws";
}elseif($RESULT=="AD" and $BET=="F"){
    $cbet ="Midweek"; $type="draws";
}else {
  $cbet = selection_type($BET) ;
  $type = match_type($RESULT); 
}
$match =  $type;
$match = $cbet . printv(" - ") . $type;

switch ($RESULT) :
	case "HW": $odd_from = "Odds from BetExplorer";  break; 
	case "AW": $odd_from = "Odds from BetExplorer";  break; 
	case "AD": $odd_from = "Odds from BetExplorer";  break; 
	case "CH": $odd_from = "Odds from Gamebookers";  break; 
	case "CA": $odd_from = "Odds from Gamebookers";  break; 
	case "CS": $odd_from = "Odds from Gamebookers";  break; 
endswitch;
		

$wkday = date("w");

if ($BET=="F" and $weekno==cur_week($db) and $wkday<=2){ 
	$msg = "<div style='color:red;padding:5px 20px 5px 20px;font-size:11px;text-align:justify;'>
  If nothing is shown here by Tuesday this week, then it means that there are no suitable selections for 
  this category for the current week. However, you can still view all the records for the past weeks 
  selections by going to the appropriate \"Week No\" from the above panel (where Week No:  1'
    represents our posting for the first week in the current season).   </div>";

}elseif ($BET<>"F" and $weekno==cur_week($db) and $wkday>=5){ 
	$msg = "<div style='color:red;padding:5px 20px 5px 20px;font-size:11px;text-align:justify;'>
  Nothing will be shown here for the current week in respect of our Program�s weekend selections until 
  Friday this week at the earliest. If nothing is shown here by Saturday, then it means that there are no 
  suitable selections for this category for the current week. However, you can still view all the records for 
  the past weeks selections by going to the appropriate \"Week No\" from the above panel  where (Week 
    No: 1 represents our posting for the first week in the current season). 
  </div>";

}elseif ($weekno<>cur_week($db)){
	$msg = "<div style='color:red;padding:5px 20px 5px 20px;font-size:11px'>
    No Matches this Week.
  </div>";
}


$pwk = $weekno-1;
$nwk = $weekno+1;
$season = curseason($db);
$page_title = "Prime Home Win Calls ". s_title($db) ." Season $season Week $weekno $cbet $type ";

 

$nurl="$PHP_SELF?PARA=$BET&#44$RESULT&#44$weekno&#44$db";
 
$qry = "SELECT * FROM fixtures WHERE `weekno`='$weekno'"; 
if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
while ($row = $temp->fetch()):
	$wdate   =$row["wdate"];
	$weekno  =$row["weekno"];
endwhile;


require_once("header.ini.php");


$pageURL="PARA=$BET&#44$RESULT&#44$weekno&#44$db";




?>



<?php page_header("Prime Home Win Calls (Top 6)") ; 

 if (strlen($errlog)>0):
		echo "<div class='errordiv'>$errlog</div>";
 endif;

?>


<div style="padding-bottom:2px"></div>



<table border="0" width="100%" cellpadding="0" cellspacing="0" >
 <tr>
    <td width="25%"><? echo back(); ?></td>

   <td width="25%" height="20" align='center' colspan='3' valign="bottom">
		<form method='get' style='padding:0;margin:0;'>
        
    
          
          <b>Week No: </b><select size="1" name="PARA" class="text" onChange="this.form.submit();">
	   <?php
			 $br=0;
			 
			 for ($other=cur_week($db); $other>=1; $other--) :
				$br++;
				echo "<option value='$BET,$RESULT,$other,$db'" ;
					if ($other==$weekno): echo " selected"; endif;
				echo ">$other</option>\n\n";
			 endfor;
			 echo "</select>";	

	   ?>
       </form>
	 </td>
	<td width="25%" align="right"> <? echo printEASE(); ?></td>
	</tr>
 </table>

<div style='padding-bottom:10px;'></div>

<!-- startprint -->

<div class="report_blue_heading" style="width: 568px;margin:0 auto 5px auto;"><?php echo site($db);?></div>

<?php  week_box_new($match, $weekno, $wdate, $season,570) ; ?>
 


<div align='center' style="padding-top:5px">


<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#CDCDCD" width="570" >
<tr bgcolor="#d3ebab">
  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/rankno.gif"  border='0' alt=""/> </td>
  <td width="10%" class='ctd' rowspan="2"><img src="images/tbcap/datepic.gif"  border="0" alt=""/></td>
  <td width="38%" class='ctd' rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
  <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
  <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
  <td width="24%" class='ctd' colspan="3"><img src="images/tbcap/probs.gif"  border='0' alt=""/></td>
  <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/odds.gif"  border="0" alt=""/></td>

</tr>
<tr bgcolor="#d3ebab">
  <td width="8%" class='ctd'><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/a.gif"  border='0' alt=""/></td>
</tr>

<?php  

$qry = "SELECT * FROM quickpick WHERE weekno=$weekno AND bettype='$BET' and matchtype='$RESULT' and rank<='60' and season='$season' order by rank";



if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}

   $temp->execute();

    if ($temp->rowCount()==0){
       echo "<tr><td colspan='10' class='ctd' style='padding:30px;'><span class='error'>$msg</span></td></tr>";
    }else {
        
    $pic = "/pic/" ;
    $pic =  $weekno ."/pic";
    $number=0;
    $ngot =0 ;
    $css = 0;

    while ($row = $temp->fetch()) {
        
        $number++;
        $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;
        
        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&site=$db')\">";
        $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="soccer-league-tables.php?db='. $db.'&season_value='. curseason($db) .'&div_value=' . $row["div"] .'">'. $row["div"].'</a>';
        
        $title = "$row[hteam] v $row[ateam] match odds" ;
        $odd = "";
        if ($RESULT=="HW"){ $odd = $row[h_odds]; }
        if ($RESULT=="AW"){ $odd = $row[a_odds]; }
        if ($RESULT=="AD"){ $odd = $row[d_odds]; }
        if ($odd <= 0 ) { $odd = ""; }
  
        $asl_class ="";
       
        if ($row['gotit']=='1' and $row['h_s']<>'P'){
            $asl_class = " gotrt";
        }
        
        if ($asl==$act){
            $asl_class = " gotasl";
            $css ++;
        }
        
        if ($row['h_s']=='P'){
            $asl_class = " pp";
        }

?>	
<tr <?php echo rowcol($number);?>>

    <td class="ctd padd"><?php echo $number; ?></td>
    <td class="ctd "><a class='md2' <?php echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?php echo $matchno;?>&site=<?php echo $db;?>'><?php echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

     <td class='padd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?php echo $row['hteam']?>&site=eu">
        <?php echo $row['hteam'] .'</a>' . printv(' v '); ?>
        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?php echo $row['ateam']?>&site=eu">
            <?php echo $row['ateam'];?></a>
     </td>
     
    <td class="ctd"><?php echo $ltable; ?></td>
    <td class="ctd <?php echo $asl_class;?>"><?php echo $row['hgoal'] . dash() . $row['agoal'];?></td>
    <td class="ctd <?php echo $asl_class;?>"><?php echo $row['h_s'] . dash() . $row['a_s']; ?></td>
    <td class="ctd"><?php echo show_odd($row["homepb"]); ?></td>
    <td class="ctd"><?php echo show_odd($row["drawpb"]); ?></td>
    <td class="ctd"><?php echo show_odd($row["awaypb"]); ?></td>
    <td class="ctd"><a title='<?php echo $title?>' href="javascript:tell('full_odds.php?id=<?php echo $matchno?>&db=<?php echo $db?>')" class='sbar'><?php echo $odd?></a></td>
  
</tr>
<?php    }
    }  


 if ($temp->rowCount()>0){
?>

  <tr bgcolor="#f4f4f4">
    <td colspan="4" class="rtd padd credit">Total Correct Calls</td>
    <td colspan="2" class="ctd padd credit"><?php echo $ngot; ?></td>
    <td colspan="4"></td>
 
  </tr> 
 <tr bgcolor="#f4f4f4">
    <td colspan="4" class="rtd padd credit">Total Correct Score Hits</td>
    <td colspan="2" class="ctd padd credit"><?php echo $css; ?></td>
    <td colspan="4"></td>
   
  </tr> 
<?php }?>
</table>

</div>

	 <!-- stopprint -->



<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?php echo $fff ?>
</td>



<td style="font-weight:normal;text-align:center;padding-top:5px;">
	<font size="1" color="blue" >
	<b>ASL</b>&nbsp;=&nbsp;</font><font size="1">Anticipated Score-Line&nbsp;&nbsp;
	<font color="blue"><b>Act Res</b></font>&nbsp;=&nbsp;Actual Result
	<br>
	*  Click on "Date/Time & PIC" to view PIC and associated backup data<br>
	** Click on Team name to view "Results to Date"

	<?php if ($div=='nc'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
</tr>
</table>

<div style="padding-bottom:5px">&nbsp;</div>







<?php 
//require_once("pred-disclaimer.ini.php"); 

require_once("footer.ini.php"); 


?>
	
<?php	
function show_odd($value)
{
  if ($value>0): 	return $value ; else: 	return '';  endif;
}
?>
    
