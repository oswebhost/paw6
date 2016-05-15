<?php

if (!isset($_GET['week_date'])){
  $page_title = " Free Soccer Predictions";
}else{
  $page_title = $_GET['week_date'] . " Free Soccer Predictions";
}

require_once("config.ini.php");
require_once("function.ini.php");
require_once("header.ini.php");

page_header("Free Soccer Predictions History"); 


$cdate = cur_week('eu');
$csea = curseason('eu');
$q = $eu->prepare("select realwkdate from week_dates where season='$csea' and weekno='$cdate'");


/*
// if EU season is off only 
$cdate = cur_week('sa');
$csea = curseason('sa');
$q = $sa->prepare("select realwkdate from week_dates where season='$csea' and weekno='$cdate'");


*/

$q->execute();
$d = $q->fetch();
$curwk_date = $d['realwkdate'];







if ($_GET['shownow']==1){

  $eudate = getEUweek($_GET['week_date']) ;
  $sadate = getSAweek($_GET['week_date']) ;
 /*
  echo"---" . $_GET['week_date'] . "===<br />";
  echo "EU: " . $eudate->season . " - " . $eudate->week  . "<br />";
  echo "SA: " . $sadate->season . " - " . $sadate->week  . "<br />";
  echo  $curwk_date;
*/
 
  if (!isset($_GET['week_date'])){
      $eudate = new stdClass();
      $eudate->season = curseason('eu');
      $eudate->week = cur_week('eu') - 1;     
	  //$eudate->week = cur_week('eu');     // end of season
	 
      $sadate = new stdClass();
      $sadate->season = curseason('sa');
      $sadate->week = cur_week('sa') -1;  
      
  }else{
    
    $eudate = getEUweek($_GET['week_date']) ; 
    $sadate = getSAweek($_GET['week_date']) ;
  
  }
  
 
  $euDiv = getEUdivs($eudate->season, $eudate->week);
  $saDiv = getSAdivs($sadate->season, $sadate->week);
  
  
 
  $Total_No_Matches = 0;

  $temp= $eu->prepare("select count(`div`) as cno from fixtures where season='". curseason('eu') . "' and weekno='" .   $eudate->week  ."'");
  $temp->execute();
  $ddd = $temp->fetch();
  $Total_No_Matches = $ddd['cno'];
  
  $temp= $sa->prepare("select count(`div`) as cno from fixtures where season='". curseason('sa') . "' and weekno='" .   $sadate->week ."'");
  
  $temp->execute();
  $ddd = $temp->fetch();
  $Total_No_Matches += $ddd['cno'];
   
  $total_matches = $euDiv + $saDiv;
  $max_predictions = 12;
  $nLimit = 1;
 
  
  
  if ($euDiv<4){
    $nLimit = 2;
  }
   
    
   switch ($total_matches){
  	  case 14:
      case 13:	
      case 12:
      case 11:
      case 10:
      case 09:
      case 08:
	  //$from_divs = array('EP','SP','FL','G0','GB','HK','IS','P0','SL','T0'); break;
      $from_divs = array('EP','SP','FL','G0','GB','HK','IS','P0','SL','T0','MLS','BRA'); break;
      
      case 07:
      case 06:
      case 05:
      case 04:
      case 03:
      $from_divs = array('EP','SP','FL','G0','GB','HK','IS','P0','SL','T0','BRA','MLS','C0','C1','BRB','C2','S1','S2'); 
      $max_predictions = 10;
      break;
      
      default:
      $from_divs = array('EP','SP','FL','G0','GB','HK','IS','P0','SL','T0','BRA','C0','C1','BRB','C2','S1','S2','NC','PR','UP','MP'); 
      $max_predictions = $total_matches ;
      break;
  }                                                                  
   
   if ($nLimit==2){
      $from_divs = array('BRA','BRB','MLS'); 
      $max_predictions = 6; 
   }      
 


            
}


?>


<table border="0" cellpadding="5" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="570">

	<form method="get" action="<?php echo $PHP_SELF ?>">
		<input type="hidden" name="shownow" value="1" />
		<input type="hidden" name="db" value="<?php echo $_SESSION['db'];?>" />
	<tr>
	  <td ><b><font size="2" color="#0000FF">Week beginning</font></b> <br />
	  
	  <?php // echo "select * from week_dates where realwkdate<='$curwk_date' and `season` in ('2014-2015','2013-2014', '2012-2013','2011-2012') order by season desc, weekno desc"; ?>
	  <select style="width:180px" name="week_date" class="text">
	  
    <?php 
			 $br=0;

			
			
			 $q = $eu->prepare("select * from week_dates where realwkdate<'$curwk_date' and `season` in ('2015-2016','2014-2015','2013-2014', '2012-2013','2011-2012') order by season desc, weekno desc");
			 
		
       $q->execute();
       
	
                     
       while ($d = $q->fetch()){
          
            if ($d['wksdate']<>'15-Aug-2011' and $d['wksdate']<>'08-Aug-2011' and $d['wksdate']<>'01-Aug-2011' and $d['wksdate']<>'25-Jul-2011' and $d['wksdate']<>'18-Jul-2011'){
                 echo "<option value='" . $d[wksdate] . "'" ; 
              
                 if ($_GET['week_date']== $d['wksdate']){
                     echo " selected";
                 }
				 /*
				 else{
                    if (cur_week('eu') == $d['weekno'] and curseason('eu') == $d['season']){
					//if (cur_week('sa') == $d['weekno'] and curseason('sa') == $d['season']){
                      echo " selected";
                    }
                    
                 }
				 */
                 echo ">". $d['wksdate'] ."</option>\n";
           }                        
       } 
		
    	 echo "</select>";	

	  ?>
        <input type="submit" value="View Data" name="B1" class="bt" style="padding:4px 8px;"/><br /><br />
		Until we sort the problem out, please click on "<b>VIEW DATA</b>" the first time you enter this screen.
	  </td>
    <td style="text-align:center;">
    <font style='font-size:12px;'><b><?php echo find_week_dates($eudate->season, $eudate->week, "sa");?></b></font>    
    </td>	
	
    
	</tr>	
	</form>
</table>
</center>




<?php if ($_GET['shownow']==1){ ?>

<div style='text-align:center;width:550px; margin:10px auto auto 5px;border:1px solid #23488C;background:#E9EFFF;padding:5px;font-size:13px;line-height:140%;padding:10px'>
   The following shows how our <span class='bb'>FREEBIES</span> on the Home Screen have performed for the previous weeks.&nbsp;&nbsp;Remember, They do <span class='bb' style='color:red;'>NOT represent our TOP BETTING SELECTIONS!</span>, <i><span class='bb' style='color:purple;'>but the selection process used each week is exactly the same as for the current week's selections you can see on the Home Screen!</span></i>&nbsp;&nbsp;If they were our Prime Selections, why would anybody bother to register with us?&nbsp;&nbsp;The selections on the Home Screen are there simply so you can click to reveal all the backup data for the predictions shown, in the belief that you will be able to <b><i>convince yourself of the power of our unique</i></b> <span class='bb'>Predict-A-Win Program!</span><br>Basically, <i><span class='bb' style='color:purple;'>we wish you to register with us</span></i> so that we will know our product is appreciated!<br> 

</div>
	
<div style="padding-bottom:2px"></div>


<table  width="100%" align="center">
<tr>
	<td> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"> <?php echo printscr(); ?></td>
</tr>
</table>


<!-- startprint -->



 <div style="border:1px solid #23488C;width:570px;margin:0 auto 0 auto;padding:0;;">
  <table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD"  width="570" bgcolor="#F6F6F6">
  <tr bgcolor="#D3EBAB">
      <td rowspan="2" width="5%" ><img src="images/tbcap/div.gif" border="0" alt=""/></td>
      <td width="10%"  class='ctd' rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/></td>
      <td width="30%" class='ctd' rowspan="2"><img src="images/tbcap/fixture2.gif"  border="0" alt=""/></td>
      <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/aslblue.gif"  border="0" alt=""/></td>
      <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/actblue.gif"  border="0" alt=""/></td>
      <td width="24%" class='ctd' colspan="3"><img src="images/tbcap/odd.gif"  border='0' alt=""/></td>
      <td width="8%" class='ctd'rowspan="2"><img src="images/tbcap/aslcsodd.gif"  border="0" alt=""/></td>
  </tr>
  
  <tr bgcolor="#d3ebab">
      <td width="8%" class='ctd'><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
      <td width="8%" class='ctd'><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
      <td width="8%" class='ctd'><img src="images/tbcap/a.gif"  border='0' alt=""/></td>
  </tr>
  
 <?php

  
  $number=0;
  
  $matched = 0;
  
   
  for ($iii=0; $iii<=count($from_divs); $iii++){
      
   
    if ($matched >= $max_predictions){
      $iii = count($from_divs);
    } 
    
    $DIV = trim($from_divs[$iii]);
	//echo $DIV;
	
     switch ($DIV) {
          case 'EP':
          case 'SP':
          case 'IS':
          case 'SL':
          case 'GB':          
          case 'HK':
          case 'T0':
          case 'G0':
          case 'FL':
          case 'P0':
          case 'MLS':
          case 'BRA':
		  
          
          switch ($DIV) {  
            case "BRA":
            case "BRB":
            case "MLS":
              $db ='sa';
              $weekno = $sadate->week ;
              $sea    = $sadate->season ;
            break;
            
		default:
		  $db ='eu';
		  $weekno = $eudate->week ;
		  $sea    = $eudate->season ;
		break;

        }    
          
          
        //  $qry = "SELECT c.air_ht,f.*, date_format(f.match_date,'%d-%b-%y') as mdate2 FROM fixtures f, cur_reb_air c  WHERE f.`div`='$DIV' AND f.weekno='$weekno' and f.season='$sea' and f.hgoal>f.agoal and f.mid=c.matchno and f.weekno=c.weekno and f.season=c.season and f.asl_odd>0 ORDER BY f.pawrank limit $nLimit";
		  
		    $qry = "SELECT c.air_ht,f.*, date_format(f.match_date,'%d-%b-%y') as mdate2 
					FROM fixtures f, cur_reb_air c  WHERE f.`div`='$DIV' AND f.weekno='$weekno' 
					and f.season='$sea' and f.hgoal>f.agoal and f.mid=c.matchno and 
					f.weekno=c.weekno and f.season=c.season ORDER BY f.pawrank limit $nLimit";
  
  
          break;
      
      default:  
          
          switch ($DIV) {
            case "BRA":
            case "BRB":
            case "MLS":
              $db ='sa';
              $weekno = $sadate->week ;
              $sea    = $sadate->season ;
            break;
            
            default:
              $db ='eu';
              $weekno = $eudate->week ;
              $sea    = $eudate->season ;
            break;

        }    
        if (trim($DIV)=="C0"){
  	       	//echo $qry;
  	    }
        
          $qry = "SELECT c.air_ht, f.*, date_format(f.match_date,'%d-%b-%y') as mdate2 FROM fixtures f, cur_reb_air c WHERE f.`div`='$DIV' AND f.weekno='$weekno' and f.season='$sea' and f.hgoal>f.agoal and f.h_odd < f.a_odd and f.h_odd < f.d_odd and f.mid=c.matchno and f.weekno=c.weekno and f.season=c.season and f.asl_odd>0 ORDER BY f.pawrank limit $nLimit" ;
           if ($iii>5){
              
          }
          
          break;
     }
	 
  
  
   if (get_match_by_week_div($db, $DIV, $weekno, $sea)>2){
   
      // echo "$iii -- $DIV  -- $qry <br /><br />";

      if ($db=="eu"){
         $temp = $eu->prepare($qry) ;
      }else{
        $temp = $sa->prepare($qry) ;
      }
      $temp->execute();
  
             
      $pic = "/pic/" ;
      $pic =  $weekno ."/pic";
   
      $ngot =0 ;
      $css = 0;
      
      while ($row = $temp->fetch()) {
          
          $number++;
          $matched++;
          $matchno = $row['mid'];
          $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
          $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
          $ngot += $row['gotit'] ;
          
          $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&db=$db')\">";
          $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?db='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
          
         $title = divname($row['div']) . " $row[mdate2] $row[hteam] v $row[ateam]" ;
        
          $odd = "";
    
          $asl_class ="";
         
          if ($row['gotit']=='1' and $row['h_s']<>'P'){
              $asl_class = " gotrt";
          }
          
          if ($asl==$act){
              $asl_class = " gotasl";
              $css ++;
          }
          
          if ($row['h_s']=='P'){
              $asl_class = " pp";
          }
  
      ?>	
      <tr <?php echo rowcol($number);?>>
  
          <td class="ctd padd" style="padding-top:5px; padding-bottom:5px;" title='<?php echo divname($row['div']); ?> <?php echo 'Week No ' . $row['weekno'] ?>'><?php echo $row['div'];?></td>
          <td class="ctd" title='<?php echo 'Week No ' . $row['weekno'] ?>'><?php echo $row['mdate2']  ; ?></td>
      
           <td class='padd'><?php echo $row['hteam'] . printv(' v '); ?>
                            <?php echo $row['ateam'];?></a> 
           </td>
           
          
          <td class="ctd <?php echo $asl_class;?>"><?php echo $row['hgoal'] . dash() . $row['agoal'];?></td>
          <td class="ctd <?php echo $asl_class;?>"><?php echo $row['h_s'] . dash() . $row['a_s']; ?></td>
          <td class="ctd"><?php echo show_odd($row["h_odd"]); ?></td>
          <td class="ctd"><?php echo show_odd($row["d_odd"]); ?></td>
          <td class="ctd"><?php echo show_odd($row["a_odd"]); ?></td>
          <td class="ctd"><a title='<?php echo $title . " Odds";?>' href="javascript:tell('full_odds.php?id=<?php echo $matchno?>&db=<?php echo $db?>&season=<?php echo $sea?>')" class='sbar'><?php echo show_odd($row["asl_odd"])?></a></td>
      
      </tr>
  
<?php  }       
   }
}

?>    
 </table>
 </div>

<!-- stopprint -->
 
<?php
}

 require_once("footer.ini.php"); 





function getMondays($year){
	  $newyear = $year;
	  $week = 0;
	  $day = 0;
	  $mo = 1;
	  $mondays = array();
	  $i = 1;
	  
      while ($week != 1){
	    $day++;
	    $week = date("w", mktime(0, 0, 0, $mo,$day, $year));
	  }
	  
      array_push($mondays,date("d-M-Y", mktime(0, 0, 0, $mo,$day, $year)));
	 
      while ($newyear == $year){
	    $x =  strtotime(date("d-M-Y", mktime(0, 0, 0, $mo,$day, $year)) . "+" . $i . " week");
	    $i++;
	    if ($year == date("Y",$x)){
	      array_push($mondays,date("d-M-Y", $x));
	    }
	    $newyear = date("Y",$x);
	  }
	  return $mondays;
}

function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}

?>