<?php
session_start();
//include("authorization.php");
include("config.ini.php");

include("function.ini.php");

 $active_mtab = 1;
 
if (!isset($db)){
  $db = 'eu';
}else{
  $db= $_GET['db'];
}

if (!isset($_GET['season'])):
	$cur = curseason($db);
else:
	$cur = $_GET['season'];
endif;



if (isset($_GET['db'])){
  $page_title = "Soccer Double Chance Hit Rate " . s_title($db) . " Season $cur";
}else{
  $page_title = "Soccer Double Chance Hit Rate";
}



include("header.ini.php");
?>


<? page_header("Analysis of Previous Predictions") ; ?>

<? if (isset($_GET['db'])){ ?>
 
<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>


<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;padding-top:10px;padding-bottom:10px;">DOUBLE CHANCE HIT RATE</div>

<table  width="100%" align="center">
<tr>
	<td> <a class='sbar' href="analysis-of-previous-predictions.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"></td>
</tr>
</table>

<p>Each of the various Analysis Sheets viewable under this section will show you the "hit rate" associated with calling the "Double Chance" option for the posted predictions in respect of the Segregated Selection's Top 6  "1X2" calls.</p>
<br />

 <form method="get" action="double-chance.php" style="padding:0;margin:0;">
	  <input type="hidden" name="db" value="<?echo $_GET['db'];?>"/>
      
<table border="0" width="556"  align='center' cellpadding="3" style="border-collapse: collapse" bordercolor="#cccccc"  >

	<tr>
		 <td width="120"><b><font size="2" color="#0000FF">Season</font></b></td>
		 <td width='86%'><select size="1" name="season"  onChange="this.form.submit();">
           <? 
	
    		$sqry = "SELECT distinct(season) as season from cur_double order by season desc" ;
            if ($db=='eu'){
                $temp = $eu->prepare($sqry) ;
            }else{
                $temp = $sa->prepare($sqry);
            }
            $temp->execute();
    	   while ($sr = $temp->fetch()) : 
    	   ?>
    		  <option value="<?= $sr["season"] ?>" <?echo selected($cur, $sr["season"])?>><?= $sr["season"] ?></option>
    	  
    	   <? endwhile; ?>
      
		
		  </select>

		 </td>
		</tr>
		
		
	  </table> 
	  </FORM>
<br />

<table border="1" width="550" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:auto auto;" bordercolor="#D1D1D1" bgcolor="#F6F6F6">
	<tr bgcolor="#D3EBAB">
		<td><img src='images/tbcap/segtype.gif' border='0' alt='' /></td>
		<td><img src='images/tbcap/totalcalls.gif' border='0' alt='' /></td>
		<td><img src='images/tbcap/correctcalls.gif' border='0' alt='' /></td>
		<td><img src='images/tbcap/wasdraw.gif' border='0' alt='' /></td>
	  <td><img src='images/tbcap/cdcall.gif' border='0' alt='' /></td>
	  <td><img src='images/tbcap/hitrate.gif' border='0' alt='' /></td>
	</tr>
	
 <? 
		 
	
		 $qry= "select d.season, d.matchtype, d.bettype, sum(d.total_call) as totalcall ,sum(d.1st_correct) as col1, sum(d.2nd_correct) as col2, sum(d.total_correct) as col3, r.rank from cur_double d, ranking r where d.matchtype<>'N' and d.season='$cur' and d.matchtype=r.matchtype and d.bettype=r.bettype and (r.matchtype='H') group by d.bettype,d.matchtype order by r.rank" ;
		 if ($db=='eu'){
                $temp = $eu->prepare($qry) ;
            }else{
                $temp = $sa->prepare($qry);
            }
            $temp->execute();
		 $n=0;
		 $r=0;
		 while ($d = $temp->fetch() ) :				
			$n++; $r++;
			$string   = "<a class='sbar2' href='double-change-summary.php?db=$db&BET=" . $d['bettype'] .',' . $d['matchtype'] . ','. $cur . "'>";
		
			echo "<tr " . rowcol($n) . ">\n" ;
			echo "<td class='tdper'>$string" . match_bet($d['bettype'],$d['matchtype']) . "</a></td>" ;
			echo "<td class='ctd tdper'>" . num0($d["totalcall"]) . "</td>" ;
			
			if ($d['matchtype']=='D'):
				echo "<td class='ctd'>" . num0($d["col2"]) . "</td>" ;
				echo "<td class='ctd tdper'>" . num0($d['col1']) . "</td>" ;
			else:
				echo "<td class='ctd tdper'>" . num0($d["col1"]) . "</td>" ;
				echo "<td class='ctd tdper'>" . num0($d['col2']) . "</td>" ;
			endif;
			
			echo "<td class='ctd tdper'>" . num0($d["col3"]) . "</td>" ;

			if ($d["totalcall"]>0){
				echo "<td class='ctd tdper'><b>" . num2(($d["col3"]/$d["totalcall"])*100) . "%</b></td>" ;
			}else{
				echo "<td class='ctd tdper'></td>" ;
			}
		    echo "</tr>\n" ;

		
		endwhile;


		    echo "</table>" ;
	?>            


<?}else{?>
    
    <div class="report_blue_heading" style="width: 553px;margin:0 auto 5px auto;padding-top:10px;padding-bottom:10px;">DOUBLE CHANCE HIT RATE</div>
<?    
    include("select-option.ini.php");
    
} ?>

	  
<? include("footer.ini.php"); ?>
