<?php
session_start();
include("config.ini.php");
include("function.ini.php");

if (!isset($db)){
  $db = 'eu';
}else{
  $db= $_GET['db'];
}

if (!isset($_GET['season'])):
	$cur = curseason($db);
else:
	$cur = $_GET['season'];
endif;


if (isset($_GET['db'])){
  $page_title = "Soccer Win Only Betting Outcome " . s_title($db) . " Season $cur";
}else{
  $page_title = "Soccer Win Only Betting Outcome";
}

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
$season  =$row["season"];


$active_mtab = 1;	  

include("header.ini.php");
?>

<style>
	#t1 {border-left:2px solid #555555; text-align:center;}
</style>

<? page_header("Analysis of Previous Predictions") ; ?>

<div style="padding-bottom:5px"></div>

<? if (isset($_GET['db'])){ 

?>
 
<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>


<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;padding-top:10px;padding-bottom:10px;">WIN ONLY BETTING OUTCOME (Draw = No Bet)</div>

<table  width="100%" align="center">
<tr>
	<td> <a class='sbar' href="analysis-of-previous-predictions.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"></td>
</tr>
</table>

<p style="padding-top: 12px;">Each of the various Analysis Sheets viewable under this section will show you the running financial outcome of betting on the "Win Only" (Draw = No Bet) option for the posted predictions in respect of the Segregated Selections Top 6 "Home Win" calls.</p>

<div style="padding-bottom:10px"></div>

<form method="get" action="win-only.php" style="padding:0;margin:0;">
<input type="hidden" name="db" value="<?echo $_GET['db'];?>"/>

<table border="0" width="550" cellpadding="3" style="border-collapse: collapse;margin:auto auto" bordercolor="#cccccc"  >

<tr>
	  
  <td  width="5%" >
	<span class='credit'><font  color="#0000ff">Season</font></span></td>

  <td  height="22"  >
	   <select size="1" name="season" style='padding:4px 2px;'  onChange="this.form.submit();">
	  
	  <? 
	
		$sqry = "SELECT distinct(season) as season from quickpick order by season desc" ;
        if ($db=='eu'){
            $temp = $eu->prepare($sqry) ;
        }else{
            $temp = $sa->prepare($sqry);
        }
        $temp->execute();
	   while ($sr = $temp->fetch()) : 
	  ?>
		  <option value="<?= $sr["season"] ?>" <?echo selected($cur, $sr["season"])?>><?= $sr["season"] ?></option>
	  
	  <? endwhile; ?>
</select>
 </table>

</form>

<div style="padding-bottom:5px"></div>

<table border="1" width="550" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#D1D1D1" bgcolor="#F6F6F6">
	<tr bgcolor="#D3EBAB" >
		<td width="280" class='ctd'><img src="images/tbcap/segtype.gif" border="0" alt="" /></td>
		<td width="107" class='ctd'><img src="images/tbcap/success-big.gif" border="0" alt="" /></td>
		<td width="107" class='ctd'><img src="images/tbcap/net-ret.gif" border="0" alt="" /></td>
	</tr>
	
<? 
	 
 $qry= "select * from ranking where cat='wo' and matchtype in ('HW') order by rank" ;
   if ($db=='eu'){
        $temp = $eu->prepare($qry) ;
    }else{
        $temp = $sa->prepare($qry);
    }
    $temp->execute();

	 $n=0;
	 while ($d = $temp->fetch() ) :				
		$n++;
		$bet= $d['bettype'];
		$mat= $d['matchtype'];
		$sele = $d['cap'];

		echo "<tr " . rowcol($n) . ">\n" ;
		echo "<td class='tdper'><a class='sbar2' href='win-only-summary.php?db=$db&BET=$cur,$bet,$mat,$sele'>";
		echo letters($d["bettype"]) . ' - '. letters_call($d["matchtype"]) . "</a></td>" ;
		$data = Rt_s($bet, $sele, $mat,$db );
		echo "<td class='tdper ctd'>". prt($data->success / ($data->calls>0?  $data->calls : 1)*100)  ."%</td>\n";
        echo "<td class='tdper ctd'>". prtno($data->wins-$data->calls ) ."</td>\n";
		echo "</tr>\n" ;
	endwhile;
	
?>
</table>

<?}else{?>
    
    <div class="report_blue_heading" style="width: 553px;margin:0 auto 5px auto;padding-top:10px;padding-bottom:10px;">WIN ONLY BETTING OUTCOME (Draw = No Bet)</div>
<?    
    include("select-option.ini.php");
    
} ?>


	

<? include("footer.ini.php"); 


function Rt_s($bet, $selefor, $mat ,$db)
{ global $cur, $eu, $sa;

    $wk = cur_week($db);
    if ($cur == curseason($db)){
      $qry = "SELECT season,mid,weekno,hgoal,agoal, h_s,a_s, bettype,matchtype,hw_odd,aw_odd FROM quickpick WHERE 
    season='$cur' AND matchtype='$mat' AND bettype='$bet' and weekno<$wk order by weekno";
    }else{
      $qry = "SELECT season,mid,weekno,hgoal,agoal, h_s,a_s, bettype,matchtype,hw_odd,aw_odd FROM quickpick WHERE 
    season='$cur' AND matchtype='$mat' AND bettype='$bet' order by weekno";
    }

    if ($db=='eu'){
        $tempw = $eu->prepare($qry) ;
    }else{
        $tempw = $sa->prepare($qry);
    }
    $tempw->execute();
    $calls=0; $success = 0 ; $wins=0;
     
    while ($d = $tempw->fetch()){
    
      $hodd = (other_odds($d["mid"],"H",$d[season],$db)<1 ? other_odds($d["mid"],"H",$d[season],$db)+1: other_odds($d["mid"],"H",$d[season],$db));
      $aodd = (other_odds($d["mid"],"A",$d[season],$db)<1 ? other_odds($d["mid"],"A",$d[season],$db)+1: other_odds($d["mid"],"A",$d[season],$db));
    
      if ($mat == "HW"){
         
         if ($d[h_s]>$d[a_s]) { $calls++; $success++; $wins += $hodd ; }
         
         if ($d[h_s]<$d[a_s]) { $calls++; }
    
      }elseif ($mat=="AW"){
    
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