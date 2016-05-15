<?php
session_start();

include("config.ini.php");
include("function.ini.php");
include("reguser.php");
include("header.ini.php");

$service_mon = $_POST['service_month'];

?>

<html>
<!--  onload="document.skrill.submit()"-->

<body onload="document.skrill.submit()">


<?php if ($_POST['payment_gate']=="1" ) { ?>

		 <div style='text-align:center;margin:80px;font-size:40px;'>

			Connection to Skrill. Please wait.... <br /><br />
		 
		 </div>
		 
		<form action="https://www.skrill.com/app/payment.pl" name="skrill" >

			<input type="hidden" name="language" value="EN"> <br/> 
			<input type="hidden" name="logo_url" value="http://soccer-predictions.com/images/logoonly.gif"><br/> 
			<input type="hidden" name="pay_to_email" value="accounts@soccer-predictions.com"><br/> <br/> 

			
			<input type="hidden" name="return_url" value="http://soccer-predictions.com/payment_thanks.php"><br/> 
			<input type="hidden" name="cancel_url" value="http://soccer-predictions.com/payment_options.php"><br/> 
			<input type="hidden" name="status_url" value="http://soccer-predictions.com/payment_status.php"><br/> <br/> 
			
			<input type="hidden" name="merchant_fields" value="paw_userid, paw_user_email, service_id"><br/> 
			<input type="hidden" name="paw_userid"      value="<?php echo $_SESSION['userid'];?>"><br/> 
			<input type="hidden" name="paw_user_email"  value="<?php echo $_SESSION['email'];?>"><br/> 
			<input type="hidden" name="service_id"      value="<?php echo $service_mon;?>"><br/><br/> 
			
			<input type="hidden" name="pay_from_email"  value="<?php echo $_SESSION['email'];?>"><br/> 
			<input type="hidden" name="amount"          value="<?php echo num2($charge_amt[$service_mon]);?>"><br/> 
			<input type="hidden" name="currency"        value="GBP"><br/> 
			<input type="hidden" name="detail1_description" value="<?php echo paw_service_block($service_mon); ?>"><br/> <br/> 
			
			<input type="hidden" name="pm" value="DIN"><br/> 
			<input type="hidden" name="payment_methods" value="ACC,WLT"><br/> 
			<input type="hidden" name="submit_id"       value="Submit"><br/> 
			
		</form>

<?php }else { ?>

		 <div style='text-align:center;margin:80px;font-size:40px;'>
			Connection to PayPal. Please wait.... <br /><br />
		 </div>

		 
		 <form action="https://www.paypal.com/cgi-bin/webscr" method="post" name="skrill">
		
			<input type="hidden" name="cmd" value="_xclick">
			<input type="hidden" name="business" value="lady_punter@yahoo.com"><br />
			
			<input type="hidden" name="custom" value="<?php echo $_SESSION['userid'].'|'.$_SESSION['email'];?>">
			<input type="hidden" name="email"  value="<?php echo $_SESSION['email'];?>"><br />
			
			<input type="hidden" name="item_name" value="<?php echo paw_service_block($service_mon); ?>"><br />
			<input type="hidden" name="item_number" value="<?php echo $service_mon;?>"><br />
			
			<input type="hidden" name="amount" value="<?php echo num2($charge_amt[$service_mon]);?>"><br />
			<input type="hidden" name="currency_code" value="GBP"><br/> 
			
			<input type="hidden" name="notify_url"    value = "http://soccer-predictions.com/payment_statuspp.php"> <!-- IPN URL -->
			<input type="hidden" name="return"        value = "http://soccer-predictions.com/payment_thankspp.php"> <!-- thanyoupp.php URL -->
			<input type="hidden" name="rm" value="2">
			<input type="hidden" name="cbt" value="Return to Soccer-Predictions.com">
			
			<input type="hidden" name="cancel_return" value = "http://soccer-predictions.com/payment_options.php">
			
			<input type="hidden" name="submit_id" value="Submit"><br/> 
			
			
			
		</form>



<?php } ?>



</body>
</html>