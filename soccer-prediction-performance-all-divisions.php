<?php
	
require_once("config.ini.php");
require_once("function.ini.php");


if (!isset($_GET['db'])){
  $db = $_SESSION['db'];
}else{
  $db = $_GET['db'];
}

if (!isset($_GET['season'])):
	$cur = curseason($db);
else:
	$cur = $_GET['season'];
endif;

$wk = cur_week($db);


$pageURL = "?PARA=$cur";


$page_title = "Soccer Prediction Performance Records All Divisions Combined " . s_title($db) . " Season $cur";


$sql = " and `div`<>'SA' and `div`<>'FA' and `div`<>'IN' and `div`<>'EU' ";

$active_mtab = 1;

require_once("header.ini.php");

if (strlen($cur)==4){
	$db ="sa";
}else{
	$db = "eu";
}

page_header("Prediction Performance Records") ; 


?>
<style>
	#t1 {border-left:2px solid #555555; text-align:center;}
</style>
<div style="padding-bottom:5px"></div>
<!-- startprint -->

<?php if(isset($_GET['db'])){ ?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?php echo  site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?php echo  site_other($db);?></div>
<div class='clear'></div>
<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">Predictions ALL DIVISIONS COMBINED</div>

<table border="0" width="100%" cellpadding="0" cellspacing="0">
 <tr>
    <td width="25%"><?php echo back();?></td>

   <td width="25%" height="20" align='center' colspan='3' valign="bottom">
	
		
	 </td>
	<td width="25%" align="right"> <?php echo  printscr(); ?></td>
	</tr>
 </table>
 
 
 <form method="get" action="<?php echo $PHP_SELF?>" style="padding:0;margin:0;"  >
  <input type="hidden" name="db" value="<?php echo  $_GET['db'];?>" />   
	  
	  <table border="0" width="100%"  align='center' cellpadding="3" style="border-collapse: collapse" bordercolor="#f4f4f"  >
	  
		<tr>
		 <td width="10%" ><b><font size="2" color="#0000FF">Season</font></b></td>
		 <td width="80%">
			<select size="1" name="season" class="text" style="font-size:12px;width:150px;font-weight:bold;"  >
		  <?php
		  
			$sqry = "SELECT distinct(season) as season from fixtures order by season desc" ;
			
            if ($db=='eu'){
               $temp = $eu->prepare($sqry) ;
            }else{
               $temp = $sa->prepare($sqry);
            }
            $temp->execute();
              
			 while ($sr = $temp->fetch()) : 
		  ?>
		      <option value="<?php echo  $sr["season"] ?>" <?php echo  selected($cur,$sr["season"])?>><?php echo  $sr["season"] ?></option>
		  
		  <?php endwhile; ?>
		  </select>

		 </td>
		  <td class='rtd'><b><font size="2" color="#0000FF">Division</font></b></td>
              <td colspan='2' >
               <select size="1" name="DIV" class="text" style="width:220px; padding:3px;" onChange="this.form.submit();">

                    <?php if($db=='eu'){ ?>
            		    
                        
                        <option value="0" <?php echo  selected($_GET['DIV'],'0')?>>UK/European Premier Divisions</option> 
                        <option value="1" <?php echo  selected($_GET['DIV'],'1')?>>UK/European Major Divisions</option> 
                        <option value="2" <?php echo  selected($_GET['DIV'],'2')?>>UK Minor Divisions</option> 
						
						<option value="100" <?php echo  selected($_GET['DIV'],'100')?>>All Divisions</option>
                        
                        <optgroup label="One Division Only">
                  			<?php for($_i=0; $_i<count($arry_div); $_i++){ ?>
                  			  <?php if($_i<>4 and $_i<>9 and $_i<>18){ ?>
                  					<option value="<?php echo  $arry_div[$_i];?>" <?php echo  selected($_GET['DIV'], $arry_div[$_i]);?>><?php echo  divname($arry_div[$_i]); ?></option>
                  			   <?php } ?>
                  			<?php } ?>
                    
                     <?php } ?>
                     </optgroup>  
                    <?php if($db=='sa'){ ?>
                  		    <option value="0" <?php echo  selected($_GET['DIV'],'0')?>>All Divisions</option> 
                  			<?php for($_i=0; $_i<count($arry_div_sa); $_i++){ ?>
                  				<option value="<?php echo  $arry_div_sa[$_i];?>" <?php echo  selected($_GET['DIV'], $arry_div_sa[$_i]);?>><?php echo  divname($arry_div_sa[$_i]); ?></option>
                  			<?php } ?>
                     <?php } ?>
        
        			</select>
              
              </td>
		</tr>
</table>
</form>
<?php 

echo tb_header( strtoupper($season)) ; 

if ($cur == curseason($db)) {
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$cur' and weekno<'$wk' ";
}else{
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$cur' ";
}

//default divisions
$_divs = " and `div` IN ('EP','SP','FL','GB','G0','HK','IS','P0','SL','T0') "; 

if (!isset($_GET['DIV'])){
	$_GET['DIV'] = 0 ;
}
	
 switch ($_GET['DIV']){
			
	case '100': $_divs = " "; break;
	case '0': $_divs = " and `div` IN ('EP','SP','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
	case '1': $_divs = " and `div` IN ('EP','C0','C1','C2','SP','S1','S2','S3','FL','GB','G0','HK','IS','P0','SL','T0') "; break;
	case '2': $_divs = " and `div` IN ('NC', 'UP', 'RP', 'MP') "; break;
	default: $_divs = " and `div` = '" . $_GET['DIV'] . "' "; break;
}

$q .= " group by weekno order by weekno";




if ($db=='eu'){
   $tempw = $eu->prepare($q) ;
}else{
   $tempw = $sa->prepare($q);
}
$tempw->execute();

$data=''; $ht=0; $hc=0; $at=0; $ac=0; $dt=0; $dc=0;


$n=1;

$mywin = "mywin";
$window ='<a class="pp" href="javascript:sele_win(';
$window .= "'" ;
$seleURL = "cur_freedetails-all.php?PARA=$cur," ;

while ($d = $tempw->fetch() ):

	$cwk = $d["weekno"];
	if ($cwk>$last+1):
		for ($j=$last+1; $j<$cwk; $j++) :
			$data .= blank_line($j,'-');
		endfor;
	endif;



	$rowcol = rowcol($d["weekno"]);
	$data .= "<tr $rowcol>\n";
	
	$x	  = $window . $seleURL . $d["weekno"]. ",$db,$_GET[DIV]')\">" ;
	$data .= "<td align='center'>\n $x" . num0($d[weekno]) . "</a></td>\n"; 

	// homes
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$cur' and weekno='$cwk' and hgoal>agoal $sql $_divs group by weekno order by weekno";
	
	

	
	
    if ($db=='eu'){
       $temp = $eu->prepare($q) ;
    }else{
       $temp = $sa->prepare($q);
    }
    $temp->execute();	
    $dr = $temp->fetch();
	
	if ($dr['totalm']>0){
		$data .= "<td align='center' id='t1'>$window" . $seleURL . $cwk . ",$db,$_GET[DIV],H')\") style='font-size:11px;'>" . num0($dr[totalm]) . "</a></td>\n"; 
	}else{
		$data .= "<td align='center' id='t1'>0</td>\n"; 
	}

	$data .= "<td align='center'>\n" . num0($dr[correct]) . "</td>\n";
	$data .= "<td align='center'>\n<b>". num2(($dr[correct]/($dr[totalm]>0?$dr[totalm]:1))*100) . "%</b></td>\n";

	$ht += $dr["totalm"]; $hc += $dr["correct"];

	// Draws
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$cur' and weekno='$cwk' and hgoal=agoal $sql  $_divs group by weekno order by weekno";
	
   if ($db=='eu'){
       $temp = $eu->prepare($q) ;
    }else{
       $temp = $sa->prepare($q);
    }
    $temp->execute();	
    $dr = $temp->fetch();

	if ($dr['totalm']>0){
		$data .= "<td align='center' id='t1'>$window" . $seleURL . $cwk . ",$db,$_GET[DIV],D')\") style='font-size:11px;'>" . num0($dr[totalm]) . "</a></td>\n"; 
	}else{
		$data .= "<td align='center' id='t1'>0</td>\n"; 
	}

	$data .= "<td align='center'>\n" . num0($dr[correct]) . "</td>\n";
	$data .= "<td align='center'>\n<b>". num2(($dr[correct]/($dr[totalm]>0?$dr[totalm]:1))*100) . "%</b></td>\n";

	$dt += $dr["totalm"]; $dc += $dr["correct"];

	// Away
	$q = "select weekno, sum(mvalue) as totalm, sum(gotit) as correct from fixtures where mvalue>0 and season='$cur' and weekno='$cwk' and hgoal<agoal $sql  $_divs group by weekno order by weekno";
	
	
	
   if ($db=='eu'){
       $temp = $eu->prepare($q) ;
    }else{
       $temp = $sa->prepare($q);
    }
    $temp->execute();
	$dr = $temp->fetch();

	if ($dr['totalm']>0){
		$data .= "<td align='center' id='t1'>$window" . $seleURL . $cwk . ",$db,$_GET[DIV],A')\") style='font-size:11px;'>" . num0($dr[totalm]) . "</a></td>\n"; 
	}else{
		$data .= "<td align='center' id='t1'>0</td>\n"; 
	}

	$data .= "<td align='center'>\n" . num0($dr[correct]) . "</td>\n";
	$data .= "<td align='center'>\n<b>". num2(($dr[correct]/($dr[totalm]>0?$dr[totalm]:1))*100) . "%</b></td>\n";
	$at += $dr["totalm"]; $ac += $dr["correct"];

	$data .= "</tr>\n";
	$last = $cwk ;
	$n++;
	

endwhile;

for ($i=$cwk+1; $i<43; $i++):
	$data .= blank_line($i,'');
endfor;

echo $data ;
echo "<tr height='25'>\n";
echo "<td align='center'>\n<span class='credit'>Total</span></td>\n";
echo "<td align='center'  id='t1'>\n<span class='credit'>". num0($ht) ."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num0($hc)."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num2(($hc/($ht>0?$ht:1))*100) . "%</span></td>\n";

echo "<td align='center'  id='t1'>\n<span class='credit'>". num0($dt) ."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num0($dc)."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num2(($dc/($dt>0?$dt:1))*100) . "%</span></td>\n";

echo "<td align='center'  id='t1'>\n<span class='credit'>". num0($at) ."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num0($ac)."</span></td>\n";
echo "<td align='center'>\n<span class='credit'>". num2(($ac/($at>0?$at:1))*100) . "%</span></td>\n";

echo "</tr>\n";
echo "</table>\n" ;

echo '<!-- stopprint --><div style="padding-bottom:10px"></div>';

}else{
    echo '<div class="report_blue_heading">Predictions All Divisions combined</div>';
    require_once("select-option.ini.php");
    
} 

require_once("footer.ini.php");	

function tb_header($caption) 
{
return '
<table border="1" width="100%" align="center" cellpadding="2" cellspacing="0"  style="border-collapse: collapse" bordercolor="#D1D1D1" bgcolor="#F6F6F6">

	<tr bgcolor="#D3EBAB" height="20">
		<td rowspan="2" align="center" ><b>Week No<b></td>
		<td colspan="3" align="center" id="t1"><b>Home Win Calls</b></td>
		<td colspan="3" align="center" id="t1"><b>Draw Calls</b></td>
		<td colspan="3" align="center" id="t1"><b>Away Win Calls</b></td>
	</tr>
	<tr bgcolor="#D3EBAB" height="20">
		<td align="center"  id="t1"><img src="images/tbcap/total.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/correct.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/success.gif" border="0"></td>
		<td align="center"  id="t1"><img src="images/tbcap/total.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/correct.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/success.gif" border="0"></td>
		<td align="center"  id="t1"><img src="images/tbcap/total.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/correct.gif" border="0"></td>
		<td align="center" ><img src="images/tbcap/success.gif" border="0"></td>
 	</tr>';
}

function blank_line($start_week,$ch)
{
    $rowcol = rowcol($start_week);
	$data .= "<tr $rowcol >\n";
	$data .= "<td align='center' >\n$start_week</td>\n"; 
	$data .= "<td align='center' id='t1'>$ch\n</td>\n"; 
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'  id='t1'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center' id='t1'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";
	$data .= "<td align='center'>$ch\n</td>\n";

	$data .= "</tr>\n";

	return $data;
}