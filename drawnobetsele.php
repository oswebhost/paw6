<? session_start();

  include("config.ini.php") ;
  include("function.ini.php") ;
  
  $parts = explode(',',$_GET['PARA']) ;
  $SEASON= $parts[0] ;
  $BET   = $parts[1] ;
  $WEEKNO= $parts[2] ;
  $RESULT= $parts[3] ;
  $db    = $parts[4] ;

  if   ($RESULT=="HW"): $wtype = "HOME CALLS";    
  elseif ($RESULT=="AW"): $wtype = "AWAY CALLS";  
 
  endif;
  $type = selection_type($BET) ;
  $query1 = "SELECT *,date_format(match_date,'%d-%b-%Y') as m_date FROM quickpick where season='$SEASON' and bettype='$BET' and  weekno='$WEEKNO'  and matchtype='$RESULT' and season='$SEASON' order by rank";
  if ($db=='eu'){
        $temp = $eu->prepare($query1) ;
    }else{
        $temp = $sa->prepare($query1);
    }
    $temp->execute();
	

?>

<link rel="stylesheet" type="text/css" href="css/style_v4.css" />
       
<? page_header("Analysis of Previous Predictions") ; ?>



<!-- startprint -->
<div class="report_blue_heading" style="width: 790px;margin:0 auto 5px auto;"><?echo site($db);?></div>

<? //week_box($wdate,$SEASON, $WEEKNO) ;?>
<? week_box($wdate,$SEASON, $WEEKNO, selection_type($BET) . " ". $wtype . " Win Only (Draw = \"No Bet\")", 800 ); ?>
<div style="padding-bottom:8px"></div>





<table border="1" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#d6d6d6" width="800" >

<tr bgcolor="#d3ebab">
    <td width="5%" class="ctd" rowspan="2"><img src="images/tbcap/rankno.gif"  border='0' alt=""/></td>
    <td class="ctd"  rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/></td>
    <td width='250' class="ctd" rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
    <td width='50' class="ctd" rowspan="2"><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
    <td width='50' class="ctd" rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
    <td width='50' class="ctd" rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
    <td width='50' class="ctd" colspan="2"><img src="images/tbcap/odd.gif"  border='0' alt=""/></td>
    <td class="ctd"  colspan="3"><img src="images/tbcap/correct_calls.gif"  border='0' alt=""/></td>
    <td class="ctd" rowspan="2"><img src="images/tbcap/return.gif"  border="0" alt=""/></td>
</tr>
<tr bgcolor="#d3ebab">
    <td class="ctd"><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
    <td class="ctd"><img src="images/tbcap/a.gif"  border='0' alt=""/></td>
    <td class="ctd"><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
    <td class="ctd"><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
    <td class="ctd"><img src="images/tbcap/a.gif"  border='0' alt=""/></td>
</tr>


              
<? 
  $temp->execute();
  
  $number=0;
  $correct=0; $hc=0; $dc=0; $ac=0; $ret=0; $ret5=0;
  
  while ($row = $temp->fetch()) {
    
    $hodd = (other_odds($row["mid"],"H",$SEASON,$db)<1 ? other_odds($row["mid"],"H",$SEASON,$db)+1: other_odds($row["mid"],"H",$SEASON,$db));
    $aodd = (other_odds($row["mid"],"A",$SEASON,$db)<1 ? other_odds($row["mid"],"A",$SEASON,$db)+1: other_odds($row["mid"],"A",$SEASON,$db));
    
    $act = $row['h_s'] ."-" .$row[a_s];
    $asl = $row['hgoal'] ."-" .$row[agoal];
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
  
    $home = rt_call($row['h_s'],$row['a_s'],"H");
    $draw = rt_call($row['h_s'],$row['a_s'],"D");
    $away = rt_call($row['h_s'],$row['a_s'],"A");
    
    $hc+= $home;
    $ac+= $away;
    $dc+= $draw;
    
    
    $number++;
?>   
    <tr <?echo rowcol($number);?>> 
        <td class="ctd padd"><?echo $row['rank'];?></td>    
        <td class="ctd"><?echo $row['m_date'];?></td>
        <td ><?echo $row['hteam'] . printv(' v ') . $row['ateam'];?></td>
        <td class="ctd"><?echo $row['div'];?></td>
        <td class="ctd <?echo $asl_class?>"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
        <td class="ctd <?echo $asl_class?>"><?echo $row['h_s'] . dash() . $row['a_s'];?></td>
        <td class="ctd"><?echo $hodd;?></td>
        <td class="ctd"><?echo $aodd;?></td>
        <td class="ctd"><?echo ($home==1? "<b>$home</b>" : $home);?></td>
        <td class="ctd"><?echo ($draw==1? "<b>$draw</b>" : $draw);?></td>
        <td class="ctd"><?echo ($away==1? "<b>$away</b>" : $away);?></td>
        <td class="ctd">
        <?
            if ($row['h_s']<>$row['a_s'] and $RESULT=='HW'){
                echo $hodd;
                $ret+=$hodd;
            }elseif ($row['a_s']<>$row['h_s'] and $RESULT=='AW'){
                echo $aodd;
                $ret+=$aodd;
            }elseif ($row['h_s']==$row['a_s']){
                echo "n/a";
            }else{
                echo $RESULT . '0.00';
            }
        ?>
        </td>
    </tr>

<?}?>

<tr bgcolor="#f4f4f4" >
    <td colspan="8" class="credit rtd"><b>Totals:</b></td>
    <td class="credit ctd"><?echo num0($hc);?></td>
    <td class="credit ctd"><?echo num0($dc);?></td>
    <td class="credit ctd"><?echo num0($ac);?></td>
    <td class="credit ctd"><?echo num2($ret);?></td>
</tr>

<tr bgcolor="#f4f4f4" >
    <td colspan="11" class="credit rtd"><b>Total Number of Valid Matches:</b></td>
    <td class="credit ctd"><?echo num0($hc+$ac);?></td>
</tr>

<tr bgcolor="#f0f0f0" >
    <td colspan="11" class='rtd'><span class="credit">Net Return All:</span></td>
    <td class="ctd"><span class="credit"><?echo num20($ret - ($hc+$ac));?></span></td>
</tr>
</table>
               
<!-- stopprint -->           
  
<div style="float: left;width:600px;padding-left:30px;font-size:10px;margin:5px 0 5px 0;">
    <font color="#0000ff">ASL&nbsp;=&nbsp;</font>Anticipated Score-Line |  
    <font color="#0000ff">Act Res&nbsp;=&nbsp;</font>Actual Result | 
    <font color="#0000ff">P-P&nbsp;=&nbsp;</font>Postponed Match | 
    <font color="#0000ff">n/a&nbsp;=&nbsp;</font>Not Applicable<br />
</div>

<div style="float: right;padding-right:30px;width:100px;text-align:right;margin:5px 0 5px 0;"><? echo printscr()?></div>

<div class="clear"></div>

<div style="padding:15px;font-size:13px;">
<? if ($SEASON<>curseason()) : 
	//	echo 'The above Odds are NOT the reduced "Wins Only" Odds, because we did not collect them for the season shown.  The "Wins Only" Odds would have been somewhat reduced from the figures given above.' ;
	else:
		//echo 'The above Odds are NOT the reduced "Win Only" Odds, which will of course be somewhat reduced from the figures shown for the Home Wins and Away Wins.' ;       
	endif;
?>

</div>  

<div align="center"><a href="javascript:close()" class='sbar'>x Close this window x</a></div>

<?

function other_odds($mid, $b,$SEASON,$db)
{ global $eu, $sa;

	if ($b=='H'):
		$q1="select hw_odd as odds from other_odds where matchno='$mid' and season='$SEASON'";
	else:
		$q1="select aw_odd as odds from other_odds where matchno='$mid' and season='$SEASON'";
	endif;

    if ($db=='eu'){
        $tempx = $eu->prepare($q1) ;
    }else{
        $tempx = $sa->prepare($q1);
    }
    $tempx->execute();
   
	$d1 = $tempx->fetch();
	if ($d1['odds']>0):
		return num2($d1['odds']);
	else:
		return 'n/a';
	endif;
}	


?>
