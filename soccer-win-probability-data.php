<?php


require_once("config.ini.php");
require_once("function.ini.php");

if (!isset($_REQUEST['db'])){
	require_once("header.ini.php");
	require_once("select-option.ini.php");
	require_once("footer.ini.php");
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
  //  header("location: authorization.php");

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
    $query1 = "SELECT f.*,date_format(f.match_date,'%d-%b-%y') as mdate2 from fixtures f where f.weekno='$weekno' and f.season='$season' and f.hgoal>f.agoal ";
    $orderby = " ORDER BY hwinpb desc"; 
	$CAPTION = "HOME CALLS";
	$bg = " bgcolor='#f4f4f4' ";
 
  elseif($_GET['MPRED']=="AW"):
    $query1 = "SELECT f.*,date_format(f.match_date,'%d-%b-%y') as mdate2 from fixtures f where f.weekno='$weekno' and f.season='$season' and f.hgoal<f.agoal ";
    $orderby = " ORDER BY awinpb desc"; 
	$CAPTION = "AWAY CALLS";
	$bg = " bgcolor='#f4f4f4' ";
  
  else:
     $query1 = "SELECT f.*,date_format(match_date,'%d-%b-%y') as mdate2, r.gpr_av from fixtures f, cur_reb r where f.weekno='$weekno' and f.season='$season' and f.hgoal=f.agoal  and f.mid=r.matchno and f.weekno=r.weekno and f.season=r.season ";
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
  
 switch ($_GET['DIV']){
		case '-1': $divs = " "; break;
		case '0': $divs = " and f.`div` IN ('EP','SP','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
		case '1': $divs = " and f.`div` IN ('EP','C0','C1','C2','SP','S1','S2','S3','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
		case '2': $divs = " and f.`div` IN ('NC', 'UP', 'RP', 'MP') "; break;
		default: $divs = " and f.`div` = '" . $_GET['DIV'] . "' "; break;
}
	
  $query1 .=   $divs . $period . $orderby ;
  //$result = mysql_query($query1) or die(" $query1 --" .  mysql_error() ); 

  
  //echo $query1;
  
if (isset($_GET['db'])){
  $page_title = "Match Probabilities " . s_title($db) . " Season $season Week $weekno";
}else{
  $page_title = "Match Probabilities";
}


$pageURL = "?PARA=$weekno";

require_once("header.ini.php");
 $page_title = "Match Probabilities ";
?>


<? page_header($page_title); ?>
<div style="padding-bottom:5px"></div>



<?php if (isset($_GET['db'])){ 

 if (strlen($errlog)>0):
		echo "<div class='errordiv'>$errlog</div>";
 endif;    
    
?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?php echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?php echo site_other($db);?></div>
<div class='clear'></div>

<table  width="100%" align="center">
<tr>
	<td><?php echo back();?></td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"> <?php echo printscr(); ?></td>
</tr>
</table>
<br />
<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:0 auto 10px auto;" bordercolor="#f4f4f4" width="560">
	  <form method="get" action="soccer-win-probability-data.php">
        <input type="hidden" name="db" value="<?php echo $_GET['db'];?>"/>
		<tr bgcolor="#f4f4f4">
		<td width="100" ><b><font size="2" color="#0000FF">Season</font></b></td>
        <td width="70" ><b><font size="2" color="#0000FF">Week No</font></b></td>
        <td width="80" ><b><font size="2" color="#0000FF">Bet Type</font></b></td>
       
        <td width="50" rowspan="4" class='ctd'><input type="submit" value="View Data" name="B1" class="bt" style="padding:8px;padding-top:4px;"/></td>
        
        </tr>
        
        <tr bgcolor="#f4f4f4">
		  <td>

		 <select size="1" name="season" class="text">
		  <?php
		   
			  $sqry = "SELECT distinct(season) as season from cur_reb order by season desc" ;
			  if ($db=='eu'){
                   $temp = $eu->prepare($sqry) ;
              }else{
                   $temp = $sa->prepare($sqry);
              }
              $temp->execute();
              
             while ($sr = $temp->fetch()) : 
		  ?>
		      <option value="<?php echo  $sr["season"] ?>" <?php echo selected($_GET['season'],$sr["season"])?>><?php echo  $sr["season"] ?></option>
		  
		  <?php endwhile; ?>
		  </select>
		</td>
	
		  
		  <td>
		  <select size="1" name="weekno" class="text" >

		  <?php for($i=47; $i>=1; $i--) : ?>
			  <option value="<?php echo  $i;?>" <?php if($i==$cur): echo " selected"; endif;?>>&nbsp;<?php echo  $i;?>&nbsp;&nbsp;&nbsp;</option>
		  <?php endfor;?>		 

		  </select>
		  </td>
		  
		 
		  <td>
		  <select size="1" name="MPRED" class="text">
		  <option value="HW" <?php echo selected($_GET['MPRED'],'HW')?>>Home Calls</option> 
		  <option value="AD" <?php echo selected($_GET['MPRED'],'AD')?>>Draw Calls</option> 
		  <option value="AW" <?php echo selected($_GET['MPRED'],'AW')?>>Away Calls</option> 
		  
		  </select>
		  </td>
		 
    		
		 </tr>
		 <tr>
			 <td width="80" colspan='2' ><b><font size="2" color="#0000FF">Divisions</font></b></td>
			 <td  width="100" ><b><font size="2" color="#0000FF">Period</font></b></td>
		 </tr>
		 <tr>
			<td colspan='2'>
				 <select size="1" name="DIV" class="text" style="width:200px;">

             <?php if ($db=='eu'){ ?>
             
             		<option value="0" <?php echo selected($_GET['DIV'],'0')?>>UK/European Premier Divisions</option> 
                    <option value="1" <?php echo selected($_GET['DIV'],'1')?>>UK/European Major Divisions</option> 
                    <option value="2" <?php echo selected($_GET['DIV'],'2')?>>UK Minor Divisions</option> 
                    <option value="-1" <?php echo selected($_GET['DIV'],'-1')?>>All-In List of Matches</option> 
                    
    			<?php for($_i=0; $_i<count($arry_div); $_i++){ ?>
    			   <?php if ($_i<>4 and $_i<>9 and $_i<>18){ ?>
    					<option value="<?php echo $arry_div[$_i];?>" <?php echo selected($_GET['DIV'], $arry_div[$_i]);?>><?php echo divname($arry_div[$_i]); ?></option>
    			   <?php } ?>
    			<?php } ?>
             <?php } ?>

             <?php if ($db=='sa'){ ?>
    		    <option value="0" <?php echo selected($_GET['DIV'],'0')?>>All Divisions</option> 
    			<?php for($_i=0; $_i<count($arry_div_sa); $_i++){ ?>
    				<option value="<?php echo $arry_div_sa[$_i];?>" <?php echo selected($_GET['DIV'], $arry_div_sa[$_i]);?>><?php echo divname($arry_div_sa[$_i]); ?></option>
    			<?php } ?>
             <?php } ?>

			</select>

			</td>
			
			<td >
			 <select size="1" name="PERIOD" class="text" style="width:150px;">
    		   <option value="1" <?php echo selected($_GET['PERIOD'],'1')?>>Full Week (Mon - Sun)</option> 
               <option value="2" <?php echo selected($_GET['PERIOD'],'2')?>>Weekend (Sat - Sun)</option>
               <option value="3" <?php echo selected($_GET['PERIOD'],'3')?>>Midweek (Mon - Fri)</option>
    		  </select>
			</td>
			
			
		 </tr>
         </form>
	  </table>

<?php }else{ 
    
    require_once("select-option.ini.php");
    
} ?>


<?php if ($_GET['B1']=='View Data') { ?>


  <!-- startprint -->
<div style="padding-bottom:5px"></div>
   
<?php week_box_new($CAPTION . "<br><font size='1' color='#000000'>$_prerid</font>", $weekno, $wdate, $_GET['season'],'560') ?>
   




<div style='text-align:center;padding:8px;font-size:12px;font-family:verdana;'>
The following shows the Probabilities up to <BR>the end of the previous week (until midnight on Sunday).
</div>

 



<table cellpadding='2' border="1" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="560" bgcolor="#F6F6F6">
<tr bgcolor="#D3EBAB">
	  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>
	  <td width="10%" class='ctd' rowspan="2">
	  <?php if($season==curseason($db)){ ?>
	   <img src="images/tbcap/datepic.gif"  border="0" alt=""/>
    <?php }else{ ?>     
      <img src="images/tbcap/date.gif"  border="0" alt=""/>
    <?php } ?> 
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
    <td class="ctd" <?php echo ($_GET['MPRED']=='HW'? "bgcolor='#D3EBAB'": "");?>><?php echo ($row["hwinpb"]); ?></td>
    <td class="ctd" <?php echo ($_GET['MPRED']=='AD'? "": "");?>><?php echo ($row["drawpb"]); ?></td>
    <td class="ctd" <?php echo ($_GET['MPRED']=='AW'? "bgcolor='#D3EBAB'": "");?>><?php echo ($row["awinpb"]); ?></td>
    <?php echo $odd;?>

</tr>

<?php }
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
<font size="1" color="blue"><b>Avg Rels</font></b> = <font color='black'>Average Reliabilities</font> <br />
<font size="1" color="blue"><b><i>Italicised score-line</i></font></b> = <font color='black'>relegated and/or promoted teams playing</font><br>


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
