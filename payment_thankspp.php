<?php
session_start();

$page_title="Payment Successful";

require_once("config.ini.php");
require_once("function.ini.php");
require_once("reguser.php");

// Validate the Paypal Transaction id
$trans_id = $_POST['txn_id'];

require_once("header.ini.php");
?>

<style>
	.f14 { font-size:14px; padding:5px;}
</style>


<?php

page_header($page_title) ; 
echo "<div style='border:1px solid #3366FF; padding:20px;margin:5px;background:#F2F2FF;font-size:14px;line-height:180%'>";


   //if ($concatFields == strtoupper($_GET['msid']) ){
	
	if ( strlen($trans_id)>3 ){
	   
	   $sql = "select p.*, date_format(e.expire_date,'%d-%M%-%Y') as edate from skrill_expiration e, skrill_payments p where 
	   e.trans_id = p.sk_trans_id and p.sk_trans_id = '$trans_id' order by p.rid desc limit 1";
	   
	   $temp = $eu->prepare($sql);
	   $temp->execute();
	   $data = $temp->fetch();
	   $cur_code =  $data['sk_currency'];
	   
	   if ($temp->rowcount()>0){
	   
			   
				echo "
				Dear <B>" . $data['paw_id'] . "</B>,<br><br>

				Thank you for your subscription. You have been billed <b>". num2($data['sk_amt']) ."</b> in <b>". $cur_code ."</b> via SKRILL. <br><br>

				
				<table border='1' style='border-collapse: collapse' bordercolor='#c4c4c4'  width='80%'>
				<tr><td colspan='2' class='credit' bgcolor='#cccccc'><b>Transaction Details</b></td></tr>
				<tr><td class='f14' width='50%'>SKRILL reference number: </td><td width='60%' class='f14 rtd'><b>".$data['sk_trans_id'] . "</b> </td></tr>
				<tr><td class='f14'>Amount Billed:</td><td class='f14 rtd'> <b>$cur_code ". num2($data['sk_amt']) ."</b> </td></tr>
				<tr><td class='f14'>Subscription Expires:</td><td class='f14 rtd'> <b>". $data['edate']  . "</b> </td></tr>
				</table>
				<br>
				Many thanks,<br><br>
				Administrator<br> ";

				echo '<i><b><font color="blue">Soccer-Predictions.com</font></b></i>';
		}else{
			
			echo "<font class='credit'>Invalid Transaction.</font>";
		}
	
		session_start();
		ob_start();
		session_destroy();
	    
		
   }else{
	   
	   echo "<font class='credit'>Invalid Transaction.</font>";
   }
		
		
	echo "</div>";
	
?>
<br />
<br />
<center>
<a href='login.php' class='prv' style='font-size:14px;'>Click here</a> to Login</td>
</center>

<?php require_once("footer.ini.php"); ?>

