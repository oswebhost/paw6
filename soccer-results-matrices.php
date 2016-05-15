<?php


    if (!isset($fullname) or !isset($userid)):
		//header('Location: nologfree.php');
		//exit;
	endif;

require_once("config.ini.php");

require_once("function.ini.php");



$page_title ="Soccer Results Matrices";

$page_title= (isset($_GET['db'])? s_title($db) : ""). " Soccer Results Matrices "  ;

if($_GET['div_value']){
  $page_title= divname($_GET['div_value']). " " . $_GET['season_value'] . " Soccer Results Matrices "  ;
}





$db= $_GET['db'];


 $cwk = cur_week($db);
 $sea = curseason($db);
 $qry = "SELECT * FROM fixtures WHERE `weekno`= '$cwk' and season='$sea' limit 1,1"; 
 
if ($db=='eu'){
    $temp = $eu->prepare($qry) ;
}else{
    $temp = $sa->prepare($qry);
}

$temp->execute();

while ($row = $temp->fetch()){
	$season  =$row["season"];
	$wdate   =$row["wdate"];
	$weekno  =$row["weekno"];
}

$active_mtab = 1;

require_once("header.ini.php");

?>


<?php page_header("Results Matrices") ; ?>
<div style="padding-bottom:5px"></div>

<?php if(isset($_GET['db'])){ ?>
<div class="report_blue_heading" style="float:left;width: 320px;"><?php echo  site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?php echo  site_other($db);?></div>
<div class='clear'></div>

<table  width="100%" align="center">
<tr>
	<td><a class='sbar' href="soccer-results-matrices.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"></td>
</tr>
</table>
<br />


<?php week_box_nocap($weekno, $wdate, curseason($db),560); ?>




<div style="padding-bottom:10px"></div>

<center>

  <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111"  width="90%"  >
	  	<form name="ThisForm" method="get" action="full.php" onSubmit="popup(this)" style='padding:0;margin:0;'> 
			<input type="hidden" name="showpage" value='1' />
            <input type="hidden" name="db" value='<?php echo  $_GET['db'];?>' />
		<tr>
		  <td width="90" ><b><font size="2" color="#0000FF">Season:</font></b><br>
        	 <select size="1" name="season_value" class="text" style='width:110px;font-size:12px;'>
        	<option value="<?php echo  curseason($db)?>"><?php echo  curseason($db)?></option>
        
              <?php
                $sqry = "SELECT distinct(season) as season from old_tabs order by season desc" ;
                if ($db=='eu'){
                    $temp = $eu->prepare($sqry);
                     $arry_div = $arry_div_tables;
                }else{
                    $temp = $sa->prepare($sqry);
                     $arry_div = $arry_div_sa;
                }
               
               $temp->execute();
               while ($sr = $temp->fetch()) : 
              ?>
            	  <option value="<?= $sr["season"] ?>" <?php echo  selected($season_value,$sr["season"])?>><?= $sr["season"] ?></option>
              
              <?php endwhile; ?>
              </select>
            
              </td>
              <td  width="400" ><b><font size="2" color="#0000FF">Division:</font></b><br />
              <select size="1" name="div_value" class="text" style="width:260px;font-size:12px;">
                  <?php for($_i=0; $_i<count($arry_div); $_i++){ ?>
                            <option value="<?php echo  $arry_div[$_i];?>" <?php echo  selected($div_value, $arry_div[$_i]);?>><?php echo  divname($arry_div[$_i]); ?></option>
                   <?php } ?>
              </select>
              <input type="submit" value="View Data" name="B1" class="bt" style="padding: 3px;width:80px" />

		  </td>
		</tr>	</form>
	  </table>
</center>
<?php }else{
    
    require_once("select-option.ini.php");
    
} ?>

<?php

  require_once("footer.ini.php"); 
?>
