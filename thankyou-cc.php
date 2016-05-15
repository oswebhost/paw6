<?php	
session_start();



include("config.ini.php");

include("function.ini.php");

$page_title="Payment Successful";

include("header.ini.php");
?>
<style>
	.f14 { font-size:14px;}
</style>
<?php
/*ss
$ref_no = "";
$ref_no      = $_REQUEST["nbx_netbanx_reference"];

$temp = $eu->prepare("select * from net_banx where reference_no='$ref_no'");
$temp->execute();
$d2  = $temp->fetch();

$_userid = $d2['userid'];
$cur_code= $d2['currency'];
$pay_amt = $d2['amount'] ;

$temp = $eu->prepare("select date_format(validupto,'%d-%b-%Y') as validupto from userlist where userid='$_userid'");
$temp->execute();
$d2  = $temp->fetch();
$_validupto = $d2['validupto'];
*/
//if (strlen($ref_no)>0 and strlen($_userid)>0):

	page_header($page_title) ; 


	echo "<div style='border:1px solid #3366FF; padding:20px;margin:5px;background:#F2F2FF;font-size:14px;line-height:180%'>

	Dear <B>$_userid</B>,<br><br>

	Thank you for your subscription. You have been billed <b>". num2($pay_amt) ."</b> in GBP via SKRILL. <br><br>

	
	<table border='1' style='border-collapse: collapse' bordercolor='#c4c4c4'  width='80%'>
	<tr><td colspan='2' class='credit' bgcolor='#cccccc'><b>Transaction Details</b></td></tr>
	<tr><td class='f14' width='60%'>SKRILL reference number: </td><td width='60%' class='f14 rtd'><b>". $ref_no . "</b> </td></tr>
	<tr><td class='f14'>Amount Billed:</td><td class='f14 rtd'> <b>$cur_code ". num2($pay_amt) ."</b> </td></tr>
	<tr><td class='f14'>Subscription Expires:</td><td class='f14 rtd'> <b>". $_validupto  . "</b> </td></tr>
	</table>
	<br>
	Many thanks,<br><br>
	Administrator<br> ";

	echo '<i><b><font color="blue">Soccer-Predictions.com</font></b></i>';


	echo "</div>";
	echo "<br><br>";

	

//endif; 

?>

<table style='width:50%;margin:auto auto;font-size:14px;' cellpadding='5'>
	<tr>
		<td width='50%' style='font-size:14px;'><a href='login.php' class='prv' style='font-size:14px;'>Click here</a> to Login</td>
		<td></td>
	</tr>

</table>

</center>




<? include("footer.ini.php"); ?>