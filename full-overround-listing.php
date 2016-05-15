<?php

require_once("config.ini.php");
require_once("function.ini.php");

if (!isset($_REQUEST['db'])){
	require_once("header.ini.php");
	require_once("select-option.ini.php");
	require_once("footer.ini.php");
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

$tmpData =  uniqid('tmp_');

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
	$calltype = 4;
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

require_once("header.ini.php");



page_header("Current Week's Odds") ;

require_once("overround-class.php");


if (isset($_GET['db'])){ 
    if (strlen($errlog)>0)		echo "<div class='errordiv'>$errlog</div>";
 }       


?>
<div class="report_blue_heading" style="float:left;width: 320px;"><?php echo site($db);?></div>

<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?php echo site_other($db);?></div>


<div class='clear'></div>

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Specific Call Type Over-Rounds - All Matches Combined</div>



<div style="padding-bottom:2px"></div>




<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="560">
	 
	  <form method="get" action="<?php echo $PHP_SELEF;?>">
        <input type="hidden" name="db" value="<?php echo $_GET['db'];?>"/>
		
		<tr>
        	<td class='rtd' width="100"><b><font size="2" color="#0000FF">Week No</font></b></td>
    	    <td colspan="3"> 
    		  <select size="1" name="weekno" class="text"  style='padding:3px;'>

    		  <?php 
                    $max_week = find_last_week_of_season(curseason($db),$db) ;
                    if (isset($_GET['season'])){
                      $max_week = find_last_week_of_season($_GET['season'],$db) ;
                    }
                    for ($i=$max_week; $i>=1; $i--) : 
              ?>
                    
            	     <option value="<?php echo  $i;?>" <?php if($i==$weekno): echo " selected"; endif;?>>&nbsp;<?php echo  $i;?>&nbsp;&nbsp;&nbsp;</option>
    		
                  <?php endfor; ?>		 
    
       		  </select>
              
                   <font style='font-size:12px;'><b><?php echo find_week_dates($season, $weekno, $db);?></b></font>  
    
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

           <optgroup label="Over-rounds">  
                <option value="1" <?php if($_GET['SORTBY']==1) echo 'selected';?>>Home Over-round value</option>
                <option value="2" <?php if($_GET['SORTBY']==2) echo 'selected';?>>Draw Over-round value</option>
                <option value="3" <?php if($_GET['SORTBY']==3) echo 'selected';?>>Away Over-round value</option>
                <option value="4" <?php if($_GET['SORTBY']==4) echo 'selected';?>>Match Over-round value</option>
            </optgroup>

          <optgroup label="Odds">  
            <option value="10" <?php echo selected($_GET['SORTBY'],'10')?>>Home Wins Odds</option>
            <option value="11" <?php echo selected($_GET['SORTBY'],'11')?>>Away Wins Odds</option>
            <option value="12" <?php echo selected($_GET['SORTBY'],'12')?>>Draw Odds</option>
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
<td width='20%'> <a class='sbar' href="bookies-odds-soccer-betting.php?db=<?php echo $db;?>"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
<td width='70%' class='ctd'>
	</td>
	<td width='10%'align="right"> <?php echo printscr(); ?></td>
</tr>
</table>


<div style="padding-bottom:10px"></div>


  <!-- startprint -->
<?php if(isset($weekno) ): 

week_box_nocap($weekno, $wdate,$season,570);


?>


             
<div style="padding-bottom:10px"></div>

<?php over_round_msg();?>


<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="570" cellpadding='3' bgcolor="#f6f6f6">
<tr bgcolor="#d3ebab">

  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>

  <?php if( ($DIV=='FA') or ($DIV=='SA') or ($DIV=='IN')) : ?>
	   <td width="80" class='ctd' rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/>
  <?php else: ?>
		 <td width="10%" class='ctd'rowspan="2"><img src="images/tbcap/datepic.gif" border="0" alt=""/>
  <?php endif; ?>
  </td>
  <td width="38%" class='ctd' rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
  <td class='ctd' rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
  <td width="24%" class='ctd' colspan="3"><img src="images/tbcap/odd2.gif"  border='0' alt=""/></td>
  <td width="24%" class='ctd' colspan="4"><img src="images/tbcap/over2.gif"  border='0' alt=""/></td>
</tr>

<tr bgcolor="#d3ebab">
	<td width="8%" class='ctd'><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/a.gif"  border='0' alt=""/></td>

	<td width="8%" class='ctd'><img src="images/tbcap/m.gif"  border='0' alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/a.gif"  border='0' alt=""/></td>
</tr>



<?php
     if (!isset($_GET["B1"])){
        $_GET['CALL'] = 1;
        $_GET['SORTBY'] = 1;
        $_GET['PERIOD'] = '1';
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
        case 1: $ordered_by = " ORDER BY hover "; break;
        case 2: $ordered_by = " ORDER BY dover "; break;
        case 3: $ordered_by = " ORDER BY aover "; break;
    
        case 4: $ordered_by = " ORDER BY overround "; break;
        
    
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

    $query1 = "create table $tmpData as (SELECT (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum, f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb, f.weekno, f.mid,
     f.h_odd, f.d_odd, f.a_odd, f.h_odd as bookie_real_home, f.d_odd as bookie_real_draw, f.a_odd as bookie_real_away,
     f.h_odd as overround,f.h_odd as odd_sum, f.h_odd as hover, f.h_odd as dover, f.h_odd as aover, f.`div`, f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r WHERE 
    f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and cat='fixt' and
     f.h_odd>0 $period $call $_divs $filter $ordered_by $ordered, f.match_date, f.match_time, f.hteam,f.ateam)";

  
  
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
	$query1 = "select f.* from $tmpData f $ordered_by $ordered";
   
    
	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();

     

    $number = 0;
    $ngot = 0;
    $css = 0;
    
  if ($temp->rowCount()>0){
    
    while ($row = $temp->fetch()) {

    	$number++;
	    $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;

        
         // find over-round [overround-class.php]
        $or = new overround();
        $or->find_or($row['h_odd'], $row['d_odd'], $row['a_odd'], $row['hwinpb'],$row['drawpb'],$row['awinpb']);

        
        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&site=$db')\">";
        $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?site='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
        
        $title = "$row[hteam] v $row[ateam] match odds" ;
        $odd=0;
         
  
        $asl_class ="";
       
 		$sbar = "sbar";

        if ($row['gotit']=='1' and $row['h_s']<>'P'){
            $asl_class = " gotrtblue";
        }elseif ($row['gotit']=='0' and $row['h_s']<>'P'){
        	$asl_class = " wrong";
        	$sbar= "sWrg";
        }

        if (strlen($act)<2){

        	$asl_class='';
        	$sbar = 'sbar';
        }
        
        if ($asl==$act){
            $asl_class = " gotaslblue";
            $css ++;
        }
        
        if ($row['h_s']=='P'){
            $asl_class = " pp";
        }
        
        $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$season,$db)){
            $pr = " pr";
        }

          //over founds
        $hor = ($or->home_value==1? " h_Or" : "");
        $aor = ($or->away_value==1? " a_Or" : "");


?>

	<tr <?php echo rowcol($number);?>>
		<td class="ctd padd"><?php echo $number; ?></td>
	    <td class="ctd "><a class='md2' <?php echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?php echo $matchno;?>&site=<?php echo $db;?>'><?php echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

	    <td class='padd ltd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?php echo $row['hteam']?>&site=<?php echo $db;?>">
	        <?php echo $row['hteam'] .'</a>' . printv(' v '); ?>
	        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?php echo $row['ateam']?>&site=<?php echo $db;?>">
	            <?php echo $row['ateam'];?></a> (<?php echo $row['div'];?>)
	    </td>
		
		<td class='ctd <?php echo $pr;?>' <?php echo (($_GET['SORTBY']==13 or $_GET['SORTBY']==14) ? "bgcolor='#D3EBAB'": "");?> ><?php echo $row['hgoal'] . dash() . $row['agoal'];?></td>
		<td class='ctd <?php echo $hor;?>' <?php echo ($_GET['SORTBY']==10 ? "bgcolor='#D3EBAB'": "");?>><?php echo show_odd($row['h_odd']);?></td>
		<td class='ctd' <?php echo ($_GET['SORTBY']==12 ? "bgcolor='#D3EBAB'": "");?>><?php echo show_odd($row['d_odd']);?></td>
		<td class='ctd <?php echo $aor;?>' <?php echo ($_GET['SORTBY']==11 ? "bgcolor='#D3EBAB'": "");?>><?php echo show_odd($row['a_odd']);?></td>
		<td class='ctd' <?php echo ($_GET['SORTBY']==4 ? "bgcolor='#D3EBAB'": "");?>><a title='Over Round Details' class='sbar' href="javascript:OrWin('overround.php?db=<?php echo $db;?>&id=<?php echo $matchno;?>')"><?php echo num20($or->match_or);?>%</a></td>
		<td class='ctd' <?php echo ($_GET['SORTBY']==1 ? "bgcolor='#D3EBAB'": "");?>><?php echo num20($row['hover']);?></td>
		<td class="ctd" <?php echo ($_GET['SORTBY']==2 ? "bgcolor='#D3EBAB'": "");?>><?php echo num20($row['dover']);?></td>
		<td class="ctd" <?php echo ($_GET['SORTBY']==3 ? "bgcolor='#D3EBAB'": "");?>><?php echo num20($row['aover']);?></td>
		
	</tr>

<?php } ?>

<?php }else{ ?>

    <tr>
        <td colspan="11" class="credit ctd padd" style="color:red;padding:10px;">No Match for selected options</td>
    </tr>

<?php } ?>

</table>


<!-- stopprint -->

<?php
	// drop temp table 
	$query1 = "drop table $tmpData";
	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();	

?>			   
			   
			   
			   



<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?php echo  $fff ?>
</td>

<td style="font-weight:normal;text-align:center;padding-top:5px;">

	<B>ASL</B>&nbsp;=&nbsp;</FONT><font size="1">Our Anticipated Score-Line&nbsp;&nbsp;
	
	<BR>
	*  Click on "Date/Time & PIC" to view <B>Performance Indicator Chart</B><BR>and associated backup data<BR>
	
	<?php if($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>

</tr>
</table>
<br>


<?php endif;?>


<div style="padding-bottom:5px">&nbsp;</div>
		
<? //require_once("pred-disclaimer.ini.php");  ?>
<?php require_once("footer.ini.php"); ?>


<?php	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>
