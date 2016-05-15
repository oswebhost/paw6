<?php	 
session_start();
$url ="http://www.soccer-predictions.com" ;

include("config.ini.php");
include("function.ini.php");

$_SESSION['order']    = rand(1111111,999999999) ;
$_SESSION['userid']   = $_POST['userid'] ;
$_SESSION['email']    = $_POST['email'];
$_SESSION['passcode'] = md5($_POST['pass2']);
$_SESSION['amount']   = (int) $_POST['amount'] * 100 ;
$_SESSION['currency'] = $_POST['currency'];

$sql = mysql_query("select date_add(now(),  interval 2 month) as newdate") or die (mysql_error());
$d = mysql_fetch_array($sql);
$starting_date =  substr($d['newdate'],0,4) . substr($d['newdate'],5,2) . substr($d['newdate'],8,2);



?>


<html>
<head>
<title>Connection....</title>
<link rel="stylesheet" type="text/css" href="style.css" />



</head>

<body onload="netbanx.submit();">

<form name="netbanx" method="post" action="https://pay.netbanx.com/predictawin-upp">

<input type="hidden" name="paw_refno"	   value="<?echo $_SESSION['order']; ?>" /><br>
<input type="hidden" name="paw_user_id"    value="<?echo $_SESSION['userid']; ?>" /><br>
<input type="hidden" name="paw_user_email" value="<?echo $_SESSION['email']; ?>" /><br>
<input type="hidden" name="paw_trans_code" value="<?echo $_SESSION['passcode']; ?>" /><br>

<input type="hidden" name="nbx_currency_code"      value="<?echo $_SESSION['currency']?>" /><br>
<input type="hidden" name="nbx_payment_amount"     value="<?echo $_SESSION['amount']?>" /> 	<br>
<input type="hidden" name="nbx_merchant_reference" value="<?echo $_SESSION['order']; ?>" />

<input type="hidden" name="nbx_sb_create"           value="1" /><br>
<input type="hidden" name="nbx_sb_frequency_1"      value="monthly" /><br>
<input type="hidden" name="nbx_sb_amount_1"         value="<?echo $_SESSION['amount']?>" />	<br>
<input type="hidden" name="nbx_sb_lifetime_1"       value="forever" />	<br>
<input type="hidden" name="nbx_sb_retry_interval_1" value="0"/>
<input type="hidden" name="nbx_sb_retry_lifetime_1" value="0"/>
<input type="hidden" name="nbx_payment_types"       value="card,paypal,directpay24,ukash"/>

<input type="hidden" name="nbx_success_url"			 value="http://predictawin.com/successful-cc.php" />
<input type="hidden" name="nbx_success_redirect_url" value="http://predictawin.com/thankyou-cc.php" />

<? if ($_SESSION['currency']=="USD"){ ?>

	<input type="hidden" name="nbx_failure_redirect_url" value="http://soccer-americas.com/failure.php" />
	<input type='hidden' name="nbx_failure_url"			 value="http://soccer-americas.com/failure.php" />

<?}else{?>

	<input type="hidden" name="nbx_failure_redirect_url" value="http://predictawin.com/failure.php" />
	<input type='hidden' name="nbx_failure_url"			 value="http://predictawin.com/failure.php" />

<?}?>

<input type='hidden' name="nbx_redirect_exclude" value="nbx_return_url,nbx_houseno_auth,nbx_timeout,nbx_success_redirect_url,nbx_houseno,nbx_CVV_auth,nbx_postcode,nbx_failure_redirect_url,nbx_redirect_exclude,paw_refno,nbx_success_url, nbx_failure_url" />


<input type="hidden" value="Pay Now!"> 


</form>



<div style='padding:0px;text-align:center'> 
	<font size="+2" face="verdana">Connecting to<br>
	<img border="0" src="<?=$domain?>/images/visa-masterfp.gif" alt=''><br>
	Please wait...</font>
</div>




</body>
</html>