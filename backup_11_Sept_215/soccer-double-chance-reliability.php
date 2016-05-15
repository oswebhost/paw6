<?php
session_start();

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
 
 
  $pic =  $weekno ."/pic";
  
 $qry = "SELECT c.*,abs(c.dcr_dif) as dcrdif,f.match_time,f.hgoal,f.agoal,f.h_s,f.a_s,f.gotit,date_format(f.match_date,'%d-%b-%y') as mdate2  FROM cur_reb_dcr c, fixtures f WHERE (c.div<>'RP' and  c.div<>'UP' and c.div<>'MP' and c.`div`<>'NC' )AND c.weekno='$weekno' and c.season='$season' and c.matchno=f.mid and f.season=c.season and f.weekno=c.weekno";
  
  switch ($_GET['CALL'])
  { 
    case 1: $ordered_by = " and f.hgoal>f.agoal "; $row3cap = "Home Win Calls"; break;
    case 2: $ordered_by = " and f.agoal>f.hgoal "; $row3cap = "Away Win Calls"; break;
    case 3: $ordered_by = " and f.hgoal=f.agoal "; $row3cap = "Draw Calls"; break;
    case 4: $ordered_by = " ORDER BY c.gpr_av desc"; $row3cap = "All Call Types"; break;
  }
  
  switch ($_GET['PERIOD'])
  {
    case 1: $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
    case 2: $period = " and weekday(f.match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
    case 3: $period = " and weekday(f.match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;
  }
  
  switch ($_GET['SORTBY'])
  {
    case 1: $ordered_by .= " ORDER BY c.dcr_ht desc"; break;
    case 2: $ordered_by .= " ORDER BY c.dcr_at desc"; break;
    case 3: $ordered_by .= " ORDER BY dcrdif ";   break;
    case 4: $ordered_by .= " ORDER BY c.dcr_av desc"; break;
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

   
  
  
  $query1 = $qry . $divs . $period . $ordered_by ;

if (isset($_GET['db'])){
  $page_title = "Double Chance Reliabilities " . s_title($db) . " Season $season Week $weekno";
}else{
  $page_title = "Double Chance Reliabilities";
}  


include("header.ini.php");

 page_header("Double Chance Reliabilities" ); 
 
?>



<div style="padding-bottom:5px"></div>



<? if (isset($_GET['db'])){ 
    if (strlen($errlog)>0):
    		echo "<div class='errordiv'>$errlog</div>";
    endif;        
    
?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>

<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;" bordercolor="#f4f4f4" width="567">
	  <form method="get" action="<?echo $PHP_SELEF;?>">
        <input type="hidden" name="db" value="<?echo $_GET['db'];?>"/>
		<tr bgcolor="#f4f4f4">
        
    		<td ><b><font size="2" color="#0000FF">Season</font></b></td>
    		<td ><b><font size="2" color="#0000FF">Week No</font></b></td>
            <td ><b><font size="2" color="#0000FF">Division</font></b></td>
            
               
          </tr>

        <tr bgcolor="#f4f4f4">
         <td>
	    <select size="1" name="season" class="text" style="width:100px;">
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


		   <select size="1" name="DIV" class="text" style="width:200px;">

             <? if ($db=='eu'){ ?>
	            <option value="0" <?echo selected($_GET['DIV'],'0')?>>UK/European Premier Divisions</option> 
                <option value="1" <?echo selected($_GET['DIV'],'1')?>>UK/European Major Divisions</option> 
                <option value="2" <?echo selected($_GET['DIV'],'2')?>>UK Minor Divisions</option> 
                <option value="-1" <?echo selected($_GET['DIV'],'-1')?>>All-In List of Matches</option> 

    			<? for ($_i=0; $_i<count($arry_div); $_i++){ ?>
    			  <? if ($_i<>4 and $_i<>9 and $_i<>18){ ?>
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
            <td ><b><font size="2" color="#0000FF">Call Type</font></b></td>
            <td ><b><font size="2" color="#0000FF">Sort By</font></b></td>
            <td ><b><font size="2" color="#0000FF">Period</font></b></td>
          </tr>
          
    	    <tr bgcolor="#f4f4f4">	 
    		  <td>
    		  <select size="1" name="CALL" class="text" style="width:120px;">
    		   <option value="1" <?echo selected($_GET['CALL'],'1')?>>Home Win Calls</option> 
               <option value="2" <?echo selected($_GET['CALL'],'2')?>>Away Win Calls</option>
               

    		  </select>
    		  </td>
		      
    		  <td>
    		  <select size="1" name="SORTBY" class="text" style="width:150px;">
        		   <option value="1" <?echo selected($_GET['SORTBY'],'1')?>>Home Team Reliability</option> 
                   <option value="2" <?echo selected($_GET['SORTBY'],'2')?>>Away Team Reliability</option>
                   <option value="4" <?echo selected($_GET['SORTBY'],'4')?>>Average Reliabilities</option>
    		  </select>
    		  </td>
		 
    		  
    		  <td>
    		  <select size="1" name="PERIOD" class="text" style="width:200px;">
        		   <option value="1" <?echo selected($_GET['PERIOD'],'1')?>>Full Week (Mon - Sun)</option> 
                   <option value="2" <?echo selected($_GET['PERIOD'],'2')?>>Weekend (Sat - Sun)</option>
                   <option value="3" <?echo selected($_GET['PERIOD'],'3')?>>Midweek (Mon - Fri)</option>
    		  </select>
    		  </td>
		  </tr>          
          
          
		 
		  <tr bgcolor="#f4f4f4">
		      <td colspan='3' class='ctd padd'>
		      <input type="submit" value="View Data" name="B1" class="bt" style="padding:4px;"/>

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
  
<table  width="100%" align="center">
<tr>
	<td> <a class='sbar' href="current-probabilities-reliabilities.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
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
    
    week_box_new_3rows( $cdiv, $weekno, $wdate, $season,$row3cap . "<br><font size='1' color='#000000'>$_prerid</font>",567); ?>
   
<div style='text-align:center;padding:8px 25px;font-size:11px;font-family:verdana;'>
    
    The following shows the Reliabilities up to the end of the previous week 
    (until midnight on Sunday), listed in order of highest requested Reliability, 
     based on the past 10 matches played at either the Home or Away venue (as appropriate) for all Staying Teams (not for Promoted or Relegated Teams).  
 
</div> 

 



<table cellpadding='2' border="1" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="560" bgcolor="#F6F6F6">

<tr bgcolor="#d3ebab">
  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=''/></td>
  <td width="10%"  class='ctd' rowspan="2">
   
   <?if ($season==curseason($db)){ ?>
        <img src="images/tbcap/datepic.gif"  border='0' alt=''/>
    <? }else { ?>     
        <img src="images/tbcap/date.gif"  border='0' alt=''/>
    <?}?> 
   
    </td>

    <td width="38%"  class='ctd' rowspan="2"><img src="images/tbcap/flist.gif" border='0' alt=''/></td>

    <? if ($_GET['DIV']<=2){ ?>
      <td width="5%"  class='ctd' rowspan="2"><img src="images/tbcap/div.gif" border='0' alt=''/></td>
    <? } ?>

    <td width="6%"  class='ctd' rowspan="2"><img src="images/tbcap/asl.gif" border='0' alt=''/></td>
    <td width="6%"  class='ctd' rowspan="2"><img src="images/tbcap/act.gif" border='0' alt=''/></td>
    <td width="24%" class='ctd' colspan="4"><img src="images/tbcap/reb-info.gif" border='0' alt=''/></td>

</tr>

<tr bgcolor="#d3ebab">
  <td width="8%" class='ctd'><img src="images/tbcap/hteam-sm.gif" border='0' alt=''/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/ateam-sm.gif" border='0' alt=''/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/avg-sm.gif" border='0' alt=''/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/diff-smp.gif" border='0' alt=''/></td>
</tr>
	
<?  


if ($db=='eu'){
   $temp = $eu->prepare($query1) ;
}else{
   $temp = $sa->prepare($query1);
}

   $temp->execute();

    if ($temp->rowCount()==0){
       echo "<tr><td colspan='9' class='ctd' style='padding:30px;'><span class='error'>No Matches This Week</span></td></tr>";
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
<tr <?echo rowcol($number);?>>

    <td class="ctd padd"><?echo $number; ?></td>
    <td class="ctd "><a class='md2' <?echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?echo $matchno;?>&site=<?echo $db;?>'><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

     <td class='padd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['hteam']?>&site=<?echo $db;?>">
        <?echo $row['hteam'] .'</a>' . printv(' v '); ?>
        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['ateam']?>&site=<?echo $db;?>">
            <?echo $row['ateam'];?></a>
     </td>
     <? if ($_GET['DIV']<=2){ ?> 
        <td class="ctd"><?echo ($row["div"]); ?></td>
     <?}?>
    
    
    <td class="ctd <?echo $asl_class . $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
    <td class="ctd <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='1'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_ht"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='2'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_at"]); ?></td>
    <td class="ctd" <?echo ($_GET["SORTBY"]=='4'? "bgcolor='#D3EBAB'": "");?>><?echo ($row["dcr_av"]); ?></td>
    <td class="ctd"><?echo ($row["dcrdif"]); ?></td>
    

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
<font size="1" color="blue"><b>Avg</font></b> = <font color='black'>Average Reliabilities</font><br />  
<font size="1" color="blue"><b>Diff</font></b> = <font color='black'>Difference in Reliabilities</font> |  
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
