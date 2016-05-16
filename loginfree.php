<?php

require_once("reguser.php"); $logerr='';

$ACTION= $_POST["ACTION"];

if ($ACTION=="Login"){
	
	$userid= $_POST["userid"] ;
	$pwd   = $_POST["pwdcode"] ;



	if (strlen($userid)<=0){
		$logerr='User Id required.';
	}
	
	if (strlen($pwd)<=0){
      $logerr .='Password required.'  ;
	}
	
	if (find_confirm($userid,$pwd,1)=="N"){
	      $logerr .= 'Account not active.'  ;
	}

	if (find_confirm($userid,$pwd,1)=="NO"){
	      $logerr .= 'Account not active. User Id/Password not found. '  ;
	}

	if (find_user($userid,$pwd,1)=="NO"){
		$logerr= 'User Id/Password not found. Please try again.';
	}
	
	
	if (strlen($logerr)==0){
		session_start();	
		start_session($userid,1); 
		  require_once("userinfo.php");
		exit;
 	}

} elseif ($ACTION=="Reset"){
	
	if (strlen($_POST['email'])<=0){
		$logerr ='Email address required';
	}
	
	if (chg_pwd_email($_POST['email'])=="NO"){
		$logerr='Email address not found. Please try again.';
	
	}else{
  	  $logerr='Your Password details have been sent to your email address.';
	}
    
}

$page_title ="Login";

require_once("function.ini.php");
require_once("header.ini.php");

?>
<?php page_header("Subscribing Member's Log In"); ?>

<div class='hypebox'  style='width:582px;margin:0px auto 0 auto;'>
  <div class='div_top520'></div>
    <div class='div_mid520' style="line-height: 140%;">
	
	<div class='spacer'></div>
    
    <div style="padding-top:0px;padding-left:20px; padding-right:20px;text-align:justify;font-size:14px;">
    
		If you are not a Subscribing Member you will not be able to log in to see the current week's predictions. If you wish to become a Subscribing Member then you will need to <a class='bb' href='register.php'>register with us first</a> before you can pay. After registering, you must then log in with your User Id and Password before you can subscribe.
    </div>

<div class='spacer'></div>

	</div>
    <div class='div_bottom520'></div>
</div>
<div style='margin-top:10px;'></div>



<BR>
<?php 
	
	if (strlen($logerr)>0){
		echo "<div style='margin-left:30px;margin-right:30px;margin-bottom:10px;padding:10px;border:1px solid #FFAAAA;background:#FFF4F4;font-size:12px;font-family:tahoma;font-weight:bold;text-align:center;'>";
		echo $logerr;
		echo "</div>";
	}
?>




<form method="POST" action="loginfree.php" name="myform">
					
	<table width="400" cellpadding="1" cellspacing="0" style='border:1px solid #006404;margin:auto auto;background:#f1f1f1;'>
	 <tr>
	 	<td bgcolor="#006404" colspan='2' style='padding:5px 4px;'><div style='float:left;width:5px;background:#F4C300;margin-right:6px;'>&nbsp;</div>
	 		<font color="#FFFFFF"><b>Subscribing Member's Log In</b></font>
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

<?php require_once("footer.ini.php"); ?>