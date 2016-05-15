<?	
include("config.ini.php");
include("function.ini.php");
if (check_season()=='1'){ header('Location: commences.php'); exit; }



   
    

$query1 = "SELECT * from setting"; 
$result = mysql_query($query1) or die(mysql_error()); 
while ($row = mysql_fetch_array($result)):
	$updating = $row["updating"];$sended=$row["seasonended"];
	$lastweek = $row["weekno"];
endwhile;

if ($_GET['weekno']>0){
    $cur = $_GET['weekno'];
}else{
    $cur = cur_week();
}	

 $pwk = $weekno-1;
 $nwk = $weekno+1;

  if ($LOG=="N") : $purl .= "&LOG=N"; endif;
 $purl .= "&WEEKNO=";

 $ltable="<a class=blue href=ltable.php?DIV=$DIV#table>";
 $grid="<a class=blue target=_blank class=prv href=full.php?DIV=$DIV#table>";
 $query1 = "SELECT * FROM setting"; 
 $result = mysql_query($query1) or die( mysql_error() ); 
 while ($row = mysql_fetch_array($result)):
		$last_update =$row["lastupdate"];
		$cur_week    =$row["weekno"];
  endwhile;
  mysql_free_result($result); 
  $result = mysql_query("SELECT * FROM fixtures WHERE `weekno`='$weekno' and season='$season' limit 1") or die(mysql_error()); 
 $num_of_rows = mysql_num_rows ($result) ;
 while ($row = mysql_fetch_array($result)):
		$wdate   =$row["wdate"];
  endwhile;

  mysql_free_result($result); 

  $pic =  $weekno ."/pic";
  
  if ($_GET['MPRED']=='HW'):
    $query1 = "SELECT *,date_format(match_date,'%d-%b-%y') as mdate2 from fixtures where weekno='$weekno' and season='$season' and hgoal>agoal and`div`<>'MP' and `div`<>'UP' and`div`<>'RP' and`div`<>'FA' and`div`<>'SA' and`div`<>'IN' and `div`<>'NC'";
    $orderby = " ORDER BY hwinpb desc"; 
	$CAPTION = "HOME CALLS";
	$bg = " bgcolor='#f4f4f4' ";
 
  elseif($_GET['MPRED']=="AW"):
    $query1 = "SELECT *,date_format(match_date,'%d-%b-%y') as mdate2 from fixtures where weekno='$weekno' and season='$season' and hgoal<agoal and`div`<>'MP' and `div`<>'UP' and`div`<>'RP' and`div`<>'FA' and`div`<>'SA' and`div`<>'IN' and `div`<>'NC'";
    $orderby = " ORDER BY awinpb desc"; 
	$CAPTION = "AWAY CALLS";
	$bg = " bgcolor='#f4f4f4' ";
  
  else:
     $query1 = "SELECT f.*,date_format(match_date,'%d-%b-%y') as mdate2, r.gpr_av from fixtures f, cur_reb r where f.weekno='$weekno' and f.season='$season' and f.hgoal=f.agoal and f.`div`<>'MP' and f.`div`<>'UP' and f.`div`<>'RP' and f.`div`<>'FA' and f.`div`<>'NC' and f.`div`<>'SA' and f.`div`<>'IN' and f.mid=r.matchno and f.weekno=r.weekno and f.season=r.season";
     $orderby = " ORDER BY gpr_av desc";
	 $CAPTION = "DRAWS CALLS";
	 $bg = " bgcolor='#f4f4f4' ";
  endif;


 switch ($_GET['PERIOD'])
  {
    case 1: $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
    case 2: $period = " and weekday(match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
    case 3: $period = " and weekday(match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;
  }
  
  $query1 .= $period . $orderby ;
  $result = mysql_query($query1) or die(" $query1 --" .  mysql_error() ); 
  
 
  
   $data="";
   if (mysql_num_rows($result)== 0):
	  $data ="<tr><td colspan=10 align=center height=80><span class='error'>No Matches This Week</span></td></tr>";
   endif;
   $pic = "/pic/" ;
   $pic =  $weekno ."/pic";

   $number=0;
 	    while ($row = mysql_fetch_array($result)):
		   $number++;
		   $rowcol = rowcol($number);
		   $char = printv('v');
		   $matchno = trim($row["mid"]);
		   if ($matchno>0 and trim($row["hgoal"])!="N" and ($weekno==$cur_week)) :
			   $picurl = $pic . $matchno  . ".htm";
			   $mywin = "mywin" . $matchno;
			   $window ='<a title="Click to view PIC" class=md href="javascript:PicWin(';
			   $window .= "'" . $picurl ."'" ;
			   $window .= ')">';
		   else:
					$window="";
		   endif;
		   if ( ($DIV=='FA') or ($DIV=='SC')) :
				$window="";
				$h_team = explode("(",$row["hteam"]) ;
				$h_team = $h_team[0] ;

				$a_team = explode("(",$row["ateam"]) ;
				$a_team = $a_team[0] ;
		   else:
				$h_team = $row["hteam"] ;
				$a_team = $row["ateam"] ;
		   endif ;
	    
		  $data.="<tr $rowcol>";
      $data.="<td  style=\"text-align: center\" height=\"12\">";
      $data.="$number</td>";
          
		  
		  $data .= "<td  style=\"text-align: center\" >";
  	  if ($season==curseason()){    
		  $data.= "<a target='_blank' $h2 class=md2 href=team-performance-chart.php?id=$matchno>". $row["mdate"]. "&nbsp;<font size='1'>" . mtime($row['match_time']) . "</font></a></td>";
		  }else{
       $data.= $row["mdate2"];
      }
		  $data .= "</td>";

          $data.="<td  style=\"text-align: left\" height=\"12\">";
		  $data.= trim($row["hteam"]) ;
		  $data.= "&nbsp;$char&nbsp;"  ;
		  $data.= trim($row["ateam"]) ."</td>";
		  

	   	$data.= "<td  style=\"text-align: center\">" . trim($row["div"]) ."</td>";
		  
		  
		  $asl = trim($row["hgoal"]) ."-" . trim($row["agoal"]) ;
		  $act = trim($row["h_s"]) ."-" . trim($row["a_s"]) ;
		  
		  if (asl_pr_team($row["hteam"],$row["ateam"],$season)) :
		    if ($asl==$act){
		      $data .= "<td  style=\"text-align: center\" bgcolor='#D3EBAB'><b><font color='#999'><i>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</i></b></font></td>";
	        }else{
		    	 $data.= "<td  style=\"text-align: center\"><font color='#999'><i>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</i></font></td>";
		  	}
		  else:
		     if ($asl==$act){
			    $data.= "<td  style=\"text-align: center\" bgcolor='#D3EBAB'><b>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</b></td>";
			  }else{
				$data.= "<td  style=\"text-align: center\">" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</td>";
			 }
		  endif;
		  
		  if ($row["gotit"]==1){
		     if($asl==$act){
		        $data.= "<td  style=\"text-align: center\" bgcolor='#D3EBAB'><b>" . trim($row["h_s"] . ' - ' . $row["a_s"]) ."</b></td>";
         }else{
  		    $data.= "<td  style=\"text-align: center\"><b>" . trim($row["h_s"] . ' - ' . $row["a_s"]) ."</b></td>";
  		  }
      }else{
       
       $data.= "<td  style=\"text-align: center\">" . trim($row["h_s"] . ' - ' . $row["a_s"]) ."</td>";
       
       }
		  
		  
		  
		  if ($MPRED=='HW'):		
			 $data.= "<td bgcolor='#D3EBAB' style=\"text-align: center\" height=\"12\">";
		  else:
			 $data.= "<td  style=\"text-align: center\" height=\"12\">";
		  endif;
      
      $data.= num2($row["hwinpb"]) ."</td>";
		  $data.= "<td  style=\"text-align: center\" height=\"12\">";
		  $data.= num2($row["drawpb"]) . "</td>";

		 if ($MPRED=='AW'):		
			$data.= "<td bgcolor='#D3EBAB' style=\"text-align: center\" height=\"12\">";
		  else:
			$data.= "<td  style=\"text-align: center\" height=\"12\">";
		  endif;
		  $data .= num2($row["awinpb"]) . "</td>";
          
		  $data .= show_rebs($matchno,$weekno,$season,$MPRED) ;

		  $data.= "</tr>";

       endwhile;



$page_title = "$season Week No $weekno $CAPTION Matchs Probabilities Data"; 

$pageURL = "?PARA=$weekno";

include("header.ini.php");

?>


<? page_header("Match Probabilities Data" ); ?>
<div style="padding-bottom:5px"></div>




<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:0 auto 10px auto;" bordercolor="#f4f4f4" width="560">
	  <form method="get" action="prediction-by-probability-listing.php">
		<tr bgcolor="#f4f4f4">
		<td width="120" ><b><font size="2" color="#0000FF">Season</font></b></td>
        <td width="70" ><b><font size="2" color="#0000FF">Week No</font></b></td>
        <td width="80" ><b><font size="2" color="#0000FF">Bet Type</font></b></td>
        <td  width="100"><b><font size="2" color="#0000FF">Period</font></b></td>
        <td width="50" rowspan="2" style="vertical-align: bottom;"><input type="submit" value="View Data" name="B1" class="bt"></td>
        
        </tr>
        
        <tr bgcolor="#f4f4f4">
		  <td>

		 <select size="1" name="season" class="text">
		  <? 
		   
			  $sqry = mysql_query("SELECT distinct(season) as season from cur_reb order by season desc") or die (mysql_error()) ;
			 while ($sr = mysql_fetch_array($sqry)) : 
		  ?>
		      <option value="<?= $sr["season"] ?>" <?echo selected($_GET['season'],$sr["season"])?>><?= $sr["season"] ?></option>
		  
		  <? endwhile; ?>
		  </select>
		</td>
	
		  
		  <td>
		  <select size="1" name="weekno" class="text" >

		  <? for ($i=1; $i<=47; $i++) : ?>
			  <option value="<?= $i;?>" <? if($i==$cur): echo " selected"; endif;?>>&nbsp;<?= $i;?>&nbsp;&nbsp;&nbsp;</option>
		  <? endfor;?>		 

		  </select>
		  </td>
		  
		 
		  <td>
		  <select size="1" name="MPRED" class="text">
		  <option value="HW" <?echo selected($_GET['MPRED'],'HW')?>>Home Calls</option> 
		  <option value="AD" <?echo selected($_GET['MPRED'],'AD')?>>Draw Calls</option> 
		  <option value="AW" <?echo selected($_GET['MPRED'],'AW')?>>Away Calls</option> 
		  
		  </select>
		  </td>
		 
    		  
    		  <td>
    		  <select size="1" name="PERIOD" class="text" style="width:150px;">
    		   <option value="1" <?echo selected($_GET['PERIOD'],'1')?>>Full Week (Mon - Sun)</option> 
               <option value="2" <?echo selected($_GET['PERIOD'],'2')?>>Weekend (Sat - Sun)</option>
               <option value="3" <?echo selected($_GET['PERIOD'],'3')?>>Midweek (Mon - Fri)</option>
    		  </select>
    		  </td>
		 </tr>
         </form>
	  </table>


<? if ($_GET['B1']=='View Data') { ?>

<table  width="100%" align="center">
<tr>
	<td >  </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"> <? echo printscr(); ?></td>
</tr>
</table>


  <!-- startprint -->
<div style="padding-bottom:5px"></div>
   
<? week_box_new($CAPTION . "<br><font size='1' color='#000000'>$_prerid</font>", $weekno, $wdate, $_GET['season'],'560') ?>
   




<div style='text-align:center;padding:8px;font-size:12px;font-family:verdana;'>
The following shows the Probabilities up to <BR>the end of the previous week (until midnight on Sunday).
</div>

 



<table cellpadding='2' border="1" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="560" bgcolor="#F6F6F6">
<tr>
	  <td width="5%" style="text-align: center" bgcolor="#D3EBAB" rowspan="2">
	  <IMG SRC="images/tbcap/refno.gif"  BORDER='0' ALT="">
	  </td>
	  <td width="10%" style="text-align: center" bgcolor="#D3EBAB" rowspan="2">
	  <?if ($season==curseason()){ ?>
	   <IMG SRC="images/tbcap/datepic.gif"  BORDER="0" ALT="">
    <? }else { ?>     
      <IMG SRC="images/tbcap/date.gif"  BORDER="0" ALT="">
    <?}?> 
     </td>
	  <td width="38%" style="text-align: center" bgcolor="#D3EBAB" rowspan="2">
	   <IMG SRC="images/tbcap/match.gif"  BORDER="0" ALT=""></td>
	  <td width="5%" style="text-align: center" bgcolor="#D3EBAB" rowspan="2">
	   <IMG SRC="images/tbcap/div.gif"  BORDER="0" ALT=""></td>
	  <td width="6%" style="text-align: center" bgcolor="#D3EBAB" rowspan="2">
	   <IMG SRC="images/tbcap/asl.gif"  BORDER="0" ALT=""></td>
  
  <td width="6%" style="text-align: center" bgcolor="#D3EBAB" rowspan="2">
	   <IMG SRC="images/tbcap/act.gif"  BORDER="0" ALT=""></td>
	   
	  <td width="24%" style="text-align: center" height="10" bgcolor="#D3EBAB" colspan="3">
	  <IMG SRC="images/tbcap/probs.gif"  BORDER='0' ALT=""></td>

		<td width="6%" style="text-align: center" bgcolor="#D3EBAB" rowspan="2">
	   <IMG SRC="images/tbcap/av-reb.gif"  BORDER="0" ALT=""></td>

	</tr>
	<tr>
	  <td width="8%" style="text-align: center" bgcolor="#D3EBAB">
	 <IMG SRC="images/tbcap/home.gif"  BORDER='0' ALT=""></td>
	  <td width="8%" style="text-align: center" bgcolor="#D3EBAB">
	 <IMG SRC="images/tbcap/d.gif"  BORDER='0' ALT=""></td>
	  <td width="8%" style="text-align: center" bgcolor="#D3EBAB">
	  <IMG SRC="images/tbcap/a.gif"  BORDER='0' ALT=""></td>
	 
	</tr>                
	
	 <?  echo $data;  ?>
</table>
              
<div style='padding-top:4px;padding-left:5px;font-size:11px;'>
	
<FONT SIZE="1" COLOR="blue"><B>ASL</font></B> = <font color='black'>Anticipated Score-Line</FONT> |
<FONT SIZE="1" COLOR="blue"><B>Act Res</font></B> = <font color='black'>Actual Result</FONT> |
<FONT SIZE="1" COLOR="blue"><B>Avg Rels</font></B> = <font color='black'>Average Reliabilities</FONT> <br />
<FONT SIZE="1" COLOR="blue"><B><i>Italicised score-line</i></font></B> = <font color='black'>relegated and/or promoted teams playing</FONT><br>


</div>

<BR>&nbsp;<BR>&nbsp;<BR>

 
<!-- stopprint -->

<? 
}


include("footer.ini.php"); 


function show_rebs($mid,$week,$season,$sort)
{ global $h2;
//echo "select * from cur_reb where season='$season' and weekno='$week' and matchno='$mid'<br>";

 $qq = mysql_query("select * from cur_reb where season='$season' and weekno='$week' and matchno='$mid'") or die (mysql_error());
 
 $dd = mysql_fetch_array($qq) ;

 if ($sort=="AD"):
	 $data2 = "<td bgcolor='#D3EBAB' style=\"text-align: center\" height=\"12\">";
 else:
	$data2 = "<td style=\"text-align: center\" height=\"12\">";
 endif;

 $h33 = "onMouseover=\"ddrivetip('<B>Current Reliabilities Data</B><BR>". $dd['hteam'] . ": " . num2($dd["gpr_ht"]) ."<br>" . $dd['ateam'] . ": " . num2($dd["gpr_at"])  . "<br>Avg: ". num2($dd["gpr_av"]) . "<br>Diff: ". num20($dd["gpr_dif"]) ."', 150)\"; onMouseout=\"hideddrivetip()\"" ;

 $data2 .= "<a href='#' class='sbar'>" . num2($dd["gpr_av"]) . "</a></td>\n" ;
 return $data2;

}


?>
