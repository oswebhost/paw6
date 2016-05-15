<?php	
//include("authorization.php");

include("config.ini.php");
include("function.ini.php");

$active_mtab = 1;
  
$page_title="FIFA World Cup 2014 Brazil - Odds for 1st Round No. of Points";
include("header.ini.php"); 
 
page_header($page_title); 
  
?>
<div style='border:0px solid red;width:572px;'>
<img src='worldcup/logo.gif' border='0' alt='<?echo $page_title;?>'>
</div>
	
	
  <div style="padding:15px">
  <table  width="98%" align="center" border="0">
  <tr>
  	<td width='10%'> <? echo back(); ?> </td>
  	<td align="center" width='80%'></td>
  	<td width='10%' align="right"><? echo printscr(); ?></td>
  </tr>
  </table>
</div>


<!-- startprint -->

<table width="570" border="1" cellspacing="0" cellpadding="4"  style="border-collapse: collapse;margin:auto auto;" bordercolor="#999999">
 
  <tr bgcolor="#D3EBAB" >
    <td class="wctd ctd btd">Group</td>
    <td class="wctd ctd btd">Rank</td>
    <td class="wcwide wctd ctd btd wcteam">Team</td>

    <td class="wctd ctd btd wcpt">Points</td>
    <td class="wctd ctd btd wcodd">Odds</td>
    
    <td class="wctd ctd btd wcincl">Points</td>
    <td class="wctd ctd btd wcodd">Odds</td>

    <td class="wctd ctd btd wcpt">Points</td>
    <td class="wctd ctd btd wcodd">Odds</td>

  </tr>

 <?


    $data[]="	A	,	1	,	br	,	Brazil	,	6	,	5.00	,	6-7 Incl.	,	2.25	,	7	,	2.20, 3,	1";
    $data[]="	A	,	2	,	mx	,	Mexico	,	3	,	2.80	,	3-4 Incl.	,	2.15	,	4	,	3.75,	,	";
    $data[]="	A	,	3	,	cr	,	Croatia	,	4	,	2.00	,	4-5 Incl.	,	3.00	,	5	,	4.00,	,	";
    $data[]="	A	,	4	,	ca	,	Cameroon	,	2	,	2.25	,	2-3 Incl.	,	2.87	,	3	,	3.40,1,1	";
    
    $data[]="	B	,	1	,	es	,	Spain	,	5	,	3.75	,	5-6 Incl.	,	3.20	,	6	,	2.00,3	,1	";
    $data[]="	B	,	2	,	ne	,	Netherlands	,	4	,	3.75	,	4-5 Incl.	,	2.75	,	5	,	2.20	,	,	";
    $data[]="	B	,	3	,	ch	,	Chile	,	4	,	2.30	,	4-5 Incl.	,	2.87	,	5	,	3.25	,	,	";
    $data[]="	B	,	4	,	au	,	Australia	,	2	,	1.40	,	2-3 Incl.	,	4.00	,	3	,	7.50,1	,1	";
    
    $data[]="	C	,	1	,	cl	,	Colombia	,	5	,	2.50	,	5-6 Incl.	,	3.20	,	6	,	2.70	,	,	";
    $data[]="	C	,	2	,	iv	,	Ivory Coast	,	4	,	2.30	,	4-5 Incl.	,	2.70	,	5	,	3.60	,	,	";
    $data[]="	C	,	3	,	jp	,	Japan	,	4	,	1.90	,	4-5 Incl.	,	2.87	,	5	,	4.50	,1	,	1";
    $data[]="	C	,	4	,	gr	,	Greece	,	3	,	2.50	,	3-4 Incl.	,	2.25	,	4	,	4.00	,	,	";
    
    $data[]="	D	,	1	,	it	,	Italy	,	5	,	2.25	,	5-6 Incl.	,	3.10	,	6	,	3.10	,	,	";
    $data[]="	D	,	2	,	ur	,	Uruguay	,	5	,	2.10	,	5-6 Incl.	,	3.10	,	6	,	3.50	,	,	";
    $data[]="	D	,	3	,	en	,	England	,	4	,	3.00	,	4-5 Incl.	,	3.00	,	5	,	2.40	,	,	";
    $data[]="	D	,	4	,	ri	,	Costa Rica	,	2	,	1.53	,	2-3 Incl.	,	3.75	,	3	,	6.00	,1	,1	";
    
    $data[]="	E	,	1	,	fr	,	France	,	5	,	3.20	,	5-6 Incl.	,	3.20	,	6	,	2.20	,3	,	1";
    $data[]="	E	,	2	,	sw	,	Switzerland	,	4	,	2.90	,	4-5 Incl.	,	3.10	,	5	,	2.40	,	,	";
    $data[]="	E	,	3	,	ec	,	Ecuador	,	4	,	2.40	,	4-5 Incl.	,	3.25	,	5	,	2.75	,	,	";
    $data[]="	E	,	4	,	ho	,	Honduras	,	2	,	1.66	,	2-3 Incl.	,	3.40	,	3	,	5.00	,1	,1	";
    
    $data[]="	F	,	1	,	ar	,	Argentina	,	5	,	8.50	,	5-6 Incl.	,	4.20	,	6	,	1.36	,3	,	1";
    $data[]="	F	,	2	,	bo	,	Bosnia	,	4	,	2.30	,	4-5 Incl.	,	2.90	,	5	,	3.25	,	,	";
    $data[]="	F	,	3	,	ni	,	Nigeria	,	3	,	3.00	,	3-4 Incl.	,	2.10	,	4	,	3.60	,	,	";
    $data[]="	F	,	4	,	ir	,	Iran	,	2	,	1.80	,	2-3 Incl.	,	3.20	,	3	,	4.50	,	,	";
    
    $data[]="	G	,	1	,	ge	,	Germany	,	5	,	4.33	,	5-6 Incl.	,	3.40	,	6	,	1.80	,3	,1	";
    $data[]="	G	,	2	,	pt	,	Portugal	,	4	,	3.00	,	4-5 Incl.	,	3.00	,	5	,	2.40	,	,	";
    $data[]="	G	,	3	,	gh	,	Ghana	,	3	,	2.20	,	3-4 Incl.	,	2.30	,	4	,	5.00	,	,	";
    $data[]="	G	,	4	,	us	,	USA	,	3	,	2.05	,	3-4 Incl.	,	2.37	,	4	,	5.50	,	,	";
    
    $data[]="	H	,	1	,	be	,	Belgium	,	5	,	3.00	,	5-6 Incl.	,	3.20	,	6	,	2.25	,	,	";
    $data[]="	H	,	2	,	ru	,	Russia	,	4	,	3.60	,	4-5 Incl.	,	2.87	,	5	,	2.20	,3	,1	";
    $data[]="	H	,	3	,	ko	,	South Korea	,	3	,	3.00	,	3-4 Incl.	,	2.50	,	4	,	3.25	,	,	";
    $data[]="	H	,	4	,	al	,	Algeria	,	2	,	2.00	,	2-3 Incl.	,	3.10	,	3	,	3.75	,1	,	1";
  
  
  
  $x=0;

  for ($i=0; $i<count($data); $i++):

	$x++;

	$d_item = explode(",", $data[$i]);



	$bg = "" ;

	if ($d_item[1]=="1"):

	$bg = " bgcolor='#ddffdd'";

	elseif($d_item[1]=="2"):

	$bg = " bgcolor='#FFFFE1'";

	endif;

  

 ?>

  

 <tr <? echo rowcol($i);?>>

	  <td class="wctd ctd"><?=$d_item[0]?></td>

	  <td class="wctd ctd"><?=$d_item[1]?></td>

	  <td class="wctd cwteam" style="background:url(worldcup/<? echo trim($d_item[2]);?>.gif) no-repeat 3px center;padding-left:42px;"><?= strtoupper($d_item[3])?></td>

	  <td class="wctd ctd wcpt" <? echo ($d_item[10]==1? colorit($d_item[11]): ""); ?>><<?= trim($d_item[4])?></td>
    
    <td class="wctd ctd wcodd" ><?=$d_item[5]?></td> <!-- 1 -->
    	  
    
    <td class="wctd ctd wcpt" <? echo ($d_item[10]==2? colorit($d_item[11]): ""); ?>><?=$d_item[6]?></td> <!-- 1 -->
      
    <td class="wctd ctd wcodd"><?=$d_item[7]?></td>
      
    <td class="wctd ctd wcpt" <? echo ($d_item[10]==3? colorit($d_item[11]): ""); ?>>><?= trim($d_item[8]);?></td>  <!-- 2 -->
      
    <td class="wctd ctd"><?=$d_item[9]?></td>
      
    
      

  </tr>

 

 <? 

	if (($x%4)==0):

		echo "<tr><td colspan='12' bgcolor='#ccccccc' style='padding:2px;'></td></tr>\n";

	endif;

  endfor; 

 

 ?>

 

</table>

<div style="padding-left:5px;padding-top:5px;font-size:11px;font-family: verdana;">
    
    <div style="float: left;width:25px;background:yellow;border:1px solid #ccc;">&nbsp;</div>&nbsp;Soccer-Predictions.com's choice 
    <div class="clear" style="padding: 2px; padding-top:10px;"><span class='bb'>Outcome</span> = <b>8 out of 12 Correctly Called</b></div>
	<div class="clear" style="padding: 2px; padding-top:10px;"><span class='bb'>Winnings</span> = <b>2.57 Units on 12 Units Laid Out = 21.41% Profit!</b></div>
	
</div>

<br />
<br />
      
<div class="ctd" style="font-size:11px;font-family: verdana;text-align:center;">
    <font size='1'>(all Odds courtesy of <a class='sbar' href="http://bet365.com" target="_blank">Bet365</a>)</font>
</div>


<!-- stopprint -->

	

<? include("footer.ini.php"); 


function colorit($no){
    $bg ="";
    if ($no==1){
        $bg = "bgcolor='yellow'";
    }else{
        $bg = "bgcolor='pink'";
    }
    return $bg;
}

?>