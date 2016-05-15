<?php
session_start();
include("config.ini.php");
include("function.ini.php");

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

if (isset($_GET['calltype'])){
	$calltype = $_GET['calltype'];
}else{
	$calltype = 1;
}


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
	$page_title = "Specific Call Type Over-Rounds - All Matches Combined " . divname($div_value) . " " . curseason()  . " Week $weekno " ;
else:
	$page_title = "Specific Call Type Over-Rounds - All Matches Combined " . curseason() ;
endif;

include("header.ini.php");

$tmpData = uniqid('tmp_');


page_header("Prediction Performance Records") ;


include("overround-class.php");

if (!isset($_GET['db'])){

	 //echo '<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Possible Value Calls</div>';
	 include("select-option.ini.php");

}else{

?>
<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">possible value calls</div>

<div style="padding-bottom:2px"></div>

<table  width="100%" border='0'>
<tr>
	<td width='10%'><?php echo back();?></td>
	<td width='80%' class='ctd'>
	</td>
	<td width='10%'align="right"> <? echo printscr(); ?></td>
	</tr>
	
	<tr>
		<td colspan='3' bgcolor='#f3f3f3' class='padd'>
		<table border="0" cellpadding="0" cellspacing="0" style='margin:auto auto;width:90%'>


		<form method="get" action="<?php echo $PHP_SELF ?>">
			<input type="hidden" name="db" value="<?php echo $_GET['db'];?>">
		<tr>
        	<td class='rtd' width="100"><b><font size="2" color="#0000FF">Season</font></b></td>
    	    <td> 
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
			      <option value="<?= $sr["season"] ?>" <?echo selected($season,$sr["season"])?>><?= $sr["season"] ?></option>
			  
			  <?php endwhile; ?>
			  </select>
              
                     
    
    		 </td>

		   <td  class='rtd'><b><font size="2" color="#0000FF">For:</font></b></td>
		   <td>
		  	<select size="1" name="formatch" class="text" style="width:150px;" >
                <option value="1" <? if ($_GET['formatch']==1) echo 'selected';?>>Full Week (Mon - Sun)</option>
                <option value="2" <? if ($_GET['formatch']==2) echo 'selected';?>>Weekend (Sat - Sun)</option>
                <option value="3" <? if ($_GET['formatch']==3) echo 'selected';?>>Midweek (Mon - Fri)</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td class='rtd'><b><font size="2" color="#0000FF">Call Type:</font></b></td>
		<td>
		  	<select size="1" name="calltype" class="text" style="width:160px;" >
                <option value="1" <? if ($calltype==1) echo 'selected';?>>Home Win Calls</option>
                <option value="2" <? if ($calltype==2) echo 'selected';?>>Away Win Calls</option>
		  </select>
		 </td>   
		 <td class='rtd'></td>
		 <td>
		</td>
		</tr>	

		<tr>
		<td class='rtd'><b><font size="2" color="#0000FF">Sort On:</font></b></td>
		<td colspan="2">
		  	<select size="1" name="sortby" class="text" style="width:160px;">
                <option value="5" <? if ($_GET['sortby']==5) echo 'selected';?>>Home Odds</option>
                <option value="6" <? if ($_GET['sortby']==6) echo 'selected';?>>Away Odds</option>
                
                <option value="1" <? if ($_GET['sortby']==1) echo 'selected';?>>Home Over-round value</option>
                <option value="2" <? if ($_GET['sortby']==2) echo 'selected';?>>Draw Over-round value</option>
                <option value="3" <? if ($_GET['sortby']==3) echo 'selected';?>>Away Over-round value</option>
                <option value="4" <? if ($_GET['sortby']==4) echo 'selected';?>>Match Over-round value</option>
		  </select>
		  <select size="1" name="ordered" class="text" style="width:70px;" >
                <option value="1" <? if ($_GET['ordered']==1) echo 'selected';?>>00 - 99 </option>
                <option value="2" <? if ($_GET['ordered']==2) echo 'selected';?>>99 - 00</option>
		  </select>

		 </td>   
		 
         
         </td>
		 <td class='ctd'><input type="submit" value="View Data" name="B1" class="bt" style="padding:4px 8px;"/></td>
		</tr>	
		</form>
	</table>
		</td>
	</tr>	
	</table>


  <!-- startprint -->
             
<div style="padding-bottom:10px"></div>



<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="570" cellpadding='3'>
  <tr bgcolor="#d3ebab">
    <td width='100' class='ctd padd bot'>Week<br/>No</td>    
    
    <td width='100' class='ctd padd bot'>Total<br/>Matches</td>
    <td width='100' class='ctd padd bot'>Postponed<br/></td>    
    
    <td width='100' class='ctd padd bot'>Total<br/>Correct Score<br/>Hits</td>
    <td width='100' class='ctd padd bot'>Total<br/>Double Chance<br/>Hits</td>    

    <td width='100' class='ctd padd bot'>Total<br/>Correct Calls</td>
    <td width='100' class='ctd padd bot'>Total<br/>Correct Calls<br/>%</td>
    
    
   </tr> 


<?
 	$period = "";
	$_sortby = "h_odd"; 
	$_ordered = " "; 
	$_call = " and f.hgoal > f.agoal";
	$value = " hwinpb >= 50.00 and hover <= 5.00" ;

	switch ($_GET['formatch'])
	{
	    case 1: $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
	    case 2: $period = " and weekday(match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
	    case 3: $period = " and weekday(match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;
	}
	


	switch ($_GET['sortby'])
	{
	    case 1: $_sortby = "hover"; break;
	    case 2: $_sortby = "dover"; break;
	    case 3: $_sortby = "aover"; break;
	    case 4: $_sortby = "overround"; break;
        case 5: $_sortby = "h_odd"; break;
        case 6: $_sortby = "a_odd"; break;
	}

	switch ($_GET['ordered'])
	{
	    case 1: $_ordered = " "; break;
	    case 2: $_ordered = " desc "; break;
	}
	
	
	switch ($calltype)
	{
	    case 1: $_call = " and f.hgoal > f.agoal";  $value = " hwinpb >= 50.00 and hover <= 5.00" ; break;
	    case 2: $_call = " and f.agoal > f.hgoal";  $value = " awinpb >= 50.00 and aover <= 5.00" ; break;
	}


$mx_week = find_last_week_of_season($season,$db);

// don't display current week 
if($season == curseason($db)){
	$mx_week --;
}

$t_number = 0;  $t_ngot = 0;  $t_css = 0;  $t_dcc = 0;  $t_ppp = 0;
	
for ($week_loop=1; $week_loop<=$mx_week; $week_loop++){
	
	$tmpData = uniqid('tmp_');
	
    $query1 = "create TEMPORARY TABLE $tmpData as (SELECT f.hgoal, f.agoal, f.gotit, f.mvalue, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb, f.weekno, f.mid,
     f.h_odd, f.d_odd, f.a_odd, f.h_odd as bookie_real_home, f.d_odd as bookie_real_draw, f.a_odd as bookie_real_away,
     f.h_odd as overround,f.h_odd as odd_sum, f.h_odd as hover, f.h_odd as dover, f.h_odd as aover, f.`div`, f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r WHERE 
    f.weekno='$week_loop'  and f.season='$season' and f.`div`=r.matchtype and cat='fixt' and
     f.h_odd>0 $period $_call ORDER BY f.h_odd, f.match_date, f.match_time, f.hteam,f.ateam)";


	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();


    $odd_sum = 1 ;
	
	
 
	//Match Overround
    $query1 = "update $tmpData set overround = ((1/h_odd) + (1/d_odd) + (1/a_odd) -1) *100, odd_sum=((1/h_odd)*100) + ((1/d_odd)*100) + ((1/a_odd)*100)";
    if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();

    // step one for Call type Over round.
	$query1 = "update $tmpData set bookie_real_home = (((1/h_odd)*100)/ odd_sum) * 100, 
								  bookie_real_away = (((1/a_odd)*100)/ odd_sum) * 100,
								  bookie_real_draw = (((1/d_odd)*100)/ odd_sum) * 100";
    if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();

    // step two for Call type Over round.
	$query1 = "update $tmpData set hover = ((bookie_real_home-hwinpb)/bookie_real_home) * 100, 
								  aover = ((bookie_real_away-awinpb)/bookie_real_away) * 100,
								  dover = ((bookie_real_draw-drawpb)/bookie_real_draw) * 100";
    
    if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();
      
	// final selection for Listing data ....
	$query1 = "select * from $tmpData where $value order by $_sortby $_ordered";
	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();

     

    $number = 0;  $ngot = 0;  $css = 0;  $dcc = 0;  $ppp = 0;

    while ($row = $temp->fetch()) {

    	$number++;
	    $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;
        
        $dcc += $row['gotit'];

        
        $title = "" ;
        $odd=0;
         
  
        $asl_class ="";
 
        if ($asl==$act){
            $css ++;
        }
        
        if ($row['h_s']=='P'){
            $ppp++;
        }
        
      

 
        // double changes
        if ($row['mvalue']=='1'){
          if ( ($calltype==1) and ($row['h_s']==$row['a_s']) ) {
          	$dcc ++;
          }
          if ( ($calltype==2) and ($row['h_s']==$row['a_s']) ) {
          	$dcc ++;
          }
        }     
         
 

	} //endof weekly loop
	
	  	if($number>0){
			$mywin = "mywin";
			$window ='<a class="sbar" href="javascript:sele_win(\'weekly-possible-value-bets-listing.php';
			$window .= "?" ;
			$week_url = $window .  $_SERVER['QUERY_STRING'] . "&weekno=$week_loop')\"><b>" ;
			$week_url .= num0($week_loop) . "</a></b>";
			
			$valids = $number - $ppp;					
	  ?>
			<tr <?php echo rowcol($week_loop);?>>
				<td class='ctd'><?php echo $week_url; ?> </td>
				<td class='ctd'><?php echo num($number,0); ?> </td>

				<td class='ctd'><?php echo num($ppp,0); ?> </td>

				<td class='ctd'><?php echo num($css,0); ?></td>
				<td class='ctd'><?php echo num($dcc, 0); ?></td>
				<td class='ctd'><?php echo num($ngot, 0); ?></td>
				<td class='ctd bold'><?php echo num(($ngot / ($valids>0? $valids :1) ) * 100, 2); ?>%</td>

			</tr>
		<?php
			}else{
					
					echo blank_line($week_loop,"-");
			}
								
	
	
	$t_number += $number;  
	$t_ngot += $ngot;  
	$t_css += $css;  
	$t_dcc += $dcc;  
	$t_ppp += $ppp;
	
	
	

} // endof week_loop

	$t_valids = $t_number - $t_ppp;	
	
	for ($i=$week_loop; $i<45; $i++):
			echo blank_line($i,'');
	endfor;		

?>


  <tr bgcolor="#f4f4f4">
	<td class='rtd bot'>TOTAL: </td>
	<td class='ctd bot'><?php echo num($t_number,0); ?> </td>
	<td class='ctd bot'><?php echo num($t_ppp,0); ?> </td>
	<td class='ctd bot'><?php echo num($t_css,0); ?></td>
	<td class='ctd bot'><?php echo num($t_dcc, 0); ?></td>
	<td class='ctd bot'><?php echo num($t_ngot, 0); ?></td>
	<td class='ctd bot'><?php echo num(($t_ngot / ($t_valids>0? $t_valids :1) ) * 100, 2); ?>%</td>
                  
  </tr> 

</table>


<!-- stopprint -->

<?php
	// drop temp table 
	$query1 = "drop TEMPORARY table $tmpData";
	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();	


?>			   
			   
			   
			   





		
<? 

}

include("footer.ini.php"); ?>


<?	
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
