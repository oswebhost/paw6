<?
include("config.ini.php");
include("function.ini.php");

$id = $_GET["id"] ;
$db = 'eu';
$sea = 'Fifa-2014';

$qry2 = "select date_format(match_date,'%d-%b-%Y') as mdate,hteam,ateam,h_odd, d_odd, a_odd,match_time from fifa_fixt where season='$sea' and mid='$id'";


if ($db=='eu'){
   $temp2 = $eu->prepare($qry2) ;
}else{
   $temp2 = $sa->prepare($qry2);
}
$temp2->execute();
$d = $temp2->fetch() ;



?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd"> 


<html>

<head>

<link rel="shortcut icon" href="images/betware.ico"/>
<meta http-equiv="Content-Language" content="en-us"/>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252"/>
<meta name="title" content="Soccer Predictions"/>
<link rel="stylesheet" type="text/css" href="css/style.css" MEDIA="screen"/>

<title><? echo $d["hteam"] . " v ". $d["ateam"] . " Odds" ;?></title>

</head>
<body>
<? page_header("Match Odds") ; ?>
<center>



<table width='99%' cellpadding='4' border='0' style="background:#f4f4f4;border:2px solid #ccc;">
<tr>
	<td width='50%' valign='top' class='ctd'>
	
<div style="margin-top:0px;padding:2px;border:1px solid #ccc;font-size:13px;color:#0000ff;background:#fff;">	
	    <table width='100%'>
		<tr>
			<td width='48%' class='ctd'><font color='blue' size='+1'><? echo $d["hteam"] ?></font></td>
			<td width='4%' class='ctd'><font color='#cccccc' size='+1'>v</font></td>
			<td width='48%' class='ctd'><font color='red' size='+1'><? echo $d["ateam"] ?></font></td>
		</tr>
		<tr>
			<td colspan='3' class='ctd'><font size='2'><? echo $d["mdate"]. "&nbsp;<font size='1'>" . substr($d['match_time'],0,5) . "</font>";  ?></font></td>
		</tr>
		
		</table>
</div>

		<br>
		<table border='1' width='350' cellpadding='3' style="border-collapse: collapse" bordercolor="#999999">
		 <tr>
			<td colspan='3' class='ctd eurotb' bgcolor='#cccccc'><b>1X2</b></td>
		 </tr>
		 <tr>
			<td width='33%' class='ctd odds' bgcolor='#f4f4f4'><b>1</b></td>
			<td width='33%' class='ctd odds' bgcolor='#f4f4f4'><b>X</b></td>
			<td width='33%' class='ctd odds' bgcolor='#f4f4f4'><b>2</b></td>
		 </tr>
		  <tr>	
			  <td class='ctd odds' bgcolor='#ffffff'><?echo num2($d["h_odd"]); ?></td>
			  <td class='ctd odds' bgcolor='#ffffff'><?echo num2($d["d_odd"]); ?></td>
			  <td class='ctd odds' bgcolor='#ffffff'><?echo num2($d["a_odd"]); ?></td>
		  </tr>
		</table>
		<? echo bookie_name("BET"); ?>
		
	<?  
        $qry2 = "select * from other_odds where season='$sea' and matchno='$id'";
        if ($db=='eu'){
           $temp2 = $eu->prepare($qry2) ;
        }else{
           $temp2 = $sa->prepare($qry2);
        }
        $temp2->execute();
        $dd = $temp2->fetch() ;
        
	   if ($dd["hw_x"]>0): ?>
		<div style='padding-top:10px;'></div>
		<table border='1' width='350' cellpadding='3' style="border-collapse: collapse" bordercolor="#999999">
		 <tr>
			<td colspan='3' class='ctd eurotb' bgcolor='#cccccc'><b>Double Chance</b></td>
		 </tr>
		 <tr>
			<td width='33%' class='ctd odds' bgcolor='#f4f4f4'><b>1 or X</b></td>
			<td width='33%' class='ctd odds' bgcolor='#f4f4f4'><b>X or 2</b></td>
			<td width='33%' class='ctd odds' bgcolor='#f4f4f4'><b>1 or 2</b></td>
		 </tr>
		 <?
			 
			 
		 ?>
		  <tr>	
			  <td class='ctd odds' bgcolor='#ffffff'><?echo num2($dd["hw_x"]); ?></td>
			  <td class='ctd odds' bgcolor='#ffffff'><?echo num2($dd["aw_x"]); ?></td>
			  <td class='ctd odds' bgcolor='#ffffff'><?echo num2($dd["hw_aw"]); ?></td>
		  </tr>
		</table>
		<? echo bookie_name((strlen($dd["dchance"])>0 ? $dd["dchance"] : "BET")); 
		   endif;
		?>
	
	  <? if ($dd["ht_hh"]>0): ?>
	
		<div style='padding-top:10px;'></div>
		<table border='1' width='350' cellpadding='3' style="border-collapse: collapse" bordercolor="#999999">
		 <tr>
			<td colspan='6' class='ctd eurotb' bgcolor='#cccccc'><b>Half-Time/Full-Time</b></td>
		 </tr>
		 <tr>
			<td width='16%' class='ctd odds' style='border-right:0;'><b>1/1</b></td>
			<td width='16%' class='ctd odds' bgcolor='#ffffff' style='border-left:0;'><?= num2($dd["ht_hh"]);?></td>

			<td width='16%' class='ctd odds' style='border-right:0;'><b>2/1</b></td>
			<td width='16%' class='ctd odds' bgcolor='#ffffff' style='border-left:0;'><?= num2($dd["ht_ah"]);?></td>

			<td width='16%' class='ctd odds' style='border-right:0;'><b>X/1</b></td>
			<td width='16%' class='ctd odds' bgcolor='#ffffff' style='border-left:0;'><?= num2($dd["ht_dh"]);?></td>
		 </tr>

		 <tr>
			<td width='16%' class='ctd odds' style='border-right:0;'><b>1/2</b></td>
			<td width='16%' class='ctd odds' bgcolor='#ffffff' style='border-left:0;'><?= num2($dd["ht_ha"]);?></td>

			<td width='16%' class='ctd odds' style='border-right:0;'><b>2/2</b></td>
			<td width='16%' class='ctd odds' bgcolor='#ffffff' style='border-left:0;'><?= num2($dd["ht_aa"]);?></td>

			<td width='16%' class='ctd odds' style='border-right:0;'><b>X/2</b></td>
			<td width='16%' class='ctd odds' bgcolor='#ffffff' style='border-left:0;'><?= num2($dd["ht_da"]);?></td>
		 </tr>
		 <tr>
			<td width='16%' class='ctd odds' style='border-right:0;'><b>1/X</b></td>
			<td width='16%' class='ctd odds' bgcolor='#ffffff' style='border-left:0;'><?= num2($dd["ht_hd"]);?></td>

			<td width='16%' class='ctd odds' style='border-right:0;'><b>2/X</b></td>
			<td width='16%' class='ctd odds' bgcolor='#ffffff' style='border-left:0;'><?= num2($dd["ht_ad"]);?></td>

			<td width='16%' class='ctd odds' style='border-right:0;'><b>X/X</b></td>
			<td width='16%' class='ctd odds' bgcolor='#ffffff' style='border-left:0;'><?= num2($dd["ht_dd"]);?></td>
		 </tr>
		 
		</table>
		<? echo bookie_name((strlen($dd["dchance"])>0 ? $dd["dchance"] : "BET")); 
		
		  endif;
		
		?>
		
		
		<div style='padding-top:10px;'></div>
		
		<table width='100%' cellpadding='0'>
		 <tr>
			<td width='48%' valign='top' class='ctd'>
			
			<? if ($dd["un_odd"]>0): ?>
			
			<table border='1' width='100%' cellpadding='3' style="border-collapse: collapse" bordercolor="#999999">
			<tr>
				<td colspan='2' class='ctd eurotb' bgcolor='#cccccc'><b>Under/Over 2.5 Goals</b></td>
			</tr>
			<tr>
				<td class='ctd odds' width='50%'>Under</td>
				<td class='ctd odds' width='50%'>Over</td>
			</tr>
			<tr>
				<td class='ctd odds' bgcolor='#ffffff' width='50%'><?= num2($dd["un_odd"]);?></td>
				<td class='ctd odds' bgcolor='#ffffff' width='50%'><?= num2($dd["ov_odd"]);?></td>
			</tr>
			</table>
			<? echo bookie_name((strlen($dd["underover"])>0 ? $dd["underover"] : "BET")); 
			   endif;
			?>
			
			
			</td>
			<td width='5%'>&nbsp;</td>
			<td width='50%' valign='top'  class='ctd'> 
			
			<?  if ($dd["hw_odd"]>0): ?>
			<table border='1' width='100%' cellpadding='3' style="border-collapse: collapse" bordercolor="#999999">
			<tr>
				<td colspan='2' class='ctd eurotb' bgcolor='#cccccc'><b>Draw =  No Bet</b></td>
			</tr>
			<tr>
				<td class='odds' width='75%'><?= $d["hteam"] ?></td>
				<td class='ctd odds' width='25%' bgcolor='#ffffff'><?= num2($dd["hw_odd"]); ?></td>
			</tr>
			<tr>
				<td class='odds'><?= $d["ateam"] ?></td>
				<td class='ctd odds' bgcolor='#ffffff'><?= num2($dd["aw_odd"]); ?></td>
			</tr>
			
			</table>
			<? echo bookie_name((strlen($dd["winonly"])>0 ? $dd["winonly"] : "BET")); 
			   endif;
			?>

			</td>
		 </tr>		
		</table>
	
	</td>
	<td width='50%' valign='top' class='ctd'>
	
	<?
	   $qry2 = "select * from `ahcap_odds` where season='$sea' and matchno='$id'";
	   
        if ($db=='eu'){
           $temp2 = $eu->prepare($qry2) ;
        }else{
           $temp2 = $sa->prepare($qry2);
        }
        $temp2->execute();
        $ahb = $temp2->fetch() ;

	   if ($ahb["ht_odd"]>0): 
	?>
	
	<table border='1' width='100%' cellpadding='3' style="border-collapse: collapse" bordercolor="#999999">
	<tr>
		<td colspan='3' class='ctd eurotb' bgcolor='#cccccc'><b>Asian Handicap</b></td>
	</tr>
	
	<tr>
		<td width='60%' class='ctd'	bgcolor='#f4f4f4'></td>
		<td width='20%' class='ctd' bgcolor='#f4f4f4'><b>Handicap</b></td>
		<td width='20%' class='ctd' bgcolor='#f4f4f4'><b>Odds</b></td>
	</tr>
     <tr>
		<td class='odds'><?= $d["hteam"] ?></td>
		<td class='odds ctd' bgcolor='#ffffff'><?= $ahb["ht_hcap"];?></td>
		<td class='odds ctd' bgcolor='#ffffff'><?= num2($ahb["ht_odd"]);?></td>
	</tr>
	<tr>
		<td class='odds'><?= $d["ateam"] ?></td>
		<td class='odds ctd' bgcolor='#ffffff'><?= $ahb["at_hcap"];?></td>
		<td class='odds ctd' bgcolor='#ffffff'><?= num2($ahb["at_odd"]);?></td>
	</tr>
    </table>   
	<? echo bookie_name("BET"); 
	   endif;
	?>

	<div style='padding-top:10px;'></div>
	<?
    
    
  $qry2 = "select * from full_csodds where season='$sea' and matchno='$id' and rt_class='H' order by rid";
    if ($db=='eu'){
        $temp2 = $eu->prepare($qry2) ;
    }else{
        $temp2 = $sa->prepare($qry2);
    }
    $temp2->execute();
    
    if ($temp2->rowcount()>0 ){
  
  ?>
	
	<table border='0' width='100%' cellpadding='0' style="border-collapse: collapse" bordercolor="#999999">
	<tr>
		<td colspan='3' class='ctd eurotb' bgcolor='#cccccc' style='border:1px solid #999999;padding:2px;border-bottom:0'><b>Correct Scores</b></td>
	</tr>
		<td width='33%' class='ctd' valign='top'>
		
		<?
		  $qry2 = "select * from full_csodds where season='$sea' and matchno='$id' and rt_class='H' order by rid";
            if ($db=='eu'){
                $temp2 = $eu->prepare($qry2) ;
            }else{
                $temp2 = $sa->prepare($qry2);
            }
            $temp2->execute();
          
		  echo "<table width='100%' cellpadding='2' cellspacing='0' border='1' style=\"border-collapse: collapse\" bordercolor=\"#999999\">\n";
		  $n = 0;
		  while ($cs = $temp2->fetch() ):
		    $bg = ($n%2? " bgcolor='#f4f4f4'" : '');
			echo "<tr ". $bg  .">";
			echo "<td width='50%' class='ctd odds' style='border-right:0'>"  . $cs["caption"] . "</td>\n";
			echo "<td width='50%' class='ctd odds' bgcolor='#ffffff' style='border-left:0'>"  . num2($cs["odds"]). "</td>\n";
			echo "</tr>\n";
			$n++;
		  endwhile;
		  echo "</table>\n";		
		?>
		</td>
		<td width='33%' class='ctd' valign='top'>
		<?
		  $qry2 = "select * from full_csodds where season='$sea' and matchno='$id' and rt_class='D' order by rid";
          
            if ($db=='eu'){
                $temp2 = $eu->prepare($qry2) ;
            }else{
                $temp2 = $sa->prepare($qry2);
            }
            $temp2->execute();
          
          
		  echo "<table width='100%' cellpadding='2' cellspacing='0'  style=\"border-collapse: collapse;border-bottom:1px solid #999999;\" >\n";
		  $n = 0;
		  while ($cs = $temp2->fetch() ):
		    $bg = ($n%2? " bgcolor='#f4f4f4'" : '');
			echo "<tr ". $bg  .">";
			echo "<td width='50%' class='ctd odds' style='border-top:1px solid #999999;style='border-bottom:1px solid #999999;'>"  . $cs["caption"] . "</td>\n";
			echo "<td width='50%' class='ctd odds' bgcolor='#ffffff' style='border-left:0px solid #999999;border-top:1px solid #999999;style='border-bottom:1px solid #999999;'>"  . num2($cs["odds"]). "</td>\n";
			echo "</tr>\n";
			$n++;
		  endwhile;
		  echo "</table>\n";		
		?>
	</td>
		<td width='33%' class='ctd' valign='top'>
		
		<?
		  $qry2 = "select * from full_csodds where season='$sea' and matchno='$id' and rt_class='A' order by rid";
            if ($db=='eu'){
                $temp2 = $eu->prepare($qry2) ;
            }else{
                $temp2 = $sa->prepare($qry2);
            }
            $temp2->execute();
          

		  echo "<table width='100%' cellpadding='2' cellspacing='0' border='1' style=\"border-collapse: collapse\" bordercolor=\"#999999\">\n";
		  $n = 0;
		 while ($cs = $temp2->fetch() ):
		    $bg = ($n%2? " bgcolor='#f4f4f4'" : '');
			echo "<tr ". $bg  .">";
			echo "<td width='50%' class='ctd odds' style='border-right:0'>"  . $cs["caption"] . "</td>\n";
			echo "<td width='50%' class='ctd odds' bgcolor='#ffffff' style='border-left:0'>"  . num2($cs["odds"]). "</td>\n";
			echo "</tr>\n";
			$n++;
		  endwhile;
		  echo "</table>\n";		
		?>
		</td>
	
	</table>
	
	<? echo bookie_name("BET"); ?>

	 <? } ?>	

		<div style="margin-top:15px;padding:8px;border:1px solid #ccc;font-size:13px;color:#0000ff;background:#fff;">
		<a class='sbar' href='javascript:window.close();'>Close Window</a>
	
	</div>
	
	
	</td>
</tr>
</table>
</center>
</body>

</html>

