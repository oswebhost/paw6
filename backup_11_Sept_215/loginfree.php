<?php

include("reguser.php");
$logerr='';

$ACTION= $_POST["ACTION"];

if ($ACTION=="Login"):
	
	$userid= $_POST["userid"] ;
	$pwd   = $_POST["pwdcode"] ;



	if (strlen($userid)<=0):
		$logerr='User Id required.';
	endif;
	if (strlen($pwd)<=0):
      $logerr .='Password required.'  ;
	endif;
	
	
	if (find_confirm($userid,$pwd,1)=="N"):
	      $logerr .= 'Account not active.'  ;
	endif;
	if (find_confirm($userid,$pwd,1)=="NO"):
	      $logerr .= 'Account not active.'  ;
	endif;

	if (find_user($userid,$pwd,1)=="NO"):
		$logerr= 'User Id/Password not found. Please try again.';
	endif;
	
	if (strlen($logerr)==0):
		session_start();	
		start_session($userid,1); 
		  include("userinfo.php");
		exit;
 endif;

elseif ($ACTION=="Reset"):
	if (strlen($email)<=0):
		$logerr ='Email address required';
	endif;
	if (chg_pwd_email($email)=="NO"):
		$logerr='Email address not found. Please try again.';
	else:
  	  $logerr='Your Password details have been sent to your email address.';
    endif;
endif;

$page_title ="Login";

include("function.ini.php");
include("header.ini.php");

?>



<? page_header("Log In"); ?>
<BR>
<? if (strlen($logerr)>0) :
		echo "<div style='margin-left:30px;margin-right:30px;margin-bottom:10px;padding:10px;border:1px solid #FFAAAA;background:#FFF4F4;font-size:12px;font-family:tahoma;font-weight:bold;text-align:center;'>";
		echo $logerr;
		echo "</div>";
	endif;
?>




<form method="POST" action="loginfree.php" name="myform">
					
	<table width="400" cellpadding="1" cellspacing="0" style='border:1px solid #006404;margin:auto auto;background:#f1f1f1;'>
	 <tr>
	 	<td bgcolor="#006404" colspan='2' style='padding:5px 4px;'><div style='float:left;width:5px;background:#F4C300;margin-right:6px;'>&nbsp;</div>
	 		<font color="#FFFFFF"><b>Member's Log In</b></font>
	 	</td>
	 </tr>	
	 <tr>
		<td width="120" class='rtd' style='padding-top:10px;'> User Id:</td>
		<td style='padding-top:10px;'><input type="text" name="userid" class="logtxt" style="border: 1px solid #999; width:160px;padding:4px;" />
			<input type="hidden" name="ACTION" value="Login" />
		</td>
	 </tr>
	 <tr>
		<td align='right'>Password:</td>
		<td>
			<input type="password" name="pwdcode" class="pwd" style="border: 1px solid #999; width:160px;padding:4px;" />
		</td>
	 </tr>

	<tr>
	<td colspan='2' class='ctd' style='padding-bottom:10px;'>
	  <p style='line-height:120%;text-align:left;padding-top:13px;padding-bottom:20px;font-size:10px;'>By logging in with us you shall be deemed to have read, understood and accepted the terms of our <a class='sbar' href='privacy.php'>Privacy Policy</a>, as well as all the other terms and conditions specified on this website.</p>
		<input type="submit" value="Login" class='greenbt' />
	</td>
	</tr>
	</table>
		
</form>


<script type="text/javascript">
 document.myform.userid.focus();
</script>


<br/>

<div style='margin:auto auto;width:380px;padding:10px;border:1px solid #FFAAAA;background:#FFF4F4;font-size:12px;font-family:tahoma;font-weight:bold;text-align:center;'>
<b>NOT REGISTERED?</b> <br/><br/>You cannot log in if you are not a Registered member.<br><br><a href='register.php' class='prv'>Click here</a> to Register Now!

</div>


<br/>

<table width="400" cellpadding="1" cellspacing="0" style='border:1px solid #006404;margin:auto auto;background:#f1f1f1;'>
<tr>
 	<td bgcolor="#006404" colspan='2' style='padding:5px 4px;'><div style='float:left;width:5px;background:#F4C300;margin-right:6px;'>&nbsp;</div>
 		<font color="#FFFFFF"><b>Password/User Id Lost?</b></font>
 	</td>
</tr>	

<tr>
	<td style='padding-bottom:10px;'>
	  	<p class='policy'>Have you lost your Password or User Id? If so, please insert your email address below and click on &quot;submit&quot;.
	  	<br /><br />
	  	Please use the same email address you previously registered with us.<br />

		<form method="POST" action="loginfree.php">
			<input type="hidden" name="ACTION" value="Reset">
			<p style="text-align: center">
			<b>Email Address:</b><br/>
				<input type="text" name="email" size="38" class="logtxt" style="border: 1px solid #999; width:300px;padding:4px;" /><br/>
			<br>
			<input type="submit" value="Submit"  class='greenbt' />
		</form>
	</td>
</tr>

</table>

<? include("footer.ini.php"); ?>