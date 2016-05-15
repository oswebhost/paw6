<?	 session_start();
include("config.ini.php");
include("function.ini.php");


$n_max = 0 ;

if (isset($_GET['PARA'])){
    $parts = explode(",",$_GET['PARA']);
    $BET   = $parts[0];
    $RESULT= $parts[1];
    $weekno=$parts[2];

}

if ($_GET['sort_by']==2){
  $sortby = "awinpb desc";
}else{
  $sortby = "`div`,match_date,hteam,ateam";
}

if (!isset($_GET['db'])){
  $db= 'eu';
}else{
  $db= $_GET['db'];
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
    

if ($weekno<=0) $weekno = $lastweek ;

//if (check_season()=='1'){ header('Location: commences.php'); exit; }
if (isset($_SESSION['userid']) ):
  if ($_SESSION['expire'] < cur_week($db) ):
    if ( $weekno == cur_week($db) ) :
      $weekno=$lastweek;
      $errlog = "This is Week No. <b>". cur_week($db) ."</b> - you will only be able to see the current week's data if you are <a class='sbar' href='login-option.php'>logged in</a>. To be able to log in you must be a registered or fully subscribed member. A registered member pays nothing at all but must submit a valid email address to gain access to this section of the website (no access though to the \"Data for Members\" area). A fully subscribed member pays less than &pound;1 per week to get access to everything on this website, including the \"Data for Members\" area. ";
    endif;
  endif;
elseif (!isset($_SESSION['userid']) and ($weekno==cur_week($db))) :
    //header("location: authorization.php");
     $errlog = "This is Week No. <b>". cur_week($db) ."</b> - you will only be able to see the current week's data if you are logged in. To be able to log in you must be a registered or fully subscribed member. A registered member pays nothing at all but must submit a valid email address to gain access to this section of the website (no access though to the \"Data for Members\" area). A fully subscribed member pays less than &pound;1 per week to get access to everything on this website, including the \"Data for Members\" area. <br/>
      <div style='text-align:center;padding:12px;'>
         <a href='login.php' class='sales'><b>Log In</b></a> / <a href='register.php' class='sales'><b>Register</b></a> (free) / <a href='subscribe.php' class='sales'><b>Subscribe</b></a> (pay)
      </div>
   ";
    $weekno=$lastweek-1;
endif;


$page_title="Away Win Calls Top 6";



if ($RESULT=="AD" and $BET=="E"){
    $cbet ="weekend"; $type="draws";
}elseif($RESULT=="AD" and $BET=="F"){
    $cbet ="Midweek"; $type="draws";
}else {
  $cbet = selection_type($BET) ;
  $type = match_type($RESULT); 
}
$match =  $type;
$match = $cbet . printv(" » ") . $type;

switch ($RESULT) :
	case "HW": $odd_from = "Odds from BetExplorer";  break; 
	case "AW": $odd_from = "Odds from BetExplorer";  break; 
	case "AD": $odd_from = "Odds from BetExplorer";  break; 
	case "CH": $odd_from = "Odds from Gamebookers";  break; 
	case "CA": $odd_from = "Odds from Gamebookers";  break; 
	case "CS": $odd_from = "Odds from Gamebookers";  break; 
endswitch;
		

$wkday = date("w");
if ($BET<>"F" and $weekno==cur_week($db)){ 
	$msg = "<div style='color:red;padding:5px 20px 5px 20px;font-size:11px;text-align:justify;'>Nothing will be shown here for the current week in respect of our Program's weekend selections until Friday this week at the earliest. If nothing is shown here by Saturday, then it means that there are no suitable selections for this category for the current week. However, you can still view all the records for the past weeks' selections by going to the appropriate \"Week No\" from the above panel (where \"Week No: 1\" represents our posting for the first week in the current season).  </div>";
}

if ($BET=="F" and $weekno==cur_week($db)){ 
	$msg = "<div style='color:red;padding:5px 20px 5px 20px;font-size:11px;text-align:justify;'>If nothing is shown here by Tuesday this week, then it means that there are no suitable selections for this category for the current week. However, you can still view all the records for the past weeks' selections by going to the appropriate \"Week No\" from the above panel (where \"Week No: 1\" represents our posting for the first week in the current season).    </div>";
}

if ($weekno<>cur_week($db)){
	$msg = "<div style='color:red;padding:5px 20px 5px 20px;font-size:11px'>If nothing is shown here by Tuesday this week, then it means that there are no suitable selections for this category for the current week. However, you can still view all the records for the past weeks' selections by going to the appropriate \"Week No\" from the above panel (where \"Week No: 1\" represents our posting for the first week in the current season).   </div>";
}


$pwk = $weekno-1;
$nwk = $weekno+1;
$season = curseason($db);
$page_title = "Away Win Calls ". s_title($db) ." Season $season Week $weekno";

 $pageURL="PARA=$BET,$RESULT,";


$nurl="$PHP_SELF?PARA=$BET,$RESULT,$nwk,$db";
 
$qry = "SELECT * FROM fixtures WHERE `weekno`='$weekno' limit 1"; 
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


include("header.ini.php");
?>



<? page_header("Away Win Calls") ; 

if (isset($_GET['db'])){

 if (strlen($errlog)>0):
		//echo "<div class='errordiv'>$errlog</div>";
 endif;

?>


<div style="padding-bottom:2px"></div>



<table border="0" width="100%" cellpadding="0" cellspacing="0" >
 <tr>
    <td width="20%"><? echo back(); ?></td>

   <td width="20%" height="20" align='center' colspan='3' valign="bottom">
		<form method='get' style='padding:0;margin:0;'>
      <input type='hidden' name='db' value="<?php echo $db;?>"/>
        
    
          
          <b>Week No: </b><select size="1" name="PARA" class="text" onChange="this.form.submit();">
	   <? 
			 $br=0;
			 
			 for ($other=cur_week($db); $other>=1; $other--) :
				$br++;
				echo "<option value='$BET,$RESULT,$other,$db'" ;
					if ($other==$weekno): echo " selected"; endif;
				echo ">$other</option>\n\n";
			 endfor;
			 echo "</select>";	

	   ?>
   </td>
   <td width="40%"><b>Sort by:</b>
    <select name='sort_by' style='width:160px;' class='text' onChange="this.form.submit();">
      <option value='1' <?php echo selected($_GET['sort_by'],1);?>>Division</option>
      <option value='2' <?php echo selected($_GET['sort_by'],2);?>>Away Win Probabilities</option>
    </select>
   </td>
   
   </form>
	 
	<td width="25%" align="right"> <? echo printscr(); ?></td>
	</tr>
 </table>

<div style='padding-bottom:10px;'></div>

<!-- startprint -->

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>

<?  week_box_new("Away Win Calls", $weekno, $wdate, $season,570) ;?>
 


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

<?  

$qry = "SELECT * FROM fixtures WHERE weekno=$weekno and agoal>hgoal and season='$season' order by $sortby ";

if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}

   $temp->execute();

    if ($temp->rowCount()==0){
       echo "<tr><td colspan='10' class='ctd' style='padding:30px;'><span class='error'>No Matches This Week</span></td></tr>";
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
        $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?db='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
        
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
<tr <?echo rowcol($number);?>>

    <td class="ctd padd"><?echo $number; ?></td>
    <td class="ctd "><a class='md2' <?echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?echo $matchno;?>&site=<?echo $db;?>'><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

     <td class='padd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['hteam']?>&site=eu">
        <?echo $row['hteam'] .'</a>' . printv(' v '); ?>
        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['ateam']?>&site=eu">
            <?echo $row['ateam'];?></a>
     </td>
     
    <td class="ctd"><?echo $ltable; ?></td>
    <td class="ctd <?echo $asl_class;?>"><?echo $headtohead . $row['hgoal'] . dash() . $row['agoal'];?></a></td>
    <td class="ctd <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
    <td class="ctd"><?echo show_odd($row["hwinpb"]); ?></td>
    <td class="ctd"><?echo show_odd($row["drawpb"]); ?></td>
    <td class="ctd"><?echo show_odd($row["awinpb"]); ?></td>
    <td class="ctd"><a title='<?echo $title?>' href="javascript:tell('full_odds.php?id=<?echo $matchno?>&db=<?echo $db?>')" class='sbar'>Odds</a></td>
  
</tr>
<?    }
    }  


 if ($temp->rowCount()>0){
?>
  
  <tr bgcolor="#f4f4f4">
    <td colspan="5" class="rtd padd credit"><strong>Total Correct Calls</strong></td>
    <td class="ctd padd credit"><strong><?echo $ngot?></strong></td>
    <td colspan="4"></td>
  </tr>	
  <tr bgcolor="#f4f4f4">
    <td colspan="5" class="rtd padd credit"><strong>Total Correct Score Hits</strong></td>
    <td class="ctd padd credit"><strong><?echo $css?></strong></td>
    <td colspan="4"></td>
  </tr> 
<?}?>
</table>

</div>

	 <!-- stopprint -->



<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?= $fff ?>
</td>



<td style="font-weight:normal;text-align:center;padding-top:5px;">
	<font size="1" color="blue" >
	<b>ASL</b>&nbsp;=&nbsp;</font><font size="1">Anticipated Score-Line&nbsp;&nbsp;
	<font color="blue"><b>Act Res</b></font>&nbsp;=&nbsp;Actual Result
	<br>
	*  Click on "Date/Time & PIC" to view PIC and associated backup data<br>
	** Click on Team name to view "Results to Date"

	<? if ($div=='nc'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
</tr>
</table>

<div style="padding-bottom:5px">&nbsp;</div>

<?  


}else{
    
    include("select-option.ini.php");
    
} 









//include("pred-disclaimer.ini.php"); 

include("footer.ini.php"); 


?>
	
<?	
function show_odd($value)
{
  if ($value>0): 	return $value ; else: 	return '';  endif;
}
?>
    
