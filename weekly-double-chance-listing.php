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
 
if (!isset($weekno)) $weekno = $lastweek ;
    
$errlog = "";


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
	$page_title = "Double Chance Odds " . curseason($db)  . " Week $weekno " ;
else:
	$page_title = "Double Chance Odds " . curseason($db) ;
endif;

?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd"> 


<html>

<head>

<link rel="shortcut icon" href="images/betware.ico"/>
<meta http-equiv="Content-Language" content="en-us"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
<meta name="title" content="Soccer Predictions"/>
<link rel="stylesheet" type="text/css" href="css/style_v4.css" MEDIA="screen"/>

<title>Double Chance Odds All Divisions Combined</title>

<script language="JavaScript" type="text/javascript">
	function tell(url)
	{
	
		window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=710,height=520");
	}

	function OrWin(url)
	{
	
		window.open(url,"","toolbar=no,location=no,left=300,top=200,directories=no,status=no,menubar=no,resizable=no,scrollbars=yes,width=500,height=400");
	}

</script>

</head>
<body>

<?php

page_header("Prediction Performance Records") ;

require_once("overround-class.php");






?>



<div class="report_blue_heading" style="width: 98%;height:32px;margin:0 auto 5px auto;">
	<?php echo  site($db);?> <br />	
	Double Chance Odds All Divisions Combined
	
</div>



<div style="padding-bottom:2px"></div>



<div style="padding-bottom:2px"></div>    
<table  width="100%" border='0'>
<tr>
<td width='20%'>  </td>
<td width='70%' class='ctd'>
	</td>
	<td width='10%'align="right" style='padding-right:10px;'> <?php echo  printscr(); ?></td>
</tr>
</table>

<div style="padding-bottom:10px"></div>

  <!-- startprint -->
<?php if(isset($weekno) ): 

week_box_nocap($weekno, $wdate,$season,"98%");


?>


             
<div style="padding-bottom:10px;margin:auto auto; width:560px;"></div>

<?php over_round_msg();?>

<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="98%" cellpadding='3' bgcolor="#f6f6f6">
<tr bgcolor="#d3ebab">

  <td width="5%" class='ctd'><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>

  <?php if( ($DIV=='FA') or ($DIV=='SA') or ($DIV=='IN')) : ?>
	   <td width="80" class='ctd'><img src="images/tbcap/date.gif" border="0" alt=""/>
  <?php else: ?>
		 <td width="10%" class='ctd'><img src="images/tbcap/date.gif" border="0" alt=""/>
  <?php endif; ?>
  </td>
  <td class='ctd'><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
  <td class='ctd' ><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/1xnew.gif"  border='0' alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/2xnew.gif"  border='0' alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/12new.gif"  border='0' alt=""/></td>
  <td width="6%" class='ctd'><img src="images/tbcap/overround.gif"  border="0" alt=""/></td>
<?php if ($weekno<>cur_week($db)){ ?>
  <td width="6%" class='ctd'><img src="images/tbcap/dccall.gif"  border="0" alt=""/></td>
<?php }else{ ?>
  <td width="6%" class='ctd'><img src="images/tbcap/htw-prob.gif"  border="0" alt=""/></td>
<?php } ?>
<td width="6%" class='ctd'><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>

<?php if($row['weekno'] < cur_week($db)){ ?>

	<td width="8%" class='ctd'><img src="images/tbcap/act.gif"  border="0" alt=""/></td></td>

<?php }else{ ?>

	<td width="8%" class='ctd'><img src="images/tbcap/more.gif"  border="0" alt=""/	></td></td>

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

    switch ($_GET['CALL'])
      { 
            case 1: $call = " and f.hgoal>f.agoal "; $row3cap = "Home Win Calls"; break;
            case 2: $call = " and f.agoal>f.hgoal "; $row3cap = "Away Win Calls"; break;
            case 3: $call = " and f.hgoal=f.agoal "; $row3cap = "Draw Calls";     break;
            case 4: $call = " "; $row3cap = "All Call Types"; break;
      }

	
	
    switch($_GET['ordered'])
      {
        case 1: $ordered = " asc"; break;
        case 2: $ordered = " desc"; break;
      }
    
    switch ($_GET['SORTBY'])
      {
             
    
        case 10: $ordered_by = " ORDER BY o.hw_x "; break;
        case 11: $ordered_by = " ORDER BY o.aw_x "; break;
        case 12: $ordered_by = " ORDER BY o.hw_aw "; break;
    
        case 13: $ordered_by = " ORDER BY goalsum $ordered, f.hgoal "; break;
        case 14: $ordered_by = " ORDER BY goaldif "; break;
      }
          
	 $filter='';

    if ($_GET['min_odd']>0 and $_GET['max_odd']>0){
      switch ($_GET['CALL'])
      { 
        case 1: $filter = " and o.hw_x between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
        case 2: $filter = " and o.aw_x between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
        case 3: $filter = " and o.hw_aw between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
      }
    
    }
    
	

	$query1 = "SELECT date_format(f.match_date,'%d-%b-%Y') as m_date, (f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum, f.hgoal, f.agoal, 
	  f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd, f.weekno, f.mid, 
	   o.hw_x, o.aw_x, o.hw_aw, f.`div`, f.hteam,f.ateam,  f.mdate, f.match_time, r.rank 
	    FROM fixtures f, ranking r, other_odds o WHERE 
			f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and 
			 f.weekno=o.weekno and f.season=o.season and f.mid = o.matchno 
			 	and o.hw_x>0 $period $call  $_divs $filter $ordered_by $ordered, f.match_date, 
			 	  f.match_time, f.hteam,f.ateam";
  




				
	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}

    $temp->execute();

    $number = 0; $css=0; $dcc=0; $tdc =0; $postponed=0;
 
  if ($temp->rowCount()>0){
    
    while ($row = $temp->fetch()) {

    	$number++;
	    $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $tdc ++;
        
        $dccalls = double_call($row['h_s'], $row['a_s'], $row['hgoal'], $row['agoal']);
        $dcc += $dccalls;
        $char = dc_char($row['h_s'], $row['a_s'], $row['hgoal'], $row['agoal']);

        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&site=$db')\">";
        $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?site='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
        
        $title = "$row[hteam] v $row[ateam] match odds" ;
        $odd=0;
    // find over-round [overround-class.php]
        $or = new overround();
        $or->find_or($row['h_odd'], $row['d_odd'], $row['a_odd'], $row['hwinpb'],$row['drawpb'],$row['awinpb']);
        $asl_class ="";
  
        $asl_class ="";
       
 		    $sbar = "sbar";

         

        if ($char=='Y'){
          $asl_class = " gotrtblue"; 
          $sbar = "sbar";
        }else{
          $asl_class = " wrong";
          $sbar= "sWrg";
        }

        if ($asl==$act){
            $asl_class = " gotaslblue";
            	$sbar = 'sbar2';
            $css++;
        }
        
        if ($row['h_s']=='P'){
            $asl_class = " pp";
            $sbar= "sWrg";
            $postponed++;
        }
        
        $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$season,$db)){
            $pr = " pr2";
        }

       
        $overround=0;
		    $overround = ( ((1/($row["hw_x"]>0?$row["hw_x"]:1)) + (1/($row["aw_x"]>0?$row["aw_x"]:1)) + (1/($row["hw_aw"]>0?$row["hw_aw"]:1)) - 2) * 100)/2 ; 

          //over founds
        $hor = ($or->home_value==1? " h_Or" : "");
        $aor = ($or->away_value==1? " a_Or" : "");

       
        if ($char=="N/A"){
          $asl_class = "  wrong";
          $tdc --;
        }
        
        if ($tdc==0){ $tdc=1;}
?>

	<tr <?php echo rowcol($number);?>>
		<td class="ctd padd"><?php echo  $number; ?></td>
	    <td class="ctd "><?php echo  $row['m_date'] ; ?></td>

	    <td class='padd ltd'><?php echo  $row['hteam']. printv(' v '). $row['ateam'];?> </td>
		
		<td class='ctd'><?php echo $row['div'];?></td>
		<td class='ctd <?php echo $hor;?>'><?php echo show_odd($row['hw_x']);?></td>
		<td class='ctd <?php echo $aor;?>'><?php echo show_odd($row['aw_x']);?></td>
		<td class='ctd'><?php echo show_odd($row['hw_aw']);?></td>
		<td class='ctd'><a title='Over Round Details' class='sbar' href="javascript:OrWin('overround.php?db=<?php echo $db;?>&id=<?php echo $matchno;?>&season=<?php echo $season;?>')"><?php echo num20($overround);?>%</a></td>
		
    <?php if ($weekno<>cur_week($db)){ ?>
         <td class="ctd <?php echo  $asl_class . $pr;?>"><?php echo $char; ?></td>
    <?php }else{ ?>
        <td class='ctd'><?php echo num2($row['hwinpb']);?></td>
    <?php } ?>

    
		
    <td class="ctd <?php echo  $asl_class . $pr;?>"><?php echo  $row['hgoal'] . dash() . $row['agoal'];?></td>

    	<td class="ctd <?php echo  $asl_class . $pr;?>">
    		<a class='<?php echo  $sbar;?>' href="javascript:tell('full_odds.php?id=<?php echo  $matchno;?>&db=<?php echo  $db;?>&season=<?php echo $season;?>')">
    			<?php if(strlen($act)<2){
    				echo "Odds";
    			}else{
    				echo $row['h_s'] . dash() . $row['a_s']; 
    			}	
    			?>
    		</a>
    	</td>
		
	</tr>

<?php }

if ($temp->rowCount()>0 and $weekno<>cur_week($db) ){
?>

 <tr bgcolor="#f4f4f4">
    <td colspan="3" class="rtd padd bot">Postponed Matches&nbsp;</td>
    <td colspan="1" class="ctd padd bot"><?php echo  $postponed; ?></td>
    <td colspan="6" class="rtd padd bot">Total "Double Chance" Correct Calls&nbsp;</td>
    <td colspan="1" class="ctd padd bot"><?php echo  $dcc; ?></td>
  </tr> 

 <tr bgcolor="#f4f4f4">
    <td colspan="10" class="rtd padd bot">Total "Double Chance" Calls&nbsp;</td>
    <td colspan="1" class="ctd padd bot"><?php echo  $tdc; ?></td>
 
  </tr> 
 <tr bgcolor="#f4f4f4">
    <td colspan="9" class="rtd padd bot">Percentage Correct&nbsp;</td>
    <td colspan="2" class="ctd padd bot"><?php echo  num2( ($dcc/$tdc) *100); ?>%</td>
   
  </tr> 

<?php } ?>

<?php }else{ ?>

    <tr>
        <td colspan="11" class="credit ctd padd" style="color:red;padding:10px;">No Match for selected options</td>
    </tr>

<?php } ?>




</table>


<!-- stopprint -->

			   
			   
			   
			   



<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>

<td style="font-weight:normal;text-align:left;padding-top:8px;padding-left:20px;font-size:11px;vertical-align:top;">
    <B>ASL = </B>Our Anticipated Score-Line <br/>
      ASL Determines the Call (1/X or 2/X) <br/>
    <b>N/A =</b> PaW Call was a Draw
	
	
	
	<?php if($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
    <td style="width:90px;background:url('images/bbsm-right.gif') no-repeat right ;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:4px;;">
        Click here<br /> to view<br />all Odds
   </td>
</tr>
</table>
<br>


<?php endif;?>


	<div style="margin:15px;padding:8px;border:1px solid #ccc;font-size:13px;color:#0000ff;background:#f4f4f4;text-align:center;">
		<a class='sbar' href='javascript:window.close();'>Close Window</a>
	</div>

		


<?php
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>
