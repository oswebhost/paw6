<?  session_start();
   
include("config.ini.php");

include("function.ini.php");


if (check_season('eu')=='1'){ 
    header('Location: commences.php'); 
    exit;
}

$cwk = cur_week('eu');
$cur = curseason('eu');

$page_title="Free Soccer Predictions UK Minor Divisions";

include("header.ini.php");

page_header($page_title) ; 
 
?>


<font size="3" color="#0000FF"><b><i>Current Week’s Fixtures & Full 1X2 Predictions <font size='2'>(with Score-Lines)</font>
</i></b></font> <BR><BR>

            
<table border="1" width="98%" align="center" bordercolor="#EBEBF3" cellspacing="0" style="border-collapse: collapse" cellpadding="6" align='center' >
  <tr bgcolor='#CADFEE'>
	
		<td width="50%">
		<? if (gg_count('NC','n/a','FIXTURE')>0) :
			 $cla="mblue" ;
		   else:
			 $cla="red" ;
		   endif;
			  echo '<A class="' . $cla . '" HREF="free-soccer-predictions-list.php?PARA=NC">' . divname("NC") ;
	  	  echo " (" . gg_count('NC','n/a','FIXTURE') . ")</A>" ;

		?>
		</td>
	
		<td >
		<? if (gg_count('RP','n/a','FIXTURE')>0) :
			 $cla="mblue" ;
		   else:
			 $cla="red" ;
		   endif;
			  echo '<A class="' . $cla . '" HREF="free-soccer-predictions-list.php?PARA=RP">' . divname("RP") ;
			  echo " (" . gg_count('RP','n/a','FIXTURE') . ")</A>" ;
		   
		?>
		</td>
	</tr>
	<tr bgcolor='#CADFEE'>
	
		<td width="50%">
		<? if (gg_count('MP','n/a','FIXTURE')>0) :
			 $cla="mblue" ;
		   else:
			 $cla="red" ;
		   endif;
			  echo '<A class="' . $cla . '" HREF="free-soccer-predictions-list.php?PARA=MP">' . divname("MP") ;
	  		   echo " (" . gg_count('MP','n/a','FIXTURE') . ")</A>" ;

		?>
		</td>
	
		<td >
		<? if (gg_count('UP','n/a','FIXTURE')>0) :
			 $cla="mblue" ;
		   else:
			 $cla="red" ;
		   endif;
			  echo '<A class="' . $cla . '" HREF="free-soccer-predictions-list.php?PARA=UP">' . divname("UP") ;
			  echo " (" . gg_count('UP','n/a','FIXTURE') . ")</A>" ;
		   
		?>
		</td>
	</tr>


	 
	
	</table>


<br/><br/>


<div style="margin:auto auto; border:1px solid #ccc; width:500px;">
	<div style="padding:5px;background:#f4f4f4;font-size:11px;color:#666;">Divisional Codes Used:</div>
	<div style="padding:5px;font-size:11px;color:#666;">
	Div ID = NC = <?echo divname("NC") ?> = Nationwide Conference<br/>
	Div ID = RP = <?echo divname("MP") ?><br />
	Div ID = MP = <?echo divname("MP") ?> = Zamaretto Premier = British Gas Premier<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;= Doc Martens <br/>
	Div ID = UP = <?echo divname("UP") ?> = Unibond 
	</div>
</div>



<!-- startprint -->
           
<? include("footer.ini.php"); ?>
