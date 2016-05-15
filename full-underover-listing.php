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
  
  

if (isset($_GET["weekno"])):
	$page_title = "Under/Over Odds " . site($db) . " " . curseason($db)  . " Week $weekno " ;
else:
	$page_title = "Under/Over Odds " . site($db) . " " . curseason($db) ;
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


<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Under/Over Odds All Divisions Combined</div>



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
                    
            	     <option value="<?php echo $i;?>" <?php if($i==$weekno): echo " selected"; endif;?>>&nbsp;<?php echo $i;?>&nbsp;&nbsp;&nbsp;</option>
    		
                  <?php endfor; ?>		 
    
       		  </select>
              
                   <font style='font-size:12px;'><b><?php echo find_week_dates($season, $weekno, $db);?></b></font>  
    
    		 </td>

	</tr>

       <tr>
            
            <td class='rtd'><b><font size="2" color="#0000FF">PaW Call Type</font></b></td>
              <td>
        		  <select size="1" name="CALL" class="text" style="width:140px;padding:3px;">
                  <option value="1" <?php if($_GET['CALL']==1) echo 'selected';?>>All Matches</option>
                  <option value="2" <?php if($_GET['CALL']==2) echo 'selected';?>>Home - Under Calls</option>
                  <option value="3" <?php if($_GET['CALL']==3) echo 'selected';?>>Home - Over Calls</option>
                  <option value="4" <?php if($_GET['CALL']==4) echo 'selected';?>>Away - Under Calls</option>
                  <option value="5" <?php if($_GET['CALL']==5) echo 'selected';?>>Away - Over Calls</option>
                  <option value="6" <?php if($_GET['CALL']==6) echo 'selected';?>>Draw - Under Calls</option>
                  <option value="7" <?php if($_GET['CALL']==7) echo 'selected';?>>Draw - Over Calls</option>
 		         </select>
    		</td>



            <td class='rtd'><b><font size="2" color="#0000FF">Sort On</font></b></td>
            <td>
        <select size="1" name="SORTBY" class="text" style="width:150px;padding:3px;">
          <optgroup label="Odds">  
            <option value="10" <?php echo selected($_GET['SORTBY'],'10')?>>Under Odds</option>
            <option value="11" <?php echo selected($_GET['SORTBY'],'11')?>>Over Odds</option>
          </optgroup>

          <optgroup label="Goals">  
            <option value="13" <?php echo selected($_GET['SORTBY'],'13')?>>Total Goals Predicted</option>
            <option value="14" <?php echo selected($_GET['SORTBY'],'14')?>>ASL Goal Difference</option>
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
                  			<?php for ($_i=0; $_i<count($arry_div); $_i++){ ?>
                  			   <?php if($_i<>4 and $_i<>9 and $_i<>18){ ?>
                  					<option value="<?php echo $arry_div[$_i];?>" <?php echo selected($_GET['DIV'], $arry_div[$_i]);?>><?php echo divname($arry_div[$_i]); ?></option>
                  			   <?php } ?>
                  			<?php } ?>
                    
                     <?php } ?>
                     </optgroup>  
                    <?php if($db=='sa'){ ?>
                  		    <option value="0" <?php echo selected($_GET['DIV'],'0')?>>All Divisions</option> 
                  			<?php for ($_i=0; $_i<count($arry_div_sa); $_i++){ ?>
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



<table  width="100%" border='0'>
<tr>
	<td width='20%'> <a class='sbar' href="bookies-odds-soccer-betting.php?db=<?php echo $db;?>"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td width='70%' class='ctd'></td>
		<td width='10%'align="right"> <?php echo printscr(); ?></td>
	</tr>
	</table>

 <center>
 
 


<div style="padding-bottom:10px"></div>

  <!-- startprint -->
<?php if(isset($weekno) ): 

week_box_nocap($weekno, $wdate,$season,570);


?>


             
<div style="padding-bottom:10px"></div>

<?php 
  if ($row['weekno'] == cur_week($db)){
    over_round_msg();
  }
?>

<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="570" cellpadding='3' bgcolor="#f6f6f6">
<tr bgcolor="#d3ebab">

  <td width="5%" class='ctd'><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>

  <?php if( ($DIV=='FA') or ($DIV=='SA') or ($DIV=='IN')) : ?>
	   <td width="80" class='ctd'><img src="images/tbcap/date.gif" border="0" alt=""/>
  <?php else: ?>
		 <td width="10%" class='ctd'><img src="images/tbcap/datepic.gif" border="0" alt=""/>
  <?php endif; ?>
  </td>
  <td width="38%" class='ctd'><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
  <td class='ctd' ><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/u25.gif"  border='0' alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/o25.gif"  border='0' alt=""/></td>

<?php if($row['weekno'] < cur_week($db)){ ?>
  <td width="12%" colspan='2' class='ctd'><img src="images/tbcap/pawuo.gif" border="0" alt=""/></td>
  
  <td width="12%" colspan='2' class='ctd'><img src="images/tbcap/bookieuo.gif" border="0" alt=""/></td>

<?php }else{ ?>
  <td width="6%" class='ctd'><img src="images/tbcap/overround.gif"  border="0" alt=""/></td>
  <td width="6%" class='ctd'><img src="images/tbcap/htw-prob.gif"  border="0" alt=""/></td>
  <td width="6%" class='ctd'><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/act.gif"  border="0" alt=""/	></td></td>

<?php } ?>

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
      
      $order = " o.un_odd, ";
      $second_order = " ,o.un_odd asc ";
      
      switch ($_GET['CALL'])
      { 
          case 1: $_calltype = " "; break;
          case 2: $_calltype = " and (f.hgoal+f.agoal) < 2.5 and f.hgoal>f.agoal "; break;
          case 3: $_calltype = " and (f.hgoal+f.agoal) > 2.5 and f.hgoal>f.agoal "; $second_order = " ,o.ov_odd asc "; break;

          case 4: $_calltype = " and (f.hgoal+f.agoal) < 2.5 and f.agoal>f.hgoal "; break;
          case 5: $_calltype = " and (f.hgoal+f.agoal) > 2.5 and f.agoal>f.hgoal "; $second_order = " ,o.ov_odd asc "; break;

          case 6: $_calltype = " and (f.hgoal+f.agoal) < 2.5 and f.hgoal=f.agoal ";  break;
          case 7: $_calltype = " and (f.hgoal+f.agoal) > 2.5 and f.hgoal=f.agoal " ; $second_order = " ,o.ov_odd asc "; break;

      }
  
      switch($_GET['ordered'])
      {
        case 1: $ordered = " asc"; break;
        case 2: $ordered = " desc"; break;
      }
          
      switch ($_GET['SORTBY'])
      {
      
        case 10: $ordered_by = " ORDER BY o.un_odd "; break;
        case 11: $ordered_by = " ORDER BY o.ov_odd "; break;
        
        case 13: $ordered_by = " ORDER BY goalsum $ordered, f.hgoal "; break;
        case 14: $ordered_by = " ORDER BY goaldif "; break;
      }

      $filter='';

      if ($_GET['min_odd']>0 and $_GET['max_odd']>0){
          switch ($_GET['CALL'])
          { 
            case 1: 
                $filter = " and o.un_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] . " and o.ov_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd']; break;
            
            case 2:
            case 4:
            case 6: 
                $filter = " and o.un_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                
            case 3:
            case 5:
            case 7:
                $filter = " and o.ov_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
          }
        
      }
      
   
 	$query1 = "SELECT (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum,f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
	 f.weekno, f.mid, o.un_odd, o.ov_odd, f.`div`,
		f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, other_odds o WHERE 
			f.weekno='$weekno' and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
				f.season=o.season and f.mid = o.matchno and o.un_odd>0 " ;
           
     $query1 .= $period . $_divs . $_calltype . $filter . $ordered_by . $second_order ;
  
    
    
	
				
	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}

    $temp->execute();

    $number = 0;
    $bookie_over = 0;
    $bookie_under= 0;
    $bookie_t_over=0;
    $bookie_t_under=0;

    $paw_over = 0;
    $paw_under= 0;
    $paw_t_over=0;
    $paw_t_under=0;

    $postpond = 0;
    $nas = 0;
    
    if ($temp->rowCount()==0){
        
        echo "<tr>\n
             <td colspan='10' class='ctd bot' style='color:red;padding:20px;'>No Match for selected options</td>\n
             </tr>\n";
        
    }
    while ($row = $temp->fetch()) {
  
      $asl_sum = 0;
      $act_sum = 0;

    	$number++;
	    $matchno = $row['mid'];
      $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
      $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;

      $asl_sum = $row["hgoal"]+$row["agoal"];
      $act_sum = $row["h_s"]+$row["a_s"];

        
      $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&site=$db')\">";
      $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?site='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
      
      $title = "$row[hteam] v $row[ateam] match odds" ;
      $odd=0;
      $or = new overround();
      $or->find_or($row['h_odd'], $row['d_odd'], $row['a_odd'], $row['hwinpb'],$row['drawpb'],$row['awinpb']);
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
            $asl_class = " gotrtblue";
        }
        
         $asl_class ="";
         $asl_class2 ="";

        if ($row['h_s']=='P'){
            $asl_class = " pp";
            $sbar= "sWrg";
            $postpond ++;
            $bookie_call = "N/A";
        
        }else{

          //paw
          if ($asl_sum<2.5) {
             $paw_t_under++;
             $paw_call = "U";

             $paw_under += ($act_sum<2.5? 1 : 0);
             $asl_class = ($act_sum<2.5? " gotrt" : "");
          }else{
             $paw_t_over++;
             $paw_call = "O";
             $paw_over += ($act_sum>2.5? 1 : 0);
             $asl_class = ($act_sum>2.5? " gotrt" : "");
          }

          $bookie_call = ($act_sum>2.5? "O": "U");

          //bookie 
          if ($row["un_odd"]<$row["ov_odd"]){
            $bookie_t_under++;
            $bookie_under += ($act_sum<2.5? 1 : 0);
            $asl_class2 = ($act_sum<2.5? " h_Or bold" : "");
          }elseif($row["ov_odd"]<$row["un_odd"] ){
            $bookie_t_over++;
            $bookie_over += ($act_sum>2.5? 1 : 0);
            $asl_class2 = ($act_sum>2.5? " h_Or bold" : "");
          }else{
            if ($row['h_s']<>'P'){
              $nas++;  
              $bookie_call = "N/A";
            }else{
              $bookie_call = "N/A";
            }

          }

        }
        
        $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$season,$db)){
            $pr = " pr2";
        }

        $overround=0;
		    $overround = ( (1/$row["un_odd"]) + (1/$row["ov_odd"] - 1)) * 100  ;

           //over founds
        $hor = ""; //($or->home_value==1? " h_Or" : "");
        $aor = "";// ($or->away_value==1? " a_Or" : "");




?>

	<tr <?php echo rowcol($number);?>>
		<td class="ctd padd"><?php echo $number; ?></td>
	    <td class="ctd "><a class='md2' <?php echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?php echo $matchno;?>&site=<?php echo $db;?>'><?php echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

	    <td class='padd ltd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?php echo $row['hteam']?>&site=<?php echo $db;?>">
	        <?php echo $row['hteam'] .'</a>' . printv(' v '); ?>
	        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?php echo $row['ateam']?>&site=<?php echo $db;?>">
	            <?php echo $row['ateam'];?></a>
	    </td>
		
		<td class='ctd'><?php echo $row['div'];?></td>
		<td class='ctd <?php echo $hor;?>'><?php echo show_odd($row['un_odd']);?></td>
		<td class='ctd <?php echo $aor;?>'><?php echo show_odd($row['ov_odd']);?></td>

    <?php if($row['weekno'] < cur_week($db)){ ?>

      <td class="ctd <?php echo $asl_class;?>" style="width:100px;"><?php echo $row['hgoal'] . dash() . $row['agoal'];?></td>
      <td class="ctd <?php echo $asl_class;?>" style="width:70px;"><?php echo ($asl_sum>2.5? "O" : "U") ;?></td>
      
      <td class="ctd <?php echo $asl_class2;?>" style="width:100px;"><?php echo $row['h_s'] . dash() . $row['a_s'];?></td>
      <td class="ctd <?php echo $asl_class2;?>" style="width:70px;"><?php echo $bookie_call ; ?></td>

    <?php }else{ ?>
      <td class='ctd'><a title='Over Round Details' class='sbar' href="javascript:OrWin('overround.php?db=<?php echo $db;?>&id=<?php echo $matchno;?>')"><?php echo num20($overround);?>%</a></td>
      <td class='ctd'><?php echo num2($row['hwinpb']);?></td>
      <td class="ctd <?php echo $pr;?>"><?php echo $row['hgoal'] . dash() . $row['agoal'];?></td>
    
      <td class="ctd">
        <a class='<?php echo $sbar;?>' href="javascript:tell('full_odds.php?id=<?php echo $matchno;?>&db=<?php echo $db;?>')">
          <?php if(strlen($act)<2){
            echo "Odds";
          }else{
            echo $row['h_s'] . dash() . $row['a_s']; 
          } 
          ?>
        </a>
      </td>
  

    <?php } ?>

  	
	</tr>

<?php } ?>

</table>




<!-- stopprint -->

			   
			   
			   
			   



<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?php echo $fff ?>
</td>

<td style="font-weight:normal;text-align:center;padding-top:5px;">
<?php if($weekno == cur_week($db)){ ?>
	<B>ASL</B>&nbsp;=&nbsp;</FONT><font size="1">Our Anticipated Score-Line&nbsp;&nbsp;<br/>
	   <B>Act Res</B>&nbsp;=&nbsp;</FONT><font size="1">Actual Result (once known)<br/>
<?php }else{ ?>

<div style="padding-top:5px;font-size:11px;padding-left:102px;text-align:left;">
  <b>KEY:</b>&nbsp;&nbsp;<b>O</b>&nbsp;=&nbsp;Over Call&nbsp;&nbsp;&nbsp;&nbsp;<b>U</b>&nbsp;=&nbsp;Under Call<br />
  <strong>N/A</strong> = Either Postponed or Bookie's Odds are Equal
 </div>
<?php } ?>
	<BR>
	
	
	<?php if($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>

<?php if($weekno == cur_week($db)){ ?>
    <td style="width:90px;background:url('images/bbsm-right.gif') no-repeat right ;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:4px;;">
        Click here<br /> to view<br />all Odds
   </td>
<?php } ?>

</tr>
</table>
<br>

<?php endif; ?>

<?php if($weekno < cur_week($db)){
/*
  if ($bookie_t_under==0) $bookie_t_under = 1;
  if ($bookie_t_over==0) $bookie_t_over = 1;
  if ($paw_t_under==0) $paw_t_under = 1;
  if ($paw_t_over==0) $paw_t_over = 1;
*/

 ?>
<div style='padding:0px;'></div>

<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="570" cellpadding='3'>
  <tr bgcolor="#d3ebab">
    <td width='200' class='ctd padd bot'>SUMMARY</td>    
    <td width='100' class='ctd padd bot'>Postponed<br/>and<br/>N/A</td>    
    <td width='100' class='ctd padd bot'>Total<br/>Under<br/>Calls</td>    
    <td width='100' class='ctd padd bot'>Correct<br/>Under<br/>Calls</td>    
    <td width='100' class='ctd padd bot'>Correct<br/>Under<br/>Calls %</td>    

    <td width='100' class='ctd padd bot'>Total<br/>Over<br/>Calls</td>    
    <td width='100' class='ctd padd bot'>Correct<br/>Over<br/>Calls</td>    
    <td width='100' class='ctd padd bot'>Correct<br/>Over<br/>Calls %</td>    

   </tr> 
  <tr bgcolor='#f4f4f4'>
    <td class='rtd padd bot'>PAW Total&nbsp;</td>
    <td class='ctd padd bot'><?php echo $postpond;?></td>
    
    <td class='ctd padd bot'><?php echo ($paw_t_under);?></td>
    <td class='ctd padd bot'><?php echo ($paw_t_under>0? $paw_under : "n/a") ;?></td>
    
    <?php if($paw_t_under>0){?>
       <td class='ctd padd bot'><?php echo num2( ($paw_under/ $paw_t_under)*100) ;?>%</td>
    <?php }else{ ?>
      <td class='ctd padd bot'>n/a</td>
    <?php } ?>

    <td class='ctd padd bot'><?php echo ($paw_t_over);?></td>
    <td class='ctd padd bot'><?php echo ($paw_t_over>0? $paw_over : "n/a") ;?></td>
    
    <?php if($paw_t_over>0){?>
      <td class='ctd padd bot'><?php echo num2( ($paw_over/ $paw_t_over)*100) ;?>%</td>
    <?php }else{ ?>
      <td class='ctd padd bot'>n/a</td>
    <?php } ?>

  </tr>
  <tr bgcolor='#f4f4f4'>
    <td class='rtd padd bot'>*Bookie Total&nbsp;</td>
    <td class='ctd padd bot'><?php echo $postpond + $nas;?></td>

    <td class='ctd padd bot'><?php echo ($bookie_t_under);?></td>
    <td class='ctd padd bot'><?php echo ($bookie_t_under>0? $bookie_under : "n/a") ;?></td>

    <?php if($bookie_t_under>0){?>
      <td class='ctd padd bot'><?php echo num2( ($bookie_under/ $bookie_t_under)*100) ;?>%</td>
    <?php }else{ ?>
      <td class='ctd padd bot'>n/a</td>
    <?php } ?>

    <td class='ctd padd bot'><?php echo ($bookie_t_over) ;?></td>
    <td class='ctd padd bot'><?php echo ($bookie_t_over>0? $bookie_over : "n/a") ;?></td>
    <?php if($bookie_t_over>0){?>
      <td class='ctd padd bot'><?php echo num2( ($bookie_over/ ($bookie_t_over-$nas))*100) ;?>%</td>
    <?php }else{ ?>
      <td class='ctd padd bot'>n/a</td>
    <?php } ?>

  </tr>

</table>


 <font size='1'>*Where the Bookie's lowest Odds dictate the Bookie's call.</font> 



<?php } ?>


<div style="padding-bottom:5px">&nbsp;</div>
		
<? //require_once("pred-disclaimer.ini.php");  ?>
<?php require_once("footer.ini.php"); ?>


<?php	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>
