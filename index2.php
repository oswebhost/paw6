<?
$show_key =1 ;
    session_start(); 
    
    if ($_GET['ref']=='YM'){
        $_SESSION['ref'] = $_GET['ref'];
    }
    
    
    
    
    include("config.ini.php");
    include("function.ini.php");
    include("reguser.php");
    
    $show_key= meta_index() . meta_football() . meta_freepred() ;
    $show_key2 = 1;
    $page_title = "Quality Soccer Predictions Data";
    
    include("header.ini.php");


/*  
    Updated: 27-mar-2013
    
    Page 1 Alternatives rev 09 (27Feb13)
    page 7
    27-feb-2013
*/


$tmp = $eu->prepare('select week_begin from setting');
$tmp->execute();
$ddd = $tmp->fetch();
$week_perid = $ddd['week_begin'];

page_header("<font color='#26529B'>FREE SOCCER PREDICTIONS!</font>");






$wtype ="WEEKEND SHORT ODDS � HOME WIN CALLS"; $WEEKNO=41;
$sql_string = "weekno='$WEEKNO' and season='2011-2012' and matchtype='HW' and bettype='E'";


//include("hypes/2013-2014/week18.html"); 
echo "<div style='padding-top:5px;'></div>";



// pic details //

$pic_id = 3707;
$pic_db = "eu";
$pictitle  ="21-Dec-2013<br/> Feyenoord v Zwolle 3-0";
$pic_url = "team-performance-chart.php?id=$pic_id&amp;site=$pic_db";


//
$total_matches = 0;

$db ='eu';
$weekno = cur_week($db);
$sea    = curseason($db);
$temp= $eu->prepare("select count(`div`) as cno from fixtures where season='$sea' and weekno='$weekno'");
$temp->execute();
$ddd = $temp->fetch();
$total_matches = $ddd['cno'];

$db ='sa';
$weekno = cur_week($db);
$sea    = curseason($db);
$temp = $sa->prepare("select count(`div`) as cno from fixtures where season='$sea' and weekno='$weekno'");
$temp->execute();
$ddd = $temp->fetch();
$total_matches+= $ddd['cno'];

$flag_path = 'images/pawflags/';

?>
<link rel="stylesheet" href="tips/jquery.cluetip.css" type="text/css" />
<script src="tips/jquery.cluetip.js"></script>
<script src="tips/demo/demo.js"></script>





 
<div class="salespage" style="margin-top:2px;">
	


<div style='text-align:center;width:560px; margin:auto auto;border:1px solid #23488C;background:#E9EFFF;padding:5px;font-size:13px;line-height:140%'>

<? 
$fullist = 1;

if ($fullist==1){?>

We have <span class="bb"><? echo $total_matches;?></span> predictions this week (<?php echo trim($week_perid); ?>), and the ones we show below are simply the first in the list of this week�s �<span class='bb'>Win Calls</span>� we make for each individual <span class='bb'>Premier Divisions</span> we are posting predictions for this week, where our Program's calls match the Bookie's thinking. They are <span class="bb">free picks</span>, so don�t expect any of them to be our Prime Selections (although one or two may be)! To see all our predictions and the full backup details you need to be a <span class='bb' style='color:maroon'>Registered Member</span> and log in first.  But you won't have to pay anything at all, <span class="bb">because it's all completely free-of-charge!</span>  

<?}else{?>

We have <span class="bb"><? echo $total_matches;?></span> predictions this week (<?php echo trim($week_perid); ?>), and the ones we show below represent a selection of our Program's �<span class='bb'>Win Calls</span>� that align with the Bookie's thinking (only one per Premier/Major Division). Not all <span class='bb'>Premier Divisions</span> are playing this week, so the selections for the <span class='bb'>Major Divisions</span> are for our Program's most favoured calls. The <span class='bb'>Premier Division</span> calls are simply the first matches in the Fixtures List where our Program's call matches the Bookie's expectations. <strong>So none of these calls represent our Top 6 Prime Selections!</strong> To see all our predictions and the full backup details you need to be a <span class='bb' style='color:maroon'> Registered Member</span> and log in first. But you won't have to pay anything at all, <span class="bb">because it's all completely free-of-charge!</span>


<?}?>
 
    
</div>
<!--
<div style="text-align:center">
<img src="images/wk19v21.gif" border="0" />
</div>
-->


 <div style="border:1px solid #23488C;width:570px;margin:0 auto 0 auto;padding:0;border-top:0px;">
  <table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD"  width="570" bgcolor="#F6F6F6">
  <tr bgcolor="#D3EBAB">
      <td rowspan="2" width="5%" >
          <? if ($fullist==2){?>
          <img src="images/tbcap/div.gif" border="0" alt=""/>
          <?}?>
      </td>
      <td width="10%"  class='ctd' rowspan="2"><img src="images/tbcap/datepic2.gif" border="0" alt=""/></td>
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
  
  <?
  $db ='eu';
  $weekno = 23;//cur_week($db); //when season is ongoing.;
  $sea    = curseason($db);
  $number=0;
  
  for ($i=0; $i<=count($major_divs); $i++){
      
      if ($fullist==2){
        $major_divs = array('EP','C0','C1','C2','SP','S1','S2','S3');
      }
      $DIV = $major_divs[$i];
     
     switch ($DIV) {
          case 'EP':
          case 'SP':
     
          $qry = "SELECT *, date_format(match_date,'%d-%b-%y') as mdate2 FROM fixtures  WHERE `div`='$DIV' AND weekno='$weekno' and season='$sea' and hgoal>agoal  ORDER BY match_date limit 1";
          break;
      
      default:    
          $qry = "SELECT c.air_ht, f.*, date_format(f.match_date,'%d-%b-%y') as mdate2 FROM fixtures f, cur_reb_air c WHERE f.`div`='$DIV' AND f.weekno='$weekno' 
and f.season='$sea' and f.hgoal>f.agoal and f.h_odd < f.a_odd and f.h_odd < f.d_odd and f.mid=c.matchno and f.weekno=c.weekno and f.season=c.season   
      ORDER BY c.air_ht desc, f.hwinpb desc limit 1" ;
          break;
     }
  
          
          
      $temp = $eu->prepare($qry) ;
      $temp->execute();
  
     
          
      $pic = "/pic/" ;
      $pic =  $weekno ."/pic";
   
      $ngot =0 ;
      $css = 0;
      while ($row = $temp->fetch()) {
          
          $number++;
          $matchno = $row['mid'];
          $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
          $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
          $ngot += $row['gotit'] ;
          
          $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&db=$db')\">";
          $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?db='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
          
          $title = "$row[mdate2] $row[hteam] v $row[ateam]" ;
        
          $odd = "";
          if ($RESULT=="HW"){ $odd = $row[h_odds]; }
          if ($RESULT=="AW"){ $odd = $row[a_odds]; }
          if ($RESULT=="AD"){ $odd = $row[d_odds]; }
          if ($odd <= 0 ) { $odd = ""; }
    
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
      <tr <?echo rowcol($number);?>>
  
          <td class="ctd padd" style="padding-top:5px; padding-bottom:5px;">
              <?if ($fullist==2){?> 
                 <?php echo $row['div'];?>
              <?}else{?>
               <img src="<?echo $flag_path . $DIV .".jpg";?>" border="0"/>
              <?}?>
          </td>
          <td class="ctd "><a class='md2' title='<?echo $title;?>' target='_blank' href='team-performance-chart.php?id=<?echo $matchno;?>&site=<?echo $db;?>'><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>
      
           <td class='padd'><?echo $row['hteam'] . printv(' v '); ?>
                            <?echo $row['ateam'];?></a> 
           </td>
           
          
          <td class="ctd <?echo $asl_class;?>"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
          <td class="ctd <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
          <td class="ctd"><?echo show_odd($row["h_odd"]); ?></td>
          <td class="ctd"><?echo show_odd($row["d_odd"]); ?></td>
          <td class="ctd"><?echo show_odd($row["a_odd"]); ?></td>
          <td class="ctd"><a title='<?echo $title . " Odds";?>' href="javascript:tell('full_odds.php?id=<?echo $matchno?>&db=<?echo $db?>')" class='sbar'><?echo show_odd($row["asl_odd"])?></a></td>
      
      </tr>
  
  <?  }
      
    }
  
  
  
  
  
  
  
  $db ='sa';
  $weekno = cur_week($db);
  $sea    = curseason($db);
  $arry_div_sa2 = array('MLS', 'BRA','BRB');
  
  for ($i=0; $i<=count($arry_div_sa2); $i++){
      
      $DIV = $arry_div_sa2[$i];
  
      $qry = "SELECT *, date_format(match_date,'%d-%b-%y') as mdate2 FROM fixtures WHERE `div`='$DIV' AND weekno='$weekno' and season='$sea' and hgoal>agoal ORDER BY match_date limit 1";
      $temp = $sa->prepare($qry) ;
      $temp->execute();
      
      $pic = "/pic/" ;
      $pic =  $weekno ."/pic";
   
      $ngot =0 ;
      $css = 0;
      while ($row = $temp->fetch()) {
          
          $number++;
          $matchno = $row['mid'];
          $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
          $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
          $ngot += $row['gotit'] ;
          
          $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&db=$db')\">";
          $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?db='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
          
          $title = "$row[mdate2] $row[hteam] v $row[ateam]" ;
          $odd = "";
          if ($RESULT=="HW"){ $odd = $row[h_odds]; }
          if ($RESULT=="AW"){ $odd = $row[a_odds]; }
          if ($RESULT=="AD"){ $odd = $row[d_odds]; }
          if ($odd <= 0 ) { $odd = ""; }
    
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
      <tr <?echo rowcol($number);?>>
  
          <td class="ctd padd" style="padding-top:5px; padding-bottom:5px;"><img src="<?echo $flag_path . $DIV .".jpg";?>" border="0"/></td>
          <td class="ctd "><a class='md2' title='<?echo $title;?>' target='_blank' href='team-performance-chart.php?id=<?echo $matchno;?>&site=<?echo $db;?>'><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>
      
           <td class='padd'><?echo $row['hteam'] . printv(' v '); ?>
                            <?echo $row['ateam'];?></a> 
           </td>
          <td class="ctd <?echo $asl_class;?>"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
          <td class="ctd <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
          <td class="ctd"><?echo show_odd($row["h_odd"]); ?></td>
          <td class="ctd"><?echo show_odd($row["d_odd"]); ?></td>
          <td class="ctd"><?echo show_odd($row["a_odd"]); ?></td>
          <td class="ctd"><a title='<?echo $title. " Odds"?>' href="javascript:tell('full_odds.php?id=<?echo $matchno?>&db=<?echo $db?>')" class='sbar'><?echo show_odd($row["asl_odd"])?></a></td>
      
      </tr>
  
  <?  }
      
    }
  ?>
  </table>
</div>

<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:158px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?= $fff ?>
</td>

<td style="font-weight:normal;text-align:center;padding-top:5px;">
	<font color="blue"><b>PaW ASL</b></font>&nbsp;=&nbsp;</font><font size="1">Predict-A-Win Program's Anticipated Score-Line<br />
	<font color="blue"><b>Act Res</b></font>&nbsp;=&nbsp;Actual Result
	<br/>

	

	<? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
    <td style="width:86px;background:url('images/bbsm-right.gif') no-repeat right ;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:4px;;">
        Click here<br /> to view<br />all Odds
   </td>
</tr>
</table>

<div class="clear"></div>





<a name="video"></a>
<div class="clear"></div>

<div style="padding: 8px 0;">
<iframe width="570" height="380" src="//www.youtube.com/embed/Y42pJ0Z0hFw" frameborder="0" allowfullscreen></iframe>
</div>


<table border="0">
<tr>
    <td valign="top">
    <a  class="custom-width mblue" rel="ajax3.html" title="<?= $pictitle?>" href="<?php echo $pic_url;?>" target="_blank" onMouseover="ddrivetip('Performance Indicator Chart - click to see full chart.', 150)"  onMouseout="hideddrivetip()"><img src="images/pics/<?php echo $pic_db;?>/<?php echo $pic_id;?>.gif" border="0" align="left" vspace="0" hspace="15" style="margin-left:-2px;" alt="<?= $pictitle?>"/></a>
    </td>
    
    <td style='width:50px'>&nbsp;</td>
    <td valign="top">
    
   
    
    <div style='text-align:center;width:310px; margin:5px auto 0 auto;border:0px solid #23488C;'>
        <? // include("hypes/2012-2013/week24.html"); ?>
        
        <a class='none' href="javascript:bigwin('soccer-predictions-analysis-tool.php?<?php echo $toolurl;?>')"><img src="images/soccerpatbox3.gif" border="0" alt="Interactive Analysis Tool -- Soccer Predictions Analysis Tool There you will be able to play with the data and check out many what if scenarios based on the Odds range you select and our computer Program�s Probabilities and Reliabilities, etc. If you ever wanted proof of how everything is slanted in the Bookies favour, this fabulous tool provides it! " /></a>
    </div>
    
     <div style='text-align:center;width:310px; margin:20px auto 0 auto;'>
           <img src="images/8box.gif" border="0" alt="Every New Registered Member will be given access to our specially prepared document \�8 GOLDEN RULES for SUCCESSFUL SOCCER BETTING\�, which will be available for downloading immediately after completing registration." />  
    </div>
    
    
            <?php if (!isset($_SESSION["userid"])){ ?>

            <div class="reg_botton" style="margin-top: 20px;">
              <a title='Get Soccer Predictions Data Now!' href="register-aweber.php">
                <img src='images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
            </div>
            <?}?>

    
    </td>
    </tr>
    
  
</tr>
</table>



<div class="clear"></div>



</div>

<p style='margin-top:1px;padding-top:0'>&nbsp;</p>






<? 


 include("footer.ini.php"); 
 
 	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>