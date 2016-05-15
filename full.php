<?php

 session_start();
   //ob_end_clean();
   ob_start();
  


require_once("config.ini.php");
$java_ = -1 ;
require_once("function.ini.php");


$db = $_GET['db'];
$season_value = $_GET['season_value'];
$div_value= $_GET['div_value'];
$DIV      = $_GET['div_value'];


$cwk = cur_week($db);
$cur = curseason($db);

$qry = "SELECT * FROM fixtures WHERE `weekno`= '$cwk' and season='$cur' limit 1,1"; 
if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
while ($row =$temp->fetch()){
  $season  =$row["season"];
  $wdate   =$row["wdate"];
  $weekno  =$row["weekno"];
}



$pageURL ="?PARA=$DIV,$season_value";

$mat_file = ($season_value==curseason($db))? "matrix" : "old_matrix" ;
$tab_file = ($season_value==curseason($db))? "tabs" : "old_tabs" ;


$fix_url  = ($season_value==curseason($db))? "1" : "0" ;

if ($fix_url=='1'):
	$qry = "SELECT * FROM $mat_file WHERE `div`='$DIV' and season='$season_value' ";
else:
	$qry = "SELECT * FROM $mat_file WHERE `div`='$DIV' and season='$season_value' order by rid";
endif;



if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
}else{
   $temp = $sa->prepare($qry);
}
$temp->execute();
$num_of_rows = $temp->rowCount() ;



$data="";
$awayteams="";
$matrix_data="";
//<td width="60" class="matrix">Man U</td>
$number=0;
while ($row = $temp->fetch()):
 $DIV=$row["div"];
 $number++;
 $rowcol = rowcol($number);


	$awayteams.="<td width=\"65\" class=\"matrix2\" bgcolor=\"#A7B0BA\">" . $row["nicks"] ."</td>";
	$matrix_data.="<tr $rowcol height=\"12\" class='row'>";
	$matrix_data.="<td width=\"172\" class=\"matrixl\" style='padding:3px 1px;'>&nbsp;" .trim($row["team"])."</td>";
	// Column 1
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s1"]=="XX-XX"): $matrix_data.=" bgcolor=\"#005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s1"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 2
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s2"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s2"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 3
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s3"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s3"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 4
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s4"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s4"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 5
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s5"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s5"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 6
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s6"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s6"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 7
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s7"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s7"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 8
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s8"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s8"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 9
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s9"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s9"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 10
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s10"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s10"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 11
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s11"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s11"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 12
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s12"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s12"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 13
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s13"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s13"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 14
  
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s14"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s14"]) ;
	$matrix_data.= "</td>";
	endif;
	// Column 15
  if ($num_of_rows>=15){
  	$matrix_data.="<td width=\"65\" class=\"matrix\"";
  	if ($row["s15"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
    	$matrix_data.= ">";
    	$matrix_data.= trim($row["s15"]) ;
    	$matrix_data.= "</td>";
	endif;
  }
	// Column 16
  
   if ($num_of_rows>=16){
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s16"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s16"]) ;
	$matrix_data.= "</td>";
	endif;
  }
  
	// Column 17
  if ($num_of_rows>=17){

	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s17"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s17"]) ;
	$matrix_data.= "</td>";
  endif;
  }
  
	// Column 18
 if ($num_of_rows>=18){	
  $matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s18"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s18"]) ;
	$matrix_data.= "</td>";
	endif; 
	}
	
	if ($num_of_rows>=19):
		// Column 19
		$matrix_data.="<td width=\"65\" class=\"matrix\"";
		if ($row["s19"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
		$matrix_data.= ">";
		$matrix_data.= trim($row["s19"]) ;
		$matrix_data.= "</td>"; endif;
	endif;
  
	if ($num_of_rows>=20):
		// Column 20
		$matrix_data.="<td width=\"65\" class=\"matrix\"";
		if ($row["s20"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
		$matrix_data.= ">";
		$matrix_data.= trim($row["s20"]) ;
		$matrix_data.= "</td>";endif;
	endif;
	if ($num_of_rows>=21):
	// Column 21
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s21"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s21"]) ;
	$matrix_data.= "</td>";endif;
	// Column 22
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s22"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s22"]) ;
	$matrix_data.= "</td>";endif;
	if ($num_of_rows>22):

	// Column 23
	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s23"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s23"]) ;
	$matrix_data.= "</td>";endif;
	// Column 24
	if ($num_of_rows>23):

	$matrix_data.="<td width=\"65\" class=\"matrix\"";
	if ($row["s24"]=="XX-XX"): $matrix_data.=" bgcolor=\"005BB7\"><font color=\"#005bb7\">****</font></td>";else:
	$matrix_data.= ">";
	$matrix_data.= trim($row["s24"]) ;
	$matrix_data.= "</td>";endif;
	endif;
	endif;
	endif;

$matrix_data.="</tr>";
endwhile;



	  
?>
<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Soccer Results Matrix <?echo divname($DIV) . " Season $season_value" ;?></title>

<? page_header("Soccer Results Matrix") ; ?>
<BR>

<!-- startprint -->
<!--Info Box--->

<?php 
	 if ($season_value<>curseason($db)){
		week_box_only($season_value, divname($DIV),'98%');
	 }else{
	  	week_box_new(divname($DIV), $cwk, $wdate, $season_value,'98%'); 
	 }
?>

<div style="padding-bottom:8px"></div>

<!-- END OF Info Box--->

<!-- Results Grid --->
 <div align="center">
  
 <table border="3" cellspacing="0" cellpadding="2" style="border-collapse:  collapse" bordercolor="#A7B0BA" width="98%" >
 <tr>
    <td width="172" rowspan="2" bgcolor="#005BB7" class="matrix">
    <b><FONT COLOR="#FFFFFF">HOME TEAM</FONT></b></td>
    <td width="1380" class="matrix" colspan="<?php echo  $num_of_rows ?>" bgcolor="#005BB7">
    <b><FONT COLOR="#FFFFFF">A W A Y &nbsp;&nbsp;&nbsp; T E A M</FONT></b></td>
 </tr>
 <?php echo  $awayteams?> 
 <?php echo  $matrix_data ?>
 </table>
 </div>
 <div style="padding-bottom:5px"></div>

<!-- stopprint -->

<!-- END of Results Grid--->
<?php
if ($DIV=='NC'): echo "<font size='1' style='padding-left:10px;'>Ebbsfleet U - formerly Gravesend</font>"; endif; 
?>

<table  width="98%" align="center" border='0'>
<tr>
	<td width='95%' align='center'><a href="javascript:close()" class='sbar'>x Close this window x</a> </td> 
	<td align="right"> <?php echo  printscr(); ?></td>
</tr>
</table>


<!-- END OF other division box--->