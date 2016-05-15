<?php	
include("config.ini.php");
include("function.ini.php");
$active_mtab = 1;
  
$page_title = "FIFA World Cup 2014 Brazil - GROUP TABLES";
include("header.ini.php"); 
 
page_header($page_title); 
  
?>
<div style='border:0px solid red;width:572px;'>
<img src='worldcup/logo.gif' border='0' alt='<?echo $page_title;?>'>
</div>
	
  
<div style="padding:5px">
  <table  width="98%" align="center" border="0">
  <tr>
  	<td width='10%'> <? echo back(); ?> </td>
  	<td align="center" width='80%'></td>
  	<td width='10%' align="right"><? echo printscr(); ?></td>
  </tr>
  </table>
</div>

<?
    

      $data[] = "A	,	BRAZIL	,	3	,	2	,	1	,	0	,	7	,	2	,	7, br, 1"	;
      $data[] = "A	,	MEXIco	,	3	,	2	,	1	,	0	,	4	,	1	,	7, mx, 2";
      $data[] = "A	,	CROATIA	,	3	,	1	,	0	,	2	,	6	,	6	,	3, cr, 3"	;
      $data[] = "A	,	CAMEROON,	3	,	0	,	0	,	3	,	1	,	9	,	0, ca, 4"	;
      
      $data[] = "B	,	NETHERLANDS,	3	,	3	,	0	,	0	,	10	,	3	,	9, ne, 1"	;
      $data[] = "B	,	CHILE	,	3	,	2	,	0	,	1	,	5	,	3	,	6, ch, 2"	;
      $data[] = "B	,	SPAIN	,	3	,	1	,	0	,	2	,	4	,	7	,	3, es, 34"	;
      $data[] = "B	,	AUSTRALIA,	3	,	0	,	0	,	3	,	3	,	9	,	0,au, 4"	;
  

      $data[] = "C,COLOMBIA,	3,3	,0,0,	9	,	2,	9,cl,1"	;
      $data[] = "C,GREECE,	3,1	,1,1,	2	,	4,	4,gr,2"	;
      $data[] = "C,IVOry COAST,	3,1	,0,2,	4	,	5,	3,iv,3"	;
      $data[] = "C,JAPAN,	3,0	,1,2,	2	,	6,	1,jp,4"	;


      $data[] = "D	,	COSTA RICA,	3	,	2	,	1	,	0,4	,	1	,	7,ri,1"	;
      $data[] = "D	,	URUGUAY	,	3	,	2	,	0	,	1,4	,	4	,	6, ur,2"	;
      $data[] = "D	,	ITALY	,	3	,	1	,	0	,	2,2	,	3	,	3, it, 3"	;
      $data[] = "D	,	ENGLAND	,	3	,	0	,	1	,	2,2	,	4	,	1,en, 4"	;
      
      $data[] = "E	,	FRANCE	,	3	,	2	,	1	,	0	,	8	,	2	,	7,fr,1"	;
      $data[] = "E	,	SWITZERLAND,	3	,	2	,	0	,	1	,	7	,	6	,	6,sw,2"	;
      $data[] = "E	,	ECUADOR	,	3	,	1	,	1	,	1	,	3	,	3	,	4,ec,3"	;
      $data[] = "E	,	HONDURAS,	3	,	0	,	0	,	3	,	1	,	8	,	0,ho,4"	;
      
      $data[] = "F	,	ARGENTINA,	3	,	3	,	0	,	0	,	6	,	3	,	9,ar,1"	;
      $data[] = "F	,	NIGERIA	,	3	,	1	,	1	,	1	,	3	,	3	,	4,ni,2"	;
      $data[] = "F	,	BOSNIA 	,	3	,	1	,	0	,	2	,	4	,	4	,	3,bo,3"	;
      $data[] = "F	,	IRAN	,	3	,	0	,	1	,	2	,	1	,	4	,	1,ir,4"	;
      
      $data[] = "G	,	GERMANY	,	3	,	2	,	1	,	0	,	7	,	2	,	7,ge,1"	;
      $data[] = "G	,	USA	,		3	,	1	,	1	,	0	,	4	,	4	,	4,us,2"	;
      $data[] = "G	,	PORTUGAL,	3	,	1	,	1	,	1	,	4	,	7	,	4,pt,3"	;
      $data[] = "G	,	GHANA	,	3	,	0	,	1	,	2	,	4	,	6	,	1,gh,4"	;
	  
      $data[] = "H	,BELGIUM	,	3	,	3	,	0	,	0	,	4	,	1	,	9,be,1"	;
      $data[] = "H	,ALGERIA	,	3	,	1	,	1	,	1	,	6	,	5	,	4,al,2"	;
      $data[] = "H	,RUSSIA		,	3	,	0	,	2	,	1	,	2	,	3	,	2,ru,3"	;
      $data[] = "H	,KOREA REPUBLIC,2	,	0	,	1	,	2	,	3	,	6	,	1,ko,4"	;
    
    
    
     for ($i=0; $i<count($data); $i++){
        $line = explode("," , $data[$i]);

            if ($line[10] == 1){
    
?>  

<!-- startprint -->

    	<table border="1" cellpadding="4"  width="550" style="border-collapse: collapse" bordercolor="#D2D2D2" cellspacing="0">
  	<tr>
	  <td style='padding-left:10px;background:#ccc;' colspan='9'><span class='big'> GROUP <font color="#FF0000"><? echo $line[0];?></font></span><font color="#FF0000"> </td>
	</tr> 
         
	<tr bgcolor="#D3EBAB">
          <td class="wcteam bold wcwide ctd" style="width:190px;">Teams</td>
    			<td class="wcteam bold wcsm ctd">P</td>
    			<td class="wcteam bold wcsm ctd">W</td>
    			<td class="wcteam bold wcsm ctd">D</td>
    			<td class="wcteam bold wcsm ctd">L</td>
    			<td class="wcteam bold wcsm ctd">GF</td>
    			<td class="wcteam bold wcsm ctd">GA</td>
				<td class="wcteam bold wcsm ctd">GD</td>
    			<td class="wcteam bold wcsm ctd">Points</td>
    		</tr>

        <?} // end if ?>    


        		<tr <? echo rowcol($line[10]);?> >
        			<td class="wctd wcname" style="background:url(worldcup/<? echo trim($line[9]);?>.gif) no-repeat 3px center;padding-left:40px;"><? echo strtoupper($line[1]); ?></td>
        			<td class="wctd ctd"><? echo $line[2];?></td>
        			<td class="wctd ctd"><? echo $line[3]; ?></td>
        			<td class="wctd ctd"><? echo $line[4]; ?></td>
        			<td class="wctd ctd"><? echo $line[5]; ?></td>
        			<td class="wctd ctd"><? echo $line[6]; ?></td>
        			<td class="wctd ctd"><? echo $line[7]; ?></td>
				<td class="wctd ctd"><? echo $line[6]-$line[7]; ?></td>
        			<td class="wctd ctd bold"><? echo $line[8]; ?></td>
        		</tr>

         <? if ($line[10]==4){ ?>
            </table>
            <div style="padding-bottom:4px"></div>
         <?} // endif ?>
        
<?} // main for loop ?>


<!-- stopprint -->

<div style="padding-bottom:10px"></div>



<?= back() ?>

<div style="padding-bottom:10px"></div>	
  
	

<? include("footer.ini.php"); ?>