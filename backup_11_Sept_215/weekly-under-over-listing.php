<?php
session_start();
include("config.ini.php");
include("function.ini.php");

if (!isset($_REQUEST['db'])){
	include("header.ini.php");
	include("select-option.ini.php");
	include("footer.ini.php");
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
  
  

if (isset($_GET["weekno"])):
	$page_title = "Under/Over Odds " . site($db) . " " . curseason($db)  . " Week $weekno " ;
else:
	$page_title = "Under/Over Odds " . site($db) . " " . curseason($db) ;
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

include("overround-class.php");

?>

<div class="report_blue_heading" style="width: 98%;height:32px;margin:0 auto 5px auto;">
	<?echo site($db);?> <br />	
	under/over Odds All Divisions Combined
	
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

<div style="padding-bottom:10px"></div>

<div style="padding-bottom:10px"></div>

  <!-- startprint -->
<? if (isset($weekno) ): 

week_box_nocap($weekno, $wdate,$season,"98%");


?>


             
<div style="padding-bottom:10px"></div>

<?php 
  if ($row['weekno'] == cur_week($db)){
    over_round_msg();
  }
?>

<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="98%" cellpadding='3' bgcolor="#f6f6f6">
<tr bgcolor="#d3ebab">

  <td width="5%" class='ctd'><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>

  <? if ( ($DIV=='FA') or ($DIV=='SA') or ($DIV=='IN')) : ?>
	   <td width="80" class='ctd'><img src="images/tbcap/date.gif" border="0" alt=""/>
  <? else: ?>
		 <td width="10%" class='ctd'><img src="images/tbcap/date.gif" border="0" alt=""/>
  <? endif; ?>
  </td>
  <td width="38%" class='ctd'><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
  <td class='ctd' ><img src="images/tbcap/div.gif"  border="0" alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/u25.gif"  border='0' alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/o25.gif"  border='0' alt=""/></td>

<?if ($row['weekno'] < cur_week($db)){ ?>
  <td width="12%" colspan='2' class='ctd'><img src="images/tbcap/pawuo.gif" border="0" alt=""/></td>
  
  <td width="12%" colspan='2' class='ctd'><img src="images/tbcap/bookieuo.gif" border="0" alt=""/></td>

<?}else{?>
  <td width="6%" class='ctd'><img src="images/tbcap/overround.gif"  border="0" alt=""/></td>
  <td width="6%" class='ctd'><img src="images/tbcap/htw-prob.gif"  border="0" alt=""/></td>
  <td width="6%" class='ctd'><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
  <td width="8%" class='ctd'><img src="images/tbcap/more.gif"  border="0" alt=""/	></td></td>

<?}?>

</tr>

<?
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
      
      $order = " o.un_odd, ";
      $second_order = " ,o.un_odd asc ";
      
      switch ($_GET['CALL'])
      { 
          case 1: $_calltype = " "; break;
          case 2: $_calltype = " and (f.hgoal+f.agoal) < 2.5 and f.hgoal>f.agoal "; break;
          case 3: $_calltype = " and (f.hgoal+f.agoal) > 2.5 and f.hgoal>f.agoal "; $second_order = " ,o.ov_odd asc "; break;

          case 4: $_calltype = " and (f.hgoal+f.agoal) < 2.5 and f.agoal>f.hgoal "; break;
          case 5: $_calltype = " and (f.hgoal+f.agoal) > 2.5 and f.agoal>f.hgoal "; $second_order = " ,o.ov_odd asc "; break;

          case 6: $_calltype = " and (f.hgoal+f.agoal) < 2.5 and f.hgoal=f.agoal ";  break;
          case 7: $_calltype = " and (f.hgoal+f.agoal) > 2.5 and f.hgoal=f.agoal " ; $second_order = " ,o.ov_odd asc "; break;

      }
  
      switch($_GET['ordered'])
      {
        case 1: $ordered = " asc"; break;
        case 2: $ordered = " desc"; break;
      }
          
      switch ($_GET['SORTBY'])
      {
      
        case 10: $ordered_by = " ORDER BY o.un_odd "; break;
        case 11: $ordered_by = " ORDER BY o.ov_odd "; break;
        
        case 13: $ordered_by = " ORDER BY goalsum $ordered, f.hgoal "; break;
        case 14: $ordered_by = " ORDER BY goaldif "; break;
      }

      $filter='';

      if ($_GET['min_odd']>0 and $_GET['max_odd']>0){
          switch ($_GET['CALL'])
          { 
            case 1: 
                $filter = " and o.un_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] . " and o.ov_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd']; break;
            
            case 2:
            case 4:
            case 6: 
                $filter = " and o.un_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
                
            case 3:
            case 5:
            case 7:
                $filter = " and o.ov_odd between " . $_GET['min_odd']  . " and ".  $_GET['max_odd'] ; break;
          }
        
      }
      
   
 	$query1 = "SELECT date_format(f.match_date,'%d-%b-%Y') as m_date,(f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum,f.hgoal, f.agoal, f.gotit, f.h_s,f.a_s,f.hwinpb,f.awinpb,f.drawpb,f.h_odd,f.a_odd,f.d_odd,
	 f.weekno, f.mid, o.un_odd, o.ov_odd, f.`div`,
		f.hteam,f.ateam,  f.mdate, f.match_time, r.rank FROM fixtures f, ranking r, other_odds o WHERE 
			f.weekno='$weekno' and f.season='$season' and f.`div`=r.matchtype and r.cat='fixt' and f.weekno=o.weekno and 
				f.season=o.season and f.mid = o.matchno and o.un_odd>0 " ;
           
     $query1 .= $period . $_divs . $_calltype . $filter . $ordered_by . $second_order ;
  
    
    
				
	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}

    $temp->execute();

    $number = 0;
    $bookie_over = 0;
    $bookie_under= 0;
    $bookie_t_over=0;
    $bookie_t_under=0;

    $paw_over = 0;
    $paw_under= 0;
    $paw_t_over=0;
    $paw_t_under=0;

    $postpond = 0;
    $nas = 0;
    
    if ($temp->rowCount()==0){
        
        echo "<tr>\n
             <td colspan='10' class='ctd bot' style='color:red;padding:20px;'>No Match for selected options</td>\n
             </tr>\n";
        
    }
    while ($row = $temp->fetch()) {
  
      $asl_sum = 0;
      $act_sum = 0;

    	$number++;
	    $matchno = $row['mid'];
      $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
      $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;

      $asl_sum = $row["hgoal"]+$row["agoal"];
      $act_sum = $row["h_s"]+$row["a_s"];

        
      
      $title = "$row[hteam] v $row[ateam] match odds" ;
      $odd=0;
      $or = new overround();
      $or->find_or($row['h_odd'], $row['d_odd'], $row['a_odd'], $row['hwinpb'],$row['drawpb'],$row['awinpb']);
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
            $asl_class = " gotrtblue";
        }
        
         $asl_class ="";
         $asl_class2 ="";

        if ($row['h_s']=='P'){
            $asl_class = " pp";
            $sbar= "sWrg";
            $postpond ++;
            $bookie_call = "N/A";
        
        }else{

          //paw
          if ($asl_sum<2.5) {
             $paw_t_under++;
             $paw_call = "U";

             $paw_under += ($act_sum<2.5? 1 : 0);
             $asl_class = ($act_sum<2.5? " gotrt" : "");
          }else{
             $paw_t_over++;
             $paw_call = "O";
             $paw_over += ($act_sum>2.5? 1 : 0);
             $asl_class = ($act_sum>2.5? " gotrt" : "");
          }

          $bookie_call = ($act_sum>2.5? "O": "U");

          //bookie 
          if ($row["un_odd"]<$row["ov_odd"]){
            $bookie_t_under++;
            $bookie_under += ($act_sum<2.5? 1 : 0);
            $asl_class2 = ($act_sum<2.5? " h_Or bold" : "");
          }elseif($row["ov_odd"]<$row["un_odd"] ){
            $bookie_t_over++;
            $bookie_over += ($act_sum>2.5? 1 : 0);
            $asl_class2 = ($act_sum>2.5? " h_Or bold" : "");
          }else{
            if ($row['h_s']<>'P'){
              $nas++;  
              $bookie_call = "N/A";
            }else{
              $bookie_call = "N/A";
            }

          }

        }
        
        $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$season,$db)){
            $pr = " pr2";
        }

        $overround=0;
		    $overround = ( (1/$row["un_odd"]) + (1/$row["ov_odd"] - 1)) * 100  ;

           //over founds
        $hor = ""; //($or->home_value==1? " h_Or" : "");
        $aor = "";// ($or->away_value==1? " a_Or" : "");




?>

	<tr <?php echo rowcol($number);?>>
		<td class="ctd padd"><?echo $number; ?></td>
	    <td class="ctd "><?echo $row['m_date'];?></td>

	    <td class='padd ltd'><?echo $row['hteam'] . printv(' v ') . $row['ateam'];?> </td>
		
		<td class='ctd'><?php echo $row['div'];?></td>
		<td class='ctd <?php echo $hor;?>'><?php echo show_odd($row['un_odd']);?></td>
		<td class='ctd <?php echo $aor;?>'><?php echo show_odd($row['ov_odd']);?></td>

    <?if ($row['weekno'] < cur_week($db)){ ?>

      <td class="ctd <?echo $asl_class;?>" style="width:100px;"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
      <td class="ctd <?echo $asl_class;?>" style="width:70px;"><?echo ($asl_sum>2.5? "O" : "U") ;?></td>
      
      <td class="ctd <?echo $asl_class2;?>" style="width:100px;"><?echo $row['h_s'] . dash() . $row['a_s'];?></td>
      <td class="ctd <?echo $asl_class2;?>" style="width:70px;"><?echo $bookie_call ; ?></td>

    <?}else{?>
      <td class='ctd'><a title='Over Round Details' class='sbar' href="javascript:OrWin('overround.php?db=<?php echo $db;?>&id=<?php echo $matchno;?>')"><?php echo num20($overround);?>%</a></td>
      <td class='ctd'><?php echo num2($row['hwinpb']);?></td>
      <td class="ctd <?echo $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
    
      <td class="ctd">
        <a class='<?echo $sbar;?>' href="javascript:tell('full_odds.php?id=<?echo $matchno;?>&db=<?echo $db;?>')">
          <? if (strlen($act)<2){
            echo "Odds";
          }else{
            echo $row['h_s'] . dash() . $row['a_s']; 
          } 
          ?>
        </a>
      </td>
  

    <?}?>

  	
	</tr>

<?}?>

</table>




<!-- stopprint -->

			   
			   
			   
			   





<div style="padding-top:5px;font-size:11px;padding-left:10px;text-align:left;">
  <b>KEY:</b>&nbsp;&nbsp;<b>O</b>&nbsp;=&nbsp;Over Call&nbsp;&nbsp;&nbsp;&nbsp;<b>U</b>&nbsp;=&nbsp;Under Call<br />
  <strong>N/A</strong> = Either Postponed or Bookie's Odds are Equal
 </div>


<? endif;?>

<?if ($weekno < cur_week($db)){
/*
  if ($bookie_t_under==0) $bookie_t_under = 1;
  if ($bookie_t_over==0) $bookie_t_over = 1;
  if ($paw_t_under==0) $paw_t_under = 1;
  if ($paw_t_over==0) $paw_t_over = 1;
*/

 ?>
<div style='padding:10px;'></div>

<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="98%" cellpadding='3'>
  <tr bgcolor="#d3ebab">
    <td width='200' class='ctd padd bot'>SUMMARY</td>    
    <td width='100' class='ctd padd bot'>Postponed<br/>and<br/>N/A</td>    
    <td width='100' class='ctd padd bot'>Total<br/>Under<br/>Calls</td>    
    <td width='100' class='ctd padd bot'>Correct<br/>Under<br/>Calls</td>    
    <td width='100' class='ctd padd bot'>Correct<br/>Under<br/>Calls %</td>    

    <td width='100' class='ctd padd bot'>Total<br/>Over<br/>Calls</td>    
    <td width='100' class='ctd padd bot'>Correct<br/>Over<br/>Calls</td>    
    <td width='100' class='ctd padd bot'>Correct<br/>Over<br/>Calls %</td>    

   </tr> 
  <tr bgcolor='#f4f4f4'>
    <td class='rtd padd bot'>PAW Total&nbsp;</td>
    <td class='ctd padd bot'><?php echo $postpond;?></td>
    
    <td class='ctd padd bot'><?php echo ($paw_t_under>0? $paw_t_under: "n/a");?></td>
    <td class='ctd padd bot'><?php echo ($paw_t_under>0? $paw_under : "n/a") ;?></td>
    
    <? if($paw_t_under>0){?>
       <td class='ctd padd bot'><?php echo num2( ($paw_under/ $paw_t_under)*100) ;?>%</td>
    <?}else{?>
      <td class='ctd padd bot'>n/a</td>
    <?}?>

    <td class='ctd padd bot'><?php echo ($paw_t_over>0? $paw_t_over : "n/a");?></td>
    <td class='ctd padd bot'><?php echo ($paw_t_over>0? $paw_over : "n/a") ;?></td>
    
    <? if($paw_t_over>0){?>
      <td class='ctd padd bot'><?php echo num2( ($paw_over/ $paw_t_over)*100) ;?>%</td>
    <?}else{?>
      <td class='ctd padd bot'>n/a</td>
    <?}?>

  </tr>
  <tr bgcolor='#f4f4f4'>
    <td class='rtd padd bot'>*Bookie Total&nbsp;</td>
    <td class='ctd padd bot'><?php echo $postpond + $nas;?></td>

    <td class='ctd padd bot'><?php echo ($bookie_t_under);?></td>
    <td class='ctd padd bot'><?php echo ($bookie_t_under>0? $bookie_under : "n/a") ;?></td>

    <? if($bookie_t_under>0){?>
      <td class='ctd padd bot'><?php echo num2( ($bookie_under/ ($bookie_t_under-$nas>0?$bookie_t_over-$nas:1) )*100) ;?>%</td>
    <?}else{?>
      <td class='ctd padd bot'>n/a</td>
    <?}?>

    <td class='ctd padd bot'><?php echo ($bookie_t_over) ;?></td>
    <td class='ctd padd bot'><?php echo ($bookie_t_over>0? $bookie_over : "n/a") ;?></td>
    <? if($bookie_t_over>0){?>
      <td class='ctd padd bot'><?php echo num2( ($bookie_over/ ($bookie_t_over-$nas>0?$bookie_t_over-$nas:1))*100) ;?>%</td>
    <?}else{?>
      <td class='ctd padd bot'>n/a</td>
    <?}?>

  </tr>

</table>


 <div style='text-align:center;font-size:10px;'>*Where the Bookie's lowest Odds dictate the Bookie's call.</div> 



<?}?>


	<div style="margin:15px;padding:8px;border:1px solid #ccc;font-size:13px;color:#0000ff;background:#f4f4f4;text-align:center;">
		<a class='sbar' href='javascript:window.close();'>Close Window</a>
	</div>


<?	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>