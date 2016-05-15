<?php
session_start();
include("config.ini.php");
include("function.ini.php");

if (!isset($_REQUEST['db'])){
	include("header.ini.php");
	include("select-option.ini.php");
	include("footer.ini.php");
	exit;
}

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
  
  if ($_GET['MPRED']=='HW'):
    $query1 = "SELECT *,date_format(match_date,'%d-%b-%y') as mdate2 from fixtures where weekno='$weekno' and season='$season' and hgoal>agoal and`div`<>'MP' and `div`<>'UP' and`div`<>'RP' and`div`<>'FA' and`div`<>'SA' and`div`<>'IN' and `div`<>'NC'";
    $orderby = " ORDER BY hwinpb desc"; 
	$CAPTION = "HOME CALLS";
	$bg = " bgcolor='#f4f4f4' ";
 
  elseif($_GET['MPRED']=="AW"):
    $query1 = "SELECT *,date_format(match_date,'%d-%b-%y') as mdate2 from fixtures where weekno='$weekno' and season='$season' and hgoal<agoal and`div`<>'MP' and `div`<>'UP' and`div`<>'RP' and`div`<>'FA' and`div`<>'SA' and`div`<>'IN' and `div`<>'NC'";
    $orderby = " ORDER BY awinpb desc"; 
	$CAPTION = "AWAY CALLS";
	$bg = " bgcolor='#f4f4f4' ";
  
  else:
     $query1 = "SELECT f.*,date_format(match_date,'%d-%b-%y') as mdate2, r.gpr_av from fixtures f, cur_reb r where f.weekno='$weekno' and f.season='$season' and f.hgoal=f.agoal and f.`div`<>'MP' and f.`div`<>'UP' and f.`div`<>'RP' and f.`div`<>'FA' and f.`div`<>'NC' and f.`div`<>'SA' and f.`div`<>'IN' and f.mid=r.matchno and f.weekno=r.weekno and f.season=r.season";
     $orderby = " ORDER BY gpr_av desc";
	 $CAPTION = "DRAWS CALLS";
	 $bg = " bgcolor='#f4f4f4' ";
  endif;


 switch ($_GET['PERIOD'])
  {
    case 1: $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
    case 2: $period = " and weekday(match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
    case 3: $period = " and weekday(match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;
  }
  
  $query1 .= $period . $orderby ;
  //$result = mysql_query($query1) or die(" $query1 --" .  mysql_error() ); 

if (isset($_GET['db'])){
  $page_title = "Match Probabilities " . s_title($db) . " Season $season Week $weekno";
}else{
  $page_title = "Match Probabilities";
}


$pageURL = "?PARA=$weekno";

include("header.ini.php");
 $page_title = "Match Probabilities ";
?>


<? page_header($page_title); ?>
<div style="padding-bottom:5px"></div>



<? if (isset($_GET['db'])){ 

 if (strlen($errlog)>0):
		echo "<div class='errordiv'>$errlog</div>";
 endif;    
    
?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>

<table  width="100%" align="center">
<tr>
	<td><?php echo back();?></td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"> <? echo printscr(); ?></td>
</tr>
</table>
<br />
<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:0 auto 10px auto;" bordercolor="#f4f4f4" width="560">
	  <form method="get" action="soccer-win-probability-data.php">
        <input type="hidden" name="db" value="<?echo $_GET['db'];?>"/>
		<tr bgcolor="#f4f4f4">
		<td width="100" ><b><font size="2" color="#0000FF">Season</font></b></td>
        <td width="70" ><b><font size="2" color="#0000FF">Week No</font></b></td>
        <td width="80" ><b><font size="2" color="#0000FF">Bet Type</font></b></td>
        <td  width="100"><b><font size="2" color="#0000FF">Period</font></b></td>
        <td width="50" rowspan="2" style="vertical-align: bottom;"><input type="submit" value="View Data" name="B1" class="bt" style="padding:8px;padding-top:4px;"/></td>
        
        </tr>
        
        <tr bgcolor="#f4f4f4">
		  <td>

		 <select size="1" name="season" class="text">
		  <? 
		   
			  $sqry = "SELECT distinct(season) as season from cur_reb order by season desc" ;
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
	
		  
		  <td>
		  <select size="1" name="weekno" class="text" >

		  <? for ($i=47; $i>=1; $i--) : ?>
			  <option value="<?= $i;?>" <? if($i==$cur): echo " selected"; endif;?>>&nbsp;<?= $i;?>&nbsp;&nbsp;&nbsp;</option>
		  <? endfor;?>		 

		  </select>
		  </td>
		  
		 
		  <td>
		  <select size="1" name="MPRED" class="text">
		  <option value="HW" <?echo selected($_GET['MPRED'],'HW')?>>Home Calls</option> 
		  <option value="AD" <?echo selected($_GET['MPRED'],'AD')?>>Draw Calls</option> 
		  <option value="AW" <?echo selected($_GET['MPRED'],'AW')?>>Away Calls</option> 
		  
		  </select>
		  </td>
		 
    		  
    		  <td>
    		  <select size="1" name="PERIOD" class="text" style="width:150px;">
    		   <option value="1" <?echo selected($_GET['PERIOD'],'1')?>>Full Week (Mon - Sun)</option> 
               <option value="2" <?echo selected($_GET['PERIOD'],'2')?>>Weekend (Sat - Sun)</option>
               <option value="3" <?echo selected($_GET['PERIOD'],'3')?>>Midweek (Mon - Fri)</option>
    		  </select>
    		  </td>
		 </tr>
         </form>
	  </table>

<?}else{
    
    include("select-option.ini.php");
    
} ?>


<? if ($_GET['B1']=='View Data') { ?>


  <!-- startprint -->
<div style="padding-bottom:5px"></div>
   
<? week_box_new($CAPTION . "<br><font size='1' color='#000000'>$_prerid</font>", $weekno, $wdate, $_GET['season'],'560') ?>
   




<div style='text-align:center;padding:8px;font-size:12px;font-family:verdana;'>
The following shows the Probabilities up to <BR>the end of the previous week (until midnight on Sunday).
</div>

 



<table cellpadding='2' border="1" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="560" bgcolor="#F6F6F6">
<tr bgcolor="#D3EBAB">
	  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>
	  <td width="10%" class='ctd' rowspan="2">
	  <?if ($season==curseason($db)){ ?>
	   <img src="images/tbcap/datepic.gif"  border="0" alt=""/>
    <? }else { ?>     
      <img src="images/tbcap/date.gif"  border="0" alt=""/>
    <?}?> 
     </td>
	  <td width="38%" class='ctd' rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
	  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
	  <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
      <td width="6%" rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
	  <td width="24%" colspan="3" align='center'><img src="images/tbcap/probs.gif"  border='0' alt=""/></td>
	  <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/av-reb.gif"  border="0" alt=""/></td>
</tr>
<tr bgcolor="#d3ebab">
	  <td width="8%" class='ctd'><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
	  <td width="8%" class='ctd'><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
	  <td width="8%" class='ctd'><img src="images/tbcap/a.gif"  border='0' alt=""/></td>
</tr>                
	
<?  


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
        $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;
        
        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&site=$db')\">";
        $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?site='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
        
        $title = "$row[hteam] v $row[ateam] match odds" ;
        $odd=0;
        $odd = show_rebs($matchno,$_GET['weekno'],$_GET['season'],$_GET['MPRED'],$db);
  
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
<tr <?echo rowcol($number);?>>

    <td class="ctd padd"><?echo $number; ?></td>
    <td class="ctd "><a class='md2' <?echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?echo $matchno;?>&site=<?echo $db;?>'><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

     <td class='padd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['hteam']?>&site=<?echo $db;?>">
        <?echo $row['hteam'] .'</a>' . printv(' v '); ?>
        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['ateam']?>&site=<?echo $db;?>">
            <?echo $row['ateam'];?></a>
     </td>
     
    <td class="ctd"><?echo ($row["div"]); ?></td>
    <td class="ctd <?echo $asl_class . $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
    <td class="ctd <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
    <td class="ctd" <?echo ($_GET['MPRED']=='HW'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["hwinpb"]); ?></td>
    <td class="ctd" <?echo ($_GET['MPRED']=='AD'? "": "");?>><?echo ($row["drawpb"]); ?></td>
    <td class="ctd" <?echo ($_GET['MPRED']=='AW'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["awinpb"]); ?></td>
    <?echo $odd;?>

</tr>

<?    }
    }  


 if ($temp->rowCount()>0){
?>
  

<tr bgcolor="#f4f4f4">
    <td colspan="4" class="rtd padd credit">Total Correct Calls</td>
    <td colspan="2" class="ctd padd credit"><?echo $ngot; ?></td>
    <td colspan="4"></td>
  </tr> 

   <tr bgcolor="#f4f4f4">
    <td colspan="4" class="rtd padd credit">Total Correct Score Hits</td>
    <td colspan="2" class="ctd padd credit"><?echo $css; ?></td>
    <td colspan="4"></td>
  </tr> 
  
<?}?>
</table>



              
<div style='padding-top:4px;padding-left:5px;font-size:11px;'>
	
<font size="1" color="blue"><b>ASL</font></b> = <font color='black'>Anticipated Score-Line</font> |
<font size="1" color="blue"><b>Act Res</font></b> = <font color='black'>Actual Result</font> |
<font size="1" color="blue"><b>Avg Rels</font></b> = <font color='black'>Average Reliabilities</font> <br />
<font size="1" color="blue"><b><i>Italicised score-line</i></font></b> = <font color='black'>relegated and/or promoted teams playing</font><br>


</div>

<br>&nbsp;<br>&nbsp;<br>

 
<!-- stopprint -->

<? 
}


include("footer.ini.php"); 


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
