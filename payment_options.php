<?php
session_start();

$java_= 0;
 
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


<div class='hypebox'  style='width:582px;margin:0px auto 0 auto;'>
  <div class='div_top520'></div>
    <div class='div_mid520' style="line-height: 140%;">
	
	<div class='spacer'></div>
	
	 <div style="padding-top:0px;padding-left:5px; padding-right:5px;text-align:justify;font-size:15px;">



<p style='padding-top:0px;font-size:14px;'>You can pay either through <span class='bb'>PayPal</span> or <span class='maroon'>Skrill</span> <a href='https://www.skrill.com/en/digital-wallet/' target='_blank'><b>Digital Wallet</b></a> (see options below). 


<p style='padding-top:5px;font-size:14px;'>Before proceeding further, please also read the <a href='#notes'><span class='bb' style='color:#852064;font-size:13px;'>ESSENTIAL NOTES</span></a> under the below listing of "SERVICES PACKAGES AVAILABLE".</p>


<div class='spacer'></div>

	</div>
    <div class='div_bottom520'></div>
</div>

</div>


<br >



 
<form method="POST" action="payment_step2.php" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);" style="padding:0;margin:0">


	<INPUT TYPE="hidden" name="ACTION" value="ADD">
	




<div style="padding-bottom:5px;"></div>

 <table border="1" cellpadding="4" cellspacing="1" style="margin:auto auto;border-collapse: collapse" bordercolor="#2E8BC9" width="80%">
	<TR bgcolor='#2E8BC9'>
	
		<TD colspan='3' class='mytd2' style='color:#fff;padding:10px;'><B>SERVICES PACKAGES AVAILABLE</B></TD>
	
	</TR>
<!--		
	<tr>
		<td class='mytd ltd' colspan='3'>EARLY BIRD FEES:</td>
	</tr>

	<tr>
		<td class='mytd'  width='5%' ><input checked type='radio' style='border:0' name='service_month' alt='radio' emsg='Please specify your payment option.' value='0' >
		<td class='ltd service2' style='padding:10px;'><b>12 Months Services</b><div style='font-weight:normal;padding-top:10px;'>Pay before <span class='bb'>30 NOVEMBER 2015</span> and get Services right <br/>through to <span class='bb'>31 MAY 017!</span></div> </td>
		<td class='mytd2'>&#163;<?php echo num2($charge_amt[0]) ;?></td>
	</tr>

	
	<tr>
		<td class='mytd'  width='5%' ><input checked type='radio' style='border:0' name='service_month' alt='radio' emsg='Please specify your payment option.' value='1' >
		<td class='ltd service2' style='padding:10px;'><b>12 Months Services</b><div style='font-weight:normal;padding-top:10px;'>Pay between <span class='bb'>01-31 DECEMBER 2015</span> and get 1 extra month<br/> of Services (up to <span class='bb'>31 JANUARY 2017</span>).</div> </td>
		<td class='mytd2'>&#163;<?php echo num2($charge_amt[0]) ;?></td>
	</tr>
	
-->
	
	<tr>
		<td class='mytd ltd' colspan='3'>DISCOUNTED "ATTRACTION" FEES:</td>
	</tr>
	
	<?php


	for ($i=2; $i<9; $i++){

		echo "<tr bgcolor='white'>\n\n";
		echo "<td class='mytd' style='padding:10px;'>";
		if ($i==2){
			echo "<input type='radio' checked style='border:0' name='service_month' alt='radio' emsg='Please specify your payment option.' value='". $i ."' >";
		}else{
			echo "<input type='radio'  style='border:0' name='service_month' alt='radio' emsg='Please specify your payment option.' value='". $i ."' >";
		}
		
		echo "</td>\n\n";
		echo "<td class='mytd service2 ltd' style='padding:10px'>Pay between <span class='bb'>". strtoupper($_between[$i]) . "</span> and get " . $charge_mon[$i] . " months of Services (up to <span class='bb'>". strtoupper($_fromdate[$i])."</span>).</td>\n";
		echo "<td class='mytd2d'>&#163;" . num2($charge_amt[$i]) . "</td>\n";
		echo "</tr>\n\n";
	}
?>
	
	
	
	<tr>
		<td class='mytd ltd' colspan='3'>STANDARD FEES: <br/>
		<span style='font-size:11px; font-weight:normal'>
		(payable from <span class='bb'>01 SEPTEMBER 2016</span> onwards for all - no exceptions):
		</span>
		</td>
	</tr>
	
	
<?php


	for ($i=9; $i<count($charge_amt); $i++):
		echo "<tr bgcolor='white'>\n\n";
		echo "<td class='mytd' style='padding:10px;'>";
		echo "<input type='radio'  style='border:0' name='service_month' alt='radio' emsg='Please specify your payment option.' value='". $i ."' >";
		echo "</td>\n\n";
		if ($charge_mon[$i]==1){
			echo "<td class='mytd service2 ltd' style='padding:10px'>" . $charge_mon[$i] . " Month Services </td>\n";
			
		}else{
			echo "<td class='mytd service2 ltd' style='padding:10px'>" . $charge_mon[$i] . " Months Services </td>\n";
		}
		echo "<td class='mytd2d'>&#163;" . num2($charge_amt[$i]) . "</td>\n";
		echo "</tr>\n\n";
	endfor;		
?>

	
</table>

<br>
 <table border="1" cellpadding="4" cellspacing="1" style="margin:auto auto;border-collapse: collapse" bordercolor="#2E8BC9" width="80%">
	<TR bgcolor='#2E8BC9'>
	<td class='mytd ltd' colspan='2' style="color:#fff">PAY BY:</td>
	</tr>
	<td> <input type="radio" name="payment_gate" checked value = "2" > </td>
	<td> <img src='images/paypal_image.jpg' border='0' style='padding-left:5px;padding-top:0px;	' /></td>
	</tr>

	</tr>
	<td> <input type="radio" name="payment_gate"  value = "1" > </td>
	<td> <img src='images/skrill-payby-150x83_en.gif' border='0' style='padding-left:5px;padding-top:0px;'s /></td>
	</tr>
</table>

<div style='text-align:center;margin:20px;'>


 
 <?php if (isset($_SESSION["userid"])) { ?>
	<INPUT TYPE="submit" class='btn' value="Proceed to Pay"> 

<?php }else{ ?>
		<!-- <div class='error_div' style='width:108px;margin:auto auto;'><a class='sbar' href='login.php'>Login Please</a></div> -->
		 
		 <span class='red' style='font-size:12px;'>Please log in before attempting to pay.</span><br /><br />
		 
		<INPUT TYPE="button" class='btn' value="Proceed to Pay" onclick="alert('Please log in.')"> 

 <?php } ?>



</form>
<!--
 <div style='text-align:center;margin:40px;'>
 <img src="https://www.skrill.com/fileadmin/content/images/brand_centre/Payment_Options_by_Skrill/skrill-powered-long_224x60.png" alt="Multiple Options by Skrill" title="Multiple Options by Skrill">
 </div>
-->

</div>

<a name="notes"></a>

<div style='padding:00px 30px; font-size:14px;'>

<span class='bb' style='color:#852064'>ESSENTIAL NOTES:</span>
<ol>
<li style='padding-bottom:10px;'>Access to the current week's predictions data on this website will be <b>100% free-of-charge</b> until midnight on <b>31 December 2015</b> <span class='bb'>but only for Registered Members</span>.  The <span class='bb'>START DATE</span> for the subscription Services will still not be until <span class='bb'>01 January 2016</span>, no matter when you pay us in 2015.     </li>

<li style='padding-bottom:10px;'>From <span class='bb'>01 January 2016</span> only <span class='bb'>Subscribing Members</span> will be eligible to access the current week's predictions data.  </li>

<li style='padding-bottom:10px;'><b>However, you must be a</b> <span class='bb'>Registered Member</span> before you can subscribe!  If you are not currently a Registered Member but would like to become one, please <span class='bb'><a class='bb' href='register.php'>click here</a></span> to <b>Register Now</b> and then come back to this Subscribe page when you decide you want to commence paying.  </li>

<li style='padding-bottom:10px;'>After you have registered with us <span class='bb'>you will receive a confirmation email from AWeber</span>, and to be able to get access to the data on this website you will be required to click on the confirmation link in that AWeber email.  The reason for having to do that is because of the anti-spamming laws that now surround online businesses; if we don't have your permission to send you our weekly advisory emails (we will never be trying to sell you anything) then AWeber may close our mass emailing service down, and that would cripple one arm of our services.  We therefore have to insist that you click on that Aweber confirmation link, because we can't allow anybody to cripple us in that way.  If we don't get confirmation of your AWeber confirmation, then you will not be able to get access to our Services - it's that simple!      </li>

<li style='padding-bottom:10px;'><b>Casual Visitors</b> to this website </span>will only ever be able to view the Home Page "Free Soccer Predictions" (with full backup data) plus the past predictions data stretching back many years; the current week's predictions data will not be available to them.</li>

<li style='padding-bottom:10px;'>From <span class='bb'>01 January 2016</span> all Registered Members who have not subscribed will be considered to be the same as "<b>Casual Visitors</b>", and their access will be limited in line therewith.  To regain full access to the current week's predictions data after that date, all that the non-subscribing Registered Members will need to do is commence subscribing.  </li>


<li style='padding-bottom:10px;'>To avoid having to pay the the increased fees, <span class='bb'>Registered Members</span> are advised to take advantage of our "<span class='bb'>EARLY BIRD FEES</span>", which will no longer be on offer at these same low rates <b>after 31 December 2015</b>.     </li>

</ol>
<a href="#top">Go to Top</a>
</div>


 
<?php require_once("footer.ini.php"); ?>