<? session_start();

  include("config.ini.php") ;
  include("function.ini.php") ;

  $parts = explode(',',$_GET['PARA']) ;
  $SEASON= $parts[0] ;
  $WEEK  = $parts[1] ;
  $db    = $parts[2] ;
   

if ($db=='eu'){
    $cap='European';
}else{
    $cap='American';
}

?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<title>predictawin.com</title>

<? 
$page_title="Prediction Performance Records"; 
page_header($page_title) ; 


?>


<!-- startprint -->
 
<div style="padding-bottom:5px"></div>

<center>
			
  <? 
	echo "<!-- startprint -->" ;
	
	$qry = "select weekno,season,wdate from fixtures where weekno='" . $WEEK ."' and season='$SEASON' limit 0,1" ;
    if ($db=='eu'){
        $temp = $eu->prepare($qry) ;
    }else{
        $temp = $sa->prepare($qry);
    }
    $temp->execute();
  	$row = $temp->fetch() ;
  	week_box($row["wdate"],$row["season"], $row["weekno"], "CORRECT SCORES (\"EASE 6\") $cap", "93%" ) ;
	echo "<br/>" ;
	
	$qry = "SELECT * FROM ease WHERE weekno='$WEEK' and season='$SEASON' order by rank"; 
    if ($db=='eu'){
        $temp = $eu->prepare($qry) ;
    }else{
        $temp = $sa->prepare($qry);
    }
    $temp->execute();

  while ($row = $temp->fetch()):
      $show_summary=1;
	     $number++;
		 if (intval($number / 2) == ($number / 2)):
			  $rowcol = "bgcolor='" . EVENROW ."' ";
		 else:
			  $rowcol = "bgcolor='" . ODDROW . "' ";
		endif;
		
		
		$matchno = trim($row["matchno"]);
		$match_details = ease_match($matchno,$SEASON,$db) ;
		
	

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
      $data.= "<td $rowcol  class='ctd padd'>";
      
      $data.= $match_details->m_date."</td>";
      $data.= "<td $rowcol  style=\"text-align: left\">";
      $data.= '&nbsp;';
      $data.= trim($match_details->hteam) . "</a>";
      $data.= "&nbsp;<FONT cOLOR=\"#FF0000\">v</FONT> ";
      $data.= trim($match_details->ateam) ."</td>";
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
    
    
    	$data.= "</tr>\n\n";
	
  
		
    endwhile;
	 

	?>


<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#cdcdcd" width="93%" >
<tr bgcolor="#d3ebab">
    <td width="5%" style="text-align: center"  rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>
    <td width="10%" style="text-align: center" rowspan="2"><img src="images/tbcap/date.gif"  border="0" alt=""/></td>
    <td width="38%" style="text-align: center" rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
    <td width="8%" style="text-align: center" rowspan="2"><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
    <td width="8%" style="text-align: center" rowspan="2"> <img src="images/tbcap/pcalls.gif"  border="0" alt=""/></td>
    <td width="15%" style="text-align: center" colspan="3"><img src="images/tbcap/hedgecall.gif"  border='0' alt=""/></td>
    <td width="8%" style="text-align: center" rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
</tr>
<tr>
  <td width="6%" style="text-align: center"  bgcolor="#d3ebab"><img src="images/tbcap/2.gif"  border='0' alt=""/></td>
  <td width="6%" style="text-align: center"  bgcolor="#d3ebab"><img src="images/tbcap/3.gif"  border='0' alt=""/></td>
  <td width="6%" style="text-align: center"  bgcolor="#d3ebab"><img src="images/tbcap/4.gif"  border='0' alt=""/></td>
</tr>

<? echo $data ;
  empty($data);
?>
</table>

<br />


<!--
<table width='400' style='margin:auto auto;border-collapse:collapse;' border='1' cellpadding='0' >
   <tr>
      <td colspan='2'><imgsrc='images/summary_head.gif' border='0' alt=''></td>   
   </tr>
  
  <?
    $sql = mysql_query("select * from ease_summary where weekno='$WEEK' and season='$SEASON'");
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
-->
</center>



<!-- stopprint -->
<div style='padding:5px;color:#ff0000;font-size:14px;text-align:center;'>
  <a class='sbar' href='download.php?week=<? echo $WEEK . "&site=$db"; ?>'><img src='images/download.jpg' border='0' alt='Download Excel File' /></a>
</div>




<table  width="93%" align="center">
<tr>
	<td> </td>
	<td align="right"> <? $pageURL ="?season=$SEASON&site=$db";  echo printscr(); ?></td>
</tr>
</table>

<div style="padding-bottom:8px" align="center"></div>
<div align="center"><a href="javascript:close()" class='sbar'>x Close this window x</a></div>


<?

function ease_match($matchno,$SEASON,$db)
{ 
  global $eu, $sa;
    
  $sea = $SEASON;
  
  $sql = "select date_format(match_date,'%d-%b-%Y') as m_date, h_s,a_s,gotit, hteam,ateam,`div`,mdate,match_time from fixtures where mid='$matchno' and season='$sea'" ;
  if ($db=='eu'){
    $temp = $eu->prepare($sql) ;
  }else{
        $temp = $sa->prepare($sql);
  }
  $temp->execute();
  $dd = $temp->fetch() ;

  $match_details = new stdClass();
  $match_details->hteam = $dd["hteam"] ;
  $match_details->ateam = $dd["ateam"] ;
  $match_details->div = $dd["div"] ;
  $match_details->m_date = $dd["m_date"] ;
  $match_details->h_s = $dd["h_s"];
  $match_details->a_s = $dd["a_s"];
  $match_details->gotit = $d[gotit];
  return $match_details;
}
?>