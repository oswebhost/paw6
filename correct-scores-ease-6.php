<?	 session_start();
include("config.ini.php");
include("function.ini.php");


$n_max = 0 ;

$weekno=$_REQUEST['PARA'];


$query1 = "SELECT * from setting"; 
$result = mysql_query($query1) or die(mysql_error()); 
while ($row = mysql_fetch_array($result)):
	$updating = $row["updating"];$sended=$row["seasonended"];
	$lastweek = $row["weekno"];
	$season  =$row["season"];
	if ($sended=='1'):header('Location: commences.php');exit;endif;
	if ($updating=='1'):header('Location: underway.php');exit;endif; // commented for v2 only 
endwhile;



if ($weekno<=0) $weekno = $lastweek ;
    


$errlog = "";

if (isset($_SESSION['userid']) ):
	if ($_SESSION['expire'] < cur_week() ):
		if ( $weekno == cur_week() ) :
			$weekno=$lastweek-1;
			$errlog = "Sorry, your subscription expired at the end of Week " . $_SESSION['expire'] . ". To be able to access the current week's predictions your subscription will need to be renewed." ;
		endif;
	endif;
endif;

if (!isset($_SESSION['userid']) and $weekno==$lastweek) :
		//header("location: authorization.php");
       //$weekno=$lastweek-1;
endif;



	  

$page_title="Correct Scores Selections (\"EASE 6\")";




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
$season = curseason();



$page_title = " Correct Scores (\"EASE 6\") Week $weekno $season";

 $pageURL=$weekno;



 $result = $eu->prepare("SELECT * FROM fixtures WHERE `weekno`='$weekno' and season='$season'");
 $result->execute();
  
 $num_of_rows = $result->rowcount() ;
 
 while ($row = $result->fetch() ){
		$wdate   =$row["wdate"];
		$weekno  =$row["weekno"];
  }

  $query1 = "SELECT * FROM ease WHERE weekno=$weekno and season='$season' order by rank"; 
  
  
    
  $result =$result = $eu->prepare($query1);
  $result->execute();
	
   $data="";
   $number=0;
   $ngot=0;
   $contra_print=0;
  
   $data="";
   $show_summary=0;
   
   if ($result->rowcount() == 0):
     
    	 if ($weekno<>cur_week("eu") ):
    		  $data ="<tr><td colspan='10' align='center' height='80'><span class='error'> ";
    		  $data .= "No Suitable Selections This Week</span></td></tr>";
    	 else:
    		  $data ="<tr><td colspan='10' align='center' height='80'><span class='error'> ";
    		  $data .= $msg . "</span></td></tr>";
    	 endif;
   endif;
   
   
while ($row = $result->fetch() ):
      $show_summary=1;
	     $number++;
		 if (intval($number / 2) == ($number / 2)):
			  $rowcol = "bgcolor='" . EVENROW ."' ";
		 else:
			  $rowcol = "bgcolor='" . ODDROW . "' ";
		endif;
		
		
		$matchno = trim($row["matchno"]);
		$match_details = ease_match($matchno) ;
		
	

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
      $data.= "<td $rowcol width=\"5%\" style=\"text-align: center;padding:5px 0\">" . $row["rank"]. "</td>";
      $data.= "<td $rowcol  style=\"text-align: center\">";
      
      $data.= "<a target='_blank' class=md2 href=team-performance-chart.php?id=$matchno&site=eu&season=$season>". $match_details->mdate. "&nbsp;<font size='1'>" . substr($match_details->match_time,0,5) . "</font></a></td>";
      $data.= "<td $rowcol  style=\"text-align: left\">";
      $data.= '&nbsp;<a title="Results to Date" class="md" href="teamfixt.php?TEAM='. $match_details->hteam .'">';
      $data.= trim($match_details->hteam) . "</a>";
      $data.= "&nbsp;<FONT cOLOR=\"#FF0000\">v</FONT> ";
      $data.= '<a title="Results to Date"  class="md" href="teamfixt.php?TEAM='. $match_details->ateam .'">';
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
	
		
    	$data.= "<a title='$title' href=\"javascript:tell('full_odds.php?db=eu&id=$matchno&season=$season')\" class='sbar'>view</a>" ;
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
?>



<? page_header("Correct Scores Selections (\"EASE 6\")") ; 

 if (strlen($errlog)>0):
		echo "<div class='errordiv'>$errlog</div>";
 endif;

?>


<div style="padding-bottom:2px"></div>

<table border="0" width="100%" cellpadding="0" cellspacing="0" >
 <tr>
    <td width="25%"><? echo back(); ?></td>

   <td width="25%" height="20" align=center colspan=3 valign="bottom">
		<form method='get' style='padding:0;margin:0;'>	
			<B>Week No: </B><select size="1" name="PARA" class="text" onChange="this.form.submit();">
	   <? 
			 $br=0;
			 
			 for ($other=6; $other<=cur_week('eu'); $other++) :
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



<?  week_box_nocap($weekno, $wdate, $season) ;?>
<div align='center' style="padding-top:5px"></div>


<? if ($number >0) { ?>
<div style='padding:5px;color:#ff0000;font-size:14px;text-align:center;'>
  <a class='sbar' href='download.php?week=<? echo $weekno; ?>'><img src='images/download.jpg' border='0' alt='Download Excel File' /></a>
</div>

<? } ?>
 
<table border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse;" bordercolor="#CDCDCD" width="575" >
	<tr>
		  <td width="5%" style="text-align: center"  bgcolor="#D3EBAB" rowspan="2">
		  <IMG SRC="images/tbcap/refno.gif"  BORDER='0' ALT="">
		  </td>
		  <td width="10%" style="text-align: center"  bgcolor="#D3EBAB" rowspan="2">
		   <IMG SRC="images/tbcap/datepic.gif"  BORDER="0" ALT=""></td>
		  <td width="38%" style="text-align: center"  bgcolor="#D3EBAB" rowspan="2">
		   <IMG SRC="images/tbcap/match.gif"  BORDER="0" ALT=""></td>
		  <td width="8%" style="text-align: center"  bgcolor="#D3EBAB" rowspan="2">
		   <IMG SRC="images/tbcap/div.gif"  BORDER="0" ALT=""></td>
		  <td width="8%" style="text-align: center"  bgcolor="#D3EBAB" rowspan="2">
		   <IMG SRC="images/tbcap/pcalls.gif"  BORDER="0" ALT=""></td>
		   
		  <td width="15%" style="text-align: center" height="10" bgcolor="#D3EBAB" colspan="3">
		  <IMG SRC="images/tbcap/hedgecall.gif"  BORDER='0' ALT=""></td>
		    <td width="8%" style="text-align: center"  bgcolor="#D3EBAB" rowspan="2">
		   <IMG SRC="images/tbcap/act.gif"  BORDER="0" ALT=""></td>
       
        <td width="6%" style="text-align: center"  bgcolor="#D3EBAB" rowspan="2">
        <IMG SRC="images/tbcap/odds.gif"  BORDER="0" ALT=""></td>	 

		</tr>
		<tr>
		  <td width="6%" style="text-align: center"  bgcolor="#D3EBAB"><IMG SRC="images/tbcap/2.gif"  BORDER='0' ALT=""></td>
		  <td width="6%" style="text-align: center"  bgcolor="#D3EBAB"><IMG SRC="images/tbcap/3.gif"  BORDER='0' ALT=""></td>
		  <td width="6%" style="text-align: center"  bgcolor="#D3EBAB"><IMG SRC="images/tbcap/4.gif"  BORDER='0' ALT=""></td>
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

	<FONT COLOR="blue"><B>Act Res</B></FONT>&nbsp;=&nbsp;Actual Result
	<BR>
	*  Click on "Date/Time & PIC" to view PIC and associated backup data<BR>
	** Click on Team name to view "Results to Date"

	<? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
</tr>
</table>

<div style="padding-bottom:5px">&nbsp;</div>

<? 
if ($weekno==cur_week("eu")){ ?>

	<div style='color:red;padding:5px 20px 10px 20px;font-size:11px;display:none;'>If it is a weekday, then nothing will be shown here until the Friday at the earliest. If nothing is shown here by Saturday, then it means that there are no suitable selections for this category for the current week.  </div>

<?  //include("pred-disclaimer.ini.php");
}

/*
$sql = mysql_query("select * from ease_summary where weekno='$weekno' and season='$season'");
$show_summary = mysql_num_rows($sql);
if ($show_summary>0){
?>

<table width='400' style='margin:auto auto;border-collapse:collapse;' border='1' cellpadding='0' >
   <tr>
      <td colspan='2'><img src='images/summary_head.gif' border='0' alt=''></td>   
   </tr>
  
  <?
    $sql = mysql_query("select * from ease_summary where weekno='$weekno' and season='$season'");
    $dd  = mysql_fetch_array($sql);
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

 
*/

include("footer.ini.php"); 

function ease_match($matchno)
{ $sea = curseason("eu");

  $sql = mysql_query("select h_s,a_s,gotit, hteam,ateam,`div`,mdate,match_time from fixtures where mid='$matchno' and season='$sea'") ;
  $dd  = mysql_fetch_array($sql) ;
  $match_details = new stdClass();
  $match_details->hteam = $dd["hteam"] ;
  $match_details->ateam = $dd["ateam"] ;
  $match_details->mdate = $dd["mdate"] ;
  $match_details->div = $dd["div"] ;
  $match_details->match_time = $dd["match_time"] ;
  $match_details->h_s = $dd["h_s"];
  $match_details->a_s = $dd["a_s"];
  $match_details->gotit = $d[gotit];
  return $match_details;
}
?>
	
