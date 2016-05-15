<? session_start();

  include("config.ini.php") ;
  include("function.ini.php") ;

  $parts = explode(',',$_GET['PARA']) ;
  $SEASON= $parts[0] ;
  $BET   = $parts[1] ;
  $RESULT= $parts[2] ;
  $WEEKNO= $parts[3] ;
  
  $db = $_GET['db'];
  
 $qry = "SELECT * FROM fixtures WHERE weekno='$WEEKNO' and `season`='$SEASON' limit 1";

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

  $pageURL = "";//"?PARA=$SEASON,$BET,$WEEKNO,$RESULT";

  if   ($RESULT=="HW"): $wtype = "HOME CALLS";  $cc='D';   $ncol = 10;
  elseif ($RESULT=="AW"): $wtype = "AWAYS"; $cc='D';  $ncol = 10;
  elseif ($RESULT=="AD"): $wtype = "WEEKEND DRAWS"; $cc='W'; $ncol = 10;
  elseif ($RESULT=="CS"): $wtype = "CORRECT SCORES - DRAWS";  $ncol = 10;
  elseif ($RESULT=="CH"): $wtype = "CORRECT SCORES - HOMES";  $ncol = 10;
  elseif ($RESULT=="CA"): $wtype = "CORRECT SCORES - AWAYS";  $ncol = 10;
  endif;
  $type = selection_type($BET) ;
	
    $qry = "SELECT q.*,date_format(q.match_date ,'%d-%b-%Y') as m_date FROM quickpick q where q.season='$SEASON' and q.bettype='$BET' and  q.weekno='$WEEKNO'  and q.matchtype='$RESULT' and q.season='$SEASON' order by q.rank";
	
     if ($db=='eu'){
            $temp = $eu->prepare($qry) ;
        }else{
            $temp = $sa->prepare($qry);
        }
        
        $temp->execute();
	
	$data="";
	$number=0;
	$correct=0;
	while ($row = $temp->fetch()):
		$wdate = $row["wdate"];
		$number++;
		$char = printv('v');
		$rowcol = rowcol($number);
		$data .= "<tr $rowcol>";
		$data .= '<td class="ctd padd">'. $row["rank"] .'</td>';
		$data .= '<td class="ctd">'. $row["m_date"] .'</td>';
		$data .= '<td style="text-align: left">';
		$data .= '&nbsp;'.trim($row["hteam"]) . "&nbsp;$char&nbsp;" ;
		$data .=  trim($row["ateam"]).'</td>';
		$data .= '<td class="ctd">' .$row["div"]. '</td>';

		$asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
		$act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;

		$predRt  = ($row['hgoal']>$row['agoal'] ? "H" : ($row['hgoal']<$row['agoal'] ?"A" : "D"));
		$actualRt= ($row['h_s']>$row['a_s'] ? "H" : ($row['h_s']<$row['a_s'] ?"A" : "D"));

		$actRt  = ($row['h_s']>$row['a_s'] ? "H" : "A");
		
		$oddRt = ($row['h_odds']>$row['a_odds'] ? "A" : "H");


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

        if ($RESULT=='HW'){
		    if ($predRt=='H' and ($actualRt=='H' or $actualRt=='D')){
		    	$asl_class=' gotrt';
		    }
		}
		    	
		$correct += $row["gotit"] ;

		$data .= '<td class="ctd '. $asl_class .'">'. trim($row["hgoal"]) . dash().trim($row["agoal"]) .'</td>';
		$data .= '<td class="ctd '. $asl_class .'">'. trim($row["h_s"]) . dash() .trim($row["a_s"]) .'</td>';
		

		

		$data .= '<td class="ctd">' ;
		if ($row["h_odds"]<=0) : $data .= ''; else: $data .=$row["h_odds"] ; endif;
		$data .='</td>';
		$data .= '<td class="ctd">' ;
		if ($row["d_odds"]<=0) : $data .= ''; else: $data .=$row["d_odds"] ; endif;
		$data .='</td>';
		$data .= '<td class="ctd">' ;
		if ($row["a_odds"]<=0) : $data .= ''; else: $data .=$row["a_odds"] ; endif;
		$data .='</td>';
	/*	
		if ($ncol=='12'):
			$data .= '<td class="ctd">' ;
			if ($row["asl_odds"]<=0) : $data .= ''; else: $data .=$row["asl_odds"] ; endif;
			$data .='</td>';
			$data .= '<td class="ctd">' ;
			if ($row["cs_odds"]<=0) : $data .= ''; else: $data .=$row["cs_odds"] ; endif;
			$data .='</td>';
		endif;
		
		*/
		$data .= '<td class="ctd">' ;
		if ($row["gotit"]==1) :
			$data.= '<IMG SRC="images/tbcap/chked.gif" BORDER="0" >' ;
		else:
		 if ($row['h_s']=='P'):
			$data .='n/a';
		 else:
			if ($cc=='D'):
				if ($row['h_s']==$row['a_s']):
					$data.= '<IMG SRC="images/tbcap/chked.gif" BORDER="0" >Draw' ;
					$correct += 1 ;
				else:
					$data.= 'x' ;	
				endif;
			else:
				
				
				
				if ($actRt == $oddRt ):
					
					if ($actRt=="H"):
						$data.= '<IMG SRC="images/tbcap/chked.gif" BORDER="0">Home' ;
						$correct += 1 ;
					else:
						$data.= '<IMG SRC="images/tbcap/chked.gif" BORDER="0">Away' ;
						$correct += 1 ;
					endif;
				else:
				    if ($row['h_odds']==$row['a_odds']):
						$data .='n/a';
					else:
						$data.= 'x' ;	
					endif;
				endif;
			endif;
		  endif;
		endif;
		$data.= '</td>';
		$data .= '</tr>';

	endwhile;
$data .= '<tr bgcolor="#f4f4f4" height="25">';
$data .= '<td colspan="9" align="right"><b>Total Correct Calls:</b></td>';
$data .= '<td align="center"><span class="credit">' . num0($correct) .' </span></td>';
$data .= '</tr>';

 
?>

<link rel="stylesheet" type="text/css" href="css/style_v4.css">
<title>predictawin.com</title>

<? $page_title="Analysis of Previous Predictions"; 
	page_header($page_title) ; 
?>

<div style="padding-bottom:8px"></div>

<!-- startprint -->

<div class="report_blue_heading" style="width: 612px;margin:0 auto 5px auto;">
 <? 
  if ($RESULT=="AD"){
    echo "Double Chance Hit Rate " . red(' - ') . $wtype ;
  }
  else{
  echo selection_type($BET) . " Double Chance Hit Rate " . red(' - ') . $wtype ;
  } 
  echo "<br/>";
  echo site($db);
    
?>
</div>


<? 
 
week_box_nocap($WEEKNO, $wdate, $SEASON,620) ;
?>

<div style="padding-bottom:8px"></div>

<center>


<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#d6d6d6" width="620" bgcolor="#D3EBAB">
<tr bgcolor="#D3EBAB">
	<td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>
	<td width="10%" class='ctd' rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/></td>
	<td width="58%" class='ctd' rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
	<td class='ctd' rowspan="2"><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
	<td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
	<td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
    <td width="24%" class='ctd' colspan="3"><img src="images/tbcap/odd.gif"  border='0' alt=""/></td>
	<td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/correctcall.gif"  border="0" alt=""/></td>
</tr>
<tr bgcolor="#d3ebab">
      <td class='ctd' ><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
      <td class='ctd' ><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
      <td class='ctd' ><img src="images/tbcap/a.gif"  border='0' alt=""/></td>
  </tr>
<tr>
  


<? echo $data; ?>                



</table>

</center>	
  <!-- stopprint -->  
 <div style="float: left;width:400px;padding-left:30px;font-size:10px;margin:5px 0 5px 0;">
    <font color="#0000ff">PaW ASL&nbsp;=&nbsp;</font>Predict-A-Win Anticipated Score-Line <br/>  
    <font color="#0000ff">Act Res&nbsp;=&nbsp;</font>Actual Result <br/> 
    <font color="#0000ff">P-P&nbsp;=&nbsp;</font>Postponed Match <br/> 
    <font color="#0000ff">n/a&nbsp;=&nbsp;</font>Not Applicable<br />
</div>

<div style="float: right;padding-right:30px;width:100px;text-align:right;margin:5px 0 5px 0;"><? echo printscr()?></div>

<div class='clear'></div>

<div align="center"><A HREF="javascript:close()" class='sbar'>x Close this window x</A></div>

