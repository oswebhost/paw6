<?php
// 11-june-2015 copy saved as patbackup/...._20150611

// need to work on Win Only Bookies and DC call bookies
//

session_start();
ob_end_clean();
ob_start();

include("config.ini.php");
include("function.ini.php");

$odd_max_diff =  20;

if (!isset($_GET['db'])){
  $db= 'eu';
}else{
  $db= $_GET['db'];
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
$cur_week  =$row["weekno"];

if (isset($_GET['season'])){
    $season = $_GET['season']; 
}else{
    $season  =$row["season"];
}

/*
if ($LOG=="N"): $lastweek = $lastweek - 1; endif;
if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;
*/
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

$PAGE_TITLE = "Soccer Selections Analysis Tool v2"  ;


 $pic =  $weekno ."/pic";
  
$onlyAsl = "";

if ($_GET['ASL2GET']=='all'){
	$onlyAsl = "";
}else{
	$onlyAsl = " and f.hgoal = '" . substr($_GET['ASL2GET'],0,1) . "' and f.agoal = '" . substr($_GET['ASL2GET'],1,1) . "'" ;
}
  
//echo $onlyAsl;
   
 $qry = "SELECT f.bookiecall, f.hodddif, f.aodddif, f.dodddif, concat(f.hgoal,f.agoal) as asl2show, f.prvalue, c.dcr_ht, c.dcr_at, c.dcr_av,c.dcr_dif,
		 abs(c.dcr_dif) as dcrdif,f.`div`, f.hteam,f.ateam,f.match_time,f.hgoal,f.agoal,f.h_s,f.a_s,f.gotit,f.mvalue,f.mid,f.pawrank, 
		 date_format(f.match_date,'%d-%b-%y') as mdate,
        f.hwinpb, f.drawpb, f.awinpb, f.h_odd, f.d_odd, f.a_odd, r.ptr_ht, r.ptr_at, r.ptr_av,r.ptr_dif, abs(r.ptr_dif) as ptrdif ,
        (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum, ((f.drawpb*0.5) + f.hwinpb /(f.hwinpb+f.awinpb)*100) as x1probs, 
        ((f.drawpb*0.5) + f.awinpb /(f.hwinpb+f.awinpb)*100) as x2probs, g.gpr_ht, g.gpr_at, g.gpr_av, a.air_ht, a.air_at,a.air_av,a.air_dif ";



switch ($_GET['BETTING']){
    
    case 1: 
        $qry .= ", o.hw_x, o.aw_x, o.hw_aw, o.hw_odd, o.aw_odd, o.un_odd, o.ov_odd           
        FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, other_odds o, cur_reb g, cur_reb_air a     
        WHERE c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and c.season=f.season and c.weekno=f.weekno and 
        g.matchno=f.mid and g.season=f.season and g.weekno=f.weekno and  
        a.matchno=f.mid and a.season=f.season and a.weekno=f.weekno and 
        r.matchno=f.mid and r.season=f.season and r.weekno=f.weekno and 
        o.matchno=f.mid and o.season=f.season and o.weekno=f.weekno  " ;
        break;
        
    case 2: 
    
        $qry .= ", o.hw_x, o.aw_x, o.hw_aw        
        FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, other_odds o, cur_reb g, cur_reb_air a     
        WHERE c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and c.season=f.season and c.weekno=f.weekno and 
        g.matchno=f.mid and g.season=f.season and g.weekno=f.weekno and  
        a.matchno=f.mid and a.season=f.season and a.weekno=f.weekno and 
        r.matchno=f.mid and r.season=f.season and r.weekno=f.weekno and 
        o.matchno=f.mid and o.season=f.season and o.weekno=f.weekno and o.hw_x>0 " ;

		//bookies calls
		switch($_GET['CALL']){
			case 16: $qry .= " and o.hw_x < o.aw_x "; break;
			case 17: $qry .= " and o.aw_x < o.hw_x "; break;
		}
		
		break;
		
    case 3: 
        $qry .= ", o.hw_odd, o.aw_odd        
        FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, other_odds o , cur_reb g, cur_reb_air a    
        WHERE c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and c.season=f.season and c.weekno=f.weekno and  
        g.matchno=f.mid and g.season=f.season and g.weekno=f.weekno and 
        a.matchno=f.mid and a.season=f.season and a.weekno=f.weekno and  
        r.matchno=f.mid and r.season=f.season and r.weekno=f.weekno and 
        o.matchno=f.mid and o.season=f.season and o.weekno=f.weekno and o.hw_odd>0 " ;
		
		//bookies calls
		switch($_GET['CALL']){
			case 11: $qry .= " and o.hw_odd < o.aw_odd "; break;
			case 12: $qry .= " and o.aw_odd < o.hw_odd "; break;
		}
		
		break;

    case 4: 
        $qry .= ", o.un_odd, o.ov_odd        
        FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, other_odds o, cur_reb g, cur_reb_air a     
        WHERE c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and c.season=f.season and c.weekno=f.weekno and  
        g.matchno=f.mid and g.season=c.season and g.weekno=c.weekno and 
        a.matchno=f.mid and a.season=c.season and a.weekno=c.weekno and  
        r.matchno=f.mid and r.season=c.season and r.weekno=c.weekno and  
        o.matchno=f.mid and o.season=c.season and o.weekno=c.weekno and " ;
		
		//bookies call
		if ($_GET['CALL']>3){
			$qry .= " o.un_odd < o.ov_odd and o.ov_odd > 0 ";
		}else{
			$qry .= " (f.hgoal+f.agoal)< 2.5 and o.un_odd>0 ";
		}

        break;
        
    case 5: 
        $qry .= ", o.un_odd, o.ov_odd        
        FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, other_odds o, cur_reb g, cur_reb_air a     
        WHERE c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and c.season=f.season and c.weekno=f.weekno and  
        g.matchno=f.mid and g.season=c.season and g.weekno=c.weekno and 
        a.matchno=f.mid and a.season=c.season and a.weekno=c.weekno and  
        r.matchno=f.mid and r.season=c.season and r.weekno=c.weekno and  
        o.matchno=f.mid and o.season=c.season and o.weekno=c.weekno and  " ;
		
		if ($_GET['CALL']>3){
			$qry .= " o.ov_odd < o.un_odd and o.ov_odd > 0 ";
		}else{
			$qry .= " (f.hgoal+f.agoal)>2.5 and o.un_odd>0 " ;
		}
		
        break;
      
    case 6: 
        $qry .= ", o.ht_odd, o.at_odd, o.ht_hcap, o.at_hcap          
        FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, ahcap_odds o, cur_reb g, cur_reb_air a     
        WHERE c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and c.season=f.season and c.weekno=f.weekno and  
        g.matchno=f.mid and g.season=c.season and g.weekno=c.weekno and 
        a.matchno=f.mid and a.season=c.season and a.weekno=c.weekno and  
        r.matchno=f.mid and r.season=c.season and r.weekno=c.weekno and  
        o.matchno=f.mid and o.season=c.season and o.weekno=c.weekno " ;
        break;
        
}

$proption="";

switch ($_GET['PROPTION'])
  { 
    case 1: $proption = " and f.`prvalue` = 0 "; break;
    case 2: $proption = " ";                    break;
    case 3: $proption = " and f.`prvalue` = 1 ";  break;
  }

  
  switch ($_GET['CALL'])
  { 
    case 1: $call = " and f.hgoal>f.agoal "; $row3cap = "Home Win Calls"; break;
    case 2: $call = " and f.agoal>f.hgoal "; $row3cap = "Away Win Calls"; break;
    case 3: $call = " and f.hgoal=f.agoal "; $row3cap = "Draw Calls";     break;
    case 4: $call = " "; $row3cap = "All Call Types"; break;

	case 6: $call = " and f.bookiecall = '1' "; $row3cap = "Home Win Calls (Bookies)"; break;
    case 7: $call = " and f.bookiecall = '2' "; $row3cap = "Away Win Calls (Bookies)"; break;
    case 8: $call = " and f.bookiecall = '3' "; $row3cap = "Draw Calls (Bookies)"; break;

    case 11: $call = " "; $row3cap = "Home Win Calls (Bookies)"; break;
    case 12: $call = " "; $row3cap = "Away Win Calls (Bookies)"; break;
	
	case 11: $call = " "; $row3cap = "Home Win Calls (Bookies)"; break;
    case 12: $call = " "; $row3cap = "Away Win Calls (Bookies)"; break;

	case 16: $call = " "; $row3cap = "Home Win/Draw Calls (Bookies)"; break;
    case 17: $call = " "; $row3cap = "Away Win/Draw Calls (Bookies)"; break;
	
  }
  
  if ($_GET['BETTING']==2){
	  if ($_GET['CALL']==1){
		   $row3cap = "Home Win/Draw Calls (PaW)";
	  }
  	  if ($_GET['CALL']==2){
		   $row3cap = "Away Win/Draw Calls (PaW)";
	  }

  }
  
  switch ($_GET['PERIOD'])
  {
    case '1': $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
    case '2': $period = " and weekday(f.match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
    case '3': $period = " and weekday(f.match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;

    case '0_d': $period = " and weekday(f.match_date)=0"; $_prerid="Monday"; break;
    case '1_d': $period = " and weekday(f.match_date)=1"; $_prerid="Tuesday"; break;
    case '2_d': $period = " and weekday(f.match_date)=2"; $_prerid="Wednesday"; break;
    case '3_d': $period = " and weekday(f.match_date)=3"; $_prerid="Thursday"; break;
    case '4_d': $period = " and weekday(f.match_date)=4"; $_prerid="Friday"; break;
    case '5_d': $period = " and weekday(f.match_date)=5"; $_prerid="Saturday"; break;
    case '6_d': $period = " and weekday(f.match_date)=6"; $_prerid="Sunday"; break;
  }
  
  switch($_GET['ordered'])
  {
    case 1: $ordered = " asc"; break;
    case 2: $ordered = " desc"; break;
  }
  
  switch ($_GET['SORTBY'])
  {
        case 1: $ordered_by = " ORDER BY r.ptr_ht $ordered, f.hwinpb desc "; break;
        case 2: $ordered_by = " ORDER BY r.ptr_at $ordered, f.awinpb desc "; break;
        case 3: $ordered_by = " ORDER BY r.ptr_av $ordered "; break;
    
        case 4: $ordered_by = " ORDER BY c.dcr_ht $ordered, f.hwinpb desc,c.dcr_av desc "; break;
        case 5: $ordered_by = " ORDER BY c.dcr_at $ordered, f.awinpb desc,c.dcr_av desc "; break;
        case 6: $ordered_by = " ORDER BY c.dcr_av $ordered "; break;
    
        case 7: $ordered_by = " ORDER BY f.hwinpb $ordered, r.ptr_ht desc "; break;
        case 8: $ordered_by = " ORDER BY f.awinpb $ordered, r.ptr_at desc "; break;
        case 9: $ordered_by = " ORDER BY f.drawpb $ordered "; break;
    
        case 10: $ordered_by = " ORDER BY f.h_odd $ordered, r.ptr_ht desc, f.hwinpb desc "; break;
        case 11: $ordered_by = " ORDER BY f.a_odd $ordered, r.ptr_at desc, f.awinpb desc "; break;
        case 12: $ordered_by = " ORDER BY f.d_odd $ordered, r.ptr_ht desc "; break;
    
        case 13: $ordered_by = " ORDER BY goalsum $ordered, f.hgoal $ordered, r.ptr_av desc "; break;
        case 14: $ordered_by = " ORDER BY goaldif $ordered, f.hgoal $ordered, f.hwinpb desc "; break;
        
        case 20: $ordered_by = " ORDER BY o.hw_x $ordered , r.ptr_ht desc, f.hwinpb desc "; break;
        case 21: $ordered_by = " ORDER BY o.aw_x $ordered , r.ptr_at desc, f.awinpb desc "; break;
        case 22: $ordered_by = " ORDER BY o.hw_x $ordered "; break;
         
        case 30: $ordered_by = " ORDER BY o.hw_odd $ordered, f.hwinpb desc, r.ptr_ht desc "; break;
        case 31: $ordered_by = " ORDER BY o.aw_odd $ordered, f.awinpb desc, r.ptr_at desc "; break;
        
        case 40: $ordered_by = " ORDER BY o.un_odd $ordered, f.hwinpb desc, r.ptr_ht desc"; break;
        case 41: $ordered_by = " ORDER BY o.ov_odd $ordered, f.awinpb desc, r.ptr_at desc "; break;
        
        case 50: $ordered_by = " ORDER BY x1probs $ordered, f.hwinpb desc "; break;
        case 51: $ordered_by = " ORDER BY x2probs $ordered, f.awinpb desc "; break;
        
        case 60: $ordered_by = " ORDER BY gpr_ht $ordered, f.hwinpb desc "; break;
        case 61: $ordered_by = " ORDER BY gpr_at $ordered, f.awinpb desc "; break;
        case 62: $ordered_by = " ORDER BY gpr_av $ordered "; break;
        
        case 70: $ordered_by = " ORDER BY air_ht $ordered , f.hwinpb desc"; break;
        case 71: $ordered_by = " ORDER BY air_at $ordered , f.awinpb desc"; break;
        case 72: $ordered_by = " ORDER BY air_av $ordered "; break;
        
		//asian handicap
		case 80: $ordered_by = " ORDER BY ht_odd  $ordered "; break;
		case 81: $ordered_by = " ORDER BY at_odd  $ordered "; break;
		case 82: $ordered_by = " ORDER BY ht_hcap $ordered "; break;
		case 83: $ordered_by = " ORDER BY at_hcap $ordered "; break;
		
		
      }

$callpar2='';
$callpar='';
$filter='';

 switch ($_GET['BETTING'])
 {
    case 1: //1x2 betting
       switch ($_GET['CALL'])
       {
            case 1:
                switch ($_GET['CALLPARAM'])
                {
                    case 1: $callpar = ' and f.h_odd < f.a_odd'; break;
                    case 2: $callpar = ' and f.h_odd > f.a_odd'; break;
                }  
                break;
                
            case 2:
                switch ($_GET['CALLPARAM'])
                {
                    case 1: $callpar = ' and f.a_odd < f.h_odd'; break;
                    case 2: $callpar = ' and f.a_odd > f.h_odd'; break;
                }  
                break;
                
            case 3:
                switch ($_GET['CALLPARAM'])
                {
                    case 1: $callpar = " and (( hodddif between '0' and '". $odd_max_diff . "' or aodddif between '0' and '" . $odd_max_diff  . "') )" ; break;
                    case 2: $callpar = " and ( hodddif > '". $odd_max_diff . "' or aodddif > '" . $odd_max_diff ."' )"  ; break;
                }
                break;
				
				
            case 6:
                switch ($_GET['CALLPARAM'])
                {
                    case 1: $callpar = ' and f.hgoal > f.agoal'; break;
                    case 2: $callpar = ' and f.agoal > f.hgoal'; break;
                }  
                break;
                
            case 7:
                switch ($_GET['CALLPARAM'])
                {
                    case 1: $callpar = ' and f.agoal > f.hgoal'; break;
                    case 2: $callpar = ' and f.hgoal > f.agoal'; break;
                }  
                break;

       }
       
	   
	   break;    
      
      case 2:   // dc calls
        switch ($_GET['CALL'])
        {
            case 1:
                switch ($_GET['CALLPARAM'])
                {
                    case 1: $callpar = ' and  o.hw_x < o.aw_x'; break;
                    case 2: $callpar = ' and  o.hw_x >= o.aw_x'; break;
                    
                }  
                break;
                
            case 2:
                switch ($_GET['CALLPARAM'])
                {
                    case 1: $callpar = ' and  o.aw_x < o.hw_x'; break;
                    case 2: $callpar = ' and  o.aw_x > o.hw_x'; break;
                }  
        }
       break;
       
       case 3: // win only
          switch ($_GET['CALL'])
          {
            case 1: 
                switch ($_GET['CALLPARAM'])
                {
                    case 1: $callpar = ' and  o.hw_odd <= o.aw_odd '; break;
                    case 2: $callpar = ' and  o.hw_odd > o.aw_odd '; break;
                    
                }  
            break;
            
            case 2: 
               switch ($_GET['CALLPARAM'])
                {
                    case 1: $callpar = ' and  o.aw_odd <= o.hw_odd '; break;
                    case 2: $callpar = ' and  o.aw_odd > o.hw_odd '; break;
                    
                }  

            break;
          }
       break;
       
       case 4:// under 2.5
            switch ($_GET['CALLPARAM'])
            {
                case 1: $callpar = ' and  o.un_odd < o.ov_odd '; break;
                case 2: $callpar = ' and  o.un_odd > o.ov_odd '; break;
            }  
       break;

       case 5:// overr 2.5
            switch ($_GET['CALLPARAM'])
            {
                case 1: $callpar = ' and  o.ov_odd < o.un_odd '; break;
                case 2: $callpar = ' and  o.ov_odd > o.un_odd '; break;
            }  
       break;
 
 }   

 
 
 
 
if ($_GET['min_odd']>0 or $_GET['max_odd']>0){

  switch ($_GET['BETTING']){
    
      case 1: 
	      switch ($_GET['CALL'])
          { 
            case 1:
			case 6:
				$filter = " and f.h_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'" ; break;
            case 2:
			case 7:
				$filter = " and f.a_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
            case 3: 
			case 8:
				$filter = " and f.d_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
          }
        break;

      case 2: 
	  
          switch ($_GET['CALL'])
          { 
            case 1: $filter = " and o.hw_x between '" . $_GET['min_odd']  . "' and '" .  $_GET['max_odd'] ."'" ; break;
            case 2: $filter = " and o.aw_x between '" . $_GET['min_odd']  . "' and '" .  $_GET['max_odd'] ."'"; break;
            case 3: $filter = " and o.hw_aw between '" . $_GET['min_odd'] . "' and '" .  $_GET['max_odd'] ."'"; break;
          }
        break;

      case 3: 
	      switch ($_GET['CALL'])
          { 
            case 1:
			case 11: 
				$filter = " and o.hw_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'" ; break;
            case 2:
			case 12:
				$filter = " and o.aw_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
          }
        break;
    
      case  4: 
          
          $filter = " and o.un_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
          switch ($_GET['CALL'])
          { 
            case 1:
			case 6:
                
                if ($_GET['SORTBY']==40){
                   $filter = " and o.un_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
                }
                if ($_GET['SORTBY']==41){
                  $filter = " and o.ov_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
                }
            
            case 2:
			case 7:

                if ($_GET['SORTBY']==40){
                 $filter = " and o.un_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
                }
                if ($_GET['SORTBY']==41){
                  $filter = " and o.ov_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
                }
            
         
          }
        break;
        
     case  5: 
          
          $filter = " and o.ov_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;                   
          switch ($_GET['CALL'])
          { 
            case 1:
                
                if ($_GET['SORTBY']==40){
                 $filter = " and o.un_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
                }
                if ($_GET['SORTBY']==41){
                  $filter = " and o.ov_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
                }
            
            case 2:

                if ($_GET['SORTBY']==40){
                 $filter = " and o.un_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd']."'" ; break;
                }
                if ($_GET['SORTBY']==41){
                  $filter = " and o.ov_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'" ; break;
                }
            
         
          }
        break;
        
       case  6: // asian handicap
          switch ($_GET['CALL'])
          { 
            case 1: $filter = " and o.ht_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
            case 2: $filter = " and o.at_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
          }
        break;
  
  }
  
}

if ($_GET['db']=='eu'){
    
    switch ($_GET['DIV'])
	{
        case '0': $_divs = " and f.`div` IN ('EP','SP','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
        case '1': $_divs = " and f.`div` IN ('EP','C0','C1','C2','SP','S1','S2','S3','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
        case '2': $_divs = " and f.`div` IN ('NC', 'UP', 'RP', 'MP') " ; break;
		case '99': $_divs = "  " ; break;
        default:  $_divs = " and f.`div` = '" . $_GET['DIV'] . "' " ; break;
    }
    
}else{
    switch ($_GET['DIV'])
	{
        
        case '0': $_divs = " and f.`div` IN ('MLS','BRA','BRB') ";  break;
        default: $_divs = " and f.`div` = '" . $_GET['DIV'] . "' "; break;
    }
    
}  
$limited = "";

if ($_GET['limitedto']>0){
    $limited = " limit " . $_GET['limitedto'];
}

//update fixtures set hodddif=(((a_odd+1)/(h_odd+1))-1)*100, aodddif= (((h_odd+1)/(a_odd+1))-1)*100, dodddif=((a_odd+1)-(h_odd+1)); 



//echo "ppp  $filter"  . $_GET['SORTBY'] . $_GET['BETTING'];

$query1 = $qry . $proption . $onlyAsl . $_divs . $period . $call .  $filter .  $callpar . $ordered_by .  $limited ;

//echo "$filter ---<br />"  ;

// echo $query1;
 
    

if (!isset($_SESSION['userid'])){
    $filename = "tmp_" . time() ;

}else{
  $filename = "tmp_" . trim($_SESSION['userid']) ;
}

$xx = "CREATE TEMPORARY TABLE " . $filename . " (".$query1.")";

if ($db=='eu'){
   $temp = $eu->prepare($xx) ;
}else{
   $temp = $sa->prepare($xx);
}
$temp->execute();


$query1 = "select * from $filename " .  (strlen($callpar2)>2 ? " and $callpar2" : $callpar2);

//echo  $query1 ;

if (isset($_GET['db'])){
  $page_title = "Soccer Selections Analysis Tool " . s_title($db) . " Season $season Week $weekno";
}else{
  $page_title = "Soccer Selections Analysis Tool ";
}  

$show_key= meta_tools();
$desc = "A novel interactive online source of past soccer fixtures linked to the Bookies Odds, allowing assessment to be made of the best betting options for the current week's matches. ";



?>


<html !DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<head>

<link rel="shortcut icon" href="<?=$domain?>/images/betware.ico" />
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta name="title" content="Soccer Predictions Analysis Tool (SoccerPAT) <?echo $page_title ?>" />

<link rel="stylesheet" type="text/css" href="<?=$domain?>/css/style_v4.css" media="screen" />
<meta name="description" content="<?php echo $desc;?>" />

<meta name="keywords" content="<?php echo $show_key;?>" />


<style>
  .dark {border-right:2px solid #333;}
  .row:hover {background-color: #e4d4d4}
</style>
</head>
<script type="text/javascript">
function tell(url)
{

  window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=710,height=620");
}
</script>

<body>
<?php  page_header("Soccer Predictions Analysis Tool (SoccerPAT)"); $page_title ="Soccer Predictions Analysis Tool "; ?>

<div style="padding-bottom:5px"></div>

<? if (isset($_GET['db'])){ 

    if (strlen($errlog)>0){
    	echo "<div class='errordiv' style='width:835px;margin:0 auto 10px auto;'>$errlog</div>";
    }        

if ($db=='sa'){
  //$pat_url = "db=eu&season=2014-2015";
  $wk_to_show = cur_week('eu') -1;
  //$pat_url = "db=eu&season=2014-2015&DIV=0&BETTING=1&SORTBY=13&ordered=1&PERIOD=1&CALL=3&min_odd=0.00&max_odd=0.00&limitedto=6&PROPTION=1&CALLPARAM=0&B1=View+Data&weekno=" .$wk_to_show ;
  
   $pat_url = "db=eu&season=". curseason("eu") ."&DIV=0&BETTING=1&SORTBY=13&ordered=1&PERIOD=1&CALL=3&PROPTION=1&ASL2GET=all&limitedto=6&min_odd=0.00&max_odd=0.00&CALLPARAM=0&CALLAS=0&weekno=" .$wk_to_show ;
}else{
   $wk_to_show = cur_week('sa') -1;
   $pat_url = "db=sa&season=2015&DIV=0&BETTING=1&SORTBY=13&ordered=1&PERIOD=1&CALL=3&min_odd=0.00&max_odd=0.00&limitedto=6&PROPTION=1&CALLPARAM=0&weekno=" .$wk_to_show ;
}   

//echo $pat_url;
?>

<div style='width:1010px; margin:auto auto;'>
<div class="report_blue_heading" style="float:left;width: 200px;"><?echo site($db);?></div>

<div class="report_blue_heading" style="float:left;width: 560px; font-size:11px; text-transform:none;font-weight:normal;color:white;background:blue;">
	Have some fun - try interacting with and changing the parameters below to see the different outcomes possible!
</div>

<div class="report_blue_link" style="float:right;width: 220px;"><a href='soccer-predictions-analysis-tool.php?<?echo $pat_url;?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>
</div>



<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="1000">
	 
	  <form method="get" action="<?echo $PHP_SELEF;?>">
        <input type="hidden" name="db" value="<?echo $_GET['db'];?>"/>
		

		<tr>
        
    		<td width='120' class='rtd'><b><font size="2" color="#0000FF">Season</font></b></td>
    		<td width="100">
		    <select size="1" name="season" class="text" style='padding:3px;width:140px;' onChange="this.form.submit();">
			  <? 
			   
				  $sqry = "SELECT distinct(season) as season from fixtures order by season desc limit 3" ;
				  if ($db=='eu'){
	                   $temp = $eu->prepare($sqry) ;
	              }else{
	                   $temp = $sa->prepare($sqry);
	              }
	              $temp->execute();
	              
	             while ($sr = $temp->fetch()) : 
			  ?>
			      <option value="<?= $sr["season"] ?>" <?echo selected($_GET['season'],$sr["season"])?>><?= $sr["season"] ?></option>
			  
			  <? endwhile; ?>
			  </select>
			</td>


			<td class='rtd'><b><font size="2" color="#0000FF">Week No</font></b></td>

		 <td>
		  <select size="1" name="weekno" class="text"  style='padding:3px;'>

		  <? 
        $max_week = find_last_week_of_season(curseason($db),$db) ;
        if (isset($_GET['season'])){
          $max_week = find_last_week_of_season($_GET['season'],$db) ;
        }
        for ($i=$max_week; $i>=1; $i--) : ?>
			     <option value="<?= $i;?>" <? if($i==$weekno): echo " selected"; endif;?>>&nbsp;<?= $i;?>&nbsp;&nbsp;&nbsp;</option>
		  <? endfor;?>		 

		  </select>

      &nbsp;&nbsp; <font style='font-size:12px;'><b><?php echo find_week_dates($season, $weekno, $db);?></b></font>  

		  </td>


		  <td class='rtd'><b><font size="2" color="#0000FF">Division(s) to Use</font></b></td>
	
	      <td>
		   <select size="1" name="DIV" class="text" style="width:200px; padding:3px;">

            <? if ($db=='eu'){ ?>
		            <option value="0" <?echo selected($_GET['DIV'],'0')?>>UK/European Premier Divisions</option> 
                    <option value="1" <?echo selected($_GET['DIV'],'1')?>>UK/European Major Divisions</option> 
                    <option value="2" <?echo selected($_GET['DIV'],'2')?>>UK Minor Divisions</option> 
					<option value="99" <?echo selected($_GET['DIV'],'99')?>>All Divisions</option> 
            
                    <optgroup label="One Division Only">
          			<? for ($_i=0; $_i<count($arry_div); $_i++){ ?>
          			   <? if ($_i<>4 and $_i<>9 and $_i<>18){ ?>
          					<option value="<? echo $arry_div[$_i];?>" <? echo selected($_GET['DIV'], $arry_div[$_i]);?>><? echo divname($arry_div[$_i]); ?></option>
          			   <? } ?>
          			<? } ?>
                    </optgroup>
             <?}?>

            <? if ($db=='sa'){ ?>
          		    <option value="0" <?echo selected($_GET['DIV'],'0')?>>All Divisions</option> 
          			<? for ($_i=0; $_i<count($arry_div_sa); $_i++){ ?>
          				<option value="<? echo $arry_div_sa[$_i];?>" <? echo selected($_GET['DIV'], $arry_div_sa[$_i]);?>><? echo divname($arry_div_sa[$_i]); ?></option>
          			<? } ?>
             <?}?>

			</select>
		  </td>

	</tr>

       <tr>
            
            <td class='rtd'><b><font size="2" color="#0000FF">Bet Types </font></b></td>
            <td>
                <select size="1" name="BETTING" class="text" style="width:140px;padding:3px;" onchange="this.form.submit();">
              		 <option value="1" <?echo selected($_GET['BETTING'],'1')?>>1X2 Betting</option> 
                     <option value="2" <?echo selected($_GET['BETTING'],'2')?>>Double Chance Betting</option>
                     <option value="3" <?echo selected($_GET['BETTING'],'3')?>>Win Only Betting</option>
                     
                     <option value="4" <?echo selected($_GET['BETTING'],'4')?>>Under 2.5 Goals Betting</option>
                     <option value="5" <?echo selected($_GET['BETTING'],'5')?>>Over 2.5 Goals Betting</option>
					
      		  </select>
            
            </td>
            
             <td class='rtd'><b><font size="2" color="#0000FF">Sort On</font></b></td>
            <td>
    		 <select size="1" name="SORTBY" class="text" style="width:180px;padding:3px;">
             
          <? if ($_GET['BETTING']=="1"){ ?>   
              <optgroup label="1X2 Odds">  
                <option value="10" <?echo selected($_GET['SORTBY'],'10')?>>1X2 Home Wins Odds</option>
                <option value="11" <?echo selected($_GET['SORTBY'],'11')?>>1X2 Away Wins Odds</option>
                <option value="12" <?echo selected($_GET['SORTBY'],'12')?>>1X2 Draw Odds</option>
              </optgroup>
			     <optgroup label="Goals">  
           		 <option value="13" <?echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
           		 <option value="14" <?echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
             </optgroup>
          <?}?>
          
           <? if ($_GET['BETTING']=="2"){ ?>   
		     <optgroup label="1X2 Odds">  
                <option value="10" <?echo selected($_GET['SORTBY'],'10')?>>1X2 Home Wins Odds</option>
                <option value="11" <?echo selected($_GET['SORTBY'],'11')?>>1X2 Away Wins Odds</option>
                <option value="12" <?echo selected($_GET['SORTBY'],'12')?>>1X2 Draw Odds</option>
              </optgroup>
			  
              <optgroup label="Double Chance Odds">  
                <option value="20" <?echo selected($_GET['SORTBY'],'20')?>>DC 1/X Odds</option>
                <option value="21" <?echo selected($_GET['SORTBY'],'21')?>>DC 2/X Odds</option>
                <option value="22" <?echo selected($_GET['SORTBY'],'22')?>>DC 1/2 Odds</option>
              </optgroup>
			  
			  </optgroup>
			     <optgroup label="Goals">  
           		  <option value="13" <?echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
           		  <option value="14" <?echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
             </optgroup>
			
          <?}?>
          
          <? if ($_GET['BETTING']=="3"){ ?>   

			 <optgroup label="1X2 Odds">  
                <option value="10" <?echo selected($_GET['SORTBY'],'10')?>>1X2 Home Wins Odds</option>
                <option value="11" <?echo selected($_GET['SORTBY'],'11')?>>1X2 Away Wins Odds</option>
                <option value="12" <?echo selected($_GET['SORTBY'],'12')?>>1X2 Draw Odds</option>
              </optgroup>

              <optgroup label="Win Only Odds">  
                <option value="30" <?echo selected($_GET['SORTBY'],'30')?>>Home Win Only Odds</option>
                <option value="31" <?echo selected($_GET['SORTBY'],'31')?>>Away Win Only Odds</option>
              </optgroup>
			  
			  </optgroup>
			     <optgroup label="Goals">  
           		  <option value="13" <?echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
           		  <option value="14" <?echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
             </optgroup>
          <?}?>
          
          <? if ($_GET['BETTING']=="4" or $_GET['BETTING']=="5"){ ?>   
		     <optgroup label="1X2 Odds">  
                <option value="10" <?echo selected($_GET['SORTBY'],'10')?>>1X2 Home Wins Odds</option>
                <option value="11" <?echo selected($_GET['SORTBY'],'11')?>>1X2 Away Wins Odds</option>
                <option value="12" <?echo selected($_GET['SORTBY'],'12')?>>1X2 Draw Odds</option>
              </optgroup>
			  
              <optgroup label="Under/Over Odds">  
                <option value="40" <?echo selected($_GET['SORTBY'],'40')?>>Under 2.5 Goals Odds</option>
                <option value="41" <?echo selected($_GET['SORTBY'],'41')?>>Over 2.5 Goals Odds</option>
              </optgroup>

             <optgroup label="Goals">  
           		 <option value="13" <?echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
           		 <option value="14" <?echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
             </optgroup>

			  
			  
          <?}?>
          
          
           <? if ($_GET['BETTING']=="6"){ // asian handicap  ?>   
              <optgroup label="Asian Handicap Odds">  
                <option value="80" <?echo selected($_GET['SORTBY'],'80')?>>Home Win Odds</option>
                <option value="81" <?echo selected($_GET['SORTBY'],'81')?>>Away Win Odds</option>
              </optgroup>
              <optgroup label="Asian Handicap Value">  
                <option value="82" <?echo selected($_GET['SORTBY'],'82')?>>Home Team Handicap</option>
                <option value="83" <?echo selected($_GET['SORTBY'],'83')?>>Away Team Handicap</option>
              </optgroup>
          <?}?>
          
    

          <optgroup label="Probabilities">    
            <option value="7" <?echo selected($_GET['SORTBY'],'7')?>>Home Win Probabilities</option>
            <option value="8" <?echo selected($_GET['SORTBY'],'8')?>>Away Win Probabilities</option>
            <option value="9" <?echo selected($_GET['SORTBY'],'9')?>>Draw Probabilities</option>
            
            <option value="50" <?echo selected($_GET['SORTBY'],'50')?>>DC 1/X Probabilities</option>
            <option value="51" <?echo selected($_GET['SORTBY'],'51')?>>DC 2/X Probabilities</option>

          </optgroup>    
          
          <optgroup label="All Inclusive Reliabilities">  
            <option value="70" <?echo selected($_GET['SORTBY'],'70')?>>Home Team AI Reliability</option>
            <option value="71" <?echo selected($_GET['SORTBY'],'71')?>>Away Team AI Reliability</option>
            <option value="72" <?echo selected($_GET['SORTBY'],'72')?>>Average AI Reliability</option>
          </optgroup>
          
          <optgroup label="General Prediction Reliabilities">  
            <option value="60" <?echo selected($_GET['SORTBY'],'60')?>>Home Team GP Reliability</option>
            <option value="61" <?echo selected($_GET['SORTBY'],'61')?>>Away Team GP Reliability</option>
            <option value="62" <?echo selected($_GET['SORTBY'],'62')?>>Average GP Reliability</option>
          </optgroup>
          
          <optgroup label="Prediction Type Reliabilities">  
            <option value="1" <?echo selected($_GET['SORTBY'],'1')?>>Home Team PT Reliability</option> 
            <option value="2" <?echo selected($_GET['SORTBY'],'2')?>>Away Team PT Reliability</option>
            <option value="3" <?echo selected($_GET['SORTBY'],'3')?>>Average PT Reliabilities</option>
          </optgroup>    
          
          <optgroup label="Double Chance Reliabilities">  
            <option value="4" <?echo selected($_GET['SORTBY'],'4')?>>Home Team DC Reliability</option>
            <option value="5" <?echo selected($_GET['SORTBY'],'5')?>>Away Team DC Reliability</option>
            <option value="6" <?echo selected($_GET['SORTBY'],'6')?>>Average DC RReliability</option>
          </optgroup>

        
          
          
    		  </select>

    		  	<select size="1" name="ordered" class="text" style="width:85px;padding:3px;" >
                	<option value="1" <? if ($_GET['ordered']==1) echo 'selected';?>>Low-High</option>
                	<option value="2" <? if ($_GET['ordered']==2) echo 'selected';?>>High-Low</option>
		  		</select>
    		  </td>

            <td class='rtd'><b><font size="2" color="#0000FF">Period/Date</font></b></td>
              <td>
      		  <select size="1" name="PERIOD" class="text" style="width:200px;padding:3px;">
          		 <option value="1" <?echo selected($_GET['PERIOD'],'1')?>>Full Week (Mon - Sun)</option> 
                 <option value="2" <?echo selected($_GET['PERIOD'],'2')?>>Weekend (Sat - Sun)</option>
                 <option value="3" <?echo selected($_GET['PERIOD'],'3')?>>Midweek (Mon - Fri)</option>

                 <?php echo fixture_date($season, $weekno, $db, $_GET['PERIOD'], $divs) ;?>

      		  </select>
    		  </td>
          </tr>
       
       <tr>
          
          
          <td class='rtd'><b><font size="2" color="#0000FF">Call Type</font></b></td>
              <td>
    		  <select size="1" name="CALL" class="text" style="width:140px;padding:3px;" onchange="this.form.submit();">
              
               <? if ($_GET['BETTING']==1 or $_GET['BETTING']==4 or $_GET['BETTING']==5){ ?>
			       <option value="0" <?echo selected($_GET['CALL'],'0')?>>[ Select ]</option> 
        		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win Calls (PaW)</option> 
                   <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win Calls (PaW)</option>
                   <option value="3" <?echo selected($_GET['CALL'],'3')?>>Draw Calls (PaW)</option>
			   <?}?>
			   <? if ($_GET['BETTING']==1 or $_GET['BETTING']==4 or $_GET['BETTING']==5){ ?>
        		   <option value="6" <?echo selected($_GET['CALL'],'6')?>>Home Win Calls (Bookie)</option> 
                   <option value="7" <?echo selected($_GET['CALL'],'7')?>>Away Win Calls (Bookie)</option>
                   <option value="8" <?echo selected($_GET['CALL'],'8')?>>Draw Calls (Bookie)</option>
				<?}?>
               
               
               <? if ($_GET['BETTING']==2){ ?>
			       <option value="0" <?echo selected($_GET['CALL'],'0')?>>[ Select ]</option> 			   
        		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win/Draw Calls (PaW)</option> 
                   <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win/Draw Calls (PaW)</option>
				   
           		   <option value="16" <?echo selected($_GET['CALL'],'16')?>>Home Win/Draw Calls (Bookie)</option> 
                   <option value="17" <?echo selected($_GET['CALL'],'17')?>>Away Win/Draw Calls (Bookie)</option>

				   
               <?}?>
               
               
                 <? if ($_GET['BETTING']==3 ){ ?>
			       <option value="0" <?echo selected($_GET['CALL'],'0')?>>[ Select ]</option> 				 
        		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win Calls (PaW)</option> 
                   <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win Calls (PaW)</option>

        		   <option value="11" <?echo selected($_GET['CALL'],'11')?>>Home Win Calls (Bookie)</option> 
                   <option value="12" <?echo selected($_GET['CALL'],'12')?>>Away Win Calls (Bookie)</option>
				   
               <?}?>



    		  </select>
    		</td>
          
          <td class='rtd'><b><font size="2" color="#0000FF">Rel/Prom Treatment</font></b></td>
              <td class='ltd'>
              <select size="1" name="PROPTION" class="text" style="width:140px;padding:3px;">
                  <option value="1" <?echo selected($_GET['PROPTION'],'1')?>>Staying Teams Only</option>
                  <option value="2" <?echo selected($_GET['PROPTION'],'2')?>>All Teams (incl R/P)</option>
                  <option value="3" <?echo selected($_GET['PROPTION'],'3')?>>Just R/P Matches</option>
              </select>
			  
			  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<b><font size="2" color="#0000FF">ASL</font></b>&nbsp;&nbsp;
              <select size="1" name="ASL2GET" class="text" style="width:73px;padding:3px;margin-right:1px;">
              	<option value="all">ALL</option>
              	
               <?php if ($_GET['CALL']==3 or $_GET['CALL']==8 ){ ?>
              		<option value="00" <?echo selected($_GET['ASL2GET'],'00')?> >0-0</option>
              		<option value="11" <?echo selected($_GET['ASL2GET'],'11')?> >1-1</option>
              		<option value="22" <?echo selected($_GET['ASL2GET'],'22')?> >2-2</option>
              		<option value="33" <?echo selected($_GET['ASL2GET'],'33')?> >3-3</option>
              <?php }?>
			
			   <?php if ($_GET['CALL']==1 or $_GET['CALL']==6 ){ ?>
					<option value="10" <?echo selected($_GET['ASL2GET'],'10')?> >1-0</option>
              		<option value="20" <?echo selected($_GET['ASL2GET'],'20')?> >2-0</option>
              		<option value="21" <?echo selected($_GET['ASL2GET'],'21')?> >2-1</option>
              		<option value="30" <?echo selected($_GET['ASL2GET'],'30')?> >3-0</option>
              		<option value="31" <?echo selected($_GET['ASL2GET'],'31')?> >3-1</option>
              		<option value="32" <?echo selected($_GET['ASL2GET'],'32')?> >3-2</option>
              		<option value="40" <?echo selected($_GET['ASL2GET'],'40')?> >4-0</option>
              		<option value="41" <?echo selected($_GET['ASL2GET'],'41')?> >4-1</option>
               <?php }?>		
 			   
 			   <?php if ($_GET['CALL']==2 or $_GET['CALL']==7 ){ ?>
 			   		
					<option value="01" <?echo selected($_GET['ASL2GET'],'01')?> >0-1</option>
              		<option value="02" <?echo selected($_GET['ASL2GET'],'02')?> >0-2</option>
              		<option value="12" <?echo selected($_GET['ASL2GET'],'12')?> >1-2</option>
              		<option value="03" <?echo selected($_GET['ASL2GET'],'03')?> >0-3</option>
              		<option value="13" <?echo selected($_GET['ASL2GET'],'13')?> >1-3</option>
              		<option value="23" <?echo selected($_GET['ASL2GET'],'23')?> >2-3</option>
              		<option value="04" <?echo selected($_GET['ASL2GET'],'04')?> >0-4</option>
              		<option value="14" <?echo selected($_GET['ASL2GET'],'14')?> >1-4</option>
              <?php }?>
              
              </select>

              </td>
		  
          
            
            <td class='rtd'><b><font size="2" color="#0000FF">Limit Calls to 1st</font></b></td>
            <td><input type='text' style='width:40px;text-align:center;' name='limitedto' value='<?php echo num($_GET['limitedto'],0)?>'/> (insert No.)
            	
            	
            	
            </td>
       </tr>

		  <tr>
		  
		  
		    <td class='rtd'>
			<b><font size="2" color="#0000FF">Odds Range</font></b></td>
            <td><input type='text' style='width:40px;text-align:center;' name='min_odd' value='<?php echo num($_GET['min_odd'],2)?>'/> Min
              &nbsp;<input type='text' style='width:40px;text-align:center;' name='max_odd' value='<?php echo num($_GET['max_odd'],2)?>'/> Max
              
              
              
              
            </td>
			
			

             
              <td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Match Limitation</font></b></td>
              <td>

              	<select size="1" name="CALLPARAM" class="text" style="width:180px;padding:3px;">

              <? if ($_GET['BETTING']<>6){ ?>	
               
                 <? if ($_GET['BETTING']==1 and $_GET['CALL']>5 and $_GET['CALL']<8){ ?>	
				 
					  <option value="0" <?echo selected($_GET['CALLPARAM'],'0')?>>All Matches</option> 
					  <option value="1" <?echo selected($_GET['CALLPARAM'],'1')?>>Bookie Aligned with PaW</option> 
					  <option value="2" <?echo selected($_GET['CALLPARAM'],'2')?>>Bookie Opposite to PaW</option>
             
				 <?} elseif ($_GET['BETTING']==1 and $_GET['CALL']==8 ){ ?>	
				 
					  <option value="0" <?echo selected($_GET['CALLPARAM'],'0')?>>All Matches</option> 
					
				<?}else{ ?>

					  <option value="0" <?echo selected($_GET['CALLPARAM'],'0')?>>All Matches</option> 
					  <option value="1" <?echo selected($_GET['CALLPARAM'],'1')?>>PaW Aligned with Bookie</option> 
					  <option value="2" <?echo selected($_GET['CALLPARAM'],'2')?>>PaW Opposite to Bookie</option>
				
				<?} ?>
			 
			 <?}else{ ?>
             
				<option value="0" <?echo selected($_GET['CALLPARAM'],'0')?>>All Matches</option>
             
			 <?} ?>	 

               </select>

              
		     

		   </td>
		   
		   <?php if ($_GET['BETTING']==1 and $_GET['CALL']==1){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="2" <?echo selected($_GET['CALLAS'],'2')?>>Call as Aways</option>
                   <option value="3" <?echo selected($_GET['CALLAS'],'3')?>>Call as Draws</option>
				   <option value="5" <?echo selected($_GET['CALLAS'],'5')?>>Use Bookies Call</option> 
				  
				   <option value="20" <?echo selected($_GET['CALLAS'],'20')?>>Double Chance 1X</option> 
				   <option value="21" <?echo selected($_GET['CALLAS'],'21')?>>Double Chance 12</option> 
				   <option value="22" <?echo selected($_GET['CALLAS'],'22')?>>Double Chance 2X</option> 
				   <option value="25" <?echo selected($_GET['CALLAS'],'25')?>>Away Win Only</option> 
				   
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==1 and $_GET['CALL']==2 ){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="1" <?echo selected($_GET['CALLAS'],'1')?>>Call as Homes</option> 
                   <option value="3" <?echo selected($_GET['CALLAS'],'3')?>>Call as Draws</option>
				   <option value="5" <?echo selected($_GET['CALLAS'],'5')?>>Use Bookies Call</option> 

				   <option value="20" <?echo selected($_GET['CALLAS'],'20')?>>Double Chance 1X</option> 
				   <option value="21" <?echo selected($_GET['CALLAS'],'21')?>>Double Chance 12</option> 
				   <option value="22" <?echo selected($_GET['CALLAS'],'22')?>>Double Chance 2X</option> 
				   <option value="26" <?echo selected($_GET['CALLAS'],'26')?>>Home Win Only</option> 

			   </select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==1 and $_GET['CALL']==3 ){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="1" <?echo selected($_GET['CALLAS'],'1')?>>Call as Homes</option> 
                   <option value="2" <?echo selected($_GET['CALLAS'],'2')?>>Call as Aways</option>
				   <option value="5" <?echo selected($_GET['CALLAS'],'5')?>>Use Bookies Call</option> 

			   </select>
			</td>
			<?php } ?>
			
			
			
			<?php if ($_GET['BETTING']==1 and $_GET['CALL']==6){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="2" <?echo selected($_GET['CALLAS'],'2')?>>Call as Aways </option>
                   <option value="3" <?echo selected($_GET['CALLAS'],'3')?>>Call as Draws</option>
				   <option value="4" <?echo selected($_GET['CALLAS'],'4')?>>Use PaW Calls</option>

				   <option value="20" <?echo selected($_GET['CALLAS'],'20')?>>Double Chance 1X</option> 
				   <option value="21" <?echo selected($_GET['CALLAS'],'21')?>>Double Chance 12</option> 
				   <option value="22" <?echo selected($_GET['CALLAS'],'22')?>>Double Chance 2X</option> 
				   <option value="25" <?echo selected($_GET['CALLAS'],'25')?>>Away Win Only</option> 
				   
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==1 and $_GET['CALL']==7 ){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="1" <?echo selected($_GET['CALLAS'],'1')?>>Call as Homes</option> 
                   <option value="3" <?echo selected($_GET['CALLAS'],'3')?>>Call as Draws</option>
				   <option value="4" <?echo selected($_GET['CALLAS'],'4')?>>Use PaW Calls</option>

				   <option value="20" <?echo selected($_GET['CALLAS'],'20')?>>Double Chance 1X</option> 
				   <option value="21" <?echo selected($_GET['CALLAS'],'21')?>>Double Chance 12</option> 
				   <option value="22" <?echo selected($_GET['CALLAS'],'22')?>>Double Chance 2X</option> 
				   <option value="26" <?echo selected($_GET['CALLAS'],'26')?>>Home Win Only</option> 
				   
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==1 and $_GET['CALL']==8 ){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="1" <?echo selected($_GET['CALLAS'],'1')?>>Call as Homes</option> 
                   <option value="2" <?echo selected($_GET['CALLAS'],'2')?>>Call as Aways</option>
				   <option value="4" <?echo selected($_GET['CALLAS'],'4')?>>Use PaW Calls</option>
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==5 ){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="10" <?echo selected($_GET['CALLAS'],'10')?>>Call as Under 2.5</option> 
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==4 ){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
				   <option value="11" <?echo selected($_GET['CALLAS'],'11')?>>Call as Over 2.5</option> 
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==2 and ($_GET['CALL']==1 or $_GET['CALL']==16) ){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="7" <?echo selected($_GET['CALLAS'],'7')?>>Away Win/Draw Call</option>
                   <option value="9" <?echo selected($_GET['CALLAS'],'9')?>>Home Win/Away Win</option>
				</select>
			</td>
			<?php } ?>
			
			<?php if ($_GET['BETTING']==2 and ($_GET['CALL']==2 or $_GET['CALL']==17) ){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:140px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="8" <?echo selected($_GET['CALLAS'],'8')?>>Home Win/Draw Call</option>
                   <option value="9" <?echo selected($_GET['CALLAS'],'9')?>>Home Win/Away Win</option>
				</select>
			</td>
			<?php } ?>
			
			<?php if ( ($_GET['BETTING']==3 and $_GET['CALL']==1)  or $_GET['CALL']== 11){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:200px;padding:3px;" >
				   <option value="0"  <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="12" <?echo selected($_GET['CALLAS'],'12')?>>Calls as Away Wins (WO)</option>
				   <option value="14" <?echo selected($_GET['CALLAS'],'14')?>>Call as Draws (1X2)</option>
			   <!--<option value="15" <?echo selected($_GET['CALLAS'],'15')?>>Call as Aways (1X2)</option> -->
				</select>
			</td>
			<?php } ?>
			
			<?php if ( ($_GET['BETTING']==3 and $_GET['CALL']==2) or $_GET['CALL']== 12){ ?>
			<td colspan='1' class='rtd'><b><font size="2" color="#0000FF">Reverse Call</font></b></td>
			
			<td>	
				<select size="1" name="CALLAS" class="text" style="width:200px;padding:3px;" >
				   <option value="0" <?echo selected($_GET['CALLAS'],'0')?>>No Reverse Call</option> 
                   <option value="13" <?echo selected($_GET['CALLAS'],'13')?>>Call as Home Wins (WO)</option>
				   <option value="14" <?echo selected($_GET['CALLAS'],'14')?>>Call as Draws (1X2)</option>
			  <!-- <option value="16" <?echo selected($_GET['CALLAS'],'16')?>>Call as Homes (1X2)</option> -->
				</select>
			</td>
			<?php } ?>
		</tr>
		
        
</table>
<table border="0" cellpadding="2" cellspacing="0" style="border:0px solid #ccc;margin:auto auto;" bordercolor="#f4f4f4" width="1000">
	<tr>
	
		<td  style='text-align:right;padding-top:5px;width:550px;'>
		 <input type="submit" value="View Data" name="B1" class="bt" style="padding:0px;"/> 
		</td>
			<td style='padding-top:4px;padding-left:10px;font-size:18px;'>
				<b>Then Click the <span class='bb'>Summary for Season</span> link below.</b>
			</td>
		
		</tr>
	</table>
	
</form>

<?}else{
    
    include("select-option.ini.php");
    
} ?>



<? if ($_GET['B1']=='View Data') { ?>




<div style="padding-bottom:5px"></div>
  
<table  width="900" style='margin:auto auto'>
<tr>
  <td></td>
  <td align="center"><span class='bot'></span></td>
  <td align="right"> <? echo printscr(); ?></td>
</tr>
</table>

<!-- startprint -->


<? 
    if ( ($db=='eu') and ($_GET['DIV']=='0')){
        $cdiv= divname('0');
    }elseif ( ($db=='sa') and ($_GET['DIV']=='0')){
        $cdiv= divname('1');
    }else{
        $cdiv= divname($_GET['DIV']);
    }
    


function revCall($no,$secondPara){
	$rvcall ="";
	if ($secondPara < 4){

		switch ($no)
		{	
			case 1: $rvcall = "Call as Homes"; break;
			case 2: $rvcall = "Call as Aways"; break;
			case 3: $rvcall = "Call as Draws"; break;
			case 5: $rvcall = "Use Bookies Call"; break;
			
			case 7: $rvcall = "Away Win/Draw"; break;
			case 8: $rvcall = "Home Win/Draw"; break;
			case 9: $rvcall = "Home Win/Away Win"; break;
			
			case 10: $rvcall = "Call as Under 2.5"; break;
			case 11: $rvcall = "Call as Over 2.5"; break;
			
			case 12: $rvcall = "Call as Away Wins (W0)"; break;
			case 13: $rvcall = "Call as Home Wins (WO)"; break;
			case 14: $rvcall = "Call as Draws (1X2)"; break;

			case 16: $rvcall = "Home Win/Draw Calls"; break;
			case 17: $rvcall = "Away Win/Draw Calls"; break;
			
			case 20: $rvcall = "Double Chance 1X"; break;
			case 21: $rvcall = "Double Chance 12"; break;
			case 22: $rvcall = "Double Chance 2X"; break;
			
			case 25: $rvcall = "Away Win Only"; break;
			case 26: $rvcall = "Home Win Only"; break;
			
			
		}

	}else{

		switch ($no)
		{
			case 1: $rvcall = "Call as Homes"; break;
			case 2: $rvcall = "Call as Aways "; break;
			case 3: $rvcall = "Call as Draws"; break;
			case 4: $rvcall = "Use PaW Calls"; break;
			case 10: $rvcall = "Call as Under 2.5"; break;
			case 11: $rvcall = "Call as Over 2.5"; break;
			
			case 12: $rvcall = "Call as Away Wins (WO)"; break;
			case 13: $rvcall = "Call as Home Wins (WO)"; break;
			case 14: $rvcall = "Call as Draws (1X2)"; break;
			
			case 16: $rvcall = "Home Win/Draw Calls"; break;
			case 17: $rvcall = "Away Win/Draw Calls"; break;
			
			case 20: $rvcall = "Double Chance 1X"; break;
			case 21: $rvcall = "Double Chance 12"; break;
			case 22: $rvcall = "Double Chance 2X"; break;
			
			case 25: $rvcall = "Away Win Only"; break;
			case 26: $rvcall = "Home Win Only"; break;

		}
	}
	
	return $rvcall;
}

	if ($_GET['CALLAS']> 0){
		$row3cap .= "&nbsp;<font color='red'>(Reversed - " . revCall($_GET['CALLAS'],$_GET['CALL']) . ")</font>";
	}
	
week_box_new_3rows("Soccer Predictions Analysis Tool", $weekno, $wdate, $season,$row3cap . "<br><font size='1' color='#000000'>$_prerid</font>",900); ?>
   

<div style='width:900px; margin:auto auto;text-align:justify;padding:8px 5px;font-size:10px;line-height:130%;font-family:verdana;'>
    
 The standard "Probabilities" (HW, D and AW) respectively refer to the chances of a Home Win, a Draw or an Away Win occurring.  The "DC Probabilities" refer to the chances of the named result occurring, where 1/X = Home Win or Draw and 2/X = Away Win or Draw. <br />
 
 
</div> 



<table cellpadding='2' border="1" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="1000" bgcolor="#F6F6F6">

<tr bgcolor="#d3ebab">
  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=''/></td>
  <td class='ctd' width="20%"   rowspan="2">
   
   <?if ($season==curseason($db)){ ?>
        <img src="images/tbcap/datepic.gif"  border='0' alt=''/>
    <? }else { ?>     
        <img  src="images/tbcap/date.gif"  border='0' alt=''/>
    <?}?> 
   
    </td>

    <td width="45%"  class='ctd' rowspan="2"><img src="images/tbcap/flist.gif" border='0' alt=''/></td>

  
    <td width="5%"  class='ctd' rowspan="2"><img src="images/tbcap/div.gif" border='0' alt=''/></td>
   <!-- <td width="5%"  class='ctd' rowspan="2"><img src="images/tbcap/pawrank.gif" border='0' alt=''/></td> -->
  
    <td width="6%"  class='ctd' rowspan="2"><img src="images/tbcap/asl.gif" border='0' alt=''/></td>
    <td width="6%"  class='ctd' rowspan="2"><img src="images/tbcap/act.gif" border='0' alt=''/></td>

    <td width="6%"  class='ctd' style='padding:0' rowspan="2"><img src="images/tbcap/asltotgls.gif" border='0' alt=''/></td>
    <td width="6%"  class='ctd dark' style='padding:0' rowspan="2"><img src="images/tbcap/actgls.gif" border='0' alt=''/></td>

 <? if ($_GET['BETTING']=="6"){?>
      <td class='ctd' rowspan="2" style='padding:0 20px'><img src="images/tbcap/h-cap.gif" border='0' alt=''/></td>
      <td class='ctd  dark' rowspan="2" style='padding:0 20px'><img src="images/tbcap/odds.gif" border='0' alt=''/></td>
   <?}?>
   
   
    <td class='ctd dark' colspan="3"><img src="images/tbcap/probs2.gif" border='0' alt=''/></td>
   
   <? if ($_GET['BETTING']<>"6"){?>
    <td class='ctd dark' colspan="2"><img src="images/tbcap/dcprobs2.gif" border='0' alt=''/></td>
   <? } ?> 
    
    <? if ($_GET['SORTBY']>6 and $_GET['SORTBY']<60){ ?>
        <td class='ctd dark' colspan="3"><img src="images/tbcap/1x2rebinfo.gif" border='0' alt=''/></td>
    <?}?>
    
    
    <? if ($_GET['SORTBY'] == 1 or $_GET['SORTBY'] == 2 or $_GET['SORTBY'] == 3 or $_GET['SORTBY']> 79){ ?>
        <td class='ctd dark' colspan="3"><img src="images/tbcap/1x2rebinfo.gif" border='0' alt=''/></td>
    <?}?>

    <? if ($_GET['SORTBY'] == 4 or $_GET['SORTBY'] == 5 or $_GET['SORTBY'] == 6){ ?>
        <td class='ctd dark' colspan="3"><img src="images/tbcap/dcrebinfo.gif" border='0' alt=''/></td>
    <?}?>
   
    <? if ($_GET['SORTBY'] == 60 or $_GET['SORTBY'] == 61 or $_GET['SORTBY'] == 62){ ?>
        <td class='ctd dark' colspan="3"><img src="images/tbcap/gprrebinfo.gif" border='0' alt=''/></td>
    <?}?>
    
   <? if ($_GET['SORTBY'] == 70 or $_GET['SORTBY'] == 71 or $_GET['SORTBY'] == 72){ ?>
        <td class='ctd dark' colspan="3"><img src="images/tbcap/airrebinfo.gif" border='0' alt=''/></td>
    <?}?>
    
    <? //if ($_GET['BETTING']==1){?>
        <td class='ctd' colspan="3"><img src="images/tbcap/odd2.gif" border='0' alt=''/></td>
    <?//}?>

    <? if ($_GET['BETTING']==2 or $_GET['CALLAS']==20 or $_GET['CALLAS']==21 or $_GET['CALLAS']==22){?>
        <td class='ctd' colspan="3"><img src="images/tbcap/dc_odds.gif" border='0' alt=''/></td>
    <?}?>
    
     <? if ($_GET['BETTING']==3){?>
        <td class='ctd' colspan="2"><img src="images/tbcap/winonly_odds.gif" border='0' alt=''/></td>
    <?}?>
    
     <? if ($_GET['BETTING']=="4" or $_GET['BETTING']=="5"){?>
        <td class='ctd' colspan="2"><img src="images/tbcap/uo_odds.gif" border='0' alt=''/></td>
     <?}?>
      <? if ($_GET['CALLAS']==5){?>	  
	  <td class='ctd' rowspan='2'><img src="images/tbcap/bookie_call.gif" border='0' alt=''/></td>
  <?}?>

</tr>

<tr bgcolor="#d3ebab">
  <td class='ctd'><img src="images/tbcap/homeW.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/d.gif" border='0' alt=''/></td>
  <td class='ctd dark'><img src="images/tbcap/aW.gif" border='0' alt=''/></td>
 
 <? if ($_GET['BETTING']<>"6"){?>
  <td class='ctd'><img src="images/tbcap/1xnew.gif" border='0' alt=''/></td>
  <td class='ctd dark'><img src="images/tbcap/2xnew.gif" border='0' alt=''/></td>
 <? } ?>
      
  <td class='ctd '><img src="images/tbcap/hteam-sm.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/ateam-sm.gif" border='0' alt=''/></td>
  <td class='ctd dark'><img src="images/tbcap/avg-sm.gif" border='0' alt=''/></td>
  
  <td class='ctd '><img src="images/tbcap/home.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/d.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/a.gif" border='0' alt=''/></td>


  <? if ($_GET['BETTING']==2 or $_GET['CALLAS']==20 or $_GET['CALLAS']==21 or $_GET['CALLAS']==22){?>
      <td class='ctd '><img src="images/tbcap/1xnew.gif" border='0' alt=''/></td>
      <td class='ctd'><img src="images/tbcap/2xnew.gif" border='0' alt=''/></td>
      <td class='ctd'><img src="images/tbcap/12new.gif" border='0' alt=''/></td>
  <?}?>

 <? if ($_GET['BETTING']==3){?>
      <td class='ctd '><img src="images/tbcap/htwin.gif" border='0' alt=''/></td>
      <td class='ctd'><img src="images/tbcap/atwin.gif" border='0' alt=''/></td>
  <?}?>
  
    <? if ($_GET['BETTING']=="4" or $_GET['BETTING']=="5"){?>
      <td class='ctd '><img src="images/tbcap/u25.gif" border='0' alt=''/></td>
      <td class='ctd'><img src="images/tbcap/o25.gif" border='0' alt=''/></td>
   <?}?>
   
  
  
</tr>

<?  
   
    
    if ($db=='eu'){
       $temp = $eu->prepare($query1) ;
       $temp->execute();
       $drops = $eu->prepare('drop TEMPORARY table `' . $filename ."`");
       $drops->execute();
       
    }else{
       $temp = $sa->prepare($query1);
       $temp->execute();
       $drops = $sa->prepare('drop TEMPORARY table `' . $filename ."`");
       $drops->execute();
    }
    

    
    $total_rec = $temp->rowCount();
    
    if ($temp->rowCount()==0){
       echo "<tr><td colspan='21' class='ctd' style='padding:30px;'><span class='error'>No Match for selected options</span></td></tr>";
    }else {
        
    $pic = "/pic/" ;
    $pic =  $weekno ."/pic";
    $number=0;
    $ngot =0 ;
    $css =0;
    $postponed = 0;
    $win_odds = 0;
     $nobets =  0;
	$my_value = "";
	
    while ($row = $temp->fetch()) {
     
     
        $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$_GET['season'],$db)){
         $pr = " pr2";
        }    
        
       
        $number++;
        $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;

            
        $title = "$row[hteam] v $row[ateam] match odds" ;
        $odd=0;
        //$odd = show_rebs($matchno,$_GET['weekno'],$_GET['season'],$_GET['MPRED'],$db);
  
        $asl_class =""; $asl_class2 ="";
        $dc_char = '';
       
	   
	    $asl_class2 = $asl_class ;
       
        
      switch ($_GET['BETTING']){
        	
        
        case 1:
            $captions = "For Singles 1X2 Betting";
            
            if ($_GET['CALL']<5){
				
				$_BOOKIECALL = 0;
				if ($row['mvalue']>0){
					
					switch ($_GET['CALLAS']) {
						case 0:
						case 1:
						case 2:
						case 3:
							$_rt_get = return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], $_GET['CALLAS']);
							$ngot += $_rt_get; // $row['gotit'] ;
							break;
						
						case 5:
							$_BOOKIECALL = $row["bookiecall"];
							$_rt_get = return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], $_BOOKIECALL);
							$ngot += $_rt_get; // $row['gotit'] ;
							break;
						
						default:
							$_rt_get = pat_rev_call($row["h_s"], $row["a_s"],$_GET['CALLAS']);
							$ngot += $_rt_get; //
							break;
					}
				
					
			
					if ($_rt_get == '1' ){
						$asl_class = " gotrt";
						$asl_class2 = $asl_class ;
						
						if ($_GET['CALLAS']==0){
						
							switch ($_GET['CALL']){
							  case 1: $win_odds+= $row['h_odd']; break;
							  case 2: $win_odds+= $row['a_odd']; break;
							  case 3: $win_odds+= $row['d_odd']; break;
							}
							
						}else{
						
							switch ($_GET['CALLAS']){
							  case 1: $win_odds+= $row['h_odd']; break;
							  case 2: $win_odds+= $row['a_odd']; break;
							  case 3: $win_odds+= $row['d_odd']; break;
							  case 5:
							  	$asl_class = " ";  // no CS correct for Bookie
								$asl_class2 = " ";

								switch ($_BOOKIECALL){
								  case 1: $win_odds+= $row['h_odd'];  $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
								  case 2: $win_odds+= $row['a_odd'];  $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
								  case 3: $win_odds+= $row['d_odd'];  $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
								}
								break;
								
								case 20: $win_odds+= $row['hw_x'];  $call_it= "1/X"; break;
								case 21: $win_odds+= $row['hw_aw']; $call_it= "1/2"; break;
								case 22: $win_odds+= $row['aw_x'];  $call_it= "2/X"; break;
								
								case 25: $win_odds+= $row['aw_odd']; break;
								case 26: $win_odds+= $row['hw_odd']; break;
								
							}
						}
					}
				}
			
			}else{
				//bookies call 1x2
				$asl_class = " ";  // no CS correct for Bookie
				$asl_class2 = " ";
				
				if ($row['mvalue']>0){
						switch ($_GET['CALL']){
						  
						  case 6: 

								$_rt_get = 0 ;
								$_rt_get = Rt_type($row['h_s'],$row['a_s']) ;
								
								if ($_GET['CALLAS']>0 and $_GET['CALLAS']<4){  // rev. home
									$_rt_get = ($_GET['CALLAS'] == $_rt_get ? 1 : 0); //
								}
								
								$act_rt = Rt_type($row["h_s"], $row["a_s"]);
								
								if($_GET['CALLAS']==4 ){ // rev. paw
									$_rt_get  =  return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], 0);
									$my_value = "  -- $_rt_get  " ;
								}
								
								if($_GET['CALLAS']==0){ // rev. paw
									$_rt_get  =  return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], 1);
								}
								
								if($_GET['CALLAS']>=20){ 
									$_rt_get = pat_rev_call($row["h_s"], $row["a_s"],$_GET['CALLAS']);
								}
								
								
								//$ngot += $_rt_get; //
	
								
								$ngot += ($_rt_get==1? 1 : 0 ) ;
								if ($_rt_get == 1){
									switch ($_GET['CALLAS']){
									  case 0: $win_odds+= $row['h_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 1: $win_odds+= $row['h_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 2: $win_odds+= $row['a_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 3: $win_odds+= $row['d_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 4: 
										switch ($act_rt){
											case 1: $win_odds+= $row['h_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
											case 2: $win_odds+= $row['a_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
											case 3: $win_odds+= $row['d_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
										}
										
										case 20: $win_odds+= $row['hw_x'];  $call_it= "1/X"; $asl_class = " gotrt"; $asl_class2 = $asl_class;  break;
										case 21: $win_odds+= $row['hw_aw']; $call_it= "1/2"; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
										case 22: $win_odds+= $row['aw_x'];  $call_it= "2/X"; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
										
										case 25: $win_odds+= $row['aw_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class;  break;
										case 26: $win_odds+= $row['hw_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class;  break;
									}
								}
								
								break;
						  
						  case 7:
								//$win_odds+= ($row['a_s']>$row['h_s']?  $row['a_odd'] : 0) ;
								//$ngot += ($row['a_s']>$row['h_s']? 1 : 0) ;
								//$_rt_get = return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], $_GET['CALLAS']);
								
								$_rt_get = 0 ;
								$_rt_get = Rt_type($row['h_s'],$row['a_s']) ;
								
								$act_rt = Rt_type($row["h_s"], $row["a_s"]);
								
								if ($_GET['CALLAS']>0 and $_GET['CALLAS']<4){  // rev. home
									$_rt_get = ($_GET['CALLAS'] == $_rt_get ? 1 : 0); //
								}
								
								if($_GET['CALLAS']==4){ // rev. paw
									$_rt_get  =  return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], 0);
								}
								
								if($_GET['CALLAS']==0){ // rev. paw
									$_rt_get  =  return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], 2);
								}
								
								
								$ngot += ($_rt_get==1? 1 : 0 ) ;
								if ($_rt_get == 1){
									switch ($_GET['CALLAS']){
									  case 0: $win_odds+= $row['a_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 1: $win_odds+= $row['h_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 2: $win_odds+= $row['a_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 3: $win_odds+= $row['d_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 4: 
										switch ($act_rt){
											case 1: $win_odds+= $row['h_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
											case 2: $win_odds+= $row['a_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
											case 3: $win_odds+= $row['d_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
										}
									}
								}
								
								break;
						  
						  case 8:
								//$win_odds+= ($row['h_s']==$row['a_s']?  $row['d_odd'] : 0) ;
								//$ngot += ($row['h_s']==$row['a_s']? 1 : 0) ;
								$_rt_get = 0 ;
								$_rt_get = Rt_type($row['h_s'],$row['a_s']) ;
								
								$act_rt = Rt_type($row["h_s"], $row["a_s"]);
								
								if ($_GET['CALLAS']>0 and $_GET['CALLAS']<4){  // rev. home
									$_rt_get = ($_GET['CALLAS'] == $_rt_get ? 1 : 0); //
								}
								
								if($_GET['CALLAS']==4){ // rev. paw
									$_rt_get  =  return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], 0);
								}
								
								if($_GET['CALLAS']==0){ // rev. paw
									$_rt_get  =  return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], 3);
								}
								
								$ngot += ($_rt_get==1? 1 : 0 ) ;
								if ($_rt_get == 1){
									switch ($_GET['CALLAS']){
									  case 0: $win_odds+= $row['d_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 1: $win_odds+= $row['h_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 2: $win_odds+= $row['a_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 3: $win_odds+= $row['d_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
									  case 4: 
										switch ($act_rt){
											case 1: $win_odds+= $row['h_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
											case 2: $win_odds+= $row['a_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
											case 3: $win_odds+= $row['d_odd']; $asl_class = " gotrt"; $asl_class2 = $asl_class; break;
										}
									}
								}
								break;
						}
					
				
				}
				
			}
            break;
        
		
		
		
        case 2:     // double change WIN or Draw
             $captions = "For Singles Double Chance Betting";
              if ($row['mvalue']>0){
				    $call_it = "";
					if ($_GET['CALLAS']==0){
					switch ($_GET['CALL']){
					   case 1:
					   case 2:						
					   $dc_char = dc_char($row['h_s'], $row['a_s'], $row['hgoal'], $row['agoal']);   
					   if ($dc_char=="Y"){
						 $asl_class = " gotrt"; $ngot ++;
							 switch ($_GET['CALL']){
							  case 1: $win_odds+= $row['hw_x']; $call_it = "1/X"; break;
							  case 2: $win_odds+= $row['aw_x']; $call_it = "2/X"; break;
							}
					   }
					   break;
					   
					   case 16: // bookie call home win /draw
						   $dc_char = dc_char($row['h_s'], $row['a_s'], 1, 0);   
						   if ($dc_char=="Y"){
							 $asl_class = " gotrt"; $ngot ++;
								 switch ($_GET['CALL']){
								  case 16: $win_odds+= $row['hw_x']; $call_it = "1/X"; break;
								  case 17: $win_odds+= $row['aw_x']; $call_it = "2/X"; break;
								}
						   }
						break;
						
					   case 17: // bookie call away win /draw
						   $dc_char = dc_char($row['h_s'], $row['a_s'], 0, 1);   
						   if ($dc_char=="Y"){
							 $asl_class = " gotrt"; $ngot ++;
								 switch ($_GET['CALL']){
								  case 16: $win_odds+= $row['hw_x']; $call_it = "1/X"; break;
								  case 17: $win_odds+= $row['aw_x']; $call_it = "2/X"; break;
								}
						   }
					   break;
					}
					
					}else{  // reversed call 
						$act_rt =  Rt_type($row['h_s'], $row['a_s']);
						$call_it = "";
						switch ($_GET['CALLAS']){
							case 7: 
								if ($act_rt ."/X" == "2/X" ){
									$asl_class = " gotrt"; $ngot ++;
									$win_odds += $row['aw_x']; 
									$call_it = "2/X";
								}	
								if ($act_rt ."/X" == "3/X" ){
									$asl_class = " gotrt"; $ngot ++;
									$win_odds += $row['aw_x']; 
									$call_it = "2/X";
								}	
								
								break;

							case 8: 
								if ($act_rt ."/X" == "1/X" ){
									$asl_class = " gotrt"; $ngot ++;
									$win_odds += $row['hw_x']; 
									$call_it = "1/X";
								}
								if ($act_rt ."/X" == "3/X" ){
									$asl_class = " gotrt"; $ngot ++;
									$win_odds += $row['hw_x']; 
									$call_it = "1/X";
								}										
								break;
								
							case 9: 
								if ( ($act_rt ."/2" == "1/2") or ($act_rt ."/1" == "2/1") ){
									$asl_class = " gotrt"; $ngot ++;
									$win_odds += $row['hw_aw']; 
									$call_it = "1/2";
								}			
								break;

						}
					}	
               }
            break;
        
        case 3:  // Win only 
            $captions = "For Singles Win Only Betting";
            if ($row['mvalue']>0){
				
				if ($_GET['CALLAS'] == 0) {
                
					switch ($_GET['CALL']){
					   case 1:
					   case 2:
						   $dc_char = Winonly_char($row['h_s'], $row['a_s'], $row['hgoal'], $row['agoal']);   
					    
						   if ($dc_char=="Y"){
							 $asl_class = " gotrt"; $ngot ++;
								 switch ($_GET['CALL']){
								  case 1: $win_odds+= $row['hw_odd']; break;
								  case 2: $win_odds+= $row['aw_odd']; break;
								}
						   }
						   break;
						 
						case 11: // bookie home win 
						   $dc_char = Winonly_char($row['h_s'], $row['a_s'], 1, 0);   
						   if ($dc_char=="Y"){
							 $asl_class = " gotrt"; $ngot ++;
								 switch ($_GET['CALL']){
								  case 11: $win_odds+= $row['hw_odd']; break;
								  case 12: $win_odds+= $row['aw_odd']; break;
								}
						   }
						   break;						   
						   
						   case 12: // bookie away win
							   $dc_char = Winonly_char($row['h_s'], $row['a_s'], 0, 1);   
							   if ($dc_char=="Y"){
								 $asl_class = " gotrt"; $ngot ++;
									 switch ($_GET['CALL']){
									  case 11: $win_odds+= $row['hw_odd']; break;
									  case 12: $win_odds+= $row['aw_odd']; break;
									}
							   }
							
							break;

				   }
			   
				}else{
					switch ($_GET['CALLAS']){
						case 12:  // call as Away Wins only Draw NB
							$act_rt = Rt_type($row['h_s'], $row['a_s']) ;
							switch ($act_rt){
								case 3: $dc_char = "N/A"; break;
								case 2:  $asl_class = " gotrt"; $ngot ++; $win_odds+= $row['aw_odd'];  break;
							}
							break;
						
						case 13:
							$act_rt = Rt_type($row['h_s'], $row['a_s']) ;
							switch ($act_rt){
								case 3: $dc_char = "N/A"; break;
								case 1:  $asl_class = " gotrt"; $ngot ++; $win_odds+= $row['hw_odd'];  break;
							}
							break;
						
						case 14:
							$act_rt = Rt_type($row['h_s'], $row['a_s']) ;
							switch ($act_rt){
								case 1: $dc_char = ""; break;
								case 2: $dc_char = ""; break;
								case 3:  $asl_class = " gotrt"; $ngot ++; $win_odds+= $row['d_odd'];  break;
							}
							
							break;
					}	
					
				}
				
				if ($dc_char=="NB" or $dc_char=="N/A"){
					$nobets++;
			   }
				$asl_class2=$asl_class;
             }
            break;
            
        case 4: // under over 2.5
        case 5:
            //callas = 10 Under    and   callas = 11 Over 
			
			$captions = ($_GET['BETTING']==4? "For Singles Under 2.5 Goals Betting" : "For Single Over 2.5 Goals Betting");
            $asl_sum = $row["hgoal"] + $row["agoal"] ;
            $act_sum = $row["h_s"] + $row["a_s"] ;
            
            if ($row['mvalue']>0){
				if ($_GET['CALLAS'] == 0) {
				
					if ($_GET['CALL'] < 4 ){
						
						if ($asl_sum>2.5 and $act_sum>2.5){
							$asl_class = " gotrt"; $ngot ++;
							$win_odds+= $row['ov_odd']; 
						}
						
						if ($asl_sum<2.5 and $act_sum<2.5){
							$asl_class = " gotrt"; $ngot ++;
							$win_odds+= $row['un_odd']; 
						}
						
					}else{
						
						if ($act_sum>2.5 and $_GET['BETTING']== 5){
							$asl_class = " gotrt"; $ngot ++;
							$win_odds+= $row['ov_odd']; 
						}
						
						if ($act_sum<2.5 and $_GET['BETTING']== 4 ){
							$asl_class = " gotrt"; $ngot ++;
							$win_odds+= $row['un_odd']; 
						}
					
					}
				
				}else{
				//rev calls //callas = 10 Under    and   callas = 11 Over 
					if ($_GET['CALL'] < 4 ){ // paw
						
						if ($_GET['CALLAS']==10 and $act_sum<2.5){
							$asl_class = " gotrt"; $ngot ++;
							$win_odds+= $row['un_odd']; 
						}
						
						if ($_GET['CALLAS']==11 and $act_sum>2.5){
							$asl_class = " gotrt"; $ngot ++;
							$win_odds+= $row['ov_odd']; 
						}
						
					}else{  // bookies 
						
						if ($act_sum<2.5 and $_GET['CALLAS']==10){
							$asl_class = " gotrt"; $ngot ++;
							$win_odds+= $row['un_odd']; 
						}
						
						if ($act_sum>2.5 and$_GET['CALLAS']==11){
							$asl_class = " gotrt"; $ngot ++;
							$win_odds+= $row['ov_odd']; 
						}
					
					}				
				
				
				
				}
				
				
				
				$asl_class2=$asl_class;
            }
			
			
            break;
			
		
       } 
        
        
      
      
        if ($row['h_s']=='P'){
            $asl_class = " pp";
            $postponed++;
           
        }
        
		if ($_GET['CALL']<3 and $_GET['CALLAS']==0){
			if ($asl==$act){
				$asl_class = " gotasl";
				$css ++;
			}
		}
		
	

?>  
<tr <?echo rowcol($number);?> class='row'>

    <td class="ctd padd"><?echo $number; ?></td>
     <?if ($season==curseason($db)){ ?>                                   
     <td class="ctd "><a class='md2' <?echo $ffh;?> href="javascript:tell('team-performance-chart.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>
     <?}else{?>
     <td class="ctd "><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></td>
     <?}?>

     <td class='padd'><?echo $row['hteam'] . printv(' v ') . $row['ateam'];?>
     </td>
     
     <td class="ctd"><?echo ($row["div"]); ?></td>
    <!-- <td class="ctd"><?echo ($row["pawrank"]); ?></td> -->
    
    
	<?php if ($_GET['CALL']>3 and $_GET['CALLAS']==0) { ?>
		<td class="ctd <?echo $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'] ;?></td>
		<td class="ctd  <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
	<?php } ?>
	
	<?php if ($_GET['CALL']>3 and ($_GET['CALLAS']>0 and $_GET['CALLAS']<4) ) { ?>
		<td class="ctd <?echo $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'] ;?></td>
		<td class="ctd  <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
	<?php } ?>
	
	<?php if ($_GET['CALLAS']>0 and $_GET['CALLAS']>4)  { ?>
		<td class="ctd <?echo $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'] ;?></td>
		<td class="ctd  <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
	<?php } ?>
	
	<?php if ($_GET['CALL']<=3 and ($_GET['CALLAS']>0 and $_GET['CALLAS']<4) ) { ?>
		<td class="ctd <?echo $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'] ;?></td>
		<td class="ctd  <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
    <?php } ?>
	
	
	<?php if ($_GET['CALL']<=3 and $_GET['CALLAS']==0) { ?>
		<td class="ctd <?echo $asl_class . $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'] ;?></td>
		<td class="ctd  <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
    <?php } ?>
	
	<?php if ($_GET['CALL']>3 and $_GET['CALLAS']==4) { ?>
		<td class="ctd <?echo $asl_class . $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'] ;?></td>
		<td class="ctd"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
	<?php } ?>
	


    <?php if ($_GET['CALL']==2){?>
      <td class="ctd" <?echo ($_GET["SORTBY"]=='13'? "bgcolor='#D3EBAB'": "");?>><?echo num0($row['agoal'] + $row['hgoal']); ?></td>
    <?}else{?>  
      <td class="ctd" <?echo ($_GET["SORTBY"]=='13'? "bgcolor='#D3EBAB'": "");?>><?echo num0($row['hgoal'] + $row['agoal']); ?></td>
    <?}?>
	
	<?php if($row['mvalue']==1){?>
		<td class="ctd dark"><?echo num0($row['a_s'] + $row['h_s']); ?></td>
	<?php }else{ ?>
     	<td class="ctd dark">-</td>
	<?php } ?>
	
	<?php if($_GET["BETTING"]=="6") { ?>
		<td class="ctd" <?echo (($_GET["SORTBY"]=='82' or $_GET["SORTBY"]=='83') ? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ht_hcap"] ." / " . $row["at_hcap"]); ?></td>
	    <td class="ctd dark" <?echo (($_GET["SORTBY"]=='80' or $_GET["SORTBY"]=='81') ? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ht_odd"] ." / ". $row["at_odd"]); ?></td>
	<?php } ?>
    
    <td class="ctd" <?echo ($_GET["SORTBY"]=='7'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["hwinpb"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='9'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["drawpb"]); ?></td>
    <td class="ctd dark" <?echo ($_GET["SORTBY"]=='8'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["awinpb"]); ?></td>

 	<? if ($_GET['BETTING']<>"6"){?>
	    
	    <td class="ctd" <?echo ($_GET["SORTBY"]=='50'? "bgcolor='#D3EBAB'": "");?>><?echo num2(round($row["x1probs"]))  ; ?></td>
	    <td class="ctd dark" <?echo ($_GET["SORTBY"]=='51'? "bgcolor='#D3EBAB'": "");?>><?echo num2(round($row["x2probs"])); ?></td>
   
   <? } ?>
   
    <? if ($_GET['SORTBY']>6 and $_GET['SORTBY']<60){ ?>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='1'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ptr_ht"]); ?></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='2'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ptr_at"]); ?></td>
        <td class="ctd dark" <?echo ($_GET["SORTBY"]=='3'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ptr_av"]); ?></td>
    <?}?>
    
    <? if ($_GET['SORTBY'] == 1 or $_GET['SORTBY'] == 2 or $_GET['SORTBY'] == 3){ ?>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='1'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ptr_ht"]); ?></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='2'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ptr_at"]); ?></td>
        <td class="ctd dark" <?echo ($_GET["SORTBY"]=='3'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ptr_av"]); ?></td>
    <?}?>
    
    <? if ($_GET['SORTBY'] == 4 or $_GET['SORTBY'] == 5 or $_GET['SORTBY'] == 6 or $_GET['SORTBY']>79){ ?>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='4'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_ht"]); ?></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='5'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_at"]); ?></td>
        <td class="ctd dark" <?echo ($_GET["SORTBY"]=='6'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_av"]); ?></td>     
    <?}?>
    
    <? if ($_GET['SORTBY'] == 60 or $_GET['SORTBY'] == 61 or $_GET['SORTBY'] == 62){ ?>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='60'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["gpr_ht"]); ?></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='61'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["gpr_at"]); ?></td>
        <td class="ctd dark" <?echo ($_GET["SORTBY"]=='62'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["gpr_av"]); ?></td>     
    <?}?>
   
    <? if ($_GET['SORTBY'] == 70 or $_GET['SORTBY'] == 71 or $_GET['SORTBY'] == 72){ ?>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='70'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["air_ht"]); ?></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='71'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["air_at"]); ?></td>
        <td class="ctd dark" <?echo ($_GET["SORTBY"]=='72'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["air_av"]); ?></td>     
    <?}?>    
    
	
    <? if ($_GET['CALLAS']==0){?>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and ($_GET['CALL']=='1' or $_GET['CALL']=='6') ) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='10'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["h_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and ($_GET['CALL']=='3' or $_GET['CALL']=='8')) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='12'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["d_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and ($_GET['CALL']=='2' or $_GET['CALL']=='7')) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='11'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["a_odd"]); ?></a></td>
    <?}?>
	
	
	 <? if ($_GET['BETTING']==1 and ($_GET['CALLAS']>0 and $_GET['CALLAS']<4) ){?>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and ($_GET['CALLAS']=='1' or $_GET['CALLAS']=='6') ) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='10'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["h_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and ($_GET['CALLAS']=='3' or $_GET['CALLAS']=='8')) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='12'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["d_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and ($_GET['CALLAS']=='2' or $_GET['CALLAS']=='7')) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='11'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["a_odd"]); ?></a></td>
    <?}?>


	<? if ($_GET['BETTING']>=3 and $_GET['CALLAS']>4 and $_GET['CALLAS']<14 ){?>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and ($_GET['CALLAS']=='1' or $_GET['CALLAS']=='6') ) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='10'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["h_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and ($_GET['CALLAS']=='3' or $_GET['CALLAS']=='8')) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='12'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["d_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and ($_GET['CALLAS']=='2' or $_GET['CALLAS']=='7')) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='11'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["a_odd"]); ?></a></td>
    <?}?>
	
	<? if ($_GET['BETTING']>=3 and $_GET['CALLAS']==14  ){?>
        <td class="ctd <?echo (($_GET["BETTING"]=='3' and ($_GET['CALLAS']=='1' or $_GET['CALLAS']=='6') ) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='10'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["h_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='3' and ($_GET['CALLAS']=='14' or $_GET['CALLAS']=='8')) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='12'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["d_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='3' and ($_GET['CALLAS']=='2' or $_GET['CALLAS']=='7')) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='11'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["a_odd"]); ?></a></td>
    <?}?>
	
	 <? if ($_GET['BETTING']==1 and $_GET['CALLAS']==4 ){?>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and $act_rt==1)  ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='10'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["h_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and $act_rt==3) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='12'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["d_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and $act_rt==2) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='11'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["a_odd"]); ?></a></td>
    <?}?>
	
	
	
	
	<!-- Use Bookie Call -->
	 <? if ($_GET['BETTING']==1 and $_GET['CALLAS']==5 ){?>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and $_BOOKIECALL==1)  ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='10'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["h_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and $_BOOKIECALL==3) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='12'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["d_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and $_BOOKIECALL==2) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='11'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["a_odd"]); ?></a></td>
		
		<td class="ctd <?echo $asl_class2;?>">
		<?php 
			switch ($row["bookiecall"]){
				case 1: echo "1"; break;
				case 2: echo "2"; break;
				case 3: echo "X"; break;
			}	
		  
		?></td>
		
    <?}?>
	
	<!-- outright rev calls -->
	<? if ($_GET['BETTING']==1 and ($_GET['CALLAS']==20 or $_GET['CALLAS']==21 or $_GET['CALLAS']==22 )  ){?>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and $_BOOKIECALL==1)  ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='10'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["h_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and $_BOOKIECALL==3) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='12'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["d_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='1' and $_BOOKIECALL==2) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='11'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["a_odd"]); ?></a></td>
		
		
		<td class="ctd <?echo ($call_it == "1/X" ?  $asl_class: "")?>" <?echo ($_GET["SORTBY"]=='20'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["hw_x"]); ?></a></td>
        <td class="ctd <?echo ($call_it == "2/X" ?  $asl_class: "")?>" <?echo ($_GET["SORTBY"]=='21'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["aw_x"]); ?></a></td>
        <td class="ctd <?echo ($call_it == "1/2" ?  $asl_class: "")?>" <?echo ($_GET["SORTBY"]=='22'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["hw_aw"]);?></a></td>
		
    <?}?>	
	
	<? if ($_GET['BETTING']==2 and $_GET['CALLAS']>0){?>
        <td class="ctd"><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["h_odd"]); ?></a></td>
        <td class="ctd"><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["d_odd"]); ?></a></td>
        <td class="ctd"><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["a_odd"]); ?></a></td>
	<?}?>
	
    <? if ($_GET['BETTING']==2){?>
	
        <td class="ctd <?echo ($call_it == "1/X" ?  $asl_class: "")?>" <?echo ($_GET["SORTBY"]=='20'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["hw_x"]); ?></a></td>
        <td class="ctd <?echo ($call_it == "2/X" ?  $asl_class: "")?>" <?echo ($_GET["SORTBY"]=='21'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["aw_x"]); ?></a></td>
        <td class="ctd <?echo ($call_it == "1/2" ?  $asl_class: "")?>" <?echo ($_GET["SORTBY"]=='22'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["hw_aw"]);?></a></td>
    <?}?>

	<!-- added bookies call 11 dec 2015 -->
    <? if ($_GET['BETTING']==3 and  $_GET['CALLAS']== 0 ){?>
        <td class="ctd <?echo (($_GET["BETTING"]=='3' and ($_GET['CALL']==1 or $_GET['CALL']==11)) ?  $asl_class: "")?>" <?echo ($_GET["SORTBY"]=='30'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["hw_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='3' and ($_GET['CALL']==2 or $_GET['CALL']==12)) ?  $asl_class: "")?>" <?echo ($_GET["SORTBY"]=='31'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["aw_odd"]); ?></a></td>
    <?}?>

	
	
    <? if ($_GET['BETTING']==3 and $_GET['CALLAS']>10){?>
        <td class="ctd <?echo (($_GET["BETTING"]=='3' and $_GET['CALLAS']==13) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='30'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["hw_odd"]); ?></a></td>
        <td class="ctd <?echo (($_GET["BETTING"]=='3' and $_GET['CALLAS']==12) ?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='31'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["aw_odd"]); ?></a></td>
    <?}?>
	
    <? if ($_GET['BETTING']==4 and $_GET['CALLAS']==0){?>
        <td class="ctd <?echo ($_GET["BETTING"]=='4'?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='40'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["un_odd"]); ?></a></td>
        <td class="ctd <?echo ($_GET["BETTING"]=='5'?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='41'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["ov_odd"]); ?></a></td>
    <?}?>

    <? if ($_GET['BETTING']==4  and $_GET['CALLAS']==11){?>
        <td class="ctd <?echo ($_GET["BETTING"]=='5'?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='40'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["un_odd"]); ?></a></td>
        <td class="ctd <?echo ($_GET["BETTING"]=='4'?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='41'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["ov_odd"]); ?></a></td>
    <?}?>

    <? if ($_GET['BETTING']==5 and $_GET['CALLAS']==0){?>
        <td class="ctd <?echo ($_GET["BETTING"]=='4'?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='40'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["un_odd"]); ?></a></td>
        <td class="ctd <?echo ($_GET["BETTING"]=='5'?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='41'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["ov_odd"]); ?></a></td>
    <?}?>

    <? if ($_GET['BETTING']==5  and $_GET['CALLAS']==10){?>
        <td class="ctd <?echo ($_GET["BETTING"]=='5'?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='40'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["un_odd"]); ?></a></td>
        <td class="ctd <?echo ($_GET["BETTING"]=='4'?  $asl_class2: "")?>" <?echo ($_GET["SORTBY"]=='41'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["ov_odd"]); ?></a></td>
    <?}?>
</tr>

<?    }
    }  


if ($_GET['weekno'] <> cur_week($db)) {
?>
<tr bgcolor="#f4f4f4">
    
    
    <td colspan="3" class="rtd padd bot">Total Correct Calls&nbsp; </td>
    <td colspan="1" class="ctd padd bot"><?echo $ngot; ?></td>
    <td colspan="2" class="ctd padd bot"><?echo ($number-$postponed-$nobets>0 ? num2(($ngot/($number-$postponed-$nobets))*100) ."%" : "0.00%") ; ?></td>

    <td colspan="5" class="rtd padd bot">Total Correct Score Hits (PaW)&nbsp;</td>
    <td colspan="1" class="ctd padd bot"><?echo $css; ?></td>

    <td colspan="<?echo ($_GET['BETTING']>1? 8 : 6 ); ?>" class="rtd padd bot">Postponed/Void Matches&nbsp;</td>
    <td colspan="<?echo ($_GET['BETTING']<3? 2 : 1 ); ?>" class="ctd padd bot"><?echo $postponed +$nobets; ?></td>
 
  </tr> 
  <tr bgcolor="#f4f4f4">
    <td colspan="4" class="rtd padd bot">Units Laid Out&nbsp;</td>
    <td colspan="2" class="ctd padd bot"><?echo num2($number-$postponed-$nobets); ?></td>
    <td colspan="2" class="rtd padd bot">Units Won&nbsp;</td>
    <td colspan="2" class="ctd padd bot"><?echo num2($win_odds); ?></td>
    <td colspan="2" class="rtd padd bot"> Profit/(Loss)&nbsp;</td>

    <?php if($win_odds - ($number-$postponed-$nobets)>=0){?>
      <td colspan="2" class="ctd padd bot" style='color:blue;'><?echo num20($win_odds - ($number-$postponed-$nobets)) ; ?></td>
    <?php }else {?>
      <td colspan="2" class="ctd padd bot"  style='color:red;'><?echo num20($win_odds - ($number-$postponed-$nobets)) ; ?></td>
    <?php }?>
    <td colspan="<?echo ($_GET['BETTING']>1? 8 : 6 ); ?>" class="ctd padd bot">&nbsp;<?echo $captions; ?>  </td>
  </tr>  
<?}?>


</table>

<?

	
 foreach($_GET as $key => $value){
    
    $url .= "$key=" . $value . "&";
 }
 
 $summaryURL = "javascript:tell('weekbyweeksummary.php?" . substr($url, 0, strlen($url)-14) ."')" ;
?>
<div class='error_div' style="text-align: center;padding:10px;width:500px;margin:10px auto 10px auto">
	

    <a href="<? echo $summaryURL ?>"><span class="bb" style="font-size: 18px;">Summary for Season <?echo $_GET['season'];?></span></a>
</div>

<!-- stopprint -->

<?php }?>


<a href="javascript:tell('weekbyweeksummary.php?db=eu&season=2015-2016&weekno=26&DIV=1&BETTING=1&SORTBY=10&ordered=1&PERIOD=1&CALL=6&PROPTION=2&ASL2GET=all&limitedto=0&min_odd=1.36&max_odd=1.5&CALLPARAM=0&CALLAS=3')"></a>

</body>

</html>

<?php
  $eu = null;
  $sa = null;
  $sp = null;
  
?>