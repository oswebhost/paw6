<?php
session_start();
include("config.ini.php");
include("function.ini.php");

if (!isset($_REQUEST['db'])){
	include("header.ini.php");
	include("select-option.ini.php");
	include("footer.ini.php");
	exit;
}




$db= $_GET['db'];

$qry = "SELECT * FROM setting";

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
$cur_week  =$row["weekno"];

if (isset($_GET['season'])){
    $season = $_GET['season']; 
}else{
    $season = curseason($db);
}



if ($LOG=="N"): $lastweek = $lastweek - 1; endif;
if ($sended=='1'):header('Location: commences.php');exit;endif;
if ($updating=='1'):header('Location: underway.php');exit;endif;


if ($_GET['weekno']>0){
    $cur = $_GET['weekno'];
}else{
    $cur = cur_week($db);
}	

 $weekno = $cur;
 
 
 $pwk = $weekno-1;
 $nwk = $weekno+1;

if ($LOG=="N") : $purl .= "&LOG=N"; endif;
$purl .= "&WEEKNO=";

if (!isset($weekno)) $weekno = $lastweek ;
    
$errlog = "";

//if (check_season()=='1'){ header('Location: commences.php'); exit; }
if (isset($_SESSION['userid']) ):
  if ($_SESSION['expire'] < cur_week($db) ):
    if ( $weekno == cur_week($db) ) :
      $weekno=$lastweek-1;
      $errlog = limited_asscess_message($db);
    endif;
  endif;
elseif (!isset($_SESSION['userid']) and ($weekno==cur_week($db))) :
    //header("location: authorization.php");
    $errlog = limited_asscess_message($db);
    $weekno=$lastweek-1;
endif;



 $qry = "SELECT * FROM fixtures WHERE `weekno`='$weekno' and season='$season' limit 1"; 
 if ($db=='eu'){
   $temp = $eu->prepare($qry) ;
  }else{
   $temp = $sa->prepare($qry);
  }
 $temp->execute();
 $row  = $temp->fetch();
 $wdate= $row["wdate"];
  
  

if (isset($_GET["weekno"])):
	$page_title = "1X2 Odds " . divname($div_value) . " " . curseason()  . " Week $weekno " ;
else:
	$page_title = "1X2 Odds by Division " . curseason() ;
endif;

include("header.ini.php");

page_header("Current Week's Odds") ;


include("overround-class.php");


if (isset($_GET['db'])){ 
    if (strlen($errlog)>0)		
    	echo "<div class='errordiv'>$errlog</div>";
 }       


?>
<div class="report_blue_heading" s<div class="report_blue_heading" style="float:left;width: 320px;"><?echo site($db);?></div>

<div class="report_blue_link" style="float:right;width: 220px;"><a href='<?php echo $_SERVER['SCRIPT_NAME'] ."?db=".  db_other($db);?>'  class='sbar'>Click here</a> for <?echo site_other($db);?></div>

<div class='clear'></div>

<div class="report_blue_heading" style="width: 560px;margin:0 auto 5px auto;">1X2 Odds by Division</div>




<br />

 <center>
 
 
<table border="0" cellpadding="2" cellspacing="0" style="border:1px solid #ccc;margin:auto auto;background:#E1EFFD;" bordercolor="#f4f4f4" width="560">

	<form method="get" action="<? echo $PHP_SELF ?>">
		<input type="hidden" name="db" value="<?php echo $_GET['db'];?>">
	<tr>
	  <td ><b><font size="2" color="#0000FF">Week No:</font></b><br>
	  <select style="width:60px" name="weekno" class="text">
	   <? 
			 $br=0;
			 
			 for ($other=cur_week($db); $other>=1; $other--) :
				$br++;
				echo "<option value='$other'" ;
					if ($other==$weekno): echo " selected"; endif;
				echo ">$other</option>\n\n";
			 endfor;
			 echo "</select>";	

	   ?>

	  </td>
	  <td ><b><font size="2" color="#0000FF">Division:</font></b><br>
	  <select size="1" name="div_value" class="text" style="width:240px;">
      <?
       
        $arry_div = ($_GET['db']=='eu'? $arry_div : $arry_div_sa);

        for ($_i=0; $_i<count($arry_div); $_i++){ ?>
            
            <option value="<? echo $arry_div[$_i];?>" <? echo selected($_GET['div_value'], $arry_div[$_i]);?>><? echo divname($arry_div[$_i]); ?></option>
            
       <? } ?>
      
	  
	  </select>
      </td>

      <td class='ltd'><b><font size="2" color="#0000FF">Sort On</font></b><br/>
      
         <select size="1" name="SORTBY" class="text" style="width:160px;padding:3px;">
          <optgroup label="Odds">  
            <option value="10" <?echo selected($_GET['SORTBY'],'10')?>>Home Wins Odds</option>
            <option value="11" <?echo selected($_GET['SORTBY'],'11')?>>Away Wins Odds</option>
            <option value="12" <?echo selected($_GET['SORTBY'],'12')?>>Draw Odds</option>
          </optgroup>

          <optgroup label="Goals">  
            <option value="13" <?echo selected($_GET['SORTBY'],'13')?>> Total Goals Predicted</option>
            <option value="14" <?echo selected($_GET['SORTBY'],'14')?>> ASL Goal Difference</option>
          </optgroup>

          <optgroup label="Probabilities">    
            <option value="7" <?echo selected($_GET['SORTBY'],'7')?>>Home Wins Probabilities</option>
          </optgroup>    
          
          <option value="15" <?echo selected($_GET['SORTBY'],'15')?>>Match Date</option>
           
        </select>

    		  	<select size="1" name="ordered" class="text" style="width:66px;padding:3px;" >
                	<option value="1" <? if ($_GET['ordered']==1) echo 'selected';?>>00-99</option>
                	<option value="2" <? if ($_GET['ordered']==2) echo 'selected';?>>99-00</option>
		  		</select>
                
    	   </td>


      </td>
      
      </tr>
      
      <tr>
      <td colspan="3" class="ctd">
	  <input type="submit" value="View Data" name="B1" class="bt" style="padding:4px 8px;"/>

	  </td>
	</tr>	
	</form>
</table>
</center>

<div style="padding-bottom:2px"></div>

<table  width="100%" align="center">
<tr>
	<td> <a class='sbar' href="bookies-odds-soccer-betting.php?db=<?echo $db;?>"><img border="0" src="images/header/blue-dot.gif"/>Back</a> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"> <? echo printscr(); ?></td>
</tr>
</table>

<div style="padding-bottom:10px"></div>

  <!-- startprint -->
<? if (isset($_GET['div_value']) ): 

week_box_nocap($weekno, $wdate,$season,570);


?>


             
<div style="padding-bottom:10px"></div>

<?php over_round_msg();?>

<table border="1" style="border-collapse: collapse;margin:auto auto;" bordercolor="#cdcdcd"  width="570" cellpadding='3' bgcolor="#f6f6f6">
<tr bgcolor="#d3ebab">

  <td width="5%" class='ctd' rowspan="2"><img src="images/tbcap/refno.gif"  border='0' alt=""/></td>

  <? if ( ($DIV=='FA') or ($DIV=='SA') or ($DIV=='IN')) : ?>
	   <td width="80" class='ctd' rowspan="2"><img src="images/tbcap/date.gif" border="0" alt=""/>
  <? else: ?>
		 <td width="10%" class='ctd'rowspan="2"><img src="images/tbcap/datepic.gif" border="0" alt=""/>
  <? endif; ?>
  </td>
  <td width="38%" class='ctd' rowspan="2"><img src="images/tbcap/match.gif"  border="0" alt=""/></td>
  <td width="24%" class='ctd' colspan="3"><img src="images/tbcap/odd2.gif"  border='0' alt=""/></td>
  <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/overround.gif"  border="0" alt=""/></td>
  <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/htw-prob.gif"  border="0" alt=""/></td>
  <td width="6%" class='ctd' rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>

<?if ($row['weekno'] < cur_week($db)){ ?>

	<td width="8%" class='ctd' rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/></td></td>

<?}else{?>

	<td width="8%" class='ctd' rowspan="2"><img src="images/tbcap/act.gif"  border="0" alt=""/	></td></td>

<?}?>

</tr>
<tr bgcolor="#d3ebab">
	<td width="8%" class='ctd'><img src="images/tbcap/home.gif"  border='0' alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/d.gif"  border='0' alt=""/></td>
	<td width="8%" class='ctd'><img src="images/tbcap/a.gif"  border='0' alt=""/></td>
</tr>

<?

switch($_GET['ordered'])
{
    case 1: $ordered = " asc"; break;
    case 2: $ordered = " desc"; break;
}

switch ($_GET['SORTBY'])
{
  
    
    case 7: $ordered_by = " ORDER BY f.hwinpb "; break;
      
    case 10: $ordered_by = " ORDER BY f.h_odd "; break;
    case 11: $ordered_by = " ORDER BY f.a_odd "; break;
    case 12: $ordered_by = " ORDER BY f.d_odd "; break;
    
    case 13: $ordered_by = " ORDER BY goalsum $ordered, f.hgoal "; break;
    case 14: $ordered_by = " ORDER BY goaldif "; break;
    
    case 15: $ordered_by = " ORDER BY f.match_date "; break;
}
          
	$query1 = "SELECT f.*,(f.hgoal-f.agoal) as goaldif, (f.hgoal+f.agoal) as goalsum FROM fixtures f WHERE f.`div`='$_GET[div_value]' and f.weekno='$weekno' and f.season='$season' and f.h_odd>0 "; 

    $query1 .= $ordered_by . $ordered ;



	if ($db=='eu'){
	   $temp = $eu->prepare($query1) ;
	}else{
	   $temp = $sa->prepare($query1);
	}

    $temp->execute();

    $number = 0;
    $postponed=0;
     $css=0;
  if ($temp->rowCount()>0){
    
    while ($row = $temp->fetch()) {

    	$number++;
	    $matchno = $row['mid'];
        $asl= trim($row["hgoal"]) . '-'.trim($row["agoal"]) ;
        $act= trim($row["h_s"]) . '-'.trim($row["a_s"]) ;
        $ngot += $row['gotit'] ;

        // find over-round [overround-class.php]
        $or = new overround();
        $or->find_or($row['h_odd'], $row['d_odd'], $row['a_odd'], $row['hwinpb'],$row['drawpb'],$row['awinpb']);


        
        $headtohead = "<a title='Head to Head' class='md' href=\"javascript:head('headtohead.php?ID=$matchno&site=$db')\">";
        $ltable= '<a class="md" title="League Tables '. divname($row["div"])  .'" href="league-table.php?site='. $db.'&DIV=' . $row["div"] .'">'. $row["div"].'</a>';
        
        $title = "$row[hteam] v $row[ateam] match odds" ;
        $odd=0;
      

 
        //$odd = show_rebs($matchno,$_GET['weekno'],$_GET['season'],$_GET['MPRED'],$db);
  
        $asl_class ="";
       
 		$sbar = "sbar";

        if ($row['gotit']=='1' and $row['h_s']<>'P'){
            $asl_class = " gotrtblue";
        }elseif ($row['gotit']=='0' and $row['h_s']<>'P'){
        	$asl_class = " wrong";
        	$sbar= "sWrg";
        }

        if (strlen($act)<2){

        	$asl_class='';
        	$sbar = 'sbar';
        }
        
        if ($asl==$act){
            $asl_class = " gotaslblue";
            	$sbar = 'sbar2';
             $css ++;
        }
        
        if ($row['h_s']=='P'){
            $asl_class = " pp";
            $sbar= "sWrg";
            $postponed++;
        }
        
        $pr = "";
        if (asl_pr_team($row["hteam"],$row["ateam"],$season,$db)){
            $pr = " pr2";
        }

        //over founds
        $hor = ($or->home_value==1? " h_Or" : "");
        $aor = ($or->away_value==1? " a_Or" : "");


?>

	<tr <?php echo rowcol($number);?>>
		<td class="ctd padd"><?echo $number; ?></td>
	    <td class="ctd" <?echo ($_GET["SORTBY"]=='15'? "bgcolor='#D3EBAB'": "");?>><a class='md2' <?echo $ffh;?> target='_blank' href='team-performance-chart.php?id=<?echo $matchno;?>&site=<?echo $db;?>'><?echo $row['mdate'] . " " . substr($row['match_time'],0,5); ?></a></td>

	    <td class='padd ltd'><a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['hteam']?>&site=<?echo $db;?>">
	        <?echo $row['hteam'] .'</a>' . printv(' v '); ?>
	        <a title="Results to Date" class='md' href="teamfixt.php?TEAM=<?echo $row['ateam']?>&site=<?echo $db;?>">
	            <?echo $row['ateam'];?></a>
	    </td>


    <td <?echo ($_GET["SORTBY"]=='10'? "bgcolor='#D3EBAB'": "");?> class='ctd <?php echo $hor;?>'><?php echo show_odd($row['h_odd']);?></td>
    <td <?echo ($_GET["SORTBY"]=='12'? "bgcolor='#D3EBAB'": "");?> class='ctd' ><?php echo show_odd($row['d_odd']);?></td>
    <td <?echo ($_GET["SORTBY"]=='11'? "bgcolor='#D3EBAB'": "");?> class='ctd <?php echo $aor;?>'><?php echo show_odd($row['a_odd']);?></td>
    <td class='ctd'><a title='Over Round Details' class='sbar' href="javascript:OrWin('overround.php?db=<?php echo $db;?>&id=<?php echo $matchno;?>')"><?php echo num20($or->match_or);?>%</a></td>
    <td <?echo ($_GET["SORTBY"]=='7'? "bgcolor='#D3EBAB'": "");?> class='ctd' ><?php echo num2($row['hwinpb']);?></td>
    <td class="ctd <?echo $asl_class . $pr;?>"><?echo $row['hgoal'] . dash() . $row['agoal'];?></td>
		
    	<td class="ctd <?echo $asl_class;?>">
    		<a class='<?echo $sbar;?>' href="javascript:tell('full_odds.php?id=<?echo $matchno;?>&db=<?echo $db;?>')">
    			<? if (strlen($act)<2){
    				echo "Odds";
    			}else{
    				echo $row['h_s'] . dash() . $row['a_s']; 
    			}	
    			?>
    		</a>
    	</td>
		
	</tr>

<?}?>


 

<tr bgcolor="#f4f4f4">
    
    <td colspan="3" class="rtd padd bot">Postponed Matches</td>
    <td colspan="1" class="ctd padd bot"><?echo $postponed; ?></td>
    <td colspan="3" class="rtd padd bot">Total Correct Calls</td>
    <td colspan="1" class="ctd padd bot"><?echo $ngot; ?></td>
    <td colspan="2" class="ctd padd bot"><?echo num2(($ngot/$number)*100) ."%" ; ?></td>
 
  </tr> 
 <tr bgcolor="#f4f4f4">
    <td colspan="8" class="rtd padd bot">Total Correct Score Hits</td>
    <td colspan="2" class="ctd padd bot"><?echo $css; ?></td>
   
  </tr> 

<?}else{ ?>

    <tr>
        <td colspan="11" class="credit ctd padd" style="color:red;padding:30px;">No Match for selected options</td>
    </tr>

<?}?>

</table>


<!-- stopprint -->

			   
			   
			   
			   



<table width='100%' border='0' cellpadding='0' cellspacing='0'>
<tr>
<td style="width:165px;background:url('images/bbg.gif') no-repeat;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:8px;">
	<?= $fff ?>
</td>

<td style="font-weight:normal;text-align:center;padding-top:5px;">
	
	*  Click on "Date/Time & PIC" to view <B>Performance Indicator Chart</B> and associated backup data<BR><BR>
	
	<B>ASL</B>&nbsp;=&nbsp;</FONT><font size="1">Our Anticipated Score-Line&nbsp;&nbsp;<br/>
	<B>Act Res</B>&nbsp;=&nbsp;</FONT><font size="1">Actual Result (once known)
	
	

	
	<? if ($DIV=='NC'): echo "<br>Ebbsfleet U - formerly Gravesend"; endif; ?>

	</font>
</td>
    <td style="width:90px;background:url('images/bbsm-right.gif') no-repeat right ;height:59px;font-size:10px;font-family:verdana;text-align:center;padding-top:4px;;">
        Click here<br /> to view<br />all Odds
   </td>
</tr>
</table>
<br>


<? endif;?>


<div style="padding-bottom:5px">&nbsp;</div>
		
<? //include("pred-disclaimer.ini.php");  ?>
<? include("footer.ini.php"); ?>


<?	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>
