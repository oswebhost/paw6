<?php

$page_title ="Subscribe";

$starting_value = 0;
$max_value      = 2500;



include("config.ini.php");
include("header.ini.php");
include("function.ini.php");
page_header($page_title); 

$temp = $eu->prepare("select count(uid) as cNo from userlist");
$temp->execute();
$data= $temp->fetch();
$show_value = ($data['cNo'] + $starting_value) ;

?>


<STYLE>
<!--

  .normal { background-color: #EFF3FF }
  .highlight { background-color: #F8F8D5 }
//-->
</style>



<div style='width:450px;margin:auto auto;font-size:12px;'>

<div  style='width:450px;height:70px;margin:auto auto;text-align:left;background:url(images/payback.gif) no-repeat'>
    
    
</div>

<div style='margin-top:5px;'></div> 
<p style="padding:10px 0 0px 0;font-size: 14px;line-height:180%;">
 There are two Payment Method options to choose from:<br />
 </p>
 <p style="padding:10px 0 0px 30px;margin-top:0;font-size: 14px;line-height:180%;">
 1. Monthly Recurring Payment of just <span class="bb">&pound;4.00</span> per month.<br />
 2. Lump-Sum Payment Method:<br />

<ul style="margin-top:0;margin-left:60px; " > 
  <li style="font-size: 14px;">3-Month Subscription for <span class="bb">&pound;11.00</span>.</li>
  <li style="font-size: 14px;">6-Month Subscription for <span class="bb">&pound;21.00</span>.</li>
  <li style="font-size: 14px;">12-Month Subscription for <span class="bb">&pound;40.00</span>.</li>
</ul>

</p>

  



<form method='post' name='signup' action='make_payment.php' onsubmit="return checkPass();">
		
		<input type='hidden' name='amount' value='2.00'/>
		<input type='hidden' name='currency' value='GBP'/>


		<table width='450' cellpadding='3' cellspacing='0' border='0' style='border:1px solid #2E61BC; background:#EFF3FF;'>
			<tr>
				<td colspan='2' class='padd' bgcolor='#2E61BC'><font size='+1' color='#ffffff'>New Subscribing Member Details</font></td>
			</tr>
			<tr>
				<td colspan='2' style='height:10px;'></td>
			</tr>
			<tr >
				<td width='30%' style='font-size:12px;' align='right'>User ID: </td>
				<td width='80%'>
				<input type='text' style='width:150px;padding:4px;border:1px solid #ccc;' name='userid' id='userid' onblur="AjaxCallUser(this.value)"> 6 - 12 characters
				</td>
			</tr>	
			<tr>
				<td></td>
				<td><span id="txtUserid" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
			</tr>

			<tr>
				<td style='font-size:12px;' align='right'>Email Address: </td>
				<td><input type='text' style='width:250px;padding:4px;border:1px solid #ccc;' name='email' id='email' onblur="AjaxCallEmail(this.value)"/></td>
			<tr>
				<td></td>
				<td><span id="txtEmail" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
			</tr>
			</tr>
			<tr>
				<td width='20%' style='font-size:12px;' align='right'>Password: </td>
				<td width='80%'>
				<input type='password' style='width:150px;padding:4px;border:1px solid #ccc;' name='pass' id='pass' />
				</td>
			</tr>	
			<tr>
				<td></td>
				<td><span id="txtUserid22" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
			</tr>
			<tr>
				<td width='20%' style='font-size:12px;' align='right'>Confirm Password: </td>
				<td width='80%'>
				<input type='password' style='width:150px;padding:4px;border:1px solid #ccc;' name='pass2' id='pass2'/>
				</td>
			</tr>
            <tr bgcolor="#8BAEF9">
				<td style='font-size:15px;padding:5px;' colspan="2"><strong>Choose Subscription Option</strong> </td>
            </tr>
            <tr>
				<td colspan="2"  style='font-size:14px;padding-left:80px;' align='right' valign="top">
				
                    <table width="100%" cellpadding="8" cellspacing="0" border="0"> 
                        <tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                            <td width='2'><input type="radio" name="paymentfor" value="1"/></td>
                            <td><span class="bb" style="font-size:14px;">&pound;4.00</span> Monthly Recurring Payment</td>
                        </tr>
                         
                         <tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                            <td ><input type="radio" name="paymentfor" value="2"/></td>
                            <td><span class="credit padd">3-Month</span> <span class="bb" style="font-size:14px;">&pound;11.00</span> Lump-Sum Payment </td>
                        </tr>
                        <tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                            <td ><input type="radio" name="paymentfor" value="3"/></td>
                            <td><span class="credit padd">6-Month</span> <span class="bb" style="font-size:14px;">&pound;21.00</span> Lump-Sum Payment </td>
                        </tr>
                        <tr onMouseOver="this.className='highlight'" onMouseOut="this.className='normal'">
                            <td ><input type="radio" name="paymentfor" value="4"/></td>
                            <td><span class="credit padd">12-Month</span> <span class="bb" style="font-size:14px;">&pound;40.00</span> Lump-Sum Payment</td>
                        </tr>


                    </table>
                    
                    
				        
				</td>
			</tr>
            
			
			<tr>
				<td colspan='2' style='padding:10px 0 15px 0;text-align:center;'>
					<input type='submit' value='Continue' class='greenbt' />
				</td>
			</tr>
		</table>

	
</form>


<div style="background:url(images/paynoteback.gif) no-repeat;margin-top:25px;height:240px;padding:5px;">


   
<font style='font-size:11px;'><b>PLEASE NOTE:</b></font>
<ol>
    <li style='font-size:11px;'><strong>If you choose the Monthly Recurring Payment option</strong>, then you will receive the <span class="bb">first 2 months' trial of our Services at half price</span>, plus we offer a <span style='color:#6600CC;'><b><i>100% money-back guarantee</i></b></span> if you don't wish to continue after the first month! <span class="bb">So your first 2 month's subscription is only £4 in total</span>, and you get it all back if you are not satisfied, without any questions asked from our side. </i>
    
	<li style='font-size:11px;'>The monthly recurring charge is due on the same day each month. You will be notified each month after payment has been received.</li>   
    
	<li style='font-size:11px;'>It shall be deemed that before making payment you read, fully understood, agreed to and accepted the provisions of our <a class='sbar' href='disclaimer.php'><em>Disclaimer</em></a> and <a class='sbar' href='refund.php'><em>Refund Policy</em></a> and that you are fully aware of what our Services will provide you with.</li>
</ol>


 
 
</div>


</div>




<? include("footer.ini.php"); ?>