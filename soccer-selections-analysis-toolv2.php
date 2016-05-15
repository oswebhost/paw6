<?php

session_start();
ob_end_clean();
ob_start();

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
    $season  =$row["season"];
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

$PAGE_TITLE ="Soccer Selections Analysis Tool v2"  ;


 $pic =  $weekno ."/pic";
  
 $qry = "SELECT c.dcr_ht, c.dcr_at, c.dcr_av,c.dcr_dif,abs(c.dcr_dif) as dcrdif,f.`div`, 
        f.hteam,f.ateam,f.match_time,f.hgoal,f.agoal,f.h_s,f.a_s,f.gotit,f.mid, date_format(f.match_date,'%d-%b-%y') as mdate,
        f.hwinpb, f.drawpb, f.awinpb, f.h_odd, f.d_odd, f.a_odd, r.ptr_ht, r.ptr_at, r.ptr_av,r.ptr_dif, abs(r.ptr_dif) as ptrdif ,
        (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum ";

switch ($_GET['BETTING']){
    
    case 1: 
        $qry .= "FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r  
        WHERE c.weekno='$weekno' and c.season='$season' and  
        c.matchno=f.mid and f.season=c.season and f.weekno=c.weekno and 
        r.matchno=f.mid and r.season=c.season and r.weekno=c.weekno " ;
        break;
        
    case 2: 
    
        $qry .= ", o.hw_x, o.aw_x, o.hw_aw        
        FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, other_odds o 
        WHERE c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and f.season=c.season and f.weekno=c.weekno and 
        r.matchno=f.mid and r.season=c.season and r.weekno=c.weekno and 
        o.matchno=f.mid and o.season=c.season and o.weekno=c.weekno and o.hw_x>0 " ;
        
        break;

    case 3: 
         $qry .= ", o.hw_odd, o.aw_odd        
        FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, other_odds o 
        WHERE c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and f.season=c.season and f.weekno=c.weekno and 
        r.matchno=f.mid and r.season=c.season and r.weekno=c.weekno and 
        o.matchno=f.mid and o.season=c.season and o.weekno=c.weekno and o.hw_odd>0 " ;
        break;

    case 4: 
         $qry .= ", o.un_odd, o.ov_odd        
        FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, other_odds o 
        WHERE c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and f.season=c.season and f.weekno=c.weekno and 
        r.matchno=f.mid and r.season=c.season and r.weekno=c.weekno and 
        o.matchno=f.mid and o.season=c.season and o.weekno=c.weekno and (f.hgoal+f.agoal)<3 and o.un_odd>0 " ;
        break;
        
    case 5: 
         $qry .= ", o.un_odd, o.ov_odd        
        FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, other_odds o 
        WHERE c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and f.season=c.season and f.weekno=c.weekno and 
        r.matchno=f.mid and r.season=c.season and r.weekno=c.weekno and 
        o.matchno=f.mid and o.season=c.season and o.weekno=c.weekno and (f.hgoal+f.agoal)>2.5 and o.un_odd>0 " ;
        break;
        
}

  
  switch ($_GET['CALL'])
  { 
    case 1: $call = " and f.hgoal>f.agoal "; $row3cap = "Home Win Calls"; break;
    case 2: $call = " and f.agoal>f.hgoal "; $row3cap = "Away Win Calls"; break;
    case 3: $call = " and f.hgoal=f.agoal "; $row3cap = "Draw Calls";     break;
    case 4: $call = " "; $row3cap = "All Call Types"; break;
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
    case 1: $ordered_by = " ORDER BY r.ptr_ht "; break;
    case 2: $ordered_by = " ORDER BY r.ptr_at "; break;
    case 3: $ordered_by = " ORDER BY r.ptr_av "; break;

    case 4: $ordered_by = " ORDER BY c.dcr_ht "; break;
    case 5: $ordered_by = " ORDER BY c.dcr_at "; break;
    case 6: $ordered_by = " ORDER BY c.dcr_av "; break;

    case 7: $ordered_by = " ORDER BY f.hwinpb "; break;
    case 8: $ordered_by = " ORDER BY f.awinpb "; break;
    case 9: $ordered_by = " ORDER BY f.drawpb "; break;

    case 10: $ordered_by = " ORDER BY f.h_odd "; break;
    case 11: $ordered_by = " ORDER BY f.a_odd "; break;
    case 12: $ordered_by = " ORDER BY f.d_odd "; break;

    case 13: $ordered_by = " ORDER BY goalsum $ordered, f.hgoal $ordered, r.ptr_av "; break;
    case 14: $ordered_by = " ORDER BY goaldif "; break;
    
    case 20: $ordered_by = " ORDER BY o.hw_x "; break;
    case 21: $ordered_by = " ORDER BY o.aw_x "; break;
    case 22: $ordered_by = " ORDER BY o.hw_x "; break;
    
    case 30: $ordered_by = " ORDER BY o.hw_odd "; break;
    case 31: $ordered_by = " ORDER BY o.aw_odd "; break;
    
    case 40: $ordered_by = " ORDER BY o.un_odd "; break;
    case 41: $ordered_by = " ORDER BY o.ov_odd "; break;
    
    
  }

  

$filter='';

if ($_GET['min_odd']>0 and $_GET['max_odd']>0){

  switch ($_GET['BETTING']){
    
      case 1: 
          switch ($_GET['CALL'])
          { 
            case 1: $filter = " and f.h_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
            case 2: $filter = " and f.a_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
            case 3: $filter = " and f.d_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
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

      case  3: 
          switch ($_GET['CALL'])
          { 
            case 1: $filter = " and o.hw_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
            case 2: $filter = " and o.aw_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
          }
        break;

      case 4: 
          switch ($_GET['CALL'])
          { 
            case 1: $filter = " and o.un_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
            case 2: $filter = " and o.ov_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
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


$query1 = $qry . $_divs . $period . $call . $filter . $ordered_by . $ordered ;





if (isset($_GET['db'])){
  $page_title = "Soccer Selections Analysis Tool " . s_title($db) . " Season $season Week $weekno";
}else{
  $page_title = "Soccer Selections Analysis Tool";
}  




?>


<html !DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<head>

<link rel="shortcut icon" href="<?=$domain?>/images/betware.ico">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="title" content="<?echo $page_title ?>">

<link rel="stylesheet" type="text/css" href="<?=$domain?>/css/style_v4.css" media="screen">

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
<?php  page_header("Soccer Selections Analysis Tool"); $page_title ="Soccer Selections Analysis Tool "; ?>

<div style="padding-bottom:5px"></div>

<? if (isset($_GET['db'])){ 

    if (strlen($errlog)>0){
    	echo "<div class='errordiv' style='width:835px;margin:0 auto 10px auto;'>$errlog</div>";
    }        
    
?>

<div style='width:1010px; margin:auto auto;'>
<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>
</div>

<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="1000">
	 
	  <form method="get" action="<?echo $PHP_SELEF;?>">
        <input type="hidden" name="db" value="<?echo $_GET['db'];?>"/>
		

		<tr>
        
    		<td width='80' class='rtd'><b><font size="2" color="#0000FF">Season</font></b></td>
    		<td width="200">
		    <select size="1" name="season" class="text" style='padding:3px;width:180px;' onChange="this.form.submit();">
			  <? 
			   
				  $sqry = "SELECT distinct(season) as season from cur_reb order by season desc limit 1" ;
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


		  <td class='rtd'><b><font size="2" color="#0000FF">Division</font></b></td>
	
	      <td>
		   <select size="1" name="DIV" class="text" style="width:200px; padding:3px;">

            <? if ($db=='eu'){ ?>
		            <option value="0" <?echo selected($_GET['DIV'],'0')?>>UK/European Premier Divisions</option> 
                    <option value="1" <?echo selected($_GET['DIV'],'1')?>>UK/European Major Divisions</option> 
                    <option value="2" <?echo selected($_GET['DIV'],'2')?>>UK Minor Divisions</option> 
            
                    <optgroup label="One Division Only">
          			<? for ($_i=0; $_i<count($arry_div); $_i++){ ?>
          			   <? if ($_i<>5 and $_i<>10 and $_i<>19){ ?>
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
                <select size="1" name="BETTING" class="text" style="width:180px;padding:3px;" onchange="this.form.submit();">
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
          <?}?>
          
           <? if ($_GET['BETTING']=="2"){ ?>   
              <optgroup label="Double Chance Odds">  
                <option value="20" <?echo selected($_GET['SORTBY'],'20')?>>DC 1/X Odds</option>
                <option value="21" <?echo selected($_GET['SORTBY'],'21')?>>DC 2/X Odds</option>
                <option value="22" <?echo selected($_GET['SORTBY'],'22')?>>DC 1/2 Odds</option>
              </optgroup>
          <?}?>
          
          <? if ($_GET['BETTING']=="3"){ ?>   
              <optgroup label="Win Only Odds">  
                <option value="30" <?echo selected($_GET['SORTBY'],'30')?>>Home Win Only Odds</option>
                <option value="31" <?echo selected($_GET['SORTBY'],'31')?>>Away Win Only Odds</option>
              </optgroup>
          <?}?>
          
          <? if ($_GET['BETTING']=="4" or $_GET['BETTING']=="5"){ ?>   
              <optgroup label="Under/Over Odds">  
                <option value="40" <?echo selected($_GET['SORTBY'],'40')?>>Under 2.5 Goals Odds</option>
                <option value="41" <?echo selected($_GET['SORTBY'],'41')?>>Over 2.5 Goals Odds</option>
              </optgroup>
          <?}?>
          
          <optgroup label="Goals">  
            <option value="13" <?echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
            <option value="14" <?echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
          </optgroup>

          <optgroup label="Probabilities">    
            <option value="7" <?echo selected($_GET['SORTBY'],'7')?>>Home Win Probabilities</option>
            <option value="8" <?echo selected($_GET['SORTBY'],'8')?>>Away Win Probabilities</option>
            <option value="9" <?echo selected($_GET['SORTBY'],'9')?>>Draw Probabilities</option>
          </optgroup>    
          <optgroup label="1X2 Reliability">  
            <option value="1" <?echo selected($_GET['SORTBY'],'1')?>>Home Team 1X2 Reliability</option> 
            <option value="2" <?echo selected($_GET['SORTBY'],'2')?>>Away Team 1X2 Reliability</option>
            <option value="3" <?echo selected($_GET['SORTBY'],'3')?>>Average 1X2 Reliabilities</option>
          </optgroup>    
          <optgroup label="Double Chance Reliability">  
            <option value="4" <?echo selected($_GET['SORTBY'],'4')?>>Home Team DC Reliabilities</option>
            <option value="5" <?echo selected($_GET['SORTBY'],'5')?>>Away Team DC Reliabilities</option>
            <option value="6" <?echo selected($_GET['SORTBY'],'6')?>>Average DC Reliabilities</option>
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
          
          
          <td class='rtd'><b><font size="2" color="#0000FF">PaW Call Type</font></b></td>
              <td>
    		  <select size="1" name="CALL" class="text" style="width:180px;padding:3px;">
              
               <? if ($_GET['BETTING']==1 or $_GET['BETTING']==4 or $_GET['BETTING']==5){ ?>
        		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win Calls</option> 
                   <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win Calls</option>
                   <option value="3" <?echo selected($_GET['CALL'],'3')?>>Draw Calls</option>
               <?}?>
               
               <? if ($_GET['BETTING']==2){ ?>
        		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win/Draw Calls</option> 
                   <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win/Draw Calls</option>
               <?}?>
               
               
                 <? if ($_GET['BETTING']==3){ ?>
        		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win Calls</option> 
                   <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win Calls</option>
               <?}?>



    		  </select>
    		</td>
          
          
            <td class='rtd'><b><font size="2" color="#0000FF">Odds Range</font></b></td>
            <td><input type='text' style='width:40px;text-align:center;' name='min_odd' value='<?php echo $_GET['min_odd']?>'/> Min
              &nbsp;<input type='text' style='width:40px;text-align:center;' name='max_odd' value='<?php echo $_GET['max_odd']?>'/> Max
            </td>
            
            <td></td>
            <td></td>
       </tr>

		  <tr>
		      <td colspan='6' class='ctd padd'>
		      <input type="submit" value="View Data" name="B1" class="bt" style="padding:0px;"/>

		   </td>
		</tr>
        </form>
</table>


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
    

week_box_new_3rows( "Soccer Selections Analysis Tool", $weekno, $wdate, $season,$row3cap . "<br><font size='1' color='#000000'>$_prerid</font>",900); ?>
   

<div style='width:900px; margin:auto auto;text-align:justify;padding:8px 5px;font-size:10px;line-height:130%;font-family:verdana;'>
    
    The “Probabilities” refer to the chances of a Home Win (HW), a Draw (D) or an Away Win (AW) occurring.
    <br />
    For the “1X2 Reliabilities”, when applied to <strong>Home Win Calls</strong> they refers to the Home Team’s actual WINNING capability, while the Away Team’s 1X2 Reliability refers to the Away Team’s actual LOSING capability.  When applied to <strong>Away Win Calls</strong>, the “Away Team 1X2 Reliability” refers to the Away Team’s actual WINNING capability, while the Home Team’s 1X2 Reliability refers to the Home Team’s actual LOSING capability.  The “Average” 1X2 Reliability is the straight average of the combined “Winning” and “Losing” capabilities for the 2 different scenarios (Home Win Calls or Away Win Calls).  The same thing exactly applies to the “DC Reliabilities”.    
  
 
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

    <td width="38%"  class='ctd' rowspan="2"><img src="images/tbcap/flist.gif" border='0' alt=''/></td>

  
    <td width="5%"  class='ctd' rowspan="2"><img src="images/tbcap/div.gif" border='0' alt=''/></td>
  
    <td width="6%"  class='ctd' rowspan="2"><img src="images/tbcap/asl.gif" border='0' alt=''/></td>
    <td width="6%"  class='ctd' rowspan="2"><img src="images/tbcap/act.gif" border='0' alt=''/></td>

    <td width="6%"  class='ctd' style='padding:0' rowspan="2"><img src="images/tbcap/asltotgls.gif" border='0' alt=''/></td>
    <td width="6%"  class='ctd dark' style='padding:0' rowspan="2"><img src="images/tbcap/actgls.gif" border='0' alt=''/></td>

    <td class='ctd dark' colspan="3"><img src="images/tbcap/probs2.gif" border='0' alt=''/></td>
    <td class='ctd dark' colspan="3"><img src="images/tbcap/1x2rebinfo.gif" border='0' alt=''/></td>
    <td class='ctd dark' colspan="3"><img src="images/tbcap/dcrebinfo.gif" border='0' alt=''/></td>
    
    <? if ($_GET['BETTING']==1){?>
        <td class='ctd' colspan="3"><img src="images/tbcap/odd2.gif" border='0' alt=''/></td>
    <?}?>

    <? if ($_GET['BETTING']==2){?>
        <td class='ctd' colspan="3"><img src="images/tbcap/dc_odds.gif" border='0' alt=''/></td>
    <?}?>
    
     <? if ($_GET['BETTING']==3){?>
        <td class='ctd' colspan="2"><img src="images/tbcap/winonly_odds.gif" border='0' alt=''/></td>
    <?}?>
    
     <? if ($_GET['BETTING']=="4" or $_GET['BETTING']=="5"){?>
        <td class='ctd' colspan="2"><img src="images/tbcap/uo_odds.gif" border='0' alt=''/></td>
     <?}?>
    
</tr>

<tr bgcolor="#d3ebab">
  <td class='ctd'><img src="images/tbcap/homeW.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/d.gif" border='0' alt=''/></td>
  <td class='ctd dark'><img src="images/tbcap/aW.gif" border='0' alt=''/></td>
  
  <td class='ctd '><img src="images/tbcap/hteam-sm.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/ateam-sm.gif" border='0' alt=''/></td>
  <td class='ctd dark'><img src="images/tbcap/avg-sm.gif" border='0' alt=''/></td>
  
  <td class='ctd'><img src="images/tbcap/hteam-sm.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/ateam-sm.gif" border='0' alt=''/></td>
  <td class='ctd dark'><img src="images/tbcap/avg-sm.gif" border='0' alt=''/></td>
 
 
  <? if ($_GET['BETTING']==1){?>
      <td class='ctd '><img src="images/tbcap/home.gif" border='0' alt=''/></td>
      <td class='ctd'><img src="images/tbcap/d.gif" border='0' alt=''/></td>
      <td class='ctd'><img src="images/tbcap/a.gif" border='0' alt=''/></td>
  <?}?>

 <? if ($_GET['BETTING']==2){?>
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
}else{
   $temp = $sa->prepare($query1);
}

   $temp->execute();
    
    $total_rec = $temp->rowCount();
    
    if ($temp->rowCount()==0){
       echo "<tr><td colspan='20' class='ctd' style='padding:30px;'><span class='error'>No Match for selected options</span></td></tr>";
    }else {
        
    $pic = "/pic/" ;
    $pic =  $weekno ."/pic";
    $number=0;
    $ngot =0 ;
    $css =0;
    $postponed = 0;
    $win_odds = 0;
     $nobets =  0;

    while ($row = $temp->fetch()) {
        
        $number++;
        $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        
        

            
        $title = "$row[hteam] v $row[ateam] match odds" ;
        $odd=0;
        //$odd = show_rebs($matchno,$_GET['weekno'],$_GET['season'],$_GET['MPRED'],$db);
  
        $asl_class ="";
        $dc_char = '';
       
        
      switch ($_GET['BETTING']){
        
        case 1:
            $captions = "For Standard 1X2 Betting";
             $ngot += $row['gotit'] ;
             if ($row['gotit']=='1' and $row['h_s']<>'P'){
                $asl_class = " gotrt";
                switch ($_GET['CALL']){
                  case 1: $win_odds+= $row['h_odd']; break;
                  case 2: $win_odds+= $row['a_odd']; break;
                  case 3: $win_odds+= $row['d_odd']; break;
                }
            }
            break;
        
        case 2:     // double change WIN or Draw
             $captions = "For Standard Double Change Betting";
               $dc_char = dc_char($row['h_s'], $row['a_s'], $row['hgoal'], $row['agoal']);   
               if ($dc_char=="Y"){
                 $asl_class = " gotrt"; $ngot ++;
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
                 $asl_class = " gotrt"; $ngot ++;
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
            
            if ($asl_sum>2.5 and $act_sum>2.5){
                $asl_class = " gotrt"; $ngot ++;
                $win_odds+= $row['ov_odd']; 
            }
            
            if ($asl_sum<2.5 and $act_sum<2.5){
                $asl_class = " gotrt"; $ngot ++;
                $win_odds+= $row['un_odd']; 
            }
            
            break;
        
       } 
        
        
        
        if ($asl==$act){
            $asl_class = " gotasl";
            $css ++;
        }
      
        if ($row['h_s']=='P'){
            $asl_class = " pp";
            $postponed++;
           
        }
        
        $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$_GET['season'],$db)){
            $pr = " pr2";
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
    
    
    <td class="ctd <?echo $asl_class . $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
    <td class="ctd  <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>

    <?php if ($_GET['CALL']==2){?>
      <td class="ctd" <?echo ($_GET["SORTBY"]=='13'? "bgcolor='#D3EBAB'": "");?>><?echo num0($row['agoal'] + $row['hgoal']); ?></td>
    <?}else{?>  
      <td class="ctd" <?echo ($_GET["SORTBY"]=='13'? "bgcolor='#D3EBAB'": "");?>><?echo num0($row['hgoal'] + $row['agoal']); ?></td>
    <?}?>

     <td class="ctd dark"><?echo num0($row['a_s'] + $row['h_s']); ?></td>

    <td class="ctd" <?echo ($_GET["SORTBY"]=='7'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["hwinpb"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='9'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["drawpb"]); ?></td>
    <td class="ctd dark" <?echo ($_GET["SORTBY"]=='8'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["awinpb"]); ?></td>

    <td class="ctd" <?echo ($_GET["SORTBY"]=='1'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ptr_ht"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='2'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ptr_at"]); ?></td>
    <td class="ctd dark" <?echo ($_GET["SORTBY"]=='3'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["ptr_av"]); ?></td>
    

    <td class="ctd" <?echo ($_GET["SORTBY"]=='4'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_ht"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='5'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_at"]); ?></td>
    <td class="ctd dark" <?echo ($_GET["SORTBY"]=='6'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_av"]); ?></td>
    
    
    <? if ($_GET['BETTING']==1){?>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='10'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["h_odd"]); ?></a></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='12'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["d_odd"]); ?></a></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='11'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["a_odd"]); ?></a></td>
    <?}?>
    
    <? if ($_GET['BETTING']==2){?>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='20'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["hw_x"]); ?></a></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='21'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["aw_x"]); ?></a></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='22'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["hw_aw"]); ?></a></td>
    <?}?>

    <? if ($_GET['BETTING']==3){?>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='30'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["hw_odd"]); ?></a></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='31'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["aw_odd"]); ?></a></td>
    <?}?>

    <? if ($_GET['BETTING']==4 or $_GET['BETTING']==5){?>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='40'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["un_odd"]); ?></a></td>
        <td class="ctd" <?echo ($_GET["SORTBY"]=='41'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["ov_odd"]); ?></a></td>
    <?}?>
    
</tr>

<?    }
    }  


if ($_GET['weekno'] <> cur_week($db)) {
?>
<tr bgcolor="#f4f4f4">
    
    
    <td colspan="3" class="rtd padd bot">Total Correct Calls&nbsp;</td>
    <td colspan="1" class="ctd padd bot"><?echo $ngot; ?></td>
    <td colspan="2" class="ctd padd bot"><?echo ($number>0 ? num2(($ngot/($number-$postponed-$nobets))*100) ."%" : "") ; ?></td>

    <td colspan="5" class="rtd padd bot">Total Correct Score Hits&nbsp;</td>
    <td colspan="1" class="ctd padd bot"><?echo $css; ?></td>

    <td colspan="6" class="rtd padd bot">Postponed/Void Matches&nbsp;</td>
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
    <td colspan="6" class="ltd padd bot">&nbsp;<?echo $captions; ?>  </td>
  </tr>  
<?}?>


</table>

<?
 foreach($_GET as $key => $value){
    
    $url .= "$key=$value&";
 }
 
 $summaryURL = "javascript:tell('weekbyweeksummary.php?" . substr($url, 0, strlen($url)-14) ."')" ;
?>
<div class='error_div' style="text-align: center;padding:10px;width:500px;margin:10px auto 10px auto">
    <a href="<? echo $summaryURL ?>"><span class="bb" style="font-size: 18px;">Weekly Summary for Season <?echo $_GET['season'];?></span></a>
</div>

<!-- stopprint -->

<?php }?>


</body>

</html>