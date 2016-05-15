<?

session_start();
include("config.ini.php");
include("function.ini.php");


$qry = "SELECT * FROM setting";

$db = $_GET['db'];

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

if (!isset($_REQUEST['season_value'])){
	$sea = curseason($db);	
}else{
	$sea = $_REQUEST['season_value'];
}    

    

if (!isset($_REQUEST['curWeek'])){
    $weekno = cur_week($db);    
}else{
    $weekno = $_GET['curWeek'];
}
	  

 $pageURL = "?PARA=$DIV,$weekno";
 $nurl="$PHP_SELF?DIV=$DIV,$nwk";


  
  
	$qry = "SELECT * FROM misc_odds f where f.season='$sea' limit 1";
   
	if ($db=='eu'){
	   $temp = $eu->prepare($qry) ;
	}else{
	   $temp = $sa->prepare($qry);
	}
	$temp->execute();
	$hd = $temp->fetch();
   

 
$page_title= "Jump The Gun!";

$active_mtab = 1;

include("header.ini.php"); 
$page_title= "Jump The Gun!";
?>

<? page_header($page_title ); ?>

<div style="padding-bottom:2px"></div>

<? if (isset($_GET['db'])){ ?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
 <div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div> 
<div class='clear'></div>


<br />

<form method="get" action="<? echo $PHP_SELF ?>">
    <input type="hidden" name="db" value="<?echo $_GET['db'];?>" />
    
<table border="0" style="border-collapse: collapse;margin:auto auto;"  width="540" >

<tr>
  <td width="130" ><b><font size="2" color="#0000FF">Season:</font></b><br>
  <select size="1" name="season_value" class="text" style='width:110px;font-size:12px;' onchange="this.form.submit()" >

  <? $sqry = "SELECT distinct(season) as season from misc_odds order by season desc" ;
    if ($db=='eu'){
        $temp = $eu->prepare($sqry);
    }else{
        $temp = $sa->prepare($sqry);
    }

	$temp->execute();
   while ($sr = $temp->fetch()) : 
  ?>
	  <option value="<?= $sr["season"] ?>" <?echo selected($season_value,$sr["season"])?>><?= $sr["season"] ?></option>
  
  <? endwhile; ?>
  
  </select>

 

  </td>
</tr>	

</table>
</form>

<table border="0" width="100%" cellpadding="0" cellspacing="0" >
 <tr>
    <td width="25%"></td>

   <td width="25%" height="20" align='center' colspan='3' valign="bottom">
		
	 </td>
	<td width="25%" align="right"> <? echo printscr(); ?></td>
	</tr>
 </table>
 
<div style="padding-bottom:5px"></div>

  <!-- startprint -->
 
 

<div style="padding-bottom:5px"></div>


<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD"  width="540" bgcolor="#F6F6F6">
    <tr bgcolor="#D3EBAB">
        <td  class='ctd credit' rowspan='2' style='padding:8px 0'>Ref</td>
        <td  class='ctd credit' rowspan='2' style='width:230px'>Team</td>
        <td  class='ctd credit' colspan='4' >Outright Win Odds</td>
    </tr>
    <tr bgcolor="#D3EBAB">
		<td class='ctd credit' style='font-size:12px;width:80px;'><?php echo $hd['col1date'];?></td>
		<td class='ctd credit' style='font-size:12px;width:80px;'><?php echo $hd['col2date'];?>&nbsp;</td> 
		<td class='ctd credit' style='font-size:12px;width:80px;'><?php echo $hd['col3date'];?>&nbsp;</td>
		<td class='ctd credit' style='font-size:12px;width:80px;'><?php echo $hd['col4date'];?>&nbsp;</td>
    </tr>
    
    <?
	
   
	if ($db=='eu'){
		$qry = "SELECT f.*, r.rank FROM misc_odds f, ranking r WHERE  f.season='$sea' and f.`div`=r.matchtype and r.cat='fixt' ORDER BY r.rank,f.col2,f.col2,f.col3,f.col4 ";
	   $temp = $eu->prepare($qry) ;
	}else{
		$qry = "SELECT f.*, r.rank FROM misc_odds f, ranking r WHERE  f.season='$sea' and f.`div`=r.matchtype and r.cat='fixt' ORDER BY r.rank,f.col1";
	   $temp = $sa->prepare($qry);
	}
	$temp->execute();

	
      $pdiv='';
      while ($data = $temp->fetch()){  ; 
    
        $hpr = $data['team'];
        
        if (asl_pr_byteam($data["team"],$season ,$db)){
          $hpr = "<span class='pr3'>" . $data['team'] . "</span>";
        } 
        

        if ($pdiv<>$data['div']){
            $x=0;
            echo "<tr>\n<td colspan='6' class='credit' style='padding:5px;'>\n" . divname($data['div'])  . "</td>\n</tr>\n\n";
        }
        $x++;

        $odddata = match_1x2_odds($data['season'], $data['matchno'], $db)


    ?>
        <tr <? echo rowcol($x);?> >
            <td class="ctd s12" style="padding:4px;"><?php echo $x ?></td>
            
            <td class="ltd s12" style="padding:4px;"><?php echo $hpr ?></td>
            <td class='rtd s12' style="padding:4px;"><?php echo show_odd($data['col1']);?></td>
			<td class='rtd s12' style="padding:4px;"><?php echo show_odd($data['col2']);?></td> 
            <td class='rtd s12' style="padding:4px;"><?php echo show_odd($data['col3']);?></td>
			<td class='rtd s12' style="padding:4px;"><?php echo show_odd($data['col4']);?></td>
        </tr>

    <? $pdiv = trim($data['div']); 
        } 
    ?>
</table>

               <!-- stopprint -->

<?}else{
    
    include("select-option.ini.php");
    
} ?>

<div style="padding-top:5px;font-size:10px;padding-left:70px;">
	
	<?php if ($db=='eu'){
		//echo "Collected: 08-Aug-2014";
	}else{
		//echo "Collectd: 14-Aug-2014";
	}
	?>
</div>
		

<? include("footer.ini.php"); ?>

<?  
function show_odd($value)
{
  if ($value>0):  return "$value" ; else:   return '-';  endif;
}
?>

