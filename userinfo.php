<?php

session_start();   

if (!isset($_SESSION['userid']) ){
	header("location: authorization.php");
   //$weekno=$lastweek-1;
}

$page_title="My Account Details";

global $logout;
$logout = '<a class="rm" href="logout.php">»Logout</a>';

require_once("config.ini.php");



// also update REGUSER.php  just for $change_mon variable
$charge_mon  = array( 12,  12,   12,  12,  12,  12,  12,  12,  12, 12,    9,   6,   3, 1);
//$charge_amt  = array( 115, 115, 145, 175, 205, 235, 265, 295, 325, 345, 285, 215, 125);


require_once("function.ini.php");
require_once("header.ini.php");
require_once("reguser.php");


$sql = "select p.*, date_format(p.pay_date,'%d-%b%-%Y') as paydate, date_format(e.expire_date,'%d-%b%-%Y') as edate from skrill_expiration e, skrill_payments p where e.trans_id = p.sk_trans_id and p.paw_id = '$_SESSION[userid]' order by p.pay_date desc ";



   
$temp = $eu->prepare($sql);
$temp->execute();

$norows = $temp->rowcount() ;



page_header("My Account Details") ;

if ($_SESSION['userid']=='imran' or $_SESSION['userid']=='wally'){
	//echo "<pre>";
	//print_r($_SESSION);
	//echo "</pre>";
}

?>


<center>
<BR>

<table border="0" width="80%" cellspacing="0" cellpadding="5" bgcolor="#F1F1F1" 
style="border:1px solid #F4C300;">
<tr>
	<td colspan='2' style="background:#F4C300;" class="credit"><span class=credit>Welcome</span></td>
</tr>

<tr>
<td width="70%" align="left" height="130" valign='top'  class="credit">
Hi <b><font color="#0000FF"><?php echo ucwords($userid)?></font>  <font size='2'>(<?php echo $_SESSION['email'];?>)</font><br><br>
</b>Welcome to <b><font color="#0000FF">Soccer Predictions</font><br></b>
<br>
<table width="100%" border='0' cellpadding='5'>

<tr>
	<td align='right' width='200'  class="credit"> No of Logins: </td>
	<td  class="credit" width='200'> <b><?php echo $_SESSION["logcount"] ?></b> </td>
</tr>

<tr>
	<td align='right'  class="credit"> Member Since: </td>
	<td  class="credit"> <b><?php echo $_SESSION["date_reg"] ?></b> </td>
</tr>

<tr>
	<td align='right'  class="credit"> Services Expiry Date: </td>
	<td  class="credit"> <b>
	
	<?php

		if($_SESSION['expire']==100){
			
			echo  $_SESSION['vdate2'];
			
		}else{
			
			echo "** EXPIRED **";
		}
		
	?>
	
	</b> </td> 
	
</tr>				



</table>
</td>
</tr>
</table>

 <?php 
 	if ($temp->rowcount()==0) { ?>
		<div class="error_div" style="text-align:left;margin-top:20px;font-size:15px;width:440px">

			Hi <?php echo ucwords($userid)?>,<br/><br/>
			
			Thank you for having registered with us. However, you will not be able to see the current week's predictions unless you first: <br><br/>
			<center><a href="payment_options.php" class="bb">SUBSCRIBE</a></center><br/>

			Thanks and regards,<br/><br/>

		
			Woz Salmon  

		</div>
<?php } ?>	

<br />

<table cellspacing='0' width='460' border='0' cellpadding='10' style="border:2px solid #f4c300;background:#666;">
<tr>

	<td  width='30%' >
		<a class='toplink' href="http://www.freetellafriend.com/tell/" onclick="window.open('http://www.freetellafriend.com/tell/?option=manual&title='+encodeuricomponent(document.title)+'&url='+encodeuricomponent('predictawin.com'), 'freetellafriend', 'scrollbars=1,menubar=0,width=617,height=530,resizable=1,toolbar=0,location=0,status=0,screenx=210,screeny=100,left=210,top=100'); return false;" title="tell a friend" target="_blank"><span class='credit'>Tell-A-Friend</span></a>
	</td>

	<td  width='36%' align='center' >
		<a class='toplink' href="changepassword.php"><span class='credit'>Change Password</span></a>
	</td>
</tr>
</table>


<?php

  if ($temp->rowcount()>0) {

?>
		<span class='credit bb' >Payment History</span>
		 <table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse;margin:5px auto 0 auto;" bordercolor="#0057C1" width="95%" >
		  <tr bgcolor="#ccc" height='25'>
			<td width="10%" class='ctd'><b>Pay Date</b></td>
			<td width="8%" class='ctd'><b>Trans. Id</b></td>
			<td width="15%" class='ctd'><b>Services Package</b></td>
			<td width="10%" class='ctd'><b>Expiry Date</b></td>
			<td width="10%" class='ctd'><b>Amount</b></td>
		  </tr>
		<?php
			
	    
		while ($row = $temp->fetch()){

			   $cur_code =  $row['sk_currency'];
			   
		?>
			 <tr <?php echo rowcol($number);?>>
				<td class='ctd' style='font-family:verdana;'><?php echo $row['paydate'] ;?></td>
				<td class='ctd' style='font-family:verdana;'><?php echo $row['sk_trans_id'] ;?></td>
				<td class='ctd' style='font-family:verdana;'><?php echo $charge_mon[$row['paw_service']] ;?>-Months Services</td>
				<td class='ctd' style='font-family:verdana;'><?php echo $row['edate'] ;?></td>
				<td class='ctd bb' style='font-family:verdana;'><?php echo $cur_code ;?> <?php echo ($row['sk_amt']) ;?></td>
			  </tr>
			
			<?php
		}
	 ?>
	  
	 </table>
	   <br /><br />
	   
<?php } ?>

<br /><br />



<div class='error_div' style='width:150px;'><a class="sbar" href="logout.php">*** L o g o u t  ***</a></div>
<br />


<div style='text-align:center;width:450px; margin:auto auto;border:1px solid #23488C;background:#E9EFFF;padding:5px;font-size:13px;padding:10px 0'>
	   <a class='sales' href='get8rules.php'><b>8 GOLDEN RULES for SUCCESSFUL SOCCER BETTING</b></a> <br/>
</div>


</center>
<?php require_once("footer.ini.php"); ?>