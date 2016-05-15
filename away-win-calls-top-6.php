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


if ($LOG=="N"): $lastweek = $lastweek - 1; endif;
if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;
    
    

$wk = ",". $weekno;
$season = curseason($db);

$page_title = "Soccer Away Win Calls";


include("header.ini.php");
	
?>

<? page_header("Away Win Calls Top 6") ; ?>


<div style="text-align:center;margin-bottom:14px;">
<font size="3" color="#0000FF"><b><i>Current Week’s Postings</i></b> <font size='1'><b>(<?php echo weekbegin('ea');?>)</b></font></font>
</div>		

<table border="1" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:auto auto" bordercolor="#CDCDCD" width="90%">

	<tr bgcolor="#D3EBAB">
		<td class="ctd credit" width='50%' style='padding:15px 0'>Calls Type</td>
        <td class="ctd credit">EUROPE</td>
        <td class="ctd credit">AMERICAS</td>
    </tr>
  
   
   
   <tr>
      <td class='credit' style="padding:10px 0 10px 5px;">Midweek Preferences </td>
      <td class='ctd'>
      	<? if (gg_count("F","AW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="away-win-calls.php?PARA=F,AW'. $wk.',eu">' . gg_count("F","AW","SELECTION",'eu') . "</a>";
			?>
      </td>
      
      <td class='ctd'>
      	<? if (gg_count("F","AW","SELECTION",'sa')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="away-win-calls.php?PARA=F,AW,'. cur_week('sa').',sa">' . gg_count("F","AW","SELECTION",'sa') . "</a>";
			?>
      </td>
     
   </tr>
   
   <tr>
      <td class='credit' style="padding:10px 0 10px 5px;">Weekend Short Odds </td>
      <td class='ctd'>
			<? if (gg_count("E","AW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="away-win-calls.php?PARA=E,AW'.$wk.',eu">' . gg_count("E","AW","SELECTION",'eu') . "</a>";
			?>      
      </td>
    <td class='ctd'>
			<? if (gg_count("E","AW","SELECTION",'sa')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="away-win-calls.php?PARA=E,AW,'. cur_week('sa').',sa">' . gg_count("E","AW","SELECTION",'sa') . "</a>";
			?>      
      </td>
   </tr>

   <tr>
      <td class='credit' style="padding:10px 0 10px 5px;">Weekend Medium Odds </td>
         <td class='ctd'>
			<? if (gg_count("V","AW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="away-win-calls.php?PARA=V,AW'.$wk.',eu">' . gg_count("V","AW","SELECTION",'eu') . "</a>";
			?>      
      </td>
       <td class='ctd'>
			<? if (gg_count("V","AW","SELECTION",'sa')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="away-win-calls.php?PARA=V,AW,'. cur_week('sa').',sa">' . gg_count("V","AW","SELECTION",'sa') . "</a>";
			?>      
      </td>
     
   </tr>

   <tr>
      <td class='credit' style="padding:10px 0 10px 5px;">Weekend Long Shots </td>
     <td class='ctd'>
			<? if (gg_count("L","AW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="away-win-calls.php?PARA=L,AW'.$wk.',eu">' . gg_count("L","AW","SELECTION",'eu') . "</a>";
			?>      
      </td>
     <td class='ctd'>
			<? if (gg_count("L","AW","SELECTION",'sa')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="away-win-calls.php?PARA=L,AW,'. cur_week('sa').',sa">' . gg_count("L","AW","SELECTION",'sa') . "</a>";
			?>      
      </td>
     
   </tr>
</table>


<p style='font-size:11px;padding:10px 0 0px 30px;color:red;font-weight:bold'>Weekend Calls are not usually posted until Friday at the earliest.</p> 
<p style='font-size:11px;padding:10px 30px;color:blue;font-weight:bold'>You can view all the postings for past weeks by clicking on the blue number or the red "0". </p>

<p style='font-size:11px;padding:0px 30px'><strong><span style="color: red;">WARNING:</strong></span> We recommend using 
	the Medium Odds and Long Shots selections only for alternative "Correct Scores" hedge betting purposes, because you 
	can expect actual Draws to result all too often as well as the occasional Away Win.  Selective "Double Chance" betting
	 may help too.  </p>
    
           
<? include("footer.ini.php"); ?>
