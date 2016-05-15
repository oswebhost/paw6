<? session_start();

include("config.ini.php");

include("function.ini.php");
	
	

$parts = explode(',',$_GET['BET']) ;
$SEASON= $parts[0] ;
$BET   = $parts[1] ;
$sele   = $parts[2] ;
$RESULT= $parts[3] ;

$db= $_GET['db'];

$qry = "SELECT * FROM setting";

if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
$row = $temp->fetch() ;     

$updating = $row["updating"];
$sended=$row["seasonended"];
$lastweek = $row["weekno"];
$cur_week  =$row["weekno"];








$prtURL = "print.php?msg=Prediction Performance"; 


$mywin = "mywin";
$window ='<a class="pp" href="javascript:myacct(';
$window .= "'" ;
$seleURL = "drawnobetsele.php?PARA=$SEASON,$BET," ;

$page_title= s_title($db)." Season $SEASON ". selection_type($BET) . " ". letters_call($sele) . " Wins Only Betting Outcome (Draw = No Bet)"; 

include("header.ini.php");

page_header("Analysis of Previous Predictions") ; 

?>
<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;"><?echo site($db);?></div>

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;padding-top:10px;padding-bottom:10px;">WIN ONLY BETTING OUTCOME (Draw = No Bet)</div>

<table  width="100%" align="center">
<tr>
	<td> <a class='sbar' href="analysis-of-previous-predictions.php?season=<?=$SEASON;?>&db=<?echo $db?>"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"><? echo printscr(); ?></td>
</tr>
</table>


<p>This shows you the running financial outcome to date if you had bet each week on the "Win Only" (Draw = No Bet) option in respect of the Segregated Selections Top 6 matches.</p>
<br/>

<? if (isset($BET)) : ?>

<!-- startprint -->
 <table border="1" width="400" align="center" cellpadding="3" cellspacing="0"  style="border-collapse: collapse;margin:auto auto;"   bordercolor="#cccccc">
 <tr>
      <td align='center' colspan="4">
	  <b><span class='big'><? echo $SEASON  . '   '.  selection_type($BET) ;?></span>
		<br/>
      <span class='big'><? echo letters_call($sele); ?></span>
	  </td>
	
    </tr>
    <tr bgcolor="#D3EBAB">
  	 <td><img src='images/tbcap/weekno.gif' border='0' alt='' /></td>
  	 <td><img src='images/tbcap/tcalls.gif' border='0' alt='' /></td>
  	 <td><img src='images/tbcap/success-big.gif' border='0' alt='' /></td>
  	 <td><img src='images/tbcap/net-ret.gif' border='0' alt='' /></td>
	</tr>
   

<?


$seleURL = '<a class="pp" href="javascript:myacct(\'drawnobetsele.php?PARA='. $SEASON .','. $BET .',' ;
//echo "bet : $BET, $sele, $RESULT, $SEASON" ;

$n=0;
$nMax= ($SEASON==curseason($db)? cur_week($db)-1 : 45);

$calls=0; $success=0; $wins=0;
for ($j=1; $j<=$nMax; $j++):
    $n++;
    $rowcol = rowcol($n);
    $data = Rt_Bet($BET, $sele, $j,$db) ;
  	echo "<tr $rowcol >";
  	if ($data->calls>0){
      echo '<td class="ctd tdper">';
      echo $seleURL . $j. ",$sele,$db')\">". $j . "</a></td>";
    }else{
      echo '<td class="ctd tdper">'. $j .'</td>';
    } 
    echo '<td class="ctd tdper">'. ($data->calls>0? num0($data->calls) : '') .'</td>'; 
    echo '<td class="ctd tdper">'. ($data->calls>0? num0($data->success) : '') .'</td>';
    echo '<td class="ctd tdper">'. ($data->calls>0? prtno($data->wins-$data->calls) : '') .'</td>';
    echo '</tr>' ;
    $calls += $data->calls;
    $success+= $data->success;
    $wins  += $data->wins;
  //  echo "$BET, $sele, $j/";
endfor;

$nMx = 45;


for ($i=$j; $i<=$nMx; $i++):
    $n++;
    $rowcol = rowcol($n);
  	echo "<tr $rowcol >";
    echo '<td class="ctd tdper">'. $i .'</td>'; 
    echo '<td class="ctd"></td>'; 
    echo '<td class="ctd"></td>';
    echo '<td class="ctd"></td>';
    echo '</tr>' ;
endfor;


echo "<tr bgcolor='#f4f4f4'>\n\n";
echo '<td align="center" class=\'credit\'>TOTAL</td>'; 
echo "<td align='center' class='credit'>" . num0($calls) ."</td>"; 
echo "<td align='center' class='credit'>" . num0($success) ."</td>"; 
echo "<td align='center' class='credit'>" . num20($wins-$calls) ."</td>"; 

echo '</tr>' ;


echo "<tr bgcolor='#f4f4f4'>\n\n";
echo '<td align="center" colspan="2" class=\'credit\' colspan="1"></td>'; 
 
echo "<td align='center' class='credit'>" . num2(($success/($calls>0?$calls:1)) *100) ."%</td>"; 
echo '<td align="center"></td>'; 

echo '</tr>' ;

?>


</table>
<BR><BR>

</center>
 

  
 <!-- stopprint -->

<? endif; ?> 
      

<? include("footer.ini.php");

function Rt_Bet($bet, $selefor, $wk,$db)
{ global $SEASON, $eu, $sa;

$qry = "SELECT season,mid,weekno,hgoal,agoal, h_s,a_s, bettype,matchtype,hw_odd,aw_odd FROM quickpick WHERE 
season='$SEASON' AND matchtype='$selefor' AND bettype='$bet' and weekno=$wk";

if ($db=='eu'){
    $temp = $eu->prepare($qry) ;
}else{
    $temp = $sa->prepare($qry);
}
$temp->execute();

$calls=0; $success = 0 ; $wins=0;
 
while ($d = $temp->fetch()){
  
  $hodd = (other_odds($d["mid"],"H",$d[season],$db)<1 ? other_odds($d["mid"],"H",$d[season],$db)+1: other_odds($d["mid"],"H",$d[season],$db));
  $aodd = (other_odds($d["mid"],"A",$d[season],$db)<1 ? other_odds($d["mid"],"A",$d[season],$db)+1: other_odds($d["mid"],"A",$d[season],$db));
	  
  if ($selefor == "HW"){
     
     if ($d[h_s]>$d[a_s]) { $calls++; $success++; $wins += $hodd ; }
     
     if ($d[h_s]<$d[a_s]) { $calls++; }

  }elseif ($selefor=="AW"){

     if ($d[a_s]>$d[h_s]) { $calls++; $success++; $wins+= $aodd ;}
     
     if ($d[a_s]<$d[h_s]) { $calls++; }
  }
}

 $data = new stdClass();
 $data->calls   = $calls ;
 $data->success = $success;
 $data->wins    = $wins;

 return $data;


}

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
