  <?php

  $euDiv = getEUdivs(curseason('eu'), cur_week('eu'));
  $saDiv = getSAdivs(curseason('sa'), cur_week('sa'));
  
 
  $Total_No_Matches = 0;

  $temp= $eu->prepare("select count(`div`) as cno from fixtures where season='". curseason('eu') . "' and weekno='" . cur_week('eu')."'");
  $temp->execute();
  $ddd = $temp->fetch();
  $Total_No_Matches = $ddd['cno'];
  
  $temp= $sa->prepare("select count(`div`) as cno from fixtures where season='". curseason('sa') . "' and weekno='" . cur_week('sa')."'");
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

 // echo $total_matches ;

  // print_r($from_divs);
  
$flag_path = 'images/pawflags/';

?>

<div style='text-align:center;width:566px; margin:auto auto;border:1px solid #000;background:#E9EFFF;padding:5px;font-size:13px;line-height:140%;margin-top:12px;border-bottom:0'>

<?php
$fullist = 2;

?>



The following <span class='bb'>free soccer predictions</span> are "<span class='bb'>Home Win Calls</span>"  
representing our Program's topmost favoured call(s) for each Division covered.  <b>They do not represent our TOP BETTING SELECTIONS!</b> We have <span class="bb"><?php echo $Total_No_Matches;?></span> predictions this week (<?php
 echo trim($week_perid); ?>); to see ALL of them (plus the full backup details) you need to be a <span class=
'bb' style='color:maroon'>Subscribing Member</span> and log in first.




 
    
</div>



<div style="border:0px solid #000;width:578px;margin:0 auto 0 auto;padding:0;border-top:0px;">
  <table border="1" style="border-collapse: collapse;margin:auto auto;border-color:#000000"  width="100%" >
  <tr bgcolor="#D3EBAB">
      <td rowspan="2" width="5%" ><img src="images/tbcap/div.gif" border="0" alt="Division"></td>
      <td width="10%"  class='ctd' rowspan="2"><img src="images/tbcap/datepic2.gif" border="0" alt="Date and Time"></td>
      <td width="30%" class='ctd' rowspan="2"><img src="images/tbcap/fixture2.gif"  border="0" alt="Fixture List"></td>
      <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/aslblue.gif"  border="0" alt="Anticipated Score-Line"></td>
      <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/actblue.gif"  border="0" alt="Actual Result"></td>
      <td width="20%" class='ctd' colspan="3"><img src="images/tbcap/odd.gif"  border='0' alt="1x2 Odds"></td>
	  
      <td width="6%" class='ctd'rowspan="2"><img src="images/tbcap/aslcsodd.gif"  border="0" alt="Anticipated Score-Line Correct Score Odds"></td> 
  </tr>
  
  <tr bgcolor="#d3ebab">
      <td width="6%" class='ctd'><img src="images/tbcap/home.gif"  border='0' alt="Home Win Odds"></td>
      <td width="6%" class='ctd'><img src="images/tbcap/d.gif"  border='0' alt="Draw Odds"></td>
      <td width="6%" class='ctd'><img src="images/tbcap/a.gif"  border='0' alt="Away Wins Odds"></td>
      
  </tr>
  
  <?php

  
  $number=0;
  
  $matched = 0;
    
  if ($_SESSION['userid']=='imran'){
    
    //echo $max_predictions;
  }
     
  for ($iii=0; $iii<count($from_divs); $iii++){
      
   
    if ($matched >= $max_predictions){
      $iii = count($from_divs);
    } 
    
    $DIV = $from_divs[$iii];
   
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
              $weekno = cur_week('sa') ;
              $sea    = curseason('sa') ;
            break;
            
            default:
              $db ='eu';
              $weekno = cur_week('eu') ;
              $sea    = curseason('eu') ;
            break;

        }    
          
          
          $qry = "SELECT c.air_ht,f.*, date_format(f.match_date,'%d-%b-%y') as mdate2 
					FROM fixtures f, cur_reb_air c  WHERE f.`div`='$DIV' AND f.weekno='$weekno' 
					and f.season='$sea' and f.hgoal>f.agoal and f.mid=c.matchno and 
					f.weekno=c.weekno and f.season=c.season ORDER BY f.pawrank limit $nLimit";
          
          if ($iii==2){
				//echo $qry;
          }
          
          break;
      
      default:  
          
          switch ($DIV) {  
            case "BRA":
            case "BRB":
            case "MLS":
              $db ='sa';
              $weekno = cur_week('sa') ;
              $sea    = curseason('sa') ;
            break;
            
            default:
              $db ='eu';
              $weekno = cur_week('eu') ;
              $sea    = curseason('eu') ;
            break;


        }    
        
          $qry = "SELECT c.air_ht,f.*, date_format(f.match_date,'%d-%b-%y') as mdate2 FROM fixtures f,
					cur_reb_air c  WHERE f.`div`='$DIV' AND f.weekno='$weekno' and f.season='$sea' 
					and f.hgoal>f.agoal and f.mid=c.matchno and f.weekno=c.weekno and f.season=c.season 
					ORDER BY f.pawrank limit $nLimit"; //f.hwinpb desc, c.air_ht desc
          break;
     }
     
   //  echo $qry ;
	
	//echo gg_count($DIV,'n/a','FIXTURE', $db) ;
     
	    if (get_match_by_week_div($db, $DIV, $weekno, $sea)>1){
		 
		 //echo "$iii $qry<br /><br />";

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
			  
			  
	        $pr = "";
	        if (asl_pr_team($row["hteam"],$row["ateam"],$sea,$db)){
	            $pr = " pr2";
	        }  
			  
			  
			  $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&amp;db=$db')\">";
			  $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?db='. $db.'&amp;DIV=' . $row["div"] .'">'. $row["div"].'</a>';
			  
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
	  
			  <td class="ctd padd" style="padding-top:5px; padding-bottom:5px;" title='<?php echo divname($row['div']); ?>'><?php echo $row['div'];?></td>
			  <td class="ctd "><a class='md2' title='<?php echo $title;?>' target='_blank' href='team-performance-chart.php?id=<?php echo $matchno;?>&amp;site=<?php echo $db;?>'><?php echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>
		  
			   <td class='padd'><?php echo $row['hteam'] . printv(" v ") . $row['ateam']; ?></td>
			   
			  
			  <td class="ctd <?php echo $asl_class;?>"><?php echo $row['hgoal'] . dash() . $row['agoal'];?></td>
			  <td class="ctd <?php echo $asl_class;?>"><?php echo $row['h_s'] . dash() . $row['a_s']; ?></td>
			  <td class="ctd"><?php echo show_odd($row["h_odd"]); ?></td>
			  <td class="ctd"><?php echo show_odd($row["d_odd"]); ?></td>
			  <td class="ctd"><?php echo show_odd($row["a_odd"]); ?></td>
			 
			  <td class="ctd"><a title='<?php echo $title . " Odds";?>' href="javascript:tell('full_odds.php?id=<?php echo $matchno?>&amp;db=<?php echo $db?>&amp;season=<?php echo $sea?>')" class='sbar'><?php echo show_odd($row["asl_odd"])?></a></td> 
		  
		  </tr>
	  
<?php  }       
	}
  } ?>
  
      
 </table>
</div>

<div style="border:0px solid #23488C;width:580px;margin:0 auto 0 auto;padding:0;border-top:0px;">

<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:158px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?php echo $fff ?>
</td>

<td style="font-weight:normal;text-align:center;padding-top:5px;">
	<font color="blue"><b>PaW ASL</b></font>&nbsp;&nbsp;=&nbsp;&nbsp;<font size="1">Predict-A-Win Program's Anticipated Score-Line<br>
	<font color="blue"><b>Act Res</b></font>&nbsp;&nbsp;=&nbsp;&nbsp;Actual Result
	<br>

	
	</font>
</td>
    <td style="width:90px;background:url('images/bbsm-right.gif') no-repeat right ;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:4px;;">
        Click here<br> to view<br>all Odds
   </td>
</tr>
</table>
</div>

<?php $_SESSION['db'] = "eu"; ?>