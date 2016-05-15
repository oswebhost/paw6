<?php
session_start();

require_once("config.ini.php");
require_once("function.ini.php");

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
 
 
  $pic =  $weekno ."/pic";
  
  $query1="SELECT h.*, abs(h.ht_hedge-h.at_hedge) as hedgedif, f.hgoal,f.agoal,f.h_s,f.a_s,f.gotit,f.match_date, f.match_time,date_format(f.match_date,'%d-%b-%y') as mdate2 from cur_hedge h, fixtures f where h.weekno='$weekno' and h.season='$season' and h.div <>'MP' and h.div<>'UP' and h.div<>'NC' and h.div <>'RP' and h.div <>'FA' and h.div <>'SA' and h.div <>'IN' and h.`div`<>'NC' and h.matchno=f.mid and f.season=h.season and f.weekno=h.weekno" ;
 
 switch ($_GET['PERIOD'])
  {
    case 1: $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
    case 2: $period = " and weekday(f.match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
    case 3: $period = " and weekday(f.match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;
  }
  
  
 
 if ($_GET['MPRED']=='HW'):
	$query1 .= " and f.hgoal>f.agoal ";
	$CAPTION = "HOME CALLS";
	$bg = " bgcolor='#f4f4f4' ";
    
  elseif($_GET['MPRED']=="AW"):
    $query1 .= " and f.hgoal<f.agoal ";
  	$CAPTION = "AWAY CALLS";
  	$bg = " bgcolor='#f4f4f4' ";
  
  else:
    $query1 .= " and f.hgoal=f.agoal ";
    $CAPTION = "DRAWS CALLS";
    $bg = " bgcolor='#f4f4f4' ";

  endif;
  
  
  switch ($_GET['SORTBY'])
  {
    case 1: $ordered_by = " ORDER BY h.ht_hedge desc"; break;
    case 2: $ordered_by = " ORDER BY h.at_hedge desc"; break;
    case 3: $ordered_by = " ORDER BY hedgedif ";   break;
    case 4: $ordered_by = " ORDER BY h.avg_hedge desc"; break;
  }
  
  $query1 .= $period . $ordered_by ;

if (isset($_GET['db'])){
  $page_title = "Hedge Betting Reliance Factors " . s_title($db) . " Season $season Week $weekno";
}else{
  $page_title = "Hedge Betting Reliance Factors";
}  


require_once("header.ini.php");

 page_header("Hedge Betting Reliance Factors" ); 
 
?>



<div style="padding-bottom:5px"></div>



<?php if(isset($_GET['db'])){ 
    if (strlen($errlog)>0):
    		echo "<div class='errordiv'>$errlog</div>";
    endif;        

?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?php echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?php echo site_other($db);?></div>
<div class='clear'></div>

<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;" bordercolor="#f4f4f4" width="567">
	  <form method="get" action="<?php echo $PHP_SELEF;?>">
        <input type="hidden" name="db" value="<?php echo $_GET['db'];?>"/>
        
     	<tr bgcolor="#f4f4f4">	 
        <td><b><font size="2" color="#0000FF">Season</font></b></td>
        <td><b><font size="2" color="#0000FF">Week No</font></b></td>
        <td><b><font size="2" color="#0000FF">Bet Type</font></b></td>
        <td><b><font size="2" color="#0000FF">Sort By</font></b></td>
        <td><b><font size="2" color="#0000FF">Period</font></b></td>
	    </tr>
         
      <tr bgcolor="#f4f4f4">	 
         <td><select size="1" name="season" class="text" style="width:80px;">
		 
		  <?php
		   
			  $sqry = "SELECT distinct(season) as season from cur_hedge order by season desc" ;
              echo $sqry;
              
			  if ($db=='eu'){
                   $temp = $eu->prepare($sqry) ;
              }else{
                   $temp = $sa->prepare($sqry);
              }
              $temp->execute();
              
             while ($sr = $temp->fetch()) : 
		   ?>
		      <option value="<?php echo $sr["season"] ?>" <?php echo selected($_GET['season'],$sr["season"])?>><?php echo $sr["season"] ?></option>
		  
		    <?php endwhile; ?>
		    </select>
	
		   </td>
		  
		  <td>
		  <select size="1" name="weekno" class="text" style="width:60px;">

		  <?php for($i=47; $i>=1; $i--) : ?>
			  <option value="<?php echo $i;?>" <?php if($i==$cur): echo " selected"; endif;?>>&nbsp;<?php echo $i;?>&nbsp;&nbsp;&nbsp;</option>
		  <?php endfor;?>		 

		  </select>
		  </td>
		  <td>
            <select size="1" name="MPRED" class="text">
		          <option value="HW" <?php echo selected($_GET['MPRED'],'HW')?>>Home Calls</option> 
		  		  <option value="AW" <?php echo selected($_GET['MPRED'],'AW')?>>Away Calls</option> 
		  
		      </select>		 
             </td>
    		  <td>
    		  <select size="1" name="SORTBY" class="text" style="width:180px;">
      		   <option value="1" <?php echo selected($_GET['SORTBY'],'1')?>>Home Team Reliance Factors</option> 
               <option value="2" <?php echo selected($_GET['SORTBY'],'2')?>>Away Team Reliance Factors</option>
               <option value="4" <?php echo selected($_GET['SORTBY'],'4')?>>Average Reliance Factors</option>
   		  </select>
    		  </td>
		 
    		  
    		  <td>
    		  <select size="1" name="PERIOD" class="text" style="width:110px;">
    		   <option value="1" <?php echo selected($_GET['PERIOD'],'1')?>>Full Week (Mon - Sun)</option> 
               <option value="2" <?php echo selected($_GET['PERIOD'],'2')?>>Weekend (Sat - Sun)</option>
               <option value="3" <?php echo selected($_GET['PERIOD'],'3')?>></option>Midweek (Mon - Fri)</option>
    		  </select>
    		  </td>
		  </tr>   
          
                 
		  
		  
		  <tr bgcolor="#f4f4f4">	 
		  <td colspan='5' align='center'>
		      <input type="submit" value="View Data" name="B1" class="bt" style="padding:4px;"/>

		  </td>
		</tr>	</form>
        
	
		
        </form>
</table>


<?php }else{
    
    require_once("select-option.ini.php");
    
} ?>


<?php if($_GET['B1']=='View Data') { ?>


  <!-- startprint -->
<div style="padding-bottom:5px"></div>
  
<table  width="100%" align="center">
<tr>
	<td> <a class='sbar' href="current-probabilities-reliabilities.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"> <?php echo printscr(); ?></td>
</tr>
</table>
<br />
 
<?php 
    if ( ($db=='eu') and ($_GET['DIV']=='0')){
        $cdiv= divname('0');
    }elseif ( ($db=='sa') and ($_GET['DIV']=='0')){
        $cdiv= divname('1');
    }else{
        $cdiv= divname($_GET['DIV']);
    }
    
    week_box_new($CAPTION . " - CORRECT SCORES" ."<br><font size='1' color='#000000'>$_prerid</font>", $weekno, $wdate, $season, 560);
?>
    
<div style='text-align:center;padding:8px 25px;font-size:11px;font-family:verdana;'>
    
 The following shows the "Correct Scores" Reliance Factors up to the end of the previous week (until midnight on Sunday), 
 listed in order of Reliability, based on the past 10 matches played at either the Home or Away venue (as appropriate) 
 for all Staying Teams (not for Promoted or Relegated Teams).  In theory, the "Average" Reliance 
 Factors ought to indicate where it is worth doing hedge betting with Correct Scores (usually to a maximum of 4 alternative score-lines).     
 
</div> 

 



<table cellpadding='2' border="1" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="560" bgcolor="#F6F6F6">

<tr bgcolor="#d3ebab">
  <td width="5%" class='ctd'><img src="images/tbcap/refno.gif"  border='0' alt=''/></td>
  <td width="5%" class="ctd">
    <?php if($season==curseason($db)){ ?>
	     <img src="images/tbcap/datepic.gif"  border="0" alt=""/>
      <?php }else{ ?>     
        <img src="images/tbcap/date.gif"  border="0" alt=""/>
      <?php } ?> 
     </td>
  <td class='ctd'><img src="images/tbcap/flist.gif" border="0" alt=""/></td>
  <td class='ctd'><img src="images/tbcap/div.gif" border="0" alt=""/></td>
  <td class='ctd'><img src="images/tbcap/asl.gif" border="0" alt=""/></td>
  <td class='ctd'><img src="images/tbcap/act.gif" border="0" alt=""/></td>
  <td class='ctd'><img src="images/tbcap/hteam.gif" border="0" alt=""/></td>
  <td class='ctd'><img src="images/tbcap/ateam.gif" border="0" alt=""/></td>
  <td class='ctd'><img src="images/tbcap/avg.gif" border="0" alt=""/></td>
  <td class='ctd'><img src="images/tbcap/difpos.gif" border="0" alt=""/></td>
</tr>
	
<?php  


if ($db=='eu'){
   $temp = $eu->prepare($query1) ;
}else{
   $temp = $sa->prepare($query1);
}

   $temp->execute();

    if ($temp->rowCount()==0){
       echo "<tr><td colspan='10' class='ctd' style='padding:30px;'><span class='error'>No Matches This Week</span></td></tr>";
    }else {
        
    $pic = "/pic/" ;
    $pic =  $weekno ."/pic";
    $number=0;
    $ngot =0 ;
    $css =0;
    while ($row = $temp->fetch()) {
        
        $number++;
        $matchno = $row['matchno'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;
        
        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&site=$db')\">";
        $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?site='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
        
        $title = "$row[hteam] v $row[ateam] match odds" ;
        $odd=0;
        //$odd = show_rebs($matchno,$_GET['weekno'],$_GET['season'],$_GET['MPRED'],$db);
  
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
        
        $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$_GET['season'],$db)){
            $pr = " pr";
        }    
        

?>	
<tr <?php echo rowcol($number);?>>

    <td class="ctd padd"><?php echo $number; ?></td>
    <td class="ctd "><a class='md2' <?php echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?php echo $matchno;?>&site=<?php echo $db;?>'><?php echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

     <td class='padd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?php echo $row['hteam']?>&site=<?php echo $db;?>">
        <?php echo $row['hteam'] .'</a>' . printv(' v '); ?>
        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?php echo $row['ateam']?>&site=<?php echo $db;?>">
            <?php echo $row['ateam'];?></a>
     </td>
     
    <td class="ctd"><?php echo ($row["div"]); ?></td>
    <td class="ctd <?php echo $asl_class . $pr;?>"><?php echo $row['hgoal'] . dash() . $row['agoal'];?></td>
    <td class="ctd <?php echo $asl_class;?>"><?php echo $row['h_s'] . dash() . $row['a_s']; ?></td>
    <td class="ctd" <?php echo ($_GET["SORTBY"]=='1'? "bgcolor='#D3EBAB'": "");?>><?php echo ($row["ht_hedge"]); ?></td>
    <td class="ctd" <?php echo ($_GET["SORTBY"]=='2'? "bgcolor='#D3EBAB'": "");?>><?php echo ($row["at_hedge"]); ?></td>
    <td class="ctd" <?php echo ($_GET["SORTBY"]=='4'? "bgcolor='#D3EBAB'": "");?>><?php echo ($row["avg_hedge"]); ?></td>
    <td class="ctd"><?php echo ($row["hedgedif"]); ?></td>
    

</tr>

<?php    }
    }  


 if ($temp->rowCount()>0){
?>
  
<tr bgcolor="#f4f4f4">
    <td colspan="4" class="rtd padd credit">Total Correct Calls</td>
    <td colspan="2" class="ctd padd credit"><?php echo $ngot; ?></td>
    <td colspan="4"></td>
  </tr> 

   <tr bgcolor="#f4f4f4">
    <td colspan="4" class="rtd padd credit">Total Correct Score Hits</td>
    <td colspan="2" class="ctd padd credit"><?php echo $css; ?></td>
    <td colspan="4"></td>
  </tr> 
<?php } ?>
</table>



              
<div style='padding-top:4px;padding-left:5px;font-size:11px;'>

<font size="1" color="blue"><b>ASL</font></b> = <font color='black'>Anticipated Score-Line</font> |	
<font size="1" color="blue"><b>Act Res</font></b> = <font color='black'>Actual Result</font> | 
<font size="1" color="blue"><b>Avg</font></b> = <font color='black'>Average Reliabilities</font><br />  
<font size="1" color="blue"><b>Diff</font></b> = <font color='black'>Difference in Hedge Betting Reliance Factor </font><br />    
<font size="1" color="blue"><b><i>Italicised score-line</i></font></b> = <font color='black'>relegated and/or promoted teams playing</font><br>

</div>

<div style='padding:25px;font-size:11px;'>

The above figures are "relative" only, and relate to how near to (or far away from) the ACTUAL Score-Lines the Program's originally posted "Anticipated Scorelines" (ASL's) have been, looking backwards over the past 10 matches.

<br /><br />If the "Hedge Betting Reliance Factor" for a team is low, then it means that the ASL has been way off the mark many times, and therefore that team's ASL is unreliable and inappropriate for use when deciding Correct Scores "Hedge Betting". 

</div>


<br>&nbsp;<br>&nbsp;<br>

 
<!-- stopprint -->

<?php
}


require_once("footer.ini.php"); 


function show_rebs($mid,$week,$season,$sort,$db)
{ global $h2, $eu, $sa;
//echo "select * from cur_reb where season='$season' and weekno='$week' and matchno='$mid'<br>";

 $qq = "select * from cur_reb where season='$season' and weekno='$week' and matchno='$mid'";
if ($db=='eu'){
   $tempw = $eu->prepare($qq) ;
}else{
   $tempw = $sa->prepare($qq);
}
$tempw->execute();
$dd = $tempw->fetch() ; 

 
 if ($sort=="AD"):
	 $data2 = "<td bgcolor='#D3EBAB' style=\"text-align: center\" height=\"12\">";
 else:
	$data2 = "<td style=\"text-align: center\" height=\"12\">";
 endif;

 $h33 = "onMouseover=\"ddrivetip('<B>Current Reliabilities Data</B><BR>". $dd['hteam'] . ": " . num2($dd["gpr_ht"]) ."<br>" . $dd['ateam'] . ": " . num2($dd["gpr_at"])  . "<br>Avg: ". num2($dd["gpr_av"]) . "<br>Diff: ". num20($dd["gpr_dif"]) ."', 150)\"; onMouseout=\"hideddrivetip()\"" ;

 $data2 .= "<a href='#' class='sbar'>" . num2($dd["gpr_av"]) . "</a></td>\n" ;
 return $data2;

}


?>
