<?php	
include("config.ini.php");
include("function.ini.php");
$active_mtab = 1;
  
$page_title = "FIFA World Cup 2014 Brazil - OUTRIGHT WIN ODDS";
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

<?

    $data[]="	br	,	Brazil	,	3.75	,	4.00	,	4.00	,	3.50	,	4.00	,	4.00	,	4.00	,	4.00	";
    $data[]="	ar	,	Argentina	,	5.50	,	6.00	,	5.50	,	5.50	,	6.00	,	5.50	,	6.00	,	6.00	";
    $data[]="	ge	,	Germany	,	6.50	,	6.00	,	6.50	,	7.00	,	6.50	,	6.00	,	6.00	,	6.50	";
    $data[]="	es	,	Spain	,	7.50	,	8.00	,	8.00	,	7.00	,	8.00	,	7.00	,	8.00	,	8.00	";
    $data[]="	be	,	Belgium	,	15.00	,	15.00	,	15.00	,	19.00	,	19.00	,	17.00	,	15.00	,	17.00	";
    $data[]="	fr	,	France	,	23.00	,	19.00	,	21.00	,	23.00	,	21.00	,	21.00	,	19.00	,	17.00	";
    $data[]="	it	,	Italy	,	26.00	,	26.00	,	26.00	,	21.00	,	29.00	,	23.00	,	26.00	,	26.00	";
    $data[]="	ur	,	Uruguay	,	26.00	,	26.00	,	26.00	,	26.00	,	29.00	,	29.00	,	26.00	,	26.00	";
    $data[]="	co	,	Colombia	,	29.00	,	23.00	,	23.00	,	29.00	,	26.00	,	23.00	,	23.00	,	26.00	";
    $data[]="	ne	,	Netherlands	,	31.00	,	26.00	,	29.00	,	29.00	,	34.00	,	29.00	,	26.00	,	26.00	";
    $data[]="	en	,	England	,	34.00	,	34.00	,	34.00	,	34.00	,	34.00	,	34.00	,	34.00	,	34.00	";
    $data[]="	pt	,	Portugal	,	34.00	,	26.00	,	34.00	,	34.00	,	34.00	,	23.00	,	26.00	,	34.00	";
    $data[]="	ch	,	Chile	,	41.00	,	41.00	,	41.00	,	41.00	,	51.00	,	34.00	,	41.00	,	41.00	";
    $data[]="	ru	,	Russia	,	81.00	,	67.00	,	67.00	,	81.00	,	101.00	,	81.00	,	67.00	,	67.00	";
    $data[]="	mx	,	Mexico	,	101.00	,	151.00	,	151.00	,	151.00	,	126.00	,	126.00	,	151.00	,	126.00	";
    $data[]="	sw	,	Switzerland	,	101.00	,	67.00	,	101.00	,	101.00	,	126.00	,	101.00	,	67.00	,	101.00	";
    $data[]="	iv	,	Ivory Coast	,	126.00	,	126.00	,	151.00	,	151.00	,	151.00	,	151.00	,	126.00	,	101.00	";
    $data[]="	ec	,	Ecuador	,	126.00	,	151.00	,	151.00	,	151.00	,	151.00	,	151.00	,	151.00	,	126.00	";
    $data[]="	bo	,	Bosnia	,	151.00	,	126.00	,	151.00	,	201.00	,	201.00	,	201.00	,	126.00	,	151.00	";
    $data[]="	cr	,	Croatia	,	151.00	,	151.00	,	201.00	,	201.00	,	201.00	,	151.00	,	151.00	,	126.00	";
    $data[]="	jp	,	Japan	,	151.00	,	126.00	,	126.00	,	151.00	,	201.00	,	151.00	,	126.00	,	151.00	";
    $data[]="	us	,	USA	,	201.00	,	151.00	,	151.00	,	151.00	,	201.00	,	251.00	,	151.00	,	151.00	";
    $data[]="	gh	,	Ghana	,	251.00	,	151.00	,	201.00	,	201.00	,	201.00	,	201.00	,	151.00	,	151.00	";
    $data[]="	ni	,	Nigeria	,	251.00	,	251.00	,	251.00	,	301.00	,	301.00	,	201.00	,	251.00	,	201.00	";
    $data[]="	gr	,	Greece	,	301.00	,	251.00	,	251.00	,	201.00	,	301.00	,	251.00	,	251.00	,	201.00	";
    $data[]="	ko	,	South Korea	,	301.00	,	501.00	,	251.00	,	401.00	,	501.00	,	401.00	,	501.00	,	301.00	";
    $data[]="	au	,	Australia	,	501.00	,	501.00	,	751.00	,	501.00	,	751.00	,	1001.00	,	501.00	,	501.00	";
    $data[]="	ca	,	Cameroon	,	501.00	,	401.00	,	751.00	,	501.00	,	1001.00	,	751.00	,	401.00	,	501.00	";
    $data[]="	al	,	Algeria	,	1501.00	,	1501.00	,	1001.00	,	1001.00	,	2501.00	,	1001.00	,	1501.00	,	2001.00	";
    $data[]="	ir	,	Iran	,	1501.00	,	1501.00	,	751.00	,	1001.00	,	1501.00	,	1501.00	,	1501.00	,	1501.00	";
    $data[]="	ho	,	Honduras	,	2001.00	,	1501.00	,	2501.00	,	1001.00	,	4001.00	,	1501.00	,	1501.00	,	3001.00	";
    $data[]="	ri	,	Costa Rica	,	2501.00	,	1501.00	,	2501.00	,	1001.00	,	4001.00	,	2001.00	,	1501.00	,	2001.00	";

   
   
?>   
<!-- startprint -->
      
    	<table border="1" cellpadding="4"  width="570" style="border-collapse: collapse" bordercolor="#D2D2D2" cellspacing="0">
    		<tr bgcolor="#D3EBAB">
          <td class="wcteam bold wcwide ctd">Teams</td>
    			<td class="wcteam bold wcsm ctd">Bet365</td>
    			<td class="wcteam bold wcsm ctd">GB</td>
    			<td class="wcteam bold wcsm ctd">WH</td>
    			<td class="wcteam bold wcsm ctd">SP</td>
    			<td class="wcteam bold wcsm ctd">VC</td>
    			<td class="wcteam bold wcsm ctd">LB</td>
    			<td class="wcteam bold wcsm ctd">BW</td>
          <td class="wcteam bold wcsm ctd" alt='PaddyPower'>PP</td>
          
    		</tr>

    
<?php    
    
     for ($i=0; $i<count($data); $i++){
        $line = explode("," , $data[$i]);
           
?>  

        		<tr <? echo rowcol($i);?> >
        			<td class="wctd wcname" style="background:url(worldcup/<? echo trim($line[0]);?>.gif) no-repeat 3px center;padding-left:40px;"><? echo strtoupper($line[1]); ?></td>
        			<td class="wctd ctd"><? echo $line[2];?></td>
        			<td class="wctd ctd"><? echo $line[3]; ?></td>
        			<td class="wctd ctd"><? echo $line[4]; ?></td>
        			<td class="wctd ctd"><? echo $line[5]; ?></td>
        			<td class="wctd ctd"><? echo $line[6]; ?></td>
        			<td class="wctd ctd"><? echo $line[7]; ?></td>
        			<td class="wctd ctd"><? echo $line[8]; ?></td>
              <td class="wctd ctd"><? echo $line[9]; ?></td>
        		</tr>

       
        
<?} // main for loop ?>



  </table>

<!-- stopprint -->  
  
  <div style="padding-bottom:10px"></div>

  <div style='padding:5px; font-size:11px;font-family:verdana;'>
       Odds collected on: 08-May-2014 <br/><br/>
       
       Bet365 = bet365.com <br/>
       GB = gamebookers.com <br/>
       WH = williamhill.com <br/>
       SP = sportingbet.com <br/>
       VC = betvictor.com<br/>
       LB = ladbrokes.com<br/>
       BW = bwin.com<br/>
       PP = paddypower.com<br/>
  
  
  </div>



<?= back() ?>

<div style="padding-bottom:10px"></div>	
  
	

<? include("footer.ini.php"); ?>