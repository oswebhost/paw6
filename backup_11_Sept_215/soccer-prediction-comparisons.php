<?php
session_start();
include("config.ini.php");
include("function.ini.php");


$cap="";

//submitted=1&season=2012-2013&callfor=1&PERIOD=1&db=eu&B1=View+Data

$db= $_GET['db'];


$data="";
$actal_hw   = 0; $actal_aw   = 0; $actal_dr   = 0; $actal_pp  = 0;
$paw_improve = 0;

$odd_max_diff = 20;

$curWeek = 1;

if (!isset($_REQUEST['season'])){
     $sea = curseason($db);
}else{
    
    $sea = $_REQUEST['season'];
}

$errlog = "";

 if ($sea == curseason($db) ){
    $curWeek = cur_week($db);
    $max_week = $curWeek - 1;
}else{
    $max_week = 44;
    $curWeek = 45;
}




if( $_GET['submitted'] == '1'){
    
    
    for ($ii=1; $ii<=$max_week; $ii++){
    
        $mywin = "mywin";
        $window ='<a class="pp" href="javascript:sele_win(';
        $window .= "'" ;
        $seleURL = "bookie-odds-listing.php?PARA=".$_GET["callfor"]. ",". $_GET["PERIOD"] . "," ;
        
        $x	  = $window . $seleURL . $ii. ",$sea,$db')\">" ;
        
         $rowcol = rowcol($ii);
        
          switch ($_GET[PERIOD])
          {
            case 1: $period = " ";  $_prerid="Full Week (Mon - Sun)"; break;
            case 2: $period = " and weekday(f.match_date)>4"; $_prerid="Weekend (Sat - Sun)"; break;
            case 3: $period = " and weekday(f.match_date)<5"; $_prerid="Midweek (Mon - Fri)"; break;
          }
      
    
    
        if ($_GET["callfor"]=="1"):
        	$query1 = "SELECT f.hwinpb as probs, f.mid,f.weekno,f.`div`,f.mdate,f.hteam,f.ateam,f.hgoal,f.agoal,f.h_odd,f.d_odd,f.h_s,f.a_s, f.gotit, f.mvalue,f.a_odd,f.match_time, ((f.a_odd/f.h_odd)-1)*100 as diff, r.rank  FROM fixtures f, ranking r WHERE
        			f.weekno='$ii' and f.season='$sea' and f.h_odd>0 and f.`div`=r.matchtype and r.cat='bk' $period ORDER BY diff,f.h_odd, r.rank";
        	
            $cap = "Against Bookies' Home Win Expectations";
        	$ordered = 1;	
            $_calls = "Home Win" ;		
        
        elseif($_GET["callfor"]=="2"):
        
        	$query1 = "SELECT f.hwinpb as probs, f.mid,f.weekno,f.`div`,f.mdate,f.hteam,f.ateam,f.hgoal,f.agoal,f.h_odd,f.h_odd,f.h_s,f.a_s, f.gotit, f.mvalue,f.d_odd,f.a_odd,f.match_time, 
        		((f.a_odd/f.h_odd)-1)*100 as hwin, ((f.h_odd/f.a_odd)-1)*100 as awin, abs(f.h_odd-f.a_odd) as dodd, r.rank FROM fixtures f, ranking r WHERE
        			f.weekno='$ii' and f.season='$sea' and f.h_odd>0 and f.`div`=r.matchtype and r.cat='bk' $period ORDER BY dodd,f.d_odd, f.match_date,f.match_time,f.`div`, f.hteam,f.ateam";
        	$cap = "Against Bookies' Draw Expectations";
        	$ordered = 2;	
            $_calls = "Draw" ;
            
        elseif($_GET["callfor"]=="3"):
        	$query1 = "SELECT f.awinpb as probs,f.mid,f.weekno,f.`div`,f.mdate,f.hteam,f.ateam,f.agoal,f.hgoal,f.h_s,f.a_s, f.gotit, f.mvalue,f.h_odd,f.h_odd,f.d_odd,f.a_odd,f.match_time, ((f.h_odd/f.a_odd)-1)*100 as diff, r.rank FROM fixtures f, ranking r WHERE
        			f.weekno='$ii' and f.season='$sea' and f.h_odd>0 and f.`div`=r.matchtype and r.cat='bk' $period ORDER BY diff, f.a_odd";
        	$cap = "Against Bookies' Away Win Expectations";
        	$ordered = 3;
            $_calls = "Away Win" ;
        
        endif;  
          
    	$book_ex_hw = 0; $book_ex_aw = 0; $book_ex_dr = 0;
    	$paw_ex_hw  = 0; $paw_ex_aw  = 0; $paw_ex_dr  = 0;
    
    
    	$book_cr_hw = 0; $book_cr_aw = 0; $book_cr_dr = 0;
    	$paw_cr_hw  = 0; $paw_cr_aw  = 0; $paw_cr_dr  = 0;


         if ($db=='eu'){
           $temp = $eu->prepare($query1) ;
         }else{
           $temp = $sa->prepare($query1);
         }
         $temp->execute();
      
    	while ($row = $temp->fetch() ):
    	 
    	if ($callfor<>'2'):
    	   	if ($row["diff"]>$odd_max_diff):	
    		
    		    
    		  $asl= trim($row["hgoal"]). '-'. trim($row["agoal"]) ;
    		  $act= trim($row["h_s"]) . '-'. trim($row["a_s"]) ;
    
    			// bookie exp
    			  if ($row["h_s"]<>"P"){
    			
    				if ($row["h_odd"]<=$row["a_odd"]){ 
    					$book_ex_hw += 1; 
    					if ($row["h_s"]>$row["a_s"]) { $book_cr_hw += 1; }
    
    				}   
    			  }	
    
    			  if ($row["h_s"]<>"P"){	
    				if ($row["a_odd"]<=$row["h_odd"]){ 
    					$book_ex_aw += 1; 
    					if ($row["a_s"]>$row["h_s"]) { $book_cr_aw += 1; }
    				}
    			  }
    
    			// paw exp
    			if ($row["h_s"]<>"P"){
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
    		endif;
    	else:
    	
    		if ( ($row["hwin"]>0 and $row["hwin"]<=$odd_max_diff)  or ($row["awin"]>0 and $row["awin"]<=$odd_max_diff) ):	
    			// bookie exp
    				if ($row["h_s"] <> "P"){
    					$book_ex_dr += 1; 
    					if ($row["h_s"]==$row["a_s"]) { $book_cr_dr += 1; }
    				}
    
    			// paw exp
    			if ($row["h_s"] <> "P"){
    				if ($row["hgoal"]>$row["agoal"]){ 
    					$paw_ex_hw  += 1; 
    					if ( ($row["h_s"]>$row["a_s"]) and $row["gotit"]=="1") { $paw_cr_hw += 1; }
    				}  
    
    				if ($row["hgoal"]<$row["agoal"]){ 
    					$paw_ex_aw  += 1; 
    					if ( ($row["a_s"]>$row["h_s"]) and $row["gotit"]=="1") { $paw_cr_aw += 1; }
    				}
    				if ($row["hgoal"]==$row["agoal"]){ 
    					$paw_ex_dr += 1; 
    					if ( ($row["a_s"]==$row["h_s"]) and $row["gotit"]=="1") { $paw_cr_dr += 1; }
    				}
    			}			
    		 endif;
    	 endif;
    	 
       endwhile;
    
    
    	
    
        $data.= "<tr $rowcol>\n";
        $data.= "<td class='ctd'> $x". $ii . "</a></td>\n";
    	
    
    	
    
       
       if ($_GET['callfor']=='1'){
    
    		$data.= "<td class='ctd'>". ($curWeek<>$ii? $book_ex_hw: "") . "</td>\n";
    		if ($ii<$curWeek){
    			$data.= "<td class='ctd'>". ($book_ex_hw>0? $book_cr_hw: "") . "</td>\n";
    			if ( ($book_cr_hw/($book_ex_hw>0? $book_ex_hw:1)) > ($paw_cr_hw/($paw_ex_hw>0? $paw_ex_hw: 1))){
    				$data.= "<td class='ctd btd bb'>". ($book_ex_hw>0? prtno(($book_cr_hw/$book_ex_hw)*100) ."%" : "") . "</td>\n";
    			}else{
    				$data.= "<td class='ctd'>". ($book_ex_hw>0? prtno(($book_cr_hw/$book_ex_hw)*100) ."%" : "") . "</td>\n";
    			}
    
    		}else{
    			$data.= "<td class='ctd'></td>\n";
    			$data.= "<td class='ctd'></td>\n";
    		}
    
    
    		$data.= "<td class='ctd'>". ($curWeek<>$ii? $paw_ex_hw: "") . "</td>\n";
    		if ($ii<$curWeek){
    			$data.= "<td class='ctd'>". ($paw_ex_hw>0? $paw_cr_hw: "") . "</td>\n";
    			if ( ($book_cr_hw/($book_ex_hw>0? $book_ex_hw:1)) > ($paw_cr_hw/($paw_ex_hw>0? $paw_ex_hw: 1))){
    				$data.= "<td class='ctd'>". ($paw_ex_hw>0? prtno(($paw_cr_hw/$paw_ex_hw)*100) ."%" : "") . "</td>\n";
    			}else{
    				$data.= "<td class='ctd btd bb'>". ($paw_ex_hw>0? prtno(($paw_cr_hw/$paw_ex_hw)*100) ."%" : "") . "</td>\n";
    			}
    
    		}else{
    			$data.= "<td class='ctd'></td>\n";
    			$data.= "<td class='ctd'></td>\n";
    		}
    
    		$actal_dr += ($ii<$curWeek? $paw_ex_hw : 0); 
    		$actal_pp += ($ii<$curWeek? $paw_cr_hw : 0);  
    		$actal_hw += ($ii<$curWeek? $book_ex_hw : 0);  
    		$actal_aw += ($ii<$curWeek? $book_cr_hw : 0); 
       }
    
       if ($_GET['callfor']=='2'){
    		
    		$data.= "<td class='ctd'>". ($curWeek<>$ii? $book_ex_dr: "") . "</td>\n";
    		if ($ii<$curWeek){
    			$data.= "<td class='ctd'>". ($book_ex_dr>0? $book_cr_dr: "") . "</td>\n";
    			if ( ($book_cr_dr/($book_ex_dr>0? $book_ex_dr:1)) > ($paw_cr_dr/($paw_ex_dr>0? $paw_ex_dr: 1))){
    				$data.= "<td class='ctd btd bb'>". ($book_ex_dr>0? prtno(($book_cr_dr/$book_ex_dr)*100) ."%" : "") . "</td>\n";
    			}else{
    				$data.= "<td class='ctd'>". ($book_ex_dr>0? prtno(($book_cr_dr/$book_ex_dr)*100) ."%" : "") . "</td>\n";
    			}
    
    		}else{
    			$data.= "<td class='ctd'></td>\n";
    			$data.= "<td class='ctd'></td>\n";
    		}
    
    
    		$data.= "<td class='ctd'>". ($curWeek<>$ii? $paw_ex_dr: "") . "</td>\n";
    		if ($ii<$curWeek){
    			$data.= "<td class='ctd'>". ($paw_ex_dr>0? $paw_cr_dr: "") . "</td>\n";
    			if ( ($book_cr_dr/($book_ex_dr>0? $book_ex_dr:1)) > ($paw_cr_dr/($paw_ex_dr>0? $paw_ex_dr: 1))){
    				$data.= "<td class='ctd'>". ($paw_ex_dr>0? prtno(($paw_cr_dr/$paw_ex_dr)*100) ."%" : "") . "</td>\n";
    			}else{
    				if ($paw_ex_dr>0){	
    					$data.= "<td class='ctd btd bb'>". ($paw_ex_dr>0? prtno(($paw_cr_dr/$paw_ex_dr)*100) ."%" : "") . "</td>\n";
    				}else {
    					$data.= "<td class='ctd'></td>\n";
    				}
    			}
    
    		}else{
    			$data.= "<td class='ctd'></td>\n";
    			$data.= "<td class='ctd'></td>\n";
    		}
    
    
    		$actal_dr += ($ii<$curWeek? $paw_ex_dr:0); 
    		$actal_pp += ($ii<$curWeek? $paw_cr_dr:0); 
    		$actal_hw += ($ii<$curWeek? $book_ex_dr:0); 
    		$actal_aw += ($ii<$curWeek? $book_cr_dr:0);
    
    
       }
    
       if ($_GET['callfor']=='3'){
    
    		$data.= "<td class='ctd'>". ($curWeek<>$ii? $book_ex_aw: "") . "</td>\n";
    		if ($ii<$curWeek){
    			$data.= "<td class='ctd'>". ($book_ex_aw>0? $book_cr_aw: "") . "</td>\n";
    			if ( ($book_cr_aw/($book_ex_aw>0? $book_ex_aw:1)) > ($paw_cr_aw/($paw_ex_aw>0? $paw_ex_aw: 1))){
    				if ($paw_cr_aw>0){
    					$data.= "<td class='ctd btd bb'>". ($book_ex_aw>0? prtno(($book_cr_aw/$book_ex_aw)*100) ."%" : "") . "</td>\n";
    				}else{
    					$data.= "<td class='ctd'>". ($book_ex_aw>0? prtno(($book_cr_aw/$book_ex_aw)*100) ."%" : "") . "</td>\n";
    				}
    			}else{
    				$data.= "<td class='ctd'>". ($book_ex_aw>0? prtno(($book_cr_aw/$book_ex_aw)*100) ."%" : "") . "</td>\n";
    			}
    
    		}else{
    			$data.= "<td class='ctd'></td>\n";
    			$data.= "<td class='ctd'></td>\n";
    		}
    
    	
    		$data.= "<td class='ctd'>". ($curWeek<>$ii? $paw_ex_aw: "") . "</td>\n";
    		if ($ii<$curWeek){
    			$data.= "<td class='ctd'>". ($paw_ex_aw>0? $paw_cr_aw: "") . "</td>\n";
    			if ( ($book_cr_aw/($book_ex_aw>0? $book_ex_aw:1)) > ($paw_cr_aw/($paw_ex_aw>0? $paw_ex_aw: 1))){
    				$data.= "<td class='ctd'>". ($paw_ex_aw>0? prtno(($paw_cr_aw/$paw_ex_aw)*100) ."%" : "") . "</td>\n";
    			}else{
    				if ($paw_cr_aw>0){
    					$data.= "<td class='ctd btd bb'>". ($paw_ex_aw>0? prtno(($paw_cr_aw/$paw_ex_aw)*100) ."%" : "") . "</td>\n";
    				}else{
    					$data.= "<td class='ctd'>". ($paw_ex_aw>0? prtno(($paw_cr_aw/$paw_ex_aw)*100) ."%" : "") . "</td>\n";
    				}
    			}
    
    		}else{
    			$data.= "<td class='ctd'></td>\n";
    			$data.= "<td class='ctd'></td>\n";
    	
    		}
    
    		
    		$actal_dr += ($ii<$curWeek? $paw_ex_aw : 0); 
    		$actal_pp += ($ii<$curWeek? $paw_cr_aw : 0); 
    		$actal_hw += ($ii<$curWeek? $book_ex_aw : 0); 
    		$actal_aw += ($ii<$curWeek? $book_cr_aw : 0);
    
       }
    	
    	$data.= "</tr>\n";
    
    } // end for week
    	  
    if ($sea == curseason($db)){      
        for($ii=$curWeek; $ii<=44; $ii++){
        
            $rowcol = rowcol($ii);
            $data.= "<tr $rowcol>\n";
            $data.= "<td class='ctd'>". $ii . "</td>\n";
        	
        	$data.= "<td class='ctd'></td>\n";
        	$data.= "<td class='ctd'></td>\n";
        	$data.= "<td class='ctd'></td>\n";
        
        	$data.= "<td class='ctd'></td>\n";
        	$data.= "<td class='ctd'></td>\n";
        	$data.= "<td class='ctd'></td>\n";
        
        	$data.= "</tr>\n";
        }
    }
    
    if (isset($_GET['callfor'])){
    
    	$data.= "<tr bgcolor='#cccccc'>\n";
    	$data.= "<td class='ctd'></td>\n";
    	
    	if ($_GET['callfor']=='1'){
    		$data.= "<td class='ctd credit'>". ($actal_hw>0? $actal_hw: "") . "</td>\n";
    		$data.= "<td class='ctd credit'>". ($actal_aw>0? $actal_aw: "") . "</td>\n";
    		$data.= "<td class='ctd credit'>". ($actal_hw>0? prtno(($actal_aw/$actal_hw)*100) ."%" : "") . "</td>\n";
    	}
    
    	if ($_GET['callfor']=='2'){
    		$data.= "<td class='ctd credit'>". ($actal_hw>0? $actal_hw: "") . "</td>\n";
    		$data.= "<td class='ctd credit'>". ($actal_aw>0? $actal_aw: "") . "</td>\n";
    		$data.= "<td class='ctd credit'>". ($actal_hw>0? prtno(($actal_aw/$actal_hw)*100) ."%" : "") . "</td>\n";
    	}
    
    	if ($_GET['callfor']=='3'){
    		$data.= "<td class='ctd credit'>". ($actal_hw>0? $actal_hw: "") . "</td>\n";
    		$data.= "<td class='ctd credit'>". ($actal_aw>0? $actal_aw: "") . "</td>\n";
    		$data.= "<td class='ctd credit'>". ($actal_hw>0? prtno(($actal_aw/$actal_hw)*100) ."%" : "") . "</td>\n";
    	}
    
    	$data.= "<td class='ctd credit'>". ($actal_dr>0? $actal_dr: "") . "</td>\n";
    	$data.= "<td class='ctd credit'>". ($actal_pp>0? $actal_pp: "") . "</td>\n";
    	$data.= "<td class='ctd credit'>". ($actal_dr>0? prtno(($actal_pp/$actal_dr)*100) ."%" : "") . "</td>\n";
    
    	$data.= "</tr>\n";
    
    	$paw_improve = 0;
        
        if ($actal_dr>0){
    	   $paw_improve = ( (($actal_pp/$actal_dr)*100) - (($actal_aw/$actal_hw)*100) ) /  (($actal_aw/$actal_hw)*100) ;
        }
        
    	$data.= "<tr bgcolor='#f4f4f4'>\n";
    	$data.= "<td class='rtd credit' style='color:blue' colspan='6'>Predict-A-Win's Improvement Over Bookies =</td>\n";
    
    	$data.= "<td class='ctd credit' style='color:blue'>". prtno($paw_improve * 100) . "%</td>\n";
    
    	$data.= "</tr>\n";
    }

}// if $submitted == 1

if (isset($_GET['db'])){
     
     $page_title = "Soccer Betting Comparisons - ". site($db) ." $sea $_prerid $_calls ";
}else{
    
    $page_title = "Soccer Betting Comparisons "; 
}

include("header.ini.php");


page_header("Bookie v PaW Overall Success Compared" ) ; 

if (isset($_GET['db'])){ 

?>

<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>
<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>
<div class='clear'></div>


<br />
<?
if (strlen($errlog)>0):
		echo "<div class='errordiv'>$errlog</div>";
 endif;


?>


<div style="padding-bottom:2px"></div>
 <center>
<table border="0" width="100%" cellpadding="0" cellspacing="0">
 <tr>
    <td width="25%"><a class='sbar' href="bookie-odds-summary.php"><img border="0" src="images/header/blue-dot.gif"/>Back</a></td>

   <td width="25%" height="20" align='center' colspan='3' valign="bottom">
		<form method='get' style='padding:0;margin:0;'>	
		
	 </td>
	<td width="25%" align="right"> <? echo printscr(); ?></td>
	</tr>
 </table>
 <br/>




<form method="get" action="<? echo $PHP_SELF ?>">
    <input type="hidden" name="submitted" value="1"/>
    <input type="hidden" name="db" value="<?echo $_GET['db'];?>" />   
    
<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:0 auto 10px auto;" bordercolor="#f4f4f4" width="560">

	<tr bgcolor="#f4f4f4">
        <td ><b><font size="2" color="#0000FF">Season: </font></b> <br />
        
         <select size="1" name="season" class="text" style="width:100px;">
	  <? 
		  $sqry = "SELECT distinct(season) as season from quickpick order by season desc" ;
            if ($db=='eu'){
               $temp = $eu->prepare($sqry) ;
            }else{
               $temp = $sa->prepare($sqry);
            }
            $temp->execute();
          
	   while ($sr = $temp->fetch()) : 
	  ?>
		  <option value="<?= $sr["season"] ?>" <?echo selected($_GET['season'],$sr["season"])?>><?= $sr["season"] ?></option>
	  <? endwhile; ?>
        </td>
	 
		<td  class='ltd' >	<b><font size="2" color="#0000FF">Call Type: </font></b><br />
		  <select size="1" name="callfor" class="text" style="width:100px;">
			<option value="1" <?echo selected($_GET['callfor'],'1')?>>Home Wins</option>
			<option value="3" <?echo selected($_GET['callfor'],'3')?>>Away Wins</option>
			<option value="2" <?echo selected($_GET['callfor'],'2')?>>Draws</option>
		  </select>
	  </td>
		<td class='ltd'>	
			<b><font size="2" color="#0000FF">for: </font></b><br />
	
			<select size="1" name="PERIOD" class="text" style="width:120px;">
			<option value="1" <?echo selected($_GET[PERIOD],'1')?>>Full Week</option>
			<option value="2" <?echo selected($_GET[PERIOD],'2')?>>Weekend (Sat - Sun)</option>
			<option value="3" <?echo selected($_GET[PERIOD],'3')?>>Midweek (Mon - Fri)</option>
		  </select>
		</td>
        
       
		<td><br /><input type="submit" value="View Data" name="B1" class="bt" style="padding: 3px;width:80px" /></td>
	</tr>
	</table>
</form>

</center>

<?}else{
    
    include("select-option.ini.php");
    
} ?>

  <!-- startprint -->
<div style="padding-bottom:10px"></div>



<? if (isset($_GET['callfor']) ): 


yearonly_box($cap . "<br><font size='1' color='#000000'>$_prerid</font>", $_GET['season'] );


?>



  



  <table border="1" cellpadding='3' style="border-collapse: collapse;margin:auto auto;" bordercolor="#CDCDCD"  width="560" bgcolor="#F6F6F6">
   <tr bgcolor="#D3EBAB">

    <td rowspan="2" class='ctd'><img src="images/tbcap/wkno.gif"  border='0' alt='' /></td>
	<td colspan='3' class='ctd'><img src="images/tbcap/bookies.gif"  border='0' alt='' /></td>
	<td colspan='3' class='ctd'><img src="images/tbcap/paw.gif"  border='0' alt='' /></td>
  </tr>
   
  <tr bgcolor="#D3EBAB">
	<td><img src="images/tbcap/expectations.gif"  border='0' alt='' /></td>
	<td><img src="images/tbcap/successes.gif"  border='0' alt='' /></td>
	<td><img src="images/tbcap/successper.gif"  border='0' alt='' /></td>

	<td><img src="images/tbcap/predictions.gif"  border='0' alt='' /></td>
	<td><img src="images/tbcap/successes.gif"  border='0' alt='' /></td>
	<td><img src="images/tbcap/successper.gif"  border='0' alt='' /></td>
  </tr>

	 <?  echo $data;  ?>
</table>
 </center>



<!-- stopprint -->



			   
<? endif;?>


<div style="padding-bottom:5px">&nbsp;</div>
		
<? include("footer.ini.php"); ?>


<?	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>
