<?php

session_start();
include("config.ini.php");
include("function.ini.php");


if (!isset($_GET['site'])){
    $db='eu';
}else{
    $db = $_GET['site'];
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
$season  =$row["season"];

if ($LOG=="N"): $lastweek = $lastweek - 1; endif;

if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;


$parts = explode(",",$_GET["PARA"]);
$DIV  =  $parts[0];
$weekno= $parts[1];
$errlog = "";

$updating = $row["updating"];
$sended=$row["seasonended"];
$lastweek = $row["weekno"];
$season  =$row["season"];

if ($LOG=="N"): $lastweek = $lastweek - 1; endif;
if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;
    
    


if ($weekno<=0) $weekno = $lastweek ;


 if (count($parts)==1):
     if (!isset($fullname) or !isset($userid)):
    $weekno=$lastweek;
  else:
    $weekno=$lastweek;
  endif;
 else:
  $weekno=$parts[1];
 endif;


if (!isset($fullname) or !isset($userid)):
  if ($ACTION<>"PRINT"):
      if ($weekno==$lastweek):
      //header('Location: nolog.php');
      //exit;
    endif;
  endif;
endif;

 

$page_title="Major Divisions 1X2 Predictions " . divname($DIV) . " Season $cur_season Week $weekno";
 
 include("header.ini.php");

?>


<? 
$page_title="Major Divisions 1X2 Predictions"; page_header($page_title) ;


if (strlen($errlog)>0):
    echo "<div class='errordiv'>$errlog</div>";
endif;

 ?> 
<div style="padding-bottom:2px"></div>

<div style="padding-bottom:2px"></div>

<table border="0" width="98%" cellpadding="0" cellspacing="0">
 <tr>
    <td width="25%"> <? echo back(); ?> </td>

   <td width="25%" height="20" align=center colspan=3 valign="bottom">
		<form method='get' style='padding:0;margin:0;'>	
            <input type="hidden" name="site" value="<?echo $db ;?>" />
			<b>Week No: </b><select style='width:40px;' name="PARA" class="text" onChange="this.form.submit();">
	   <? 
			 $br=0;
			 
			 for ($other=cur_week($db); $other>=1; $other--) :
				$br++;
				echo "<option value='$DIV,$other'" ;
					if ($other==$weekno): echo " selected"; endif;
				echo ">$other</option>\n\n";
			 endfor;
			 echo "</select></form>";	

	   ?>
	 </td>
	<td width="25%" align="right"> <? echo printscr(); ?></td>
	</tr>
 </table>


<div style="padding-bottom:10px"></div>

  <!-- startprint -->
<?  

$qry = "SELECT * FROM fixtures WHERE `div`='$DIV' AND weekno='$weekno' and `season`='$season' ORDER BY match_date,hteam,ateam";

if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
$row = $temp->fetch() ;

week_box_new(divname($DIV), $weekno, $row['wdate'], $season,570) ;

?>
 

             
<div style="padding-bottom:5px"></div>

<center>

<table border="1" style="border-collapse: collapse" bordercolor="#CDCDCD"  width="570" align="center" bgcolor="#F6F6F6" >
<tr bgcolor="#D3EBAB">
    <td width="5%" style="text-align: center" rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt='' /></td>
    <td width="10%" style="text-align: center" rowspan="2"><? if ( ($DIV=='FA') or ($DIV=='SC')) : ?><img src="images/tbcap/date.gif" border='0' alt='' />
     <? else: ?>
    	  <img src="images/tbcap/date.gif" border='0' alt='' />
     <? endif; ?>
    </td>
    <td width="38%" style="text-align: center" rowspan="2"><img src="images/tbcap/fixture.gif"  border='0' alt='' /></td>
    <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/1x2call.gif"  border='0' alt='' /></td>
    <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/1x2res.gif"  border='0' alt='' /></td>
    <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/actsl.gif"  border='0' alt='' /></td>
    <td width="24%" style="text-align: center" colspan="3"><img src="images/tbcap/probs.gif"  border='0' alt='' /></td>
    <td width="24%" style="text-align: center" rowspan="2"><img src="images/tbcap/odds.gif"  border='0' alt='' /></td>
</tr>

<tr bgcolor="#D3EBAB">
    <td width="8%" style="text-align: center"><img src="images/tbcap/home.gif"  border='0' alt='' /></td>
    <td width="8%" style="text-align: center"><img src="images/tbcap/d.gif"  border='0' alt='' /></td>
    <td width="8%" style="text-align: center"><img src="images/tbcap/a.gif"  border='0' alt='' /></td>
</tr>

<?  
    $temp->execute();

    if ($temp->rowCount()==0){
       echo "<tr><td colspan='10' class='ctd' style='padding:30px;'><span class='error'>No Matches This Week</span></td></tr>";
    }else {
        
    $pic = "/pic/" ;
    $pic =  $weekno ."/pic";
    $number=0;
    
    while ($row = $temp->fetch()) {
        
        $number++;
        $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno')\">";
        
        $title = "$row[hteam] v $row[ateam] match odds" ;
        
        $asl_class ="";
       
        if ($row['gotit']=='1' and $row['h_s']<>'P'){
            $asl_class = " ";
        }
        
        if ($asl==$act){
            $asl_class = " ";
        }
        
        if ($row['h_s']=='P'){
            $asl_class = " ";
        }

?>	
        <tr <?echo rowcol($number);?>>
            <td class="ctd padd"><?echo $number; ?></td>
            <td class="ctd "><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></td>
            
            <td class='padd'><?echo $row['hteam'] .'</a>' . printv(' v '); ?><?echo $row['ateam'];?></a>
             </td>
             
            <td class="ctd"><? echo show_call_char($row["hgoal"], $row["agoal"], $row[mid], $row[weekno], $row[season],$db ) ;?></td>
            <td class="ctd"><? echo show_goal_char1x2($row["h_s"], $row["a_s"],$db);?></td>
            <td class="ctd <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
            <td class="ctd"><?echo show_odd($row["hwinpb"]); ?></td>
            <td class="ctd"><?echo show_odd($row["drawpb"]); ?></td></td>
            <td class="ctd"><?echo show_odd($row["awinpb"]); ?></td></td>
            <td class="ctd"><a title='<?echo $title;?>' href="javascript:tell('full_odds.php?id=<?echo $matchno;?>&db=<?echo $db;?>')" class='sbar'>view</a></td>
        </tr>        
        
  <?    }
    }  
  ?>		 
                

</table>
   
</center> 
	 
 <!-- stopprint -->
  <!-- stopprint -->	
<div style="padding-left:5px;padding-bottom:5px;font-weight:normal;text-align:center;">
	<FONT SIZE="1" >

	** Click on Team name to view "Results to Date"<BR>	
	<FONT COLOR="blue"><B>Act S/L</B></FONT>&nbsp;=&nbsp;Actual Score-Line

	<? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</div>

<BR>
<? 
include("pred1x2-disclaimer.ini.php"); 


?>

<div class="reg_botton"><a title='Subscribe Now!' href="subscribe.php"><img src='images/joinnow2.png' border='0' alt='subscribe.php' /></a></div>

<?
include("footer.ini.php"); ?>

<?	

  
function show_call_char($hgoal, $agoal, $mid, $weekno, $season,$db )
{   global $eu, $sa;

    $char =  "";
    
    $xqry="select hw_x, aw_x, hw_aw from other_odds where season='$season' and weekno='$weekno' and matchno='$mid'";
    
    if ($db=='eu'){
       $temp2 = $eu->prepare($qry) ;
    }else{
       $temp2 = $sa->prepare($qry);
    }
    $temp2->execute();
    $xx = $temp2->fetch() ;

    //home predicted
    if ($hgoal>$agoal){
         $char = ($xx['hw_x']>=1.10? "<img src='images/1x.gif' alt='1/X'/>" : "<img src='images/1h.gif' alt='1'/>" ) ;    
    }
    
    //away predicted
    if ($agoal>$hgoal){
         $char = ($xx['aw_x']>=1.10? "<img src='images/2x.gif' alt='2/X'/>" : "<img src='images/2a.gif' alt='2'/>" ) ;    
    }
   
    //draw predicted
    if ($hgoal==$agoal){
         $char = ($xx['hw_x']>$xx[aw_x]? "<img src='images/1x.gif' alt='1/X'/>" : "<img src='images/2x.gif' alt='2/X'/>" ) ;    
    }

    
    return $char;
}

function show_odd($value)
{
  if ($value>0): 	return $value ; else: 	return '';  endif;
}
?>
