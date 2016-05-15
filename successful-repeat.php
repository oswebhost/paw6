<?php

session_start();

include("config.ini.php");

include("function.ini.php");

$from_url = parse_url($_SERVER["HTTP_REFERER"]) ;
$ip       = $_SERVER['REMOTE_ADDR']; 



$values="------Repeat Payment----\n";
$values.= date("d-M-Y H:i") . "\n";
foreach($_POST as $field=>$value)
{
	$values.=$field."=".$value."\n";	
}
$values.= $from_url["host"] . "\n" . $ip . "\n";
$values.="------------------\n";

$filename = dirname(__FILE__) . '/xls/signup_log.txt';
$fp = fopen($filename, "a");
fwrite($fp, $values );
fclose($fp);




if ($_POST['status'] == 'passed' ): //netbanx.com
	
	$old_reference = $_POST["old_reference"];
	$pay_amt       = $_POST["amount"]/100;
	$ref_no        = $_POST["new_reference"];
	$status        = $_POST["status"];	
	

	$_userid   =  Old_Ref_to_Userid($old_reference) ;
	
	$comments = "Recurring payment";
	
	$postback = "POST=";
	foreach($_POST as $field=>$value){
		$postback .= $field . "=" . $value ." | ";	
	}

	$sql = "insert into net_banx values (0, '$_userid', '$ref_no', '$ref_no', now(), '$pay_amt', '$comments' ,'$postback')";
    $temp= $eu->prepare($sql);
    $temp->execute();    

	
	$sql = "update userlist set validupto = DATE_ADD(validupto, INTERVAL 1 MONTH) WHERE `userid`='$_userid'";
    $temp= $eu->prepare($sql);
    $temp->execute();    

	exit();
	
else:
	include("header.ini.php");
	page_header("Sorry!") ;
	echo "<center> <br><br><br><br><br> 
	
			<div class='error_div'>
				  <font size='+1'>Invalid transaction from IP $ip</font>
			</div>
		  </center>";
	include("footer.ini.php");
endif;


function Old_Ref_to_Userid($refno){
    global $eu;
    
	$sql = mysql_query("select userid from net_banx where reference_no='$refno'");
    $temp= $eu->prepare($sql);
    $temp->execute();    
    $d = $temp->fetch();
	return $d["userid"];
}

?>