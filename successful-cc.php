<?php
 session_start();
  
  if ($_SESSION['by']=='YM'){
        $PaW = "YM";
  }else{
    $PaW = 'PaW';
  }
    

$from_url = parse_url($_SERVER["HTTP_REFERER"]) ;
$ip       = $_SERVER['REMOTE_ADDR']; 

$values="------------------\n";
$values.= date("d-M-Y H:i") . "\n";

foreach($_POST as $field=>$value)
{
	$values.=$field."=".$value."\n";	
}
$values.= $from_url["host"] . "\n" . $ip . "\n";
$values.="------------------\n";

$filename = dirname(__FILE__) . '/logs/signup_log.txt';
$fp = fopen($filename, "a");
fwrite($fp, $values );
fclose($fp);



include("config.ini.php");

include("function.ini.php");


if ( $_POST["nbx_status"] == "passed"): //netbanx.com
	
	$client_name = addslashes($_POST["nbx_cardholder_name"]);
	$pay_amt     = $_POST["nbx_payment_amount"]/100;
	$ref_no      = $_POST["nbx_netbanx_reference"];
	$paw_refno   = $_POST["paw_refno"];
	$paw_id      = $_POST["paw_user_id"];	
	$paw_email   = $_POST["paw_user_email"];
	$paw_code    = $_POST["paw_trans_code"];
	$cur_code    = $_POST["nbx_currency_code"];

	
	$comments = "Initial payment"; 
	
	$postback = $values ;

	$ref_count = 0;
	$temp = $eu->prepare("select * from net_banx where reference_no='$ref_no'");
    $temp->execute();
    $ref_count = $temp->rowCount();

	if ($ref_count==0){
		$sql = "insert into net_banx values (0, '$paw_id', '$paw_refno', '$ref_no', now(), '$cur_code', '$pay_amt', '$comments' ,'$postback')";
        $temp= $eu->prepare($sql);
        $temp->execute();    
	}
	

    $temp = $eu->prepare("select userid from userlist where userid='$paw_id'");
    $temp->execute();
	$rdate = date("d-M-Y");

	if ($temp->rowCount() == 0){
		$sql = "insert into userlist (userid, pwd, fullname,ip, email,logcount,confirm,paidmem,last_login, refer_by,validupto, date_reg,regdate) values ('$paw_id', '$paw_code', '$client_name', '$ip', '$paw_email', '1', 'Y', '1', now(), '$PaW', now(), now(),'$rdate')";
        $temp= $eu->prepare($sql);
        $temp->execute();    
	}
	
	if ($ref_count==0){
		$sql = "update userlist set memtype='', validupto = DATE_ADD(validupto, INTERVAL 1 MONTH) WHERE `userid`='$paw_id'";
        $temp= $eu->prepare($sql);
        $temp->execute();    
	}

endif;

$newRef = $_POST["nbx_netbanx_reference"];
$x = send_email("oswebhost@gmail.com","admin@soccer-predictions.com",$newRef, "Ref. $newRef");

?>