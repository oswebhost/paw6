<?php
session_start();

 
include("config.ini.php");
include("function.ini.php");
include("header.ini.php");




$page_title = "Subscribe";

//regular charges

$charge_mon = array(12, 12, 3  , 6 , 9 , 12);
$charge_amt = array(115, 175, 125,215,285,345);




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

<div style='padding:20px;text-align:center;'>
<font size="+1">NOTE: Not Charging Yet - Still Free-of-Charge for Now!<br />But You Must Register!</font>
</div>

<div style='text-align:center;margin:10px;'>
 <img src="https://www.skrill.com/fileadmin/content/images/brand_centre/Payment_Options_by_Skrill/skrill-powered-long_224x60.png" alt="Multiple Options by Skrill" title="Multiple Options by Skrill">
 </div>

 
<form method="POST" action="payment_step2.php" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);" style="padding:0;margin:0">


	<INPUT TYPE="hidden" name="ACTION" value="ADD">
	




<div style="padding-bottom:5px;"></div>

 <table border="1" cellpadding="4" cellspacing="1" style="margin:auto auto;border-collapse: collapse" bordercolor="#c4c4c4" width="100%">
	<TR bgcolor='#cccccc'>
		<TD width='5%' class='mytd2' style='padding:20px;'><B>Select</B></TD>
		<TD width='80%' class='mytd2'><B>No. of Months </B></TD>
		<TD width='15%' class='mytd2'><B>Cost </B></TD>
	</TR>
	
	<tr>
		<td class='mytd' ><input checked type='radio' style='border:0' name='service_month' alt='radio' emsg='Please specify your payment option.' value='0' >
		<td class='mytd service2 ltd' style='padding:10px;'>12 Months Service from 01-Dec-15 (pay by 31-Oct-15)</td>
		<td class='mytd2'>&#163;<?php echo num2($charge_amt[0]) ;?></td>
	</tr>
	
	<tr>
		<td class='mytd' ><input disabled type='radio' style='border:0' name='service_month' alt='radio' emsg='Please specify your payment option.' value='1' >
		<td class='mytd2d service2 ltd' style='padding:10px;'>12 Months Service from 01-Dec-15 (pay from 01 to 30-Nov-15)</td>
		<td class='mytd2d'>&#163;<?php echo num2($charge_amt[1]) ;?></td>
	</tr>
<?


	for ($i=2; $i<=5; $i++):
		echo "<tr bgcolor='white'>\n\n";
		echo "<td class='mytd' style='padding:10px;'>";
		echo "<input type='radio' disabled style='border:0' name='service_month' alt='radio' emsg='Please specify your payment option.' value='". $i ."' >";
		echo "</td>\n\n";
		echo "<td class='mytd2d service2 ltd' style='padding:10px'>" . $charge_mon[$i] . " Months Service (not starting until 01-Dec-15)</td>\n";
		echo "<td class='mytd2d'>&#163;" . num2($charge_amt[$i]) . "</td>\n";
		echo "</tr>\n\n";
	endfor;		


	


?>

	 


</table>

<div style='text-align:center;margin:20px;'>

 <br>
 
 <?php if (isset($_SESSION["userid"])) { ?>
 <INPUT TYPE="submit" class='btn' value="Continue"> 

<?php }else{ ?>
		<!-- <div class='error_div' style='width:108px;margin:auto auto;'><a class='sbar' href='login.php'>Login Please</a></div>-->
 <?php } ?>



</form>
 <div style='text-align:center;margin:40px;'>
 <img src="https://www.skrill.com/fileadmin/content/images/brand_centre/Payment_Options_by_Skrill/skrill-powered-long_224x60.png" alt="Multiple Options by Skrill" title="Multiple Options by Skrill">
 </div>

</div>
 
<?php include("footer.ini.php"); ?>