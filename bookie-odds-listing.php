<?php
session_start();
include("config.ini.php");
include("function.ini.php");


$parts = explode(',',$_GET['PARA']) ;
$callfor = $parts[0] ;
$periodpara= $parts[1] ;
$weekno  = $parts[2] ;
$sea = $parts[3];
$db = $parts[4];

$show_data = 1;
$odd_max_diff = 20;


if ($sas == curseason($db) and $weekno == cur_week($db)){
    
    $show_data = 0;
}

$errlog = "";

 
switch ($periodpara)
  {
    case 1: $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
    case 2: $period = " and weekday(f.match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
    case 3: $period = " and weekday(f.match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;
  }
  
 

if ($callfor=="1"):
	$query1 = "SELECT f.wdate, f.hwinpb as probs, f.mid,f.weekno,f.`div`,f.mdate,f.hteam,f.ateam,f.hgoal,f.agoal,f.h_odd,f.d_odd,f.h_s,f.a_s, f.gotit, f.mvalue,f.a_odd,f.match_time, ((f.a_odd/f.h_odd)-1)*100 as diff, r.rank  FROM fixtures f, ranking r WHERE
			f.weekno='$weekno' and f.season='$sea' and f.h_odd>0 and f.`div`=r.matchtype and r.cat='bk' $period ORDER BY  f.h_odd, r.rank";
	
    $cap = "Against Bookies' Home Win Expectations";
	$ordered = 1;			

elseif($callfor=="2"):
	$query1 = "SELECT f.wdate,f.hwinpb as probs, f.mid,f.weekno,f.`div`,f.mdate,f.hteam,f.ateam,f.hgoal,f.agoal,f.h_odd,f.h_odd,f.h_s,f.a_s, f.gotit, f.mvalue,f.d_odd,f.a_odd,f.match_time, 
		((f.a_odd/f.h_odd)-1)*100 as hwin, ((f.h_odd/f.a_odd)-1)*100 as awin, abs(f.h_odd-f.a_odd) as dodd, r.rank FROM fixtures f, ranking r WHERE
			f.weekno='$weekno' and f.season='$sea' and f.h_odd>0 and f.`div`=r.matchtype and r.cat='bk' $period ORDER BY f.d_odd, dodd, f.match_date,f.match_time,f.`div`, f.hteam,f.ateam";
	$cap = "Against Bookies' Draw Expectations";
	$ordered = 2;	

elseif($callfor=="3"):
	$query1 = "SELECT f.wdate,f.awinpb as probs,f.mid,f.weekno,f.`div`,f.mdate,f.hteam,f.ateam,f.agoal,f.hgoal,f.h_s,f.a_s, f.gotit, f.mvalue,f.h_odd,f.h_odd,f.d_odd,f.a_odd,f.match_time, ((f.h_odd/f.a_odd)-1)*100 as diff, r.rank FROM fixtures f, ranking r WHERE
			f.weekno='$weekno' and f.season='$sea' and f.h_odd>0 and f.`div`=r.matchtype and r.cat='bk' $period ORDER BY f.a_odd";
	$cap = "Against Bookies' Away Win Expectations";
	$ordered = 3;

endif;  


  
 if ($db=='eu'){
   $temp = $eu->prepare($query1) ;
 }else{
   $temp = $sa->prepare($query1);
 }
 $temp->execute();


   $data="";
   
   if ($temp->rowCount() == 0):
	  $data ="<tr><td colspan='11' align='center' style='padding:50px;'><span class='error'>No Matches This Week</span></td></tr>";
   endif;
   $pic = "/pic/" ;
   $pic =  $weekno ."/pic";
	$ngot =0;
   $number=0;
	

	$book_ex_hw = 0; $book_ex_aw = 0; $book_ex_dr = 0; $book_pp = 0;
	$paw_ex_hw  = 0; $paw_ex_aw  = 0; $paw_ex_dr  = 0; $paw_pp  = 0;
	$actal_hw   = 0; $actal_aw   = 0; $actal_dr   = 0; $actal_pp= 0;

	$book_cr_hw = 0; $book_cr_aw = 0; $book_cr_dr = 0;
	$paw_cr_hw  = 0; $paw_cr_aw  = 0; $paw_cr_dr  = 0;


	while ($row = $temp->fetch() ):
	 $wdate  = $row['wdate'];
	if ($callfor<>'2'):
	   	if ($row["diff"]>$odd_max_diff):	
		   $number++;
		   $rowcol = rowcol($number);
		   $char = printv('v');
		   $matchno = trim($row["mid"]);
		   if ($matchno>0 and trim($row["hgoal"])!="N" and  ($DIV<>'FA') and ($DIV<>'IN') and ($DIV<>'SA')) :
			   $picurl = $pic . $matchno  . ".htm";
			   $mywin = "mywin" . $matchno;
			   $window ='<a title="Click to view PIC"  href="javascript:PicWin(';
			   $window .= "'" . $picurl ."'" ;
			   $window .= ')">';
		   else:
					$window="";
		   endif;
		  
		   if (  ($DIV=='SC')) :
				$window="";
				$h_team = explode("(",$row["hteam"]) ;
				$h_team = $h_team[0] ;

				$a_team = explode("(",$row["ateam"]) ;
				$a_team = $a_team[0] ;
		   else:
				$h_team = $row["hteam"] ;
				$a_team = $row["ateam"] ;
		   endif ;

		 $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?DIV=' . $row["div"] .'">';
		  $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno')\">";
		  $data.="<tr>";
		  $data.="<td  $rowcol style=\"text-align: center\" height=\"12\">";
		  $data.= "$number</td>";
		 

		   $data.="<td  $rowcol style=\"text-align: center\" height=\"12\">";
		 $div_value = $row["div"];

        if ( $sea == curseason() ){ 	
    		  $data.=  $row["mdate"]. "&nbsp;<font size='1'>" . substr($row['match_time'],0,5) . "</font></td>";
        }else{
            $data.=  $row["mdate"]. "&nbsp;<font size='1'>" . substr($row['match_time'],0,5) . "</font></td>";
    	
        }

		$data.= "<td $rowcol  width=\"38%\" style=\"text-align: left\">";
		//$data.= '&nbsp;<a title="Results to Date" class=md href="teamfixt.php?TEAM='. $row["hteam"] .'">';
		$data.= trim($row["hteam"]) . "</a>";
		$data.= "&nbsp;<FONT cOLOR=\"#FF0000\">v</FONT> ";
		//$data.= '<a title="Results to Date"  class=md href="teamfixt.php?TEAM='. $row["ateam"] .'">';
		$data.= trim($row["ateam"]) ."</a></td>";


		$data.= "<td $rowcol class='ctd'>" . $row["div"] . "</td>\n";
		$data.= "<td " . ($ordered==1? "bgcolor='#D3EBAB'" : $rowcol) ." style=\"text-align: center\">";
		$data.= show_odd($row["h_odd"]) . "</td>";

		$data.= "<td " . ($ordered==2? "bgcolor='#D3EBAB'" : $rowcol) ." style=\"text-align: center\">";
		$data.= show_odd($row["d_odd"]) . "</td>";

		$data.= "<td " . ($ordered==3? "bgcolor='#D3EBAB'" : $rowcol) ." style=\"text-align: center\">";
		$data.= show_odd($row["a_odd"]) . "</td>";

		$overround=0;
		$overround = ((1/$row["h_odd"]) + (1/$row["d_odd"]) + (1/$row["a_odd"]) -1) *100 ;
		$data .= "<td $rowcol class='ctd'>" . num2($overround) . "%</td>\n";

		$data .= "<td $rowcol class='ctd'>" . $row['probs'] . "</td>\n";
		    
		  $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
		  $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;

		 if (asl_pr_team($row["hteam"],$row["ateam"],$sea,$db)) :

		    if ($asl==$act){
		      $data .= "<td bgcolor='#C1FF84' style=\"text-align: center\" $rowcol ><font color='#999'><b><i>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</i></b></font></td>";
	        }else{
				if ($row["gotit"]=="1") {
			    	 $data.= "<td  style=\"text-align: center\" $rowcol ><font color='#999'><b><i>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</i></b></font></td>";
				}else{

			    	 $data.= "<td  style=\"text-align: center\" $rowcol ><font color='#999'><i>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</i></font></td>";
				}
		  	}	

			 else:
		     if ($asl==$act){
			    $data.= "<td   bgcolor='#C1FF84' style=\"text-align: center\" $rowcol><b>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</b></td>";
			  }else{
				  if ($row["gotit"]=="1"){
					$data.= "<td  style=\"text-align: center\" $rowcol><b>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</b></td>";
				  }else{
					  $data.= "<td  style=\"text-align: center\" $rowcol>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</td>";
				  }
			 }
		  endif;

		 if (strlen($act)>1){
			$data.= "<td  style=\"text-align: center\" $rowcol><a class='sbar' href=\"javascript:tell('full_odds.php?id=$row[mid]&site=$db')\">" . trim($row["h_s"] . ' - ' . $row["a_s"]) ."</a></td>";
		  }else{
			$data.= "<td style=\"text-align: center\" $rowcol><a class='sbar' href=\"javascript:tell('full_odds.php?id=$row[mid]&site=$db')\">Odds</a></td>";
		 }

		  $data.= "</tr>";
		  $ngot += $row['gotit'] ;


			// bookie exp
				if ($row["h_odd"]<=$row["a_odd"]){ 
					$book_ex_hw += 1; 
					if ($row["h_s"]>$row["a_s"]) { $book_cr_hw += 1; }

				}   

				if ($row["a_odd"]<=$row["h_odd"]){ 
					$book_ex_aw += 1; 
					if ($row["a_s"]>$row["h_s"]) { $book_cr_aw += 1; }
				}

			// paw exp
			  if ($row["h_s"]=="P"){
				$paw_pp++;
			  }else{
				if ($row["hgoal"]>$row["agoal"]){ 
					$paw_ex_hw  += 1; 
					if ( ($row["h_s"]>$row["a_s"]) and $row["gotit"]=="1" ) { $paw_cr_hw += 1; }
				}  

				if ($row["hgoal"]<$row["agoal"]){ 
					$paw_ex_aw  += 1; 
					if ( ($row["a_s"]>$row["h_s"]) and $row["gotit"]=="1" ) { $paw_cr_aw += 1; }
				}
				if ($row["hgoal"]==$row["agoal"]){ 
					$paw_ex_dr += 1; 
					if ( ($row["a_s"]==$row["h_s"]) and $row["gotit"]=="1" ) { $paw_cr_dr += 1; }
				}
					
			  }	
				//Actual
				if ($row["h_s"]=="P") {
					$actal_pp += 1; 
				}else{
					if ($row["h_s"]>$row["a_s"] and $row['h_s']<>'P') { $actal_hw += 1; }
					if ($row["a_s"]>$row["h_s"] and $row['h_s']<>'P') { $actal_aw += 1; }
					if ($row["a_s"]==$row["h_s"] and $row['h_s']<>'P'){ $actal_dr += 1; }
				}
				

		endif;
	else:
	
		if ( ($row["hwin"]>0 and $row["hwin"]<=$odd_max_diff)  or ($row["awin"]>0 and $row["awin"]<=$odd_max_diff) ):	
		   $number++;
		   $rowcol = rowcol($number);
		   $char = printv('v');
		   $matchno = trim($row["mid"]);
		   if ($matchno>0 and trim($row["hgoal"])!="N" and  ($DIV<>'FA') and ($DIV<>'IN') and ($DIV<>'SA')) :
			   $picurl = $pic . $matchno  . ".htm";
			   $mywin = "mywin" . $matchno;
			   $window ='<a title="Click to view PIC"  href="javascript:PicWin(';
			   $window .= "'" . $picurl ."'" ;
			   $window .= ')">';
		   else:
					$window="";
		   endif;
		  
		   if (  ($DIV=='SC')) :
				$window="";
				$h_team = explode("(",$row["hteam"]) ;
				$h_team = $h_team[0] ;

				$a_team = explode("(",$row["ateam"]) ;
				$a_team = $a_team[0] ;
		   else:
				$h_team = $row["hteam"] ;
				$a_team = $row["ateam"] ;
		   endif ;
		 
		  $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno')\">";
		  $data.="<tr>";
		  $data.="<td  $rowcol style=\"text-align: center\" height=\"12\">";
		  $data.= "$number</td>";
		  $data.="<td  $rowcol style=\"text-align: center\" height=\"12\">";

		  if ( $sea == curseason($db) ){ 	
    		  $data.=  $row["mdate"]. "&nbsp;<font size='1'>" . substr($row['match_time'],0,5) . "</font></td>";
          }else{
            $data.=  $row["mdate"]. "&nbsp;<font size='1'>" . substr($row['match_time'],0,5) . "</font></td>";
    	
        }
		  
		  $data.="<td  $rowcol style=\"text-align: left\" height=\"12\">";
		  $data.= '&nbsp;';
		  $data.= trim($row["hteam"]) ;
		  $data.= "&nbsp;$char&nbsp;"  ;
		  $data.= trim($row["ateam"]) ."</td>";
		  
		  $data.= "<td $rowcol class='ctd'>" . $row["div"] . "</td>\n";
		  $data.= "<td " . ($ordered==1? "bgcolor='#D3EBAB'" : $rowcol) ." style=\"text-align: center\">";
		  $data.= show_odd($row["h_odd"]) . "</td>";
		  
		  $data.= "<td " . ($ordered==2? "bgcolor='#D3EBAB'" : $rowcol) ." style=\"text-align: center\">";
		  $data.= show_odd($row["d_odd"]) . "</td>";

		  $data.= "<td " . ($ordered==3? "bgcolor='#D3EBAB'" : $rowcol) ." style=\"text-align: center\">";
		  $data.= show_odd($row["a_odd"]) . "</td>";

		  $overround=0;
		  $overround = ((1/$row["h_odd"]) + (1/$row["d_odd"]) + (1/$row["a_odd"]) -1) *100 ;
		  $data .= "<td $rowcol class='ctd'>" . num2($overround) . "%</td>\n";
		  
		  $data .= "<td $rowcol class='ctd'>" . $row['probs'] . "</td>\n";
		  
		

		  $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
		  $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;

		 if (asl_pr_team($row["hteam"],$row["ateam"],$season,$db)) :

		    if ($asl==$act){
		      $data .= "<td  bgcolor='#C1FF84' style=\"text-align: center\" $rowcol ><font color='#999'><b><i>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</i></b></font></td>";
	        }else{
				if ($row["gotit"]=="1") {
			    	 $data.= "<td  style=\"text-align: center\" $rowcol ><font color='#999'><b><i>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</i></b></font></td>";
				}else{

			    	 $data.= "<td  style=\"text-align: center\" $rowcol ><font color='#999'><i>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</i></font></td>";
				}
		  	}	

			 else:
		     if ($asl==$act){
			    $data.= "<td   bgcolor='#C1FF84' style=\"text-align: center\" $rowcol><b>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</b></td>";
			  }else{
				  if ($row["gotit"]=="1"){
					$data.= "<td  style=\"text-align: center\" $rowcol><b>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</b></td>";
				  }else{
					  $data.= "<td  style=\"text-align: center\" $rowcol>" . trim($row["hgoal"] . ' - ' . $row["agoal"]) ."</td>";
				  }
			 }
		  endif;

		 if (strlen($act)>1){
			$data.= "<td  style=\"text-align: center\" $rowcol><a class='sbar' href=\"javascript:tell('full_odds.php?id=$row[mid]&site=$db')\">" . trim($row["h_s"] . ' - ' . $row["a_s"]) ."</a></td>";
		  }else{
			$data.= "<td style=\"text-align: center\" $rowcol><a class='sbar' href=\"javascript:tell('full_odds.php?id=$row[mid]&site=$db')\">Odds</a></td>";
		 }

		  $data.= "</tr>";
		  $ngot += $row['gotit'] ;

			// bookie exp
			
			if ($row["h_s"]<>"P"){
				$book_ex_dr += 1; 
				if ($row["h_s"]==$row["a_s"]) { $book_cr_dr += 1; }
			}


		
		// paw exp
		 if ($row["h_s"]=="P"){
			 $paw_pp++;
		 }else{
			if ($row["hgoal"]>$row["agoal"]){ 
				$paw_ex_hw  += 1; 
				if ( ($row["h_s"]>$row["a_s"]) and $row["gotit"]=="1" ) { $paw_cr_hw += 1; }
			}  

			if ($row["hgoal"]<$row["agoal"]){ 
				$paw_ex_aw  += 1; 
				if ( ($row["a_s"]>$row["h_s"]) and $row["gotit"]=="1" ) { $paw_cr_aw += 1; }
			}
			if ($row["hgoal"]==$row["agoal"]){ 
				$paw_ex_dr += 1; 
				if ( ($row["a_s"]==$row["h_s"]) and $row["gotit"]=="1" ) { $paw_cr_dr += 1; }
			}
		 }		
			
			//Actual
			if ($row["h_s"]=="P") { 
				$actal_pp += 1;
			}else{
				if ($row["h_s"]>$row["a_s"] and $row['h_s']<>'P') { $actal_hw += 1; }
				if ($row["a_s"]>$row["h_s"] and $row['h_s']<>'P') { $actal_aw += 1; }
				if ($row["a_s"]==$row["h_s"] and $row['h_s']<>'P'){ $actal_dr += 1; }
			}


		endif;
	
    endif;
	 
	 
   endwhile;
	  
$page_title = "Bookie v PaW Overall Success Compared";

?>

<link rel="stylesheet" type="text/css" href="css/style.css">
<title>Analysis of Bookies&#39; 1X2 Odd</title>

<? 
include("page-header.ini.php");


page_header("Bookie v PaW Overall Success Compared") ; 


if (strlen($errlog)>0):
		echo "<div id='errordiv'>$errlog</div>";
 endif;


?>
	
<table  width="560" align="center" border='0'>
<tr>
	<td width='90%' align='center'><a href="javascript:close()" class='sbar'>x Close this window x</a> </td>
	<td align="right"> <? $pageURL ="?season=$sea";  echo printscr(); ?></td>
</tr>
</table>
<br/>


  <!-- startprint -->




<? if (isset($callfor) ): 


week_box_new200($cap . "<br><font size='1' color='#000000'>$_prerid</font>", $weekno, $wdate, $sea,600)


?>




             
<div style="padding-bottom:10px"></div>



<table border="1" cellpadding='3' style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD"  width="600" bgcolor="#F6F6F6">
<tr bgcolor="#D3EBAB">

  <td width="5%" style="text-align: center" rowspan="2"><img src="images/tbcap/refno.gif" border='0' alt='' /></td>
  <td width="80" align="center" rowspan="2"><img src="images/tbcap/date.gif" border='0' alt='' /></td>
  <td width="38%" style="text-align: center" rowspan="2"><img src="images/tbcap/match.gif" border='0' alt='' /></td>
  <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/div.gif" border='0' alt='' /></td>
  <td width="24%" style="text-align: center" colspan="3"><img src="images/tbcap/odd2.gif" border='0' alt='' /></td>
  <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/overround.gif" border='0' alt='' /></td>

  <td width="6%" style="text-align: center" rowspan="2">
	<? if ($_GET["callfor"]=="3") { ?>
		<img src="images/tbcap/atw-prob.gif" border='0' alt='' />
	<?}else{?>
		<img src="images/tbcap/htw-prob.gif" border='0' alt='' />
	<?}?>
  </td>

 <td width="6%" style="text-align: center" rowspan="2"><img src="images/tbcap/asl.gif"  border='0' alt='' /></td>

<?if ($row['weekno'] < cur_week($db)){ ?>

 <td width="8%" style="text-align: center;padding-top:2px" rowspan="2"><img src="images/tbcap/act.gif"  border='0' alt='' /></td>

<?}else{?>

<td width="8%" style="text-align: center;padding-top:2px" rowspan="2"><img src="images/tbcap/more.gif"  border='0' alt='' /></td>

<?}?>

</tr>
<tr bgcolor="#D3EBAB">
    <td width="8%" style="text-align: center" ><img src="images/tbcap/home.gif"  border='0' alt='' /></td>
    <td width="8%" style="text-align: center" ><img src="images/tbcap/d.gif"  border='0' alt='' /></td>
    <td width="8%" style="text-align: center" ><img src="images/tbcap/a.gif"  border='0' alt='' /></td>
</tr>


<?  echo $data;  ?>
		 
</table>

</center>

<!-- stopprint -->





<? if (isset($callfor)) { ?>

<table width='600' border='0' cellpadding='0' cellspacing='0' style='margin:auto auto;'>
<tr>
<td ></td>

<td style="font-weight:normal;text-align:center;padding-top:5px;">

	<B>ASL</B>&nbsp;=&nbsp;</FONT><font size="1">Our Anticipated Score-Line&nbsp;&nbsp;
		<BR>
	
	
	<? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
    <td style="width:90px;background:url('images/bbsm-right.gif') no-repeat right ;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:4px;;">
        Click here<br /> to view<br />all Odds
   </td>
</tr>
</table>

<?}


/*
$book_ex_hw = 0; $book_ex_aw = 0; $book_ex_dr = 0;
$paw_ex_hw  = 0; $paw_ex_aw  = 0; $paw_ex_dr  = 0;
$actal_hw   = 0; $actal_aw   = 0; $actal_dr   = 0; $actal_pp  = 0;

$book_cr_hw = 0; $book_cr_aw = 0; $book_cr_dr = 0;
$paw_cr_hw  = 0; $paw_cr_aw  = 0; $paw_cr_dr  = 0;
*/
?>			   
			   
			   
<br>			   
<? if ($callfor=='1') { ?>

<table width='560' cellpadding="2" bgcolor='#E6F7D6' style="border:1px solid #76CD27;margin: 0 auto 5px auto">
<tr>
	<td valign="top" colspan='2'>
	The above "Home Win" expectations represent those matches where the Bookie’s Odds for the "Home Win" are more than <?=$odd_max_diff?>% over the Bookie's Odds for the "Away Win".
    <br> 
	<br>
	The above matches are listed in the order of Lowest Odds for the "Home Win", then BIGGEST difference between the Home Win & Away Win Odds and, finally, the earliest Date/Time.


	</td>
</tr>
</table>
<br>
 <table border="1" cellpadding='5' style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD"  width="560" bgcolor="#F6F6F6">
	<tr bgcolor="#D3EBAB">
		<td style='font-weight:bold;width:250px;'>EXPECTATIONS & ACTUAL RESULTS</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>Home Wins</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>Away Wins</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>Draws</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>P-P</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>TOTALS</td>
	</tr>

	<tr>
		<td class='btd'>Bookies' Expectations</td>
		<td class='ctd btd'><?php echo prt_0($book_ex_hw-$actal_pp); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_ex_aw); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_ex_dr); ?></td>
		<td class='ctd btd'><?php echo prt_0($actal_pp); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_ex_hw+$book_ex_aw+$book_ex_dr); ?></td>
	</tr>

	<tr>
		<td class='btd'>Predict-A-Win's Expectations</td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_hw); ?></td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_aw); ?></td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_dr); ?></td>
		<td class='ctd btd'><?php echo prt_0($paw_pp); ?></td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_hw+$paw_ex_aw+$paw_ex_dr+$paw_pp); ?></td>
	</tr>

	<tr>
		<td class='btd'>Actual Results</td>
		<td class='ctd btd'><?php echo ($show_data==1 ? prt_0($actal_hw) : ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1 ? prt_0($actal_aw) : ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1 ? prt_0($actal_dr) : ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1 ? prt_0($actal_pp) : ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1 ? prt_0($actal_hw+$actal_aw+$actal_dr+$actal_pp) : ""); ?></td>
	</tr>

	<tr>
		<td colspan='6'></td>
	</tr>
	

	<tr bgcolor="#D3EBAB">
		<td style='font-weight:bold;width:250px;'>CORRECT CALLS - Totals</td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>

	</tr>

<? if ($show_data==1 ){ ?>

	<tr>
		<td class='btd'>Bookies </td>
		<td class='ctd btd'><?php echo prt_0($book_cr_hw); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_cr_aw); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_cr_dr); ?></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'><?php echo prt_0($book_cr_hw+$book_cr_aw+$book_cr_dr); ?></td>
	</tr>

	<tr>
		<td class='btd'>Predict-A-Win </td>
		<td class='ctd btd'><?php echo ($paw_ex_hw>0? $paw_cr_hw: ""); ?></td>
		<td class='ctd btd'><?php echo ($paw_ex_aw>0? $paw_cr_aw: ""); ?></td>
		<td class='ctd btd'><?php echo ($paw_ex_dr>0? $paw_cr_dr: ""); ?></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'><?php echo prt_0($paw_cr_hw+$paw_cr_aw+$paw_cr_dr); ?></td>
	</tr>
<?}?>

	<tr>
		<td colspan='6'></td>
	</tr>
	
	<tr bgcolor="#D3EBAB">
		<td style='font-weight:bold;width:250px;'>CORRECT CALLS - %</td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
	</tr>

<? if ($show_data==1){ ?>
	<tr>
		<td class='btd'>Bookies </td>
		<td class='ctd btd'>
		<?
			if ( ($book_ex_hw+$book_ex_aw+$book_ex_dr)>0 ){

					echo num2( ($book_cr_hw)/($actal_hw+$actal_aw+$actal_dr) * 100) ."%";
			}
	
		?>
		</td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
	</tr>

	<tr>
		<td class='btd'>Predict-A-Win </td>
		<td class='ctd btd'>
		<?
			if ( ($paw_ex_hw)>0 ){

					echo num2( ($paw_cr_hw)/($paw_ex_hw) * 100) ."%";
			}
		?>
		</td>
		<td class='ctd btd'>
		<?
			if ( ($paw_ex_aw)>0 ){

					echo num2( ($paw_cr_aw)/($paw_ex_aw) * 100) ."%";
			}
	
		?>

		</td>
		<td class='ctd btd'>
		<?
			if ( ($paw_ex_dr)>0 ){

					echo num2( ($paw_cr_dr)/($paw_ex_dr) * 100) ."%";
			}
	
		?>

		
		</td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
	</tr>

  <?}?>

</table>

<? } ?>

<? if ($callfor=="3") { ?>
<table width='560' cellpadding="2" bgcolor='#E6F7D6' style="border:1px solid #76CD27;margin: 0 auto 5px auto">
<tr>
	<td valign="top" colspan='2'>
	The above "Away Win" expectations represent those matches where the Bookie’s Odds for the "Away Win" are more than <?=$odd_max_diff?>% over the Bookie's Odds for the "Home Win".
	<br> 
	<br>
	The above matches are listed in the order of Lowest Odds for the "Away Win", then BIGGEST difference between the Away Win & Home Win Odds and, finally, the earliest Date/Time.


	</td>
</tr>
</table>

<br>
 <table border="1" cellpadding='5' style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD"  width="560" bgcolor="#F6F6F6">
	<tr bgcolor="#D3EBAB">
		<td style='font-weight:bold;width:250px;'>EXPECTATIONS & ACTUAL RESULTS</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>Home Wins</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>Away Wins</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>Draws</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>P-P</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>TOTALS</td>
	</tr>

	<tr>
		<td class='btd'>Bookies' Expectations</td>
		<td class='ctd btd'><?php echo prt_0($book_ex_hw); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_ex_aw-$actal_pp); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_ex_dr); ?></td>
		<td class='ctd btd'><?php echo prt_0($actal_pp); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_ex_hw+$book_ex_aw+$book_ex_dr); ?></td>
	</tr>

	<tr>
		<td class='btd'>Predict-A-Win's Expectations</td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_hw); ?></td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_aw); ?></td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_dr); ?></td>
		<td class='ctd btd'><?php echo prt_0($paw_pp);?></td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_hw+$paw_ex_aw+$paw_ex_dr+$paw_pp); ?></td>
	</tr>

	<tr>
		<td class='btd'>Actual Results</td>
		<td class='ctd btd'><?php echo ($show_data==1? prt_0($actal_hw): ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1? prt_0($actal_aw): ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1? prt_0($actal_dr): ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1? prt_0($actal_pp): ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1? prt_0($actal_hw+$actal_aw+$actal_dr+$actal_pp): ""); ?></td>
	</tr>

	<tr>
		<td colspan='6'></td>
	</tr>
	
	<tr bgcolor="#D3EBAB">
		<td style='font-weight:bold;width:250px;'>CORRECT CALLS - Totals</td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>

	</tr>

<? if($show_data==1) { ?> 
	<tr>
		<td class='btd'>Bookies </td>
		<td class='ctd btd'><?php echo prt_0($book_cr_hw); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_cr_aw); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_cr_dr); ?></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'><?php echo prt_0($book_cr_hw+$book_cr_aw+$book_cr_dr); ?></td>
	</tr>

	<tr>
		<td class='btd'>Predict-A-Win </td>
		<td class='ctd btd'><?php echo ($paw_ex_hw>0? $paw_cr_hw: ""); ?></td>
		<td class='ctd btd'><?php echo ($paw_ex_aw>0? $paw_cr_aw: ""); ?></td>
		<td class='ctd btd'><?php echo ($paw_ex_dr>0? $paw_cr_dr: ""); ?></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'><?php echo prt_0($paw_cr_hw+$paw_cr_aw+$paw_cr_dr); ?></td>
	</tr>
<? } ?>
	<tr>
		<td colspan='6'></td>
	</tr>
	
	<tr bgcolor="#D3EBAB">
		<td style='font-weight:bold;width:250px;'>CORRECT CALLS - %</td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
	</tr>

<? if($show_data==1) { ?>
	<tr>
		<td class='btd'>Bookies </td>
		<td class='ctd btd'></td>
		<td class='ctd btd'>
		<?
			if ( ($book_ex_hw+$book_ex_aw+$book_ex_dr)>0 ){

					echo num2( ($book_cr_hw+$book_cr_aw+$book_cr_dr)/($actal_hw+$actal_aw+$actal_dr) * 100) ."%";
			}
	
		?>
		</td>
		
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
	</tr>

	<tr>
		<td class='btd'>Predict-A-Win </td>
		<td class='ctd btd'>
		<?
			if ( ($paw_ex_hw)>0 ){

					echo num2( ($paw_cr_hw)/($paw_ex_hw) * 100) ."%";
			}
		?>
		</td>
		<td class='ctd btd'>
		<?
			if ( ($paw_ex_aw)>0 ){

					echo num2( ($paw_cr_aw)/($paw_ex_aw) * 100) ."%";
			}
	
		?>

		</td>
		<td class='ctd btd'>
		<?
			if ( ($paw_ex_dr)>0 ){

					echo num2( ($paw_cr_dr)/($paw_ex_dr) * 100) ."%";
			}
	
		?>

		
		</td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
	</tr>
  <? } ?>

</table>



<? } ?>
<? if ($callfor=="2") { ?>

<table width='560'  cellpadding="2" bgcolor='#E6F7D6' style="border:1px solid #76CD27;margin:auto auto">
<tr>
	<td valign="top" colspan='2'>
	The above "Draw" expectations represent those matches where the DIFFERENCE between the "Home Win" and "Away Win" Odds is +/-<?=$odd_max_diff?>% or less. It means the Bookies think those matches could swing either way and they don't care which way you bet because, on average, across all those matches, the betting will most likely fall 50/50 (and so their Over-Round will ensure that the Bookies will make good money overall).
	<br><br>
	The above matches are listed in the order of Lowest Odds for the DRAW, then lowest difference between the Home Win & Away Win Odds and, finally, the earliest Date/Time.



	</td>
</table>

<br>

 <table border="1" cellpadding='5' style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD"  width="560" bgcolor="#F6F6F6">

	<tr bgcolor="#D3EBAB">
		<td style='font-weight:bold;width:250px;'>EXPECTATIONS & ACTUAL RESULTS</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>Home Wins</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>Away Wins</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>Draws</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>P-P</td>
		<td style='text-align:center;font-weight:bold;width:60px;'>TOTALS</td>
	</tr>

	<tr>
		<td class='btd'>Bookies' Expectations</td>
		<td class='ctd btd'><?php echo prt_0($book_ex_hw); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_ex_aw); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_ex_dr); ?></td>
		<td class='ctd btd'><?php echo prt_0($actal_pp); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_ex_hw+$book_ex_aw+$book_ex_dr+$actal_pp); ?></td>
	</tr>

	<tr>
		<td class='btd'>Predict-A-Win's Expectations</td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_hw); ?></td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_aw); ?></td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_dr); ?></td>
		<td class='ctd btd'><?php echo prt_0($actal_pp); ?></td>
		<td class='ctd btd'><?php echo prt_0($paw_ex_hw+$paw_ex_aw+$paw_ex_dr+$actal_pp); ?></td>
	</tr>

	<tr>
		<td class='btd'>Actual Results</td>
		<td class='ctd btd'><?php echo ($show_data==1? prt_0($actal_hw): ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1? prt_0($actal_aw): ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1? prt_0($actal_dr): ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1? prt_0($actal_pp): ""); ?></td>
		<td class='ctd btd'><?php echo ($show_data==1? prt_0($actal_hw+$actal_aw+$actal_dr+$actal_pp): ""); ?></td>
	</tr>

	<tr>
		<td colspan='6'></td>
	</tr>
	
	<tr bgcolor="#D3EBAB">
		<td style='font-weight:bold;width:250px;'>CORRECT CALLS - Totals</td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>

	</tr>

<? if($show_data==1) { ?>
	<tr>
		<td class='btd'>Bookies </td>
		<td class='ctd btd'><?php echo prt_0($book_cr_hw); ?></td>
		<td class='ctd btd'><?php echo prt_0($book_cr_aw); ?></td>
		<td class='ctd btd'><?php echo ($book_cr_dr); ?></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'><?php echo prt_0($book_cr_hw+$book_cr_aw+$book_cr_dr); ?></td>
	</tr>

	<tr>
		<td class='btd'>Predict-A-Win </td>
		<td class='ctd btd'><?php echo ($paw_ex_hw>0? $paw_cr_hw:""); ?></td>
		<td class='ctd btd'><?php echo ($paw_ex_aw>0? $paw_cr_aw:""); ?></td>
		<td class='ctd btd'><?php echo ($paw_ex_dr>0? $paw_cr_dr:""); ?></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'><?php echo prt_0($paw_cr_hw+$paw_cr_aw+$paw_cr_dr); ?></td>
	</tr>
<? } ?>
	<tr>
		<td colspan='6'></td>
	</tr>
	
	<tr bgcolor="#D3EBAB">
		<td style='font-weight:bold;width:250px;'>CORRECT CALLS - %</td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>

	</tr>

<? if($show_data==1) { ?>
	<tr>
		<td class='btd'>Bookies </td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
		<td class='ctd btd'>
		<?
			if ( ($book_ex_hw+$book_ex_aw+$book_ex_dr)>0 ){

					echo num2( ($book_cr_hw+$book_cr_aw+$book_cr_dr)/($book_ex_hw+$book_ex_aw+$book_ex_dr) * 100) ."%";
			}
	
		?>
		</td>
		
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
	</tr>

	<tr>
		<td class='btd'>Predict-A-Win </td>
		<td class='ctd btd'>
		<?
			if ( ($paw_ex_hw)>0 ){

					echo num2( ($paw_cr_hw)/($paw_ex_hw) * 100) ."%";
			}
		?>
		</td>
		<td class='ctd btd'>
		<?
			if ( ($paw_ex_aw)>0 ){

					echo num2( ($paw_cr_aw)/($paw_ex_aw) * 100) ."%";
			}
	
		?>

		</td>
		<td class='ctd btd'>
		<?
			if ( ($paw_ex_dr)>0 ){

					echo num2( ($paw_cr_dr)/($paw_ex_dr) * 100) ."%";
			}
	
		?>

		
		</td>
		<td class='ctd btd'></td>
		<td class='ctd btd'></td>
	</tr>

	<? } ?>
</table>

<? } ?>
			   
<? endif;?>

<br />	
<table  width="560" align="center" border='0'>
<tr>
	<td width='90%' align='center'><a href="javascript:close()" class='sbar'>x Close this window x</a> </td>
	<td align="right"> <? $pageURL ="?season=$sea";  echo printscr(); ?></td>
</tr>
</table>



<?	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>