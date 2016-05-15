<?php 

session_start();

  require_once("config.ini.php") ;
  require_once("function.ini.php") ;
  
 $parts = explode(",",$_GET['PARA']);
  
  $SEASON= $parts[0] ;
  $BET   = $parts[1] ;
  $WEEKNO= $parts[2] ;
  $RESULT= $parts[3] ;
  $db    = $parts[4] ;
  
  
   
  $pageURL = "";//"?PARA=$SEASON,$BET,$WEEKNO,$RESULT";

  if ($RESULT=="HW"): $wtype = strtoupper(selection_type($BET)) . printv(" &#187; ") . prt_bet($RESULT) ;    $ncol = 11;
    elseif ($RESULT=="AW"): $wtype = strtoupper(selection_type($BET)) . printv(" &#187; ") . prt_bet($RESULT);  $ncol = 11;
    elseif ($RESULT=="AD"): $wtype = strtoupper(selection_type($BET)) . printv(" &#187; ") . prt_bet($RESULT);  $ncol = 11;
    elseif ($RESULT=="DC"): $wtype = "WEEKEND ". printv(" &#187; ") . " DOUBLE CHANCE Calls (1X)";  $ncol = 11;
    elseif ($RESULT=="AHB"): $wtype = "WEEKEND ". printv(" &#187; ") ." ASIAN HANDICAP";  $ncol = 13;
    elseif ($RESULT=="1X2"): $wtype = "WEEKEND ". printv(" &#187; ") ." 1X2 Outright win CALLS ";  $ncol = 11;
  endif;

	if ($RESULT=="AD" and $BET=="E") $wtype = strtoupper("Weekend") . printv(" &#187; ") . prt_bet($RESULT); 
  
  
    $total_ret=0; $total_call=0;



  $type = selection_type($BET) ;
	$sql = "SELECT *,date_format(match_date ,'%d-%b-%Y') as m_date FROM quickpick where season='$SEASON' and bettype='$BET' and  weekno='$WEEKNO'  and matchtype='$RESULT' and season='$SEASON' order by rank";
   
    if ($db=='eu'){
        $temp = $eu->prepare($sql) ;
        $cap = "European Divisions";
    }else{
        $temp = $sa->prepare($sql);
        $cap = "American Divisions";
    }
    $temp->execute();
	$num_of_rows = $temp->rowCount();
	$data="";
	$number=0;
	$correct=0;
	while ($row = $temp->fetch()):
		$wdate = $row["wdate"];
		$number++;
		
		$rowcol = rowcol($number);
		$data .= "<tr $rowcol>";
		$data .= '<td class="ctd padd">'. $row["rank"] .'</td>';
		$data .= '<td style="text-align: center">'. $row["m_date"] .'</td>';
		$data .= '<td style="text-align: left">';
		
		if($RESULT=="1X2"){
		  $char = printvblack('v');
		  $data .= '&nbsp;<b>'.trim($row["hteam"]) . "</b>&nbsp;$char&nbsp;" ;
		}else{
		  $char = printv('v');
		  $data .= '&nbsp;'.trim($row["hteam"]) . "&nbsp;$char&nbsp;" ;
    }
    		
		$data .=  trim($row["ateam"]).'</td>';
		$data .= '<td style="text-align: center">' .$row["div"]. '</td>';
		
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
        	  
	  if ($asl==$act):
		  $data.= "<td class='ctd $asl_class'>" ;
		  $data.= trim($row["hgoal"]) . dash() . trim($row["agoal"]) ."</td>\n";
	  else:
		  $data.= "<td  $rowcol class='ctd $asl_class'>" ;
		  $data.= trim($row["hgoal"]) . dash() . trim($row["agoal"]) ."</td>\n";
	  endif;
		  
	
	   if ($asl==$act):
			 $data.= "<td class='ctd $asl_class'>";
		  else:
			 $data.= "<td  $rowcol class='ctd $asl_class'>";
		  endif;
		
		  if ($row["h_s"]<>'P') :
               $total_call++ ;
			  if ($row['gotit']=='1') :
					$data .=  $row["h_s"] .dash(). $row['a_s']  ;
			  else:
					$data .= $row["h_s"] .dash(). $row['a_s']   ;
			  endif;
		  else:
				$data .=  "<font color='gray'>". $row["h_s"] .printv('-'). $row['a_s'] . "</font>" ;
		  endif;


 		$data .= '</td>';
		
		
		$data .= '<td align=center>' ;
		if ($row["h_odds"]<=0) : $data .= ''; else: $data .=$row["h_odds"] ; endif;
        
		$data .='</td>';
		$data .= '<td align=center>' ;
		if ($row["d_odds"]<=0) : $data .= ''; else: $data .=$row["d_odds"] ; endif;
		$data .='</td>';
        
		$data .= '<td align=center>' ;
		if ($row["a_odds"]<=0) : $data .= ''; else: $data .=$row["a_odds"] ; endif;
		$data .='</td>';
		
		if ($ncol=='12'):
			$data .= '<td align=center>' ;
			if ($row["asl_odds"]<=0) : $data .= ''; else: $data .=$row["asl_odds"] ; endif;
			$data .='</td>';
			$data .= '<td align=center>' ;
			if ($row["cs_odds"]<=0) : $data .= ''; else: $data .=$row["cs_odds"] ; endif;
			$data .='</td>';
		endif;
		$data .= '<td style="text-align: center">' ;
		if ($row["gotit"]==1) :
			$data.= '<IMG SRC="images/tbcap/chked.gif" BORDER="0" ALT="half">' ;
		else:
		   if ($row['h_s']=='P'):
				$data .= 'n/a';
			else:
				$data.= 'x' ;
			endif;
		endif;
		$data.= '</td>';
	   
		$data .= '<td style="text-align: center">' ;
			if ($row["gotit"]==1) :
			  $correct ++;
				switch ($RESULT):
					 case "HW":
						$data .= num2($row['h_odds']) ; $total_ret += $row['h_odds']; break;
					 case "AW":
						$data .= num2($row['a_odds']) ; $total_ret += $row['a_odds']; break;
					 case "AD":
						$data .= num2($row['d_odds']) ; $total_ret += $row['d_odds']; break;
					 case "1X2":
					     if ($row[hgoal]>$row[agoal]) {
						     $data .= num2($row['h_odds']) ; $total_ret += $row['h_odds'];
               }else{ 
						     $data .= num2($row['a_odds']) ; $total_ret += $row['a_odds']; 
               }  
                 break;
           case "DC":
					     if ($row[h_s]>$row[a_s] and $row[gotit]==1) {
						     $data .= num2($row['h_odds']) ; $total_ret += $row['h_odds'];
               }elseif($row[h_s]<$row[a_s] and $row[gotit]==1){ 
						     $data .= num2($row['a_odds']) ; $total_ret += $row['a_odds']; 
               }elseif($row[h_s]==$row[a_s] and $row[gotit]==1) {
						     $data .= num2($row['h_odds']) ; $total_ret += $row['h_odds'];
               }  
               break;
                 
					 default:
						$data .= num2($row['asl_odds']) ; $total_ret += $row['asl_odds']; break;
				endswitch;
			else:
				$data .="0.00";
			endif;
		$data.= '</td>';
		$data .= "</tr>\n\n";
  
    
		

	endwhile;

$data .= '<tr bgcolor="#f4f4f4" height="25">';
$data .= '<td colspan="'. ($ncol=='12'? 11 : 9) .'" align="right"><span class="credit">Totals:</span></td>';
$data .= '<td align="center"><span class="credit">' . num0($correct) .' </span></td>';
$data .= '<td align="center"><span class="credit">' . num2($total_ret) .' </span></td>';
$data .= '</tr>';


$data .= '<tr bgcolor="#f4f4f4" height="25">';
$data .= '<td colspan="'. ($ncol=='12'? 12 : 10) .'" align="right"><span class="credit">Net Return All: </span></td>';

$data .= '<td align="center"><span class="credit">' . num20($total_ret-$total_call) .' </span></td>';
$data .= '</tr>';


?>

<link rel="stylesheet" type="text/css" href="css/style_v4.css">
<title>predictawin.com</title>

<?php $page_title="Prediction Performance Records"; 
	page_header($page_title) ; 
?>

<div style="padding-bottom:0px"></div>
<center>
<!-- startprint -->
<?php week_box($wdate,$SEASON, $WEEKNO, $wtype ."<br/>$cap","95%") ;?>



<div style="padding-bottom:10px"></div>





<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" bordercolor="#d6d6d6" width="95%" >
		 
<tr bgcolor="#d3ebab">
    <td width="5%" style="text-align: center" rowspan="2"><img src="images/tbcap/rankno.gif"  border='0' alt=""/></td>
    <td width="10%" style="text-align: center"  rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/></td>
    <td width="38%" style="text-align: center" rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
    <td  style="text-align: center" rowspan="2"><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
    <td width="5%" style="text-align: center" rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
    <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
    <td width="24%" style="text-align: center" colspan="<?php echo  ($ncol=='12'? 5: 3); ?>"><img src="images/tbcap/odd.gif"  border="0"alt=""/></td>
    <td  style="text-align: center" rowspan="2"><img src="images/tbcap/correctcall.gif"  border="0" alt=""/></td>
    <td style="text-align: center" rowspan="2"><img src="images/tbcap/return.gif"  border="0" alt=""/></td>


</tr>
<tr>
 <?php if($RESULT=="DC") {?>
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/1x.gif"  border="0"alt=""/></td>
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/12.gif"  border="0"alt=""/></td>
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/2x.gif"  border="0" alt=""/></td>
 <?php }else{ ?> 
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/home.gif"  border="0"alt=""/></td>
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/d.gif"  border="0"alt=""/></td>
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/a.gif"  border="0" alt=""/></td>
 <?php }?>

<?php if($ncol=='12'): ?>
  <td width="8%" style="text-align: center"><img src="images/asl-odds.gif"  border="0" alt=""/></td>
   <td width="8%" style="text-align: center"><img src="images/act-odd.gif"  border="0" alt=""/></td>
<?php endif; ?>
</tr>



<?php echo  $data; ?>           

</table>
<!-- stopprint -->  
         
<table width='95%' style='margin:auto auto;'>
<tr>
    <td width='90%' valign='top'>
	  <font size="1" color="#0000ff">ASL&nbsp;=&nbsp;</font>Anticipated Score-Line | 
	   <font size="1" color="#0000ff">Act Res&nbsp;=&nbsp;</font>Actual Result | 
	   <font size="1" color="#0000ff">P-P&nbsp;=&nbsp;</font>Postponed Match |
	   <font size="1" color="#0000ff">n/a&nbsp;=&nbsp;</font>Not Applicable

   </td>
   <td  valign="top" height="36" align='right' style="padding-right:0px">
	   <font size="1" color="#ff0000" ><a href="javascript:window.print()" class="sbar"><img border='0' src='images/header/blue-dot.gif' /> Print</a>
   </td>
  </tr>
</table>
	
<div align="center"><a HREF="javascript:close()" class='sbar'>x Close this window x</a></div>