<?	 session_start();
include("config.ini.php");
include("function.ini.php");


$n_max = 0 ;

$weekno=$_REQUEST['PARA'];

if (!isset($_GET['db'])){
  $db= 'eu';
}else{
  $db= $_GET['db'];
}



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
			$errlog = limited_asscess_message($db);
		endif;
	endif;
elseif (!isset($_SESSION['userid']) and ($weekno==cur_week($db))) :
		//header("location: authorization.php");
		$errlog = limited_asscess_message($db);
		$weekno=$lastweek-1;
endif;



	  

$page_title="Correct Scores Selections";




$cbet = selection_type($BET) ;
$type = match_type($RESULT); 
$match =  
$match = "Correct Scores (\"EASE 6\")";

switch ($RESULT) :
	case "HW": $odd_from = "Odds from BetExplorer";  break; 
	case "AW": $odd_from = "Odds from BetExplorer";  break; 
	case "AD": $odd_from = "Odds from BetExplorer";  break; 
	case "CH": $odd_from = "Odds from Gamebookers";  break; 
	case "CA": $odd_from = "Odds from Gamebookers";  break; 
	case "CS": $odd_from = "Odds from Gamebookers";  break; 
endswitch;
		

$wkday = date("w");
if ($wkday<5 and $BET=="F"):
	$msg = "No Suitable Selections This Week" ;
else:
	$msg= "Nothing will be posted for the current week until Friday at the earliest. If nothing is posted by Saturday then it means that there are no suitable selections this week." ;//"Data will be available on Thursday/Friday" ;
endif;


$pwk = $weekno-1;
$nwk = $weekno+1;
$season = curseason($db);

if (isset($_GET['db'])){
  $page_title = "Correct Scores Selections " . s_title($db) . " Season $season Week $weekno";
}else{
  $page_title = "Correct Scores Selections";
}


 


$qry = "SELECT * FROM fixtures WHERE `weekno`='$weekno' and season='$season'";
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

$qry = "SELECT * FROM ease WHERE weekno=$weekno and season='$season' order by rank"; 
    
    
if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
 
   

   $data="";
   $number=0;
   $ngot=0;
   $contra_print=0;
   $data="";
   $show_summary=0;
   if ($temp->rowCount()== 0):
     
    	 if ($weekno<>cur_week($db) ):
    		  $data ="<tr><td colspan='10' align='center' height='80'><span class='error'> ";
    		  $data .= "No Suitable Selections This Week</span></td></tr>";
    	 else:
    		  $data ="<tr><td colspan='10' align='center' height='80'><span class='error'> ";
    		  $data .= $msg . "</span></td></tr>";
    	 endif;
   endif;
   
   
while ($row = $temp->fetch()):
      $show_summary=1;
	     $number++;
		 if (intval($number / 2) == ($number / 2)):
			  $rowcol = "bgcolor='" . EVENROW ."' ";
		 else:
			  $rowcol = "bgcolor='" . ODDROW . "' ";
		endif;
		
		
		$matchno = trim($row["matchno"]);
		$match_details = ease_match($matchno,$db) ;
		
	

     $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?DIV=' . $row["div"] .'">';
	   
	   $pic =  $weekno ."/pic";
     $picurl = $pic . $matchno .".htm";
     $mywin = "mywin" . $matchno;
	
     $window ='<a title="Click to view PIC" class=md href="javascript:PicWin(';
     $window .= "'" . $picurl ."'" ;
     $window .= ')">';
    
      $h_team = $match_details->hteam  ;
      $a_team = $match_details->ateam  ;
     
      $asl = trim($row["asl1"]) ;
      $act = $match_details->h_s ."-". $match_details->a_s ;
      $got = 0;
    
      $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno')\">";
      $data.= "<!--" . $row["rank"] ."--><tr>\n\n";
      $data.= "<td $rowcol width=\"5%\" class='ctd padd'>" . $row["rank"]. "</td>";
      $data.= "<td $rowcol  style=\"text-align: center\">";
      
      $data.= "<a target='_blank' $hsss class=md2 href=team-performance-chart.php?id=$matchno,$db>". $match_details->mdate. "&nbsp;<font size='1'>" . substr($match_details->match_time,0,5) . "</font></a></td>";
      $data.= "<td $rowcol  style=\"text-align: left\">";
      $data.= '&nbsp;<a title="Results to Date" class="md" href="teamfixt.php?TEAM='. $match_details->hteam .','.$db.'">';
      $data.= trim($match_details->hteam) . "</a>";
      $data.= "&nbsp;<FONT cOLOR=\"#FF0000\">v</FONT> ";
      $data.= '<a title="Results to Date"  class="md" href="teamfixt.php?TEAM='. $match_details->ateam .','.$db.'">';
      $data.= trim($match_details->ateam) ."</a></td>";
      $data.= "<td $rowcol style=\"text-align: center\">";
      $data.=  $match_details->div ."</td>";
      
      
  		if ($asl==$act) :
  		  $got = 1;
  		  $data.= "<td bgcolor='#C1FF84' style=\"text-align: center\"><b>$asl</b></td>\n";
  		else:
  		  $data.= "<td $rowcol style=\"text-align: center\">$asl</td>";
  		endif;

      if ($row[asl2]==$act) :
          $got = 1;
     		  $data.= "<td bgcolor='#C1FF84' style=\"text-align: center\"><b>$row[asl2]</b></td>\n";
    	else:
    		  $data.= "<td $rowcol style=\"text-align: center\">$row[asl2]</td>";
    	endif;
      
      if ($row[asl3]==$act) :
     		   $got = 1;
           $data.= "<td bgcolor='#C1FF84' style=\"text-align: center\"><b>$row[asl3]</b></td>\n";
    	else:
    		  $data.= "<td $rowcol style=\"text-align: center\">$row[asl3]</td>";
    	endif;

      if ($row[asl4]==$act) :
     		   $got = 1;
           $data.= "<td bgcolor='#C1FF84' style=\"text-align: center\"><b>$row[asl4]</b></td>\n";
    	else:
    		  $data.= "<td $rowcol style=\"text-align: center\">$row[asl4]</td>";
    	endif;
    
    	if ($match_details->h_s<>'P') :
    	   if ($got==1){
    		    $data.= "<td bgcolor='#C1FF84' style=\"text-align: center\"><b>$act</b></td>";
    		 }else{
            $data.= "<td $rowcol  style=\"text-align: center\"><b>$act</b></td>";
         }  
      
      else:
    		$data.= "<td $rowcol  width=\"6%\" style=\"text-align: center\">P-P</td>";
    	endif;
    
    	$data.= "<td $rowcol  width=\"8%\" style=\"text-align: center\">";

    	$title = "$h_team v $a_team match odds" ;
	
	// $title="onMouseover=\"ddrivetip('$title', 150)\"  onMouseout=\"hideddrivetip()\"" ;
	
		
    	$data.= "<a title='$title' href=\"javascript:tell('full_odds.php?id=$matchno&db=$db')\" class='sbar'>view</a>" ;
    	$data.= "</td></tr>\n\n";
	
		if ($BET=="F"  and $n_max == $number) :		
			break;			
		endif;
		
    endwhile;
	 if ($number>0):
		//$data .= "<tr bgcolor='#f6f6f6'><td colspan='5' align='right'><b>Total Correct Calls:</b></td>\n" ;
		//$data .= "<td align='center'><b>$ngot</td>\n<td colspan='4'></td></tr>" ;
	 endif;




include("header.ini.php");
$pageURL="Correct Scores Selections";
?>



<? page_header("Correct Scores Selections (EASE 6)") ; 

if (isset($_GET['db'])){
    
 if (strlen($errlog)>0):
		echo "<div class='errordiv'>$errlog</div>";
 endif;

?>


<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>

<div style="padding-bottom:2px"></div>

<table border="0" width="560" cellpadding="0" cellspacing="0" style="margin: auto auto;" >
 <tr>
    <td width="25%"><a class='sbar' href="soccer-correct-scores-predictions.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a></td>

   <td width="25%" height="20" align=center colspan=3 valign="bottom">
		<form method='get' style='padding:0;margin:0;'>	
           <input type="hidden" name="db" value="<?echo $_GET['db'];?>" />
			<B>Week No: </B><select size="1" name="PARA" class="text" onChange="this.form.submit();">
	   <? 
			 $br=0;
			 
			 for ($other=cur_week($db); $other>=1; $other--) :
				$br++;
				echo "<option value='$other'" ;
					if ($other==$weekno): echo " selected"; endif;
				echo ">$other</option>\n\n";
			 endfor;
			 echo "</select></form>";	

	   ?>
	 </td>
	<td width="25%" align="right"> <? echo printEASE(); ?></td>
	</tr>
 </table>

<div style='padding-bottom:5px;'></div>


<!-- startprint -->



<?  week_box_nocap($weekno, $wdate, $season,"560") ;?>
<div align='center' style="padding-top:5px"></div>


<? if ($number >0) { ?>
<div style='padding:5px;color:#ff0000;font-size:14px;text-align:center;'>
  <a class='sbar' href='download.php?db=<?echo $db;?>&week=<? echo $weekno; ?>'><img src='images/download.jpg' border='0' alt='Download Excel File' /></a>
</div>

<? } ?>
 
<table border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD" width="560" >
<tr bgcolor="#D3EBAB">
  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>
  <td width="10%" class='ctd' rowspan="2"><img src="images/tbcap/datepic.gif"  border="0" alt=""/></td>
  <td width="38%" class='ctd' rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
  <td width="8%" class='ctd' rowspan="2"><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
  <td width="8%" class='ctd' rowspan="2"><img src="images/tbcap/pcalls.gif"  border="0" alt=""/></td>
   
  <td width="15%" class='ctd' colspan="3"><img src="images/tbcap/hedgecall.gif"  border='0' alt=""/></td>
  <td width="8%" class='ctd' rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
  <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/odds.gif"  border="0" alt=""/></td>	 
</tr>
<tr bgcolor="#D3EBAB">
  <td width="6%" class='ctd'><img src="images/tbcap/2.gif"  border='0' alt=""/></td>
  <td width="6%" class='ctd'><img src="images/tbcap/3.gif"  border='0' alt=""/></td>
  <td width="6%" class='ctd'><img src="images/tbcap/4.gif"  border='0' alt=""/></td>
</tr>
  
<? echo $data ;
  empty($data);
?>
</table>
	 
	 <!-- stopprint -->



<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?= $fff ?>
</td>



<td style="font-weight:normal;text-align:center;padding-top:5px;">

	<font color="blue"><b>Act Res</b></font>&nbsp;=&nbsp;Actual Result
	<br>
	*  Click on "Date/Time & PIC" to view PIC and associated backup data<br>
	** Click on Team name to view "Results to Date"

	<? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
</tr>
</table>

<div style="padding-bottom:5px">&nbsp;</div>


<div style="padding-top:15px;text-align:center;">

<a href="<?=$domain?>/ba/ease-detailed-explanation.php" class="prv">"EASE 6" Detailed Explanation</a>

</div>


<? 
if ($weekno==cur_week($db)){ ?>

	<div style='color:red;padding:5px 20px 10px 20px;font-size:11px;display:none;'>If it is a weekday, then nothing will be shown here until the Friday at the earliest. If nothing is shown here by Saturday, then it means that there are no suitable selections for this category for the current week.  </div>

<?  //include("pred-disclaimer.ini.php");
}

$qry = "select * from ease_summary where weekno='$weekno' and season='$season'";
if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
if ($temp->rowCount()>0){
?>
<br />
<table width='400' style='margin:auto auto;border-collapse:collapse;' border='1' cellpadding='0' >
   <tr>
      <td colspan='2'><img src='images/summary_head.gif' border='0' alt=''></td>   
   </tr>
  
  <?
    $dd  = $temp->fetch();
  ?>
  
   <tr <? echo rowcol(1); ?>>
      <td width='300' class='ctd' style='font-size:13px;font-weight:bold;'>1X2 Calls</td>
      <td width='100' class='ctd' style='font-size:13px;font-weight:bold;padding:4px;'><? echo prtno($dd['1x2']);?> </td>
   </tr> 
  
   <tr <? echo rowcol(2); ?>>
      <td width='300' class='ctd' style='font-size:13px;font-weight:bold;'>Under/Over Calls</td>
      <td width='100' class='ctd' style='font-size:13px;font-weight:bold;padding:4px;'><? echo prtno($dd['under_over']);?> </td>
   </tr> 
  
   <tr <? echo rowcol(1); ?>>
      <td width='300' class='ctd' style='font-size:13px;font-weight:bold;'>Asian Handicap Calls</td>
      <td width='100' class='ctd' style='font-size:13px;font-weight:bold;padding:4px;'><? echo prtno($dd['ahb']);?> </td>
   </tr> 
  
   <tr <? echo rowcol(2); ?>>
      <td width='300' class='ctd' style='font-size:13px;font-weight:bold;'>Correct Scores Calls (Prime Line)</td>
      <td width='100' class='ctd' style='font-size:13px;font-weight:bold;padding:4px;'><? echo prtno($dd['cspline']);?> </td>
   </tr> 

   <tr bgcolor='#efefef'>
      <td width='300' class='ctd credit' style='color:blue;'>NET WINNINGS</td>
      <td width='100' class='ctd credit' style='color:blue;padding:4px;'><? echo prtno($dd['net_winning']);?> </td>
   </tr> 
    <tr bgcolor='#f4f4f4'>
       <td colspan='2' class='ctd' style='font-size:11px;padding:4px;'>[all figures based on a stake of 1 Unit per bet]</td>
   </tr> 

         
</table>

<?  
    } 

}else{
    
    include("select-option.ini.php");
    
} 

include("footer.ini.php"); 

function ease_match($matchno,$db)
{ $sea = curseason($db);
  global $eu, $sa;
  
  $sql = "select h_s,a_s,gotit, hteam,ateam,`div`,mdate,match_time from fixtures where mid='$matchno' and season='$sea'";
  if ($db=='eu'){
    $tempw = $eu->prepare($sql);
  }else{
    $tempw = $sa->prepare($sql);
  }
  $tempw->execute();
  $dd  = $tempw->fetch() ;
  
  $match_details = new stdClass();
  $match_details->hteam = $dd["hteam"] ;
  $match_details->ateam = $dd["ateam"] ;
  $match_details->mdate = $dd["mdate"] ;
  $match_details->div = $dd["div"] ;
  $match_details->match_time = $dd["match_time"] ;
  $match_details->h_s = $dd["h_s"];
  $match_details->a_s = $dd["a_s"];
  $match_details->gotit = $d["gotit"];
  return $match_details;
}
?>
	
