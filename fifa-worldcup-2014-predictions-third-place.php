<?php	

//include("authorization.php");



include("config.ini.php");

include("function.ini.php");

  
$active_mtab = 1;
$page_title="FIFA World Cup 2014 Brazil Third Place Play-Off Prediction";

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



	<font color="#0000ff"><span class="credit">PREDICTION FOR THIRD PLACE PLAY-OFF </span></font>



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

$data[] = "TD, 12-Jul-14, 20:00, BRAZIL, NETHERLANDS, 1 - 2,0 - 3  , br, ne,  2.15,  3.90,  3.30, 9063,0";
    

     for ($i=0; $i<count($data); $i++){

        $line = explode("," , $data[$i]);

             $id = trim($line[12]);

            $url = "<a href=\"javascript:tell('fifa_odds.php?id=$id')\">";

            $cellbg = "" ;

           

               

?>			           

<!-- startprint -->



            <table border="1" style="border-collapse: collapse" bordercolor="#CDCDCD" width="98%" align="center"  bgcolor="#F6F6F6" cellspacing="0" cellpadding="2" >

                 <tr bgcolor="#f0f0f0" >

                        <td align="center" colspan="8"> <span class='big'><? echo $line[1] ;?></span></td> 

                  </tr>     

                <tr>

            		  <td width="25" style="text-align: center" height="1" bgcolor="#d3ebab" rowspan="2"><img border="0" src="images/tbcap/date-odds.gif"/></td>

            		  <td width="91" style="text-align: center" height="1" bgcolor="#d3ebab" rowspan="2"><img border="0" src="images/tbcap/team1.gif" width="90" height="45"/></td>

            		  <td width="91" style="text-align: center" height="1" bgcolor="#d3ebab" rowspan="2"><img border="0" src="images/tbcap/team2.gif" width="90" height="45"/></td>

            		  <td width="35" style="text-align: center" height="1" bgcolor="#d3ebab" rowspan="2"><img border="0" src="images/tbcap/act.gif" width="30" height="45"/></td>

            		  <td width="35" style="text-align: center" height="1" bgcolor="#d3ebab" rowspan="2"><img src="images/tbcap/asl.gif"  border="0" alt=""/></td>

            		  <td width="20" style="text-align: center" height="10" bgcolor="#d3ebab" colspan="3"><img src="images/tbcap/odd.gif"  border='0' alt="" /></td>

            	</tr>

            

            	<tr>

            	  <td width="20" style="text-align: center" height="1" bgcolor="#D3EBAB"><img border="0" src="images/tbcap/w1.gif" width="23" height="22"/></td>

            	  <td width="20" style="text-align: center" height="1" bgcolor="#D3EBAB"><img border="0" src="images/tbcap/wcd.gif" width="23" height="22"/></td>

            	  <td width="20" style="text-align: center" height="1" bgcolor="#D3EBAB"><img border="0" src="images/tbcap/w2.gif" width="23" height="22"/></td>

            	</tr>



              

        	

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

        

       

            </table>

            <div style="padding-bottom:4px"></div>

        

        

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
        <font color='#0000ff' size="1">p<font><font size='1' color='#000000'> = Penalty shoot-out</b><br/>
        <font color='#0000ff' size="1">e<font><font size='1' color='#000000'> = Extra Time</b><br/>

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