<?php

require_once("config.ini.php");
require_once("function.ini.php");
require_once("reguser.php");



$sk_transid  = $_POST['transaction_id'];
$merchant_id = $_POST['merchant_id'];
$mb_amount   = $_POST['mb_amount'];  // paid amt
$mb_currency = $_POST['mb_currency']; // paid currency
$pay_status  = $_POST['status'];  // 
$payment_type= $_POST['payment_type'];
$sk_custid   = $_POST['customer_id'];
$md5sig      = $_POST['md5sig'];

$paw_id         = $_POST['paw_userid'] ;
$paw_user_email = $_POST['paw_user_email'] ;
$service_id     = $_POST['service_id'];// 

$expire_date = calculate_expiration_date($service_id); 

$send_amount   = $_POST['amount'];
$send_currency = $_POST['currency'];


// Validate the Moneybookers signature
$concatFields =  $_POST['merchant_id']
				.$_POST['transaction_id']
				.strtoupper(md5($skrill_secret))
				.$_POST['mb_amount']
				.$_POST['mb_currency']
				.$_POST['status'];


				
$MBEmail = 'accounts@soccer-predictions.com';
 
  
// Ensure the signature is valid, the status code == 2,
// and that the money is going to you
if (strtoupper(md5($concatFields)) == $_POST['md5sig'] && $_POST['status'] == '2' && $_POST['pay_to_email'] == $MBEmail){
    // Valid transaction.
		
	$sql ="INSERT INTO `skrill_payments` (`pay_date`,`paw_id`,`paw_service`, `paw_amt`, `sk_currency`,`sk_amt`,`sk_type`,`sk_status`,`sk_trans_id`,`sk_cust_id`,`sk_md5sig`) values 
	 (now(),'$paw_id','$service_id', '$send_amount','$mb_currency','$mb_amount','$payment_type',
	 '$pay_status','$sk_transid','$sk_custid', '$md5sig')";
	 

	// echo $sql ;
	 $temp = $eu->prepare($sql);
	 $temp->execute();
	  
	 $sql ="insert into `skrill_expiration` (userid, trans_id, pay_date, expire_date) values ('$paw_id','$sk_transid', now(),'$expire_date')";
	 
	 $temp = $eu->prepare($sql);
	 $temp->execute();
	 //echo $sql ;
	
	
    
}else{
    
	// Invalid transaction. Bail out
    exit;
}


?>

