<?php
session_start();

include("config.ini.php");

include("function.ini.php");

if (!isset($db)){
  $db = 'eu';
}else{
  $db= $_GET['db'];
}

if (!isset($_GET['season'])):
  $cur = curseason($db);
else:
  $cur = $season;
endif;
 
if (isset($_GET['db'])){
  $page_title = "Soccer Double Chance Bets Outcome ". s_title($db) . " $cur";
}else{
  $page_title = "Soccer Double Chance Bets Outcome";
}

$active_mtab = 1;
include("header.ini.php");




?>


<? page_header("Analysis of Previous Predictions") ; ?>

<!-- startprint -->

<div style="padding-bottom:5px"></div>


<? if (isset($_GET['db'])){ ?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>


<div style="padding-bottom:5px"></div>
<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">DOUBLE CHANCE BETTING OUTCOME</div>
<table  width="100%" align="center">
<tr>
	<td> <a class='sbar' href="analysis-of-previous-predictions.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"></td>
</tr>
</table>
<p>Each of the various Analysis Sheets viewable under this section will show you the running financial outcome to date of betting on the "Double Chance" option for the posted predictions in respect of the Segregated Selection's Top 6 "1X2" calls.</p>


<div style="padding-bottom:10px"></div>


 <form method="POST" action="double-chance-bet.php" style="padding:0;margin:0;">
    <input type='hidden' name='db' value='<?php echo $_GET['db'];?>' />

    <table border="0" width="100%"  align='center' cellpadding="3" style="border-collapse: collapse" bordercolor="#cccccc"  >
    <tr>
     <td width="20%" ><b><font size="2" color="#0000FF">Season</font></b></td>
     <td>
      <select size="1" name="season" class="text" style="width:90px;" onChange="this.form.submit();">
      <? 
       
        $sqry = "SELECT distinct(season) as season from cur_double_bet order by season desc";
        
        if ($db=='eu'){
             $temp = $eu->prepare($sqry) ;
        }else{
            $temp = $sa->prepare($sqry);
        }
        $temp->execute();
              
       while ($sr = $temp->fetch()) : 
      ?>
          <option value="<?= $sr["season"] ?>" <?echo selected($cur,$sr["season"])?>><?= $sr["season"] ?></option>
      
      <? endwhile; ?>
      </select>

     </td>
    </tr>
    
  
    </table> 
    </FORM>
    
    <br/>
    
  <table border="1" width="550" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#D1D1D1" bgcolor="#F6F6F6">
  <tr bgcolor="#D3EBAB">
    <td><img src='images/tbcap/segtype.gif' border='0' alt='' /></td>
    <td><img src='images/tbcap/totalcalls.gif' border='0' alt='' /></td>
    <td><img src='images/tbcap/correctcalls.gif' border='0' alt='' /></td>
    <td><img src='images/tbcap/wasdraw.gif' border='0' alt='' /></td>
    <td><img src='images/tbcap/cdcall.gif' border='0' alt='' /></td>
    <td><img src='images/tbcap/corectper.gif' border='0' alt='' /></td>
    <td><img src='images/tbcap/netreturnunit.gif' border='0' alt='' /></td>
  </tr>
    
   <? 
     $q= "select d.season, d.matchtype, d.bettype, sum(d.total_call) as totalcall ,sum(d.1st_correct) as col1, sum(d.2nd_correct) as col2, sum(d.total_correct) as col3, sum(odd_return) as odds, r.rank from cur_double_bet d, ranking r where d.matchtype<>'N' and d.season='$cur' and d.matchtype=r.matchtype and d.bettype=r.bettype and r.matchtype='H' group by d.bettype,d.matchtype order by r.rank" ;
        
      if ($db=='eu'){
             $temp = $eu->prepare($q) ;
      }else{
            $temp = $sa->prepare($q);
      }
      $temp->execute();     

     $n=0;
     $r=0;
     while ($d = $temp->fetch() ) :        
      $n++; $r++;
      $string   = "<a class='sbar2' href='double-change-bet-summary.php?BET=" . $d['bettype'] .',' . $d['matchtype'] . ','. $cur . ",$db'>";
    
      echo "<tr " . rowcol($n) . ">\n" ;
      echo "<td class='tdper padd'>$string" . match_bet($d['bettype'],$d['matchtype']) . "</a></td>" ;
      echo "<td class='tdper ctd'>" . num0($d["totalcall"]) . "</td>" ;
      
      if ($d['matchtype']=='D'):
        echo "<td class='tdper ctd'>" . num0($d["col2"]) . "</td>" ;
        echo "<td class='tdper ctd'>" . num0($d['col1']) . "</td>" ;
      else:
        echo "<td class='tdper ctd'>" . num0($d["col1"]) . "</td>" ;
        echo "<td class='tdper ctd'>" . num0($d['col2']) . "</td>" ;
      endif;
      
      echo "<td class='tdper ctd'>" . num0($d["col3"]) . "</td>" ;

      echo "<td class='tdper ctd'>" . num2( ($d["col3"]/($d['totalcall']>1?$d['totalcall']:1))*100) . "%</td>" ;

      echo "<td class='tdper ctd'><b>" . num20($d["odds"]-$d["totalcall"]) . "</b></td>" ;
      echo "</tr>\n" ;

    
    endwhile;


        echo "</table>" ;
  ?>          

<?}else{
    
    echo '<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">DOUBLE CHANCE BETTING OUTCOME</div>';
    include("select-option.ini.php");
    
} ?>
 <!-- stopprint -->
 
<? include("footer.ini.php");?>
