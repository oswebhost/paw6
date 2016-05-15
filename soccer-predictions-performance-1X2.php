<?php
session_start();
require_once("config.ini.php");
require_once("function.ini.php");

$active_mtab = 1;

$db= $_GET['db'];

if (!isset($_GET["B1"])){
    $_GET['CALL'] = 1;
    $_GET['SORTBY'] = 10;
    $_GET['PERIOD'] = '1';
    $_GET['DIV'] = '0';

}


if (!isset($_GET['cur'])){
	$season = curseason($db);
}else{
    $season = curseason($db);
}


if (isset($_GET["weekno"])):
	$page_title = "By Predict-A-Win Call Type (1X2) " .  curseason($db)  . " Week $weekno " ;
else:
	$page_title = "By Predict-A-Win Call Type (1X2) " . curseason($db) ;
endif;

 
$hc=''; $ac=''; $dcc='';$pb ='';
$_orderby = " f.h_odd, f.rank "; $hc='bgcolor="#D3EBAB"'; 
 
switch ($_GET['CALL'])
{   
    case 1: $period = " and f.hgoal>f.agoal "; $_prerid="Home Win Calls"; break;
    case 2: $period = " and f.agoal>f.hgoal "; $_prerid="Away Win Calls";  break;
    case 3: $period = " and f.hgoal=f.agoal "; $_prerid="Draw Calls";break;
}

 switch($_GET['ordered'])
{
    case 1: $ordered = " asc"; break;
    case 2: $ordered = " desc"; break;
}

switch ($_GET['SORTBY'])
{
    case 7: $ordered_by = " ORDER BY f.hwinpb "; break;
    //case 8: $ordered_by = " ORDER BY f.awinpb "; break;
    //case 9: $ordered_by = " ORDER BY f.drawpb "; break;
    
    case 10: $ordered_by = " ORDER BY f.h_odd "; break;
    case 11: $ordered_by = " ORDER BY f.a_odd "; break;
    case 12: $ordered_by = " ORDER BY f.d_odd "; break;
    
    case 13: $ordered_by = " ORDER BY goalsum $ordered, f.hgoal "; break;
    case 14: $ordered_by = " ORDER BY goaldif "; break;
}
          
$filter='';

if ($_GET['min_odd']>0 and $_GET['max_odd']>0){
  switch ($_GET['CALL'])
  { 
    case 1: $filter = " and f.h_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
    case 2: $filter = " and f.a_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
    case 3: $filter = " and f.d_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
  }

}
          
switch ($_GET['PERIOD'])
{
    case 1: $period .= " ";  $_prerid .= "<br><font size='1'>Full Week (Mon - Sun)</font>"; break;
    case 2: $period .= " and weekday(match_date)>4"; $_prerid .= "<br><font size='1'>Weekend (Sat - Sun)</font>"; break;
    case 3: $period .= " and weekday(match_date)<5"; $_prerid .= "<br><font size='1'>Midweek (Mon - Fri)</font>"; break;
    
    case '0_d': $period = " and weekday(f.match_date)=0"; $_prerid="Monday"; break;
    case '1_d': $period = " and weekday(f.match_date)=1"; $_prerid="Tuesday"; break;
    case '2_d': $period = " and weekday(f.match_date)=2"; $_prerid="Wednesday"; break;
    case '3_d': $period = " and weekday(f.match_date)=3"; $_prerid="Thursday"; break;
    case '4_d': $period = " and weekday(f.match_date)=4"; $_prerid="Friday"; break;
    case '5_d': $period = " and weekday(f.match_date)=5"; $_prerid="Saturday"; break;
    case '6_d': $period = " and weekday(f.match_date)=0"; $_prerid="Sunday"; break;
}  


$active_mtab = 1;

require_once("header.ini.php");

require_once("overround-class.php");


page_header("Prediction Performance Records") ; 


?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?php echo site($db);?></div>

<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?php echo site_other($db);?></div>


<div class='clear'></div>

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">By Predict-A-Win Call Type (1X2)</div>



<div style="padding-bottom:2px"></div>


<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="560">
	 
	  <form method="get" action="<?php echo $PHP_SELF;?>">
        <input type="hidden" name="db" value="<?php echo $_GET['db'];?>"/>
		<tr>
			  <td class='rtd'><b><font size="2" color="#0000FF">Season</font></b></td>
			  
			  <td>	
				  <select size="1" name="season_value" class="text" style='width:110px;font-size:12px;' onChange="this.form.submit();">
				
				  <?php $sqry = "SELECT distinct(season) as season from fixtures order by season desc" ;
				    if ($db=='eu'){
				        $temp = $eu->prepare($sqry);
				        $arry_div = $arry_div_tables ;
				    }else{
				        $temp = $sa->prepare($sqry);
				        $arry_div = $arry_div_sa;
				    }
				   
				   $temp->execute();
				   while ($sr = $temp->fetch()) : 
					   if (!isset($season)){
					   	$season = $sr['season'];
					   }
				  ?>
					  <option value="<?php echo $sr["season"] ?>" <?php echo selected($season_value,$sr["season"])?>><?php echo $sr["season"] ?></option>
				  
				  <?php endwhile; ?>
				  </select>
			
			  </td>
			
		
		
        	<td class='rtd' width="100"><b><font size="2" color="#0000FF"></font></b></td>
    	    <td colspan="3"> 
    		       
    		 </td>

	</tr>

       <tr>
            
            <td class='rtd'><b><font size="2" color="#0000FF">Call Type</font></b></td>
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
            <option value="10" <?php echo selected($_GET['SORTBY'],'10')?>>Home Wins Odds</option>
            <option value="11" <?php echo selected($_GET['SORTBY'],'11')?>>Away Wins Odds</option>
            <option value="12" <?php echo selected($_GET['SORTBY'],'12')?>>Draw Odds</option>
          </optgroup>

          <optgroup label="Goals">  
            <option value="13" <?php echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
            <option value="14" <?php echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
          </optgroup>

          <optgroup label="Probabilities">    
            <option value="7" <?php echo selected($_GET['SORTBY'],'7')?>>Wins Probabilities</option>
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
		      <td colspan='6' class='ctd padd'>
		      <input type="submit" value="View Data" name="B1" class="bt" style="padding:4px;"/>

		   </td>
		</tr>
        </form>
</table>

<div style="padding-bottom:2px"></div>

<table  width="100%" align="center">
<tr>
	<td> <a class='sbar' href="prediction-performance-records.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"> <?php echo printscr(); ?></td>
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

	$mx_week = find_last_week_of_season($season,$db);
	
	// don't display current week 
	if($season == curseason($db)){
		$mx_week --;
	}
	
	$total_matches=0; $total_calls=0; $total_postponed=0; $total_correct=0;$total_cs=0;
	$total_wrong=0; $total_valid=0;
	
	for ($week_loop=1; $week_loop<=$mx_week; $week_loop++){


		$query1 = "SELECT (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum,date_format(f.match_date,'%d-%b-%Y') as m_date, 
				f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb, f.weekno, f.mid, f.h_odd, f.d_odd, f.a_odd, 
					f.`div`,f.hteam,f.ateam,  f.mdate, f.match_time
						FROM 
							fixtures f 
								WHERE 
									f.weekno='$week_loop' and f.season='$season' and f.h_odd>0";
            
    
		    $query1 .= $period . $filter. $ordered_by . $ordered;

		   
		    		    
			if ($db=='eu'){
			   $temp = $eu->prepare($query1) ;
			}else{
			   $temp = $sa->prepare($query1);
			}
		
		    $temp->execute();
		
		
			 $week_matches=0;  $week_calls=0;  $week_postponed=0;  $week_correct=0; $week_cs=0;
			 $week_wrong=0; $week_valid=0;
		
		     $temp->execute();
		
		     $match_check =  $temp->rowcount();
			
			 if ($match_check>0){
				
				$mywin = "mywin";
				$window ='<a class="sbar" href="javascript:sele_win(\'weekly-1x2prediction-listing.php';
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
		        $week_correct += $row['gotit'] ;
		        
		        $title = "View Weekly Match Listing" ;
		        
		        if ($asl==$act){
		            $week_cs ++;
		        }
		        
		        if ($row['h_s']=='P'){
		            $week_postponed++;
		        }
			}
		
			$week_valid = $week_matches - $week_postponed;
			$total_valid += $week_valid; 
			$total_matches += $week_matches;
			$total_correct += $week_correct;
			$total_cs += $week_cs;
			$total_postponed += $week_postponed;
				
			if($week_matches>0){
?>
				<tr <?php echo rowcol($week_loop);?>>
					<td class='ctd'><?php echo $week_url; ?></td>
					<td class='ctd'><?php echo num($week_matches,0); ?></td>
					<td class='ctd'><?php echo num($week_postponed,0); ?></td>
					<td class='ctd'><?php echo num($week_matches - $week_postponed ,0); ?></td>
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
		    <td class="ctd padd bot"><?php echo num($total_matches,0); ?></td>
		    <td class="ctd padd bot"><?php echo $total_postponed; ?></td>
		    <td class="ctd padd bot"><?php echo $total_valid; ?></td>
		    <td class="ctd padd bot"><?php echo $total_cs; ?></td>
		    <td class="ctd padd bot"><?php echo $total_correct; ?></td>
		     <td class="ctd padd bot"><?php echo num( ($total_correct / ($total_valid>0? $total_valid : 1) ) * 100,2); ?>%</td>    
		 </tr> 
		
		</table>


<!-- stopprint -->

			   
			   
			   
			   



<div style="padding-bottom:5px">&nbsp;</div>



		
<?php //require_once("pred-disclaimer.ini.php");  ?>
<?php require_once("footer.ini.php"); ?>


<?php	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}

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
