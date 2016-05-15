<? session_start();

  include("config.ini.php") ;
  include("function.ini.php") ;

  $sql = ""; $wtype = "";

  $parts = explode(',',$_GET['PARA']) ;
  $SEASON = $parts[0] ;
  $WEEKNO = $parts[1] ;
  $DIV    = $parts[2] ;
  $db = $parts[3] ;
  $RESULT = $parts[4] ;

  

  if   ($RESULT=="H"): $wtype = "HOME WIN CALLS";   $sql = " and hgoal>agoal ";
  elseif ($RESULT=="A"): $wtype = "AWAY WIN CALLS"; $sql = " and hgoal<agoal ";
  elseif ($RESULT=="D"): $wtype = "DRAW CALLS"; $sql = " and hgoal=agoal ";
  endif;

  $type = selection_type($BET) ;
	if (strlen($sql)==0){
		$calls = divname($DIV) ;
		$qry = "SELECT *,date_format(match_date,'%d-%b-%y') as m_date FROM fixtures where weekno='$WEEKNO'  and season='$SEASON' and `div`='$DIV' order by mdate,hteam,ateam";
	}else{
		$calls = divname($DIV) . "<br/><font style='font-size:14px;color:#000;'>$wtype</font>";
		$qry = "SELECT *,date_format(match_date,'%d-%b-%y') as m_date FROM fixtures where weekno='$WEEKNO' and season='$SEASON' $sql and `div`='$DIV' order by mdate,hteam,ateam";
	
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
	while ($row = $temp->fetch()  ):
		$wdate = $row["wdate"];
		$number++;
		$char = printv('v');
		$rowcol = rowcol($number);
		$data .= "<tr $rowcol height=\"18\">";
		$data .= '<td class="ctd padd">'. $number .'</td>';
		$data .= '<td style="text-align: center">'. $row["m_date"] .'</td>';
		$data .= '<td style="text-align: left">';
		$data .= '&nbsp;'.trim($row["hteam"]) . "&nbsp;$char&nbsp;" ;
		$data .=  trim($row["ateam"]).'</td>';
	
				
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
        
        $data .= "<td class='ctd $asl_class'>". trim($row["hgoal"]) .dash() .trim($row["agoal"]) .'</td>';
        
		if ($row["h_s"]=="P"):
			$data .= '<td class="ctd pp"><font color="gray">P-P</font></td>';
		else:
			$data .= "<td class='ctd $asl_class'>". trim($row["h_s"]) .dash().trim($row["a_s"]) .'</td>';
			$correct += $row["gotit"] ;
		endif;
        
		$data .= "<td $rowcol  width=\"8%\" style=\"text-align: center\" height=\"16\">";
		$data .=  num2($row['h_odd']) .'</td>';
		$data .= "<td $rowcol  width=\"8%\" style=\"text-align: center\" height=\"16\">";
		$data .=  num2($row['d_odd']) .'</td>';
		$data .= "<td $rowcol  width=\"8%\" style=\"text-align: center\" height=\"16\">";
		$data .=  num2($row['a_odd']) .'</td>';

		$data .= '<td style="text-align: center">' ;
		if ($row["gotit"]==1) :
			$data.= '<IMG SRC="images/tbcap/chked.gif" BORDER="0" ALT="">' ;
		else:
			if ($row["h_s"]=="P"): $data.= '-' ; else: $data.= 'x' ;endif;
		endif;
		$data.= '</td>';
		$data .= '</tr>';

	endwhile;
$data .= '<tr bgcolor="#f4f4f4" height="25">';
$data .= '<td colspan="8" align="right"><b>Total Correct Calls:</b></td>';
$data .= '<td align="center"><span class="credit">' . num0($correct) .' </span></td>';
$data .= '</tr>';

 
?>

<link rel="stylesheet" type="text/css" href="css/style_v4.css" />
<title>predictawin.com </title>
<? 
$pageURL = "";
$page_title="Prediction Performance Records";
page_header($page_title) ; 

?>

<div style="padding-bottom:8px"></div>
<!-- startprint -->
<? week_box($wdate,$SEASON, $WEEKNO, $calls, "98%"); ?>

<div style="padding-bottom:8px"></div>

<table border="0" width="100%" cellpadding="0" cellspacing="0">
  <tr>
	<td width="100%" valign="top" colspan='2'>

<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#d6d6d6" width="98%" bgcolor="#D3EBAB">

<tr bgcolor="#d3ebab">
    <td width="5%" style="text-align: center"  rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>
    <td width="10%" style="text-align: center" rowspan="2"><img src="images/tbcap/date.gif"  border="0" alt=""/></td>
    <td width="38%" style="text-align: center" rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
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
<? echo $data; ?>                

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