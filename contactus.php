<?php

$page_title = "Contact Us";
require_once("config.ini.php");
require_once("function.ini.php");

require_once("header.ini.php");
require_once('recaptchalib.php');

 page_header($page_title) ; 


// Get a key from https://www.google.com/recaptcha/admin/create
$publickey = "6LeKWtgSAAAAAFbgIMbnLXDJRjYL8xBp7JTRteRU";
$privatekey = "6LeKWtgSAAAAAHTSTApzYTMi8M2Tv8MM6cZqU-SH";

# the response from reCAPTCHA
$resp = null;
# the error code from reCAPTCHA, if any
$error = null;




?>



<p>All enquiries regarding this website or our computer Program, including matters related to the philosophy, logic, principles and methodology employed, can be emailed to us using the below facility:  </p>



<?php


   
# was there a reCAPTCHA response?

if ($_POST["recaptcha_response_field"]) {
        $resp = recaptcha_check_answer ($privatekey,
                                        $_SERVER["REMOTE_ADDR"],
                                        $_POST["recaptcha_challenge_field"],
                                        $_POST["recaptcha_response_field"]);

        if ($resp->is_valid) {
            $c_name = ucwords($_POST["full_name"]);
			$info = contact_temp() ;
			$info = ereg_replace("%today%", date("r"), $info );
			$info = ereg_replace("%sendto%", $_POST["sendto"], $info );
			$info = ereg_replace("%full_name%", $c_name, $info );
			$info = ereg_replace("%email%", $_POST["email"], $info );
			$info = ereg_replace("%IP%", $REMOTE_ADDR, $info );
		  
			$info = ereg_replace("%comments%", stripslashes(nl2br(strip_tags($_POST["remarks"]))), $info );

		 	$x = send_email($_POST["sendto"],$_POST["email"],$info, $c_name. " - Message" ) ;
			if ($x == '1'):
				echo "<div class='info_div' style='width:40%;margin:40px auto 0 auto;'>
		    Hi $c_name,</span><br>Thanks for your email.
		    </div>";
				
			endif;
        


        } else {
                # set the error code so that we can display it
                $error = $resp->error;
        }
}

 show_form() ;   
?>


<p>Alternatively, you can write to us at:</p>
<p style='padding-left:30px'>
M.D. Salmon<br/>
BetWare Marketing and Promotions <br/>
MAKAJAS Building <br/>
No. 52 Ilaya Proper <br/>
Pasong Buaya<br/>
Imus, Cavite 4103<br/> 
Philippines, <br/>
</p>
<p>or you can telephone us on +63-921-359-6363.</p>





<?php require_once("footer.ini.php");

function contact_temp()
{
return '<table borderColor="#ffffff" cellSpacing="0" cellPadding="4" width="92%" align="center"   border="1" >    
    <tr>
      <td width="25%"><font face="Verdana" size="2">Date</font></td>
      <td width="75%"><font face="Verdana" size="2">%today%</font></td>
    </tr>
    <tr>
      <td width="25%"><font face="Verdana" size="2">Send to</font></td>
      <td width="75%"><font face="Verdana" size="2">%sendto%</font></td>
    </tr>
    <tr>
      <td width="25%"><font face="Verdana" size="2">From</font></td>
      <td width="75%"><font face="Verdana" size="2">%full_name%</font></td>
    </tr>
    <tr>
      <td width="25%"><font face="Verdana" size="2">Email</font></td>
      <td width="75%">
      <font face="Verdana" size="2">%email%</font></td>
    </tr>

    <tr>
      <td width="25%"><font face="Verdana" size="2">IP Address</font></td>
      <td width="75%">
      <font face="Verdana" size="2">%IP%</font></td>
    </tr>
	<tr>
      <td colspan="2" valign="top"><font face="Verdana" size="2">
     %comments%</font></td>
    </tr>

  </table>' ; 

}



function contact_txt()
{
return "Date :   %today%

From : %full_name%  

Email: %email%

Telephone: %telephone% 

Message:%comments% " ; 
}





function show_form()
{
	global $publickey, $error;

echo '<form method="POST" action="contactus.php" onSubmit="return validateForm(this,0,0,0,0);" onFocusOut="clearStyle(event.srcElement);">
		<INPUT TYPE="hidden" name="send" value="send">
	  
	  
		<table border="0" cellpadding="5" cellspacing="4" width="80%" style="margin:20px auto 0 auto;background:#f4f4f4;border:1px solid #ccc;">
			<tr>
				<td width="20%" style="font-size:12px;">Send to:</td>
				<td width="80%">

        <select name="sendto" style="border:1px solid #ccc;width:70%;padding:5px;">
          <option value="admin@soccer-predictions.com">admin@soccer-predictions.com</option>
          
        </select>
				
			</tr>
			<tr>
				<td width="20%" style="font-size:12px;">Name:</td>
				<td width="80%"><input type="text" name="full_name" style="width:66%;border:1px solid #ccc;padding:5px;color:#000;" alt=length|4 emsg="Please enter your name">
			</tr>
			<tr>
				<td style="font-size:12px;">Email:</td>
				<td><input type="text" name="email" style="width:66%;border:1px solid #ccc;padding:5px;color:#000;" alt=email emsg="Please enter your email address">
				</td>
       </tr>
      
       <tr>
				<td valign="top" colspan="2" style="font-size:12px;">
				Message: <br />
				<textarea rows="9" name="remarks" style="width:97%;border:1px solid #ccc;font-size:12px;padding:5px;font-weight:bold;" alt=length|10 emsg="Please enter your message."></textarea></td>
			</tr>
			
			<tr>
				<td height="20" colspan="2">
				<div align="center" style="padding-top:0px;">
					<input type="submit" value="Submit" name="submit" class="bt" style="padding:5px 20px;">
				</div>
				</td>
			</tr>
		</table>
	
</form> ' ;



}

// Generate Random Code of 6 charachters
function makeRandomCode() { 
  $salt = "ABCHEFGHJKMNPQRSTUVWXYZ23456789"; 
  srand((double)microtime()*1000000);  
      $i = 0; 
      while ($i < 6) { 
            $num = rand() % 33; 
            $tmp = substr($salt, $num, 1); 
            $pass = $pass . $tmp; 
            $i++; 
      } 
      return $pass; 
} 

function send_email($email_to,$from_mail,$message,$subject)
{
   $headers  = "MIME-Version: 1.0\r\n";
	 $headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
	 $headers .= "From: $from_mail  \n";
	 $headers .= "Return-path: $from_mail  \n";
	 $headers .= "Reply-To: $from_mail \n";
     $send =  mail($email_to, $subject, $message, $headers);
	 return $send;

}


?>