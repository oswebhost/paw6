<?php	
//include("authorization.php");

include("config.ini.php");
include("function.ini.php");
$active_mtab = 1;
  
$page_title="FIFA World Cup 2014 Brazil Group Matches Batch 2";
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

	<font color="#0000ff"><span class="credit">PREDICTIONS FOR GROUP MATCHES (Batch 2)</span></font>

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
	$data[] = "A, 17-Jun-14, 19:00, BRAZIL, MEXICO, 3 - 0, 0 - 0 , br, mx,  1.30,  6.00, 11.00, 9015,0";
	$data[] = "A, 18-Jun-14, 22:00, CAMEROON, CROATIA, 1 - 1, 0 - 4  , ca, cr,  6.00,  3.90,  1.66, 9018,1";

	$data[] = "B, 18-Jun-14, 16:00, AUSTRALIA, NETHERLANDS, 0 - 3, 2 - 3 , au, ne, 15.00,  7.00,  1.22, 9019,0";
	$data[] = "B, 18-Jun-14, 19:00, SPAIN, CHILE, 1 - 1, 0 - 2 , es, ch,  1.66,  4.33,  5.25, 9020,1";

	$data[] = "C, 19-Jun-14, 16:00, COLOMBIA, IVORY COAST, 2 - 1, 2 - 1 , cl, iv,  2.20,  3.40,  3.60, 9021,0";
	$data[] = "C, 19-Jun-14, 22:00, JAPAN, GREECE, 1 - 2, 0 - 0 , jp, gr,  2.25,  3.50,  3.40, 9022,1";

	$data[] = "D, 19-Jun-14, 19:00, URUGUAY, ENGLAND, 0 - 2, 2 - 1 , ur, en,  3.50,  3.50,  2.20, 9023,0";
	$data[] = "D, 20-Jun-14, 16:00, ITALY, COSTA RICA, 2 - 1, 0 - 1 , it, ri,  1.55,  4.20,  7.00, 9024,1";
   

	$data[] = "E, 20-Jun-14, 22:00, HONDURAS, ECUADOR, 0 - 2, 1 - 2  , ho, ec,  6.00,  4.20,  1.61, 9026,0";
	$data[] = "E, 20-Jun-14, 19:00, SWITZERLAND, FRANCE, 1 - 2,2 - 5  , sw, fr,  4.75,  3.80,  1.80, 9025,1";

	$data[] = "F, 21-Jun-14, 16:00, ARGENTINA, IRAN, 3 - 0, 1 - 0 , ar, ir,  1.12, 10.00, 26.00, 9027,0";
	$data[] = "F, 21-Jun-14, 22:00, NIGERIA, BOSNIA, 1 - 2, 1 - 0 , ni, bo,  4.75,  3.80,  1.80, 9028,1";

	$data[] = "G, 21-Jun-14, 19:00, GERMANY, GHANA, 3 - 0, 2 - 2  , ge, gh,  1.28,  6.00, 12.00, 9029,0";
	$data[] = "G, 22-Jun-14, 22:00, USA, PORTUGAL, 1 - 2, 2 - 2 , us, pt,  6.00,  3.80,  1.66, 9030,1";

	$data[] = "H, 22-Jun-14, 16:00, BELGIUM, RUSSIA, 2 - 1, 1 - 0 , be, ru,  2.00,  3.50,  4.20, 9031,0";
	$data[] = "H, 22-Jun-14, 19:00, SOUTH KOREA, ALGERIA, 2 - 1, 2 - 4 , ko, al,  2.30,  3.30,  3.50, 9032,1";
		
	
    
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