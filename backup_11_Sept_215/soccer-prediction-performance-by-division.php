<? session_start();
 include("config.ini.php");

include("function.ini.php");

if (!isset($db)){
  $db = 'eu';
}else{
  $db= $_GET['db'];
}


if (!isset($_GET["season"])):
	$cur = curseason($db);
else:
	$cur = $_GET["season"];
endif;

$wk = cur_week($db);

if (isset($_GET['db'])){
    $page_title = "Prediction Performance By Division " . s_title($db) . " Season $cur"  ;
}else{
    $page_title = "Prediction Performance By Division"  ;
}

$active_mtab = 1;
include("header.ini.php");
?>


<? page_header("Prediction Performance Records") ; ?>
<div style="padding-bottom:5px"></div>

<? if (isset($_GET['db'])){ ?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>
<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">PREDICTIONS by DIVISION</div>

<table border="0" width="100%" cellpadding="0" cellspacing="0">
 <tr>
    <td width="25%"></td>

   <td width="25%" height="20" align='center' colspan='3' valign="bottom">
	
		
	 </td>
	<td width="25%" align="right"> <? echo printscr(); ?></td>
	</tr>
 </table>


         
<form method="get" action="<?=$PHP_SELF?>" style="padding:0;margin:0;"  >
   <input type="hidden" name="db" value="<?echo $_GET['db'];?>" />   
  <table border="0" width="100%"  align='center' cellpadding="3" style="border-collapse: collapse" bordercolor="#f4f4f"  >
  
	<tr>
	 <td width="20%" ><b><font size="2" color="#0000FF">Season</font></b></td>
	 <td>
		<select size="1" name="season" class="text" style="font-size:12px;width:120px;font-weight:bold;"  onChange="this.form.submit();">
	  <? 
	  
		$sqry = "SELECT distinct(season) as season from fixtures order by season desc";
        if ($db=='eu'){
           $temp = $eu->prepare($sqry) ;
        }else{
           $temp = $sa->prepare($sqry);
        }
        $temp->execute();
		 while ($sr =$temp->fetch()) : 
	  ?>
	      <option value="<?= $sr["season"] ?>" <?echo selected($cur,$sr["season"])?>><?= $sr["season"] ?></option>
	  
	  <? endwhile; ?>
	  </select>

	 </td>
	</tr>
</table>
</form>

			
	<? 
		 
    	 echo tb_header($type,'Result Type') ;
    	 if ($cur <> curseason($db)){
    		 $q= "select f.season, f.`div` as division, sum(f.mvalue) as totalm, sum(f.gotit) as correct, r.rank from fixtures f,ranking r where f.mvalue>0 and f.season='$cur' and f.`div`=r.matchtype and r.cat='fixt' group by division order by r.rank" ;
    	 }else{
    		 $q= "select f.season, f.`div` as division, sum(f.mvalue) as totalm, sum(f.gotit) as correct, r.rank from fixtures f,ranking r where f.mvalue>0 and f.season='$cur' and f.weekno<'$wk' and f.`div`=r.matchtype and r.cat='fixt' group by division order by r.rank" ;
    	 }
   
         
        if ($db=='eu'){
           $tempw = $eu->prepare($q) ;
        }else{
           $tempw = $sa->prepare($q);
        }
        $tempw->execute();
        
		 $n=0;
		 $r=0;
		 while ($d = $tempw->fetch() ) :				
			$n++; $r++;
			$div = $d['division'] ;
			$string   = "<a class='sbar' href='prediction-performance-by-divisison-list.php?PARA=" . $div . ','. $cur .",$db'>";
		
			echo "<tr " . rowcol($n) . ">\n" ;
			echo "<td>$string" . divname($div) . "</a> (" . $div . ")</td>" ;
			
            // Home calls	
            if ($cur <> curseason($db)){
             $q = "select f.season, f.`div` as division, sum(f.mvalue) as totalm, sum(f.gotit) as correct from fixtures f where f.mvalue>0 and f.season='$cur' and f.`div`='$div' and f.hgoal>f.agoal group by division" ;
            }else{
             $q = "select f.season, f.`div` as division, sum(f.mvalue) as totalm, sum(f.gotit) as correct from fixtures f where f.mvalue>0 and f.season='$cur' and f.weekno<'$wk' and f.`div`='$div' and f.hgoal>f.agoal group by division" ;
            }
            
            if ($db=='eu'){
               $temp = $eu->prepare($q) ;
            }else{
               $temp = $sa->prepare($q);
            }
            
            $temp->execute();
            $data = $temp->fetch();    
               
			 $home = num2(($data["correct"]/($data["totalm"]>0?$data["totalm"]:1))*100);
			
            
            // Draw calls	
            if ($cur <> curseason($db)){
             $q = "select f.season, f.`div` as division, sum(f.mvalue) as totalm, sum(f.gotit) as correct from fixtures f where f.mvalue>0 and f.season='$cur' and f.`div`='$div' and f.hgoal=f.agoal group by division" ;
            }else{
             $q = "select f.season, f.`div` as division, sum(f.mvalue) as totalm, sum(f.gotit) as correct from fixtures f where f.mvalue>0 and f.season='$cur' and f.weekno<'$wk' and f.`div`='$div' and f.hgoal=f.agoal group by division" ;
            }
            
            if ($db=='eu'){
             $temp = $eu->prepare($q) ;
            }else{
             $temp = $sa->prepare($q);
            }
            
            $temp->execute();
            $data = $temp->fetch();    
                
			 $draw = num2(($data["correct"]/($data["totalm"]>0?$data["totalm"]:1))*100);
			 

            // Away calls	
            if ($cur <> curseason($db)){
             $q = "select f.season, f.`div` as division, sum(f.mvalue) as totalm, sum(f.gotit) as correct from fixtures f where f.mvalue>0 and f.season='$cur' and f.`div`='$div' and f.hgoal<f.agoal group by division" ;
            }else{
              $q = "select f.season, f.`div` as division, sum(f.mvalue) as totalm, sum(f.gotit) as correct from fixtures f where f.mvalue>0 and f.season='$cur' and f.weekno<'$wk' and f.`div`='$div' and f.hgoal<f.agoal group by division" ;
            }
            if ($db=='eu'){
             $temp = $eu->prepare($q) ;
            }else{
             $temp = $sa->prepare($q);
            }
            
            $temp->execute();
            $data = $temp->fetch();    
            
            $away = num2(($data["correct"]/($data["totalm"]>0?$data["totalm"]:1))*100);
            
            if ($home > $away and $home > $draw):
             echo "<td align='center'><b>" . $home . "%</b></td>" ;
             echo "<td align='center'>". $draw  . "%</td>" ;
             echo "<td align='center'>" . $away  . "%</td>" ;
            
            elseif($draw > $home and $draw > $away ):
             echo "<td align='center'>" . $home . "%</td>" ;
             echo "<td align='center'><b>". $draw  . "%</b></td>" ;
             echo "<td align='center'>" . $away  . "%</td>" ;
            
            elseif($away > $home and $away > $draw):
             echo "<td align='center'>" . $home . "%</td>" ;
             echo "<td align='center'>". $draw  . "%</td>" ;
             echo "<td align='center'><b>" . $away  . "%</b></td>" ;
            else:
             echo "<td align='center'>" . $home . "%</td>" ;
             echo "<td align='center'>". $draw  . "%</td>" ;
             echo "<td align='center'>" . $away  . "%</td>" ;
            endif;





		    echo "</tr>\n" ;

		
		endwhile;


  echo "</table>" ;

?>


<div style='padding-top:5px;font-size:11px;'>(Our Division Codes)</div>

<br/><br/>
<div style='text-align:left'>
<b><font color="blue" style='padding-left:5px;'>Please take careful note of the following:</font></b>
</div>

<div style='padding-left:5px;padding-right:5px;overflow:auto;'>

<p style='font-size:10px;padding-top:8px'>
	In general we do far better with our predictions for Premier Divisions than with Minor Divisions. This is because the ability of the teams in the lower ranking Divisions is often far more erratic than in the higher Divisions. So please bear that in mind when you think about which matches to put your money on!

</div>

<?}else{
    echo '<div class="report_blue_heading">PREDICTIONS by DIVISION</div>';
    include("select-option.ini.php");
    
} ?>

<? include("footer.ini.php");

function tb_header($type,$rt)
{  global $SEASON,$db;
	$s=$lastweek-1;
	$X = cur_week($db) -1 ;
return ' 
<div style="padding-bottom:5px"></div>
<table border="1" width="100%" cellpadding="4" cellspacing="0" style="border-collapse: collapse" bordercolor="#D1D1D1" bgcolor="#F6F6F6">
	<tr bgcolor="#D3EBAB" height="20">
		<td width="300" align="center"><span class="credit">Division</span></td>
		<td width="80" style="text-align: center"><img src="images/tbcap/hsuc.gif" border="0"></td>
		<td width="80" style="text-align: center"><img src="images/tbcap/dsuc.gif" border="0"></td>
		<td width="80" style="text-align: center"><img src="images/tbcap/asuc.gif" border="0"></td>
	</tr>' ;

}



?>
