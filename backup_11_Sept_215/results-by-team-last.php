<?	
session_start();

if ($loc =="Home" ): 
	$TEAM = $_SESSION['home'] ; $cap="<font color='blue'>" . strtoupper($_SESSION[home]) ."</font>" ;
else: 
	$TEAM = $_SESSION['away']; $cap="<font color='red'>". strtoupper($_SESSION[away]). "</font>" ;  
endif;

$myStyleB =" style='font-weight:bold;color:black;text-align:center;' ";
$myStyle =" style='font-weight:bold;color:black;text-align:center;'";


$query1 = "SELECT *, date_format(match_date,'%d-%b-%y') as mdate FROM `last_season_pred` WHERE hteam=\"$TEAM\" and season='$last_season' and  `div`<>'FA' and `div`<>'SA' and `div`<>'IN' ORDER BY match_date";

if ($db=='eu'){
    $temp = $eu->prepare($query1) ;
}else{
    $temp = $sa->prepare($query1);
}
$temp->execute();

$data="";
$number=0; $w=0; $d=0; $l=0; $t=0;  $pw=0; $pd=0; $pl=0; $pt=0; $over=0; $under=0;$pover=0; $punder=0;

while ($row = $temp->fetch()):
	$number++;
	if ($row["h_s"]=="P"):
		$rowcol = " bgcolor='#cccccc' ";
	else:
		$rowcol = rowcol($number);
	endif;
	

	$data.="<tr>";
	$data.= "<td $rowcol class='ctd padd'>";
	$data.= "&nbsp;".$row["mdate"] ."</td>";
	$data.="<td $rowcol  style=\"text-align: left\" >&nbsp;";
	$data.= $row["ateam"] ;
	$data.="</td>";


	if ($row["h_s"] > $row["a_s"]) :
		$act_rt = "H";
	elseif ($row["a_s"] > $row["h_s"]) :
		$act_rt = "A";
	else:
		$act_rt = "D" ;
	endif;

	if ($row["hgoal"] > $row["agoal"]) :
		$asl_rt = "H"; 
	elseif ($row["agoal"] > $row["hgoal"]) :
		$asl_rt = "A"; 
	else:
		$asl_rt = "D" ;
	endif;
	
	$h_s = trim($row["h_s"]); $a_s=trim($row["a_s"]);
	$char = ResultChar($h_s,$a_s,"H") ;
	
	if ( $char<>"P"):
	    $tg = (int) $row["h_s"] + (int) $row["a_s"];
        $taslg = (int) $row["hgoal"] + (int) $row["agoal"];
        
       
    		if ($tg < 2.5):
    			$under++;
    		elseif ($tg >2.5):
    			$over++;
    		endif;
       
        
		if ($taslg < 2.5):
			$punder++;
		elseif ($taslg >2.5):
			$pover++;
		endif;
        
		if ($row["hgoal"] > $row["agoal"]) :
			$asl_rt = "H"; $pw++;
		elseif ($row["agoal"] > $row["hgoal"]) :
			$asl_rt = "A"; $pl++;
		else:
			$asl_rt = "D" ; $pd++;
		endif;
	endif;

	$act_goal = trim($row["h_s"]) ."-" . trim($row["a_s"]) ;
	$asl_goal = trim($row["hgoal"]) ."-" . trim($row["agoal"]) ;



	if ($row['gotit']=='1'):
		
		$data.="<td bgcolor='#9D9DFF' style=\"text-align: center;width:20px;\">";
		if ($act_goal==$asl_goal):
			$data.= "<font style='font-size:12px;'><b>". trim($row["h_s"]) ."-" . trim($row["a_s"]) . "</b></font>"; 
		else:
			$data.=  trim($row["h_s"]) ."-" . trim($row["a_s"]) ; 
		endif;
		$data .= "</td>";
	else:
		$data.="<td $rowcol style=\"text-align: center;width:20px;\">";
		$data.=  trim($row["h_s"]) ."-" . trim($row["a_s"]) . "</td>";
	endif;

	

	if ($char=="W"): $w++;
        if ($act_goal==$asl_goal){
           $data.="<td bgcolor='#D2D2FF' class='ctd bold' style=\"width:20px;\">".  $char . "</td>";
        }else{
        	if ($row['gotit']=='1')	{
		  		$data.="<td bgcolor='#D2D2FF' class='ctd bold' style=\"width:20px;\">".  $char . "</td>";
		  	}else{
		  		$data.="<td bgcolor='#D2D2FF' style=\"text-align: center;width:20px;\">".  $char . "</td>";
		  	}
        } 	
	elseif ($char == "D") : $d++;
        if ($act_goal==$asl_goal){
		  $data.="<td bgcolor='#DFFFDF' class='ctd bold' style=\"width:20px;\">".  $char . "</td>";	
        }else{
        	if ($row['gotit']=='1')	{
          		$data.="<td bgcolor='#DFFFDF' class='ctd bold' style=\"width:20px;\">".  $char . "</td>";
          	}else{
          		$data.="<td bgcolor='#DFFFDF' style=\"text-align: center;width:20px;\">".  $char . "</td>";
          	}
        }
	elseif ($char == "L") : $l++;
        if ($act_goal==$asl_goal){
		  $data.="<td bgcolor='#FFD2D2' class='ctd bold' style=\"width:20px;\">".  $char . "</td>";	
        }else{
        	if ($row['gotit']=='1')	{
        		$data.="<td bgcolor='#FFD2D2' class='ctd bold' style=\"width:20px;\">".  $char . "</td>";		
        	}else{
        		$data.="<td bgcolor='#FFD2D2' style=\"text-align: center;width:20px;\">".  $char . "</td>";
        	}
          
        }
	else: 
		$data.="<td $rowcol style=\"text-align: center;width:20px;\"></td>";	
	endif;


	
	if ($row['gotit']=='1'):
		
		$data.="<td bgcolor='#9D9DFF' style=\"text-align: center;width:20px;\">";
		if ($act_goal==$asl_goal):
			$data.= "<font style='font-size:12px;'><b>". trim($row["hgoal"]) ."-" . trim($row["agoal"]) . "</b></font>"; 
		else:
			$data.=  trim($row["hgoal"]) ."-" . trim($row["agoal"]) ; 
		endif;
		$data .= "</td>";
	else:
		$data.="<td $rowcol style=\"text-align: center;width:20px;\">";
		$data.=  trim($row["hgoal"]) ."-" . trim($row["agoal"]) . "</td>";
	endif;

	$data.="</tr>";
endwhile;
	
	
$t  = $w + $d + $l ;
$pt = $pw + $pd + $pl ;

$data .= "<tr bgcolor='#f4f4f4'>\n" ;
$data .= "<td colspan='5' align='right'>\n";

$data .= "<table width='100%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#008800'>\n\n";
$data .= "<tr>\n" ;
$data .= "<td rowspan='2' $myStyle bgcolor='#f4f4f4' width='28%'>Predicted</td><td $myStyle bgcolor='#EAEAFF' width='18%'>Win</td> <td $myStyle bgcolor='#DFFFDF' width='18%'>Draw</td> <td $myStyle width='18%' bgcolor='#FFD2D2' width='18%'>Loss</td> <td $myStyle bgcolor='#FFFFC4'>TOTAL</td>";
$data .= "</tr>\n";
$data .= "<td $myStyleB bgcolor='#EAEAFF'>$pw</td> <td $myStyleB bgcolor='#DFFFDF'>$pd</td> <td $myStyleB bgcolor='#FFD2D2'>$pl</td> <td $myStyleB bgcolor='#FFFFC4'>$pt</td> </tr>";
$data .= "</table>\n";

$data .= "<div style='padding-bottom:3px;'></div>\n";
$data .= "<table width='100%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#008800'>\n\n";
$data .= "<tr>\n" ;
$data .= "<td rowspan='2' $myStyle bgcolor='#f4f4f4' width='28%' >Actual</td><td $myStyle bgcolor='#EAEAFF' width='18%'>Win</td> <td $myStyle bgcolor='#DFFFDF' width='18%'>Draw</td> <td $myStyle  bgcolor='#FFD2D2' width='18%'>Loss</td> <td $myStyle bgcolor='#FFFFC4' width='18%'>TOTAL</td>";
$data .= "</tr>\n";
$data .= "<td $myStyleB bgcolor='#EAEAFF'>$w</td> <td $myStyleB bgcolor='#DFFFDF'>$d</td> <td $myStyleB bgcolor='#FFD2D2'>$l</td> <td $myStyleB bgcolor='#FFFFC4'>$t</td> </tr>";
$data .= "</table>\n";

$data .= "<div style='padding-bottom:3px;'></div>\n";

$data .= "<table width='100%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#333333'>\n\n";
$data .= "<tr bgcolor='#FFEACA'>\n<td class='ctd bold' width='33%'>Call</td><td class='ctd bold'  width='33%'>Under 2.5</td><td class='ctd bold' width='33%'>Over 2.5</td></tr>\n";
$data .= "<td $myStyle bgcolor='#f4f4f4'>Predicted</td><td $myStyle bgcolor='#EAEAFF'>$punder</td><td $myStyle bgcolor='#EAEAFF'>$pover</td></tr>\n";
$data .= "<td $myStyle bgcolor='#f4f4f4'>Actual</td><td $myStyle bgcolor='#DFFFDF'>$under</td><td $myStyle bgcolor='#DFFFDF'>$over</td></tr>\n";
$data .= "</table>\n";

$data .= "</td>\n" ;
$data .= "</tr>\n";





$query1 = "SELECT *, date_format(match_date,'%d-%b-%y') as mdate FROM `last_season_pred` WHERE ateam=\"$TEAM\" and season='$last_season' and  `div`<>'FA' and `div`<>'SA' and `div`<>'IN' ORDER BY match_date";

if ($db=='eu'){
    $temp = $eu->prepare($query1) ;
}else{
    $temp = $sa->prepare($query1);
}
$temp->execute();

$data1 ="";
$number=0; $w=0; $d=0; $l=0; $t=0;   $pw=0; $pd=0; $pl=0; $pt=0;$over=0; $under=0;$pover=0; $punder=0;
while ($row = $temp->fetch()):

	$number++;
	if ($row["h_s"]=="P"):
		$rowcol = " bgcolor='#cccccc' ";
	else:
		$rowcol = rowcol($number);
	endif;
	$data1.="<tr>";
	$data1.= "<td $rowcol class='ctd padd'>";
	$data1.= "&nbsp;".$row["mdate"] ."</td>";
	$data1.="<td $rowcol  style=\"text-align: left\" height=\"12\">&nbsp;";
	$data1.= $row["hteam"] ;
	$data1.="</td>";

	
	if ($row["h_s"] > $row["a_s"]) :
		$act_rt = "H"; 
	elseif ($row["a_s"] > $row["h_s"]) :
		$act_rt = "A";
	else:
		$act_rt = "D" ;
	endif;

	if ($row["hgoal"] > $row["agoal"]) :
		$asl_rt = "H"; 
	elseif ($row["agoal"] > $row["hgoal"]) :
		$asl_rt = "A"; 
	else:
		$asl_rt = "D" ;
	endif;

	
	
	if ( $char<>"P"):
	    $tg = (int) $row["h_s"] + (int) $row["a_s"];
        $taslg = (int) $row["hgoal"] + (int) $row["agoal"];
        
        
    		if ($tg < 2.5):
    			$under++;
    		elseif ($tg >2.5):
    			$over++;
    		endif;
       
        
		if ($taslg < 2.5):
			$punder++;
		elseif ($taslg >2.5):
			$pover++;
		endif;
        
        
		if ($row["hgoal"] > $row["agoal"]) :
			$asl_rt = "H"; $pl++;
		elseif ($row["agoal"] > $row["hgoal"]) :
			$asl_rt = "A"; $pw++;
		else:
			$asl_rt = "D" ; $pd++;
		endif;
	endif;
	

	$h_s = trim($row["h_s"]); $a_s=trim($row["a_s"]);
	$char = ResultChar($h_s,$a_s,"A") ;

	$act_goal = trim($row["h_s"]) ."-" . trim($row["a_s"]) ;
	$asl_goal = trim($row["hgoal"]) ."-" . trim($row["agoal"]) ;

	if ($row['gotit']=='1'):
		$data1.="<td bgcolor='#9D9DFF' style=\"text-align: center;width:20px;\">";
		if ($act_goal==$asl_goal):
			$data1.= "<font style='font-size:12px;'><b>". trim($row["h_s"]) ."-" . trim($row["a_s"]) . "</b></font>"; 
		else:
			$data1.=  trim($row["h_s"]) ."-" . trim($row["a_s"]) ; 
		endif;
		$data .= "</td>";
	else:
		$data1.="<td $rowcol style=\"text-align: center;width:20px;\">";
		$data1.=  trim($row["h_s"]) ."-" . trim($row["a_s"]) . "</td>";
	endif;

	if ($char=="W"): $w++;
        if ($act_goal==$asl_goal){
		      $data1.="<td bgcolor='#D2D2FF'  class='ctd bold' style=\"width:20px;\">".  $char . "</td>";
        }else{
              if ($row['gotit']=='1'){
              	$data1.="<td bgcolor='#D2D2FF'  class='ctd bold' style=\"width:20px;\">".  $char . "</td>";
              }else{
              	$data1.="<td bgcolor='#D2D2FF' style=\"text-align: center;width:20px;\">".  $char . "</td>";
              }
        }  
        	
	elseif ($char == "D") : $d++;
	    if ($act_goal==$asl_goal){
		      $data1.="<td bgcolor='#DFFFDF' class='ctd bold' style=\"width:20px;\">".  $char . "</td>";
        }else{
        	  if ($row['gotit']=='1'){
              	$data1.="<td bgcolor='#DFFFDF' class='ctd bold' style=\"width:20px;\">".  $char . "</td>";
              }else{
              	$data1.="<td bgcolor='#DFFFDF' style=\"text-align: center;width:20px;\">".  $char . "</td>";
              }
        }  
    	
	elseif ($char == "L") : $l++;
	    if ($act_goal==$asl_goal){
		      $data1.="<td bgcolor='#FFD2D2' class='ctd bold' style=\"width:20px;\">".  $char . "</td>";
        }else{
        	 if ($row['gotit']=='1'){
              $data1.="<td bgcolor='#FFD2D2' class='ctd bold' style=\"width:20px;\">".  $char . "</td>";
             }else{
             	$data1.="<td bgcolor='#FFD2D2' style=\"text-align: center;width:20px;\">".  $char . "</td>";
             }
        }  
    	
	else: 
		$data1.="<td $rowcol style=\"text-align: center;width:20px;\"></td>";	
	endif;

	
	
	if ($row['gotit']=='1'):
		$data1.="<td bgcolor='#9D9DFF' style=\"text-align: center;width:20px;\">";
		if ($act_goal==$asl_goal):
			$data1.= "<font style='font-size:12px;'><b>". trim($row["hgoal"]) ."-" . trim($row["agoal"]) . "</b></font>"; 
		else:
			$data1.=  trim($row["hgoal"]) ."-" . trim($row["agoal"]) ; 
		endif;
		$data .= "</td>";
	else:
		$data1.="<td $rowcol style=\"text-align: center;width:20px;\">";
		$data1.=  trim($row["hgoal"]) ."-" . trim($row["agoal"]) . "</td>";
	endif;

	$data1.="</tr>";


endwhile;
	
$t  = $w + $d + $l ;
$pt = $pw + $pd + $pl ;
$data1 .= "<tr bgcolor='#f4f4f4'>\n" ;
$data1 .= "<td colspan='5' align='right'>\n";

$data1 .= "<table width='100%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#008800'>\n\n";
$data1 .= "<tr>\n" ;
$data1 .= "<td rowspan='2' $myStyle bgcolor='#f4f4f4' width='28%'>Predicted</td><td $myStyle bgcolor='#EAEAFF' width='18%'>Win</td> <td $myStyle bgcolor='#DFFFDF' width='18%'>Draw</td> <td $myStyle width='18%' bgcolor='#FFD2D2' width='18%'>Loss</td> <td $myStyle bgcolor='#FFFFC4'>TOTAL</td>";
$data1 .= "</tr>\n";
$data1 .= "<td $myStyleB bgcolor='#EAEAFF'>$pw</td> <td $myStyleB bgcolor='#DFFFDF'>$pd</td> <td $myStyleB bgcolor='#FFD2D2'>$pl</td> <td $myStyleB bgcolor='#FFFFC4'>$pt</td> </tr>";
$data1 .= "</table>\n";

$data1 .= "<div style='padding-bottom:3px;'></div>\n";
$data1 .= "<table width='100%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#008800'>\n\n";
$data1 .= "<tr>\n" ;
$data1 .= "<td rowspan='2' $myStyle bgcolor='#f4f4f4' width='28%' >Actual</td><td $myStyle bgcolor='#EAEAFF' width='18%'>Win</td> <td $myStyle bgcolor='#DFFFDF' width='18%'>Draw</td> <td $myStyle  bgcolor='#FFD2D2' width='18%'>Loss</td> <td $myStyle bgcolor='#FFFFC4' width='18%'>TOTAL</td>";
$data1 .= "</tr>\n";
$data1 .= "<td $myStyleB bgcolor='#EAEAFF'>$w</td> <td $myStyleB bgcolor='#DFFFDF'>$d</td> <td $myStyleB bgcolor='#FFD2D2'>$l</td> <td $myStyleB bgcolor='#FFFFC4'>$t</td> </tr>";
$data1 .= "</table>\n";

$data1 .= "<div style='padding-bottom:3px;'></div>\n";

$data1 .= "<table width='100%' cellpadding='2' border='1' style='border-collapse: collapse'  bordercolor='#333333'>\n\n";
$data1 .= "<tr bgcolor='#FFEACA'>\n<td class='ctd bold' width='33%'>Call</td><td class='ctd bold'  width='33%'>Under 2.5</td><td class='ctd bold' width='33%'>Over 2.5</td></tr>\n";
$data1 .= "<td $myStyle bgcolor='#f4f4f4'>Predicted</td><td $myStyle bgcolor='#EAEAFF'>$punder</td><td $myStyle bgcolor='#EAEAFF'>$pover</td></tr>\n";
$data1 .= "<td $myStyle bgcolor='#f4f4f4'>Actual</td><td $myStyle bgcolor='#DFFFDF'>$under</td><td $myStyle bgcolor='#DFFFDF'>$over</td></tr>\n";
$data1 .= "</table>\n";


$data1 .= "</td>\n" ;
$data1 .= "</tr>\n";


?>

		
			

	 <!-- startprint -->

	
<div align='center'> 

<? if ($loc =="Home" ): ?>
	  <center> <B>When Home: <?=$cap?></B>
	  <? if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
	  </center>
	  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#CDCDCD" width="100%">
	  
	  <tr bgcolor="#D3EBAB">
	   <td width="14%" class='ctd'><b>Date</b></td>
		<td width="20%" class='ctd'><b>Opponent</b></td>
		<td width="7%" class='ctd'><b>Act.<BR>Score</b></td>
		<td width="5%" class='ctd'><b>RT</b></td>
	    <td width="6%" class='ctd' ><b>ASL</b></td>
	  </tr>
	  <? echo $data ?>
	</table>

<? else: ?>
	  
	  <center> <B>When Away: <?=$cap?></B>
	  <? if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
	  </center>	 
	  <table border="1" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#CDCDCD" width="100%">
	  
	  <tr bgcolor="#D3EBAB">
	   <td width="14%" class='ctd'><b>Date</b></td>
		<td width="20%" class='ctd'><b>Opponent</b></td>
		<td width="7%" class='ctd'><b>Act.<BR>Score</b></td>
		<td width="5%" class='ctd'><b>RT</b></td>
	    <td width="6%" class='ctd'><b>ASL</b></td>
	  </tr>
	  <? echo $data1 ?>
	</table>

<? endif;?>

</div>