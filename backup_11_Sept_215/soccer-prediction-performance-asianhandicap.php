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

page_header("Prediction Performance Records") ;


include("overround-class.php");
include("asianhandycap-class.php");



?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>

<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>


<div class='clear'></div>



<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Asian Handicap Odds All Divisions Combined</div>


<table  width="100%" border='0'>
<tr>
  <td width='10%'><?php echo back();?></td>
    <td width='10%'align="right"> <? echo printscr(); ?></td>
  </tr>
</table>

<div style="padding-bottom:2px"></div>

  <!-- startprint -->

<table border="0" cellpadding="4" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="560">



		<form method="get" action="<? echo $PHP_SELF ?>">
			<input type="hidden" name="db" value="<?php echo $_GET['db'];?>">
		<tr>
		  <td style='text-align:left;padding:10px 0 10px 0;'><b><font size="2" color="#0000FF">Season:</font></b>
			<select size="1" name="season" class="text" style="font-size:12px;width:100px;font-weight:bold;"  >
			  <?php 
			  
				$sqry = "SELECT distinct(season) as season from fixtures order by season desc";
		        if ($db=='eu'){
		           $temp = $eu->prepare($sqry) ;
		        }else{
		           $temp = $sa->prepare($sqry);
		        }
		        $temp->execute();
				 while ($sr =$temp->fetch()) : 
			  ?>
			      <option value="<?= $sr["season"] ?>" <?echo selected($season,$sr["season"])?>><?= $sr["season"] ?></option>
			  
			  <?php endwhile; ?>
			  </select>

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
    
    <td style='text-align:left;padding:10px 0 10px 0;width:160px;'><b><font size="2" color="#0000FF">Filter:</font></b>
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


<div style="padding-bottom:2px;padding-top:5px;font-size:11px;padding-left:10px;">
	 * Total below = No. of valid bets remaining after "No Bets" and "Postponed" matches are taken into account.
</div>	

<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:2px auto 10px auto;" bordercolor="#CDCDCD" width="560">

<tr  bgcolor="#D3EBAB">
	<td width='80' class='ctd padd bot'>Week<br/>No</td>    
	<td width='120' class='ctd padd bot'>Total*<br/>Home Win<br/>Calls</td>    
	<td width='120' class='ctd padd bot'>Correct<br/>Home Win<br/>Calls</td>    
	<td width='120' class='ctd padd bot'>Correct<br/>Home Win<br/>%</td>
	<td width='120' class='ctd padd bot'>Total*<br/>Away Win<br/>Calls</td>    
	<td width='120' class='ctd padd bot'>Correct<br/>Away Win<br/>Calls</td>    		
	<td width='120' class='ctd padd bot'>Correct<br/>Away Win<br/>%</td>    				
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

	
	$mx_week = find_last_week_of_season($season,$db);
	
	// don't display current week 
	if($season == curseason($db)){
		$mx_week --;
	}
	
	$total_matches=0; $total_calls=0; $total_postponed=0; $total_correct=0;$total_cs=0;
	$total_wrong=0; $total_valid=0;
    
    $t_number = 0; $t_hcalls=0; $t_hright=0; $t_acalls=0; $t_aright=0;
	
	for ($week_loop=1; $week_loop<=$mx_week; $week_loop++){
		
			if ($callfor=="1"){
				$query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
				 f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
					f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.at_hcap>0 and
						f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
							f.season=o.season and f.mid = o.matchno $_divs  $filteron $period ORDER BY o.ht_odd,o.at_odd desc, f.hteam,f.ateam";
			
			}elseif ($callfor=="2"){
			
			  $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
			   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
			    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap>0 and
			      f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
			        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.at_odd, o.ht_odd";
			
			}elseif($callfor=="3"){
			
			  $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
			   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
			    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap=o.at_hcap and
			      f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
			        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.ht_odd,o.at_odd";
			
			
			}elseif($callfor=="4"){ // home strong / win win
			
			$query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
			   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
			    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.at_hcap>0 and
			     o.ht_odd<o.at_odd and f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
			        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.ht_odd,o.at_odd desc, f.hteam,f.ateam";
			
			}elseif($callfor=="5"){ // home strong / away win
			  $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
			   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
			    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.at_hcap>0 and
			     o.at_odd<o.ht_odd and f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
			        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.ht_odd,o.at_odd desc, f.hteam,f.ateam";
			  
			}elseif($callfor=="6"){ // away strong / away win
			  $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
			   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
			    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap>0 and
			      o.at_odd<o.ht_odd and f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
			        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.at_odd, o.ht_odd";
			  
			}elseif($callfor=="7"){ // away strong / win win
			  $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
			   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
			    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap>0 and
			      o.ht_odd<o.at_odd and f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
			        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.at_odd, o.ht_odd";
			
			}elseif($callfor=="8"){ // Equal strong / home win	
			 $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
			   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
			    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap=o.at_hcap and
			     o.ht_odd<o.at_odd and f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
			        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.ht_odd,o.at_odd";
			
			}elseif($callfor=="9"){ // Equal strong / away win 
			 $query1 = "SELECT f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
			   f.weekno, f.mid, o.ht_odd, o.at_odd,o.ht_hcap, o.at_hcap, f.`div`,
			    f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, ahcap_odds o WHERE o.ht_hcap=o.at_hcap and
			     o.at_odd<o.ht_odd and f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
			        f.season=o.season and f.mid = o.matchno $_divs $filteron $period ORDER BY o.ht_odd,o.at_odd";
			
			}



	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}

    $temp->execute();
	
	$match_check =  $temp->rowcount();
    
  
   
	if ($match_check>0){
		
		$mywin = "mywin";
		$window ='<a class="sbar" href="javascript:sele_win(\'weekly-asianhandicap-listing.php';
		$window .= "?" ;
		$week_url = $window .  $_SERVER['QUERY_STRING'] . "&weekno=$week_loop')\"><b>" ;
		$week_url .= num0($week_loop) . "</a></b>";
	
	}else{
			
		$week_url = $week_loop ;
				
	}
	  
   
    $hcalls=0; $hright=0; $acalls=0; $aright=0;
	
    while ($row = $temp->fetch()) {
			
		
    	
    	$number++;
	    
	    $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;
        
  
        $title = "View Weekly Match Listing" ;
        $odd=0;
  
       $ahb = new asianhandycap();
       $ahb->asian_rt($row['ht_hcap'],$row['at_hcap'], $row['h_s'], $row['a_s'] , $row['ht_odd'] ,$row['at_odd']);

       if ($row['ht_odd']<$row['at_odd']){
           $hcalls += $ahb->unit;
           $hright += $ahb->correct;

       }elseif ($row['at_odd']<$row['ht_odd']){
           $acalls += $ahb->unit;
           $aright += $ahb->correct;
       }


	}  //endof weekno loop
	
	$t_hcalls += $hcalls; 
	$t_hright += $hright; 
	$t_acalls += $acalls; 
	$t_aright += $aright;
	
	
		
		if($match_check>0){
?>
			<tr <?php echo rowcol($week_loop);?>>
				<td class='ctd'><?php echo $week_url ; ?></td>
				<td class='ctd'><?php echo num($hcalls,2); ?></td>
				<td class='ctd'><?php echo num($hright,2); ?></td>
				<td class='ctd bold'><?php echo num( $hright / ($hcalls>0? $hcalls : 1) *100 ,2); ?>%</td>
				<td class='ctd'><?php echo num($acalls,2); ?></td>
				<td class='ctd'><?php echo num($aright,2); ?></td>
				<td class='ctd bold'><?php echo num( $aright / ($acalls>0? $acalls : 1) *100 ,2); ?>%</td>
			</tr>
<?php
		}else{
			
			echo blank_line($week_loop,"-");
		}
				
	} // end for $week_loop
	
		for ($i=$week_loop; $i<45; $i++):
			echo blank_line($i,'');
		endfor;
	
?>

	<tr bgcolor="#f4f4f4">
		<td class='rtd padd bot'>TOTAL:</td>
		<td class='ctd padd bot'><?php echo num($t_hcalls,2); ?></td>
		<td class='ctd padd bot'><?php echo num($t_hright,2); ?></td>
		<td class='ctd padd bot'><?php echo num( $t_hright / ($t_hcalls>0? $t_hcalls : 1) *100 ,2); ?>%</td>
		<td class='ctd padd bot'><?php echo num($t_acalls,2); ?></td>
		<td class='ctd padd bot'><?php echo num($t_aright,2); ?></td>
		<td class='ctd padd bot'><?php echo num( $t_aright / ($t_acalls>0? $t_acalls : 1) *100 ,2); ?>%</td>
	</tr>
	
</table>

<!-- stopprint -->

			   
			   
			   







<div style="padding-bottom:5px">&nbsp;</div>
		
<? //include("pred-disclaimer.ini.php");  ?>
<? include("footer.ini.php"); ?>


<?	

function blank_line($start_week,$ch)
{
    $rowcol = rowcol($start_week);
	$data .= "<tr $rowcol >\n";
	$data .= "<td align='center' >\n$start_week</td>\n"; 
	$data .= "<td align='cente'>$ch\n</td>\n"; 
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	
	$data .= "<td align='center'  id='t1'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	
	$data .= "</tr>\n";

	return $data;
}
?>
