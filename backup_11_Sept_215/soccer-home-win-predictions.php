<?php
session_start();
include("config.ini.php");

include("function.ini.php");

$qry = "SELECT * FROM setting";
$db='eu';

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

/*
if ($LOG=="N"): $lastweek = $lastweek - 1; endif;
if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;
  */  
    

if ($weekno<=0) $weekno = $lastweek ;

//if (check_season()=='1'){ header('Location: commences.php'); exit; }
if (isset($_SESSION['userid']) ):
	if ($_SESSION['expire'] < cur_week($db) ):
		if ( $weekno == cur_week($db) ) :
			$weekno=$lastweek-1;
			$errlog = "You will only be able to see the current week's data if you are logged in. To be able to log in you must be a fully subscribed member.";
		endif;
	endif;
elseif (!isset($_SESSION['userid']) and ($weekno==cur_week($db))) :
		//header("location: authorization.php");
		$errlog = "You will only be able to see the current week's data if you are logged in. To be able to log in you must be a fully subscribed member.";
		$weekno=$lastweek-1;
endif;




$wk = ",". $weekno;
$season = curseason($db);

$page_title = "Prime Home Win Calls (Top 6) ";

 
include("header.ini.php");
	
?>

<? page_header($page_title) ; ?>


<div style="text-align:left;margin-bottom:14px;">
<font size="3" color="#0000FF"><b><i>Current Week's Postings</i></b> <font size='1'><b></b></font></font>
</div>		

<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="90%">

	<tr bgcolor="#D3EBAB">
		<td class="ctd credit" style='padding:14px 0' width='50%'>Segregation Type</td>
        <td class="ctd credit">EUROPE</td>
        <td class="ctd credit">AMERICAS</td>
    </tr>
  
   
   
   <tr>
      <td class='credit' style="padding:10px 0 10px 5px;">Midweek Preferences </td>
      <td class='ctd'>
      	<? if (gg_count("F","HW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=F,HW'. $wk.',eu">' . gg_count("F","HW","SELECTION",'eu') . "</a>";
			?>
      </td>
      
      <td class='ctd'>
      	<? if (gg_count("F","HW","SELECTION",'sa')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=F,HW,'. cur_week('sa').',sa">' . gg_count("F","HW","SELECTION",'sa') . "</a>";
			?>
      </td>
     
   </tr>
   
   <tr>
      <td class='credit' style="padding:10px 0 10px 5px;">Weekend Short Odds </td>
      <td class='ctd'>
			<? if (gg_count("E","HW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=E,HW'.$wk.',eu">' . gg_count("E","HW","SELECTION",'eu') . "</a>";
			?>      
      </td>
    <td class='ctd'>
			<? if (gg_count("E","HW","SELECTION",'sa')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=E,HW,'. cur_week('sa').',sa">' . gg_count("E","HW","SELECTION",'sa') . "</a>";
			?>      
      </td>
   </tr>

   <tr>
      <td class='credit' style="padding:10px 0 10px 5px;">Weekend Medium Odds </td>
         <td class='ctd'>
			<? if (gg_count("V","HW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=V,HW'.$wk.',eu">' . gg_count("V","HW","SELECTION",'eu') . "</a>";
			?>      
      </td>
       <td class='ctd'>
			<? if (gg_count("V","HW","SELECTION",'sa')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=V,HW,'. cur_week('sa').',sa">' . gg_count("V","HW","SELECTION",'sa') . "</a>";
			?>      
      </td>
     
   </tr>

   <tr>
      <td class='credit' style="padding:10px 0 10px 5px;">Weekend Long Shots </td>
     <td class='ctd'>
			<? if (gg_count("L","HW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=L,HW'.$wk.',eu">' . gg_count("L","HW","SELECTION",'eu') . "</a>";
			?>      
      </td>
     <td class='ctd'>
			<? if (gg_count("L","HW","SELECTION",'sa')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=L,HW,'. cur_week('sa').',sa">' . gg_count("L","HW","SELECTION",'sa') . "</a>";
			?>      
      </td>
     
   </tr>
</table>


<p style='font-size:11px;padding:10px 0 0px 30px;color:red;font-weight:bold'>Weekend Selections are not usually posted until Friday at the earliest.</p> 
<p style='font-size:11px;padding:10px 30px;color:blue;font-weight:bold'>You can view all the postings for past weeks by clicking on the blue number or the red "0". </p>

<p style='font-size:11px;padding:0px 30px'><strong><span style="color: red;">WARNING:</strong></span> We recommend using 
	the Medium Odds and Long Shots selections only for alternative "Correct Scores" hedge betting purposes, because you 
	can expect actual Draws to result all too often as well as the occasional Away Win.  Selective "Double Chance" betting
	 may help too.  </p>
    
           
<? include("footer.ini.php"); ?>
