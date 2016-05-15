<?php
session_start();

 
require_once("config.ini.php");
require_once("function.ini.php");
require_once("reguser.php");
require_once("header.ini.php");




$page_title = "Subscribe";

//regular charges




$errlog="";

	



page_header("Subscribe");
 

?>



<style>
	.mytd {text-align:center;font-size:14px;font-weight:bold;}
	.mytd2 {text-align:center;font-size:14px;font-weight:bold;color:blue;}
	.mytd2d {text-align:center;font-size:14px;font-weight:bold;color:#333;}
	.ltd {text-align:left;}
	
	.service2 {font-size:12px;font-weight:bold;}
	
	.btn {
	  background: #3498db;
	  background-image: -webkit-linear-gradient(top, #3498db, #2980b9);
	  background-image: -moz-linear-gradient(top, #3498db, #2980b9);
	  background-image: -ms-linear-gradient(top, #3498db, #2980b9);
	  background-image: -o-linear-gradient(top, #3498db, #2980b9);
	  background-image: linear-gradient(to bottom, #3498db, #2980b9);
	  -webkit-border-radius: 8;
	  -moz-border-radius: 8;
	  border-radius: 8px;
	  font-family: Georgia;
	  color: #ffffff;
	  font-size: 18px;
	  padding: 10px 20px 10px 20px;
	  text-decoration: none;
	}

	.btn:hover {
	  background: #3cb0fd;
	  background-image: -webkit-linear-gradient(top, #3cb0fd, #3498db);
	  background-image: -moz-linear-gradient(top, #3cb0fd, #3498db);
	  background-image: -ms-linear-gradient(top, #3cb0fd, #3498db);
	  background-image: -o-linear-gradient(top, #3cb0fd, #3498db);
	  background-image: linear-gradient(to bottom, #3cb0fd, #3498db);
	  text-decoration: none;
	}
</style>

<div style='padding:20px;text-align:left; font-size:14px;'>
	<b>NOTE:</b>
	<ol >
		<li style='font-size:14px;'>We are not charging yet, so our Services are still Free-of-Charge for now! </li>
		
		<li style='font-size:14px;'>You must be a <span class='bb'>Registered Member</span> before you can subscribe.</li>
		
		<li style='font-size:14px;'>Payments can only be taken through Skrill Wallet.</li>
	</ol>

</div>


 
<form method="POST" action="payment_step2.php" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);" style="padding:0;margin:0">


	<INPUT TYPE="hidden" name="ACTION" value="ADD">
	




<div style="padding-bottom:5px;"></div>

 <table border="1" cellpadding="4" cellspacing="1" style="margin:auto auto;border-collapse: collapse" bordercolor="#2E8BC9" width="100%">
	<TR bgcolor='#2E8BC9'>
		<TD width='5%' class='mytd2' style='padding:20px;color:#fff;'><B>SELECT</B></TD>
		<TD width='80%' class='mytd2' style='color:#fff;'><B>SERVICES PACKAGE REQUIRED</B></TD>
		<TD width='15%' class='mytd2' style='color:#fff;'><B>COST </B></TD>
	</TR>
	
	<tr>
		<td class='mytd ltd' colspan='3'>EARLY BIRD FEES</td>
	</tr>
	<tr>
		<td class='mytd' ><input checked type='radio' style='border:0' name='service_month' alt='radio' emsg='Please specify your payment option.' value='0' >
		<td class='ltd service2' style='padding:10px;'><b>12 Months Services</b><div style='font-weight:normal;padding-top:10px;'>(Pay before <span class='bb'>31 DECEMBER 2015</span> and get <b>1 month FREE</b>. After that date <span class='red'>STANDARD FEES</span> will apply.)</div> </td>
		<td class='mytd2'>&#163;<?php echo num2($charge_amt[0]) ;?></td>
	</tr>
	<tr>
		<td class='mytd ltd' colspan='3'>STANDARD FEES</td>
	</tr>
	
	
<?php


	for ($i=1; $i<=4; $i++):
		echo "<tr bgcolor='white'>\n\n";
		echo "<td class='mytd' style='padding:10px;'>";
		echo "<input type='radio'  style='border:0' name='service_month' alt='radio' emsg='Please specify your payment option.' value='". $i ."' >";
		echo "</td>\n\n";
		echo "<td class='mytd service2 ltd' style='padding:10px'>" . $charge_mon[$i] . " Months Services </td>\n";
		echo "<td class='mytd2d'>&#163;" . num2($charge_amt[$i]) . "</td>\n";
		echo "</tr>\n\n";
	endfor;		


	


?>

	 


</table>

<div style='text-align:center;margin:20px;'>

 <br>
 
 <?php if (isset($_SESSION["userid"])) { ?>
 <INPUT TYPE="submit" class='btn' value="Continue"> 

<?php }else{ ?>
		<!-- <div class='error_div' style='width:108px;margin:auto auto;'><a class='sbar' href='login.php'>Login Please</a></div>-->
 <?php } ?>



</form>
<!--
 <div style='text-align:center;margin:40px;'>
 <img src="https://www.skrill.com/fileadmin/content/images/brand_centre/Payment_Options_by_Skrill/skrill-powered-long_224x60.png" alt="Multiple Options by Skrill" title="Multiple Options by Skrill">
 </div>
-->

</div>
 
<?php require_once("footer.ini.php"); ?>