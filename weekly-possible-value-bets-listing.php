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

if (isset($_GET['calltype'])){
	$calltype = $_GET['calltype'];
}else{
	$calltype = 1;
}


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
	$page_title = "Specific Call Type Over-Rounds - All Matches Combined " . divname($div_value) . " " . curseason()  . " Week $weekno " ;
else:
	$page_title = "Specific Call Type Over-Rounds - All Matches Combined " . curseason() ;
endif;
$tmpData = uniqid('tmp_');

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

<title>Possible Values Calls</title>

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

include("overround-class.php");



?>
<div class="report_blue_heading" style="width: 98%;height:32px;margin:0 auto 5px auto;">
	<?echo site($db);?> <br />	
	possbile value calls
	
</div>





<div style="padding-bottom:2px"></div>    
<table  width="100%" border='0'>
<tr>
<td width='20%'>  </td>
<td width='70%' class='ctd'>
	</td>
	<td width='10%'align="right" style='padding-right:10px;'> <? echo printscr(); ?></td>
</tr>
</table>


  <!-- startprint -->
<?  

week_box_nocap($weekno, $wdate,$season,"98%");


?>


             
<div style="padding-bottom:10px"></div>



<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="98%" cellpadding='3' bgcolor="#f6f6f6">
<tr bgcolor="#d3ebab">

  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>

  <? if ( ($DIV=='FA') or ($DIV=='SA') or ($DIV=='IN')) : ?>
	   <td width="80" class='ctd' rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/>
  <? else: ?>
		 <td width="10%" class='ctd'rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/>
  <? endif; ?>
  </td>
  <td width="38%" class='ctd' rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
  <td class='ctd' rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>

  <?php if ($weekno == cur_week($db)){ ?>
  		<td width="24%" class='ctd' colspan="3"><img src="images/tbcap/ods.gif"  border='0' alt=""/></td>
  <?php }else{ ?>
  		<td class='ctd' rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td>
  		<td width="24%" class='ctd' colspan="2"><img src="images/tbcap/ods.gif"  border='0' alt=""/></td>
  <?php } ?>		

  <td width="24%" class='ctd' colspan="4"><img src="images/tbcap/over2.gif"  border='0' alt=""/></td>
</tr>

<tr bgcolor="#d3ebab">
	<td width="8%" class='ctd'><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
	
	<?php if ($weekno == cur_week($db)){ ?>
		<td width="8%" class='ctd'><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
	<?php } ?>

	<td width="8%" class='ctd'><img src="images/tbcap/a.gif"  border='0' alt=""/></td>

	<td width="8%" class='ctd'><img src="images/tbcap/m.gif"  border='0' alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/a.gif"  border='0' alt=""/></td>
</tr>



<?
 	$period = "";
	$_sortby = "h_odd"; 
	$_ordered = " "; 
	$_call = " and f.hgoal > f.agoal";
	$value = " hwinpb >= 50.00 and hover <= 5.00" ;

	switch ($_GET['formatch'])
	{
	    case 1: $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
	    case 2: $period = " and weekday(match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
	    case 3: $period = " and weekday(match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;
	}
	


	switch ($_GET['sortby'])
	{
	    case 1: $_sortby = "hover"; break;
	    case 2: $_sortby = "dover"; break;
	    case 3: $_sortby = "aover"; break;
	    case 4: $_sortby = "overround"; break;
        case 5: $_sortby = "h_odd"; break;
        case 6: $_sortby = "a_odd"; break;
	}

	switch ($_GET['ordered'])
	{
	    case 1: $_ordered = " "; break;
	    case 2: $_ordered = " desc "; break;
	}
	
	
	switch ($calltype)
	{
	    case 1: $_call = " and f.hgoal > f.agoal";  $value = " hwinpb >= 50.00 and hover <= 5.00" ; break;
	    case 2: $_call = " and f.agoal > f.hgoal";  $value = " awinpb >= 50.00 and aover <= 5.00" ; break;
	}

    $query1 = "create TEMPORARY TABLE $tmpData as (SELECT date_format(f.match_date,'%d-%b-%Y') as m_date, f.hgoal, f.agoal, f.gotit, f.mvalue, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb, f.weekno, f.mid,
     f.h_odd, f.d_odd, f.a_odd, f.h_odd as bookie_real_home, f.d_odd as bookie_real_draw, f.a_odd as bookie_real_away,
     f.h_odd as overround,f.h_odd as odd_sum, f.h_odd as hover, f.h_odd as dover, f.h_odd as aover, f.`div`, f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r WHERE 
    f.weekno='$weekno'  and f.season='$season' and f.`div`=r.matchtype and cat='fixt' and
     f.h_odd>0 $period $_call ORDER BY f.h_odd, f.match_date, f.match_time, f.hteam,f.ateam)";


	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();


    $odd_sum = 1 ;
	
	
 
	//Match Overround
    $query1 = "update $tmpData set overround = ((1/h_odd) + (1/d_odd) + (1/a_odd) -1) *100, odd_sum=((1/h_odd)*100) + ((1/d_odd)*100) + ((1/a_odd)*100)";
    if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();

    // step one for Call type Over round.
	$query1 = "update $tmpData set bookie_real_home = (((1/h_odd)*100)/ odd_sum) * 100, 
								  bookie_real_away = (((1/a_odd)*100)/ odd_sum) * 100,
								  bookie_real_draw = (((1/d_odd)*100)/ odd_sum) * 100";
    if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();

    // step two for Call type Over round.
	$query1 = "update $tmpData set hover = ((bookie_real_home-hwinpb)/bookie_real_home) * 100, 
								  aover = ((bookie_real_away-awinpb)/bookie_real_away) * 100,
								  dover = ((bookie_real_draw-drawpb)/bookie_real_draw) * 100";
    
    if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();
      
	// final selection for Listing data ....
	$query1 = "select * from $tmpData where $value order by $_sortby $_ordered";
	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();

     

    $number = 0;
    $ngot = 0;
    $css = 0;
    $dcc = 0;
    $ppp = 0;

    while ($row = $temp->fetch()) {

    	$number++;
	    $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;
        
        $dcc += $row['gotit'];

        
         // find over-round [overround-class.php]
        $or = new overround();
        $or->find_or($row['h_odd'], $row['d_odd'], $row['a_odd'], $row['hwinpb'],$row['drawpb'],$row['awinpb']);

        
        
        $title = "$row[hteam] v $row[ateam] match odds" ;
        $odd=0;
         
  
        $asl_class ="";
       
 		$sbar = "sbar";

        if ($row['gotit']=='1' and $row['h_s']<>'P'){
            $asl_class = " gotrtblue";
        }elseif ($row['gotit']=='0' and $row['h_s']<>'P'){
        	$asl_class = " wrong";
        	$sbar= "sWrg";
        }

        if (strlen($act)<2){
        	$asl_class='';
        	$sbar = 'sbar';
        }
        
        if ($asl==$act){
            $asl_class = " gotaslblue";
            $css ++;
        }
        
        if ($row['h_s']=='P'){
            $asl_class = " pp";
            $ppp++;
        }
        
      

          //over founds
        $hor = ($or->home_value==1? " h_Or" : "");
        $aor = ($or->away_value==1? " a_Or" : "");

        // double changes
        if ($row['mvalue']=='1'){
          if ( ($calltype==1) and ($row['h_s']==$row['a_s']) ) {
          	$dcc ++;
          }
          if ( ($calltype==2) and ($row['h_s']==$row['a_s']) ) {
          	$dcc ++;
          }
        }     
         
        $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$_GET['season'],$db)){
            $pr = " pr2";
        }    
?>

	<tr <?php echo rowcol($number);?>>
		<td class="ctd padd"><?echo $number; ?></td>
	    <td class="ctd "><?echo $row['m_date'] ; ?></td>

	    <td class='padd ltd'><?echo $row['hteam'] . printv(' v ') . $row['ateam'];?> </td>
	    
		<td class='ctd <?php echo $pr . $asl_class;?>'><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
		
		<?php if ($weekno <> cur_week($db)){ ?>
			<td class='ctd <?echo $asl_class;?>'><?echo $row['h_s'] . dash() . $row['a_s'];?></td>
		<?php }?>
	
		<td class='ctd <?php echo $hor;?> <?echo ($_sortby=='h_odd'? "bgcolor='#D3EBAB'": "");?>'><a class='<?echo $sbar;?>' href="javascript:tell('full_odds.php?id=<?echo $matchno;?>&db=<?echo $db;?>&season=<?echo $season;?>')"><?php echo show_odd($row['h_odd']);?></a></td>
		
		<?php if ($weekno == cur_week($db)){ ?>	
				<td class='ctd' ><?php echo show_odd($row['d_odd']);?></td>
		<?php } ?>

		<td class='ctd <?php echo $aor;?> <?echo ($_sortby=='a_odd'? "bgcolor='#D3EBAB'": "");?>'><a class='<?echo $sbar;?>' href="javascript:tell('full_odds.php?id=<?echo $matchno;?>&db=<?echo $db;?>&season=<?echo $season;?>')"><?php echo show_odd($row['a_odd']);?></a></td>
		<td class='ctd' <?echo ($_sortby=='overround'? "bgcolor='#D3EBAB'": "");?>><a title='Over Round Details' class='sbar' href="javascript:OrWin('overround.php?db=<?php echo $db;?>&id=<?php echo $matchno;?>&season=<?echo $season;?>')"><?php echo num20($or->match_or);?>%</a></td>
		<td class='ctd' <?echo ($_sortby=='hover'? "bgcolor='#D3EBAB'": "");?>><?php echo num20($row['hover']);?></td>
		<td class="ctd" <?echo ($_sortby=='dover'? "bgcolor='#D3EBAB'": "");?>><?php echo num20($row['dover']);?></td>
		<td class="ctd" <?echo ($_sortby=='aover'? "bgcolor='#D3EBAB'": "");?>><?php echo num20($row['aover']);?></td>
		
	</tr>

<?}

  if ($temp->rowCount()==0){

  	echo "<tr><td colspan='11' class='ctd' style='padding:40px 0'><span class='error'>No matches qualify as \"Possible Value Calls\" this week.</span></td></tr>";
  }



?>


<?php if ($weekno <> cur_week($db)){ ?>	
   <tr bgcolor="#f4f4f4">                  
    <td colspan="3" class="rtd padd bot">Total Double Chance Hits</td>
    <td colspan="2" class="ctd padd bot"><?echo $dcc; ?></td>
    <td colspan="6"></td>
  </tr> 

  <tr bgcolor="#f4f4f4">
    <td colspan="3" class="rtd padd bot">Total Correct Calls</td>
    <td colspan="2" class="ctd padd bot"><?echo $ngot; ?></td>
    <td colspan="6"></td>
  </tr> 
 <tr bgcolor="#f4f4f4">
    <td colspan="3" class="rtd padd bot">Total Correct Score Hits</td>
    <td colspan="2" class="ctd padd bot"><?echo $css; ?></td>
    <td colspan="6"></td>
  </tr> 
 <tr bgcolor="#f4f4f4">
    <td colspan="3" class="rtd padd bot">Postponed/Void Matches</td>
    <td colspan="2" class="ctd padd bot"><?echo $ppp; ?></td>
    <td colspan="6"></td>
  </tr> 
<?php } ?>

</table>


<!-- stopprint -->

<?php
	// drop temp table 
	$query1 = "drop TEMPORARY table $tmpData";
	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}
    $temp->execute();	


?>			   
			   
			   
			   



<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>

<td style="font-weight:normal;text-align:center;padding-top:5px;">

	<B>ASL</B>&nbsp;=&nbsp;</FONT><font size="1">Our Anticipated Score-Line&nbsp;&nbsp;
	
	<BR>
	
	<? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>

</tr>
</table>
<br>





	<div style="margin:15px;padding:8px;border:1px solid #ccc;font-size:13px;color:#0000ff;background:#f4f4f4;text-align:center;">
		<a class='sbar' href='javascript:window.close();'>Close Window</a>
	</div>



<?	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}

?>
