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

$PAGE_TITLE ="Soccer Prediction Data Analysis";


 $pic =  $weekno ."/pic";
  
 $qry = "SELECT c.dcr_ht, c.dcr_at, c.dcr_av,c.dcr_dif,abs(c.dcr_dif) as dcrdif,f.`div`, 
        f.hteam,f.ateam,f.match_time,f.hgoal,f.agoal,f.h_s,f.a_s,f.gotit,f.mid, date_format(f.match_date,'%d-%b-%y') as mdate,
        f.hwinpb, f.drawpb, f.awinpb, f.h_odd, f.d_odd, f.a_odd, r.gpr_ht, r.gpr_at, r.gpr_av,r.gpr_dif, abs(r.gpr_dif) as gprdif  
        FROM cur_reb_dcr c, fixtures f, cur_reb r
        WHERE (c.div<>'RP' and  c.div<>'UP' and c.div<>'MP' and c.`div`<>'NC') AND 
        c.weekno='$weekno' and c.season='$season' and 
        c.matchno=f.mid and f.season=c.season and f.weekno=c.weekno and 
        r.matchno=f.mid and r.season=c.season and r.weekno=c.weekno " ;
        
  
  switch ($_GET['CALL'])
  { 
    case 1: $call = " and f.hgoal>f.agoal "; $row3cap = "Home Win Calls"; break;
    case 2: $call = " and f.agoal>f.hgoal "; $row3cap = "Away Win Calls"; break;
    case 3: $call = " and f.hgoal=f.agoal "; $row3cap = "Draw Calls";     break;
    case 4: $call = " "; $row3cap = "All Call Types"; break;
  }
  
  switch ($_GET['PERIOD'])
  {
    case 1: $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
    case 2: $period = " and weekday(f.match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
    case 3: $period = " and weekday(f.match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;
  }
  
  switch ($_GET['SORTBY'])
  {
    case 1: $ordered_by = " ORDER BY r.gpr_ht "; break;
    case 2: $ordered_by = " ORDER BY r.gpr_at "; break;
    case 3: $ordered_by = " ORDER BY r.gpr_av "; break;

    case 4: $ordered_by = " ORDER BY c.dcr_ht "; break;
    case 5: $ordered_by = " ORDER BY c.dcr_at "; break;
    case 6: $ordered_by = " ORDER BY c.dcr_av "; break;

    case 7: $ordered_by = " ORDER BY f.hwinpb "; break;
    case 8: $ordered_by = " ORDER BY f.awinpb "; break;
    case 9: $ordered_by = " ORDER BY f.drawpb "; break;

    case 10: $ordered_by = " ORDER BY f.h_odd "; break;
    case 11: $ordered_by = " ORDER BY f.a_odd "; break;
    case 12: $ordered_by = " ORDER BY f.d_odd "; break;
  }

  switch($_GET['ordered'])
  {
    case 1: $ordered = " asc"; break;
    case 2: $ordered = " desc"; break;
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

if ($_GET['DIV']=='0'):
    $divs = " AND (c.div<>'RP' and  c.div<>'UP' and c.div<>'MP' and c.`div`<>'NC') " ;
else:
    $divs = " AND c.div='$_GET[DIV]'" ;
endif;
  
  
  
$query1 = $qry . $divs . $period . $call . $filter . $ordered_by . $ordered ;


if (isset($_GET['db'])){
  $page_title = "Soccer Prediction Data Analysis " . s_title($db) . " Season $season Week $weekno";
}else{
  $page_title = "Soccer Prediction Data Analysis";
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

  window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=710,height=520");
}
</script>

<body>
<?php  page_header($PAGE_TITLE); ?>

<div style="padding-bottom:5px"></div>

<? if (isset($_GET['db'])){ 

    if (strlen($errlog)>0){
    	echo "<div class='errordiv' style='width:835px;margin:0 auto 10px auto;'>$errlog</div>";
    }        
    
?>

<div style='width:860px; margin:auto auto;'>
<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>
</div>

<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;" bordercolor="#f4f4f4" width="850">
	 
	  <form method="get" action="<?echo $PHP_SELEF;?>">
        <input type="hidden" name="db" value="<?echo $_GET['db'];?>"/>
		

		<tr bgcolor="#f4f4f4">
        
    		<td width='80' class='rtd'><b><font size="2" color="#0000FF">Season</font></b></td>
    		<td>
		    <select size="1" name="season" class="text" style='padding:3px;width:120px;'>
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


			<td class='rtd'><b><font size="2" color="#0000FF">Week No</font></b></td>

		 <td>
		  <select size="1" name="weekno" class="text"  style='padding:3px;'>

		  <? for ($i=47; $i>=1; $i--) : ?>
			  <option value="<?= $i;?>" <? if($i==$cur): echo " selected"; endif;?>>&nbsp;<?= $i;?>&nbsp;&nbsp;&nbsp;</option>
		  <? endfor;?>		 

		  </select>
		  </td>


		  <td class='rtd'><b><font size="2" color="#0000FF">Division</font></b></td>
	
	      <td>
		   <select size="1" name="DIV" class="text" style="width:200px; padding:3px;">

             <? if ($db=='eu'){ ?>
    		    <option value="0" <?echo selected($_GET['DIV'],'0')?>>UK/European Major Divisions</option> 
    			<? for ($_i=0; $_i<count($arry_div); $_i++){ ?>
    			   <? if ($_i<>5 and $_i<>10 and $_i<>19){ ?>
    					<option value="<? echo $arry_div[$_i];?>" <? echo selected($_GET['DIV'], $arry_div[$_i]);?>><? echo divname($arry_div[$_i]); ?></option>
    			   <? } ?>
    			<? } ?>
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

       <tr bgcolor="#f4f4f4">
            
            <td class='rtd'><b><font size="2" color="#0000FF">Call Type</font></b></td>
              <td>
    		  <select size="1" name="CALL" class="text" style="width:120px;padding:3px;">
    		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win Calls</option> 
               <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win Calls</option>
               <option value="3" <?echo selected($_GET['CALL'],'3')?>>Draw Calls</option>
               

    		  </select>
    		</td>



            <td class='rtd'><b><font size="2" color="#0000FF">Sort On</font></b></td>
            <td>
    		  <select size="1" name="SORTBY" class="text" style="width:180px;padding:3px;">
          <optgroup label="Odds">  
            <option value="10" <?echo selected($_GET['SORTBY'],'10')?>>Home Wins Odds</option>
            <option value="11" <?echo selected($_GET['SORTBY'],'11')?>>Away Wins Odds</option>
            <option value="12" <?echo selected($_GET['SORTBY'],'12')?>>Draw Odds</option>
          </optgroup>

          <optgroup label="Probabilities">    
            <option value="7" <?echo selected($_GET['SORTBY'],'7')?>>Home Wins Probabilities</option>
            <option value="8" <?echo selected($_GET['SORTBY'],'8')?>>Away Wins Probabilities</option>
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

            <td class='rtd'><b><font size="2" color="#0000FF">Period</font></b></td>
              <td>
    		  <select size="1" name="PERIOD" class="text" style="width:200px;padding:3px;">
        		   <option value="1" <?echo selected($_GET['PERIOD'],'1')?>>Full Week (Mon - Sun)</option> 
               <option value="2" <?echo selected($_GET['PERIOD'],'2')?>>Weekend (Sat - Sun)</option>
               <option value="3" <?echo selected($_GET['PERIOD'],'3')?>>Midweek (Mon - Fri)</option>
    		  </select>
    		  </td>
          </tr>
       
       <tr bgcolor="#f4f4f4">
            <td class='rtd'><b><font size="2" color="#0000FF">Odds Range</font></b></td>
            <td><input type='text' style='width:40px;text-align:center;' name='min_odd' value='<?php echo $_GET['min_odd']?>'/> Min
              &nbsp;<input type='text' style='width:40px;text-align:center;' name='max_odd' value='<?php echo $_GET['max_odd']?>'/> Max
            </td>
            <td></td>
            <td></td>
            <td></td>
            <td></td>
       </tr>

		  <tr bgcolor="#f4f4f4">
		      <td colspan='6' class='ctd padd'>
		      <input type="submit" value="View Data" name="B1" class="bt" style="padding:8px;"/>

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
  
<table  width="850" style='margin:auto auto'>
<tr>
  <td></td>
  <td align="center"><span class='bot'></span></td>
  <td align="right"> <? echo printscr(); ?></td>
</tr>
</table>
<br />
 
<? 
    if ( ($db=='eu') and ($_GET['DIV']=='0')){
        $cdiv= divname('0');
    }elseif ( ($db=='sa') and ($_GET['DIV']=='0')){
        $cdiv= divname('1');
    }else{
        $cdiv= divname($_GET['DIV']);
    }
    

week_box_new_3rows( $cdiv, $weekno, $wdate, $season,$row3cap . "<br><font size='1' color='#000000'>$_prerid</font>",850); ?>
   


<br/>

<table cellpadding='2' border="1" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="980" bgcolor="#F6F6F6">

<tr bgcolor="#d3ebab">
  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=''/></td>
  <td width="15%"  class='ctd' rowspan="2">
   
   <?if ($season==curseason($db)){ ?>
        <img src="images/tbcap/datepic.gif"  border='0' alt=''/>
    <? }else { ?>     
        <img src="images/tbcap/date.gif"  border='0' alt=''/>
    <?}?> 
   
    </td>

    <td width="38%"  class='ctd' rowspan="2"><img src="images/tbcap/flist.gif" border='0' alt=''/></td>

  
    <td width="5%"  class='ctd' rowspan="2"><img src="images/tbcap/div.gif" border='0' alt=''/></td>
  
    <td width="6%"  class='ctd' rowspan="2"><img src="images/tbcap/asl.gif" border='0' alt=''/></td>
    <td width="6%"  class='ctd dark' rowspan="2"><img src="images/tbcap/act.gif" border='0' alt=''/></td>

    <td class='ctd dark' colspan="3"><img src="images/tbcap/probs2.gif" border='0' alt=''/></td>
    <td class='ctd dark' colspan="4"><img src="images/tbcap/1x2rebinfo.gif" border='0' alt=''/></td>
    <td class='ctd dark' colspan="4"><img src="images/tbcap/dcrebinfo.gif" border='0' alt=''/></td>
    <td class='ctd' colspan="3"><img src="images/tbcap/odd2.gif" border='0' alt=''/></td>

</tr>

<tr bgcolor="#d3ebab">
  <td class='ctd'><img src="images/tbcap/home.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/d.gif" border='0' alt=''/></td>
  <td class='ctd dark'><img src="images/tbcap/a.gif" border='0' alt=''/></td>
  

  <td class='ctd '><img src="images/tbcap/hteam-sm.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/ateam-sm.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/avg-sm.gif" border='0' alt=''/></td>
  <td class='ctd dark'><img src="images/tbcap/diff-smp.gif" border='0' alt=''/></td>

  <td class='ctd'><img src="images/tbcap/hteam-sm.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/ateam-sm.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/avg-sm.gif" border='0' alt=''/></td>
  <td class='ctd dark'><img src="images/tbcap/diff-smp.gif" border='0' alt=''/></td>

  <td class='ctd '><img src="images/tbcap/home.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/d.gif" border='0' alt=''/></td>
  <td class='ctd'><img src="images/tbcap/a.gif" border='0' alt=''/></td>

</tr>

<?  


if ($db=='eu'){
   $temp = $eu->prepare($query1) ;
}else{
   $temp = $sa->prepare($query1);
}

   $temp->execute();

    if ($temp->rowCount()==0){
       echo "<tr><td colspan='20' class='ctd' style='padding:30px;'><span class='error'>No Matches This Week</span></td></tr>";
    }else {
        
    $pic = "/pic/" ;
    $pic =  $weekno ."/pic";
    $number=0;
    $ngot =0 ;
    $css =0;
    $postponed = 0;

    while ($row = $temp->fetch()) {
        
        $number++;
        $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;
        
            
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
            $postponed++;
           
        }
        
        $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$_GET['season'],$db)){
            $pr = " pr";
        }    
        

?>  
<tr <?echo rowcol($number);?> class='row'>

    <td class="ctd padd"><?echo $number; ?></td>
    <td class="ctd "><a class='md2' <?echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?echo $matchno;?>&site=<?echo $db;?>'><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

     <td class='padd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['hteam']?>&site=<?echo $db;?>">
        <?echo $row['hteam'] .'</a>' . printv(' v '); ?>
        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['ateam']?>&site=<?echo $db;?>">
            <?echo $row['ateam'];?></a>
     </td>
     
     <td class="ctd"><?echo ($row["div"]); ?></td>
    
    
    <td class="ctd <?echo $asl_class . $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
    <td class="ctd dark <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>

    <td class="ctd" <?echo ($_GET["SORTBY"]=='7'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["hwinpb"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='9'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["drawpb"]); ?></td>
    <td class="ctd dark" <?echo ($_GET["SORTBY"]=='8'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["awinpb"]); ?></td>

    <td class="ctd" <?echo ($_GET["SORTBY"]=='1'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["gpr_ht"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='2'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["gpr_at"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='3'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["gpr_av"]); ?></td>
    <td class="ctd dark"><?echo ($row["gprdif"]); ?></td>

    <td class="ctd" <?echo ($_GET["SORTBY"]=='4'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_ht"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='5'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_at"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='6'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_av"]); ?></td>
    <td class="ctd dark"><?echo ($row["dcrdif"]); ?></td>
    
    <td class="ctd" <?echo ($_GET["SORTBY"]=='10'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["h_odd"]); ?></a></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='12'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["d_odd"]); ?></a></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='11'? "bgcolor='#D3EBAB'": "");?>><a class='md' href="javascript:tell('full_odds.php?id=<?echo $row['mid'];?>&db=<?echo $db;?>')"><?echo ($row["a_odd"]); ?></a></td>

</tr>

<?    }
    }  


 if ($temp->rowCount()>0){
?>
<tr bgcolor="#f4f4f4">
    
    
    <td colspan="5" class="rtd padd bot">Total Correct Calls&nbsp;</td>
    <td colspan="1" class="ctd padd bot"><?echo $ngot; ?></td>
    <td colspan="2" class="ctd padd bot"><?echo num2(($ngot/($number-$postponed))*100) ."%" ; ?></td>

    <td colspan="4" class="rtd padd bot">Total Correct Score Hits&nbsp;</td>
    <td colspan="1" class="ctd padd bot"><?echo $css; ?></td>

    <td colspan="6" class="rtd padd bot">Postponed Matches&nbsp;</td>
    <td colspan="1" class="ctd padd bot"><?echo $postponed; ?></td>
 
  </tr> 
 
<?}?>


</table>


<?php }?>


</body>

</html>