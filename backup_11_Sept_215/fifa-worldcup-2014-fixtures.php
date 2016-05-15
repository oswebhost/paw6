<?php	
include("config.ini.php");
include("function.ini.php");
$active_mtab = 1;
  
$page_title = "FIFA World Cup 2014 Brazil - GROUP FIXTURES";
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


    $data[]="	A	,	12-Jun-14	,	Brazil	,	Croatia	,	20:00	,	br	,	cr	";
    $data[]="	A	,	13-Jun-14	,	Mexico	,	Cameroon	,	16:00	,	mx	,	ca	";
    $data[]="	B	,	13-Jun-14	,	Spain	,	Netherlands	,	20:00	,	es	,	ne	";
    $data[]="	B	,	13-Jun-14	,	Chile	,	Australia	,	22:00	,	ch	,	au	";
    $data[]="	C	,	14-Jun-14	,	Colombia	,	Greece	,	16:00	,	cl	,	gr	";
    $data[]="	C	,	14-Jun-14	,	Ivory Coast	,	Japan	,	22:00	,	iv	,	jp	";
    $data[]="	D	,	14-Jun-14	,	Uruguay	,	Costa Rica	,	19:00	,	ur	,	ri	";
    $data[]="	D	,	14-Jun-14	,	England	,	Italy	,	23:00	,	en	,	it	";
    
    
	$data[]="	E	,	15-Jun-14	,	Switzerland	,	Ecuador	,	16:00	,	sw	,	ec	";
    $data[]="	E	,	15-Jun-14	,	France	,	Honduras	,	19:00	,	fr	,	ho	";
    $data[]="	F	,	15-Jun-14	,	Argentina	,	Bosnia	,	22:00	,	ar	,	bo	";
    $data[]="	F	,	16-Jun-14	,	Iran	,	Nigeria	,	19:00	,	ir	,	ni	";
    $data[]="	G	,	16-Jun-14	,	Germany	,	Portugal	,	16:00	,	ge	,	pt	";
    $data[]="	G	,	16-Jun-14	,	Ghana	,	USA	,	22:00	,	gh	,	us	";
    $data[]="	H	,	17-Jun-14	,	Belgium	,	Algeria	,	16:00	,	be	,	al	";
    $data[]="	H	,	17-Jun-14	,	Russia	,	South Korea	,	22:00	,	ru	,	ko	";
    $data[]="	A	,	17-Jun-14	,	Brazil	,	Mexico	,	19:00	,	br	,	mx	";
    $data[]="	A	,	18-Jun-14	,	Cameroon	,	Croatia	,	22:00	,	ca	,	cr	";
    $data[]="	B	,	18-Jun-14	,	Australia	,	Netherlands	,	16:00	,	au	,	ne	";
    $data[]="	B	,	18-Jun-14	,	Spain	,	Chile	,	19:00	,	es	,	ch	";
    $data[]="	C	,	19-Jun-14	,	Colombia	,	Ivory Coast	,	16:00	,	cl	,	iv	";
    $data[]="	C	,	19-Jun-14	,	Japan	,	Greece	,	22:00	,	jp	,	gr	";
    $data[]="	D	,	19-Jun-14	,	Uruguay	,	England	,	19:00	,	ur	,	en	";
    $data[]="	D	,	20-Jun-14	,	Italy	,	Costa Rica	,	16:00	,	it	,	ri	";
    $data[]="	E	,	20-Jun-14	,	Switzerland	,	France	,	19:00	,	sw	,	fr	";
    $data[]="	E	,	20-Jun-14	,	Honduras	,	Ecuador	,	22:00	,	ho	,	ec	";
    $data[]="	F	,	21-Jun-14	,	Argentina	,	Iran	,	16:00	,	ar	,	ir	";
    $data[]="	F	,	21-Jun-14	,	Nigeria	,	Bosnia	,	22:00	,	ni	,	bo	";
    $data[]="	G	,	21-Jun-14	,	Germany	,	Ghana	,	19:00	,	ge	,	gh	";
    $data[]="	G	,	22-Jun-14	,	USA	,	Portugal	,	22:00	,	us	,	pt	";
    $data[]="	H	,	22-Jun-14	,	Belgium	,	Russia	,	16:00	,	be	,	ru	";
    $data[]="	H	,	22-Jun-14	,	South Korea	,	Algeria	,	19:00	,	ko	,	al	";
    $data[]="	A	,	23-Jun-14	,	Cameroon	,	Brazil	,	20:00	,	ca	,	br	";
    $data[]="	A	,	23-Jun-14	,	Croatia	,	Mexico	,	20:00	,	cr	,	mx	";
    $data[]="	B	,	23-Jun-14	,	Australia	,	Spain	,	19:00	,	au	,	es	";
    $data[]="	B	,	23-Jun-14	,	Netherlands	,	Chile	,	16:00	,	ne	,	ch	";
    $data[]="	C	,	24-Jun-14	,	Greece	,	Ivory Coast	,	20:00	,	gr	,	iv	";
    $data[]="	C	,	24-Jun-14	,	Japan	,	Colombia	,	20:00	,	jp	,	cl	";
    $data[]="	D	,	24-Jun-14	,	Costa Rica	,	England	,	16:00	,	ri	,	en	";
    $data[]="	D	,	24-Jun-14	,	Italy	,	Uruguay	,	16:00	,	it	,	ur	";
    $data[]="	E	,	25-Jun-14	,	Ecuador	,	France	,	20:00	,	ec	,	fr	";
    $data[]="	E	,	25-Jun-14	,	Honduras	,	Switzerland	,	20:00	,	ho	,	sw	";
    $data[]="	F	,	25-Jun-14	,	Bosnia	,	Iran	,	16:00	,	bo	,	ir	";
    $data[]="	F	,	25-Jun-14	,	Nigeria	,	Argentina	,	16:00	,	ni	,	ar	";
    $data[]="	G	,	26-Jun-14	,	Portugal	,	Ghana	,	16:00	,	pt	,	gh	";
    $data[]="	G	,	26-Jun-14	,	USA	,	Germany	,	16:00	,	us	,	ge	";
    $data[]="	H	,	26-Jun-14	,	Algeria	,	Russia	,	20:00	,	al	,	ru	";
    $data[]="	H	,	26-Jun-14	,	South Korea	,	Belgium	,	20:00	,	ko	,	be	";

     
   
?>   
<!-- startprint -->
      
    	<table border="1" cellpadding="4"  width="570" style="border-collapse: collapse" bordercolor="#D2D2D2" cellspacing="0">
    		<tr bgcolor="#D3EBAB">
          <td class="wcteam bold wcsm ctd">GROUP</td>
          <td class="wcteam bold wcdate ctd">DATE</td>
          <td class="wcteam bold wcsm ctd">GMT</td>
    			<td class="wcteam bold wcmatch ctd" colspan='2'>MATCH</td>
    		</tr>

    
<?php    
    
     for ($i=0; $i<count($data); $i++){
        $line = explode("," , $data[$i]);
           
?>  

        		<tr <? echo rowcol($i);?> >
        			<td class="wctd ctd"><? echo $line[0];?></td>
        			<td class="wctd ctd"><? echo $line[1]; ?></td>
        			<td class="wctd ctd"><? echo $line[4]; ?></td>
              <td class="wctd wcname" style="background:url(worldcup/<? echo trim($line[5]);?>.gif) no-repeat 3px center;padding-left:40px;"><? echo strtoupper($line[2]); ?></td>
              <td class="wctd wcname" style="background:url(worldcup/<? echo trim($line[6]);?>.gif) no-repeat 3px center;padding-left:40px;"><? echo strtoupper($line[3]); ?></td>
              
        		</tr>

       
        
<?} // main for loop ?>



  </table>

<!-- stopprint -->  
  
  <div style="padding-bottom:10px"></div>

  <div style='padding:5px; font-size:11px;font-family:verdana;'>
       Collected on: 08-May-2014 <br/><br/>
       
       
  
  </div>



<?= back() ?>

<div style="padding-bottom:10px"></div>	
  
	

<? include("footer.ini.php"); ?>