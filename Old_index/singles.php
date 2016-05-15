<table cellpadding='2' border="1" style="border-collapse: collapse;" bordercolor="#CDCDCD" width="100%" bgcolor="#F6F6F6">
<tr bgcolor="#d3ebab">
    <td class="ctd" width="10%"><img src="images/tbcap/wkno.gif" border='0' alt=''/></td>
    <td class="ctd" width="10%"><img src="images/tbcap/unit_laid.gif" border='0' alt=''/></td>
    <td class="ctd" width="10%"><img src="images/tbcap/total_correct_calls.gif" border='0' alt=''/></td>
    <td class="ctd" width="10%"><img src="images/tbcap/total_cs_hits.gif" border='0' alt=''/></td>
    <td class="ctd" width="10%"><img src="images/tbcap/postponed_void_matches.gif" border='0' alt=''/></td>
    <td class="ctd" width="10%"><img src="images/tbcap/units_won.gif" border='0' alt=''/></td> 
    <td class="ctd" width="10%"><img src="images/tbcap/profit_loss.gif" border='0' alt=''/></td> 
 </tr>




<?
$odd_max_diff =  20;

 $Tnumber=0; $Tngot =0 ;  $Tcss =0;  $Tpostponed = 0;  $Twin_odds = 0;  $Tnobets =  0; 
 
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
  
  
for ($weekno=1; $weekno<=$max_week; $weekno++){

 $qry = "SELECT f.bookiecall, f.hodddif, f.aodddif, f.dodddif, concat(f.hgoal,f.agoal) as asl2show, f.prvalue, c.dcr_ht, c.dcr_at, c.dcr_av,c.dcr_dif,abs(c.dcr_dif) as dcrdif,f.`div`, f.hteam,f.ateam,f.match_time,f.hgoal,f.agoal,f.h_s,f.a_s,f.gotit,f.mvalue,f.mid,f.pawrank, date_format(f.match_date,'%d-%b-%y') as mdate,
        f.hwinpb, f.drawpb, f.awinpb, f.h_odd, f.d_odd, f.a_odd, r.ptr_ht, r.ptr_at, r.ptr_av,r.ptr_dif, abs(r.ptr_dif) as ptrdif ,
        (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum, ((f.drawpb*0.5) + f.hwinpb /(f.hwinpb+f.awinpb)*100) as x1probs, 
        ((f.drawpb*0.5) + f.awinpb /(f.hwinpb+f.awinpb)*100) as x2probs, g.gpr_ht, g.gpr_at, g.gpr_av, a.air_ht, a.air_at,a.air_av,a.air_dif ";



    
       switch ($_GET['BETTING']){
        
        case 1: 
            $qry .= "FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, cur_reb g, cur_reb_air a   
            WHERE c.weekno='$weekno' and c.season='$season' and  
            c.matchno=f.mid and f.season=c.season and f.weekno=c.weekno and 
            g.matchno=f.mid and g.season=f.season and g.weekno=f.weekno and 
            a.matchno=f.mid and a.season=f.season and a.weekno=f.weekno and 
            r.matchno=f.mid and r.season=f.season and r.weekno=f.weekno and f.h_odd>0 " ;
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
                case 1: $filter = " and o.hw_x between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                case 2: $filter = " and o.aw_x between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                case 3: $filter = " and o.hw_aw between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
              }
            break;
    
          case 3: 
              switch ($_GET['CALL'])
              { 
                case 1: $filter = " and o.hw_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                case 2: $filter = " and o.aw_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
              }
            break;
    
        case  4: 
          
          $filter = " and o.un_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
          switch ($_GET['CALL'])
          { 
            case 1:
                if ($_GET['SORTBY']==40){
                   $filter = " and o.un_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                }
                if ($_GET['SORTBY']==41){
                  $filter = " and o.ov_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                }
            
            case 2:
                if ($_GET['SORTBY']==40){
                 $filter = " and o.un_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                }
                if ($_GET['SORTBY']==41){
                  $filter = " and o.ov_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                }
            
         
          }
        break;
        
     case  5: 
          
          $filter = " and o.ov_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;                   
          switch ($_GET['CALL'])
          { 
            case 1:
                
                if ($_GET['SORTBY']==40){
                 $filter = " and o.un_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                }
                if ($_GET['SORTBY']==41){
                  $filter = " and o.ov_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                }
            
            case 2:

                if ($_GET['SORTBY']==40){
                 $filter = " and o.un_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                }
                if ($_GET['SORTBY']==41){
                  $filter = " and o.ov_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                }
            
         
          }
        break;
      
      }
      
    }
    
    if ($_GET['db']=='eu'){
        
        switch ($_GET['DIV']){
            
            case '0': $_divs = " and f.`div` IN ('EP','SP','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
            case '1': $_divs = " and f.`div` IN ('EP','C0','C1','C2','SP','S1','S2','S3','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
            case '2': $_divs = " and f.`div` IN ('NC', 'UP', 'RP', 'MP') "; break;
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
    
   if  ($weekno==22){
     //echo $query1;
   }
    
    if (!isset($_SESSION['userid'])){
        $filename = "tmp_" . time() ;
  
    }else{
      $filename = "tmp_" . trim($_SESSION['userid']) ;
    }

    
     
    $xx = "CREATE TEMPORARY TABLE " . $filename . " (".$query1.")";
   // if ($weekno==9) echo "xx = $xx";
    
    if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();
    
   // echo $temp->rowcount();

   $xx = "alter table " . $filename . " ADD COLUMN `rid` int NOT NULL AUTO_INCREMENT primary key FIRST";
   if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
    }else{
       $temp = $sa->prepare($xx);
    }
    $temp->execute();

    
    $xx = "select * from $filename $callpar2";
    
    if ($db=='eu'){
       $temp = $eu->prepare($xx) ;
       $temp->execute();
       $drops = $eu->prepare('drop TEMPORARY table `' . $filename ."`");
       $drops->execute();
    }else{
       $temp = $sa->prepare($xx);
       $temp->execute();
       $drops = $sa->prepare('drop TEMPORARY table `' . $filename ."`");
       $drops->execute();
    }
 
      
   $number=0; $ngot =0 ;  $css =0;  $postponed = 0;  $win_odds = 0;  $nobets =  0;
  
   while ($row = $temp->fetch()) {
        $number++;
        $matchno = $row['mid'];
        
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;

    
    switch ($_GET['BETTING']){
        
        case 1:
            $captions = "For Singles 1X2 Betting";
            
			if ($_GET['CALL']<5){
				
			
				
				if ($row['mvalue']>0){
					
					if ($_GET['CALLAS'] < 5){
						$_rt_get = return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], $_GET['CALLAS']);
					
					}else{
							//= " and f.hodddif >= $odd_max_diff "; $row3cap = "Home Win Calls (Bookies)"; break;
							//= " and f.aodddif >= $odd_max_diff "; $row3cap = "Away Win Calls (Bookies)"; break;
							//= " and ( (f.aodddif>0 and f.aodddif <= $odd_max_diff) or (f.hodddif>0 and f.hodddif <= $odd_max_diff) ) "; $row3cap = "Draw Calls (Bookies)";		
							
						$_BOOKIECALL = 0;
						$_BOOKIECALL = $row['bookiecall'] ;
						
						$_rt_get = return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], $_BOOKIECALL);
					}
				
					$ngot += $_rt_get; // $row['gotit'] ;
					
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
							
							$_BOOKIECALL = $row['bookiecall'] ;
							
							switch ($_GET['CALLAS']){
							  case 1: $win_odds+= $row['h_odd']; break;
							  case 2: $win_odds+= $row['a_odd']; break;
							  case 3: $win_odds+= $row['d_odd']; break;
							  case 5:
							  	$asl_class = " ";  // no CS correct for Bookie
								$asl_class2 = " ";
								// need to add coodes here for bookie calls
								//= " and f.hodddif >= $odd_max_diff "; $row3cap = "Home Win Calls (Bookies)"; break;
								//= " and f.aodddif >= $odd_max_diff "; $row3cap = "Away Win Calls (Bookies)"; break;
								//= " and ( (f.aodddif>0 and f.aodddif <= $odd_max_diff) or (f.hodddif>0 and f.hodddif <= $odd_max_diff) ) "; $row3cap = "Draw Calls (Bookies)";
								switch ($_BOOKIECALL){
								  case 1: $win_odds+= $row['h_odd'];  break;
								  case 2: $win_odds+= $row['a_odd'];  break;
								  case 3: $win_odds+= $row['d_odd'];  break;
								}
								break;
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
								
								if($_GET['CALLAS']==4){ // rev. paw
									$_rt_get  =  return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], 0);
									$my_value = "  -- $_rt_get  " ;
								}
								
								if($_GET['CALLAS']==0){ // rev. paw
									$_rt_get  =  return_gotit($row["hgoal"], $row["agoal"],$row["h_s"], $row["a_s"], 1);
								}
								
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
								
								if($_GET['CALLAS']==4 ){ // rev. paw
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
             $captions = "For Standard Double Change Betting";
               $dc_char = dc_char($row['h_s'], $row['a_s'], $row['hgoal'], $row['agoal']);   
               if ($dc_char=="Y"){
                     $ngot ++;
                     switch ($_GET['CALL']){
                      case 1: $win_odds+= $row['hw_x']; break;
                      case 2: $win_odds+= $row['aw_x']; break;
                    }
               } 
                
            break;
        
        case 3:  // Win only 
            $captions = "For Standard Win Only Betting";
            $dc_char = Winonly_char($row['h_s'], $row['a_s'], $row['hgoal'], $row['agoal']);   
               if ($dc_char=="Y"){
                     $ngot ++;
                     switch ($_GET['CALL']){
                      case 1: $win_odds+= $row['hw_odd']; break;
                      case 2: $win_odds+= $row['aw_odd']; break;
                    }
               }
               if ($dc_char=="NB" or $dc_char=="N/A"){
                $nobets++;
               }
        
            break;
            
        case 4: // under over 2.5
        case 5:
            $captions = "For Standard Under/Over Betting";
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
        if ($asl==$act){
            $css ++;
        }

        if ($row['h_s']=='P'){
            $postponed++;
        }
        
    }
    
     // total for Year;
        $Tnumber +=$number ;
        $Tpostponed += $postponed;
        $Tcss += $css;
        $Twin_odds += $win_odds;
        $Tngot += $ngot;
        $Tnobets += $nobets;
    
?>


<tr <?echo rowcol($weekno);?>>

    <td class="ctd" ><?echo $weekno ;?></td>
    <td class="ctd" ><?echo num0($number-$postponed-$nobets);?></td>
    <td class="ctd" ><?echo $ngot;?></td>
    <td class="ctd" ><?echo $css;?></td>
    <td class="ctd" ><?echo $postponed +$nobets;?></td>
    <td class="ctd" ><?echo num2($win_odds);?></td>
    
    <?php if($win_odds - ($number-$postponed-$nobets)>=0){?>
        <td class="ctd padd bot" style='color:blue;'><?echo num20($win_odds - ($number-$postponed-$nobets));?></td>
    <?php }else {?>
        <td class="ctd padd bot"  style='color:red;'><?echo num20($win_odds - ($number-$postponed-$nobets)) ; ?></td>
    <?php }?>
 
 </tr>

<?


} // endof FOR weekno

?>

<tr bgcolor="#f4f4f4">

    <td class="ctd credit" style="padding: 10px 0px;" >TOTAL</td>
    <td class="ctd credit" ><?echo num0($Tnumber-$Tpostponed-$Tnobets);?></td>
    <td class="ctd credit" ><?echo $Tngot;?></td>
    <td class="ctd credit" ><?echo $Tcss;?></td>
    <td class="ctd credit" ><?echo $Tpostponed +$Tnobets;?></td>
    <td class="ctd credit" ><?echo num2($Twin_odds);?></td>
    
    <?php if($Twin_odds - ($Tnumber-$Tpostponed-$Tnobets)>=0){?>
        <td class="credit ctd padd" style='color:blue;'><?echo num20($Twin_odds - ($Tnumber-$Tpostponed-$Tnobets));?></td>
    <?php }else {?>
        <td class="credit ctd padd"  style='color:red;'><?echo num20($Twin_odds - ($Tnumber-$Tpostponed-$Tnobets)) ; ?></td>
    <?php }?>
 
 </tr>

</table>


<br />

<!-- stopprint -->

<table  width="98%" align="center" border='0'>
<tr>
	<td width='95%' align='center'><a href="javascript:close()" class='sbar'>x Close this window x</a> </td> 

</tr>
</table>




