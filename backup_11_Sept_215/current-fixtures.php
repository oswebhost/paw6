<?

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
$season  =$row["season"];

if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;
    
$sea = curseason($db);
    

if (!isset($_REQUEST['curWeek'])){
    $weekno = cur_week($db);    
}else{
    $weekno = $_GET['curWeek'];
}
	  

 $pageURL = "?PARA=$DIV,$weekno";
 $nurl="$PHP_SELF?DIV=$DIV,$nwk";


$qry = "SELECT * FROM fixtures WHERE weekno='$weekno' and `season`='$season' limit 1";

if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();


 while ($row = $temp->fetch()):
	$wdate   =$row["wdate"];
	$weekno  =$row["weekno"];
 endwhile;

  
  
$qry = "SELECT f.season, f.matchno, f.weekno, f.`div`,f.hteam,f.ateam, date_format(f.date_time,'%d-%b-%y') as mdate, date_format(f.date_time,'%H:%i') as mtime, r.rank FROM fixt_list f, ranking r WHERE f.weekno='$weekno'  and f.season='$sea' and f.`div`=r.matchtype and cat='fixt' ORDER BY r.rank, f.date_time, f.hteam,f.ateam";
   
if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
   
 
$page_title= (isset($_GET['db'])? s_title($db) : ""). " Current Soccer Fixtures";


 include("header.ini.php"); 
 $page_title= "Current Fixtures + 1X2 Odds";
?>

<? page_header($page_title ); ?>

<div style="padding-bottom:2px"></div>

<? if (isset($_GET['db'])){ ?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>


<br />

<table border="0" width="100%" cellpadding="0" cellspacing="0" >
 <tr>
    <td width="25%"><a class='sbar' href="current-fixtures.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a></td>

   <td width="25%" height="20" align='center' colspan='3' valign="bottom">
		<form method='get' style='padding:0;margin:0;'>	
        <input type="hidden" name="db" value="<?echo $_GET['db'];?>" />
        
			<B>Week No: </B><select style='width:50px;' name="curWeek" class="text" onChange="this.form.submit();">
	   <? 
			 $br=0;
			 
			 for ($other= cur_week($db); $other>=1; $other--) :
				$br++;
				echo "<option value='$other'" ;
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
 <?  week_box_nocap($weekno, $wdate, $season,540); ?>
 

<div style="padding-bottom:5px"></div>


<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD"  width="540" bgcolor="#F6F6F6">
    <tr bgcolor="#D3EBAB">
        <td width="5%" class='ctd' rowspan='2'><IMG SRC="images/tbcap/refno.gif"  BORDER='0' ALT=""></td>
        <td width="25%" class='ctd' rowspan='2'><IMG SRC="images/tbcap/date.gif" BORDER="0" ALT=""></td>
        <td  class='ctd' rowspan='2'><IMG SRC="images/tbcap/match.gif"  BORDER="0" ALT=""></td>
        <td  class='ctd' colspan='3'><IMG SRC="images/tbcap/odd2.gif"  BORDER="0" ALT=""></td>
        
    </tr>
    <tr bgcolor="#D3EBAB">
        <td width="8%" class='ctd'><IMG SRC="images/tbcap/home.gif"  BORDER="0" ALT=""></td>
        <td width="8%" class='ctd'><IMG SRC="images/tbcap/d.gif"  BORDER="0" ALT=""></td>
        <td width="8%" class='ctd'><IMG SRC="images/tbcap/a.gif"  BORDER="0" ALT=""></td>

    </tr>
    <?
      $pdiv='';
      while ($data = $temp->fetch()){  ; 
    
        if ($pdiv<>$data['div']){
            $x=0;
            echo "<tr>\n<td colspan='6' class='credit' style='padding:5px;'>\n" . divname($data['div'])  . "</td>\n</tr>\n\n";
        }
        $x++;

        $odddata = match_1x2_odds($data['season'], $data['matchno'], $db)


    ?>
        <tr <? echo rowcol($x);?> >
            <td class="ctd s12" style="padding:4px;"><?php echo $x ?></td>
            <td class="ctd s12" style="padding:4px;"><?php echo $data[mdate] ?>&nbsp;&nbsp;<font size="1"><? echo $data[mtime] ?></font></td>
            <td class="ltd s12" style="padding:4px;"><?php echo $data[hteam] . printv(" v ") . $data[ateam] ?></td>
            <td class='ctd s12' style="padding:4px;"><?php echo show_odd($odddata->h_odd);?></td>
            <td class='ctd s12' style="padding:4px;"><?php echo show_odd($odddata->d_odd);?></td>
            <td class='ctd s12' style="padding:4px;"><?php echo show_odd($odddata->a_odd);?></td>
        </tr>

    <? $pdiv = trim($data['div']); 
        } 
    ?>
</table>
               <!-- stopprint -->

<?}else{
    
    include("select-option.ini.php");
    
} ?>

<div style="padding-bottom:5px">&nbsp;</div>
		

<? include("footer.ini.php"); ?>

<?  
function show_odd($value)
{
  if ($value>0):  return "$value" ; else:   return '';  endif;
}
?>

