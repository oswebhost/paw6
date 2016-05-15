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


if (isset($_GET['season'])){
    $season = $_GET['season']; 
}else{
    $season = curseason($db);
}




if ($LOG=="N"): $lastweek = $lastweek - 1; endif;
if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;


$cur = cur_week($db);
	

 
 
 $pwk = $weekno-1;
 $nwk = $weekno+1;

if (!isset($weekno)) $weekno = $lastweek ;


if (isset($_GET['weekno'])){
  $weekno = $_GET['weekno'];
}else{
  $weekno  =  $weekno; 
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
  
  

$page_title = "Bookie v PaW Expectations " . curseason($db) ;


$odd_max_diff = 20;


$hc=''; $ac=''; $dc='';

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



switch($_GET['ordered'])
{
    case 1: $_ordered = " asc"; break;
    case 2: $_ordered = " desc"; break;
}

switch ($_GET['SORTBY'])
{
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




require_once("header.ini.php");
require_once("overround-class.php");


page_header("Prediction Performance Records") ;


      


?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?php echo site($db);?></div>

<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?php echo site_other($db);?></div>


<div class='clear'></div>

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">BOOKIE V PAW EXPECTATIONS</div>



<div style="padding-bottom:2px"></div>


<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="560">
	 
	  <form method="get" action="<?php echo $PHP_SELF;?>">
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
			      <option value="<?php echo  $sr["season"] ?>" <?php echo selected($season,$sr["season"])?>><?php echo  $sr["season"] ?></option>
			  
			  <?php endwhile; ?>
			  </select>
    
    		 </td>

	</tr>

       <tr>
            
            <td class='rtd'><b><font size="2" color="#0000FF">Call Type</font></b></td>
              <td>
    		  <select size="1" name="CALL" class="text" style="width:140px;padding:3px;">
    	        <option value="1" <?php if($_GET['CALL']==1) echo 'selected';?>>Bookie's Home Win Calls</option>
                <option value="2" <?php if($_GET['CALL']==2) echo 'selected';?>>Bookie's Away Win Calls</option>
                <option value="3" <?php if($_GET['CALL']==3) echo 'selected';?>>Bookie's Draw Calls</option>
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
        <?php if ($weekno==cur_week($db)){ ?>
          <optgroup label="Probabilities">    
            <option value="7" <?php echo selected($_GET['SORTBY'],'7')?>>Wins Probabilities</option>
          </optgroup>
        <?php } ?>    
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
                  					<option value="<?php echo  $arry_div[$_i];?>" <?php echo  selected($_GET['DIV'], $arry_div[$_i]);?>><?php echo  divname($arry_div[$_i]); ?></option>
                  			   <?php } ?>
                  			<?php } ?>
                    
                     <?php } ?>
                     </optgroup>  
                    <?php if($db=='sa'){ ?>
                  		    <option value="0" <?php echo selected($_GET['DIV'],'0')?>>All Divisions</option> 
                  			<?php for($_i=0; $_i<count($arry_div_sa); $_i++){ ?>
                  				<option value="<?php echo  $arry_div_sa[$_i];?>" <?php echo  selected($_GET['DIV'], $arry_div_sa[$_i]);?>><?php echo  divname($arry_div_sa[$_i]); ?></option>
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


<table  width="100%" align="center">
<tr>
	<td><?php echo back();?> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"> <?php echo  printscr(); ?></td>
</tr>
</table>


<div style="padding-bottom:10px"></div>

<!-- startprint -->

<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="570" cellpadding='3'>
  <tr bgcolor="#d3ebab">
    <td width='100' class='ctd padd bot'>Week<br/>No</td>    
    <td width='100' class='ctd padd bot'>Total<br/>Matches</td>
    <td width='100' class='ctd padd bot'>Postponed<br/></td>    
    
    <td width='100' class='ctd padd bot'>Bookie's Correct<br/>Calls</td>    
    <td width='100' class='ctd padd bot'>Bookie's Correct<br/>%</td>

    <td width='100' class='ctd padd bot'>PaW's Correct<br/>Calls</td>    
    <td width='100' class='ctd padd bot'>PaW's Correct<br/>%</td>
    
    
   </tr> 
   
<?php

$t_number = 0; $t_css=0; $t_paw_correct = 0; $t_bookie_correct = 0; $t_postponed =0;


$mx_week = find_last_week_of_season($season,$db);

// don't display current week 
if($season == curseason($db)){
	$mx_week --;
}
	
for ($week_loop=1; $week_loop<=$mx_week; $week_loop++){
	
		
		if ($_GET['CALL']=="1"):
		  $query1 = "SELECT (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum,f.wdate, f.hwinpb as probs,f.hwinpb,f.awinpb,f.drawpb, f.mid,f.weekno,f.`div`,f.mdate,f.hteam,f.ateam,f.hgoal,f.agoal,
		    f.h_odd,f.d_odd,f.h_s,f.a_s, f.gotit, f.mvalue,f.a_odd,f.match_time, ((f.a_odd/f.h_odd)-1)*100 as diff, r.rank 
		     FROM fixtures f, ranking r WHERE f.weekno='$week_loop' and f.season='$season' and f.h_odd>0
		      and f.`div`=r.matchtype and r.cat='bk'";
		  
		   // $period ORDER BY  f.h_odd, r.rank
		    $cap = "BOOKIE'S Home Win Expectations";
		    $_prerid2="Home Win Calls"; 
		
		elseif($_GET['CALL']=="2"):
		  $query1 = "SELECT (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum,f.wdate,f.awinpb as probs,f.mid,f.weekno,f.`div`,f.mdate,f.hteam,f.ateam,f.agoal,f.hgoal,f.h_s,f.a_s, f.gotit, f.mvalue,f.h_odd,f.h_odd,f.d_odd,f.a_odd,f.match_time, ((f.h_odd/f.a_odd)-1)*100 as diff, r.rank FROM fixtures f, ranking r WHERE
		      f.weekno='$week_loop' and f.season='$season' and f.h_odd>0 and f.`div`=r.matchtype and r.cat='bk'";
		    
		    //$period ORDER BY f.a_odd
		    $cap = "BOOKIE'S Away Win Expectations";
		    $_prerid2="Away Win Calls"; 
		
		elseif($_GET['CALL']=="3"):
		  $query1 = "SELECT (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum,f.wdate,f.hwinpb as probs, f.mid,f.weekno,f.`div`,f.mdate,f.hteam,f.ateam,f.hgoal,f.agoal,f.h_odd,f.h_odd,f.h_s,f.a_s, f.gotit, f.mvalue,f.d_odd,f.a_odd,f.match_time, 
		    ((f.a_odd/f.h_odd)-1)*100 as hwin, ((f.h_odd/f.a_odd)-1)*100 as awin, abs(f.h_odd-f.a_odd) as dodd, r.rank FROM fixtures f, ranking r WHERE
		      f.weekno='$week_loop' and f.season='$season' and f.h_odd>0 and f.`div`=r.matchtype and r.cat='bk' ";
		      
		      //$period ORDER BY f.d_odd, dodd, f.match_date,f.match_time,f.`div`, f.hteam,f.ateam
		      
		      $cap = "BOOKIE'S Draw Expectations";
		      $_prerid2="Draw Calls"; 
		
		endif;  
		
		$query1 .= $period . $_divs . $filter. $ordered_by . $_ordered;
		
		
		
		
		if ($db=='eu'){
		   $temp = $eu->prepare($query1) ;
		}else{
		   $temp = $sa->prepare($query1);
		}
		
		$temp->execute();
		
		
		$number = 0; $css=0; $paw_correct = 0; $bookie_correct = 0; $postponed =0;
		    
		while ($row = $temp->fetch()) {
		
		    if ($_GET['CALL']<>'3'){
		     
		     if ($row["diff"]>$odd_max_diff) {  
		
		      	$number++;
		  	    $matchno = $row['mid'];
		        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
		        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
		        $ngot += $row['gotit'] ;
		
		        $rtType = Rt_type($row['h_s'], $row['a_s']);
		        $paw_rt = Rt_type($row['hgoal'], $row['agoal']);
		        
		        
		        $title = "$row[hteam] v $row[ateam] match odds" ;
		        $odd=0;
		    // find over-round [overround-class.php]
		        $or = new overround();
		        $or->find_or($row['h_odd'], $row['d_odd'], $row['a_odd'], $row['hwinpb'],$row['drawpb'],$row['awinpb']);
		        $asl_class ="";
		       
		 		    $sbar = "sbar";
		
		        if (($_GET['CALL']==1) and ($rtType==1)){
		            $css++;
		            $asl_class2 = " gotrtblue";
		        }elseif($_GET['CALL']==1 and $rtType<>1){
		          $asl_class2 = " wrong";
		           $sbar2= "sWrg";
		         
		        }
		
		
		      if (($_GET['CALL']==2) and ($rtType==2)){
		            $css++;
		            $asl_class2 = " gotrtblue";
		        }elseif($_GET['CALL']==2 and $rtType<>2){
		          $asl_class2 = " wrong";
		           $sbar2= "sWrg";
		        
		        }
		
		        if (($_GET['CALL']==3) and ($rtType==3)){
		            $css++;
		            $asl_class2 = " gotrtblue";
		        }elseif($_GET['CALL']==3 and $rtType<>3){
		          $asl_class2 = " wrong";
		          $sbar2= "sWrg";
		         
		        }
		        
		       
		
		        if ($row['h_s']=='P'){
		            $asl_class = " pp";
		            $sbar= "sWrg";
		            $postponed++;
		        }
		        
		        $pr = "";
		        if (asl_pr_team($row["hteam"],$row["ateam"],$season,$db)){
		            $pr = " pr2";
		        }
		     
		        $overround=0;
				$overround = ((1/$row["h_odd"]) + (1/$row["d_odd"]) + (1/$row["a_odd"]) -1) *100 ;
		           //over founds
		        $hor = ($or->home_value==1? " h_Or" : "");
		        $aor = ($or->away_value==1? " a_Or" : "");
		
		
		
		        if ($row['gotit']==1){ 
		          $paw_correct++;
		          $asl_class = " gotrtblue";
		        }else{
		           $asl_class = " wrong";
		          
		        } 
		         if ($asl==$act){
		            $asl_class = " gotaslblue";
		            $sbar = ' sbar2';
		            
		        }
		
		
		?>
		
			
		
		
		
		
		
		<?php
		   }
		  }else{
		      
		      if ( ($row["hwin"]>0 and $row["hwin"]<=$odd_max_diff)  or ($row["awin"]>0 and $row["awin"]<=$odd_max_diff) ){
		        $number++;
		        $matchno = $row['mid'];
		        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
		        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
		        $ngot += $row['gotit'] ;
		        
		        $rtType = Rt_type($row['h_s'], $row['a_s']);
		        $paw_rt = Rt_type($row['hgoal'], $row['agoal']);
		
		            
		        $title = "$row[hteam] v $row[ateam] match odds" ;
		        $odd=0;
		    // find over-round [overround-class.php]
		        $or = new overround();
		        $or->find_or($row['h_odd'], $row['d_odd'], $row['a_odd'], $row['hwinpb'],$row['drawpb'],$row['awinpb']);
		        $asl_class = " wrong";
		       
		        $sbar = "sbar";
		
		        if (($_GET['CALL']==3) and ($rtType==3)){
		            $css++;
		            $asl_class2 = " gotrtblue";
		            $sbar2 = "sbar";
		        }elseif($_GET['CALL']==3 and $rtType<>3){
		          $asl_class2 = " wrong";
		          $sbar2= "sWrg";
		        }
		
		      
		
		
		        if ($row['h_s']=='P'){
		            $asl_class = " pp";
		            $postponed++;
		        }
		        
		        $pr = "";
		        if (asl_pr_team($row["hteam"],$row["ateam"],$season,$db)){
		            $pr = " pr2";
		        }
		     
		         $overround=0;
		         $overround = ((1/$row["h_odd"]) + (1/$row["d_odd"]) + (1/$row["a_odd"]) -1) *100 ;
		           //over founds
		        $hor = ($or->home_value==1? " h_Or" : "");
		        $aor = ($or->away_value==1? " a_Or" : "");
		
		     if ($row['gotit']==1){ 
		          $paw_correct++;
		          $asl_class = " gotrtblue";
		        }else{
		           $asl_class = " wrong";
		           $sbar= "sWrg";
		        } 
		
		        if ($asl==$act){
		            $asl_class = " gotaslblue";
		            
		        }
		
	        }
		
		  }
		} // week only loop
	  	
	  	if($number>0){
			$mywin = "mywin";
			$window ='<a class="sbar" href="javascript:sele_win(\'weekly-bookie-expectations-listing.php';
			$window .= "?" ;
			$week_url = $window .  $_SERVER['QUERY_STRING'] . "&weekno=$week_loop')\"><b>" ;
			$week_url .= num0($week_loop) . "</a></b>";
			
			$valids = $number - $postponed;					
	  ?>
			<tr <?php echo rowcol($week_loop);?>>
				<td class='ctd'><?php echo $week_url; ?> </td>
				<td class='ctd'><?php echo num($number,0); ?> </td>

				<td class='ctd'><?php echo num($postponed,0); ?> </td>

				<td class='ctd'><?php echo num($css,0); ?></td>
				<td class='ctd bold'><?php echo num(($css / ($valids>0? $valids :1)) * 100, 2); ?>%</td>

				<td class='ctd'><?php echo num($paw_correct,0); ?> </td>
				<td class='ctd bold'><?php echo num(($paw_correct / ($valids>0? $valids :1) ) * 100, 2); ?>%</td>

			</tr>
		<?php
			}else{
					
					echo blank_line($week_loop,"-");
			}
								
		
		$t_number += $number ; 
		$t_css += $css; 
		$t_paw_correct += $paw_correct; 
		$t_bookie_correct += $css; 
		$t_postponed += $postponed;
		
}// end of $week_loop

	$t_valids = $t_number - $t_postponed;	
	
	for ($i=$week_loop; $i<45; $i++):
			echo blank_line($i,'');
	endfor;		
?>


 

 <tr bgcolor="#f4f4f4">
		<td class='ctd bot'>TOTAL:</td>
		<td class='ctd bot'><?php echo num($t_number,0); ?></td>
		<td class='ctd bot'><?php echo num($t_postponed,0); ?></td>
		
		<td class='ctd bot'><?php echo num($t_bookie_correct,0); ?></td>
		<td class='ctd bot'><?php echo num(($t_bookie_correct / ($valids>0? $t_valids :1)) * 100, 2); ?>%</td>

		<td class='ctd bot'><?php echo num($t_paw_correct,0); ?></td>
		<td class='ctd bot'><?php echo num(($t_paw_correct / ($t_valids>0? $t_valids :1)) * 100, 2); ?>%</td>


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
