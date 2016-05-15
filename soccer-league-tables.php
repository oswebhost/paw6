<?php

$db= $_GET['db'];




require_once("config.ini.php");
require_once("function.ini.php");


if (!isset($_GET['congrp'])){
  $congrp = "ALL";
}else{
  $congrp = $_GET['congrp'];  
}




if (isset($_GET['season_value'])){

    $season_value  = $_GET['season_value'];
    $div_value = $_GET['div_value'];
}else{

    $season_value  = curseason($db);
    $div_value = "EP";

}


if ($season_value==curseason($db)){
  $mat_file = "matrix";
  $tab_file = "tabs"; 
}else{
  $mat_file = "old_matrix";
  $tab_file = "tabs"; 
}



$wk = max_tab_week($season_value,$db);

$page_title= (isset($_GET['db'])? s_title($db) : ""). " Soccer League Tables "  ;

if($_GET['div_value']){
  $page_title= divname($_GET['div_value']). " " . $_GET['season_value'] . " Soccer League Tables "  ;
}


$active_mtab = 1;

require_once("header.ini.php");


page_header("League Tables") ;


?>
  
<div style="padding-bottom:5px"></div>

<center>



<div style="padding-bottom:10px"></div>

<?php if(isset($_GET['db'])){ ?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?php echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?php echo site_other($db);?></div>
<div class='clear'></div>

<table  width="100%" align="center">
<tr>
  <td><a class='sbar' href="soccer-league-tables.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
  <td align="center"><span class='bot'></span></td>
  <td align="right"></td>
</tr>
</table>
<br />

<form method="get" action="<?php echo $PHP_SELF ?>">
    <input type="hidden" name="db" value="<?php echo $_GET['db'];?>" />
    
    <table border="0" cellpadding="0" cellspacing="0" style="border-collapse: collapse" bordercolor="#111111" width="90%">

<tr>
  <td width="130" ><b><font size="2" color="#0000FF">Season:</font></b><br>
  <select size="1" name="season_value" class="text" style='width:110px;font-size:12px;'>
  <option value="<?php echo curseason($db)?>"><?php echo curseason($db)?></option>

  <?php

    $sqry = "SELECT distinct(season) as season from old_tabs order by season desc" ;
    if ($db=='eu'){
        $temp = $eu->prepare($sqry);
        $arry_div = $arry_div_tables ;
    }else{
        $temp = $sa->prepare($sqry);
        $arry_div = $arry_div_sa;
    }
   
   $temp->execute();
   while ($sr = $temp->fetch()) : 
  ?>
    <option value="<?php echo $sr["season"] ?>" <?php echo selected($season_value,$sr["season"])?>><?php echo $sr["season"] ?></option>
  
  <?php endwhile; ?>
  </select>

  </td>
  <td  width="400" ><b><font size="2" color="#0000FF">Division:</font></b><br />
  <select size="1" name="div_value" class="text" style="width:260px;font-size:12px;">
      <?php for($_i=0; $_i<count($arry_div); $_i++){ ?>
           <option value="<?php echo $arry_div[$_i];?>" <?php echo selected($div_value, $arry_div[$_i]);?>><?php echo divname($arry_div[$_i]); ?></option>
       <?php } ?>
  </select>
  <input type="submit" value="View Data" name="B1" class="bt" style="padding: 3px;width:80px" />

  </td>
</tr> 

</table>
</form>

<div style="padding-bottom:10px"></div>

<?php }else{ 
    
    require_once("select-option.ini.php");
    
} ?>

<!-- startprint -->

<?php 



if (isset($season_value)){ 
  
     $pageURL ="?PARA=$div_value,$season_value";
?>     
<div style="padding-bottom:10px"></div>

<table border="0" cellpadding="8" cellspacing="0" style="border-collapse: collapse" bordercolor="#cccccc" width="570" bgcolor="#f4f4f4">
<tr>
<td width="20%" align="center"><span class="credit"><?php echo $season_value; ?></span></td>
<td  align="center"><span class="credit"><?php echo divname($div_value) ;?></span></td>
 <td width="20%" align="right"><?php echo printscr();?></td>
</tr>
</table>

<div style="padding-bottom:10px"></div>
<?php 

if ($div_value=="MLS" and $season_value>"2014"){
?> 
  <form method="get" action='soccer-league-tables.php'>
    <input type="hidden" name='div_value' value='<?php echo $div_value ;?>'>
    <input type="hidden" name='season_value' value='<?php echo $season_value ;?>'>
    <input type="hidden" name='db' value='<?php echo $db ;?>'>
  
  <div style="margin-bottom:10px;border:1px solid #ccc;padding:8px;background:#f4f4f4;font-size:12px;"> 
    <span class='bb'>Filter by:</span> 
    <input type="radio" name="congrp" value="ALL" <?php if($congrp=="ALL") echo "checked='checked'" ?> onclick="this.form.submit();">Combined Table
    <input type="radio" name="congrp" value="EC"  <?php if($congrp=="EC") echo "checked='checked'" ?>onClick="this.form.submit();">Eastern Conference
    <input type="radio" name="congrp" value="WC"  <?php if($congrp=="WC") echo "checked='checked'" ?>onClick="this.form.submit();">Western Conference
  </div>    
  </form>
  
<?php
}

echo table_header("Overall Table");

if ($tab_file=="old_tabs"):
  $qry = "select season, team, `div`, sum(hw+hd+hl+aw+ad+al) as tp,sum(hpoint+apoint) as points,sum(hw+aw) as w,sum(hd+ad) as d,sum(hl+al) as l, sum(hgf+agf) as gf,sum(hga+aga) as ga,sum((hgf+agf)-(hga+aga)) as gd,marked from $tab_file where `div`='$div_value' and season='$season_value'";
else:
  $qry = "select season, team, `div`, sum(hw+hd+hl+aw+ad+al) as tp,sum(hpoint+apoint) as points,sum(hw+aw) as w,sum(hd+ad) as d,sum(hl+al) as l, sum(hgf+agf) as gf,sum(hga+aga) as ga,sum((hgf+agf)-(hga+aga)) as gd,marked, congrp from $tab_file where `div`='$div_value' and season='$season_value' and weekno='$wk'";
endif;

if ($_GET['congrp'] == "WC" or $_GET['congrp']=='EC'){
  $qry .= " and `congrp`='" . $_GET['congrp'] . "' ";
}

$qry .=  "group by team order by points desc,gd desc, gf desc, team";


if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
$number=0;

while ($row = $temp->fetch()){
    $marked= find_deduction(trim($row["team"]), $season_value,$db);
    $number++;
?>
<tr <?php echo rowcol($number);?>>
    <td class='ctd s12'><?php echo $number;?></td>
    <td class='s12'><?php echo $row["team"] . ($marked=='1'?  printv(" *") :"")?></td>
    <td class='ctd s12'><?php echo $row["tp"];?></td>
    <td class='ctd s12'><?php echo $row["w"];?></td>
    <td class='ctd s12'><?php echo $row["d"];?></td>
    <td class='ctd s12'><?php echo $row["l"];?></td>
    <td class='ctd s12'><?php echo $row["gf"];?></td>
    <td class='ctd s12'><?php echo $row["ga"];?></td>
    <td class='ctd s12'><?php echo (int) ($row["gf"] - $row["ga"]) ;?></td>
    <td class='ctd s12'><?php echo $row["points"];?></td>
</tr>
<?php } ?>
</table>





<div style="padding-bottom:10px"></div>
<?php

echo table_header("Home Table only");

if ($tab_file=="old_tabs"):
  $qry = "select season,team,`div`,sum(hw+hd+hl) as tp,sum(hpoint) as points,sum(hw) as w,sum(hd) as d,sum(hl) as l,sum(hgf) as gf,sum(hga) as ga,sum(hgf-hga) as gd,marked from $tab_file where `div`='$div_value' and season='$season_value'";
else:
  $qry = "select season,team,`div`,sum(hw+hd+hl) as tp,sum(hpoint) as points,sum(hw) as w,sum(hd) as d,sum(hl) as l,sum(hgf) as gf,sum(hga) as ga,sum(hgf-hga) as gd,marked from $tab_file where `div`='$div_value' and season='$season_value' and weekno='$wk'";
endif;

if ($_GET['congrp'] == "WC" or $_GET['congrp']=='EC'){
  $qry .= " and `congrp`='" . $_GET['congrp'] . "' ";
}

$qry .=  "group by team order by points desc,gd desc, gf desc, team";



if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
$number=0;

while ($row = $temp->fetch()){
    $marked= find_deduction(trim($row["team"]), $season_value,$db);
    $number++;
?>
<tr <?php echo rowcol($number);?>>
    <td class='ctd s12'><?php echo $number;?></td>
    <td class='s12'><?php echo $row["team"] . ($marked=='1'?  printv(" *") :"")?></td>
    <td class='ctd s12'><?php echo $row["tp"];?></td>
    <td class='ctd s12'><?php echo $row["w"];?></td>
    <td class='ctd s12'><?php echo $row["d"];?></td>
    <td class='ctd s12'><?php echo $row["l"];?></td>
    <td class='ctd s12'><?php echo $row["gf"];?></td>
    <td class='ctd s12'><?php echo $row["ga"];?></td>
    <td class='ctd s12'><?php echo (int) ($row["gf"] - $row["ga"]) ;?></td>
    <td class='ctd s12'><?php echo $row["points"];?></td>
</tr>
<?php } ?>

</table>

<div style="padding-bottom:10px"></div>
<?php echo table_header("Away Table only");

if ($tab_file=="old_tabs"):
  $qry = "select season,team,`div`,sum(aw+ad+al) as tp,sum(apoint) as points,sum(aw) as w,sum(ad) as d,sum(al) as l,sum(agf) as gf,sum(aga) as ga,sum(agf-aga) as gd,marked from $tab_file where `div`='$div_value' and season='$season_value'";
else:
  $qry = "select season,team,`div`,sum(aw+ad+al) as tp,sum(apoint) as points,sum(aw) as w,sum(ad) as d,sum(al) as l,sum(agf) as gf,sum(aga) as ga,sum(agf-aga) as gd,marked from $tab_file where `div`='$div_value' and season='$season_value' and weekno='$wk'";
endif;

if ($_GET['congrp'] == "WC" or $_GET['congrp']=='EC'){
  $qry .= " and `congrp`='" . $_GET['congrp'] . "' ";
}

$qry .=  "group by team order by points desc,gd desc, gf desc, team";


if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
$number=0;

while ($row = $temp->fetch()){
    $marked= find_deduction(trim($row["team"]), $season_value,$db);
    $number++;
?>
<tr <?php echo rowcol($number);?>>
    <td class='ctd s12'><?php echo $number;?></td>
    <td class='s12'>    <?php echo $row["team"] . ($marked=='1'?  printv(" *") :"")?></td>
    <td class='ctd s12'><?php echo $row["tp"];?></td>
    <td class='ctd s12'><?php echo $row["w"];?></td>
    <td class='ctd s12'><?php echo $row["d"];?></td>
    <td class='ctd s12'><?php echo $row["l"];?></td>
    <td class='ctd s12'><?php echo $row["gf"];?></td>
    <td class='ctd s12'><?php echo $row["ga"];?></td>
    <td class='ctd s12'><?php echo (int) ($row["gf"] - $row["ga"]) ;?></td>
    <td class='ctd s12'><?php echo $row["points"];?></td>
</tr>
<?php } ?>

</table>
   

</center>

<?php } 

if ($DIV=='NC'): echo "<p style='font-size:10px;marign:0;padding:0;padding-left:50px;'>Ebbsfleet U - formerly Gravesend"; endif; 




$qry = "select * from deduction where season='$season_value' and `div`='$div_value' order by team";

if ($db=='eu'){
    $temp = $eu->prepare($qry);
}else{
    $temp = $sa->prepare($qry);
}

$temp->execute();


if ($temp->rowCount()>0):
?> 
 <div class='hypeboxRed' style="margin-top:0px;">
  <div class='div_topRed'></div>
    <div class='div_midRed' style="font-size:11px;text-align:left;padding-left:5px;"> 

<?php
  while ($d = $temp->fetch()):
    echo "<font color='red '>*</font> <B>$d[team]</B> $d[reason]  <br />";               
  endwhile;                              
?>

  </div>
    <div class='div_bottomRed'></div>
</div>
<?php
endif;


if( ($season_value=='2006-2007') and ($div_value=='SL') ):
?>
<div class='hypeboxRed' style="margin-top:0px;">
  <div class='div_topRed'></div>
    <div class='div_midRed' style="font-size:10px;text-align:left;padding-left:5px;"> 
   
  <ul style="padding:0;margin:0;">
  <li style="font-size:10px;text-align:left;padding-bottom:5px;">Teams receive three points for a win, one point for a draw and no points for a defeat.
  <li style="font-size:10px;text-align:left;padding-bottom:5px;">The bottom three teams will be automatically relegated.
  <li style="font-size:10px;text-align:left;padding-bottom:5px;">If teams finish level on points the team finishing higher will be the one with the best record in matches between the teams.
  <li style="font-size:10px;text-align:left;padding-bottom:5px;">If teams still cannot be separated then the team finishing higher will be the team with the best goal difference. 
  <li style="font-size:10px;text-align:left;padding-bottom:5px;">If teams still cannot be separated then the team finishing higher will be the team with the most goals scored. 
    </ul>

  </div>
    <div class='div_bottomRed'></div>
</div>

<?php endif; ?>

<!-- stopprint -->
<div style="padding-bottom:10px"></div>


<?php require_once("footer.ini.php"); 

function find_deduction($team, $season,$db){
    global $eu, $sa;
    
  $qry2 = "select * from deduction where season='$season' and `team`='$team'";
    if ($db=='eu'){
       $temp2 = $eu->prepare($qry2) ;
    }else{
       $temp2 = $sa->prepare($qry2);
    }
    $temp2->execute();
    return $temp2->rowCount();
}

?>
