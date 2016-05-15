<?php

session_start();
require_once("config.ini.php");
require_once("function.ini.php");

if (!isset($_REQUEST['db'])){
	require_once("header.ini.php");
	require_once("select-option.ini.php");
	require_once("footer.ini.php");
	exit;
}

$db= $_GET['db'];

if (!isset($_GET["B1"])){
    $_GET['CALL'] = 1;
    $_GET['SORTBY'] = 10;
    $_GET['PERIOD'] = '1';
    $_GET['DIV'] = '0';

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
    $season = curseason($db);
}


    
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
	$page_title = "Double Chance Odds " . curseason($db)  . " Week $weekno " ;
else:
	$page_title = "Double Chance Odds " . curseason($db) ;
endif;

require_once("header.ini.php");

page_header("Prediction Performance Records") ;

require_once("overround-class.php");

?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?php echo site($db);?></div>

<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?php echo site_other($db);?></div>


<div class='clear'></div>



<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Double Chance Odds All Divisions Combined</div>



<div style="padding-bottom:2px"></div>

<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="560">
	 
	  <form method="get" action="<?php echo $PHP_SELEF;?>">
        <input type="hidden" name="db" value="<?php echo $_GET['db'];?>"/>
		
		<tr>
        	<td class='rtd' width="100"><b><font size="2" color="#0000FF">Season</font></b></td>
    	    <td colspan="3"> 
				<select size="1" name="season" class="text" style="font-size:12px;width:120px;font-weight:bold;"  >
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
			      <option value="<?php echo $sr["season"] ?>" <?php echo selected($season,$sr["season"])?>><?php echo $sr["season"] ?></option>
			  
			  <?php endwhile; ?>
			  </select>
    
    		 </td>

	</tr>

       <tr>
            
            <td class='rtd'><b><font size="2" color="#0000FF">PaW Call Type</font></b></td>
              <td>
    		  <select size="1" name="CALL" class="text" style="width:120px;padding:3px;">
        		   <option value="1" <?php echo selected($_GET['CALL'],'1')?>>Home Win Calls</option> 
                   <option value="2" <?php echo selected($_GET['CALL'],'2')?>>Away Win Calls</option>
                   <option value="3" <?php echo selected($_GET['CALL'],'3')?>>Draw Calls</option>
                   
    		  </select>
    		</td>



       <td class='rtd'><b><font size="2" color="#0000FF">Sort On</font></b></td>
            <td>
        <select size="1" name="SORTBY" class="text" style="width:150px;padding:3px;">


          <optgroup label="Odds">  
            <option value="10" <?php echo selected($_GET['SORTBY'],'10')?>>Home/Draw Odds</option>
            <option value="11" <?php echo selected($_GET['SORTBY'],'11')?>>Away/Draw Odds</option>
            <option value="12" <?php echo selected($_GET['SORTBY'],'12')?>>Home/Away Odds</option>
          </optgroup>

          <optgroup label="Goals">  
            <option value="13" <?php echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
            <option value="14" <?php echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
          </optgroup>

          
          
        </select>

	  	<select size="1" name="ordered" class="text" style="width:66px;padding:3px;" >
        	<option value="1" <?php if($_GET['ordered']==1) echo 'selected';?>>00-99</option>
        	<option value="2" <?php if($_GET['ordered']==2) echo 'selected';?>>99-00</option>
  		</select>
                
    	   </td>

          
          </tr>
       
       <tr>
            <td class='rtd'><b><font size="2" color="#0000FF">Odds Range</font></b></td>
            <td><input type='text' style='width:40px;text-align:center;' name='min_odd' value='<?php echo $_GET['min_odd']?>'/> Min
              &nbsp;<input type='text' style='width:40px;text-align:center;' name='max_odd' value='<?php echo $_GET['max_odd']?>'/> Max
            </td>
              <td class='rtd'><b><font size="2" color="#0000FF">Period/Date</font></b></td>
              <td>
      		  <select size="1" name="PERIOD" class="text" style="width:218px;padding:3px;">
          		 <option value="1" <?php echo selected($_GET['PERIOD'],'1')?>>Full Week (Mon - Sun)</option> 
                 <option value="2" <?php echo selected($_GET['PERIOD'],'2')?>>Weekend (Sat - Sun)</option>
                 <option value="3" <?php echo selected($_GET['PERIOD'],'3')?>>Midweek (Mon - Fri)</option>

                 <?php echo fixture_date($season, $weekno, $db, $_GET['PERIOD'], $divs) ;?>

      		  </select>
    		  </td>
              
            
          
       </tr>

		  <tr>
              <td class='rtd'><b><font size="2" color="#0000FF">Division</font></b></td>
              <td colspan='2' >
               <select size="1" name="DIV" class="text" style="width:220px; padding:3px;">

                    <?php if($db=='eu'){ ?>
            		    
                     
                        <option value="0" <?php echo selected($_GET['DIV'],'0')?>>UK/European Premier Divisions</option> 
                        <option value="1" <?php echo selected($_GET['DIV'],'1')?>>UK/European Major Divisions</option> 
                        <option value="2" <?php echo selected($_GET['DIV'],'2')?>>UK Minor Divisions</option> 
                        
                        <optgroup label="One Division Only">
                  			<?php for($_i=0; $_i<count($arry_div); $_i++){ ?>
                  			   <?php if($_i<>4 and $_i<>9 and $_i<>18){ ?>
                  					<option value="<?php echo $arry_div[$_i];?>" <?php echo selected($_GET['DIV'], $arry_div[$_i]);?>><?php echo divname($arry_div[$_i]); ?></option>
                  			   <?php } ?>
                  			<?php } ?>
                    
                     <?php } ?>
                     </optgroup>  
                    <?php if($db=='sa'){ ?>
                  		    <option value="0" <?php echo selected($_GET['DIV'],'0')?>>All Divisions</option> 
                  			<?php for($_i=0; $_i<count($arry_div_sa); $_i++){ ?>
                  				<option value="<?php echo $arry_div_sa[$_i];?>" <?php echo selected($_GET['DIV'], $arry_div_sa[$_i]);?>><?php echo divname($arry_div_sa[$_i]); ?></option>
                  			<?php } ?>
                     <?php } ?>
        
        			</select>
              
              </td>
              
		      <td class='ctd padd'>
		      <input type="submit" value="View Data" name="B1" class="bt" style="padding:px;"/>

		   </td>
		</tr>
        </form>
</table>


<div style="padding-bottom:2px"></div>    
<table  width="100%" border='0'>
<tr>
<td width='20%'><?php echo back();?></td>
<td width='70%' class='ctd'>
	</td>
	<td width='10%'align="right"> <?php echo printscr(); ?></td>
</tr>
</table>



<div style="padding-bottom:10px"></div>

  <!-- startprint -->

<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:10px auto 10px auto;" bordercolor="#CDCDCD" width="70%">

<tr  bgcolor="#D3EBAB">
	<td align="center"><IMG SRC="images/tbcap/weekno_v5.gif"  BORDER="0" ALT=""></td>
	<td align="center"><IMG SRC="images/tbcap/noofmatches_v5.gif"  BORDER="0" ALT=""></td>
	<td align="center"><IMG SRC="images/tbcap/postponed_v5.gif"  BORDER="0" ALT=""></td>
	<td align="center"><IMG SRC="images/tbcap/valid_v5.gif"  BORDER="0" ALT=""></td>
	<td align="center"><IMG SRC="images/tbcap/cs_v5.gif"  BORDER="0" ALT=""></td>		
	<td align="center"><IMG SRC="images/tbcap/correctcall_v5.gif"  BORDER="0" ALT=""></td>
	<td align="center"><IMG SRC="images/tbcap/winloss_v5.gif"  BORDER="0" ALT=""></td>				
</tr>



             

<?php

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
        case '6_d': $period = " and weekday(f.match_date)=0"; $_prerid="Sunday"; break;
      }

    switch ($_GET['CALL'])
      { 
            case 1: $call = " and f.hgoal>f.agoal "; $row3cap = "Home Win Calls"; break;
            case 2: $call = " and f.agoal>f.hgoal "; $row3cap = "Away Win Calls"; break;
            case 3: $call = " and f.hgoal=f.agoal "; $row3cap = "Draw Calls";     break;
            case 4: $call = " "; $row3cap = "All Call Types"; break;
      }

	
	
    switch($_GET['ordered'])
      {
        case 1: $ordered = " asc"; break;
        case 2: $ordered = " desc"; break;
      }
    
    switch ($_GET['SORTBY'])
      {
             
    
        case 10: $ordered_by = " ORDER BY o.hw_x "; break;
        case 11: $ordered_by = " ORDER BY o.aw_x "; break;
        case 12: $ordered_by = " ORDER BY o.hw_aw "; break;
    
        case 13: $ordered_by = " ORDER BY goalsum $ordered, f.hgoal "; break;
        case 14: $ordered_by = " ORDER BY goaldif "; break;
      }
          
	 $filter='';

    if ($_GET['min_odd']>0 and $_GET['max_odd']>0){
      switch ($_GET['CALL'])
      { 
        case 1: $filter = " and o.hw_x between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
        case 2: $filter = " and o.aw_x between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
        case 3: $filter = " and o.hw_aw between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
      }
    
    }
    
	$mx_week = find_last_week_of_season($season,$db);
	
	// don't display current week 
	if($season == curseason($db)){
		$mx_week --;
	}
	
	$total_matches=0; $total_calls=0; $total_postponed=0; $total_correct=0;$total_cs=0;
	$total_wrong=0; $total_valid=0;
	
	for ($week_loop=1; $week_loop<=$mx_week; $week_loop++){
		$query1 = "SELECT (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum, f.hgoal, f.agoal, 
		  f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd, f.weekno, f.mid, 
		   o.hw_x, o.aw_x, o.hw_aw, f.`div`, f.hteam,f.ateam,  f.mdate, f.match_time, r.rank 
		    FROM fixtures f, ranking r, other_odds o WHERE 
				f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and 
				 f.weekno=o.weekno and f.season=o.season and f.mid = o.matchno 
				 	and o.hw_x>0 $period $call  $_divs $filter $ordered_by $ordered, f.match_date, 
				 	  f.match_time, f.hteam,f.ateam";
		  
			//echo $query1 . "<br/>$se";
			
		 $week_matches=0;  $week_calls=0;  $week_postponed=0;  $week_correct=0; $week_cs=0;
		 $week_wrong=0; $week_valid=0;
	 		
		if ($db=='eu'){
		   $temp = $eu->prepare($query1) ;
		}else{
		   $temp = $sa->prepare($query1);
		}
	
	    $temp->execute();
	    $match_check =  $temp->rowcount();
		
		if ($match_check>0){
			
			$mywin = "mywin";
			$window ='<a class="sbar" href="javascript:sele_win(\'weekly-double-chance-listing.php';
			$window .= "?" ;
			$week_url = $window .  $_SERVER['QUERY_STRING'] . "&weekno=$week_loop')\"><b>" ;
			$week_url .= num0($week_loop) . "</a></b>";
		
		}else{
				
			$week_url = $week_loop ;
					
		}

	    while ($row = $temp->fetch()) {
	    	
	    	$week_matches++;
		    
	        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
	        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
	        
	        $char = dc_char($row['h_s'], $row['a_s'], $row['hgoal'], $row['agoal']);
	        
	        $dccalls = double_call($row['h_s'], $row['a_s'], $row['hgoal'], $row['agoal']);
	        $week_correct += $dccalls;
	        
	        $title = "View Weekly Match Listing" ;
	    
	        if ($asl==$act){
	            $week_cs ++;
	        }
	        
	        if ($row['h_s']=='P'){
	            $week_postponed++;
	        }
	       
	        if ($char=="N/A"){
	          $week_wrong ++;
	        }
			
			$week_valid = $week_matches - $week_postpostponed; 
			
		}
		
		$total_valid += $week_valid; 
		$total_matches += $week_matches;
		$total_correct += $week_correct;
		$total_cs += $week_cs;
		$total_wrong += $week_wrong;
		$total_postponed += $week_postponed;
		



		if($week_matches>0){
?>
			<tr <?php echo rowcol($week_loop);?>>
				<td class='ctd'><?php echo $week_url; ?></td>
				<td class='ctd'><?php echo num($week_matches,0); ?></td>
				<td class='ctd'><?php echo num($week_postponed,0); ?></td>
				<td class='ctd'><?php echo num($week_matches - $week_postponed,0); ?></td>
				<td class='ctd'><?php echo num($week_cs,0); ?></td>
				<td class='ctd'><?php echo num($week_correct,0); ?></td>
				<td class='ctd bold'><?php echo num( ($week_correct / ($week_valid>0? $week_valid : 1) ) * 100,2); ?>%</td>
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
    <td class="rtd padd bot">TOTAL:</td>
    <td class="ctd padd bot"><?php echo $total_matches; ?></td>
    <td class="ctd padd bot"><?php echo $total_postponed; ?></td>
    <td class="ctd padd bot"><?php echo $total_valid; ?></td>
    <td class="ctd padd bot"><?php echo $total_cs; ?></td>
    <td class="ctd padd bot"><?php echo $total_correct; ?></td>
     <td class="ctd padd bot"><?php echo num( ($total_correct / ($total_valid>0? $total_valid : 1) ) * 100,2); ?>%</td>    
 </tr> 



</table>

<!-- stopprint -->

<?php require_once("footer.ini.php"); 

function blank_line($start_week,$ch)
{
    $rowcol = rowcol($start_week);
	$data .= "<tr $rowcol >\n";
	$data .= "<td align='center' >\n$start_week</td>\n"; 
	$data .= "<td align='center' id='t1'>$ch\n</td>\n"; 
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'  id='t1'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	
	$data .= "</tr>\n";

	return $data;
}

?>