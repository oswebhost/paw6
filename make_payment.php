<?php
session_start();
$url ="http://www.soccer-predictions.com" ;


$_SESSION['order']    = rand(1111111,999999999) ;
$_SESSION['userid']   = $_POST['userid'] ;
$_SESSION['email']    = $_POST['email'];
$_SESSION['passcode'] = $_POST['pass2']; 
$_SESSION['currency'] = "GBP" ;


$_SESSION['amount']   = (int) 2 * 100 ;   // first payment 2 pound

$_SESSION['regular_monthly'] = (int) 4 * 100; // payment from 3rd month onward

?>


<html>
<head>
<title>Connection....</title>
<link rel="stylesheet" type="text/css" href="style.css" />

<style>
	input { width:300px;}
</style>


</head>
 



<body onload="netbanx.submit();">

<form name="netbanx" method="post" action="https://pay.netbanx.com/soccer-predictions-upp">	

<input type="hidden" name="paw_refno"	   value="<?echo $_SESSION['order']; ?>" /><br/>
<input type="hidden" name="paw_user_id"    value="<?echo $_SESSION['userid']; ?>" /><br/>
<input type="hidden" name="paw_user_email" value="<?echo $_SESSION['email']; ?>" /><br/>
<input type="hidden" name="paw_trans_code" value="<?echo $_SESSION['passcode']; ?>" /><br/>

<!-- first payment of 2 pound -->
<!-- 1st payment of 2 pound....<br/> -->
<input type="hidden" name="nbx_currency_code"      value="<?echo $_SESSION['currency']; ?>" /><br/>
<input type="hidden" name="nbx_payment_amount"     value="<?echo $_SESSION['amount']; ?>" /> <br/>
<input type="hidden" name="nbx_merchant_reference" value="<?echo $_SESSION['order']; ?>" /><br/><br/>

<!-- create schedule billing<br/> -->
<!-- first payment of 2 pound -->
<input type="hidden" name="nbx_sb_create"           value="1" /><br/><br/>

<!--2nd payment of 2 pounds.<br/>-->
<!-- 1 more payment of 2 pounds. -->
<input type="hidden" name="nbx_sb_frequency_1"      value="monthly" /><br/>
<input type="hidden" name="nbx_sb_amount_1"         value="<?echo $_SESSION['amount']; ?>" />	<br/>
<input type="hidden" name="nbx_sb_lifetime_1"       value="1" />	<br/>
<input type="hidden" name="nbx_sb_retry_interval_1" value="2"/><br/>
<input type="hidden" name="nbx_sb_retry_lifetime_1" value="3"/><br/><br/><br/>

<!--3rd payment shell be 4 pounds <br/> -->
<!-- 4 pounds payments afterword -->
<input type="hidden" name="nbx_sb_frequency_2"      value="monthly" /><br/>
<input type="hidden" name="nbx_sb_amount_2"         value="<?php echo $_SESSION['regular_monthly']; ?>" /><br/>
<input type="hidden" name="nbx_sb_lifetime_2"       value="forever" />	<br/>
<input type="hidden" name="nbx_sb_retry_interval_2" value="2"/><br/>
<input type="hidden" name="nbx_sb_retry_lifetime_2" value="3"/><br/><br/>


<input type="hidden" name="nbx_payment_types"          value="card,paypal,directpay24,ukash"/><br/>
<input type="hidden" name="nbx_success_show_content"   value="1" /><br/>
<input type="hidden" name="nbx_success_url"			   value="http://soccer-predictions.com/successful-cc.php" /><br/>
<input type="hidden" name="nbx_success_redirect_url"   value="http://soccer-predictions.com/thankyou-cc.php" /><br/>
<input type="hidden" name="nbx_failure_redirect_url"   value="http://soccer-predictions.com/failure.php" /><br/>
<input type='hidden' name="nbx_failure_url"			   value="http://soccer-predictions.com/failure.php" /><br/>


<input type="hidden" value="Pay Now!"/> 


</form>





</body>
</html>