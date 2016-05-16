<?php

require("config.ini.php");
require("function.ini.php");
require("combinations.php");


?>


<table cellpadding='2' border="1" style="border-collapse: collapse;" bordercolor="#CDCDCD" width="100%" bgcolor="#F6F6F6">
<tr bgcolor="#d3ebab">
    <td class="ctd" width="20%"><img src="images/tbcap/wkno.gif" border='0' alt=''/></td>
    <td class="ctd" width="20%"><img src="images/tbcap/unit_laid.gif" border='0' alt=''/></td>
	<td class="ctd" width="20%"><img src="images/tbcap/total_correct_calls.gif" border='0' alt=''/></td>
    <td class="ctd" width="20%"><img src="images/tbcap/units_won.gif" border='0' alt=''/></td> 
    <td class="ctd" width="20%"><img src="images/tbcap/profit_loss.gif" border='0' alt=''/></td> 
 </tr>




<?php

$db = $_GET["db"];
$season = $_GET["season"];

$odd_maxdiff =  20;
 
 $Tcorect_calls = 0 ; 
 $Tnumber=0; $Tngot =0 ;  $Tcss =0;  $Tpostponed = 0;  $Twin_odds = 0;  $Tnobets =  0; 
 $win_week=0; $loss_week=0; $max_losses=0; $prv_week=0;
 
 if ($_GET['season']==curseason($_GET['db']) ){
   $max_week = cur_week($_GET['db']) - 1;
   
 }else{  
   $max_week = find_last_week_of_season($_GET['season'],$_GET['db']);
 }
// find_last_week_of_season($season,$_GET['db'])



$onlyAsl = "";

if ($_GET['ASL2GET']=='all'){
	$onlyAsl = "";
}else{
	$onlyAsl = " and f.hgoal = '" . substr($_GET['ASL2GET'],0,1) . "' and f.agoal = '" . substr($_GET['ASL2GET'],1,1) . "'" ;
}

$debugging = 0; // if 1 = create TABLE  if 0 = create temparary file
$Checking_weekno = 12;	


//for ($weekno=$Checking_weekno; $weekno<=$Checking_weekno; $weekno++){


for ($weekno=1; $weekno<=$max_week; $weekno++){	

 $number=0; $weekly_wins = 0; $win_odds = 1;
	 
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
        case 4: $call = " "; $row3cap = "All Call Types";  break;
		
		// need to add coodes here for bookie calls
		case 6: $call = " and f.bookiecall = '1' "; $row3cap = "Home Win Calls (Bookies)"; break;
        case 7: $call = " and f.bookiecall = '2' "; $row3cap = "Away Win Calls (Bookies)"; break;
        case 8: $call = " and f.bookiecall = '3' "; $row3cap = "Draw Calls (Bookies)"; break;
	
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
        
        case 40: $ordered_by = " ORDER BY o.un_odd $ordered, f.hwinpb desc, r.ptr_ht desc "; break;
        case 41: $ordered_by = " ORDER BY o.ov_odd $ordered, f.awinpb desc, r.ptr_at desc "; break;
        
        case 50: $ordered_by = " ORDER BY x1probs $ordered, f.hwinpb desc "; break;
        case 51: $ordered_by = " ORDER BY x2probs $ordered, f.awinpb desc "; break;
        
        case 60: $ordered_by = " ORDER BY gpr_ht $ordered, f.hwinpb desc "; break;
        case 61: $ordered_by = " ORDER BY gpr_at $ordered, f.awinpb desc "; break;
        case 62: $ordered_by = " ORDER BY gpr_av $ordered "; break;
        
        case 70: $ordered_by = " ORDER BY air_ht $ordered , f.hwinpb desc"; break;
        case 71: $ordered_by = " ORDER BY air_at $ordered , f.awinpb desc"; break;
        case 72: $ordered_by = " ORDER BY air_av $ordered "; break;
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

      case  3: 
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
                
                if ($_GET['SORTBY']==40){
                   $filter = " and o.un_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
                }
                if ($_GET['SORTBY']==41){
                  $filter = " and o.ov_odd between '" . $_GET['min_odd']  . "' and '".  $_GET['max_odd'] ."'"; break;
                }
            
            case 2:

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
        
        switch ($_GET['DIV']){
            
            case '0': $_divs = " and f.`div` IN ('EP','SP','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
            case '1': $_divs = " and f.`div` IN ('EP','C0','C1','C2','SP','S1','S2','S3','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
            case '2': $_divs = " and f.`div` IN ('NC', 'UP', 'RP', 'MP') "; break;
			case '99': $_divs = "  " ; break;
            default: $_divs = " and f.`div` = '" . $_GET['DIV'] . "' "; break;
        }
        
    }else{
        switch ($_GET['DIV']){
            
            case '0': $_divs = " and f.`div` IN ('MLS','BRA','BRB') "; break;
            default: $_divs = " and f.`div` = '" . $_GET['DIV'] . "' "; break;
        }
        
    }  
    
      
   $limited = "";

    if ($_GET['limitedto']>0){
        $limited = " limit " . $_GET['limitedto'];
    }
    

	  
   $query1 = $qry .$proption . $onlyAsl . $_divs . $period . $call . $filter . $callpar . $ordered_by .   $limited ;
   
   if  ($weekno==$Checking_weekno){
     // echo $query1;
   }
    //echo $_GET['max_odd'];
	
    if (!isset($_SESSION['userid'])){
        $filename = "tmp_" . time() ;
  
    }else{
      $filename = "tmp_" . trim($_SESSION['userid']) ;
    }
	//echo $filename;

	
   if ($debugging == 1){
		$xx = "CREATE TABLE " . $filename . " (".$query1.")";
   }else{
		$xx = "CREATE TEMPORARY TABLE " . $filename . " (".$query1.")";
   }
  
   
	
	


	
   // if ($weekno==30) echo "<pre>" . print_r($_GET) . "</pre>";
    
    if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();
	

	
    
	//echo $filter;
	
   // echo $temp->rowcount();
   
   $xx = "alter table " . $filename . " ADD COLUMN `pawcall` int first";
   if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();
   
   
   $xx = "alter table " . $filename . " ADD COLUMN `dcoutcome` int first";
   if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();
   
   $xx = "alter table " . $filename . " ADD COLUMN `overoutcome` int first";
   if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();

   $xx = "alter table " . $filename . " ADD COLUMN `underoutcome` int first";
   if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();
	
   $xx = "alter table " . $filename . " ADD COLUMN `no_win` int first";
   if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();

   $xx = "alter table " . $filename . " ADD COLUMN `winoutcome` int first";
   if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();

   $xx = "alter table " . $filename . " ADD COLUMN `rid` int NOT NULL AUTO_INCREMENT primary key first";
   if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();
	
	//added for bookies call Win Only / Double Chances 
	switch ($_GET['CALL']){
		case 11: $xx = "update $filename set hgoal = '1' , agoal = '0' "; break; // bookies Home wins ONLY
		case 12: $xx = "update $filename set hgoal = '0' , agoal = '1' "; break; // bookies Away wins ONLY
		
		case 16: $xx = "update $filename set hgoal = '1' , agoal = '0' "; break; // bookies Home wins/Draw dc
		case 17: $xx = "update $filename set hgoal = '0' , agoal = '1' "; break; // bookies Away wins/Draw dc
	}
  
	
   if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();
	unset($xx);
		
		
	$xx = "select * from $filename";
    if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
   $temp->execute();

	

	 
	while ($rows = $temp->fetch()){

		
		$over_outcome = 0; $under_outcome = 0; $dc_outcome = 0; $win_outcome = 0; $no_win_bet = 0; $weekly_correct = 0; $_BOOKIECALL = 0 ; $no_win_number = 0;
		
		$_BOOKIECALL = $rows['bookiecall'];
		
		$asl_sum = $rows["hgoal"] + $rows["agoal"] ;
        $act_sum = $rows["h_s"] + $rows["a_s"] ;
	
		$dc_char = dc_char($rows['h_s'], $rows['a_s'], $rows['hgoal'], $rows['agoal']);   
		$win_char = Winonly_char($rows['h_s'], $rows['a_s'], $rows['hgoal'], $rows['agoal']);   
		
		$nrid = $rows['rid'] ;
		
		$nGotSql = " ";
		
		
		
		// normal calls
		switch ($_GET['CALLAS']){
			case 0:
				
				$_actrt = Rt_type($rows['h_s'],$rows['a_s']) ;
				
				if ($_GET['CALL']>5){
					$nGotSql = " , gotit = '0' ";
				}

				if (($_GET['CALL']==6) and ($_actrt == 1)  ){
					$nGotSql = " , gotit = '1' ";
				}
				
				if (($_GET['CALL']==7) and ($_actrt == 2)  ){
					$nGotSql = " , gotit = '1' ";
				}
				
				if (($_GET['CALL']==8) and  ($_actrt == 3) ){
					$nGotSql = " , gotit = '1' ";
				}
				
				
			break;
			
			case 1:
			case 2:
			case 3:
				//reverse calls 
				$_actrt = Rt_type($rows['h_s'],$rows['a_s']) ;
				//$nGotSql = $_actrt ;
				$nGotSql = " , gotit = '0' ";
				
				if($_GET['CALLAS'] == $_actrt ){
					$nGotSql = " , gotit = '1' ";
				}
				
			break;
			
			case 4:
				// use Paw Calls
				$_actrt = Rt_type($rows['h_s'],$rows['a_s']) ;
				$_pawCall = Rt_type($rows['hgoal'],$rows['agoal']) ;
				$nGotSql = " , gotit = '0' ";
				
				if($_pawCall == $_actrt ){
					$nGotSql = " , gotit = '1', pawcall = '$_pawCall' ";
				}else{
					$nGotSql = " , gotit = '0', pawcall = '$_pawCall' ";	
				}
				break;
				
			case 5:
				$_actrt = Rt_type($rows['h_s'],$rows['a_s']) ;			
				if($rows['bookiecall'] == $_actrt ){
					$nGotSql = " , gotit = '1' ";
				}else{
					$nGotSql = " , gotit = '0' ";
				}
			break;
			
			case 20: // dc 1x
			case 21: // dc 2x
			case 22: // dc 12
				$dc_outcome = pat_rev_call($rows["h_s"], $rows["a_s"],$_GET['CALLAS']);
				$nGotSql = " , gotit = '" . $dc_outcome ."' ";
				$imran[] = $dc_outcome ;
				break;

			case 25: //away win dnb
			case 26: // home win dnb
				$win_outcome = pat_rev_call($rows["h_s"], $rows["a_s"],$_GET['CALLAS']);
				$nGotSql = " , gotit = '" . $win_outcome ."' ";
				
				if ($rows["h_s"]==$rows["a_s"]){
					$nGotSql = " , mvalue  = '0' ";
				}else{
					$nGotSql = " , mvalue  = '1' ";
				}
				
				break;
		
		}

		
		
		if ($_GET['CALLAS'] ==0){  // normal call
		
			if ($_GET['CALL']< 4 and $_GET['BETTING']=='5'){
				if ($asl_sum>2.5 and $act_sum>2.5){
					$over_outcome = 1 ;
				}
			}

			if ($_GET['CALL']> 4 and $_GET['BETTING']=='5'){
				if ($act_sum>2.5){
					$over_outcome = 1 ;
				}
			}
			
			
		}else{  //rev. call rev calls //callas = 10 & 4  Under    and   callas = 11 & 5 Over 
								
			if ($_GET['CALL']< 4 and $_GET['BETTING']=='5'){
				if ($_GET['CALLAS']==10 and $act_sum<2.5){
					$under_outcome = 1 ;
				}
			}
			
			if ($_GET['CALL']>4 and $_GET['BETTING']=='5'){
				if ($_GET['CALLAS']==10 and $act_sum<2.5){
					$under_outcome = 1 ;
				}
			}
		
		}
		
		if ($_GET['CALLAS'] ==0){  // normal call
			if ($_GET['CALL']< 4 and $_GET['BETTING']=='4'){
				if ($asl_sum<2.5 and $act_sum<2.5){
					$under_outcome = 1;
				}
			}
			if ($_GET['CALL']> 4 and $_GET['BETTING']=='4'){
				if ($act_sum<2.5){
					$under_outcome = 1;
				}
			}
		
		}else{
			//rev. call rev calls //callas = 10 & 4  Under    and   callas = 11 & 5 Over 
			if ($_GET['CALL']< 4 and $_GET['BETTING']=='4'){
				if ($_GET['CALLAS']==11 and $act_sum>2.5){
					$over_outcome = 1;
				}
			}
			if ($_GET['CALL']> 4 and $_GET['BETTING']=='4'){
				if ($act_sum>2.5){
					$over_outcome = 1;
				}
			}
		
		}
		
		$act_rt =  Rt_type($rows['h_s'], $rows['a_s']);
		switch ($_GET['CALLAS']){  // double chance Normal = 0 else reverse calls
			case 0:
				
				if ($dc_char == "Y"){
					$dc_outcome = 1;
				}
				break;
				
			case 7:
				if ($act_rt ."/X" == "2/X" ){
					$dc_outcome = 1;
				}
				if ($act_rt ."/X" == "3/X" ){
					$dc_outcome = 1;
				}
				
				break;
				
			case 8:
				if ($act_rt ."/X" == "1/X" ){
					$dc_outcome = 1;
				}
				if ($act_rt ."/X" == "3/X" ){
					$dc_outcome = 1;
				}
				
				break;
			
			case 9:
				if ( ($act_rt ."/2" == "1/2") or ($act_rt ."/1" == "2/1") ){
					$dc_outcome = 1;
				}				
				break;
			
			
				
		}

		if ($_GET['CALLAS']==0){
			
			if ($win_char == "Y"){
				$win_outcome = 1;
			}
		
		}else{
			
			$dc_char = "";
			
			
			switch ($_GET['CALLAS']){
				case 12:  // call as Away Wins only Draw NB
					$act_rt = Rt_type($rows['h_s'], $rows['a_s']) ;
					switch ($act_rt){
						case 3: $dc_char = "N/A"; $win_outcome = 0; break;
						case 2: $win_outcome = 1; break;
						case 1: $win_outcome = 0; break;
					}
					break;
				
				case 13:
					$act_rt = Rt_type($rows['h_s'], $rows['a_s']) ;
					switch ($act_rt){
						case 3: $dc_char = "N/A"; $win_outcome = 0; break;
						case 1: $win_outcome = 1;  break;
						case 2: $win_outcome = 0; break;
					}
					break;
				
				case 14: // 1x2 Draw
					$act_rt = Rt_type($rows['h_s'], $rows['a_s']) ;
					switch ($act_rt){
						case 3: $nGotSql = " , gotit = '1' "; $win_outcome = 0; $dc_char = ""; break;
						case 1: $nGotSql = " , gotit = '0' "; $win_outcome = 0; $dc_char = ""; break;
						case 2: $nGotSql = " , gotit = '0' "; $win_outcome = 0; $dc_char = ""; break;
					}
				
					break;
			}							
			
		}
			if ($_GET['CALLAS']<>"14"){ // != 1x2 Draw
				if ($win_char=="N/A" or $dc_char=="N/A"){
					$no_win_bet = 1;
					
					if ($_GET['BETTING'] == '3' ){
						$nGotSql = $nGotSql . ", mvalue='0' ";
					}
				}
			}
		
		$xx = "update  $filename set no_win='$no_win_bet', overoutcome ='$over_outcome', underoutcome='$under_outcome', dcoutcome='$dc_outcome',winoutcome='$win_outcome' $nGotSql where rid='$nrid'";
		
		
		
	
		
	   if ($db=='eu'){
		   $temp2 = $eu->prepare($xx) ;
		}else{
		   $temp2 = $sa->prepare($xx);
		}
		$temp2->execute();
	}
	
	//echo  "<br/><br/>===========". $xx . "==============<br/><br/>";
	
    $xx = "select * from $filename $callpar2";
    if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
       $temp->execute();
    }else{
       $temp = $sa->prepare($xx);
       $temp->execute();
    }
	
	
	  
  	
	//change p2s to p3s or p4s or p5s or p6s
  	$combibets = p6s( $temp->rowcount());
	/*
		echo "$weekno -- " ;
		echo $combibets->combinations . "<br>"; 
		echo $combibets->counts . "<br>";
		echo "comtype " . $combibets->type;
	*/
	
	$explode_combiation = explode("|", $combibets->combinations);
	

	 
	
	for ($no_of_loops=0; $no_of_loops<$combibets->counts; $no_of_loops++){
		
		
		
		$get_combination = $explode_combiation[$no_of_loops];
		$ary_match_number = explode(",",$get_combination);
		
		$find_sting = "`rid` IN (";
		$whereSql = "";
		
		
		
		for ($match_loop=0; $match_loop<count($ary_match_number); $match_loop++){
			
			$match_id = $ary_match_number[$match_loop] ;
			
			$find_sting .= $match_id . "," ;
		}

		$whereSql =  " WHERE " . substr($find_sting, 0, strlen($find_sting)-1) . ")";
			
			
		switch ($_GET['BETTING']){
			case 1:
				
				switch ($_GET['CALLAS']){
					case 0:
					case 1:
					case 2:
					case 3:
					case 4:
					case 5:
						$xx = "select sum(mvalue) as m_value, sum(gotit) as got_it from $filename $whereSql"; break;
					case 20:
					case 21:
					case 22:
						$xx = "select sum(mvalue) as m_value, sum(dcoutcome) as got_it from $filename $whereSql"; break;	
					case 25:
					case 26:
						$xx = "select sum(mvalue) as m_value, sum(winoutcome) as got_it from $filename $whereSql"; break;
				}
			  break;	
			case 2:$xx = "select sum(mvalue) as m_value, sum(dcoutcome) as got_it from $filename $whereSql"; break;		
			case 3:
				if ($_GET['CALLAS']==14){
					$xx = "select sum(mvalue) as m_value, sum(gotit) as got_it from $filename $whereSql"; 
				}else{
					$xx = "select sum(mvalue) as m_value, sum(winoutcome) as got_it from $filename $whereSql"; 	
				}
				break;

			case 4:
				if ($_GET['CALLAS']==0){
					$xx = "select sum(mvalue) as m_value, sum(underoutcome) as got_it from $filename $whereSql"; 
				}else{
					$xx = "select sum(mvalue) as m_value, sum(overoutcome) as got_it from $filename $whereSql"; 
				}		
				break;
					
			case 5:
				if ($_GET['CALLAS']==0){
					$xx = "select sum(mvalue) as m_value, sum(overoutcome) as got_it from $filename $whereSql"; 
				}else{
					$xx = "select sum(mvalue) as m_value, sum(underoutcome) as got_it from $filename $whereSql"; 
				}		
				break;
				
				
		}
		
		 //echo "select * from $filename $whereSql";
		
		if ($db=='eu'){
          $temp = $eu->prepare($xx) ;
          $temp->execute();
		}else{
          $temp = $sa->prepare($xx) ;
          $temp->execute();
		}
		$row = $temp->fetch();
		
		
		if ($row['m_value'] == $combibets->type) {
			$number ++;
		}
		
		if ($row['got_it'] == $combibets->type){
			
			$win_odds = 0;  
			$weekly_correct ++;
			
			$xx = "select * from $filename $whereSql";
		
			//echo $xx;
			
			if ($db=='eu'){
			  $temp = $eu->prepare($xx) ;
			  $temp->execute();
			}else{
			  $temp = $sa->prepare($xx) ;
			  $temp->execute();
			}
			
			
			
			while($row = $temp->fetch()){
				
				switch ($_GET['BETTING']){
					
					case 1:
						if ($_GET['CALLAS'] == 0 ){
							switch($_GET['CALL']){ //1x2 home/away/draw
								case 1: 
								case 6:
									if ($win_odds == 0){
										$win_odds =  $row['h_odd'];
									}else{
										$win_odds = $win_odds * $row['h_odd'];
									}
									break;
								case 2: 
								case 7:
									if ($win_odds == 0){
										$win_odds =  $row['a_odd'];
									}else{
										$win_odds = $win_odds * $row['a_odd'];
									}
									break;
								case 3:
								case 8:		
									if ($win_odds == 0){
										$win_odds =  $row['d_odd'];
									}else{
										$win_odds = $win_odds * $row['d_odd'];
									}
									break;
							}
						}else{
							switch ($_GET['CALLAS']){
								
								case 1: 
									if ($win_odds == 0){
										$win_odds =  $row['h_odd'];
									}else{
										$win_odds = $win_odds * $row['h_odd'];
									}
									break;
								case 2: 
									if ($win_odds == 0){
										$win_odds =  $row['a_odd'];
									}else{
										$win_odds = $win_odds * $row['a_odd'];
									}
									break;
								case 3:
									if ($win_odds == 0){
										$win_odds =  $row['d_odd'];
									}else{
										$win_odds = $win_odds * $row['d_odd'];
									}
									break;
									
								case 4:	
									// Use PaW Calls
									 if ($row["pawcall"] == 1){
										
										if ($win_odds == 0){
											$win_odds =  $row['h_odd'];
										}else{
											$win_odds = $win_odds * $row['h_odd'];
										}
									 }
									 
									if ($row["pawcall"] == 2){
										if ($win_odds == 0){
											$win_odds =  $row['a_odd'];
										}else{
											$win_odds = $win_odds * $row['a_odd'];
										}
									 }
									
									if ( ($row["pawcall"] == 3) ){
										if ($win_odds == 0){
											$win_odds =  $row['d_odd'];
										}else{
											$win_odds = $win_odds * $row['d_odd'];
										}
									}
								
									break;
									
								
								case 5:
									//$_BOOKIECALL = 0; // check this one...
									
									 if ($row["bookiecall"] == 1){
										
										if ($win_odds == 0){
											$win_odds =  $row['h_odd'];
										}else{
											$win_odds = $win_odds * $row['h_odd'];
										}
									 }
									 
									if ($row["bookiecall"] == 2){
										if ($win_odds == 0){
											$win_odds =  $row['a_odd'];
										}else{
											$win_odds = $win_odds * $row['a_odd'];
										}
									 }
									
									if ( ($row["bookiecall"] == 3) ){
										if ($win_odds == 0){
											$win_odds =  $row['d_odd'];
										}else{
											$win_odds = $win_odds * $row['d_odd'];
										}
									}
								
									break;
									
									
									
								case 20: // dc 1x
									if($win_odds == 0){
										$win_odds = $row['hw_x'];
									}else{
										$win_odds = $win_odds * $row['hw_x']; 
									}									
									break;
									
								case 21: // dc 2X
									if($win_odds == 0){
										$win_odds = $row['aw_x'];
									}else{
										$win_odds = $win_odds * $row['aw_x']; 
									}									
									break;

								case 22: // dc 12
									if($win_odds == 0){
										$win_odds = $row['hw_aw'];
									}else{
										$win_odds = $win_odds * $row['hw_aw']; 
									}			
									break;
									
								case 25: // Away WinOnly DnB
									if($win_odds == 0){
										$win_odds = $row['aw_odd'];
									}else{
										$win_odds = $win_odds * $row['aw_odd']; 
									}			
									$wk_odd[] = $row['aw_odd'];
									break;
									
								case 26: // Home WinOnly DnB
									if($win_odds == 0){
										$win_odds = $row['hw_odd'];
									}else{
										$win_odds = $win_odds * $row['hw_odd']; 
									}							
									break;
							}
						
						}
					break;
					
					case 2: // double chance
						
						if ($_GET['CALLAS'] == 0 ){						
						
							 switch ($_GET['CALL']){
							  case 1: 
								if($win_odds == 0){
									$win_odds = $row['hw_x'];
								}else{
									$win_odds = $win_odds * $row['hw_x']; 
								}
								break;
							  
							  case 2: 
								if($win_odds == 0){
									$win_odds = $row['aw_x'];
								}else{
									$win_odds = $win_odds * $row['aw_x']; 
								}
								break;
								
							  case 16:		
								if($win_odds == 0){
									$win_odds = $row['hw_x'];
								}else{
									$win_odds = $win_odds * $row['hw_x']; 
								}
								break;
							  
							  case 17:	
								if($win_odds == 0){
									$win_odds = $row['aw_x'];
								}else{
									$win_odds = $win_odds * $row['aw_x']; 
								}							  
								break;
							}
						
						}else{ // double chance reverse call
							
							$act_rt =  Rt_type($row['h_s'], $row['a_s']);
							
							switch ($_GET['CALLAS']){
								case 7:
									if ($act_rt ."/X" == "2/X" ){
										if($win_odds == 0){
											$win_odds = $row['aw_x']; 
										}else{
											$win_odds += $row['aw_x']; 
										}
									}			
									break;
								
								case 8:
									if ($act_rt ."/X" == "1/X" ){
										if($win_odds == 0){
											$win_odds = $row['hw_x']; 
										}else{
											$win_odds += $row['hw_x']; 
										}
									}			
									break;
									
								case 9:
									if ( ($act_rt ."/2" == "1/2") or ($act_rt ."/1" == "2/1") ){
										if($win_odds == 0){
											$win_odds = $row['hw_aw']; 
										}else{
											$win_odds += $row['hw_aw']; 
										}
									}			
									
									break;
							}
							
						}
					break;
					
					case 3: //win only
						if ($_GET['CALLAS'] == 0){
							 switch ($_GET['CALL']){
							  case 1: 
								if($win_odds == 0){
									$win_odds = $row['hw_odd'];
								}else{
									$win_odds = $win_odds * $row['hw_odd']; 
								}
								break;
							  
							  case 2: 
								if($win_odds == 0){
									$win_odds = $row['aw_odd'];
								}else{
									$win_odds = $win_odds * $row['aw_odd']; 
								}
								break;
								
								case 11:
									if($win_odds == 0){
										$win_odds = $row['hw_odd'];
									}else{
										$win_odds = $win_odds * $row['hw_odd']; 
									}
									break;
								
								case 12:
									if($win_odds == 0){
										$win_odds = $row['aw_odd'];
									}else{
										$win_odds = $win_odds * $row['aw_odd']; 
									}
									break;

							}
							
					    
						}else{
							switch ($_GET['CALLAS']){
								case 12:  // call as Away Wins only Draw NB
									$act_rt = Rt_type($row['h_s'], $row['a_s']) ;
									if ($act_rt==2){
										if($win_odds == 0){
											$win_odds = $row['aw_odd'];
										}else{
											$win_odds = $win_odds * $row['aw_odd']; 
										}
									}
									break;
								
								case 13:
									$act_rt = Rt_type($row['h_s'], $row['a_s']) ;
									if ($act_rt==1){
										if($win_odds == 0){
											$win_odds = $row['hw_odd'];
										}else{
											$win_odds = $win_odds * $row['hw_odd']; 
										}
									}
									break;
								
								case 14: // win only call as draw 
									$act_rt = Rt_type($row['h_s'], $row['a_s']) ;
									if ($act_rt==3){
										if($win_odds == 0){
											$win_odds = $row['d_odd'];
										}else{
											$win_odds = $win_odds * $row['d_odd']; 
										}
									}
									
									break;
							}												
						}
						
						
						$no_win_number += $row['no_win'];
						
					break;
					
					
					case 4: // under over
						if ($_GET['CALLAS'] == 0){
							if($win_odds == 0){
								$win_odds = $row['un_odd'];
							}else{
								$win_odds = $win_odds * $row['un_odd']; 
							}
						
						}else{
						
							if($win_odds == 0){
								$win_odds = $row['ov_odd'];
							}else{
								$win_odds = $win_odds * $row['ov_odd']; 
							}
						}
						
					break;
					case 5:
						if ($_GET['CALLAS'] == 0){
							if($win_odds == 0){
								$win_odds = $row['ov_odd'];
							}else{
								$win_odds = $win_odds * $row['ov_odd']; 
							}
						
						}else{
							if($win_odds == 0){
								$win_odds = $row['un_odd'];
							}else{
								$win_odds = $win_odds * $row['un_odd']; 
							}
						
						}
					break;
				}
				

			}	
			//echo  "-->> $win_odds -->> $_GET[CALLAS] -->> $Tnumber -- $number<br>";
			$weekly_wins += $win_odds;
			//echo "no bet: $no_win_number <br/>";
			//print_r($wk_odd);
			
		}	
		
	}
	
?>
	
	<tr <?php echo rowcol($weekno);?>>
		
		<?php $Tcorect_calls += $weekly_correct; $Tno_win_number += $no_win_number;?>
		
		<td class="ctd" ><?php echo $weekno ;?></td>
		<td class="ctd" ><?php echo num0($number-$no_win_number);?></td>
		<td class="ctd" ><?php echo num0($weekly_correct); ?></td>
		<td class="ctd" ><?php echo num2($weekly_wins);?></td>
	
		<?php if($weekly_wins - ($number-$no_win_number)>=0){?>
			<td class="ctd padd bot" style='color:blue;'><?php echo num20($weekly_wins - ($number-$no_win_number));?></td>
		<?php }else {?>
			<td class="ctd padd bot"  style='color:red;'><?php echo num20($weekly_wins - ($number-$no_win_number)) ; ?></td>
		<?php }?>
 
	</tr>

 
<?php


	if ($weekly_wins - ($number-$no_win_number) > 0 ){
		$win_week ++;
		$prv_week = 0;
	}

	if ($weekly_wins - ($number-$no_win_number) == 0 ){
		$prv_week = 0;
	}
	
	if ($weekly_wins - ($number-$no_win_number) < 0 ){
		$loss_week ++;
		$prv_week ++;
	}
	
	if ($prv_week>$max_losses){
		$max_losses = $prv_week;
	}

	
	$Twin_odds += $weekly_wins;
	$Tnumber+= $number;
	$weekly_correct = 0; 
	 
     if ($db=='eu'){
       $drops = $eu->prepare('drop TEMPORARY table `' . $filename ."`");
       $drops->execute();
    }else{
       $drops = $sa->prepare('drop TEMPORARY table `' . $filename ."`");
       $drops->execute();
    }

 
} // endof FOR weekno

?>


<tr bgcolor="#f4f4f4">

    <td class="ctd credit" style="padding: 10px 0px;" >TOTAL</td>
    <td class="ctd credit" ><?php echo num0($Tnumber-$Tno_win_number);?></td>
    
	<td class="ctd credit" ><?php echo num0($Tcorect_calls);?></td>
	
	<td class="ctd credit" ><?php echo num2($Twin_odds);?></td>
	
    
    <?php if($Twin_odds - ($Tnumber-$Tpostponed-$Tnobets)>=0){?>
        <td class="credit ctd padd" style='color:blue;'><?php echo num20($Twin_odds - ($Tnumber-$Tno_win_number));?></td>
    <?php }else {?>
        <td class="credit ctd padd"  style='color:red;'><?php echo num20($Twin_odds - ($Tnumber-$Tno_win_number)) ; ?></td>
    <?php }?>
 
 </tr>

</table>

<table cellpadding='2' border="1" style="margin-top:2px;border-collapse: collapse;" bordercolor="#CDCDCD" width="50%" bgcolor="#F6F6F6">
	<tr bgcolor="#d3ebab">
		<td class='ctd bold padd' width='25%'>Win Weeks</td>
		<td class='ctd bold' width='25%'>Lose Weeks</td>
		<td class='ctd bold' width='25%'>Bets</td>
		<td class='ctd bold' width='25%'>Max. L/Weeks</td>
	</tr>
	<tr>	
		<td class='ctd bold padd'><?php echo num0($win_week); ?></td>
		<td class='ctd bold'><?php echo num0($loss_week); ?></td>
		<td class='ctd bold'><?php echo num0($Tnumber-$Tpostponed-$Tnobets); ?></td>
		<td class='ctd bold'><?php echo num0($max_losses); ?></td>
	</tr>
	
</table>

<br />

<!-- stopprint -->

<table  width="98%" align="center" border='0'>
<tr>
	<td width='95%' align='center'><a href="javascript:close()" class='sbar'>x Close this window x</a> </td> 

</tr>
</table>