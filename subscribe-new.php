<?php

$page_title ="Subscribe";

$starting_value = 0;
$max_value      = 2500;



include("config.ini.php");
include("header.ini.php");
include("function.ini.php");
page_header($page_title); 

$temp = $eu->prepare("select count(uid) as cNo from userlist");
$temp->execute();
$data= $temp->fetch();
$show_value = ($data['cNo'] + $starting_value) ;

?>



<div style="text-align:center;width: 440px; margin:10px auto 25px auto; border:1px solid red; background:#FFF0F0; padding:8px;font-size:12px;line-height:150%"> 	
     <b>If you are an existing Subscribing Member and have not logged in yet, please <a style='color:blue;' href='login.php'>log in</a> now. If you have paid us at any time before, please note that you won't be able to re-join using a new User ID.</b>  

</div>


<div style='width:450px;margin:auto auto;font-size:12px;'>

<span style='font-size:16px'><B>Our regular charges are just</B></span> <span style='font-size:24px;color:blue;'><B><I>£4 per month!</I></B></span> <br>
 <br>


<p style='padding:10px 0 0px 0;'><b>As a new Subscribing Member</b>, you get a <span style='color:blue;'><b>2 months' trial of our Services at half price</b></span>, plus we offer a <span style='color:#6600CC;'><b><i>100% money-back guarantee</i></b></span> if you don't want to continue after the first month! <span style='color:blue;'><b>So your first 2 month's subscription is only £4 in total</b></span>, and you get it all back if you are not satisfied, without any questions asked from our side.


<!--
<div class='hypebox470' style="margin-top:15px;">
  <div class='div_top470'></div>
    <div class='div_mid470' style="font-size:12px;text-align:left;padding:0 8px 5px 8px;"> 
<div style='text-align:center;'><B>Count Down: <?php echo $show_value . " / 2500" ;?></B></div><br/>
To fix your charges for the next 5 years - become one of our first 2500 new Members! All existing Members are automatically granted this benefit. When this counter reaches 2500 New Members, our charges will then increase by 50%!  </div>
    <div class='div_bottom470'></div>
</div>
-->

<div style='padding:10px;'></div>

<form method='post' name='signup' action='make_payment.php' onsubmit="return checkPass();">
		
		<input type='hidden' name='amount' value='2.00'/>
		<input type='hidden' name='currency' value='GBP'/>


		<table width='450' cellpadding='3' cellspacing='0' border='0' style='border:1px solid #2E61BC; background:#EFF3FF;'>
			<tr>
				<td colspan='2' class='padd' bgcolor='#2E61BC'><font size='+1' color='#ffffff'>New Subscribing Member Details</font></td>
			</tr>
			<tr>
				<td colspan='2' style='height:10px;'></td>
			</tr>
			<tr>
				<td width='30%' style='font-size:12px;' align='right'>User ID: </td>
				<td width='80%'>
				<input type='text' style='width:150px;padding:4px;border:1px solid #ccc;' name='userid' id='userid' onblur="AjaxCallUser(this.value)"> 6 - 12 characters
				</td>
			</tr>	
			<tr>
				<td></td>
				<td><span id="txtUserid" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
			</tr>

			<tr>
				<td style='font-size:12px;' align='right'>Email Address: </td>
				<td><input type='text' style='width:250px;padding:4px;border:1px solid #ccc;' name='email' id='email' onblur="AjaxCallEmail(this.value)"/></td>
			<tr>
				<td></td>
				<td><span id="txtEmail" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
			</tr>
			</tr>
			<tr>
				<td width='20%' style='font-size:12px;' align='right'>Password: </td>
				<td width='80%'>
				<input type='password' style='width:150px;padding:4px;border:1px solid #ccc;' name='pass' id='pass' />
				</td>
			</tr>	
			<tr>
				<td></td>
				<td><span id="txtUserid22" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
			</tr>
			<tr>
				<td width='20%' style='font-size:12px;' align='right'>Confirm Password: </td>
				<td width='80%'>
				<input type='password' style='width:150px;padding:4px;border:1px solid #ccc;' name='pass2' id='pass2'/>
				</td>
			</tr>

			
			<tr>
				<td colspan='2' style='padding:10px 0 15px 0;text-align:center;'>
					<input type='submit' value='Submit' class='greenbt' />
				</td>
			</tr>
		</table>

	
</form>


<div class='hypebox470' style="margin-top:25px;">

  <div class='div_top470'></div>
    <div class='div_mid470' style="font-size:12px;text-align:left;padding:0 8px 5px 8px;"> 
<font style='font-size:11px;'><b>PLEASE NOTE:</b></font>
<ol>
	<li style='font-size:11px;'>The monthly recurring charge is due on the same day each month. You will be notified each month after payment has been received.</li>   
	<li style='font-size:11px;'>It shall be deemed that before making payment you read, fully understood, agreed to and accepted the provisions of our <a class='sbar' href='disclaimer.php'><em>Disclaimer</em></a> and <a class='sbar' href='refund.php'><em>Refund Policy</em></a> and that you are fully aware of what our Services will provide you with.</li>
</ol>

 </div>
    <div class='div_bottom470'></div>
</div>


</div>




<? include("footer.ini.php"); ?>