<?php
session_start();
include("config.ini.php");
include("function.ini.php");

$mywin = "mywin";

if (isset($_REQUEST["season"])){
    $cur = $_REQUEST['season'] ;
}else{ 
  $cur = '2013-2014';
}

?>
<html>
<head>
<title>Bookies 'Short Odds' Betting Outcomes</title>

<link rel="stylesheet" type="text/css" href="css/style_v4.css">

<script TYPE="text/javascript">
function Matrix(url)
{
	window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=900,height=720");
}
</script>

</head>

<body>

<? page_header("Bookies 'Short Odds' Betting Outcomes") ; ?>

<!--  bgcolor="#EFF5FA" -->


<form method="get" action="<?=$PHP_SELF?>" style="padding:0;margin:0;">

<table border="0" width="90%" cellpadding="3" style="border-collapse: collapse;margin:auto auto" bordercolor="#cccccc"  >
<tr>
  <td  width="5%" >
	<span class='credit'><font  color="#0000ff">Season</font></span></td>
  <td  height="22"  >
	   <select size="1" name="season"  onChange="this.form.submit();">
	  
	  <? 
	    $cur_sea = curseason('eu');
	   
		$tempw = $eu->prepare("SELECT distinct(season) as season from fixtures where season<>'Fifa-2014' order by season desc") ;
	    $tempw->execute();
        
	   while ($sr = $tempw->fetch() ) : 
	  ?>
		  <option value="<?= $sr["season"] ?>" <?echo selected($cur, $sr["season"])?>><?= $sr["season"] ?></option>
	  
	  <? endwhile; ?>
</select>
 </table>

</form>



<div style="padding-top:5px"></div>
 
<table border="1" cellpadding="3" cellspacing="0" style="border-collapse: collapse" bordercolor="#cccccccc" width="90%" align="center" >
<tr bgcolor="#D3EBAB" height="25">
	<td align="center" rowspan="2" width="40"><b>Week </b></td>
	<td align="center" colspan="4"><span class='credit' style="color:#0000ff">BOOKIES' HOME WIN PREDICTIONS</span></td>
	<td align="center" width="2" bgcolor="#999999"></td>
	<td align="center" colspan="4"><span class='credit' style="color:#ff0000">BOOKIES' AWAY WIN PREDICTIONS</span></td>
</tr>


<tr bgcolor="#D3EBAB">
	<td class='ctd padd' width="80"><b>Total</b></td>
	<td class='ctd padd' width="80"><b>Correct</b></td>
	<td class='ctd padd' width="80"><b>Gross Return</b></td>
	<td class='ctd padd' width="80"><b>NET Return</b></td>
	<td class='ctd padd' width="2" bgcolor="#999999"></td>
	<td class='ctd padd' width="80"><b>Total</b></td>
	<td class='ctd padd' width="80"><b>Correct</b></td>
	<td class='ctd padd' width="80"><b>Gross Return</b></td>
	<td class='ctd padd' width="80"><b>NET Return</b></td>
</tr>

<?
  $max_hodd = 1.50;
  $max_aodd = 1.50;
  
  $max_wk = find_last_week_of_season($cur,'eu') ;

  
	$n=0; 
	$hw_no=$hw_ct=$hw_rt=$hw_net=$aw_no=$aw_ct=$aw_rt=$aw_net=0;

   $window ='<a class="pp" href="javascript:Matrix(\'short_odds_detail.php?WK=';


for ($i=1; $i<=$max_wk; $i++)
{

	  
    $rowcol = rowcol($i);
		$td ="class='ctd'";


	  $data = get_rt_summary($i, "H", $cur, $max_hodd) ;
    
    echo "<tr $rowcol>\n";
		echo "   <td $td >$i</td>\n";
    		
		if ($data->calls>0){
			$win = $window .  $i. "&season=$cur&ID=H')\">{$data->calls}</a>";
			echo "   <td class='ctd' >$win</td>\n";
		    echo "   <td class='ctd' >$data->correct</td>\n";
		    echo "   <td class='ctd' >". prtno($data->gross). "</td>\n";
		    echo "   <td class='ctd' >". prtno($data->gross-$data->calls) ."</td>\n";
		}else{
      		echo "   <td class='ctd' >-</td>\n";
      		echo "   <td class='ctd' >-</td>\n";
      		echo "   <td class='ctd' >-</td>\n";
      		echo "   <td class='ctd' >-</td>\n";
        }
	
		echo "   <td class='ctd' bgcolor=\"#999999\"></td>\n";

	  $hw_no+= $data->calls ; $hw_ct+= $data->correct ; $hw_rt+= $data->gross ;
	
	  $data = get_rt_summary($i, "A", $cur, $max_hodd) ;
    		
		if ($data->calls>0){
			$win = $window .  $i. "&season=$cur&ID=A')\">{$data->calls}</a>";
      		echo "   <td class='ctd' >$win</td>\n";
      		echo "   <td class='ctd' >$data->correct</td>\n";
      		echo "   <td class='ctd' >". prtno($data->gross). "</td>\n";
      		echo "   <td class='ctd' >". prtno($data->gross-$data->calls) ."</td>\n";
		}else { 
      		echo "   <td class='ctd' >-</td>\n";
      		echo "   <td class='ctd' >-</td>\n";
      		echo "   <td class='ctd' >-</td>\n";
      		echo "   <td class='ctd' >-</td>\n";
    }
		
		echo "</tr>\n";

		$aw_no+= $data->calls ; $aw_ct+= $data->correct ; $aw_rt+= $data->gross ; 

}	
	
$hw_net = number_format($hw_rt - $hw_no,2,'.','')  ;
$aw_net = number_format($aw_rt - $aw_no,2,'.','')  ;

$td = "class='total ctd'";
echo "<tr bgcolor='#f4f4f4' height='25'>\n";
echo "   <td $td>TOTAL</td>\n";
echo "   <td $td>$hw_no</td>\n";
echo "   <td $td>$hw_ct</td>\n";
echo "   <td $td>$hw_rt</td>\n";
echo "   <td $td>$hw_net</td>\n";
echo "   <td bgcolor=\"#999999\"></td>\n";
echo "   <td $td>$aw_no</td>\n";
echo "   <td $td>$aw_ct</td>\n";
echo "   <td $td>$aw_rt</td>\n";
echo "   <td $td>$aw_net</td>\n";
echo "</tr>\n";


?>
</table>

<div style="width:200px;margin:20px auto 0 auto;text-align:center;padding:8px;border:1px solid #ccc;font-size:13px;color:#0000ff;background:#fff;">
	<a class='sbar' href='javascript:window.close();'>Close this Window</a>
</div>    




<div style="padding-bottom:5px"></div>
</body>
</html>


<?
function get_rt_summary($weekno, $side, $season, $max_odd)
{
  global $eu;
  
  $nCall=0; $nCorrect=0; $nGross=0;
  
  if ($side=="H"){
    $sql = "select season,weekno,mvalue,h_s, a_s, h_odd, a_odd from fixtures where season='$season' and weekno='$weekno' " ;
    $sql.= " and `div`<>'RP' and `div`<>'MP' and `div`<>'UP' and mvalue>0 and h_odd>0 and h_odd<='$max_odd'" ; 
  }else{
    $sql = "select season,weekno,mvalue,h_s, a_s, h_odd, a_odd from fixtures where season='$season' and weekno='$weekno' " ;
    $sql.= " and `div`<>'RP' and `div`<>'MP' and `div`<>'UP' and mvalue>0 and a_odd>0 and a_odd<='$max_odd'" ; 
  }
  
  $temp = $eu->prepare($sql);
  $temp->execute();
    
  while ($dd = $temp->fetch() ){
    
    $nCall++ ;
    if ($side=="H"){
      $nCorrect += ($dd[h_s]>$dd[a_s]? 1 : 0 );
      $nGross   += ($dd[h_s]>$dd[a_s]? $dd[h_odd] : 0 );
    }else{
      $nCorrect += ($dd[a_s]>$dd[h_s]? 1 : 0 );
      $nGross   += ($dd[a_s]>$dd[h_s]? $dd[a_odd] : 0 );
    }
  
  }
  
  $data = new stdClass();
  $data->calls   = $nCall ;
  $data->correct = $nCorrect;
  $data->gross   = $nGross;
  
  return $data;
}

?>