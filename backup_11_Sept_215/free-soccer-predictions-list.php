<?	session_start();
include("config.ini.php");
include("function.ini.php");




$qry = "SELECT * FROM setting";
$db='eu';

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
$DIV  = $parts[0];

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


 
	
 $pwk = $weekno-1;
 $nwk = $weekno+1;
 $purl="$PHP_SELF?PARA=$DIV";
  if ($LOG=="N") : $purl .= "&LOG=N"; endif;
 $purl .= ",";
 $nurl="$PHP_SELF?PARA=$DIV,$nwk";

 $ltable="<a class=blue href=league-table.php?DIV=$DIV#table>";
 $grid="<a class=blue target=_blank class=prv href=full.php?DIV=$DIV#table>";
 
 




 
 $page_title="1X2 Predictions " . divname($DIV) . " $season Week $weekno";
 
 
 include("header.ini.php");

?>


<? 
$page_title="1X2 Predictions"; page_header($page_title) ; ?>
 
<div style="padding-bottom:2px"></div>

<table border="0" width="560" cellpadding="0" cellspacing="0" id="AutoNumber3" height="20" align="center">
 <tr>
    <td width="25%"> <? echo back(); ?> </td>

   <td width="25%" height="20" align='center' colspan='3' valign="bottom">
		<form method='get' style='padding:0;margin:0;'>	
			<b>Week No: </b><select style='width:40px;' name="PARA" class="text" onChange="this.form.submit();">
	   <? 
			 $br=0;
			 
			 for ($other=1; $other<=cur_week('eu'); $other++) :
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


<div style="padding-bottom:5px"></div>





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

week_box_new(divname($row['div']), $row['weekno'], $row['wdate'], $row['season'],570) ;

?>
 
<div style="padding-bottom:5px"></div>


<table border="1" style="border-collapse: collapse" bordercolor="#CDCDCD"  width="570" align="center" bgcolor="#F6F6F6" >

<tr bgcolor="#D3EBAB">
	<td width="5%" style="text-align: center" rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=''/></td>

  <td width="10%" style="text-align: center" rowspan="2">
     <? if ( ($DIV=='FA') or ($DIV=='SC')) : ?>
		  <img src="images/tbcap/date.gif" border='0' alt='' />
	 <? else: ?>
		  <img src="images/tbcap/datepic.gif" border='0' alt=''/>
	 <? endif; ?>
  </td>
  <td width="38%" style="text-align:center" rowspan="2"><img src="images/tbcap/fixture.gif" border='0' alt='' /></td>
  <td width="5%" style="text-align: center" rowspan="2"><img src="images/tbcap/asl.gif" border='0' alt='' /></td>
  <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/act.gif" border='0' alt='' /></td>
  <td width="24%" style="text-align: center" colspan="3"><img src="images/tbcap/probs.gif" border='0' alt='' /></td>
 </td>

</tr>
<tr bgcolor="#D3EBAB">
  <td width="8%" style="text-align: center" ><img src="images/tbcap/home.gif" border='0' alt='' /></td>
  <td width="8%" style="text-align: center" ><img src="images/tbcap/d.gif" border='0' alt='' /></td>
  <td width="8%" style="text-align: center" ><img src="images/tbcap/a.gif" border='0' alt='' /></td>
</tr>

<?  
    $temp->execute();

    if ($temp->rowCount()==0){
       echo "<tr><td colspan='8' class='ctd' style='padding:30px;'><span class='error'>No Matches This Week</span></td></tr>";
    }else {
        
    $pic = "/pic/" ;
    $pic =  $weekno ."/pic";
    $number=0;
     $ngot =0 ;
    while ($row = $temp->fetch()) {
        
        $number++;
        $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&db=$db')\">";
        $ngot += $row['gotit'] ;
         
        $asl_class ="";
       
        if ($row['gotit']=='1' and $row['h_s']<>'P'){
            $asl_class = " gotrt";
        }
        
        if ($asl==$act){
            $asl_class = " gotasl";
        }
        
        if ($row['h_s']=='P'){
            $asl_class = " pp";
        }

?>	
        <tr <?echo rowcol($number);?>>
            <td class="ctd padd"><?echo $number; ?></td>
            <td class="ctd "><a <?echo $ffh;?> class='md2' target='_blank' href='team-performance-chart.php?id=<?echo $matchno;?>&site=eu'><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>
            
            <td class='padd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['hteam']?>&site=eu">
                <?echo $row['hteam'] .'</a>' . printv(' v '); ?>
                <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['ateam']?>&site=eu">
                    <?echo $row['ateam'];?></a>
             </td>
             
            <td class="ctd <?echo $asl_class;?>"><?echo $headtohead . $row['hgoal'] . dash() . $row['agoal'];?></a></td>
            <td class="ctd <?echo $asl_class;?>"><?echo $row['h_s'] . dash() . $row['a_s']; ?></td>
            <td class="ctd"><?echo show_odd($row["hwinpb"]); ?></td>
            <td class="ctd"><?echo show_odd($row["drawpb"]); ?></td></td>
            <td class="ctd"><?echo show_odd($row["awinpb"]); ?></td></td>
        </tr>        
        
  <?    }
    }  
  ?>	
   <tr bgcolor="#f4f4f4">
    <td colspan="4" class="rtd padd"><strong>Total Correct Calls</strong></td>
    <td class="ctd padd"><strong><?echo $ngot?></strong></td>
    <td colspan="4"></td>
  </tr>		 
</table>
    
<div id="tip1_down" style="display:none;">
    <pre class="tip">Click here to view charts,<br/>tables and supporting data</pre>
</div>	 
	 
 <!-- stopprint -->
<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?= $fff ?>
</td>


<td style="font-weight:normal;text-align:center;padding-top:5px;">
	<font size="1" color="blue" >
	<b>ASL</b>&nbsp;=&nbsp;</font><font size="1">Anticipated Score-Line&nbsp;&nbsp;
	<font color="blue"><b>Act Res</b></font>&nbsp;=&nbsp;Actual Result
	<br />
	*  Click on "Date/Time & PIC" to view PIC and associated backup data<br />
	** Click on Team name to view "Results to Date"

	<? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
</tr>
</table>

<div style="padding-bottom:5px">&nbsp;</div>



<? //include("pred1x2-disclaimer.ini.php"); ?>

<div class="reg_botton"><a title='Subscribe Now!' href="subscribe.php">
<img src='images/joinnow2.png' border='0' alt='subscribe.php' /></a></div>


<?
include("footer.ini.php"); ?>

<?	
function show_odd($value)
{
  if ($value>0): 	return $value ; else: 	return '';  endif;
}
?>
