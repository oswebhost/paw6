<?php

require_once("config.ini.php");
require_once("function.ini.php");

$TITLE =  "Register";

require_once("header.ini.php");

require_once('recaptchalib.php');

// Get a key from http://recaptcha.net/api/getkey
$publickey = "6Lfifb8SAAAAANecvFWSk_hEdIyjo9lWxB-ZrXMT";
$privatekey = "6Lfifb8SAAAAAD4F20Eks0nKYB9tOgD8NxOLq2jK";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;

# was there a reCAPTCHA response?
if ($_POST["recaptcha_response_field"]) {
    $resp = recaptcha_check_answer ($privatekey,
                                    $_SERVER["REMOTE_ADDR"],
                                    $_POST["recaptcha_challenge_field"],
                                    $_POST["recaptcha_response_field"]);

    if ($resp->is_valid) {
            $error= "You got it!";
    } else {
            # set the error code so that we can display it
            $error = $resp->error;
    }
}	

$msg = $_GET['msg'];


page_header("Register");



if (strlen($msg)>5){
?>
<div style="text-align:center;width: 410px; margin:10px auto; border:1px solid red; background:#FFF0F0; padding:5px;font-size:14px;line-height:150%"> 
	 <?php echo $msg;?>  
</div>

<?php }?>

<div style="text-align:left;width: 410px; margin:10px auto; border:1px solid red; background:#FFF0F0; padding:5px;font-size:14px;line-height:150%"> 
	 If you wish to become a Subscribing Member then you will need to register with us first before you can pay. Please see the Notes below.  

</div>




<div class="salespage2" style="margin-top:2px;padding-left:25px;padding-right:20px;">

<style>
  input[type="radio"] {font-size:16px;}
</style>


<br />

<form method='post' name='signup' action='aweber2.php' onsubmit="return checkPass();">
		
	


<table width='420' cellpadding='3' cellspacing='0' border='0' style='border:1px solid #006600; background:#F7FFE6;margin: auto auto;'>

	<tr>
		<td width='30%' style='font-size:12px;padding-top:10px;' align='right'>User ID: </td>
		<td width='80%' style='padding-top:10px;'>
		<input type='text' style='width:150px;padding:4px;' name='userid' id='userid' onblur="AjaxCallUser(this.value)"> 6 - 12 characters
		</td>
	</tr>	
	<tr>
		<td></td>
		<td><span id="txtUserid" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
	</tr>

	<tr>
		<td style='font-size:11px;' align='right'>Email Address: </td>
		<td><input type='text' style='width:250px;padding:4px;' name='email' id='email' onblur="AjaxCallEmail(this.value)"></td>
	<tr>
		<td></td>
		<td><span id="txtEmail" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
	</tr>
	</tr>
	<tr>
		<td width='20%' style='font-size:12px;' align='right'>Password: </td>
		<td width='80%'>
		<input type='password' style='width:150px;padding:4px;' name='pass' id='pass' > Min. 6 characters
		</td>
	</tr>	
	<tr>
		<td></td>
		<td><span id="txtUserid22" style='font-size:10px;font-weight:bold;color:#ff0000;'></span></td>
	</tr>
	<tr>
		<td width='20%' style='font-size:12px;' align='right'>Confirm Password: </td>
		<td width='80%'>
		<input type='password' style='width:150px;padding:4px;' name='pass2' id='pass2'>
		</td>
	</tr>

	  <tr>
		<td width='20%' style='font-size:12px;padding-left:20px;' align='right' valign='top'>How did you know about us:</td>
		<td width='80%'>
        <input type="radio" onclick="javascript:googleCheck();" id="radio1" name="group1" value="1">Google search<br />
        <input type="radio" onclick="javascript:googleCheck();" id="radio2" name="group1" value="2">Forum link<br />
        <input type="radio" onclick="javascript:googleCheck();" id="radio3" name="group1" value="3">Word of mouth recommendation<br />
        <input type="radio" onclick="javascript:googleCheck();" id="radio4" name="group1" value="4">YouTube<br />
        <input type="radio" onclick="javascript:googleCheck();" id="radio5" name="group1" value="5">Facebook<br />
        <input type="radio" onclick="javascript:googleCheck();" id="radio6" name="group1" value="6">Twitter<br />
       
       <div style="padding-top:10px;visibility:hidden" id="txtinput">
         <label for="fourmtext" id="f1" style='color:blue;font-size:12px;' title="optional"> asdfsadf </label>
         <input type='text' style='width:250px;padding:4px;' name='googletext' id='googletext' >
      </div>

		</td>
	</tr>
   <tr>
   
      <td colspan="2" style="padding-left:50px;padding-top:0px"><? //echo recaptcha_get_html($publickey, $error); ?>
	  <div class="g-recaptcha" data-sitekey="6LeKWtgSAAAAAFbgIMbnLXDJRjYL8xBp7JTRteRU"></div>
	  </td>												

    </tr>	
	<tr>
		<td colspan='2' style='padding:10px 0 15px 0;text-align:center;'>
			<input type='submit' value='Register' class='greenbt' />
		</td>
	</tr>
</table>

	
</form>

<div style='padding:30px 30px; font-size:14px;'>

<b>NOTES:</b>
<ol>
<li style='padding-bottom:10px;'>After you have registered with us <span class='bb'>you will receive a confirmation email from AWeber</span>, and to be able to get access to the data on this website you will be required to click on the confirmation link in that AWeber email. </li>
 
<li style='padding-bottom:10px;'>The reason for having to do that is because of the anti-spamming laws that now surround online businesses; if we don't have your permission to send you our weekly advisory emails (we will never be trying to sell you anything) then AWeber may close our mass emailing service down, and that would cripple one arm of our services.</li> 
 
<li style='padding-bottom:10px;'>We therefore have to insist that you click on that Aweber confirmation link, because we can't allow anybody to cripple us in that way.  If we don't get confirmation of your AWeber confirmation, then you will not be able to get access to our Services - it's that simple!</li> 
     
<li style='padding-bottom:10px;'>A valid email address is required from you for two reasons: (i) because AWeber will require confirmation of registration, <span class='red'>so the email address needs to be one you use regularly and can remember easily</span>, and (ii) if you later lose your membership details we will resend you the access details to the email address you registered with us.</li>

<li style='padding-bottom:10px;'>If you can't access your email because you can't remember your password (which often happens with some silly Members), we can't help you.... So be warned!</li>

</ol>   

</div>

</div>


<?php require_once("footer.ini.php"); ?>


