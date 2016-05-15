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

include("header.ini.php");

$tmpData = uniqid('tmp_');


page_header("Possible Value Calls") ;

include("overround-class.php");

if (!isset($_GET['db'])){

	 //echo '<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Possible Value Calls</div>';
	 include("select-option.ini.php");

}else{



	if (strlen($errlog)>0){ 
		echo "<div class='errordiv'>$errlog</div>" ;
	}




?>
<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>


<div style="padding-bottom:2px"></div>

<table  width="100%" border='0'>
<tr>
	<td width='10%'><?php echo back();?></td>
	<td width='80%' class='ctd'>
	</td>
	<td width='10%'align="right"> <? echo printscr(); ?></td>
	</tr>
	
	<tr>
		<td colspan='3' bgcolor='#f3f3f3' class='padd'>
		<table border="0" cellpadding="0" cellspacing="0" style='margin:auto auto;width:90%'>


		<form method="get" action="<?php echo $PHP_SELF ?>">
			<input type="hidden" name="db" value="<?php echo $_GET['db'];?>">
		<tr>
		  <td width="15%" class='rtd'><b><font size="2" color="#0000FF">Week No:</font></b></td>
		  <td>	
		  	<select style="width:50px" name="weekno" class="text">
		   <? 
				 $br=0;
				 
				 for ($other=cur_week($db); $other>=1; $other--) :
					$br++;
					echo "<option value='$other'" ;
						if ($other==$weekno): echo " selected"; endif;
					echo ">$other</option>\n\n";
				 endfor;
				 echo "</select>";	

		   ?>
		   	</td>

		   <td  class='rtd'><b><font size="2" color="#0000FF">For:</font></b></td>
		   <td>
		  	<select size="1" name="formatch" class="text" style="width:150px;" >
                <option value="1" <? if ($_GET['formatch']==1) echo 'selected';?>>Full Week (Mon - Sun)</option>
                <option value="2" <? if ($_GET['formatch']==2) echo 'selected';?>>Weekend (Sat - Sun)</option>
                <option value="3" <? if ($_GET['formatch']==3) echo 'selected';?>>Midweek (Mon - Fri)</option>
		  </select>
		</td>
		</tr>
		<tr>
		<td class='rtd'><b><font size="2" color="#0000FF">Call Type:</font></b></td>
		<td>
		  	<select size="1" name="calltype" class="text" style="width:160px;" >
                <option value="1" <? if ($calltype==1) echo 'selected';?>>Home Win Calls</option>
                <option value="2" <? if ($calltype==2) echo 'selected';?>>Away Win Calls</option>
		  </select>
		 </td>   
		 <td class='rtd'><b><font size="2" color="#0000FF">Order By:</font></b></td>
		 <td>
		  	<select size="1" name="ordered" class="text" style="width:70px;" >
                <option value="1" <? if ($_GET['ordered']==1) echo 'selected';?>>00 - 99 </option>
                <option value="2" <? if ($_GET['ordered']==2) echo 'selected';?>>99 - 00</option>
		  </select>

		</td>
		</tr>	

		<tr>
		<td class='rtd'><b><font size="2" color="#0000FF">Sort On:</font></b></td>
		<td>
		  	<select size="1" name="sortby" class="text" style="width:160px;">
                <option value="5" <? if ($_GET['sortby']==5) echo 'selected';?>>Home Odds</option>
                <option value="6" <? if ($_GET['sortby']==6) echo 'selected';?>>Away Odds</option>
                
                <option value="1" <? if ($_GET['sortby']==1) echo 'selected';?>>Home Over-round value</option>
                <option value="2" <? if ($_GET['sortby']==2) echo 'selected';?>>Draw Over-round value</option>
                <option value="3" <? if ($_GET['sortby']==3) echo 'selected';?>>Away Over-round value</option>
                <option value="4" <? if ($_GET['sortby']==4) echo 'selected';?>>Match Over-round value</option>
		  </select>
		 </td>   
		 <td class='rtd'><b><font size="2" color="#0000FF"></font></b>
         
         </td>
		 <td><input type="submit" value="View Data" name="B1" class="bt" style="padding:4px 8px;"/></td>
		</tr>	
		</form>
	</table>
		</td>
	</tr>	
	</table>
<center>
 
<div style="padding-bottom:10px"></div>

<div class='errordiv' >
	Double Chance betting would be the best way to make use of the matches shown below unless you have satisfied yourself that the call is good.  
	And don't rely on the "Anticipated Score-Lines" being right (although many of the past score-lines had only a 1 goal or zero goal difference)!  
</div>

 
	
</center>


  <!-- startprint -->
<? if (isset($weekno) ): 

week_box_nocap($weekno, $wdate,$season,570);


?>


             
<div style="padding-bottom:10px"></div>



<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="570" cellpadding='3' bgcolor="#f6f6f6">
<tr bgcolor="#d3ebab">

  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>

  <? if ( ($DIV=='FA') or ($DIV=='SA') or ($DIV=='IN')) : ?>
	   <td width="80" class='ctd' rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/>
  <? else: ?>
		 <td width="10%" class='ctd'rowspan="2"><img src="images/tbcap/datepic.gif" border="0" alt=""/>
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

    $query1 = "create TEMPORARY TABLE $tmpData as (SELECT f.hgoal, f.agoal, f.gotit, f.mvalue, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb, f.weekno, f.mid,
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

        
        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&site=$db')\">";
        $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?site='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
        
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
	    <td class="ctd "><a class='md2' <?echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?echo $matchno;?>&site=<?echo $db;?>'><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

	    <td class='padd ltd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['hteam']?>&site=<?echo $db;?>">
	        <?echo $row['hteam'] .'</a>' . printv(' v '); ?>
	        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['ateam']?>&site=<?echo $db;?>">
	            <?echo $row['ateam'];?></a> (<?php echo $row['div'];?>)
	    </td>
		
		<td class='ctd <?php echo $pr . $asl_class;?>'><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
		
		<?php if ($weekno <> cur_week($db)){ ?>
			<td class='ctd <?echo $asl_class;?>'><?echo $row['h_s'] . dash() . $row['a_s'];?></td>
		<?php }?>
	
		<td class='ctd <?php echo $hor;?> <?echo ($_sortby=='h_odd'? "bgcolor='#D3EBAB'": "");?>'><a class='<?echo $sbar;?>' href="javascript:tell('full_odds.php?id=<?echo $matchno;?>&db=<?echo $db;?>')"><?php echo show_odd($row['h_odd']);?></a></td>
		
		<?php if ($weekno == cur_week($db)){ ?>	
				<td class='ctd' ><?php echo show_odd($row['d_odd']);?></td>
		<?php } ?>

		<td class='ctd <?php echo $aor;?> <?echo ($_sortby=='a_odd'? "bgcolor='#D3EBAB'": "");?>'><a class='<?echo $sbar;?>' href="javascript:tell('full_odds.php?id=<?echo $matchno;?>&db=<?echo $db;?>')"><?php echo show_odd($row['a_odd']);?></a></td>
		<td class='ctd' <?echo ($_sortby=='overround'? "bgcolor='#D3EBAB'": "");?>><a title='Over Round Details' class='sbar' href="javascript:OrWin('overround.php?db=<?php echo $db;?>&id=<?php echo $matchno;?>')"><?php echo num20($or->match_or);?>%</a></td>
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
<td style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?= $fff ?>
</td>

<td style="font-weight:normal;text-align:center;padding-top:5px;">

	<B>ASL</B>&nbsp;=&nbsp;</FONT><font size="1">Our Anticipated Score-Line&nbsp;&nbsp;
	
	<BR>
	*  Click on "Date/Time & PIC" to view <B>Performance Indicator Chart</B><BR>and associated backup data<BR>
	
	<? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>

</tr>
</table>
<br>


<? endif;?>


<div style="padding-bottom:5px">&nbsp;</div>
		
<? 

}

include("footer.ini.php"); ?>


<?	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}

?>
