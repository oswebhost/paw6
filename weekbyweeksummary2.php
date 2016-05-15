<?php


/**
 * @author IM Khan
 * @copyright 2013
 * 
 * 13786215 job order globe === june 20
 * ref: ofu13060007078
 *  
 * u b 1mb = 
 * 
 * 3m= 1599  
 * 
 * 
 * 5mb =  
 * 
 * 
 * due: 4704---* 2370--
 * 
 */

session_start();
ob_end_clean();
ob_start();

include("config.ini.php");
include("function.ini.php");
include("combinations.php");

$season = $_GET['season'];

foreach($_GET as $key => $value){

    $url .= "$key=$value&";
}
 
 
?>


<html !DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<head>

<link rel="shortcut icon" href="<?=$domain?>/images/betware.ico">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="title" content="Soccer Predictions Analysis Tool (SoccerPAT) <?echo $page_title ?>">

<title> processing data - please wait for a few seconds</title>

<link rel="stylesheet" type="text/css" href="<?=$domain?>/css/style_v4.css" media="screen">

<style>
  .dark {border-right:2px solid #333;}
  .row:hover {background-color: #e4d4d4}
</style>
</head>


<body>

<?php  page_header("Summary for Season $_GET[season]"); 
       $page_title ="Summary for Season $_GET[season]  ";

?>

<div style="padding-bottom:5px"></div>

<? if (isset($_GET['db'])){ 
     
?>

<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="90%   ">
	 
	  <form method="get" action="<?echo $PHP_SELEF;?>">
        <input type="hidden" name="db" value="<?echo $_GET['db'];?>"/>
        <input type="hidden" name="season" value="<?echo $_GET['season'];?>"/>
		

		<tr>
           <td class='rtd'><b><font size="2" color="#0000FF">Bet Types </font></b></td>
            <td>
                <select  size="1" name="BETTING" class="text" style="width:120px;padding:3px;" onchange="this.form.submit();">
              		 <option value="1" <?echo selected($_GET['BETTING'],'1')?>>1X2 Betting</option> 
                     <option value="2" <?echo selected($_GET['BETTING'],'2')?>>Double Chance Betting</option>
                     <option value="3" <?echo selected($_GET['BETTING'],'3')?>>Win Only Betting</option>
                     <option value="4" <?echo selected($_GET['BETTING'],'4')?>>Under 2.5 Goals Betting</option>
                     <option value="5" <?echo selected($_GET['BETTING'],'5')?>>Over 2.5 Goals Betting</option>
      		  </select>
            
            </td>


		  <td class='rtd' style="width: 100px;"><b><font size="2" color="#0000FF">Division</font></b></td>
	
	      <td>
		   <select size="1" name="DIV" class="text" style="width:268px; padding:3px;">

            <? if ($_GET['db']=='eu'){ ?>
		            <option value="0" <?echo selected($_GET['DIV'],'0')?>>UK/European Premier Divisions</option> 
                    <option value="1" <?echo selected($_GET['DIV'],'1')?>>UK/European Major Divisions</option> 
                    <option value="2" <?echo selected($_GET['DIV'],'2')?>>UK Minor Divisions</option> 
            
                    <optgroup label="One Division Only">
          			<? for ($_i=0; $_i<count($arry_div); $_i++){ ?>
          			   <? if ($_i<>4 and $_i<>9 and $_i<>18){ ?>
          					<option value="<? echo $arry_div[$_i];?>" <? echo selected($_GET['DIV'], $arry_div[$_i]);?>><? echo divname($arry_div[$_i]); ?></option>
          			   <? } ?>
          			<? } ?>
                    </optgroup>
             <?}?>

            <? if ($_GET['db']=='sa'){ ?>
          		    <option value="0" <?echo selected($_GET['DIV'],'0')?>>All Divisions</option> 
          			<? for ($_i=0; $_i<count($arry_div_sa); $_i++){ ?>
          				<option value="<? echo $arry_div_sa[$_i];?>" <? echo selected($_GET['DIV'], $arry_div_sa[$_i]);?>><? echo divname($arry_div_sa[$_i]); ?></option>
          			<? } ?>
             <?}?>

			</select>
		  </td>

	</tr>

       <tr>
            
         
           <td class='rtd'><b><font size="2" color="#0000FF">PaW Call Type</font></b></td>
              <td>
    		  <select size="1" name="CALL" class="text" style="width:120px;padding:3px;">
              
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

          
          </tr>
       
       <tr>
          
          
        
          
          
            <td class='rtd'><b><font size="2" color="#0000FF">Odds Range</font></b></td>
            <td><input type='text' style='width:33px;text-align:center;' name='min_odd' value='<?php echo $_GET['min_odd']?>'/> Min
              &nbsp;<input type='text' style='width:33px;text-align:center;' name='max_odd' value='<?php echo $_GET['max_odd']?>'/> Max
            </td>
            
            
              <td class='rtd'><b><font size="2" color="#0000FF">Period/Date</font></b></td>
              <td>
      		  <select size="1" name="PERIOD" class="text" style="width:180px;padding:3px;">
          		   <option value="1" <?echo selected($_GET['PERIOD'],'1')?>>Full Week (Mon - Sun)</option> 
                 <option value="2" <?echo selected($_GET['PERIOD'],'2')?>>Weekend (Sat - Sun)</option>
                 <option value="3" <?echo selected($_GET['PERIOD'],'3')?>>Midweek (Mon - Fri)</option>

                 <?php echo fixture_date($season, $weekno, $db, $_GET['PERIOD'], $divs) ;?>

      		  </select>
    		  </td>
            
       </tr>
            
            <tr>
                <td class='rtd'><b><font size="2" color="#0000FF">Limit Calls to 1st</font></b></td>
            <td><input type='text' style='width:40px;text-align:center;' name='limitedto' value='<?php echo $_GET['limitedto']?>'/>(insert No.)</td>
            
             <td class='rtd'><b><font size="2" color="#0000FF">Call Parameters</font></b></td>
             
              <td>
               <select size="1" name="CALLPARAM" class="text" style="width:180px;padding:3px;">
                  <option value="0" <?echo selected($_GET['CALL'],'0')?>>All Matches</option> 
                  <option value="1" <?echo selected($_GET['CALLPARAM'],'1')?>>PaW Aligned with Bookie</option> 
                  <option value="2" <?echo selected($_GET['CALLPARAM'],'2')?>>PaW Opposite to Bookie</option>
               </select>
              </td>
             
            </tr>
             <tr>
             <td></td>
             
              <td class='rtd' colspan="2"><b><font size="2" color="#0000FF">Rel/Prom Treatment</font></b></td>
              <td class='ltd'>
              <select size="1" name="PROPTION" class="text" style="width:180px;padding:3px;">
                  <option value="1" <?echo selected($_GET['PROPTION'],'1')?>>Staying Teams Only</option>
                  <option value="2" <?echo selected($_GET['PROPTION'],'2')?>>All Teams (incl R/P)</option>
                  <option value="3" <?echo selected($_GET['PROPTION'],'3')?>>Just R/P Matches</option>
              </select>
              
              </td>
              
             </tr>
            
		  <tr>
		      <td colspan='6' class='ctd padd'>
		      <input type="submit" value="View Data" name="B1" class="bt" style="padding:0px;"/>

		   </td>
		</tr>
        </form>
</table>





<table  width="90%" style='margin:auto auto'>
<tr>
  <td></td>
  <td align="center"><span class='bot'></span></td>
  <td align="right"> <? echo printscr(); ?></td>
</tr>
</table>
<!-- startprint -->




<table cellpadding='2' border="1" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="90%" bgcolor="#F6F6F6">
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
 $Tnumber=0; $Tngot =0 ;  $Tcss =0;  $Tpostponed = 0;  $Twin_odds = 0;  $Tnobets =  0; 
 
 if ($_GET['season']==curseason($_GET['db']) ){
   $max_week = cur_week($_GET['db']) - 1;
   
 }else{  
   $max_week = find_last_week_of_season($_GET['season'],$_GET['db']);
 }
// find_last_week_of_season($season,$_GET['db'])

for ($weekno=1; $weekno<=$max_week; $weekno++){

//for ($weekno=4; $weekno<=4; $weekno++){

 $qry = "SELECT f.prvalue, c.dcr_ht, c.dcr_at, c.dcr_av,c.dcr_dif,abs(c.dcr_dif) as dcrdif,f.`div`, 
        f.hteam,f.ateam,f.match_time,f.hgoal,f.agoal,f.h_s,f.a_s,f.gotit,f.mvalue,f.mid,f.pawrank, date_format(f.match_date,'%d-%b-%y') as mdate,
        f.hwinpb, f.drawpb, f.awinpb, f.h_odd, f.d_odd, f.a_odd, r.ptr_ht, r.ptr_at, r.ptr_av,r.ptr_dif, abs(r.ptr_dif) as ptrdif ,
        (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum, ((f.drawpb*0.5) + f.hwinpb /(f.hwinpb+f.awinpb)*100) as x1probs, 
        ((f.drawpb*0.5) + f.awinpb /(f.hwinpb+f.awinpb)*100) as x2probs, g.gpr_ht, g.gpr_at, g.gpr_av, a.air_ht, a.air_at,a.air_av,a.air_dif,
        ((f.a_odd/f.h_odd)-1)*100 as hswin, ((f.h_odd/f.a_odd)-1)*100 as aswin, abs(f.h_odd-f.a_odd) as dsodd ";


    
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
            o.matchno=f.mid and o.season=c.season and o.weekno=c.weekno and (f.hgoal+f.agoal)<2.50 and o.un_odd>0 " ;
            break;
            
        case 5: 
             $qry .= ", o.un_odd, o.ov_odd        
            FROM cur_reb_dcr c, fixtures f, cur_reb_ptr r, other_odds o, cur_reb g, cur_reb_air a     
            WHERE c.weekno='$weekno' and c.season='$season' and 
            c.matchno=f.mid and c.season=f.season and c.weekno=f.weekno and  
            g.matchno=f.mid and g.season=c.season and g.weekno=c.weekno and 
            a.matchno=f.mid and a.season=c.season and a.weekno=c.weekno and  
            r.matchno=f.mid and r.season=c.season and r.weekno=c.weekno and  
            o.matchno=f.mid and o.season=c.season and o.weekno=c.weekno and (f.hgoal+f.agoal)>2.5 and o.un_odd>0 " ;
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
                            case 1: $callpar2 = " where hswin between 0 and ". $odd_max_diff . " or aswin between 0 and " . $odd_max_diff  ; break;
                            case 2: $callpar2 = " where hswin > ". $odd_max_diff . " or aswin > " . $odd_max_diff  ; break;
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
    
    $query1 = $qry .$proption . $_divs . $period . $call . $filter . $callpar . $ordered_by .   $limited ;
    
    
   if  ($weekno==9){
      //echo $query1;
   }
    
    if (!isset($_SESSION['userid'])){
        $filename = "tmp_" . time() ;
  
    }else{
      $filename = "tmp_" . trim($_SESSION['userid']) ;
    }

    
     
  $xx = "CREATE TEMPORARY TABLE " . $filename . " (".$query1.")";
  //$xx = "CREATE TABLE " . $filename . " (".$query1.")";
  
       
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
    }else{
       $temp = $sa->prepare($xx);
       $temp->execute();
    }
 
      
   $number=0; $ngot =0 ;  $css =0;  $postponed = 0;  $win_odds = 0;  $nobets =  0;
  
   while ($row = $temp->fetch()) {
        $number++;
        $matchno = $row['mid'];
        
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;

    
    switch ($_GET['BETTING']){
        
        case 1:
            $captions = "For Standard 1X2 Betting";
             $ngot += $row['gotit'] ;
             if ($row['gotit']=='1' and $row['h_s']<>'P'){
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
                if ($asl_sum>2.5 and $act_sum>2.5){
                    $asl_class = " gotrt"; $ngot ++;
                    $win_odds+= $row['ov_odd']; 
                }
                
                if ($asl_sum<2.5 and $act_sum<2.5){
                    $asl_class = " gotrt"; $ngot ++;
                    $win_odds+= $row['un_odd']; 
                }
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



<?php }

 if ($db=='eu'){
       $drops = $eu->prepare('drop TEMPORARY table `' . $filename ."`");
       $drops->execute();
    }else{
       $drops = $sa->prepare('drop TEMPORARY table `' . $filename ."`");
       $drops->execute();
    }

?>


</body>

</html>