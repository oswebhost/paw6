<?php	
//include("authorization.php");

include("config.ini.php");
include("function.ini.php");
$active_mtab = 1;
  
$page_title="FIFA World Cup 2014 Brazil Group Matches Batch 3";
include("header.ini.php"); 
 
page_header($page_title); 
  
?>
<style>
    .wctd {padding:7px 3px 7px 3px; font-size:11px; font-family: verdana;}
    a, a.visted {color:blue; text-decoration:none;}
    a:hover {text-decoration:underline;}
</style>


<div style='border:0px solid red;width:572px;'>
	<img src='worldcup/logo.gif' border='0' alt='<?echo $page_title;?>'>
</div>
<div style="padding-bottom:5px"></div>
<table border="1" width="98%" align="center" cellpadding="2" cellspacing="0" id="table1" style="border-collapse: collapse" bordercolor="#D1D1D1" bgcolor="#F6F6F6" align="center">

<tr>

<td width="100%" align="center" style="padding: 8px;">

	<font color="#0000ff"><span class="credit">PREDICTIONS FOR GROUP MATCHES (Batch 3)</span></font>

</td>

</tr>

</table>
<div style="padding-bottom:5px"></div>


<table width="98%" align="center">
<tr>
	<td > <? echo back(); ?> </td>
	<td align="center"><span class='bot'></span></td>
	<td align="right"> <? echo printscr(); ?></td>
</tr>
</table>
<div style="padding-bottom:5px"></div>


<?
	$data[] = "A, 23-Jun-14, 20:00, CAMEROON, BRAZIL, 0 - 3, 1 - 4 , ca, br, 26.00, 10.00,  1.12, 9033,0";
	$data[] = "A, 23-Jun-14, 20:00, CROATIA, MEXICO, 1 - 1, 1 - 3 , cr, mx,  2.45,  3.40,  3.10, 9034,1";

	$data[] = "B, 23-Jun-14, 16:00, AUSTRALIA, SPAIN, 0 - 2, 0 - 3 , au, es,  9.00,  5.00,  1.40, 9035,0";
	$data[] = "B, 23-Jun-14, 16:00, NETHERLANDS, CHILE, 2 - 1, 2 - 0  , ne, ch,  2.62,  3.40,  2.87, 9036,1";

	$data[] = "C, 24-Jun-14, 20:00, GREECE, IVORY COAST, 1 - 1, 2 - 1 , gr, iv,  3.80,  3.60,  2.05, 9037,0";
	$data[] = "C, 24-Jun-14, 20:00, JAPAN, COLOMBIA, 0 - 2, 1 - 4 , jp, cl,  3.10,  3.50,  2.40, 9038,1";

	$data[] = "D, 24-Jun-14, 16:00, COSTA RICA, ENGLAND, 1 - 1, 0 - 0 , ri, en,  4.50,  3.90,  1.83, 9039,0";
	$data[] = "D, 24-Jun-14, 16:00, ITALY, URUGUAY, 2 - 0, 0 - 1 , it, ur,  2.80,  3.30,  2.75, 9040,1";

	
	$data[] = "E, 25-Jun-14, 20:00, ECUADOR, FRANCE, 0 - 3, 0 - 0  , ec, fr,  4.50,  3.75,  1.85, 9041,0";
	$data[] = "E, 25-Jun-14, 20:00, HONDURAS, SWITZERLAND, 0 - 2, 0 - 3  , ho, sw,  9.00,  4.50,  1.44, 9042,1";

	$data[] = "F, 25-Jun-14, 16:00, BOSNIA, IRAN, 2 - 1, 3 - 1  , bo, ir,  2.05,  3.30,  3.80, 9043,0";
	$data[] = "F, 25-Jun-14, 16:00, NIGERIA, ARGENTINA, 0 - 2, 2 - 3 , ni, ar,  7.00,  4.00,  1.50, 9044,1";

	$data[] = "G, 26-Jun-14, 16:00, PORTUGAL, GHANA, 2 - 1,2 - 1  , pt, gh,  1.83,  3.75,  4.00, 9045,0";
	$data[] = "G, 26-Jun-14, 16:00, USA, GERMANY, 0 - 2, 0 - 1 , us, ge,  7.50,  5.00,  1.36, 9046,1";

	$data[] = "H, 26-Jun-14, 20:00, ALGERIA, RUSSIA, 1 - 2, 1 - 1 , al, ru,  6.00,  3.75,  1.60, 9047,0";
	$data[] = "H, 26-Jun-14, 20:00, SOUTH KOREA, BELGIUM, 0 - 2, 0 - 1 , ko, be,  5.50,  4.00,  1.57, 9048,1";
	
		
	
    
     for ($i=0; $i<count($data); $i++){
        $line = explode("," , $data[$i]);
             $id = trim($line[12]);
            $url = "<a href=\"javascript:tell('fifa_odds.php?id=$id')\">";
            $cellbg = "" ;
            if ($line[16]==1){
                $cellbg = " style='background:#C1FF84;font-weight:bold;'";    
            }
           
            if ($line[13] == 0){
               
?>			           
<!-- startprint -->

            <table border="1" style="border-collapse: collapse" bordercolor="#CDCDCD" width="98%" align="center"  bgcolor="#F6F6F6" cellspacing="0" cellpadding="2" >
                 <tr bgcolor="#f0f0f0" >
                        <td align="center" colspan="8"> <span class='big'> GROUP <font color="#FF0000"><? echo $line[0] ;?></font></span></td> 
                  </tr>     
                <tr>
            		  <td width="37" style="text-align: center" height="1" bgcolor="#d3ebab" rowspan="2"><img border="0" src="images/tbcap/date-odds.gif"/></td>
            		  <td width="91" style="text-align: center" height="1" bgcolor="#d3ebab" rowspan="2"><img border="0" src="images/tbcap/team1.gif" width="90" height="45"/></td>
            		  <td width="91" style="text-align: center" height="1" bgcolor="#d3ebab" rowspan="2"><img border="0" src="images/tbcap/team2.gif" width="90" height="45"/></td>
            		  <td width="31" style="text-align: center" height="1" bgcolor="#d3ebab" rowspan="2"><img border="0" src="images/tbcap/act.gif" width="30" height="45"/></td>
            		  <td width="31" style="text-align: center" height="1" bgcolor="#d3ebab" rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>
            		  <td width="27" style="text-align: center" height="10" bgcolor="#d3ebab" colspan="3"><img src="images/tbcap/odd.gif"  border='0' alt="" /></td>
            	</tr>
            
            	<tr>
            	  <td width="30" style="text-align: center" height="1" bgcolor="#D3EBAB"><img border="0" src="images/tbcap/w1.gif" width="23" height="22"/></td>
            	  <td width="30" style="text-align: center" height="1" bgcolor="#D3EBAB"><img border="0" src="images/tbcap/wcd.gif" width="23" height="22"/></td>
            	  <td width="30" style="text-align: center" height="1" bgcolor="#D3EBAB"><img border="0" src="images/tbcap/w2.gif" width="23" height="22"/></td>
            	</tr>

            <?} // end if ?>        
        	
            	<tr>
            		<td class="wctd ctd"><? echo $url . $line[1] ."<br/><font style='font-size:9px'>" . $line[2] . "GMT</font></a>"; ?></td>
            		<td class="wctd cwteam" style="background:url(worldcup/<? echo trim($line[7]);?>.gif) no-repeat 3px center;padding-left:42px;"><?= strtoupper($line[3])?></td>
					<td class="wctd cwteam" style="background:url(worldcup/<? echo trim($line[8]);?>.gif) no-repeat 3px center;padding-left:42px;"><?= strtoupper($line[4])?></td>

					
            		<td class="wctd ctd btd" <? echo $cellbg;?>><? echo $line[6];?></td>
            		<td class="wctd ctd" <? echo $cellbg; ?>><? echo $line[5]; ?></td>
            		<td class="wctd ctd" <? echo ($line[14]==1? colorit($line[15]): ""); ?>><? echo $line[9]; ?></td>
            		<td class="wctd ctd" <? echo ($line[14]==2? colorit($line[15]): ""); ?>><? echo $line[10]; ?></td>
            		<td class="wctd ctd" <? echo ($line[14]==3? colorit($line[15]): ""); ?>><? echo $line[11]; ?></td>
            	</tr>
        
        <? if ($line[13]==1){ ?>
            </table>
            <div style="padding-bottom:4px"></div>
         <?} // endif ?>
        
<?} // main for loop ?>

<p style='color:blue;padding:0 0px 10px 5px;margin:0;font-size:10px;'>Click on actual match date to see match Odds.</p>

 <div class='hypeboxRed' style="margin-top:0px;">
  <div class='div_topRed'></div>
    <div class='div_midRed' style="font-size:10px;text-align:left;padding-left:5px;"> 

        <b>
        <font color='#0000ff' size="1">ASL<font><font size='1' color='#000000'> = Anticipated Score-Line  
        <!--<font color='#0000ff' size="1">CS<font><font size='1' color='#000000'> = Correct Score Odds--> <br />
        <font color='#000000' size="1"><font color='#0000ff' size="1">W1</font> and <font color='#0000ff' size="1">W2</font> refer to a win by team 1 and team 2 respectively </font> | 
        <font color='#0000ff' size="1">D<font><font size='1' color='#000000'> = Draw</b><br/>
  </div>
    <div class='div_bottomRed'></div>
</div>






	
	
  
	

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