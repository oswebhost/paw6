<?php

//include("config.ini.php");

// pic details //
// $main_blogid = 1000;

$pic_id  = 8125;
$pic_db  = "eu";
$pictitle= "22-Apr-2016<br/>Nice v Reims<br/>2-0 (odds 9.00)";
$pic_alt = "22-Apr-2016 Nice v Reims 2-0";
$pic_url = "team-performance-chart.php?id=$pic_id&amp;site=$pic_db";

$arry_div_tables = array('EP','C0','C1','C2','SP','S1','S2','S3','FL','GB','G0','HK','IS','P0','SL','T0','NC','UP','MP','RP');

$arry_div = array('EP','C0','C1','C2','FA','SP','S1','S2','S3','SA','FL','G0','GB','HK','IS','P0','SL','T0','IN','NC','UP','MP','RP');
$arry_div_sa = array('BRA','BRB','MLS');

$major_divs = array('EP','SP','FL','G0','GB','HK','IS','P0','SL','T0');

$h2 ="onMouseover=\"ddrivetip('Available only to \'subscribing\' or \'free access\' members. ', 150)\"  onMouseout=\"hideddrivetip()\"" ;


function calculate_expiration_date($code){
	$expire_date = "";

	switch ($code){
		case '0': $expire_date = date('Y-m-d H:m:s', mktime(0, 0, 0, 5, 31, 2017)) ;  break; // '2017-05-31'
		case '1': $expire_date = date('Y-m-d H:m:s', mktime(0, 0, 0, 1, 31, 2017)) ;  break; // '2017-01-31' 	
		case '2': $expire_date = date('Y-m-d H:m:s', mktime(0, 0, 0, 2, 28, 2017)) ;  break; // 28 Feb
		case '3': $expire_date = date('Y-m-d H:m:s', mktime(0, 0, 0, 3, 31, 2017)) ;  break; // 31 Mar
		case '4': $expire_date = date('Y-m-d H:m:s', mktime(0, 0, 0, 4, 30, 2017)) ;  break; // 30 Apr
		case '5': $expire_date = date('Y-m-d H:m:s', mktime(0, 0, 0, 5, 31, 2017)) ;  break; // 31 May 
		case '6': $expire_date = date('Y-m-d H:m:s', mktime(0, 0, 0, 6, 30, 2017)) ;  break; //	30 Jun
		case '7': $expire_date = date('Y-m-d H:m:s', mktime(0, 0, 0, 7, 30, 2017)) ;  break; // 30 Jul
		case '8': $expire_date = date('Y-m-d H:m:s', mktime(0, 0, 0, 8, 31, 2017)) ;  break; // 31 Aug
		case  '9': $expire_date = date('Y-m-d H:m:s', time()+3600*24*90*4) ;  break;	// 12 months
		case '10': $expire_date = date('Y-m-d H:m:s', time()+3600*24*90*3) ;  break;	// 9 months
		case '11': $expire_date = date('Y-m-d H:m:s', time()+3600*24*90*2) ;  break;	// 6 months
		case '12': $expire_date = date('Y-m-d H:m:s', time()+3600*24*90)   ;  break;	// 3 months
		case '13': $expire_date = date('Y-m-d H:m:s', time()+3600*24*30)   ;  break;	// 1 months
		
	}
	return  $expire_date ;
}

function paw_service_block($code){
	$service_txt = "";
	switch ($code){
		case '0': $service_txt = "12 Months (up to 31-May-17)"; break;
		case '1': $service_txt = "12 Months (up to 31-Jan-17)"; break;
		
		case '2': $service_txt = "12 Months (up to 28-Feb-17)"; break;
		case '3': $service_txt = "12 Months (up to 31-Mar-17)"; break;
		case '4': $service_txt = "12 Months (up to 30-Apr-17)"; break;
		case '5': $service_txt = "12 Months (up to 31-May-17)"; break;
		case '6': $service_txt = "12 Months (up to 30-Jun-17)"; break;
		case '7': $service_txt = "12 Months (up to 30-Jul-17)"; break;
		case '8': $service_txt = "12 Months (up to 31-Aug-17)"; break;
		
		case '9': $service_txt = "12 Months"; break;
		case '10': $service_txt = "9 Months"; break;
		case '11': $service_txt = "6 Months"; break;
		case '12': $service_txt = "3 Months"; break;
		case '13': $service_txt = "1 Months"; break;
		
		
		
	}
	return $service_txt ;
}

function skrill_pay_status($code){
	$paystatus = "";
	switch ($code){
		case '2' : $paystatus = "Processed"; break;
		case '0' : $paystatus = "Pending"; break;
		case '-1': $paystatus = "Cancelled"; break;
		case '-2': $paystatus = "Failed"; break;
		case '-3': $paystatus = "Chargeback"; break;
	}
	return $paystatus;
}

//If you want to see the past records for earlier Seasons, please check the \"Prediction Performance Records\" under the GENERAL DATA menu below.

//2509
function limited_asscess_message($db){
  global $java_ ;
  
  return "<font style='font-size:14px;'>This is Week No. <b>". cur_week($db)  ."</b> - you will only be able to see the current week's data if you are <a class='sales' href='loginfree.php'><b>logged in</b></a> <span class='bb'>as a Subscribing Member</span>. </font>";  
} 



$fff = "Click here to view charts,  <br>tables and supporting<br>data";

$ffh = "id=\"testC3\" onmouseover=\"javascript:Tips.add(this, event, 'Click here to view charts, tables and supporting data', {style: 'rounded', stem: true, tipJoint: [ 'right', 'middle' ] });\"";

//$ffh = "title='click here to view'";

if ($java_=='1') :
	echo '<script src="iframe.js"></script>' ;
endif;



function getEUdivs($season, $weekno){
   global $eu;

    $temp = $eu->prepare("select distinct(`div`) as divs from fixtures where season='$season' and weekno='$weekno' and   `div` IN ('EP','SP','FL','IS','SL','GB','HK','P0','G0','T0')");
    $temp->execute();
    return $temp->rowCount();
    
} 

function getSAdivs($season, $weekno){
    global $sa;
    
    $temp = $sa->prepare("select distinct(`div`) as divs from fixtures where season='$season' and weekno='$weekno'  and   `div` IN ('MLS','BRA','BRB')");
    $temp->execute();
    
    return $temp->rowCount();
}
  

function getSAweek($wkdate){
  global $sa;
 
  
  $tmp = $sa->prepare("select season,weekno,wksdate from week_dates where wksdate='$wkdate'");
  $tmp->execute();
  $ddd = $tmp->fetch();
   
  $saDates = new stdClass();
  
  if ($tmp->rowCount()==0){
    $saDates->season = 0;
    $saDates->week = 0;                                    
  }else{
    $saDates->season = $ddd['season'];
    $saDates->week = $ddd['weekno'];                                    
  }

  return  $saDates ;
}


function getEUweek($wkdate){
  global $eu;
  
  $tmp = $eu->prepare("select season,weekno,wksdate from week_dates where wksdate='$wkdate'");
  $tmp->execute();
  $ddd = $tmp->fetch();
  
  $euDates = new stdClass();
  if ($tmp->rowCount()==0){
    $euDates->season = 0;
    $euDates->week = 0;                                    
  }else{
    $euDates->season = $ddd['season'];
    $euDates->week = $ddd['weekno'];                                    
  }

  return  $euDates ;
}


function over_round_msg(){ ?>

<div class='blue_message' >
Click on the link under "Match Over-Round" to see the details of the "Over-Round for Specific Call Type (1X2)" for any match you are interested in, as well as the  Predict-A-Win (PaW) Program's estimate of the Probabilities for each of the 3 possible match outcomes. 
</div>

<?php 
}


function team_to_div($team, $season, $db){
  global $eu, $sa;
  
  $sqry = "select distinct(`div`) as cdiv from tabs where season='$season' and team='$team'";

  if ($db=='eu'){
    $temp2 = $eu->prepare($sqry);
  }else{
    $temp2 = $sa->prepare($sqry);
  }
  
  $temp2->execute();
  $d2 = $temp2->fetch();
  return $d2['cdiv'];
}

function double_call($h_s, $a_s, $hpreds, $apreds){

  $dccall=0;

  $act_rt = Rt_type($h_s, $a_s);
  $prd_rt = Rt_type($hpreds, $apreds);

  if ($prd_rt<3 and ($act_rt==$prd_rt or $act_rt == 3)){
    $dccall = 1;
  }
  if ($prd_rt==3){
   $dccall = 0; 
  }
  if($h_s=='P'){
   $dccall = 0;    
  }
  return $dccall; 
}

function dc_char($h_s, $a_s, $hpreds, $apreds){

  $dcchar='N';

  $act_rt = Rt_type($h_s, $a_s);
  $prd_rt = Rt_type($hpreds, $apreds);
  
  if (($act_rt==$prd_rt) or ($act_rt == 3) ){
       $dcchar = "Y";
  }
  
  if ($prd_rt==3){
   $dcchar =  "N/A" ; 
  }
  
  if ($act_rt==3){
   $dcchar =  "Y" ; 
  }
  
  if($h_s=='P'){
   $dcchar = "N/A";    
  }

  return $dcchar ;

}

function Winonly_call($h_s, $a_s, $hpreds, $apreds){

  $wincall=0;

  $act_rt = Rt_type($h_s, $a_s);
  $prd_rt = Rt_type($hpreds, $apreds);

  if ($act_rt==$prd_rt){
    $wincall = 1;
  }

  if ($act_rt==3 or $prd_rt==3){
    $wincall = 0;
  }
  
  return $wincall; 
}

function Winonly_char($h_s, $a_s, $hpreds, $apreds){

  $winchar='N';
    
  $act_rt = Rt_type($h_s, $a_s);
  $prd_rt = Rt_type($hpreds, $apreds);

  if ($act_rt==$prd_rt){
    $winchar = "Y";
  }

  if ($act_rt==3 and $prd_rt<>3){
    //$winchar = "NB";
	$winchar = "N/A";
  }

  if ($prd_rt==3){
    $winchar = "N/A";
  }
  if ($h_s=="P"){
    $winchar = "P";
  }
  return $winchar; 

}


function Rt_type($hgoal, $agoal){
  $Rt = 0;
  
  if ($hgoal == "P"){
	$Rt = 0;
  }
  
  if ($hgoal>$agoal){
    $Rt = 1;
  }elseif ($agoal>$hgoal){
    $Rt = 2;
  }else{
    $Rt = 3;
  }
  

  
  return $Rt;
}


function return_gotit($hpreds, $apreds, $hgoal, $agoal, $callAs){
	
	$_gotit = 0 ;
	
	if ($callAs == 0){  // nomral call
		$predicted_rt = Rt_type($hpreds, $apreds);
	}else{ // 
		$predicted_rt = $callAs; // Reverse type call
	}
	
	$actual_rt    = Rt_type($hgoal, $agoal);
	
	if ($predicted_rt == $actual_rt){
		$_gotit = 1 ;
	}
	
	if ($hgoal == "P"){
		$_gotit = 0;
	}
	return $_gotit;
}


function pat_rev_call($hgoal, $agoal, $callAs){
	$_gotit = 0 ;
	$actual_rt  = Rt_type($hgoal, $agoal);
	
	switch ($callAs){
		
		case 20: 
			if ($actual_rt == 1 or $actual_rt == 3 ){
				$_gotit = 1 ;
			}
			break;
		
		case 21:
			if ($actual_rt == 1 or $actual_rt == 2 ){
				$_gotit = 1 ;
			}
			break;
		
		case 22:
			if ($actual_rt == 2 or $actual_rt == 3 ){
				$_gotit = 1 ;
			}
			break;
		
		case 25:
			if ($actual_rt == 2 ){ // Away Win only
				$_gotit = 1 ;
			}
			break;
		
		case 26:
			if ($actual_rt == 1 ){ // Home Win only
				$_gotit = 1 ;
			}
			break;
	}
	
	if ($hgoal == "P"){
		$_gotit = 0;
	}
	
	return $_gotit;
	
}
 


function fixture_date($season, $weekno, $db, $selected_value,$divs){
  global $eu, $sa;

  $sqry = " select distinct(c.match_date) as dlsit, date_format(c.match_date,'%d-%b-%Y &nbsp;&nbsp; %W')as dates, weekday(c.match_date) as wday 
  from fixtures c where c.season='$season' and weekno='$weekno' $divs order by dlsit";

  if ($db=='eu'){
    $temp2 = $eu->prepare($sqry);
  }else{
    $temp2 = $sa->prepare($sqry);
  }
  $temp2->execute();
  
  $addlist = "";

  while ($d2 = $temp2->fetch()){
   $c_day = $d2['wday']."_d";
   
   $addlist .= "<option " . selected($selected_value, $c_day) . " value='$c_day'>". $d2['dates'] . "</option>\n";
   
  }

  return $addlist;
}

function match_1x2_odds($season, $matchid, $db){
    global $eu, $sa;

    $sqry = "select h_odd, d_odd, a_odd from fixtures where season='$season' and mid='$matchid'";
    
    if ($db=='eu'){
       $temp2 = $eu->prepare($sqry);
    }else{
      $temp2 = $sa->prepare($sqry);
    }

    $temp2->execute();
    $d2 = $temp2->fetch();

    $modd = new stdClass();

    $modd->h_odd = $d2['h_odd'] ;
    $modd->a_odd = $d2['a_odd'] ;
    $modd->d_odd = $d2['d_odd'] ;

    return $modd;
}


function season()
{
	return '2005-2006' ;
}

function div2db($div){
    switch ($div){
        case 'BRA': 
        case 'BRB': 
        case 'MLS': $site='sa'; break;
        default:
        $site='eu'; break;
    }
    return $site;
}

function last_season_rank($TEAM,$SEASON,$db)
{  global $eu, $sa;

   $TEAM = ($TEAM=='Ebbsfleet U'? 'Gravesend' : $TEAM); 
   $sql="select `rank` from pr_teams where `season`='$SEASON' and `team`='$TEAM'";
   if ($db=='eu'){
        $temp = $eu->prepare($sql) ;
    }else{
        $temp = $sa->prepare($sql);
    }
    $temp->execute();
    $d = $temp->fetch() ;
  
  return $d["rank"] ;	
}

function site_other($db){
    if ($db=='eu'){
        return "Americas Divisions";
    }else{
        return "European Divisions";
    }
}

function db_other($db){
    if ($db=='eu'){
        return "sa";
    }else{
        return "eu";
    }
}


function site($db){
    if ($db=='eu'){
        return "European Divisions";
    }else{
        return "Americas Divisions";
    }
}
function s_title($db){
    if ($db=='eu'){
        return "European";
    }else{
        return "Americas";
    }
}

function euam($db){
    if ($db=='eu'){
        return "Europe";
    }else{
        return "Americas";
    }
}

// getting data for weekly EASE summary....
function callEASE($weekno,$season,$db)
{ global $eu, $sa;
 
    $sql="select * from ease_summary where season='$season' and weekno='$weekno'" ;
    if ($db=='eu'){
        $temp = $eu->prepare($sql) ;
    }else{
        $temp = $sa->prepare($sql);
    }
    $temp->execute();
    $dd = $temp->fetch() ;
    
    $weekdata = new stdClass();
    $weekdata->outright = $dd['1x2'] ;
    $weekdata->underover = $dd['under_over'] ;
    $weekdata->ahb = $dd['ahb'] ;
    $weekdata->cs = $dd['cspline'];
    $weekdata->net = $dd['net_winning'] ;
    
    $weekdata->x12_stake = $dd['x12_stake'] ;
    $weekdata->uo_stake = $dd['uo_stake'] ;
    $weekdata->ahb_stake = $dd['ahb_stake'] ;
    $weekdata->cs_stake = $dd['cs_stake'];
    return $weekdata;
}

function asl_pr_team($HTEAM,$ATEAM,$SEASON,$db)
{
	$pr= false;

	$season =  last_season_value($SEASON,$db) ;
	
	$hteam = last_season_rank($HTEAM,$season,$db) ;
	$ateam = last_season_rank($ATEAM,$season,$db) ;

	if ($hteam=='prom' or $hteam=='rel'): $pr = true; endif;
	if ($ateam=='prom' or $ateam=='rel'): $pr = true; endif;

	return $pr ;
}

function asl_pr_byteam($TEAM,$SEASON,$db)
{
	$pr= false;
	$season =  last_season_value($SEASON,$db) ;
	$_team = last_season_rank($TEAM,$season,$db) ;

	if ($_team=='prom' or $_team=='rel'): $pr = 1; endif;

	return $pr ;
}


function last_season_value($SEASON,$db)
{
  
  if ($db=='eu'){
      switch ($SEASON){
		    case "2015-2016": $season = "2014-2015"; break;
      	case "2014-2015": $season = "2013-2014"; break;
        case "2013-2014": $season = "2012-2013"; break;
        case "2012-2013": $season = "2011-2012"; break;
        case "2011-2012": $season = "2010-2011"; break;
    	  case "2010-2011": $season = "2009-2010"; break;
        case "2009-2010": $season = "2008-2009"; break;
        case "2008-2009": $season = "2007-2008"; break;
        case "2007-2008": $season = "2006-2007"; break;
        case "2006-2006": $season = "2005-2006"; break;
      }

   }else{
    
      switch ($SEASON){
		    case "2016": $season = "2015"; break;
		    case "2015": $season = "2014"; break;
        case "2014": $season = "2013"; break;
        case "2013": $season = "2012"; break;
        case "2012": $season = "2011"; break;
   	    case "2011": $season = "2010"; break;
        case "2010": $season = "2009"; break;
      }
   }
  
  return $season ;
}



function chk_season($db){
   global $eu, $sa; 
   
   $qry = "SELECT seasonended FROM setting";
   
    if ($db=='eu'){
        $temp = $eu->prepare($qry);
    }else{
        $temp = $sa->prepare($qry);
    }
    
   $temp->execute();
   $d = $temp->fetch() ;
 
   return (int) $d["seasonended"];
}


function cur_week($db){
   global $eu, $sa; 
   
   $qry = "SELECT weekno,seasonended FROM setting";
   
    if ($db=='eu'){
        $temp = $eu->prepare($qry);
    }else{
        $temp = $sa->prepare($qry);
    }
    
   $temp->execute();
   $d = $temp->fetch() ;
 
   return $d["weekno"];
  
}

function weekbegin($db){
   global $eu, $sa; 
   
   $qry = "SELECT week_begin,seasonended FROM setting";
   
    if ($db=='eu'){
        $temp = $eu->prepare($qry);
    }else{
        $temp = $sa->prepare($qry);
    }
    
   $temp->execute();
   $d = $temp->fetch() ;
   
   return trim($d["week_begin"]);
  
}

function max_tab_week($season,$db='eu')
{  

  global $eu, $sa;

	$qry2= "select max(weekno) as weekno from tabs where season='$season'";
 
  if ($db=='eu'){
      $temp2 = $eu->prepare($qry2);
  }else{
      $temp2 = $sa->prepare($qry2);
  }
 
 $temp2->execute();
 $d2 = $temp2->fetch() ;
 return (int) $d2["weekno"] ;

}

function curseason($db='eu'){   
   
   global $eu, $sa;
   $qry = "SELECT season FROM setting";
   
    if ($db=='eu'){
        $temp = $eu->prepare($qry);
    }else{
        $temp = $sa->prepare($qry);
    }
   
   $temp->execute();
   $d3 = $temp->fetch() ;
    
   return $d3["season"];
}

function find_week_dates($season, $weekno, $db){
  global $eu, $sa;

  $sql = "select wksdate,wkedate from week_dates where season='$season' and weekno='$weekno'";
  if($db=='eu'){
    $temp = $eu->prepare($sql);
  }else{
    $temp = $sa->prepare($sql);
  }

  $temp->execute();
  $d = $temp->fetch();
  if ($temp->rowCount()>0){
    return trim($d['wksdate']) . printv(" to ") . trim($d['wkedate']) ;
  }
}

function find_last_week_of_season($cur,$db){
    global $eu, $sa;
    
    $sql = "select max(weekno) as mx_week from fixtures where season='$cur'";
    
    if ($db=='eu'){
        $temp = $eu->prepare($sql);
        $xx = 0;
    }else{
        $temp = $sa->prepare($sql);
        $xx = 1;
    }
   
   $temp->execute();
   $d = $temp->fetch() ;
   return $d["mx_week"];
}

// getting data for weekly review ....
function segcall_count($weekno,$season,$db){
   global $eu, $sa;
   $sql= "select count(weekno) as cNo from quickpick where season='$season' and weekno='$weekno'" ;
 
   if ($db=='eu'){
      $temp = $eu->prepare($sql) ;
   }else{
      $temp = $sa->prepare($sql);
   }
   $temp->execute();
   $d = $temp->fetch();
   return (int) $d['cNo'];
}

function segcalls($weekno,$bet, $class, $season,$db)
{ global $eu, $sa;

 unset($wkdata);
 $laid = 0; $win = 0; $net_lost = "-"; $net_won = "-" ; $total_win = 0;
 
 $sql= "select * from quickpick where season='$season' and matchtype='$class' and bettype='$bet' and weekno='$weekno'" ;
 
 
 if ($db=='eu'){
    $temp = $eu->prepare($sql) ;
 }else{
    $temp = $sa->prepare($sql);
 }
 $temp->execute();
  
  
 while ($data = $temp->fetch() )
 {
    if ($data[gotit]>=0 and $data['h_s']<>'P')
    {
        $laid += 1;
        $win  += $data[gotit];
        if ($data[h_s]>$data[a_s] and $data[gotit]==1)
        {
          $total_win += $data[h_odds];
        }elseif ($data[h_s]<$data[a_s] and $data[gotit]==1)
        {
          $total_win += $data[a_odds];
        }elseif ($data[h_s]==$data[a_s] and $data[gotit]==1)
        {
          $total_win += $data[d_odds];
        }
    } 
 }
 
 if ($total_win > $laid) { $net_win = $total_win - $laid ; }
 if ($total_win < $laid) { $net_lost= $laid - $total_win ; }
 
 $wkdata = new stdClass();
 $wkdata->laid = $laid ;
 $wkdata->win  = $win ;
 $wkdata->net_lost = $net_lost ;
 $wkdata->net_win  = $net_win ;
 
 return $wkdata;
} 
 
 // getting data for bookie success level ....
function bookie_success_level($weekno,$season,$bet,$db)
{ global $eu, $sa;

 unset($wkdata);
 $laid = 0; $win = 0; $return = 0;
 
 if ($bet==1){
    
    $sql="select f.wdate,f.weekno,date_format(f.match_date ,'%d-%b-%Y') as m_date, f.`div`,f.hteam,f.ateam, f.h_s, f.a_s,f.h_odd,f.a_odd,f.d_odd, f.h_odd as odds, r.rank from fixtures f, ranking r where f.season='$season' and f.weekno='$weekno' and f.h_odd>0 and f.h_s<>'P' and f.`div`=r.matchtype and r.cat='bk'and f.h_odd <=1.50 order by odds asc  limit 0,6";
    
  
 }elseif($bet==2){
     $sql="select f.wdate, f.weekno, date_format(f.match_date ,'%d-%b-%Y') as m_date, f.`div`,f.hteam,f.ateam, f.h_s, f.a_s,f.a_s,f.h_odd,f.a_odd,f.d_odd, f.a_odd as odds, r.rank from fixtures f, ranking r where f.season='$season' and f.weekno='$weekno' and f.a_odd>0 and f.h_s<>'P' and f.`div`=r.matchtype and r.cat='bk' and f.a_odd <=1.50 order by odds asc  limit 0,6";
 
 }elseif($bet==3){
     $sql="select f.wdate, f.weekno, date_format(f.match_date ,'%d-%b-%Y') as m_date, f.`div`,f.hteam,ateam, f.h_s, f.a_s, f.a_s,f.h_odd,f.a_odd,f.d_odd, abs(f.h_odd-f.a_odd) as odds,r.rank from fixtures f, ranking r where f.season='$season' and f.weekno='$weekno' and f.h_odd>2.20 and f.a_odd>2.20 and f.h_s<>'P' and f.`div`=r.matchtype and r.cat='bk'  order by f.d_odd  limit 0,6";
 }

if ($db=='eu'){
   $temp = $eu->prepare($sql) ;
}else{
   $temp = $sa->prepare($sql);
}
$temp->execute();
 
  
 while ($data = $temp->fetch() )
 {
    $laid += 1;
    
    if ($bet==1 and $data['h_s']>$data['a_s']){
        $win += 1;
        $return += $data['odds'];
    
    }elseif($bet==2 and $data['a_s']>$data['h_s']){
        $win += 1;
        $return += $data['odds'];   
        
    }elseif($bet==3 and $data['a_s']==$data['h_s']){
        $win += 1;
        $return += $data['d_odd'];
    }
     
 }
 
 $wkdata = new stdClass();
 $wkdata->laid = $laid ;
 $wkdata->win  = $win ;
 $wkdata->gain = $return - $laid;
 return $wkdata;
}


function selected($sele_value,$box_value)
{
  if ($sele_value == $box_value) :
	  $txt = " selected ";
  else:
	$txt = " ";
  endif;
  return $txt;
}

function last_five_matches($team, $div,$HomeAway,$cur_Wk, $db){
    global $eu, $sa;
    
    $season = curseason($db);
    
    if ($HomeAway=="H"){
        $qry ="select match_date, hteam, ateam, `div`, h_s, a_s from fixtures where season='$season' and `div`='$div' and hteam=\"$team\" and weekno<='$cur_Wk' and h_s<>'P' order by match_date desc limit 5";
        
        $qry = "select q.* from ($qry) q order by q.match_date";

    }elseif ($HomeAway=="A"){
        $qry ="select match_date, hteam, ateam, `div`, h_s, a_s from fixtures where season='$season' and `div`='$div' and ateam=\"$team\" and weekno<='$cur_Wk' and h_s<>'P' order by match_date desc limit 5";
        $qry = "select q.* from ($qry) q order by q.match_date";

    }else{
        $qry ="select match_date, hteam, ateam, `div`, h_s, a_s from fixtures where season='$season' and `div`='$div' and (hteam=\"$team\" or ateam=\"$team\") and weekno<='$cur_Wk' and h_s<>'P' order by match_date desc limit 5";	
        $qry = "select q.* from ($qry) q order by q.match_date";

    }
    
	//echo $qry;
	
    if ($db=='eu'){
        $tempw = $eu->prepare($qry);
    }else{
        $tempw = $sa->prepare($qry);
    }
    $tempw->execute();
    
    
        
    $msg='';
    
    while ($_r = $tempw->fetch()){
        
        //home win        
        if ( ($_r['h_s'] > $_r['a_s']) and $_r['hteam']==$team){
            $msg .= '<img src="images/tb_w.gif" border="0" alt="Win" title="' .$_r['hteam'] .' v '. $_r['ateam'] . "  $_r[h_s]-$_r[a_s]"  . '" style="margin-right:0px;"/>';        
        }
        
        //home loss
        if ( ($_r['h_s'] < $_r['a_s']) and $_r['hteam']==$team){
            $msg .= '<img src="images/tb_l.gif" border="0" alt="Loss" title="' .$_r['hteam'] .' v '. $_r['ateam'] . "  $_r[h_s]-$_r[a_s]"  .'" style="margin-right:0px;"/>';        
        }

        //away win        
        if ( ($_r['h_s'] < $_r['a_s']) and $_r['ateam']==$team){
            $msg .= '<img src="images/tb_w.gif" border="0" alt="Win" title="' .$_r['hteam'] .' v '. $_r['ateam'] . "  $_r[h_s]-$_r[a_s]"  .'" style="margin-right:0px;"/>';        
        }

        //away loss
        if ( ($_r['h_s'] > $_r['a_s']) and $_r['ateam']==$team){
            $msg .= '<img src="images/tb_l.gif" border="0" alt="Loss" title="' .$_r['hteam'] .' v '. $_r['ateam'] . "  $_r[h_s]-$_r[a_s]"  .'" style="margin-right:0px;"/>';        
        }
        
        //draw
        if (($_r['h_s'] == $_r['a_s']) and $_r['hteam']==$team){
            $msg .= '<img src="images/tb_d.gif" border="0" alt="Draw" title="' .$_r['hteam'] .' v '. $_r['ateam'] . " $_r[h_s]-$_r[a_s]"  .'" style="margin-right:0px;"/>';        
        }
        if (($_r['h_s'] == $_r['a_s']) and $_r['ateam']==$team){
            $msg .= '<img src="images/tb_d.gif" border="0" alt="Draw" title="' .$_r['hteam'] .' v '. $_r['ateam'] . " $_r[h_s]-$_r[a_s]"  .'" style="margin-right:0px;"/>';        
        }
    }   

    return $msg ;
}
 function page_header($CAPTION,$w='100%')
{ 
  global $domain ;
echo '
    <!--END page header-->
    <table border="0" cellspacing="0" style="border-collapse: collapse" width="'.$w.'l" cellpadding="0">
      <tr>
    	  <td width="21" valign="top" height="26">
    	  <img border="0" src="'.$domain.'/images/tblefthead.gif" width="21" height="26" alt="soccer header intro"></td>
    	  <td  style="background:url('.$domain.'/images/tbheadbg1.gif) repeat-x;" height="26"><h1 class="tbhead" style="background:url('.$domain.'/images/ball-icon.png) no-repeat right center;">'.$CAPTION.'</h1></td>
    	  <td width="3"><img border="0" src="'.$domain.'/images/tbheadrg.gif" width="3" height="26" alt="results reports"></td>
      </tr>
    </table>
    <div style="padding-bottom:5px"></div>';
}

function error_box($msg)
{
echo '
<div class=\'hypeboxRed\' style="margin-top:8px;">
  <div class=\'div_topRed\'></div>
    <div class=\'div_midRed\' style="font-size:13px;text-align:centert;padding:0 8px 5px 8px;">'.
	$msg
	.'</div>
    <div class=\'div_bottomRed\'></div>
</div>';

}

function red_box($msg)
{
echo '
<div class=\'hypeboxRed\' style="margin-top:8px;">
  <div class=\'div_topRed\'></div>
    <div class=\'div_midRed\' style="font-size:13px;text-align:centert;padding:0 8px 5px 8px;">'.
	$msg
	.'</div>
    <div class=\'div_bottomRed\'></div>
</div>';

}

function blue_box($msg)
{
echo '
  <div class=\'hypeboxblue\' style="margin-top:8px;">
  <div class=\'div_topblue\'></div>
    <div class=\'div_midblue\' style="font-size:13px;text-align:centert;padding:0 8px 5px 8px;">'. 
	   $msg
	.'</div>
    <div class=\'div_bottomblue\'></div>
</div>';
}

function yearonly_box($caption, $season,$w='560')
{
echo '
<table border="1" width="'.$w.'" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#D3EBAB" bgcolor="#F6F6F6">
  <tr>
    <td style="padding:5px;text-align:center;text-transform:uppercase;color:#0066FF;font-weight:bold;font-family:verdana;"><font size="+1">'.$caption.'</font></td>
  </tr>
	<tr>
	  <td width="100%" style="font-size:12px;padding:2px;" class="ctd">Season: <b>'.$season.'</b> </td>
	</tr>
</table>';
}

//<!-- info box for Teams Page--->

function infoboxTeam($TEAM,$cur_week,$last_update,$cur_season,$w='560')
{
  echo '
  <table border="1" width="'.$w.'" cellpadding="2" cellspacing="0" style="border-collapse: collapse" bordercolor="#D3EBAB" bgcolor="#F6F6F6">
    <tr>
      <td colspan="3"  style="padding:5px;text-align:center;text-transform:uppercase;color:#0066FF;font-weight:bold;font-family:verdana;"><font size="+1">'. $TEAM .'</font></td>
    </tr>
    <tr>
      <td width="25%" style="font-size:14px;padding:2px"><b>Week No.' . $cur_week .'</b></td>
      <td width="50%" style="font-size:12px;padding:2px">Last Update: <b>'. $last_update .'</b> </td>
      <td width="25%" style="font-size:12px;padding:2px">Season: <b>' . $cur_season . '</b> </td>
    </tr>
  </table>';

}


function last_update($db){
   global $eu, $sa;

   $qry = "select lastupdate from setting";
   
   if ($db=='eu'){
    $tempw = $eu->prepare($qry);
   }else{
    $tempw = $sa->prepare($qry);
   }
   $tempw->execute();
   $d = $tempw->fetch();
   return $d['lastupdate'];
}


function check_season($db){
    global $eu, $sa;
    
    $qry = "SELECT * from setting"; 
    
    if ($db=='eu'){
       $temp = $eu->prepare($qry) ;
    }else{
       $temp = $sa->prepare($qry);
    }

    $temp->execute();
    $d = $temp->fetch() ;    
    return (int) $d["seasonended"];
}

function get_match_by_week_div($db, $div, $weekno, $season){
  global $eu, $sa;
  $qry = "select count(weekno) as cno from fixtures  where weekno='$weekno' and season='$season' and `div`='$div' ";
	if ($db=='eu'){
       $temp = $eu->prepare($qry) ;
    }else{
       $temp = $sa->prepare($qry);
    }
    $temp->execute();
    $d = $temp->fetch() ;   
    return $d["cno"];
}

function gg_count($BET,$RESULT,$FILE,$db='eu'){
    
   global $eu, $sa;
   
   
   $qry = "SELECT MAX(weekno) as lastweek,season FROM setting";
   
   if ($db=='eu'){
       $temp = $eu->prepare($qry) ;
    }else{
       $temp = $sa->prepare($qry);
    }
    $temp->execute();
    $d = $temp->fetch() ;   
    
    $lastweek = $d["lastweek"] ;
    $sea =  $d['season'];
   
   $link_string ='n/a' ;
   
   switch ($FILE): 

	case "FIXTURE": 
	   $qry = "select count(weekno) as cno from fixtures  where weekno='$lastweek' and season='$sea' and `div`='$BET' ";
	   break;
	
  case "SELECTION": 
	   $qry = "select count(weekno) as cno from quickpick where weekno='$lastweek' and season='$sea'  AND bettype='$BET' and matchtype='$RESULT'";
	    break; 
	
  endswitch; 
	
    if ($db=='eu'){
       $temp = $eu->prepare($qry) ;
    }else{
       $temp = $sa->prepare($qry);
    }
    $temp->execute();
    $d = $temp->fetch() ;
    
    $link_string = ($d["cno"] > 0) ? "mblue" : "red  " ;
    return $d["cno"];
}

function divlist(){
	return " English Barclays Premiership, English Championship, English Leagues 1 & 2, National League (Conference), Isthmian Premier, English Northern & Southern Premiers, Scottish Premier, Scottish Championship, Scottish Leagues 1 & 2, French Ligue 1, German Bundesliga, Greek Super League, Dutch Eredivisie, Italian Serie A, Portuguese Liga, Spanish Primera Liga, Turkish Super Lig, Brazil Serie A & B, and USA MLS.";
	
}


function divlist22(){
  global $arry_div, $arry_div_sa;
  
  $dlist = "";
  for ($i=0; $i<=count($arry_div); $i++){
    $dlist .= divname($arry_div[$i])." ";
  }
  for ($i=0; $i<=count($arry_div_sa); $i++){
    $dlist .= divname($arry_div_sa[$i])." ";
  }

  return $dlist;
}

//<!-- division Name --->
function divname($DIV,$CODEONLY = 0)
{
switch ($DIV):
	case "0": $caption = "UK/European Major Divisions" ; break;
  case "1": $caption = "All Divisions" ; break;
  case "2": $caption = "ALL DIVISIONS COMBINED" ; break;
	case "EP": $caption = ($CODEONLY==0? "England - Barclays Premiership" : "Barclays Premiership"); break;
	case "C0": $caption = ($CODEONLY==0? "England - Championship": "Championship"); break;	
	case "C1": $caption = ($CODEONLY==0? "England - League 1": "League 1"); break;
	case "C2": $caption = ($CODEONLY==0? "England - League 2": "League 2"); break;
	case "SP": $caption = ($CODEONLY==0? "Scotland - Premier": "Premier") ; break;
	case "S1": $caption = ($CODEONLY==0? "Scotland - Championship (Div 1)": "Championship (Div 1)" ); break;
	case "S2": $caption = ($CODEONLY==0? "Scotland - League 1 (Div 2)" : "League 1 (Div 2)") ; break;
	case "S3": $caption = ($CODEONLY==0? "Scotland - League 2 (Div 3)" : "League 2 (Div 3)"); break;
	case "NC": $caption = "National League"; break; //"Vanarama Conference"; break;
	case "MP": $caption = "Southern Premier League"; break;
	case "UP": $caption = "Northern Premier League"; break;
	case "RP": $caption = "Isthmian Premier League"; break;
	case "fa": $caption = "FA Cup/Calling Cup"; break;
	case "FA": $caption = "English FA Cup/Carling Cup"; break;
	case "SA": $caption = "Scottish FA / Bell's / Challenge Cup"; break;
	case "SC": $caption = "Scottish FA Cup"; break;
	case "IS": $caption = "Italy - Serie A"; break;
	case "GB": $caption = "Germany - Bundesliga"; break;
	case "SL": $caption = "Spain - Primera Liga"; break;
	case "FL": $caption = "France - Ligue 1"; break;
	case "HK": $caption = "Holland - Eredivisie"; break;
	case "IN": $caption = "Champions League/UEFA Cup"; break;
	case "T0": $caption = "Turkey - Super Lig"; break;
	case "G0": $caption = "Greece - Super League"; break;
	case "P0": $caption = "Portugal - Portuguese Liga"; break;
	case "BRA": $caption = "Brazil A"; break;
	case "BRB": $caption = "Brazil B"; break;	
	case "MLS": $caption = "USA MLS"; break;

endswitch;

 return $caption;
}

// Other TEAMs
function otherteams($DIV,$cur_season,$db)
{  
  global $eu, $sa;

  $query1 = "SELECT distinct(team) as team FROM tabs WHERE `div`='$DIV' and season='$cur_season' order by team"; 

  if ($db=='eu'){
    $temp = $eu->prepare($query1) ;
  }else{
    $temp = $sa->prepare($query1);
  }
  $temp->execute();
  
  $n=0;$number=0;
  
  while ($r = $temp->fetch()){
    $n++;
    $number++;
    $cTeam = trim($r["team"]);
    if ($cTeam==$_GET['TEAM']){
     $n--;
    }else{
     $othteam .= "<a class=\"blue\" href=\"$PHP_SELF?TEAM=$cTeam&site=$db\">$cTeam</a>";
     $othteam .="&nbsp;";
     if (($number <> $xrow) and ($n<6)){ 
        $othteam.= printv("-");
      }
      $othteam .="&nbsp;";
    }
     if ($n=='6'){
        $othteam.="<br>"; $n=0; 
     } 
   }
?>
<div align="center">
 <table border="0" style="border-collapse: collapse;margin:auto auto;border:1px solid #ccc;"  width="80%" cellpadding="5" >
   <tr class='td' bgcolor='#cccccc'>
       <td> Other  Teams in <span class="bot"><?php echo divname($DIV) ?></span> Division</b> </td>
     </tr>
     <tr>
        <td  bgcolor="#f4f4f4" style='text-align:center;'>
          <?php echo $othteam ?></td>

    </tr>
</table>
</div>

<?php
}

//boxes
function week_box_new($caption, $week, $wdate, $season, $w='100%')
{
echo '
<table border="1" width="'. $w .'" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#D3EBAB" bgcolor="#F6F6F6">
  <tr>
    <td colspan="3"  style="padding:5px;text-align:center;text-transform:uppercase;color:#0066FF;font-weight:bold;font-family:verdana;"><font size="+1">'.$caption.'</font></td>
  </tr>
	<tr>
	  <td width="25%" style="font-size:14px;padding:2px"><b>Week No. '. $week .'</b></td>
	  <td width="50%" style="font-size:12px;padding:2px">Week Beginning: <b>'. $wdate. '</b> </td>
	  <td width="25%" style="font-size:12px;padding:2px">Season: <b>'. $season .'</b> </td>
	</tr>
</table>';

}


function week_box_only($season, $div, $w='100%')
{
echo '
<table border="1" width="'.$w.'" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#D3EBAB" bgcolor="#F6F6F6">
	<tr>
	   <td colspan="3"  style="padding:5px;text-align:center;text-transform:uppercase;color:#0066FF;font-weight:bold;font-family:verdana;"><font size="+1">'.$div.' - '.$season.'</font></td>
	</tr>
</table>';
}



function week_box_nocap($weekno, $wdate, $season, $w='100%')
{
echo '
<table border="1" width="'.$w.'" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#D3EBAB" bgcolor="#F6F6F6">
	<tr>
	  <td width="25%" style="font-size:14px;padding:4px"><b>Week No. '.$weekno.'</b></td>
	  <td width="45%" style="font-size:12px;padding:4px">Week Beginning: <b>'.$wdate.'</b> </td>
	  <td width="30%" style="font-size:12px;padding:4px">Season: <b>'.$season.'</b> </td>
	</tr>
</table>';
}

function week_box($wdate, $season, $weekno, $caption, $w='100%')
{
echo '
<table border="1" width="'.$w.'" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#D3EBAB" bgcolor="#F6F6F6">
<tr>
    <td colspan="3"  style="padding:5px;text-align:center;text-transform:uppercase;color:#0066FF;font-weight:bold;font-family:verdana;"><font size="+1">'.$caption.'</font></td>
  </tr>
	<tr>
	  <td width="25%" style="font-size:14px;padding:2px"><b>Week No. '. $weekno .'</b></td>
	  <td width="50%" style="font-size:12px;padding:2px">Week Beginning: <b>'. $wdate .'</b> </td>
	  <td width="25%" style="font-size:12px;padding:2px">Season: <b>'. $season .'</b> </td>
	</tr>
</table>';
}

function week_box_new200($caption, $week, $wdate, $season,$w='560')
{
echo '
<table border="1" width="'.$w.'" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#D3EBAB" bgcolor="#F6F6F6">
  <tr>
    <td colspan="3"  style="padding:5px;text-align:center;text-transform:uppercase;color:#0066FF;font-weight:bold;font-family:verdana;"><font size="+1">'.$caption.'</font></td>
  </tr>
	<tr>
	  <td width="25%" style="font-size:14px;padding:2px"><b>Week No. '.$week.' </b></td>
	  <td width="50%" style="font-size:12px;padding:2px">Week Beginning: <b>'.$wdate.'</b> </td>
	  <td width="25%" style="font-size:12px;padding:2px">Season: <b>'.$season.'</b> </td>
	</tr>
</table>';
}

function week_box_new_3rows($caption, $week, $wdate, $season,$row3cap,$w='100%')
{
echo '
<table border="1" width="'.$w.'" cellpadding="2" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#D3EBAB" bgcolor="#F6F6F6">
  <tr>
    <td colspan="3"  style="padding:5px;text-align:center;text-transform:uppercase;color:#0066FF;font-weight:bold;font-family:verdana;"><font size="+1">'.$caption.'</font></td>
  </tr>
	<tr>
	  <td width="25%" style="font-size:14px;padding:2px"><b>Week No.'. $week .'</b></td>
	  <td width="50%" style="font-size:12px;padding:2px">Week Beginning: <b>'.$wdate.'</b> </td>
	  <td width="25%" style="font-size:12px;padding:2px">Season: <b>'.$season.'</b> </td>
	</tr>
   <tr>
        <td colspan="3" class="credit" style="text-align:center;padding:5px;color:#0066ff;">'.$row3cap.'</td>
   </tr>
</table>';
}


function table_header($caption)
{ 
echo '
    <table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#CDCDCD" width="570" >
    <hd><B>'.$caption.'</B></hd>
    <tr bgcolor="#D3EBAB">
        <td width="7%" style="text-align: center"><b>Rank</b></td>
        <td width="41%" style="text-align: left"><b>Team</b></td>
        <td width="7%" style="text-align: center"><b>Played</b></td>
        <td width="7%" style="text-align: center"><b>W</b></td>
        <td width="7%" style="text-align: center"><b>D</b></td>
        <td width="7%" style="text-align: center"><b>L</b></td>
        <td width="7%" style="text-align: center"><b>GF</b></td>
        <td width="8%" style="text-align: center"><b>GA</b></td>
        <td width="8%" style="text-align: center"><b>GD</b></td>
        <td width="8%" style="text-align: center"><b>Pts</b></td>
    </tr>';

}

function mon($mon)
{
	switch ($mon):
		case 1: $caption = "Jan"; break; 
		case 2: $caption = "Fab"; break;
		case 3: $caption = "Mar"; break; 
		case 4: $caption = "Apr"; break; 
		case 5: $caption = "May"; break; 
		case 6: $caption = "Jun"; break; 
		case 7: $caption = "Jul"; break; 
		case 8: $caption = "Aug"; break; 
		case 9: $caption = "Sep"; break; 
		case 10: $caption = "Oct"; break; 
		case 11: $caption = "Nov"; break; 
		case 12: $caption = "Dec"; break; 
	endswitch;
	return $caption;
}

function prt($num) 
{
	if ($num<=0) :
		return  "";
	else:
			return number_format($num, 2, '.', '') ;
	endif;
}
function prtno($num) 
{
	return number_format($num, 2, '.', '') ;
}

function prt_0($num) 
{
	if ($num<=0) :
		return  "";
	else:
			return number_format($num, 0, '.', '') ;
	endif;
}

function prtZero($num) 
{
	return number_format($num, 0, '.', '') ;

}

function num($number,$yy)
{
	return number_format($number,$yy,'.',',');
}

function num0($number)
{
	return number_format($number,0,'.',',');
}
function num00($number)
{	if ($number>0):
		return number_format($number,0,'.','');
	else:
		return "&nbsp;" ;
	endif;
}

function num1($number)
{	if ($number>0):
		return number_format($number,1,'.','');
	else:
		return "&nbsp;" ;
	endif;
}
function num2($number)
{	if ($number>0):
		return number_format($number,2,'.','');
	else:
		return "0.00" ;
	endif;
}
function num20($number)
{	
	return number_format($number,2,'.','');
	
}


function red($char)
{
	return "<font color=\"#FF0000\">$char</font>";
}
function blue($char)
{
	return "<font color=\"#0000FF\">$char</font>";
}

function printv($char)
{
	return "<font color=\"#FF0000\">$char</font>";
}

function printvblack($char)
{
	return "<font color=\"#000000\">$char</font>";
}
function dash()
{
	return " - ";
}
function rowcol($number)
{
 if (intval($number / 2) == ($number / 2)):
	  return "bgcolor='" . EVENROW ."' " ;
 else:
      return "bgcolor='" . ODDROW . "' " ;
endif;
}

function bookie_name($code)
{
	switch ($code):
		case "GB":  return "<a rel='nofollow' class='sbar' href='http://gamebookers.com' target='_blank'>Gamebookers.com</a>"; break; 
		case "SB":  return "<a rel='nofollow' class='sbar' href='http://sportingbet.com' target='_blank'>Sportingbet.com</a>"; break; 
		case "365": return "<a rel='nofollow' class='sbar' href='http://imstore.bet365affiliates.com/Tracker.aspx?AffiliateId=54790&AffiliateCode=365_154673&CID=196&DID=127&TID=1&PID=149&LNG=1' target='_blank'>Bet365.com</a>"; break; 
		case "BET": return "<a rel='nofollow' class='sbar' href='http://imstore.bet365affiliates.com/Tracker.aspx?AffiliateId=54790&AffiliateCode=365_154673&CID=196&DID=127&TID=1&PID=149&LNG=1' target='_blank'>Bet365.com</a>"; break; 
		case "VC":  return "<a rel='nofollow' class='sbar' href='http://victorchandler.com/' target='_blank'>Victorchandler.com</a>"; break; 
		case "BX":  return "<a rel='nofollow' class='sbar' href='http://gamebookers.com' target='_blank'>Gamebookers.com</a>"; break; 
		
	endswitch;

}

function closed()
{
 return '<a class=sbar href="javascript:close()"><img border="0" src="images/header/blue-dot.gif" alt="Close">Close Window</a>' ;
}

function back()
{
 return '<a class=sbar href="javascript:history.go(-1)"><img border="0" src="images/header/blue-dot.gif" alt="soccer successes">Back</a>' ;
}
function printscr()
{ global $page_title, $domain, $pageURL;
 return "<A class='sbar'  HREF='$domain/print.php?msg=$page_title&pageURL=$pageURL' target='_blank'><img border='0' src='$domain/images/header/blue-dot.gif' alt='Print'/>Print</a>" ;
}

function printEASE()
{ global $page_title, $domain, $pageURL;
 return "<A class='sbar'  HREF='$domain/print.php?msg=$page_title&PARA=$pageURL' target='_blank'><img border='0' src='$domain/images/header/blue-dot.gif' alt='Print' />Print</a>" ;
}

function prt_bet($BET) 
{
	switch ($BET): 
       case "HW":  $cbet = "Home Win Calls";  break; 
       case "AW":  $cbet = "Away Win Calls";  break; 
       case "AD":  $cbet = "Draw Calls";  break; 
       case "F":   $cbet = "Midweek Preferences"; break; 
       case "E":   $cbet = "Weekend Short Odds";  break; 
       case "V":   $cbet = "Weekend Medium Odds"; break; 
       case "L":   $cbet = "Weekend Long Shots";  break; 
       case "A":   $cbet = "Asian Handicap"; break; 
       case "1X2": $cbet = "Weekend 1X2 Outright Calls"; break;      
       case "DC":  $cbet = "Weekend Double Chance Calls"; break;       
       case "AHB": $cbet = "Weekend Asian Handicap Calls"; break;       
       case "EASE":$cbet = "Correct Scores (\"EASE 6\")";  break;       
  endswitch;
 return "$cbet" ;
}

function selection_type($BET)
{
   switch ($BET): 
    case "1X2": 
       $cbet = "Weekend 1X2 Outright Calls";
       break; 
   case "F": 
       $cbet = "Midweek Preferences";
       break; 
   case "E": 
       $cbet = "Weekend Short Odds";
       break; 
   case "L": 
       $cbet = "Weekend Long Shots";
       break; 
   case "V": 
       $cbet = "Weekend Medium Odds";
       break; 
   case "A": 
       $cbet = "Weekend Asian Handicap";
       break; 
   case "M": 
       $cbet = "Midweek";
       break; 

   endswitch;
 return $cbet ;
}

function match_type($RESULT)
{
switch ($RESULT): 
   case "HW": 
       $type = "Home Win Calls ";
       break; 
   case "AW": 
       $type = "Away Win Calls ";
       break; 
   case "AD": 
       $type = "Draw Calls ";
       break; 
   case "CS": 
       $type = "Correct Scores - Draws ";
       break; 
   case "CH": 
       $type = "Correct Scores - Homes ";
       break; 
   case "CA": 
       $type = "Correct Scores - Aways ";
       break; 
   case "HT": 
       $type = "Half-Time/Full-Time";
       break; 
 case "AHB": 
       $type = "Asian Handicap";
       break; 
   endswitch; 

   return $type;
}

function letters($CH)
{
	switch ($CH): 
		case "PP" : $cChar = "Pay-Per-Win" ;					break;
		case "QP" : $cChar = "Quik-Pik Specials" ;				break;
		case "QPS" : $cChar = "Quik-Pik Specials" ;				break;
		case "HT" : $cChar = "Half-Time/Full-Time";				break;
		case "MP":  $cChar = "Midweek Preferences Wins" ;		break;
		case "MD":  $cChar = "Midweek Preferences Draws" ;		break;
		case "MC":  $cChar = "Midweek Correct Scores" ;			break;
		case "MHT": $cChar = "Midweek Half-Time/Full-Time" ;	break;
		case "SW":  $cChar = "Weekend Short Odds Wins" ;		break;
		case "MW":  $cChar = "Weekend Medium Odds Wins" ;		break;
		case "LW":  $cChar = "Weekend Long Shots Wins" ;		break;
		case "WD":  $cChar = "Weekend Draws" ;					break;
		case "WC":  $cChar = "Weekend Correct Scores" ;			break;
		case "AHB": $cChar = "Weekend Asian Handicap" ;			break;
		case "WHT": $cChar = "Weekend Half-Time/Full-Time" ;	break;

		case "F":  $cChar = "Midweek Preferences" ;		break;
		case "E":  $cChar = "Weekend Short Odds" ;		break;
		case "V":  $cChar = "Weekend Medium Odds" ;		break;
		case "L":  $cChar = "Weekend Long Shots" ;		break;

		case "HW":  $cChar = "Home Calls" ;	break;
		case "AW":  $cChar = "Away Calls" ;	break;
		case "AD":  $cChar = "Draw Calls" ;		break;

		case "CH":  $cChar = "Correct Scores Homes" ;		break;
		case "CA":  $cChar = "Correct Scores Aways" ;		break;
		case "CS":  $cChar = "Correct Scores Draws" ;		break;

	endswitch ;

	return $cChar ;
}

function letters_call($CH)
{
	switch ($CH): 
		case "HW":  $cChar = "Home Calls" ;	break;
		case "AW":  $cChar = "Away Calls" ;	break;
		case "AD":  $cChar = "Draws" ;		break;
	endswitch ;

	return $cChar ;
}

function match_bet($match,$bet)
{
	switch ($match): 
		case "F":  $cChar = "Midweek Preferences " ;	break;
		case "E":  $cChar = "Weekend Short Odds " ;		break;
		case "V":  $cChar = "Weekend Medium Odds " ;	break;
		case "L":  $cChar = "Weekend Long Shots " ;		break;
	endswitch ;
	switch ($bet): 
		case "H":  $cChar2 = "Homes" ;	break;
		case "A":  $cChar2 = "Aways" ;	break;
		case "D":  $cChar2 = "Draws" ;	break;
	endswitch ;
  
  if ($match=="E" and $bet=="D"){
     return "Weekend Draws" ;
	}else{
    return $cChar . $cChar2 ;
  }
}

function rt_call($h_s, $a_s, $call)
{
	if ( ($h_s>$a_s) and ($call=='H')){
	   return 1;
	}else{
	   return 0;
	}
	
    if ( ($a_s>$h_s) and ($call=='A')){
	   return 1;
	}else{
	   return 0;
	}
}


function show_goal_char1x2($hg, $ag)
{
   if (strlen(trim($hg))>0):
	   if ($hg>$ag):
			$cap = "<img src='images/1h.gif' alt='Home Win'/>" ;
	   elseif($hg==$ag):
			$cap = "<img src='images/xx.gif' alt='Draw'/>" ;
	   elseif($hg<$ag):
			$cap = "<img src='images/2a.gif' alt='Away Win'/>" ;
	   endif;
	else:
		$cap="";
	endif;
	return $cap ;
}

function ResultChar($h_s,$a_s,$side)
{
  $cChar="";
  $score = trim($h_s).'-'.trim($a_s);
  switch ($side): 
  case "A":
    if ($a_s>$h_s)     :$cChar = "W";
    elseif ($a_s<$h_s) :$cChar ="L";
    elseif ($h_s=="P" and $a_s=="P"):$cChar ="P"; 
    elseif ($h_s==$a_s and $score!="-"):$cChar ="D"; 
    elseif ($score=="-"): $cChar="-";
    endif;
    break;
  case "H":
    if ($h_s<$a_s)     :$cChar ="L";
    elseif ($h_s>$a_s) :$cChar ="W";
    elseif ($h_s=="P" and $a_s=="P"):$cChar ="P"; 
    elseif ($h_s==$a_s and $score!="-"):$cChar ="D"; 
    elseif ($score=="-"): $cChar="-";
    endif;
    break;
  endswitch ;

  return $cChar ;
}

function meta_index(){
  return "{soccer pick|soccer prediction|soccer selection|soccer tip|soccer picks|soccer predictions|soccer selections|soccer tips|soccer punter|soccer punters|soccer tipping|soccer tipster|soccer tipsters|soccer winner|soccer winners|soccer premier league|soccer premier leagues|soccer premier league picks|soccer premier league predictions|soccer premier league selections|soccer premier league tips|barclay premier picks|barclay premier predictions|barclay premier selections|barclay premier tips|barclay premier soccer picks|barclay premier soccer predictions|barclay premier soccer selections|barclay premier soccer tips|epl pick|epl prediction|epl selection|epl tip|epl picks|epl predictions|epl selections|epl tips|epl soccer picks|epl soccer predictions|epl soccer selections|epl soccer tips|england soccer picks|england soccer predictions|england soccer selections|england soccer tips|england premier league predictions|english soccer picks|english soccer predictions|english soccer selections|english soccer tips|uk soccer picks|uk soccer predictions|uk soccer selections|uk soccer tips|european soccer picks |european soccer predictions|european soccer selections|european soccer tips|dutch soccer picks|dutch soccer predictions|dutch soccer selections|dutch soccer tips|france soccer picks|france soccer predictions|france soccer selections|france soccer tips|french soccer picks|french soccer predictions|french soccer selections|french soccer tips|german soccer picks|german soccer predictions|german soccer selections|german soccer tips|germany soccer picks|germany soccer predictions|germany soccer selections|germany soccer tips|greece soccer picks|greece soccer predictions|greece soccer selections|greece soccer tips|greek soccer picks|greek soccer predictions|greek soccer selections|greek soccer tips|holland soccer picks|holland soccer predictions|holland soccer selections|holland soccer tips|italian soccer picks|italian soccer predictions|italian soccer selections|italian soccer tips|italy soccer picks|italy soccer predictions|italy soccer selections|italy soccer tips|netherlands soccer picks|netherlands soccer predictions|netherlands soccer selections|netherlands soccer tips|portugal soccer picks|portugal soccer predictions|portugal soccer selections|portugal soccer tips|portuguese soccer picks|portuguese soccer predictions|portuguese soccer selections|portuguese soccer tips|premier league soccer picks|premier league predictions|premier league soccer selections|premier league soccer tips|scotland soccer picks|scotland soccer predictions|scotland soccer selections|scotland soccer tips|scottish soccer picks|scottish soccer predictions|scottish soccer selections|scottish soccer tips|spain soccer picks|spain soccer predictions|spain soccer selections|spain soccer tips|spanish soccer picks|spanish soccer predictions|spanish soccer selections|spanish soccer tips|turkey soccer picks|turkey soccer predictions|turkey soccer selections|turkey soccer tips|turkish soccer picks|turkish soccer predictions|turkish soccer selections|turkish soccer tips|USA MLS soccer picks|USA MLS soccer predictions|USA MLS soccer selections|USA MLS soccer tips|Brazil soccer picks|Brazil soccer predictions|Brazil soccer selections|Brazil soccer tips|Brazilian soccer picks|Brazilian soccer predictions|Brazilian soccer selections|Brazilian soccer tips}";
}

function meta_tools(){
    return "{soccer prediction machine|soccer prediction software|soccer prediction tool|soccer prediction tools|soccer predicting tools|soccer scores predictor|football prediction machine|football prediction software|football prediction tool|football prediction tools|football predicting tools|football scores predictor|predicting soccer scores|predicting football scores}";
}

function meta_cs(){
    return "{soccer correct score pick|soccer correct score prediction|soccer correct score selection|soccer correct score tip|soccer correct scores picks|soccer correct scores predictions|soccer correct scores selections|soccer correct scores tips|soccer correct scores tips|soccer exact score pick|soccer exact score prediction|soccer exact score selection|soccer exact score tip|soccer exact scores picks|soccer exact scores predictions|soccer exact scores selections|soccer exact scores tips|soccer exact scores tips}";
}

function meta_bettingadvice(){
    return "{advice betting|advice on betting|beating the bookie|beating the bookies|bet advice|bet forums|bet guidance|betting advice|betting advice forum|betting forums |betting guidance|betting perms|betting permutations|betting system|betting systems|betting to win|correct scores betting to win|correct scores gambling to win|expert betting advice|expert betting advice forum|expert betting advice forums|expert gambling advice|expert gambling advice forum|expert gambling advice forums|fixed odds betting advice|fixed odds gambling advice|gambling advice|gambling perms|gambling permutations|gambling systems|gambling to win|how to beat the bookie|how to beat the bookies|how to win at soccer betting|how to win at soccer gambling|socccer betting to win|soccer accumulator|soccer betting advice|soccer betting forum|soccer betting forums|soccer betting guidance|soccer betting guide|soccer betting perms|soccer betting permutations|soccer betting system|soccer betting systems|soccer betting to win|soccer gambling advice|soccer gambling forum|soccer gambling forums|soccer gambling guidance|soccer gambling guide|soccer gambling perms|soccer gambling permutations|soccer gambling to win|tips on soccer betting|tips on soccer gambling}";
}

function meta_bettingdata(){
    return "{best odds|best soccer odds|betting exchanges|betting lines|betting odds|betting odds comparison|fixed odds|league standings|odds comparison|odds comparisons|scores results|soccer betting odds|soccer odds|soccer odds comparison|soccer odds comparisons|soccer result|soccer results|soccer results|soccer score|soccer scores|soccer standings|soccer stats|stats scores|team performance|team scores|top soccer odds|bet pick|bet picks|bet prediction|bet predictions|bet selection|bet selections|bet tip|bet tips|betting picks|betting predictions|betting selections|betting tips|correct score betting|correct scores betting|effective correct score betting|effective correct score betting pick|effective correct score betting prediction|effective correct score betting selection|effective correct score gambling|effective correct score gambling pick|effective correct score gambling prediction|effective correct score gambling selection|effective correct scores betting|effective correct scores betting pick|effective correct scores betting picks|effective correct scores betting prediction|effective correct scores betting predictions|effective correct scores betting selection|effective correct scores betting selections|effective correct scores betting tip|effective correct scores betting tips|effective correct scores gambling|effective correct scores gambling pick|effective correct scores gambling picks|effective correct scores gambling prediction|effective correct scores gambling predictions|effective correct scores gambling selection|effective correct scores gambling selections|effective correct scores gambling tip|effective correct scores gambling tips|effective exact score betting|effective exact score betting pick|effective exact score betting prediction|effective exact score betting selection|effective exact score gambling|effective exact score gambling pick|effective exact score gambling prediction|effective exact score gambling selection|effective exact scores betting|effective exact scores betting pick|effective exact scores betting picks|effective exact scores betting prediction|effective exact scores betting predictions|effective exact scores betting selection|effective exact scores betting selections|effective exact scores betting tip|effective exact scores betting tips|effective exact scores gambling|effective exact scores gambling pick|effective exact scores gambling picks|effective exact scores gambling prediction|effective exact scores gambling predictions|effective exact scores gambling selection|effective exact scores gambling selections|effective exact scores gambling tip|effective exact scores gambling tips|effective soccer betting|effective soccer gambling|exact score betting|exact scores betting|gambling pick|soccer bet|soccer bet pick|soccer bet picks|soccer bet prediction|soccer bet predictions|soccer bet selection|soccer bet tip|soccer bet tips|soccer bets|soccer bets selections|soccer betting|soccer betting pick|soccer betting picks|soccer betting prediction|soccer betting predictions|soccer betting selection|soccer betting selections|soccer betting tip|soccer betting tips|soccer gambler|soccer gamblers|soccer gambling|soccer gambling|soccer gambling pick|soccer gambling picks|soccer gambling prediction|soccer gambling predictions|soccer gambling selection|soccer gambling selections|soccer gambling tip|soccer gambling tips|tip for soccer betting|tip for soccer gambling|tip on correct score betting|tip on correct scores betting|tip on exact score betting|tip on exact scores betting|tip on soccer betting|tip on soccer gambling|tips for soccer betting|tips for soccer gambling|tips on correct score betting|tips on correct scores betting|tips on exact score betting|tips on exact scores betting|tips on soccer betting|tips on soccer gambling|tips on soccer selections|tips on winning soccer bets|winning at soccer gambling|winning soccer bets|wise betting|wise gambling|wise soccer betting|wise soccer gambling}";
}

function meta_freepred(){
    return "{free advice betting|free advice gambling|free advice on betting|free advice on gambling|free advice on soccer betting|free advice on soccer gambling|free advice soccer betting|free advice soccer gambling|free bet advice|free bet forums|free bet guidance|free bet pick|free bet picks|free bet prediction|free bet predictions|free bet selection|free bet selections|free bet tip|free bet tips|free betting advice|free betting advice forum|free betting forums |free betting guidance|free betting pick|free betting picks|free betting prediction|free betting predictions|free betting selection|free betting selections|free betting sites|free betting system|free betting tip|free betting tips|free england soccer picks|free england soccer predictions|free england soccer selections|free england soccer tips|free english soccer picks|free english soccer predictions|free english soccer selections|free english soccer tips|free european soccer picks |free european soccer predictions|free european soccer selections|free european soccer tips|free gambling forums|free socccer betting to win|free soccer accumulator|free soccer bet|free soccer bet pick|free soccer bet picks|free soccer bet prediction|free soccer bet predictions|free soccer bet selection|free soccer bet selections|free soccer bet tip|free soccer bet tips|free soccer bets|free soccer bets picks|free soccer bets predictions|free soccer bets selections|free soccer bets tips|free soccer betting|free soccer betting advice|free soccer betting forum|free soccer betting forums|free soccer betting guidance|free soccer betting guide|free soccer betting pick|free soccer betting picks|free soccer betting prediction|free soccer betting predictions|free soccer betting selection|free soccer betting selections|free soccer betting system|free soccer betting systems|free soccer betting tip|free soccer betting tips|free soccer betting to win|free soccer correct scores|free soccer correct scores pick|free soccer correct scores prediction|free soccer correct scores selection|free soccer correct scores tip|free soccer gambling advice|free soccer gambling forum|free soccer gambling forums|free soccer gambling forums|free soccer gambling guidance|free soccer gambling guide|free soccer gambling pick|free soccer gambling picks|free soccer gambling prediction|free soccer gambling predictions|free soccer gambling selection|free soccer gambling selections|free soccer gambling tip|free soccer gambling tips|free soccer gambling to win|free soccer pick|free soccer picks|free soccer prediction|free soccer predictions|free soccer predictor|free soccer selection|free soccer selections|free soccer tip|free soccer tipping|free soccer tips|free soccer tipster|free soccer tipsters|free soccer world cup predictions|free tip for soccer betting|free tip for soccer gambling|free tip on correct score betting|free tip on exact score betting|free tip on soccer betting|free tip on soccer gambling|free tips for soccer betting|free tips for soccer gambling|free tips on correct score betting|free tips on exact score betting|free tips on soccer betting|free tips on soccer gambling|free tips on soccer selections|free tips on winning soccer bets|free world cup soccer predictions}";
}

function meta_football(){
    return "{barclay premier football picks|barclay premier football predictions|barclay premier football selections|barclay premier football tips|best football odds|betting tips for football|dutch football predictions|effective football betting|effective football gambling|england football predictions|english football predictions|epl football predictions|epl football tips|epl footballselections|european football picks |european football predictions|european football selections|european football tips|football accumulator|football bet|football bet pick|football bet picks|football bet prediction|football bet predictions|football bet selection|football bet tip|football bet tips|football bets|football bets|football bets selections|football bets tips|football betting|football betting advice|football betting advice|football betting forum|football betting forums|football betting guidance|football betting guide|football betting guide|football betting odds|football betting perms|football betting permutations|football betting pick|football betting picks|football betting predictions|football betting selection|football betting selections|football betting system|football betting systems|football betting systems|football betting tip|football betting tips|football betting tips|football betting tipster|football betting to win|football correct scores|football correct scores|football correct scores pick|football correct scores prediction|football correct scores selection|football correct scores tip|football gambler|football gamblers|football gambling|football gambling advice|football gambling forum|football gambling forums|football gambling guidance|football gambling guide|football gambling perms|football gambling permutations|football gambling pick|football gambling picks|football gambling prediction|football gambling predictions|football gambling selection|football gambling selections|football gambling tip|football gambling tips|football gambling to win|football odds|football odds comparison|football odds comparisons|football pick|football picks|football prediction|football prediction|football prediction machine|football prediction software|football predictions|football predictions|football predictor|football premier league|football result|football results|football results|football score|football scores|football selection|football selections|football standings|football stats|football team scores|football tip|football tipping|football tips|football tips|football tips|football tipster|football tipster|football tipsters|football tipsters|football winners|football world cup predictions|footballr betting prediction|footballr gambling|footballr punters|france footballpredictions|free advice football betting|free advice football gambling|free advice on football betting|free advice on football gambling|free football accumulator|free football bet pick|free football bet picks|free football bet prediction|free football bet predictions|free football bet selection|free football bet selections|free football bet tip|free football bet tips|free football bets picks|free football bets predictions|free football bets selections|free football bets tips|free football betting advice|free football betting forum|free football betting forums|free football betting guidance|free football betting guide|free football betting pick|free football betting picks|free football betting prediction|free football betting predictions|free football betting selection|free football betting selections|free football betting system|free football betting systems|free football betting tip|free football betting tips|free football betting to win|free football gambling advice|free football gambling forum|free football gambling forums|free football gambling guidance|free football gambling guide|free football gambling to win|free football picks|free football prediction|free football predictions|free football selections|free football tip|free football tips|free socccer betting to win|french football predictions|german football predictions|germany football predictions|greece football predictions|greek football predictions|holland football predictions|how to win at football betting|how to win at football gambling|italian football predictions|italy football predictions|latest football result|latest football results|latest football score|latest football scores|live football score statics|netherlands football predictions|portugal football predictions|portuguese football predictions|scotland football predictions|scottish football predictions|socccer betting to win|spain football predictions|spanish football predictions|tip for football betting|tip for football gambling|tip on football betting|tip on football gambling|tips for football betting|tips for football gambling|tips on football betting|tips on football betting|tips on football betting|tips on football gambling|tips on football gambling|tips on football gambling|tips on football selections|tips on winning football bets|top football odds|turkey football predictions|turkish football predictions|winning at football gambling|winning football bets|wise football betting|wise football gambling}";
}

function Check_FileName($filename)
{
	$new_name = strtolower($filename);
	$new_name = ereg_replace(" ", "_", $new_name);
	$new_name = ereg_replace("\&", "n", $new_name);
	$new_name = ereg_replace("'", "",  $new_name);
	$new_name = ereg_replace("-", "_", $new_name);
	return $new_name;	
}