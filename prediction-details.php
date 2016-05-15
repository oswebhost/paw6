<?php

session_start();
require_once("config.ini.php");
require_once("function.ini.php");



$parts = explode(",",$_GET['PARA']);
$DIV   = $parts[0];
$weekno= $parts[1];
$db    = $_GET['site'];

$errlog = "";


$page_title= $Mtype . " :: Predict-a-Win for UK Football";

$sea = curseason($db);

$last_season = last_season_value($sea,$db);


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

if (!isset($_SESSION['userid'])){ 
	$errlog = limited_asscess_message($db);
}


$page_title = "Soccer Predictions " .  divname($DIV) . " " . curseason($db) . " Week $weekno "  ;

require_once("header.ini.php");
$page_title="Fixture List";

page_header("1X2 Predictions") ; 




if (strlen($errlog)>0):
		echo "<div class='errordiv'>$errlog</div>";
endif;




?>


<div style="padding-bottom:2px"></div>

<table border="0" width="100%" cellpadding="0" cellspacing="0">
 <tr>
    <td width="10%"> <?php echo back(); ?> </td>

   <td width="80%" height="20" class='ctd' colspan='3' valign="bottom">
		<form method='get' style='padding:0;margin:0;'>
            <input type="hidden" name="site" value="<?php echo $db;?>"/>	
            
			<B>Week No: </B><select size="1" name="PARA" class="text" onChange="this.form.submit();">
	   <?php 
			 $br=0;
			 
			 for ($other=cur_week($db); $other>=1; $other--) :
				$br++;
				echo "<option value='$DIV,$other'" ;
					if ($other==$weekno): echo " selected"; endif;
				echo ">$other</option>\n\n";
			 endfor;
			 echo "</select>";	

	   ?>
       </form>
	 </td>
	 <td width="10%" class='rtd'> <?php echo printscr(); ?></td>
	</tr>
 </table>


<div style="padding-bottom:5px"></div>

  <!-- startprint -->
  
<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;"><?php echo site($db);?></div> 
 <?php  week_box_new(divname($DIV), $weekno, $wdate, $season,570) ;?>
 

<div style="padding-bottom:5px"></div>



<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD"  width="570" bgcolor="#F6F6F6">
<tr bgcolor="#D3EBAB">

    <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>
    <?php if ( ($DIV=='FA') or ($DIV=='SA') or ($DIV=='IN')) : ?>
       <td width="80" class='ctd' rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/></td>
     <?php else: ?>
    	 <td width="10%" class='ctd' rowspan="2"><img src="images/tbcap/datepic.gif" border="0" alt=""/></td>
     <?php endif; ?>
    <td width="30%" class='ctd' rowspan="2"><img src="images/tbcap/fixture.gif"  border="0" alt=""/></td>
    <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
    <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
    <td width="24%" class='ctd' colspan="4"><img src="images/tbcap/odd.gif"  border='0' alt=""/></td>
</tr>

<tr bgcolor="#d3ebab">
    <td width="8%" class='ctd'><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
    <td width="8%" class='ctd'><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
    <td width="8%" class='ctd'><img src="images/tbcap/a.gif"  border='0' alt=""/></td>
    <td width="8%" class='ctd'><img src="images/tbcap/cs.gif"  border="0" alt=""/></td>
</tr>

<?php  

$qry = "SELECT * FROM fixtures WHERE `div`='$DIV' AND weekno='$weekno' and season='$sea'  ORDER BY match_date,hteam,ateam";





if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}

   $temp->execute();

    if ($temp->rowCount()==0){
       echo "<tr><td colspan='9' class='ctd' style='padding:30px;'><span class='error'>No Matches This Week</span></td></tr>";
    }else {
        
    $pic = "/pic/" ;
    $pic =  $weekno ."/pic";
    $number=0;
    $ngot =0 ;
    $css = 0;
    while ($row = $temp->fetch()) {
        
        $number++;
        $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;

	    $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$sea,$db)){
            $pr = " pr2";
        }

			  
					          
        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&db=$db')\">";
        $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?db='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
        
        $title = "$row[hteam] v $row[ateam] match odds" ;
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
<tr <?php echo rowcol($number);?>>

    <td class="ctd padd"><?php echo $number; ?></td>
    <td class="ctd "><a class='md2' <?php echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?php echo $matchno;?>&site=<?php echo $db;?>'><?php echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

     <td class='padd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?php echo $row['hteam']?>&site=<?php echo $db;?>">
        <?php echo $row['hteam'] .'</a>' . printv(' v '); ?>
        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?php echo $row['ateam']?>&site=<?php echo $db;?>">
            <?php echo $row['ateam'];?></a>
     </td>
     
    
    <td class="ctd <?php echo $asl_class  .  $pr;?>"><?php echo $row['hgoal'] . dash() . $row['agoal'];?></td>
    <td class="ctd <?php echo $asl_class ;?>"><?php echo $row['h_s'] . dash() . $row['a_s']; ?></td>
    <td class="ctd"><?php echo show_odd($row["h_odd"]); ?></td>
    <td class="ctd"><?php echo show_odd($row["d_odd"]); ?></td>
    <td class="ctd"><?php echo show_odd($row["a_odd"]); ?></td>
    <td class="ctd"><a title='<?php echo $title?>' href="javascript:tell('full_odds.php?id=<?php echo $matchno?>&db=<?php echo $db?>')" class='sbar'><?php echo show_odd($row["asl_odd"])?></a></td>

</tr>

<?php    }
    }  


 if ($temp->rowCount()>0){
?>
  
 
  
 <tr bgcolor="#f4f4f4">
    <td colspan="4" class="rtd padd credit">Total Correct Calls</td>
    <td class="ctd padd credit"><?php echo $ngot; ?></td>
    <td colspan="4"></td>
  </tr> 
 <tr bgcolor="#f4f4f4">
    <td colspan="4" class="rtd padd credit">Total Correct Score Hits</td>
    <td class="ctd padd credit"><?php echo $css; ?></td>
    <td colspan="4"></td>
  </tr> 
<?php } ?>
</table>



<!-- stopprint -->

<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:158px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?php echo $fff ?>
</td>

<td style="font-weight:normal;text-align:center;padding-top:5px;">
	<b>ASL</b>&nbsp;=&nbsp;</font><font size="1">Anticipated Score-Line&nbsp;&nbsp;
	<font color="blue"><b>Act Res</b></font>&nbsp;=&nbsp;Actual Result
	<br/>
	*  Click on "Date/Time & PIC" to view PIC and associated backup data<br/>
	** Click on Team name to view "Results to Date"

	<?php if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
    <td style="width:86px;background:url('images/bbsm-right.gif') no-repeat right ;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:4px;;">
        Click here<br /> to view<br />all Odds
   </td>
</tr>
</table>

<div style="padding-bottom:5px">&nbsp;</div>
		

<?php $wk = max_tab_week($sea) ;  $t_url = "$DIV,$weekno,$sea,$last_season"; 

   


 if ($DIV<>'FA' and $DIV<>'SA' and $DIV<>'IN'){ 
    
 
?>


<table border='0' cellpadding='2' cellspacing='0' style='border:1px solid blue;' width='98%' style="border-collapse: collapse"> 
	<tr>
		<td  style='text-align:center;padding:5px;border-bottom:1px solid blue;'  bgcolor="#f4f4f4">
			<font class='credit'>League Standings</font>
		</td>
	</tr>
	<tr>
		<td width='100%' style='padding-top:10px;'>

		<ul id="countrytabs" class="shadetabs" style='margin:0px;padding:0;margin-left:14px;'>
			<li><a href="#" rel="#default" class="selected">Overall</a></li>
			<li><a href="ltable-rank-home.php?t_url=<?=$t_url;?>" rel="countrycontainer">Home</a></li>
			<li><a href="ltable-rank-away.php?t_url=<?=$t_url;?>" rel="countrycontainer">Away</a></li>
	   </ul>

	<div id="countrydivcontainer" style="border:0px solid gray;border-bottom:0; width:530px;margin: auto auto; padding: 0px;margin-top:3px;padding-left:2px">
        <?php require_once("ltable-rank.php"); ?>
	</div>
    
		
		</td>
	</tr>
	

</table>

<script type="text/javascript">
	var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
	countries.setpersist(false)
	countries.setselectedClassTarget("link") //"link" or "linkparent"
	countries.init()
</script>

<?php } ?>


<?php require_once("footer.ini.php"); ?>


<?php	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>
