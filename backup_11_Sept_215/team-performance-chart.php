<?

session_start();

include("config.ini.php") ;
include("function.ini.php");

if (isset($_GET['db'])){
	$db =  $_GET['db'];	
}else{
	$db =  $_GET['site'];
}



$id = $_GET['id'];
$sea = curseason($db);

$last_season = last_season_value($sea,$db);


$q= "select *,date_format(match_date,'%d-%b-%y') as m_date from `fixtures` where `mid`='$id' and season='$sea'" ;
if ($db=='eu'){
	$temp = $eu->prepare($q);
}else{
	$temp = $sa->prepare($q);
}
$temp->execute();

$d= $temp->fetch() ;
$home = trim($d["hteam"]) ;
$away = trim($d["ateam"]) ;
$cur_wk = $d["weekno"] ;
$DIV = $d['div'];

$home_div = team_to_div($home, $sea, $db);
$away_div = team_to_div($away, $sea, $db);

$start = ($cur_wk>=20? $cur_wk-19 : 1) ;
$asl= trim($d["hgoal"]) . '-'.trim($d["agoal"]) ;
$aslfile = "asl-$asl.php" ;


global $ydata, $y2data, $week_no ;
global $ydatalast, $y2datalast, $week_nolast, $week_no2 ;

unset($ydata);
unset($y2data);
unset($ydatalast);
unset($y2datalast);
unset($week_nolast);
unset($week_no2);

$q = "select weekno,gpr_ht from cur_reb where hteam=\"$home\" and season='$sea' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
if ($db=='eu'){
	$temp = $eu->prepare($q);
}else{
	$temp = $sa->prepare($q);
}
$temp->execute();
$x=0;
if ($temp->rowcount()==1):
	$dd= $temp->fetch();
	$week_no[]= $x;
	$ydata[] = $dd["gpr_ht"] ;
endif;


$q = "select weekno,gpr_ht from cur_reb where hteam=\"$home\" and season='$sea' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";

if ($db=='eu'){
	$temp = $eu->prepare($q);
}else{
	$temp = $sa->prepare($q);
}
$temp->execute();

while ($dd = $temp->fetch() ):
	$x++;
	$ydata[] = $dd["gpr_ht"] ;
	$week_no[] = $x ;
endwhile;


$x=0;

$q = "select weekno,gpr_at from cur_reb where  ateam=\"$away\" and season='$sea' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
if ($db=='eu'){
	$temp = $eu->prepare($q);
}else{
	$temp = $sa->prepare($q);
}
$temp->execute();

if ($temp->rowcount()==1):
	$dd= $temp->fetch();
	$week_no2[]= $x;
	$y2data[] = $dd["gpr_at"] ;
endif;

$q = "select weekno,gpr_at from cur_reb where  ateam=\"$away\" and season='$sea' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
if ($db=='eu'){
	$temp = $eu->prepare($q);
}else{
	$temp = $sa->prepare($q);
}
$temp->execute();
while ($dd = $temp->fetch() ):
	$x++;
	$y2data[] = $dd["gpr_at"] ;
	$week_no2[] = $x ;
endwhile;


////////// Last Season Reb /////////////////
if ($home=='Ebbsfleet U'):
	$q = "select weekno,gpr_ht from cur_reb where hteam='Gravesend' and season='$last_season' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
else:
	$q = "select weekno,gpr_ht from cur_reb where hteam=\"$home\" and season='$last_season' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
endif;
if ($db=='eu'){
	$temp = $eu->prepare($q);
}else{
	$temp = $sa->prepare($q);
}
$temp->execute();
$x=0;

if ($temp->rowcount()==0):
	$ydatalast[]  = 0 ;
endif;

if ($home=='Ebbsfleet U'):
	$q = "select weekno,gpr_ht from cur_reb where hteam='Gravesend' and season='$last_season' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
else:
	$q = "select weekno,gpr_ht from cur_reb where hteam=\"$home\" and season='$last_season' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
endif;

if ($db=='eu'){
	$temp = $eu->prepare($q);
}else{
	$temp = $sa->prepare($q);
}
$temp->execute();

while ($dd = $temp->fetch() ):
	$x++;
	$ydatalast[] = $dd["gpr_ht"] ;
endwhile;

$x=0;

if ($away=='Ebbsfleet U'):
	$q = "select weekno,gpr_at from cur_reb where ateam='Gravesend' and season='$last_season' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
else:
	$q = "select weekno,gpr_at from cur_reb where ateam=\"$away\" and season='$last_season' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
endif;
if ($db=='eu'){
	$temp = $eu->prepare($q);
}else{
	$temp = $sa->prepare($q);
}
$temp->execute();

if ($temp->rowcount()==0):
	$y2datalast[]  = 0 ;
	$week_nolast[] = 0 ;
endif;


if ($away=='Ebbsfleet U'):
	$q = "select weekno,gpr_at from cur_reb where ateam='Gravesend' and season='$last_season' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
else:
	$q = "select weekno,gpr_at from cur_reb where ateam=\"$away\" and season='$last_season' and `div`<>'FA' and `div`<>'SA' and `div`<>'IN' order by weekno";
endif;
if ($db=='eu'){
	$temp = $eu->prepare($q);
}else{
	$temp = $sa->prepare($q);
}
$temp->execute();



while ($dd = $temp->fetch() ):
	$x++;
	$y2datalast[] = $dd["gpr_at"] ;
	$week_nolast[] = $x ;
endwhile;




//////////////////


$_SESSION['ydata']   = $ydata; 
$_SESSION['y2data']  = $y2data; 
$_SESSION["week_no"] = $week_no;
$_SESSION["week_no2"]= $week_no2;

$_SESSION['ydatalast']   = $ydatalast; 
$_SESSION['y2datalast']  = $y2datalast; 
$_SESSION["week_nolast"] = $week_nolast;

$_SESSION["home"] = $home;
$_SESSION["away"] = $away;
$_SESSION['cur_wk'] = $cur_wk;
$_SESSION['div'] = $DIV;

if ($SERVER_ADDR=='127.0.0.1'):
	$file = "e:/pics/$cur_wk/pic$id.htm";
else:
	$file = dirname(__FILE__). "/pics/" . "$db/$sea/$cur_wk/pic$id.htm";
endif;


$hrank = last_season_rank(addslashes($home),$last_season,$db);
$arank = last_season_rank(addslashes($away),$last_season,$db);


if($cur_wk == cur_week($db) and !isset($_SESSION['userid'])){
   // header("location: loginfree.php");
   // exit;
}



$page_title="$home v $away Season $sea Week $cur_wk Team Performance Records";

include("header_pic.ini.php");

$page_title="Team Performance Records";

page_header("$page_title") ; 


?>

<div style="padding-bottom:2px"></div>

			
<TABLE width="98%" align="center"">
<TR>
	<TD ></TD>
	<TD align="center"><span class='bot'></span></TD>
	<TD align="right"> <? //echo printscr(); ?></TD>
</TR>
</TABLE>
<!-- startprint -->

<div style="margin:auto auto; width:520px;">

<table width='98%' border='1' cellpadding='2' cellspacing='0' style="border-collapse: collapse;" bordercolor="gray"> 
	<tr bgcolor="#f4f4f4" height='25'>
		<td colspan='10' class='ctd' ><font class='credit'><font color='blue'><?=$home;?></font> v <font color='red'><?=$away;?></font> Match Details</font></td>
	</tr>
	<tr bgcolor="#D3EBAB">
	   <td width='16%'class='ctd' rowspan="2"><b>Date</b></td>
	   <td width="5%"class='ctd' rowspan="2"><b>Div</b></td>
	   <td width="8%"class='ctd' rowspan="2"><b>ASL</b></td>
	   <td width="40%"class='ctd' colspan="3"><b>Probabilities %</b></td>
	   <td width="30%" class='ctd' colspan="4"><b>Odds</b></td>
	 </td>

	</tr>
		<tr bgcolor="#D3EBAB">
		  <td width="8%"class='ctd'><b><font color='blue'>Home</font></b></td>
		  <td width="8%"class='ctd'><b>Draw</b></td>
		  <td width="8%"class='ctd'><b><FONT COLOR="red">Away</FONT></b></td>
		  <td width="8%"class='ctd'><b><font color='blue'>H</font></b></td>
		  <td width="8%"class='ctd'><b>D</b></td>
		  <td width="8%"class='ctd'><b><FONT COLOR="red">A</FONT></b></td>
		  <td width="8%"class='ctd'><b>CS</b></td>
		</tr>

	<tr>
		<td  style='text-align:center;font-weight:bold;'><? echo $d["m_date"] . "&nbsp;<font size='1'>" . substr($d['match_time'],0,5) . "</font>"; ?> </td>
		<td style='text-align:center;font-weight:bold;'><? echo $d['div'] ;?> </td>
		<td style='text-align:center;font-size:14px;font-weight:bold;'>
		<? 
			if (asl_pr_team(addslashes($home),addslashes($away),$sea,$db)) {
				echo "<i>". $d["hgoal"] . '-'. $d["agoal"] ."</i>";
			}else{
				echo $d["hgoal"] . '-'. $d["agoal"] ;
			}
		?> 
		</td>
		<td style='text-align:center;font-weight:bold;' bgcolor='#D2D2FF'> <? echo $d['hwinpb']; ?> </td>
		<td style='text-align:center;font-weight:bold;' bgcolor='#DFFFDF'> <? echo $d['drawpb']; ?> </td>
		<td style='text-align:center;font-weight:bold;' bgcolor='#FFB0B0'> <? echo $d['awinpb']; ?> </td>
		<td style='text-align:center;font-weight:bold;'> <? echo ($d['h_odd']>0? $d['h_odd'] : '') ;?> </td>
		<td style='text-align:center;font-weight:bold;'> <? echo ($d['d_odd']>0? $d['d_odd'] : '') ;?> </td>
		<td style='text-align:center;font-weight:bold;'> <? echo ($d['a_odd']>0? $d['a_odd'] : '') ;?> </td>
		<td style='text-align:center;font-weight:bold;'> <? echo ($d['asl_odd']>0?$d['asl_odd'] : '') ;?> </td>
	</tr>
	<tr height='20'>
		<td colspan='10' style='text-align:center' > 
		<font color='red'>ASL</font> = Anticipated Score-Line</font>&nbsp;&nbsp;|&nbsp;&nbsp;
		<font color='red'>CS</font> = Correct Score</font><BR>
		</td>
	</tr>
	
</table>

<? // match probilities
	$homepb = $d["hwinpb"];
	$awaypb = $d["awinpb"];
	$drawpb = $d["drawpb"];

	$h_asl = $d["hgoal"] ;
	$a_asl = $d["agoal"] ;
	
?>

<div style="padding-bottom:10px"></div>
<!-- cs odds -->
<table border='0' cellpadding='0' cellspacing='0' width='98%' style='border:1px solid #FF0000;'> 
	<tr height='35'>	
		<td width='95%' bgcolor="#f4f4f4" style='text-align:center;border-bottom:1px solid gray;'> 
				<font class='credit'>Bookie's Correct Score Odds</font>  <BR>
				<FONT SIZE="1" >Odds provided courtesy of <? echo bookie_name("BET");?> </FONT>
				
		</td>
		<td class='rtd' bgcolor="#f4f4f4" style='text-align:center;border-bottom:1px solid gray;'>
			<a class='sbar' href="javascript:tell('full_odds.php?id=<?echo $_GET['id'];?>&db=<?echo $db;?>')">more...</a> 
		</td>
	</tr>
	<tr >
		<td colspan='2'>
			<? include ("cs_odds.php"); ?>
		</td>
	</td>
</table>

<div style="padding-bottom:10px"></div>
<!-- cs odds -->
<table border='0' cellpadding='0' cellspacing='0' width='98%' style='border:1px solid #FF0000;'> 
	<tr height='35'>	
		<td  bgcolor="#f4f4f4" style='text-align:center;border-bottom:1px solid gray;'> 
				<font class='credit'>Odds for Special Bet Types</font>  <BR>
		</td>
	</tr>
	<tr >
		<td>
			<? include ("other_odds.php"); ?>
			
		</td>
	</td>
</table>



<div style="padding-bottom:10px"></div>
<!-- Current Leauge Standing -->

    <? 
      if ($home_div==$away_div){
        
        $weekno=$cur_wk; $wk = max_tab_week($sea) ;  $t_url = "$home_div,$weekno,$sea,$last_season,,$_SESSION[home],$_SESSION[away]"; 
    
    ?>
       
    <table border='0' cellpadding='2' cellspacing='0' style='border:1px solid blue;' width='98%' style="border-collapse: collapse"> 
    	<tr>
    		<td colspan='2' style='text-align:center;padding:5px;border-bottom:1px solid gray;'  bgcolor="#f4f4f4">
    			<font class='credit'>League Standings Week <?php echo $weekno - 1; ?></font>
    		</td>
    	</tr>
    	<tr>
    		<td style='padding-top:5px;'>
            
    	   <ul id="countrytabs" class="shadetabs" style='margin:0px;padding:0'>
    			<li><a href="#" rel="#default" class="selected">Overall</a></li>
    			<li><a href="ltable-rank-home.php?t_url=<?=$t_url;?>" rel="countrycontainer">Home</a></li>
    			<li><a href="ltable-rank-away.php?t_url=<?=$t_url;?>" rel="countrycontainer">Away</a></li>
    	   </ul>
  		   </td> 
		  
		 </tr>
		 <tr>
			<td >
    		<div id="countrydivcontainer" style="width:504px;padding: 0px;margin-top:4px;">
    			<? include("ltable-rank.php"); ?>
    		</div>
    	 
    	</tr>
    </table>
	  <script type="text/javascript">
			var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
			countries.setpersist(false)
			countries.setselectedClassTarget("link") //"link" or "linkparent"
			countries.init()
	   </script>
	   
	   
	   
	   <?php if ($home_div=="MLS"){ $t_url = "$home_div,$weekno,$sea,$last_season,EC";    ?>
				
			   <table border='0' cellpadding='2' cellspacing='0' style='border:1px solid blue;margin-top:4px;' width='98%' style="border-collapse: collapse"> 
				<tr>
					<td colspan='2' style='text-align:center;padding:5px;border-bottom:1px solid gray;'  bgcolor="#f4f4f4">
						<font class='credit bb'>Eastern Conference </font>
					</td>
				</tr>
				<tr>
					<td style='padding-top:5px;'>
					
				   <ul id="countrytabs1" class="shadetabs" style='margin:0px;padding:0'>
						<li><a href="#" rel="#default" class="selected">Overall</a></li>
						<li><a href="ltable-rank-home.php?t_url=<?=$t_url;?>" rel="countrycontainer1">Home</a></li>
						<li><a href="ltable-rank-away.php?t_url=<?=$t_url;?>" rel="countrycontainer1">Away</a></li>
				   </ul>
				   </td> 
				  
				 </tr>
				 <tr>
					<td >
					<div id="countrydivcontainer1" style="width:504px;padding: 0px;margin-top:4px;">
						<? include("ltable-rank.php"); ?>
					</div>
				 
				</tr>
			</table>
			  <script type="text/javascript">
					var countries=new ddajaxtabs("countrytabs1", "countrydivcontainer1")
					countries.setpersist(false)
					countries.setselectedClassTarget("link") //"link" or "linkparent"
					countries.init()
			   </script>
		
			<?php $t_url = "$home_div,$weekno,$sea,$last_season,WC"; ?>
			   <table border='0' cellpadding='2' cellspacing='0' style='border:1px solid blue;margin-top:4px;' width='98%' style="border-collapse: collapse"> 
				<tr>
					<td colspan='2' style='text-align:center;padding:5px;border-bottom:1px solid gray;'  bgcolor="#f4f4f4">
						<font class='credit bb'>Western Conference </font>
					</td>
				</tr>
				<tr>
					<td style='padding-top:5px;'>
					
				   <ul id="countrytabs2" class="shadetabs" style='margin:0px;padding:0'>
						<li><a href="#" rel="#default" class="selected">Overall</a></li>
						<li><a href="ltable-rank-home.php?t_url=<?=$t_url;?>" rel="countrycontainer2">Home</a></li>
						<li><a href="ltable-rank-away.php?t_url=<?=$t_url;?>" rel="countrycontainer2">Away</a></li>
				   </ul>
				   </td> 
				  
				 </tr>
				 <tr>
					<td >
					<div id="countrydivcontainer2" style="width:504px;padding: 0px;margin-top:4px;">
						<? include("ltable-rank.php"); ?>
					</div>
				 
				</tr>
			</table>
			  <script type="text/javascript">
					var countries=new ddajaxtabs("countrytabs2", "countrydivcontainer2")
					countries.setpersist(false)
					countries.setselectedClassTarget("link") //"link" or "linkparent"
					countries.init()
			   </script>	   
	   
	   
	   <?php } ?>



	   
    <?}?>
    
    
     <? 
      if ($home_div<>$away_div){
        
        $weekno=$cur_wk; $wk = max_tab_week($sea) ;  $t_url = "$home_div,$weekno,$sea,$last_season"; 
    
    ?>
     
    <table border='0' cellpadding='2' cellspacing='0' style='border:1px solid blue;' width='98%' style="border-collapse: collapse"> 
    	<tr>
    		<td  style='text-align:center;padding:5px;border-bottom:1px solid gray;'  bgcolor="#f4f4f4">
    			<font class='credit'>League Standings Week  <?php echo $weekno - 1; ?></font>
    		</td>
    	</tr>
    	<tr>
    		<td width='100%' style='padding-top:5px;'>
            
    	   <ul id="countrytabs1" class="shadetabs" style='margin:0px;padding:0'>
    			<li><a href="#" rel="#default" class="selected">Overall</a></li>
    			<li><a href="ltable-rank-home.php?t_url=<?=$t_url;?>" rel="countrycontainer1">Home</a></li>
    			<li><a href="ltable-rank-away.php?t_url=<?=$t_url;?>" rel="countrycontainer1">Away</a></li>
    	   </ul>
    
    		<div id="countrydivcontainer1" style="width:504px;padding: 0px;margin-top:4px;">
    			<? include("ltable-rank.php"); ?>
    		</div>
    	 </td>
    	</tr>
    </table>
      <script type="text/javascript">
        	var countries=new ddajaxtabs("countrytabs1", "countrydivcontainer1")
        	countries.setpersist(false)
        	countries.setselectedClassTarget("link") //"link" or "linkparent"
        	countries.init()
       </script>
       
   <?    
       
          $weekno=$cur_wk; $wk = max_tab_week($sea) ;  $t_url = "$away_div,$weekno,$sea,$last_season"; 
    
    ?>
       
    <table border='1' cellpadding='2' cellspacing='0' style='border:1px solid blue;' width='98%' style="border-collapse: collapse"> 
    	<tr>
    		<td style='text-align:center;padding:5px;border-bottom:1px solid gray;'  bgcolor="#f4f4f4">
    			<font class='credit'>League Standings Week <?php echo $weekno - 1; ?></font>
    		</td>
    	</tr>
    	<tr>
    		<td width='50%' style='padding-top:5px;'>
            
    	   <ul id="countrytabs" class="shadetabs" style='margin:0px;padding:0'>
    			<li><a href="#" rel="#default" class="selected">Overall</a></li>
    			<li><a href="ltable-rank-home.php?t_url=<?=$t_url;?>" rel="countrycontainer">Home</a></li>
    			<li><a href="ltable-rank-away.php?t_url=<?=$t_url;?>" rel="countrycontainer">Away</a></li>
    	   </ul>
			
    		<div id="countrydivcontainer" style="width:504px;padding: 0px;margin-top:4px;">
    			<? include("ltable-rank.php"); ?>
    		</div>
    	 </td>
		
    	</tr>
    </table>
      <script type="text/javascript">
        	var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
        	countries.setpersist(false)
        	countries.setselectedClassTarget("link") //"link" or "linkparent"
        	countries.init()
       </script>
       
    <?}?>
    

<div style='padding:5px;text-align:center;margin:auto auto; width:500px;font-size:11px;'>
   Using Internet Explorer but the PIC display below is misaligned? <br />
   Then click the "broken page" icon to the right of the address bar. Problem solved!
</div>

<!-- The PIC -->
<table border='0' cellpadding='0' cellspacing='0' width='100%' style="border-collapse: collapse"> 
	<tr>	
		<td  style='text-align:center;padding-left:0px;padding-right:0px;' valign='top'> 
			<?  if (is_file($file)): include($file);  endif;  ?>
		</td>
	</tr>
</table>



<div style="padding-bottom:10px"></div>
<!-- Head to Head -->
<table border='0' cellpadding='1' cellspacing='0' style='border:1px solid blue;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>Head-to-Head </font> </td>
	</tr>
	<tr>
		<td width='50%' style='text-align:center' >  <b><FONT COLOR="blue"><? echo strtoupper($home); ?></FONT></b> 
		<? if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?> <b>at Home</b>
		</td>
		<td width='1%' align='center'>  </td>
		<td width='50%' style='text-align:center' > <b><FONT COLOR="red"><? echo strtoupper($away); ?></FONT></b>
		<? if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?> <b>at Home</b>  
		</td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top'> <? $loc ="Home"; include("headtohead2.php"); ?> </td>
		<td > </td>
		<td style='text-align:center' valign='top'> <? $loc ="Away"; include("headtohead2.php"); ?> </td>
	</tr>
	
</table>

<div style="padding-bottom:10px"></div>
<!-- Resutls to Date -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #FF9900;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>
		Current Season's Results to Date </font> </td>
	</tr>
	
	<tr>
		<td style='text-align:center' valign='top'> <? $loc ="Home"; include("results-by-team.php"); ?> </td>
		<td > </td>
		<td style='text-align:center' valign='top'> <? $loc ="Away"; include("results-by-team.php"); ?> </td>
	</tr>
	<tr height='20'>
		<td colspan='3' style='text-align:center' > 
		<font color='red'> Act. Score</font> = Actual Score</font>&nbsp;&nbsp;|&nbsp;&nbsp;
		<font color='red'> RT</font> = Match Result</font>&nbsp;&nbsp;|&nbsp;&nbsp; 
		<font color='red'> ASL</font> = Anticipated Score-Line</font> 
		</td>
	</tr>
</table>


<div style="padding-bottom:10px"></div>
<!-- Resutls to Date -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #FF9900;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>
		Current Season's Results to Date </font> </td>
	</tr>
	
	<tr>
		<td style='text-align:center' valign='top'> <? $loc ="Home"; include("results-by-team2.php"); ?> </td>
		<td > </td>
		<td style='text-align:center' valign='top'> <? $loc ="Away"; include("results-by-team2.php"); ?> </td>
	</tr>
	<tr height='20'>
		<td colspan='3' style='text-align:center' > 
		<font color='red'> Act. Score</font> = Actual Score</font>&nbsp;&nbsp;|&nbsp;&nbsp;
		<font color='red'> RT</font> = Match Result</font>&nbsp;&nbsp;|&nbsp;&nbsp; 
		<font color='red'> ASL</font> = Anticipated Score-Line</font> 
		</td>
	</tr>
</table>



<div style="padding-bottom:10px"></div>


<!-- Prediction Accuracy  -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #FF00FF;' width='98%' style="border-collapse: collapse"> 

	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>Prediction Accuracy This Season for Home Team <font color='blue'><?=$home;?></font> </font> 
		<? if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
		</td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top'>
			<?  include("prediction-accuracy.php"); ?> </td>
		</td>
	</tr>
	
	<tr height='5'><td></td></tr>

	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>Prediction Accuracy This Season for Away Team <FONT COLOR="red"><?=$away;?></FONT> </font> 
		<? if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
		</td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top'>
			<? include("prediction-accuracy-away.php"); ?> </td>
		</td>
	</tr>

</table>

<div style="padding-bottom:10px"></div>
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #FF9900;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td colspan='5' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>
		Frequency of Goals For/Against (Current)</font> </td>
	</tr>
	<tr>
		<td style='text-align:center' colspan='5' width='100%'><font style='font-weight:bold;font-size:12px;'>Score-Lines</font></td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top' colspan='2' width='49%'><? $loc = "Home"; include("goals-lines-by-team.php"); ?></td>
		<td width='2%'></td>
		<td style='text-align:center' valign='top' colspan='2' width='49%'><? $loc = "Away"; include("goals-lines-by-team.php"); ?></td>
	</tr>
	
	<tr>
		<td style='text-align:center' valign='top' colspan='2' width='49%'><? $loc = "Home"; include("goals-by-team.php"); ?></td>
		<td width='2%'></td>
		<td style='text-align:center' valign='top' colspan='2' width='49%'><? $loc = "Away"; include("goals-by-team.php"); ?></td>
	</tr>
	
</table>


<div style="padding-bottom:10px"></div>
<!-- Prediction Accuracy  -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #993300;' width='98%' style="border-collapse: collapse"> 

	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4">
         <font class='credit'>Average Chances for Exact Score Possibilities</font> </td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top'>
			<? 
				//if (is_file("aslchat/$aslfile")):  
					//include("aslchat/$aslfile"); 
				//else: 
				//	echo "No prediction data available"; 
				//endif; 

				include("asl-chat.php"); 
			?>
		</td>
	</tr>
	
	<tr height='5'><td></td></tr>

	
</table>
<?
//echo "select aw as win, ad as draw, al as loss from old_tabs where team=\"$team\" and season='$last_season'";
?>

<div style="padding-bottom:10px"></div>
<!-- Home or Away -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid green;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td  style='text-align:center' colspan='4' bgcolor="#f4f4f4"> 
			<font class='credit'>Incidence of Results</font>
		</td>
	</tr>
<!-- home and away -->
	<tr >
		<td width='48%' style='text-align:center'><b><FONT COLOR="blue"><? echo $home ?></FONT></b>
		 <? if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
		  if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>

		<BR>Home Team Performance at <font color='blue'><B>Home</B></font></td>
		<td width='5%' align='center'>  </td>
		<td width='48%' style='text-align:center'> <b><FONT COLOR="red"><? echo $away ?></FONT></b> 
		 <? if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
		  if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
		<BR>Away Team Performance when <font color='red'><B>Away</B></font> </td>
	</tr>
				
	<tr>
		<td valign='top' style='padding-left:5px;text-align:center'><IMG SRC="Rt-bar-all.php?<? echo bar_data($home,"Home",$db);?>" BORDER="0"  alt=''> </td>
		<td > </td>
		<td valign='top'> <IMG SRC="Rt-bar-all.php?<? echo bar_data($away,"Away",$db);?>" BORDER="0"  alt=''> </td>
	</tr>
	
<!-- away and home -->
	<tr>
		<td width='48%' style='text-align:center'>
		<BR>Home Team Performance when <font color='red'><B>Away</B></font></td>
		<td width='5%' align='center'>  </td>
		<td width='48%' style='text-align:center'>
		<BR>Away Team Performance at <font color='blue'><B>Home</B></font> </td>
	</tr>
				
	<tr>
		<td valign='top' style='padding-left:5px;text-align:center'><IMG SRC="Rt-bar-all.php?<? echo bar_data($home,"Away",$db);?>" BORDER="0"  alt=''> </td>
		<td > </td>
		<td align='center' valign='top'><IMG SRC="Rt-bar-all.php?<? echo bar_data($away,"Home",$db);?>" BORDER="0"  alt=''> </td>
	</tr>
	
<!-- over all -->
	<tr>
		<td width='48%' style='text-align:center'>
		<BR>Home Team Performance <font color='green'><B>Overall</B></font></td>
		<td width='5%' align='center'>  </td>
		<td width='48%' style='text-align:center'>
		<BR>Away Team Performance <font color='green'><B>Overall</B></font> </td>
	</tr>
				
	<tr>
		<td valign='top' style='padding-left:5px;text-align:center'><IMG SRC="Rt-bar-all.php?<? echo bar_data($home,"All",$db);?>" BORDER="0"  alt=''> </td>
		<td > </td>
		<td align='center' valign='top'> <IMG SRC="Rt-bar-all.php?<? echo bar_data($away,"All",$db);?>" BORDER="0"  alt=''> </td>
	</tr>


	<tr>
		<td colspan='3'><IMG SRC="images/gcap.gif"  BORDER="0" ALT=""></td>
	</tr>
</table>










<? $wk = ($cur_wk-1); ?>

<div style="padding-bottom:10px"></div>
<!-- Chart of Rebilaibities -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #0080C0;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td width='100%' style='text-align:center' bgcolor="#f4f4f4"><FONT class='credit'>
		Current Season's Prediction Reliabilities </font></td>
		
	</tr>
	<tr height='20'>
		<td width='100%' style='text-align:center'><FONT class='credit' color='blue'><?=$home;?> </font> 
		<? if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
		<FONT class='credit'> at Home</font></td>
		
	</tr>
	<tr>
		<td style='text-align:center' valign='top'><img src="Rb-Chart.php" border="0">  </td>
		
	</tr>	

	<tr height='20'>
		<td width='100%' style='text-align:center'><FONT class='credit' color='red'><?=$away;?></font> 
		<? if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
		<FONT class='credit'>Away</FONT></td>
		
	</tr>
	<tr>
		<td style='text-align:center' valign='top'> <img src="Rb-Chart2.php" border="0">  </td>
		
	</tr>
</table>
<div style="padding-bottom:10px"></div>



<div style="padding-bottom:10px"></div>
<!-- Chart of Rebilaibities -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid red;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td width='100%' style='text-align:center' bgcolor="#f4f4f4">  <b><FONT class='credit'>
		Last Season's Prediction Reliabilities </b></td>
		
	</tr>
	
	<tr>
		<td style='text-align:center' valign='top'>
		 <? if ( ($hrank=="rel" or $hrank=="prom") and ($arank=="rel" or $arank=="prom") ): 
				
				echo "<font size='2'><br>Last Season's Prediction Reliabilities data not avaliable for either team.</font><br><br>";
		    else:
			
		 ?>
			<img src="Rb-Chart-last.php" border="0">   
		 <? endif; ?>


		</td>
		
	</tr>

</table>




<div style="padding-bottom:10px"></div>
<!-- Prediction Accuracy  LAST SEASON-->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #666600;' width='98%' style="border-collapse: collapse"> 

	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>Prediction Accuracy Last Season for Home Team <font color='blue'><?=$home;?></font></font>
		<? if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
		?>
		</td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top'>
			<?  include("prediction-accuracy-last.php"); ?> </td>
		</td>
	</tr>
	
	<tr height='5'><td></td></tr>

	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>Prediction Accuracy Last Season for Away Team <FONT COLOR="red"><?=$away;?></FONT> </font> 
		<? if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
		   if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;?>
		</td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top'>
			<? include("prediction-accuracy-away-last.php"); ?> </td>
		</td>
	</tr>

</table>




<div style="padding-bottom:10px"></div>
<!-- Predictin/Gls LAST SEASON-->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #660000;' width='98%' style="border-collapse: collapse"> 
	<tr>
		 <td width='50%' style='text-align:center; border-right:1px solid #555555;'>
			<font class='credit'>Home Team <FONT COLOR="blue"><?=$home; ?></font></font>
			<? if ($hrank=="rel"): echo "<i> [Relegated] </i>"; endif;
			   if ($hrank=="prom"): echo "<i> [Promoted] </i>"; endif;
			?>
		</td>

		  
		  
		  <td width='50%' style='text-align:center'>
			  <font class='credit'>Away Team <FONT COLOR="red"><?=$away; ?></font></font>
			  <? if ($arank=="rel"): echo "<i> [Relegated] </i>"; endif;
				 if ($arank=="prom"): echo "<i> [Promoted] </i>"; endif;
			   ?>
		  </td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top' colspan='3'>
			<?php  include("last-season-pred-gls.php"); ?> </td>
		</td>
	</tr>
	

</table>


<div style="padding-bottom:10px"></div>
<!-- Resutls to Date -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #FF9900;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>
		 LAST SEASON'S DETAILED MATCH OUTCOMES</font> </td>
	</tr>
	
	<tr>
		<td style='text-align:center' valign='top'> <? $loc ="Home"; include("results-by-team-last.php"); ?> </td>
		<td > </td>
		<td style='text-align:center' valign='top'> <? $loc ="Away"; include("results-by-team-last.php"); ?> </td>
	</tr>
	
	<? if ($DIV=='NC'): ?>
		<tr height='20'>
			<td colspan='3' style='text-align:center' > 
				Ebbsfleet U - formerly Gravesend 
			</td>
		</tr>
	<?endif;?>

	<tr height='20'>
		<td colspan='3' style='text-align:center' > 
		<font color='red'> Act. Score</font> = Actual Score</font>&nbsp;&nbsp;|&nbsp;&nbsp;
		<font color='red'> RT</font> = Match Result</font>&nbsp;&nbsp;|&nbsp;&nbsp; 
		<font color='red'> ASL</font> = Anticipated Score-Line</font> 
		</td>
	</tr>
</table>

<div style="padding-bottom:10px"></div>
<!-- Resutls to Date -->
<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #FF9900;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td colspan='3' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>
		 LAST SEASON'S DETAILED MATCH OUTCOMES</font> </td>
	</tr>
	
	<tr>
		<td style='text-align:center' valign='top'> <? $loc ="Home"; include("results-by-team-last2.php"); ?> </td>
		<td > </td>
		<td style='text-align:center' valign='top'> <? $loc ="Away"; include("results-by-team-last2.php"); ?> </td>
	</tr>
	
	<? if ($DIV=='NC'): ?>
		<tr height='20'>
			<td colspan='3' style='text-align:center' > 
				Ebbsfleet U - formerly Gravesend 
			</td>
		</tr>
	<?endif;?>

	<tr height='20'>
		<td colspan='3' style='text-align:center' > 
		<font color='red'> Act. Score</font> = Actual Score</font>&nbsp;&nbsp;|&nbsp;&nbsp;
		<font color='red'> RT</font> = Match Result</font>&nbsp;&nbsp;|&nbsp;&nbsp; 
		<font color='red'> ASL</font> = Anticipated Score-Line</font> 
		</td>
	</tr>
</table>

<div style="padding-bottom:10px"></div>

<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid #FF9900;' width='98%' style="border-collapse: collapse"> 
	<tr height='20'>
		<td colspan='5' style='text-align:center'  bgcolor="#f4f4f4"> <font class='credit'>
		Last Season's Frequency of Goals For/Against </font> </td>
	</tr>
	<tr>
		<td style='text-align:center' colspan='5' width='100%'><font style='font-weight:bold;font-size:12px;'>Score-Lines</font></td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top' colspan='2' width='49%'><? $loc = "Home"; include("lastseason-goals-lines-by-team.php"); ?></td>
		<td width='2%'></td>
		<td style='text-align:center' valign='top' colspan='2' width='49%'><? $loc = "Away"; include("lastseason-goals-lines-by-team.php"); ?></td>
	</tr>
	<tr>
		<td style='text-align:center' valign='top' colspan='2' width='49%'><? $loc = "Home"; include("last-season-goals-by-team.php"); ?></td>
		<td width='2%'></td>
		<td style='text-align:center' valign='top' colspan='2' width='49%'><? $loc = "Away"; include("last-season-goals-by-team.php"); ?></td>
	</tr>
	
</table>


<div style="padding-bottom:10px"></div>


</div>

 <!-- stopprint -->


<? 

unset($ydata);
unset($y2data);
unset($week_no);
unset($ydatalast);
unset($y2datalast);
unset($week_nolast);
unset($week_no2);
unset($home);
unset($away);
unset($div);
unset($cur_wk);
unset($loc);

$_SESSION['home'] = "";
$_SESSION['away'] = "";

include("footer_pic.ini.php");

function draw_table($win,$draw,$away) 
{   $ww = (int) $win ; $wd = (int) $draw ; $wa = (int) $away ;
	$st = "style='text-align:center;color:black;font-weight:bold;'";
	$content = '';
	$content .= "<table width='100%' cellpadding='0' cellspacing='0' border='0'>\n\n" ;
	$content .= "<tr height='18'>\n" ;
	$content .= "<td width='$ww%' bgcolor='#D2D2FF' $st >$win%</td> \n";
	$content .= "<td width='$wd%' bgcolor='#FFEAFF' $st>$draw%</td> \n";
	$content .= "<td width='$wa%' bgcolor='#FFB0B0' $st>$away%</td> \n";
	$content .= "</tr>\n</table>\n\n";
	return $content ;
}


function bar_data($team,$side,$db)
{ 
	global $sea,$DIV, $cur_wk, $last_season, $eu, $sa;

    $cw = $cur_wk-1;

	if ($side=="Home"){
		$my_qry = "select hw as win, hd as draw, hl as loss from tabs where team=\"$team\" and season='$sea' and weekno='$cw'";
	}elseif ($side=="Away"){
		$my_qry = "select aw as win, ad as draw, al as loss from tabs where team=\"$team\" and season='$sea' and weekno='$cw'";
	}elseif ($side=="All"){
		$my_qry = "select sum(hw+aw) as win, sum(hd+ad) as draw, sum(hl+al) as loss from tabs where team=\"$team\" and season='$sea'  and weekno='$cw'";
	}

	

	$total=0; $win   = 0; $draw  = 0; $loss  = 0;
    $win_last=0;$draw_last=0;$loss_last=0;$total_last=0; 
   
	if ($db=='eu'){
        $tempw = $eu->prepare($my_qry);
    }else{
        $tempw = $sa->prepare($my_qry);
    }
    
    $tempw->execute();

    $dd  = $tempw->fetch();

	$total = $dd["win"] + $dd["draw"] + $dd["loss"] ;
	$win   = num0($dd["win"])  ;
	$draw  = num0($dd["draw"]) ;
	$loss  = num0($dd["loss"]) ;

	$team = ($team=='Ebbsfleet U'?"Gravesend":$team);
	/// Last season data
	if ($side=="Home"):
		$my_qry = "select hw as win, hd as draw, hl as loss from old_tabs where team=\"$team\" and season='$last_season'";
	elseif($side=="Away"):
		$my_qry = "select aw as win, ad as draw, al as loss from old_tabs where team=\"$team\" and season='$last_season'";
	elseif($side=="All"):
		$my_qry = "select sum(hw+aw) as win, sum(hd+ad) as draw, sum(hl+al) as loss from old_tabs where team=\"$team\" and season='$last_season'";
	endif;
	
	if ($db=='eu'){
        $tempw = $eu->prepare($my_qry);
    }else{
        $tempw = $sa->prepare($my_qry);
    }
    $tempw->execute();

    $dd  = $tempw->fetch();
	
	$total_last = $dd["win"] + $dd["draw"] + $dd["loss"] ;
	/*
	if ($total_last>0):
		$win_last   = num2( ($dd["win"]/$total_last)  * 100) ;
		$draw_last  = num2( ($dd["draw"]/$total_last) * 100) ;
		$loss_last  = num2( ($dd["loss"]/$total_last) * 100) ;
	endif;
	*/
	$win_last   = num0($dd["win"]) ;
	$draw_last  = num0($dd["draw"]) ;
	$loss_last  = num0($dd["loss"]) ;

	return "win=$win&draw=$draw&loss=$loss&win_last=$win_last&draw_last=$draw_last&loss_last=$loss_last" ;
}

function res($hs, $as)
{
	if ( $hs > $as )
	{
		$res = "<b>Win</b>";
	}
	elseif ( $hs==$as )
	{
		$res = "Draw" ;
	}
	else
	{	
		$res ="Loss";
	}
	return $res;
}


?>