<?php
session_start();
require_once("config.ini.php");

require_once("function.ini.php");

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

 
require_once("header.ini.php");
	
?>

<?php page_header($page_title) ; ?>


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
      	<?php if (gg_count("F","HW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=F,HW'. $wk.',eu">' . gg_count("F","HW","SELECTION",'eu') . "</a>";
			?>
      </td>
      
      <td class='ctd'>
      	<?php if(gg_count("F","HW","SELECTION",'sa')>0): 
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
			<?php if(gg_count("E","HW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=E,HW'.$wk.',eu">' . gg_count("E","HW","SELECTION",'eu') . "</a>";
			?>      
      </td>
    <td class='ctd'>
			<?php if(gg_count("E","HW","SELECTION",'sa')>0): 
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
			<?php if(gg_count("V","HW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=V,HW'.$wk.',eu">' . gg_count("V","HW","SELECTION",'eu') . "</a>";
			?>      
      </td>
       <td class='ctd'>
			<?php if(gg_count("V","HW","SELECTION",'sa')>0): 
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
			<?php if(gg_count("L","HW","SELECTION",'eu')>0): 
				 $cla="mblue01" ;
			   else:
				 $cla="red01" ;
			   endif; 
			   echo '<a  class="'. $cla .'" href="prime-home-win-calls.php?PARA=L,HW'.$wk.',eu">' . gg_count("L","HW","SELECTION",'eu') . "</a>";
			?>      
      </td>
     <td class='ctd'>
			<?php if(gg_count("L","HW","SELECTION",'sa')>0): 
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

<div style='font-size:12px;padding:10px 30px'> 
<span class='red' style='font-size:18px;'>WARNING NOTICE:</span>

<ol>
	<li style='padding-bottom:10px;'>This is a warning about our website's "Prime Home Win Calls", which are most definitely <span class='red'>NOT RECOMMENDATIONS </span> from us about what to bet on but, instead, are specifically to show how the <b>low Odds against so-called "Prime" selections will generally lead to you losing more than you will make!</b></li>
	
	<li style='padding-bottom:10px;'>What we post here is what our "Predict-A-Win" Program has assessed are the most likely 6 Home Team winners in each Odds range for the current week.  For all but the "Long Shots" our PRIME SELECTIONS will in all cases match what the Bookie expects the outcome to be.  But the chances of you being able to make money if you bet on all 6 matches in each Odds range are next to impossible, if not actually impossible! <span class='red'>So you have been warned!</span> </li>
	
	<li style='padding-bottom:10px;'>Some weeks it is better by far to bet on the Away Team win coming through on all matches!  You can check out the outcome of all the alternative (REVERSE) betting options by using our "<span class='bb'>SoccerPAT</span>" facility..... so please don't be lazy about it, otherwise you will continue to lose if you insist on betting on all those matches we post in the "Prime Home Win Calls" section, even though the Bookie believes that the outcome will be exactly the same as our postings! </li>
	
	<li style='padding-bottom:10px;'>In addition, we recommend using the "Medium Odds" and "Long Shots" selections only for alternative "Correct Scores" hedge betting purposes, because you can expect actual Draws to result all too often for those higher Odds ranges, as well as the occasional Away Win coming through.  Selective "Double Chance" or "Win Only" betting may help you win something from the selected matches, but don't ever rely on it!</li>
	
	<li style='padding-bottom:10px;'>As we tell you above - <span class='red'>YOU HAVE BEEN DULY WARNED</span> about relying on so-called "Prime" calls so, as Nike might say:  <span class='red'>JUST DON'T DO IT!!</span> </li>
	
	

</ol>
</div>
    
           
<?php require_once("footer.ini.php"); ?>
