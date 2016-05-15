<?php

$page_title ="Subscribe";


include("config.ini.php");
include("header.ini.php");
include("function.ini.php");
page_header($page_title); 


?>


<div style='width:450px;margin:auto auto;font-size:12px;'>

<div class='errordiv' style='font-size:14px;text-align:center;line-height:160%'>This screen is applicable only to Registered Members who wish to become Subscribing Members. </div>

<span style='font-size:16px'><B>Our regular charges are just</B></span> <span style='font-size:24px;color:blue;'><B><I>£4 per month!</I></B></span> <br>
<span style='font-size:16px'>But you only have to pay <span style='color:blue'><b>&pound;2</b></span> a month for the first 2 months!</span>
 <br>


<br><br>

<form method='post' name='signup' action='make_payment.php' onsubmit="return checkPass();">
		
		<input type='hidden' name='amount' value='2.00'/>
		<input type='hidden' name='currency' value='GBP'/>
		
		<table width='450' cellpadding='3' cellspacing='0' border='0' style='margin:auto auto; border:1px solid #ccc; background:#f4f4f4;'>
			<tr>
				<td colspan='2' bgcolor='#cccccc'><font size='+1'>Member Details</font></td>
			</tr>
			<tr>
				<td colspan='2' style='height:10px;'></td>
			</tr>
			<tr>
				<td width='30%' style='font-size:12px;' align='right'>User ID: </td>
				<td width='80%'>
				<input type='text' style='width:150px;padding:4px;' value='<?echo $_SESSION['userid'] ?>' readonly name='userid' id='userid' >
				</td>
			</tr>	
			<tr>
				<td></td>
				<td><span id="txtUserid" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
			</tr>

			<tr>
				<td style='font-size:12px;' align='right'>Email Address: </td>
				<td><input type='text' style='width:250px;padding:4px;' name='email' id='email' readonly value='<?echo $_SESSION['email'];?>'></td>
			<tr>
				<td></td>
				<td><span id="txtEmail" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
			</tr>
			</tr>
			
			
			<tr>
				<td colspan='2' style='padding:10px 0 15px 0;text-align:center;'>
					<input type='image' src='images/subnow.png' style='border:0'>
				</td>
			</tr>
		</table>

	
</form>


<div class='hypebox470' style="margin-top:15px;">
  <div class='div_top470'></div>
    <div class='div_mid470' style="font-size:12px;text-align:left;padding:0 8px 8px 8px;"> 
<font style='font-size:11px;'>PLEASE NOTE:</font>
<ol>
	<li style='font-size:11px;'>The monthly recurring charge is due on the same day each month. You will be notified each month after payment has been received.</li>   
	<li style='font-size:11px;'>It shall be deemed that before making payment you read, fully understood, agreed to and accepted the provisions of our <a class='sbar' href='disclaimer.php'><em>Disclaimer</em></a> and <a class='sbar' href='refund.php'><em>Refund Policy</em></a> and that you are fully aware of what our Services will provide you with.</li>
</ol>

 </div>
    <div class='div_bottom470'></div>
</div>


</div>




<? include("footer.ini.php"); ?>