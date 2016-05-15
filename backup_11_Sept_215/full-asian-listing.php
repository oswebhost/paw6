<?php
session_start();
include("config.ini.php");
include("function.ini.php");

if (!isset($_REQUEST['db'])){
	include("header.ini.php");
	include("select-option.ini.php");
	include("footer.ini.php");
	exit;
}


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

if (isset($_GET['season'])){
    $season = $_GET['season']; 
}else{
    $season = curseason($db);
}



if ($LOG=="N"): $lastweek = $lastweek - 1; endif;
if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;


if ($_GET['weekno']>0){
    $cur = $_GET['weekno'];
}else{
    $cur = cur_week($db);
}	

 $weekno = $cur;
 
 
 $pwk = $weekno-1;
 $nwk = $weekno+1;

  if ($LOG=="N") : $purl .= "&LOG=N"; endif;
 $purl .= "&WEEKNO=";

if (!isset($weekno)) $weekno = $lastweek ;
    
$errlog = "";

//if (check_season()=='1'){ header('Location: commences.php'); exit; }
if (isset($_SESSION['userid']) ):
  if ($_SESSION['expire'] < cur_week($db) ):
    if ( $weekno == cur_week($db) ) :
      $weekno=$lastweek-1;
      $errlog = limited_asscess_message($db);
    endif;
  endif;
elseif (!isset($_SESSION['userid']) and ($weekno==cur_week($db))) :
    //header("location: authorization.php");
    $errlog = limited_asscess_message($db);
    $weekno=$lastweek-1;
endif;



 $qry = "SELECT * FROM fixtures WHERE `weekno`='$weekno' and season='$season' limit 1"; 
 if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
  }else{
   $temp = $sa->prepare($qry);
  }
 $temp->execute();
 $row  = $temp->fetch();
 $wdate= $row["wdate"];
  
  

if (isset($_GET["weekno"])):
	$page_title = "Asian Handicap Odds " . site($db) . " " . curseason($db)  . " Week $weekno " ;
else:
	$page_title = "Asian Handicap Odds " . site($db) . " " . curseason($db) ;
endif;

include("header.ini.php");

page_header("Current Week's Odds") ;


include("overround-class.php");
include("asianhandycap-class.php");


if (isset($_GET['db'])){ 
    if (strlen($errlog)>0)		echo "<div class='errordiv'>$errlog</div>";
 }       


?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>

<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>


<div class='clear'></div>



<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Asian Handicap Odds All Divisions Combined</div>



<div style="padding-bottom:2px"></div>
  <!-- startprint -->
<? if (isset($weekno) ): 

week_box_nocap($weekno, $wdate,$season,570);


?>
<div style="padding-bottom:2px"></div>
<table  width="100%" border='0'>
<tr>
  <td width='10%'> <a class='sbar' href="bookies-odds-soccer-betting.php?db=<?echo $db;?>"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
    <td width='10%'align="right"> <? echo printscr(); ?></td>
  </tr>
</table>
<div style="padding-bottom:2px"></div>



<table border="0" cellpadding="4" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="560">



		<form method="get" action="<? echo $PHP_SELF ?>">
			<input type="hidden" name="db" value="<?php echo $_GET['db'];?>">
		<tr>
		  <td style='text-align:left;padding:10px 0 10px 0;'><b><font size="2" color="#0000FF">Week No:</font></b>
		  	<select style="width:80px" name="weekno" class="text">
		   <? 
				 $br=0;
				 
				 for ($other=cur_week($db); $other>=1; $other--) :
					$br++;
					echo "<option value='$other'" ;
						if ($other==$weekno): echo " selected"; endif;
					echo ">$other</option>\n\n";
				 endfor;
				 echo "</select>";	

		   ?>
      <td style='text-align:left;padding:10px 0 10px 0;'><b><font size="2" color="#0000FF">Bookie's Perception:</font></b>
        <select style="width:130px;" name="callfor" class="text">
            <option value="1" <? if ($_GET['callfor']==1) echo 'selected';?>>Home Strong</option>
            <option value="2" <? if ($_GET['callfor']==2) echo 'selected';?>>Away Strong </option>
            <option value="3" <? if ($_GET['callfor']==3) echo 'selected';?>>Equal Strength</option>

            <option value="4" <? if ($_GET['callfor']==4) echo 'selected';?>>Home Strong / Home Win</option>
            <option value="5" <? if ($_GET['callfor']==5) echo 'selected';?>>Home Strong / Away Win</option>

            <option value="6" <? if ($_GET['callfor']==6) echo 'selected';?>>Away Strong / Away Win</option>
            <option value="7" <? if ($_GET['callfor']==7) echo 'selected';?>>Away Strong / Home Win</option>

            <option value="8" <? if ($_GET['callfor']==8) echo 'selected';?>>Equal Strength / Home Win</option>
            <option value="9" <? if ($_GET['callfor']==9) echo 'selected';?>>Equal Strength / Away Win</option>

        </select>
    </td>
    
    <td style='text-align:left;padding:10px 0 10px 0;width:170px;'><b><font size="2" color="#0000FF">Filter:</font></b>
        <select style="width:155px;" name="filteron" class="text">
            <option value="1" <? if ($_GET['filteron']==1) echo 'selected';?>>All Matches</option>
            <option value="2" <? if ($_GET['filteron']==2) echo 'selected';?>>Full/Half No. Handicap</option>
            <option value="3" <? if ($_GET['filteron']==3) echo 'selected';?>>Quarter Handicap</option>
        </select>
    </td>

		<td style='padding:10px 0 10px 0;'><b><font size="2" color="#0000FF">For:</font></b>
		  	<select size="1" name="formatch" class="text" style="width:150px;">
          <option value="1" <? if ($_GET['formatch']==1) echo 'selected';?>>Full Week (Mon - Sun)</option>
          <option value="2" <? if ($_GET['formatch']==2) echo 'selected';?>>Weekend (Sat - Sun)</option>
          <option value="3" <? if ($_GET['formatch']==3) echo 'selected';?>>Midweek (Mon - Fri)</option>
          <?php echo fixture_date($season, $weekno, $db, $_GET['formatch'], $divs) ;?>
		  </select>
		</td>
		</tr>	
        
      	  <tr>
              <td class='rtd'><b><font size="2" color="#0000FF">Division</font></b></td>
              <td colspan='2' >
               <select size="1" name="DIV" class="text" style="width:220px; padding:3px;">

                    <? if ($db=='eu'){ ?>
            		    
                     
                        <option value="0" <?echo selected($_GET['DIV'],'0')?>>UK/European Premier Divisions</option> 
                        <option value="1" <?echo selected($_GET['DIV'],'1')?>>UK/European Major Divisions</option> 
                        <option value="2" <?echo selected($_GET['DIV'],'2')?>>UK Minor Divisions</option> 
                        
                        <optgroup label="One Division Only">
                  			<? for ($_i=0; $_i<count($arry_div); $_i++){ ?>
                  			  <? if ($_i<>4 and $_i<>9 and $_i<>18){ ?>
                  					<option value="<? echo $arry_div[$_i];?>" <? echo selected($_GET['DIV'], $arry_div[$_i]);?>><? echo divname($arry_div[$_i]); ?></option>
                  			   <? } ?>
                  			<? } ?>
                    
                     <?}?>
                     </optgroup>  
                    <? if ($db=='sa'){ ?>
                  		    <option value="0" <?echo selected($_GET['DIV'],'0')?>>All Divisions</option> 
                  			<? for ($_i=0; $_i<count($arry_div_sa); $_i++){ ?>
                  				<option value="<? echo $arry_div_sa[$_i];?>" <? echo selected($_GET['DIV'], $arry_div_sa[$_i]);?>><? echo divname($arry_div_sa[$_i]); ?></option>
                  			<? } ?>
                     <?}?>
        
        			</select>
              
              </td>
              
		      <td class='ctd padd'>
		      <input type="submit" value="View Data" name="B1" class="bt" style="padding:px;"/>

		   </td>
		</tr>
        </form>
</table>


	<div style="padding-bottom:8px"></div>	

<div class='blue_message'>
<b>Note:</b> the Bookie's perception of the outcome of the handicapped result may be the opposite of what is expected for the unhandicapped result!  The team given the additional goals advantage is what the Bookie believes is the weaker team. The lower of the Home/Away Odds determines what the Bookie thinks will be the handicapped result. 
</div>









             


<?php 
  if ($weekno==cur_week($db)){ 
    over_round_msg();
}

?>


<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="570" cellpadding='3' bgcolor="#f6f6f6">
<tr bgcolor="#d3ebab">

  <td width="5%" class='ctd'><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>

  <? if ( ($DIV=='FA') or ($DIV=='SA') or ($DIV=='IN')) : ?>
	   <td width="80" class='ctd'><img src="images/tbcap/date.gif" border="0" alt=""/>
  <? else: ?>
		 <td width="10%" class='ctd'><img src="images/tbcap/datepic.gif" border="0" alt=""/>
  <? endif; ?>
  </td>
  <td width="38%" class='ctd'><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
  <td class='ctd' ><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
  
  <td width="6%" class='ctd'><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>


  <td width="6%"  class='ctd' style='padding:0'><img src="images/tbcap/aslgd.gif" border='0' alt=''/></td>

  <td width="8%" class='ctd'><img src="images/tbcap/h-cap.gif"  border='0' alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/ahchtwin.gif"  border='0' alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/ahcatwin.gif"  border='0' alt=""/></td>
  
<?if ($weekno < cur_week($db)){ ?>
  
	<td width="8%" class='ctd'><img src="images/tbcap/act.gif"  border="0" alt=""/></td></td>
  <td width="6%" class='ctd'><img src="images/tbcap/bfo.gif"  border="0" alt=""/></td>

<?}else{ ?>
  
  <td width="8%" class='ctd'><img src="images/tbcap/overround.gif"  border="0" alt=""/></td></td>

<?}?>
</tr>

<? 
 if (!isset($_GET["B1"])){
      
        $_GET['formatch'] = '1';
        $_GET['DIV'] = '0';
     }

	if ($db=="eu"){
		
		switch ($_GET['DIV']){
		    case '0': $_divs = " and f.`div` IN ('EP','SP','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
		    case '1': $_divs = " and f.`div` IN ('EP','C0','C1','C2','SP','S1','S2','S3','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
		    case '2': $_divs = " and f.`div` IN ('NC', 'UP', 'RP', 'MP') "; break;
		    default:  $_divs = " and f.`div` = '" . $_GET['DIV'] . "' "; break;
		 }
	
	}else{
		switch ($_GET['DIV']){
			case '0': $_divs = " and f.`div` IN ('BRA','BRB','MLS') "; break;
		    default:  $_divs = " and f.`div` = '" . $_GET['DIV'] . "' "; break;
		}
	}

     
	switch ($_GET['formatch'])
	{
	    case 1: $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
	    case 2: $period = " and weekday(match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
	    case 3: $period = " and weekday(match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;
        
        case '0_d': $period = " and weekday(match_date)=0"; $_prerid="Monday"; break;
        case '1_d': $period = " and weekday(match_date)=1"; $_prerid="Tuesday"; break;
        case '2_d': $period = " and weekday(match_date)=2"; $_prerid="Wednesday"; break;
        case '3_d': $period = " and weekday(match_date)=3"; $_prerid="Thursday"; break;
        case '4_d': $period = " and weekday(match_date)=4"; $_prerid="Friday"; break;
        case '5_d': $period = " and weekday(match_date)=5"; $_prerid="Saturday"; break;
        case '6_d': $period = " and weekday(match_date)=0"; $_prerid="Sunday"; break;
	}


  

$callfor = 1;
if (isset($_GET['callfor'])){
  $callfor = $_GET['callfor'];
}

$filteron = "";
switch ($_GET['filteron'])
  {
      case 1: $filteron = " ";  break;
      case 2: $filteron = " and (o.ht_hcap in (0.50, 1.00, 1.50, 2.00, 2.50, 3.00) or o.at_hcap in (0.50, 1.00, 1.50, 2.00, 2.50, 3.00)) "; break;
      case 3: $filteron = " and (o.ht_hcap in (0.25, 0.75, 1.25, 1.75, 2.25, 2.75) or o.at_hcap in (0.25, 0.75, 1.25, 1.75, 2.25, 2.75)) "; break;
  }


if ($callfor=="1"){
	$query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
	 f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
		f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.at_hcap>0 and
			f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
				f.season=o.season and f.mid = o.matchno $_divs  $filteron $period ORDER BY o.ht_odd,o.at_odd desc, f.hteam,f.ateam";

}elseif ($callfor=="2"){

  $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap>0 and
      f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.at_odd, o.ht_odd";

}elseif($callfor=="3"){

  $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap=o.at_hcap and
      f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.ht_odd,o.at_odd";


}elseif($callfor=="4"){ // home strong / win win

$query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.at_hcap>0 and
     o.ht_odd<o.at_odd and f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.ht_odd,o.at_odd desc, f.hteam,f.ateam";

}elseif($callfor=="5"){ // home strong / away win
  $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.at_hcap>0 and
     o.at_odd<o.ht_odd and f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.ht_odd,o.at_odd desc, f.hteam,f.ateam";
  
}elseif($callfor=="6"){ // away strong / away win
  $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap>0 and
      o.at_odd<o.ht_odd and f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.at_odd, o.ht_odd";
  
}elseif($callfor=="7"){ // away strong / win win
  $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap>0 and
      o.ht_odd<o.at_odd and f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.at_odd, o.ht_odd";

}elseif($callfor=="8"){ // Equal strong / home win	
 $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap=o.at_hcap and
     o.ht_odd<o.at_odd and f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.ht_odd,o.at_odd";

}elseif($callfor=="9"){ // Equal strong / away win 
 $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap=o.at_hcap and
     o.at_odd<o.ht_odd and f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.ht_odd,o.at_odd";

}



	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}

    $temp->execute();

    $number = 0; $hcalls=0; $hright=0; $acalls=0; $aright=0;
   if ($temp->rowCount()>0){ 
    
    while ($row = $temp->fetch()) {

    	$number++;
	    $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;
        
        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&site=$db')\">";
        $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?site='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
        
        $title = "$row[hteam] v $row[ateam] match odds" ;
        $odd=0;
    // find over-round [overround-class.php]
        $or = new overround();
        $or->find_or($row['h_odd'], $row['d_odd'], $row['a_odd'], $row['hwinpb'],$row['drawpb'],$row['awinpb']);
        $asl_class ="";
  
       $ahb = new asianhandycap();
       $ahb->asian_rt($row['ht_hcap'],$row['at_hcap'], $row['h_s'], $row['a_s'] , $row['ht_odd'] ,$row['at_odd']);

       if ($row['ht_odd']<$row['at_odd']){
           $hcalls+= $ahb->unit;
           $hright+= $ahb->correct;

       }elseif ($row['at_odd']<$row['ht_odd']){
           $acalls+= $ahb->unit;
           $aright+= $ahb->correct;
       }

 		   $sbar = "sbar";

        if ($row['gotit']=='1' and $row['h_s']<>'P'){
            $asl_class = " gotrt";
        }elseif ($row['gotit']=='0' and $row['h_s']<>'P'){
        	$asl_class = " wrong";
        	$sbar= "sWrg";
        }

        if (strlen($act)<2){

        	$asl_class='';
        	$sbar = 'sWrg';
        }
        
        if ($asl==$act){
            $asl_class = " gotrt";
        }
        
        if ($row['h_s']=='P'){
            $asl_class = " pp";
            $sbar= "sWrg";
        }
        
        $pr = "";
        
       if ($weekno<>cur_week($db)){
          $pr = "";
        }
        
        $overround=0;
		    $overround = ( (1/$row["ht_odd"]) + (1/$row["at_odd"] - 1)) * 100  ;
           //over founds
        $hor = ($or->home_value==1? " h_Or" : "");
        $aor = ($or->away_value==1? " a_Or" : "");

?>

	<tr <?php echo rowcol($number);?>>
		<td class="ctd padd"><?echo $number; ?></td>
	    <td class="ctd "><a class='md2' <?echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?echo $matchno;?>&site=<?echo $db;?>'><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

	    <td class='padd ltd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['hteam']?>&site=<?echo $db;?>">
	        <?echo $row['hteam'] .'</a>' . printv(' v '); ?>
	        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['ateam']?>&site=<?echo $db;?>">
	            <?echo $row['ateam'];?></a>
	    </td>
		
		<td class='ctd'><?php echo $row['div'];?></td>
     <td class="ctd"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
 


    <?php if ($_GET['callfor']==2){?>
      <td class="ctd"><?echo num0($row['agoal'] - $row['hgoal']); ?></td>
    <?}else{?>  
      <td class="ctd"><?echo num0($row['hgoal'] - $row['agoal']); ?></td>
    <?}?>

		<td class='ctd'><?php echo ($row['ht_hcap']>0? $row['ht_hcap']: "0")."/" .($row['at_hcap']>0? $row['at_hcap']: 0) ;?></td>
		
    <? if($row['ht_odd']<$row['at_odd']){?>
      <td class='ctd bold'><?php echo show_odd($row['ht_odd']);?></td>
    <?}else{?>
      <td class='ctd'><?php echo show_odd($row['ht_odd']);?></td>
    <?}?>  
		

    <? if($row['at_odd']<$row['ht_odd']){?>
      <td class='ctd bold'><?php echo show_odd($row['at_odd']);?></td>
    <?}else{?>
      <td class='ctd'><?php echo show_odd($row['at_odd']);?></td>
    <?}?>  

    
		
		
    	

       <? if ($weekno==cur_week($db)){?>
       <td class='ctd'><a title='Over Round Details' class='sbar' href="javascript:OrWin('overround.php?db=<?php echo $db;?>&id=<?php echo $matchno;?>')"><?php echo num20($overround);?>%</a></td>
       <?}?>

        <? if ($weekno<>cur_week($db)){?>

          <td class="ctd"><a class='md' href="javascript:tell('full_odds.php?id=<?echo $matchno;?>&db=<?echo $db;?>')">
            <? if (strlen($act)<2){
              echo "Odds";
            }else{
              echo $row['h_s'] . dash() . $row['a_s']; 
            } 
            ?>
            </a></td>

          <?php if (strstr($ahb->vchar, "W")){ ?>
            <td class="ctd gotrt"><?echo $ahb->vchar; ?></td>
          <?}else{?>
            <td class="ctd"><?echo $ahb->vchar; ?></td>
          <?}?>

        
        <?}?>  

   

   

    	
		
	</tr>

<?}?>

<? if ($weekno<>cur_week($db)){?>
  <tr bgcolor='#f4f4f4'>
      <td colspan='2' class='rtd padd bot'>BOOKIES:&nbsp;</td>
      <td colspan='1' class='rtd padd bot'>Home Win Call Success&nbsp;</td>
      <td colspan='2' class='ctd padd bot'>
        <?php 
            if ($hcalls>0){
              echo num2(($hright/$hcalls)*100) ."%";
            }else{
              echo "N/A";
            }


        ?>
        </td>

      <td colspan='4' class='ctd padd bot'>Away Win Call Success&nbsp;</td>
      <td colspan='2' class='ctd padd bot'>
        <?php 
            if ($acalls>0){
              echo num2(($aright/$acalls)*100) . "%";
            }else{
              echo "N/A";
            }
        ?>
        </td>
  </tr>

<?}?>


<?}else{ ?>

    <tr>
        <td colspan="11" class="credit ctd padd" style="color:red;padding:10px;">No Match for selected options</td>
    </tr>

<?}?>


</table>


<!-- stopprint -->

			   
			   
			   


<? if ($weekno == cur_week($db)) {?>

<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:22px;">
	<?= $fff ?>
</td>

<td style="font-weight:normal;text-align:left;padding-top:8px;padding-left:20px;font-size:11px;vertical-align:top;">
   <B>ASL = </B>Our Anticipated Score-Line <br/>

   <B>GD = </B>Goal Difference <br/>
   
	<? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
   
</tr>
</table>

<?}else{ ?>

<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td  style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
  <?= $fff ?>
</td>

<td style="width:255px;font-weight:normal;text-align:left;padding-top:8px;padding-left:20px;font-size:11px;vertical-align:top;">
   <B>ASL = </B>Our Anticipated Score-Line <br/>
   <B>GD = </B>Goal Difference <br/>
    <?php if ($weekno<>cur_week($db)){ ?>
     <b>BFO = </b>Bookie's Final Outcome 
    
    <?}?>
  
  <? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

  </font>
</td>
 
   <td style='width=120px'>&nbsp;</td>
</tr>
</table>

<?}?>

<br>


<? endif;?>


<div style="padding-bottom:5px">&nbsp;</div>
		
<? //include("pred-disclaimer.ini.php");  ?>
<? include("footer.ini.php"); ?>


<?	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>
