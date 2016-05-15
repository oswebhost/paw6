<? session_start();

  include("config.ini.php") ;
  include("function.ini.php") ;
  
  $parts = explode(',',$_GET['PARA']) ;
  $SEASON= $parts[0] ;
  $WEEKNO= $parts[1] ;
  $BET   = $parts[2] ;
  $db   = $parts[3] ;
    
   
  $pageURL = "";//"?PARA=$SEASON,$BET,$WEEKNO,$RESULT";

  if ($BET==1){
    $wtype = strtoupper("Home Win Favourites");
  }elseif($BET==2){
    $wtype = strtoupper("Away Win Favourites");
  }elseif($BET==3){
    $wtype = strtoupper("Draw Favourites");
  }
    
  

   $total_ret=0; $total_call=0;

 
  if ($BET==1){
     $qry="select f.wdate,f.weekno,date_format(f.match_date ,'%d-%b-%Y') as m_date, f.`div`,f.hteam,f.ateam, f.h_s, f.a_s,f.h_odd,f.a_odd,f.d_odd, f.h_odd as odds, r.rank from fixtures f, ranking r where f.season='$SEASON' and f.weekno='$WEEKNO' and f.h_odd>0 and f.h_s<>'P' and f.`div`=r.matchtype and r.cat='bk'and f.h_odd <=1.50 order by odds asc  limit 0,6";
  }elseif($BET==2){
    $qry="select f.wdate, f.weekno, date_format(f.match_date ,'%d-%b-%Y') as m_date, f.`div`,f.hteam,f.ateam, f.h_s, f.a_s,f.a_s,f.h_odd,f.a_odd,f.d_odd, f.a_odd as odds, r.rank from fixtures f, ranking r where f.season='$SEASON' and f.weekno='$WEEKNO' and f.a_odd>0 and f.h_s<>'P' and f.`div`=r.matchtype and r.cat='bk' and f.a_odd <=1.50 order by odds asc  limit 0,6";
  }elseif($BET==3){
     $qry="select f.wdate, f.weekno, date_format(f.match_date ,'%d-%b-%Y') as m_date, f.`div`,f.hteam,ateam, f.h_s, f.a_s, f.a_s,f.h_odd,f.a_odd,f.d_odd, abs(f.h_odd-f.a_odd) as odds,r.rank from fixtures f, ranking r where f.season='$SEASON' and f.weekno='$WEEKNO' and f.h_odd>2.20 and f.a_odd>2.20 and f.h_s<>'P' and f.`div`=r.matchtype and r.cat='bk'  order by f.d_odd  limit 0,6";
  }
    
    if ($db=='eu'){
       $temp = $eu->prepare($qry) ;
       $cap = "(European)";
    }else{
       $temp = $sa->prepare($qry);
       $cap = "(American)";
    }
    $temp->execute();

 
	
	
	$num_of_rows = $temp->rowCount() ;
	$data="";
	$number=0;
	$correct=0;
    $gain = 0;
	while ($row = $temp->fetch()):
		$wdate = $row["wdate"];
		$number++;
		
		$rowcol = rowcol($number);
		$data .= "<tr $rowcol height=\"18\">";
		$data .= '<td style="text-align: center">'. $number .'</td>';
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
		  
	   
       $data .= '<td align="center" '. ($BET==1? "bgcolor='#d3ebab'" : '')  . '>' . $row["h_odd"] . '</td>';
       $data .= '<td align="center" '. ($BET==3? "bgcolor='#d3ebab'" : '')  . '>' . $row["d_odd"] . '</td>';
       $data .= '<td align="center" '. ($BET==2? "bgcolor='#d3ebab'" : '')  . '>' . $row["a_odd"] . '</td>';
  

	  $data.= "<td  $rowcol style=\"text-align: center\">" ;
	  $data.= trim($row["h_s"]) . "-" . trim($row["a_s"]) ."</td>";
	 
		  
	
     
     if ($BET=="1"){
         if ($row[h_s]>$row[a_s]){
            $data .= '<td $rowcol style="text-align: center"><img src="images/tbcap/chked.gif" border="0" alt="Correct" /></td>'; 
            $data .= '<td $rowcol style="text-align: center">'. $row['h_odd'] .'</td>';
            $correct++;
            $gain += $row['h_odd'];
         }else{
            $data .= '<td $rowcol style="text-align: center"><img src="images/tbcap/xed.gif" border="0" alt="Wrong" /></td>';
            $data .= '<td $rowcol style="text-align: center">-</td>';
         }  
     }elseif($BET=="2"){
         if ($row[h_s]<$row[a_s]){
            $data .= '<td $rowcol style="text-align: center"><img src="images/tbcap/chked.gif" border="0" alt="Correct" /></td>'; 
            $data .= '<td $rowcol style="text-align: center">'. $row['a_odd'] .'</td>';
            $correct++;
            $gain += $row['a_odd'];
         }else{
            $data .= '<td $rowcol style="text-align: center"><img src="images/tbcap/xed.gif" border="0" alt="Wrong" /></td>';
            $data .= '<td $rowcol style="text-align: center">-</td>';
         }  
        
     }elseif($BET=="3"){
          if ($row[h_s]==$row[a_s]){
            $data .= '<td $rowcol style="text-align: center"><img src="images/tbcap/chked.gif" border="0" alt="Correct" /></td>'; 
            $data .= '<td $rowcol style="text-align: center">'. $row['d_odd'] .'</td>';
            $correct++;
            $gain += $row['d_odd'];

         }else{
            $data .= '<td $rowcol style="text-align: center"><img src="images/tbcap/xed.gif" border="0" alt="Wrong" /></td>';
            $data .= '<td $rowcol style="text-align: center">-</td>';
         }  

     }
     
		
		
	
		$data .= '</tr>';
  
    
		

	endwhile;

$data .= '<tr bgcolor="#f4f4f4" height="25">';
$data .= '<td colspan="8" align="right"><span class="credit">Totals:</span></td>';
$data .= '<td align="center"><span class="credit">' . num0($correct) .' </span></td>';
$data .= '<td align="center"><span class="credit">' . num2($gain) .' </span></td>';
$data .= '</tr>';

if ($number==0){ $number=1; }

$data .= '<tr bgcolor="#f4f4f4" height="25">';
$data .= '<td colspan="8" align="right"><span class="credit"> </span></td>';
$data .= '<td align="center"><span class="credit">' . prtno(($correct/$number)*100) .'%</span></td>';
$data .= '<td align="center"><span class="credit">' . prtno($gain-$number) .' </span></td>';
$data .= '</tr>';


?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<title>predictawin.com</title>

<? $page_title="Bookie Top 6 Success Rate $cap"; 
	page_header($page_title) ; 
?>

<div style="padding-bottom:0px"></div>
<center>
<!-- startprint -->
<? week_box($wdate,$SEASON, $WEEKNO, $wtype ,"95%") ;?>



<div style="padding-bottom:10px"></div>





<table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse;" bordercolor="#d6d6d6" width="95%" bgcolor="#D3EBAB">
		 
	<tr bgcolor="#d3ebab">
	<td width="5%" style="text-align: center" bgcolor="#d3ebab" rowspan="2">
	  <img src="images/tbcap/refno.gif"  border='0' alt="">
	  </td>

	  <td width="10%" style="text-align: center"  rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/></td>
	  <td width="38%" style="text-align: center" bgcolor="#d3ebab" rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
	  <td  style="text-align: center" bgcolor="#d3ebab" rowspan="2"><img src="images/tbcap/div.gif"  border="0" alt=""/></td>

     <td width="24%" style="text-align: center" height="10" bgcolor="#d3ebab" colspan="<?= ($ncol=='12'? 5: 3); ?>">
	  <img src="images/tbcap/odd.gif"  border="0"alt=""/></td>
      
	  <td width="6%" style="text-align: center" bgcolor="#d3ebab" rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
	  <td  style="text-align: center" bgcolor="#d3ebab" rowspan="2"> <img src="images/tbcap/correctcall.gif"  border="0" alt=""/></td>
      <td  style="text-align: center"  rowspan="2"><img src="images/tbcap/return.gif"  border="0" alt=""/></td>
</tr>
<tr>
 <? if ($RESULT=="DC") {?>
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/1x.gif"  border="0"alt=""></td>
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/12.gif"  border="0"alt=""></td>
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/2x.gif"  border="0" alt=""></td>
 <?}else{ ?> 
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/home.gif"  border="0"alt=""></td>
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/d.gif"  border="0"alt=""></td>
  <td width="8%" style="text-align: center" bgcolor="#d3ebab"><img src="images/tbcap/a.gif"  border="0" alt=""></td>
 <?}?>

<? if ($ncol=='12'): ?>
  <td width="8%" style="text-align: center" bgcolor="#D3EBAB">
  <img src="images/asl-odds.gif"  border="0" alt=""></td>
   <td width="8%" style="text-align: center" bgcolor="#d3ebab">
  <img src="images/act-odd.gif"  border="0" alt=""></td>
<? endif; ?>
</tr>



				 <? echo $data; ?>                

	</table>
<!-- stopprint -->  
         
  <table width='95%' style='margin:auto auto;'>
   <tr>
	    <td width='90%' valign='top'>
  		    <font size="1" color="#0000ff">Act Res&nbsp;=&nbsp;</font>Actual Result | 
		   <font size="1" color="#0000ff">P-P&nbsp;=&nbsp;</font>Postponed Match |
		   <font size="1" color="#0000ff">n/a&nbsp;=&nbsp;</font>Not Applicable

	   </td>
	   <td  valign="top" height="36" align='right' style="padding-right:0px">
		   <FONT SIZE="1" Color="#ff0000" ><a href="javascript:window.print()" class="sbar"><img border='0' src='images/header/blue-dot.gif' /> Print</a>
	   </td>
	  </tr>
	</table>
	
<div align="center"><A HREF="javascript:close()" class='sbar'>x Close this window x</A></div>

