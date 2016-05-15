<?php

session_start();

require_once("config.ini.php") ;
require_once("function.ini.php") ;

$sql = ""; $wtype = "";

  
$parts = explode(',',$_GET['PARA']) ;
$SEASON = $parts[0] ;
$WEEKNO = $parts[1] ;
$db     = $parts[2] ;
$DIV	= $parts[3] ;
$RESULT = $parts[4] ;


  
  //default divisions
$_divs = " and `div` IN ('EP','SP','FL','GB','G0','HK','IS','P0','SL','T0') "; 


	
 switch ($DIV){
			
	case '100': $_divs = " "; break;
	case '0': $_divs = " and `div` IN ('EP','SP','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
	case '1': $_divs = " and `div` IN ('EP','C0','C1','C2','SP','S1','S2','S3','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
	case '2': $_divs = " and `div` IN ('NC', 'UP', 'RP', 'MP') "; break;
	default: $_divs = " and `div` = '" . $DIV . "' "; break;
}



  if   ($RESULT=="H"): $wtype = "HOME WIN CALLS";   $sql = " and hgoal>agoal ";
  elseif ($RESULT=="A"): $wtype = "AWAY WIN CALLS"; $sql = " and hgoal<agoal ";
  elseif ($RESULT=="D"): $wtype = "DRAW CALLS"; $sql = " and hgoal=agoal ";
  endif;

  $type = selection_type($BET) ;
	if (strlen($sql)==0){
		$calls = divname(2) ;
		$qry = "SELECT *,date_format(match_date,'%d-%b-%y') as m_date FROM fixtures where weekno='$WEEKNO'  and season='$SEASON' $_divs order by `div`,mdate,hteam,ateam";
	}else{
		$calls = divname(2) . "<br/><font style='font-size:14px;color:#000;'>$wtype</font>";
		$qry = "SELECT *,date_format(match_date,'%d-%b-%y') as m_date FROM fixtures where weekno='$WEEKNO' and season='$SEASON' $sql $_divs order by `div`,mdate,hteam,ateam";
	
	}
   
    if ($db=='eu'){
       $temp = $eu->prepare($qry) ;
    }else{
       $temp = $sa->prepare($qry);
    }
    $temp->execute();
    
	$num_of_rows = $temp->rowCount();
	$data="";
	$number=0;
	$correct=0;
	$postponed =0;
	
	while ($row = $temp->fetch()  ):
	
		$asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
		
		$wdate = $row["wdate"];
		$number++;
		$char = printv('v');
		$rowcol = rowcol($number);
		$data .= "<tr $rowcol>";
		$data .= '<td class="ctd padd">'. $number .'</td>';
		$data .= '<td style="text-align: center">'. $row["m_date"] .'</td>';
		$data .= '<td style="text-align: left">';
		$data .= '&nbsp;'.trim($row["hteam"]) . "&nbsp;$char&nbsp;" ;
		$data .=  trim($row["ateam"]).'</td>';
	
        $data .= '<td style="text-align: center">'. $row['div'] .'</td>';
		
		
		$asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
	    $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
      
      
        $asl_class ="";
       
        if ($row['gotit']=='1' and $row['h_s']<>'P'){
            $asl_class = " gotrt";
        }
        
        if ($asl==$act){
            $asl_class = " gotasl";
        }
        
        if ($row['h_s']=='P'){
            $asl_class = " pp";
        }
        
        $data .= "<td class='ctd $asl_class'>". trim($row["hgoal"]) . dash() .trim($row["agoal"]) .'</td>';
        
		if ($row["h_s"]=="P"):
			$data .= '<td class="ctd pp"><font color="gray">P-P</font></td>';
		else:
			$data .= "<td class='ctd $asl_class'>". trim($row["h_s"]) .dash().trim($row["a_s"]) .'</td>';
			$correct += $row["gotit"] ;
		endif;
        
        
	
		$data .= "<td $rowcol  width=\"8%\" style=\"text-align: center\">";
		$data .=  num2($row['h_odd']) .'</td>';
		$data .= "<td $rowcol  width=\"8%\" style=\"text-align: center\" >";
		$data .=  num2($row['d_odd']) .'</td>';
		$data .= "<td $rowcol  width=\"8%\" style=\"text-align: center\" >";
		$data .=  num2($row['a_odd']) .'</td>';

		$data .= '<td style="text-align: center">' ;
		if ($row["gotit"]==1) :
			$data.= '<IMG SRC="images/tbcap/chked.gif" BORDER="0" ALT="">' ;
		else:
			if ($row["h_s"]=="P"): $data.= '-' ; else: $data.= 'x' ;endif;
		endif;
		$data.= '</td>';
		$data .= "</tr>\n";
		
		 if ($row['h_s']=='P'){
            $postponed++;
        }
		if ($asl==$act){
           $css ++;
        }

	endwhile;


 
?>

 
<link rel="stylesheet" type="text/css" href="css/style_v4.css">
<title>Soccer-Predictions.com</title>
<?php
$pageURL = "";
$page_title="Prediction Performance Records";
page_header($page_title) ; 

?>

<div style="padding-bottom:8px"></div>
<!-- startprint -->
<?php week_box($wdate,$SEASON, $WEEKNO, $calls ."<br>" .site($db), "98%"); ?>

<div style="padding-bottom:8px"></div>

<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
	<td width="100%" valign="top" colspan='2'>

<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#d6d6d6" width="98%" bgcolor="#D3EBAB">

<tr bgcolor="#d3ebab">
    <td width="5%" style="text-align: center"  rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>
    <td width="10%" style="text-align: center" rowspan="2"><img src="images/tbcap/date.gif"  border="0" alt=""/></td>
    <td width="38%" style="text-align: center" rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
    <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
    <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
    <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
    <td width="24%" style="text-align: center" colspan="3"><img src="images/tbcap/odd.gif"  border="0" alt=""/></td>
    <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/correctcall.gif"  border="0" alt=""/></td>
</tr>
<tr bgcolor="#d3ebab">
  <td width="8%" style="text-align: center"><img src="images/tbcap/home.gif"  border="0" alt=""/></td>
  <td width="8%" style="text-align: center"><img src="images/tbcap/d.gif"  border="0" alt=""/></td>
  <td width="8%" style="text-align: center"><img src="images/tbcap/a.gif"  border="0" alt=""/></td>
</tr>
<?php echo $data; ?>                

<tr bgcolor="#f4f4f4">
    
   
    
    <td colspan="8" class="rtd padd bot">Total Correct Calls</td>
    <td colspan="1" class="ctd padd bot"><?php echo  num0($correct); ?></td> 
    <td colspan="2" class="ctd padd bot">
	
	<?php if ($number-$postponed>0){
			echo num2(($correct/($number-$postponed))*100) ."%" ; 
		}else{
			echo "0.00";
		}
	?>
	</td>
 
  </tr> 
 <tr bgcolor="#f4f4f4">
    <td colspan="8" class="rtd padd bot">Total Correct Score Hits</td>
    <td colspan="1" class="ctd padd bot"><?php echo $css; ?></td>
</tr>
 <tr bgcolor="#f4f4f4">	
	<td colspan="8" class="rtd padd bot">Postponed Matches</td>
	<td colspan="1" class="ctd padd bot"><?php echo $postponed; ?></td>
   
  </tr> 

  
</table>

<!-- stopprint --> 
         
  

</td>
</tr>
<tr>
   <td width="80%" valign="top" style="padding-left:10px;">
	  <font size="1" color="#ff0000">ASL&nbsp;=&nbsp;</font>Anticipated Score-Line | 
	   <font size="1" color="#ff0000">Act Res&nbsp;=&nbsp;</font>Actual Result | 
	   <font size="1" color="#ff0000">P-P&nbsp;=&nbsp;</font>Postponed Match | 
	   <font size="1" color="#ff0000">n/a&nbsp;=&nbsp;</font>Not Applicable

   </td>
   <td width="20%" valign="top" height="36" align='right'>&nbsp;&nbsp;&nbsp;&nbsp;
	   <font size="1" color="#ff0000" ><? echo printscr()?>&nbsp;&nbsp;&nbsp;&nbsp;
   </td>
</tr>
</table>

<div align="center"><A HREF="javascript:close()" class='sbar'>x Close this window x</A></div>