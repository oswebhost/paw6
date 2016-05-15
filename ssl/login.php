<?



//include("config.ini.php");
include("reguser.php");
$logerr='';

$ACTION= $_POST["ACTION"];

if ($ACTION=="Login"):
	
	$userid= $_POST["userid"] ;
	$pwd   = $_POST["pwd"] ;

	
	if (strlen($userid)<=0):
		$logerr='User Id required.';
	endif;
	if (strlen($pwd)<=0):
      $logerr .='Password required.'  ;
	endif;
	
	if (find_confirm($userid,$pwd)=="N"):
	      $logerr .= 'Account not active.'  ;
	endif;
	if (find_confirm($userid,$pwd)=="NO"):
	      $logerr .= 'Account not active.'  ;
	endif;

	if (find_user($userid,$pwd)=="NO"):
		$logerr= 'User Id/Password not found. Please try again.';
	endif;
	
	if (strlen($logerr)==0):
		session_start();	
		start_session($userid); 
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


<table border="0" width="400" cellpadding="1" cellspacing="0" align='center' >
			<tr>
			  <td bgcolor="#006404" height="20">
			 
			  
			  
			  <table width='100%' border='0' cellpadding='0' > <tr><td width='5' bgcolor='#F4C300'>
			  
			  </td><td width='380'>&nbsp;
				<font color="#FFFFFF"><b>Member's Log In</b></font>
			 </td></tr>
			 </table>

				</td>
			</tr>
			<tr>
			  <td height="13" bgcolor="#006404" colspan="3" rowspan="3">
			  <table border="0" width="100%" cellspacing="0" cellpadding="3" bgcolor="#F1F1F1">
				<tr>
				  <td width="100%" align="center">
				  <form method="POST" action="login.php" name="myform">
					 <br />
					 <table>
					 <tr>
						<td width="70" align='right'> User Id:</td>
						<td><input type="text" name="userid" size="22" class="logtxt" style="border: 1px solid #999; width:160px;padding:2px;" />
							<input type="hidden" name="ACTION" value="Login" />
						</td>
					 </tr>
					 <tr>
						<td align='right'>Password:</td>
						<td><input type="password" name="pwd" size="27" class="pwd" style="border: 1px solid #999; width:160px;padding:2px;" /></td>
					 </tr>
					 </table>
				   
				      <p style='line-height:100%;text-align:left;padding-top:13px;'><font size='1'>By logging in with us you shall be deemed to have read, understood and accepted the terms of our <a class='sbar' href='privacy.php'>Privacy Policy</a>, as well as all the other terms and conditions specified on this website. </font></p>


					 <br />
					<input type="submit" value="Login" style="width:80px;background:#26529B;color:#fff;border:0;padding:5px;margin-bottom:16px;">
					
				  </form>
				  <script type="text/javascript">
					 document.myform.userid.focus();
				   </script>

				  </td>
				</tr>
  </table>

</td></tr></table>	
<br/>

<div style='margin:auto auto;width:380px;padding:10px;border:1px solid #006404;background:#006404;font-size:12px;font-family:tahoma;font-weight:bold;text-align:center;'>
<b>NOT SUBSCRIBED?</b> <br/><br/>You cannot log in if you are not a subscribing member.<br><br><a href='subscribe.php' class='prv'>Click here</a> to join now.

</div>

<br/>
<table border="0" width="400" cellpadding="1" cellspacing="0" align='center' >
                        <tr>
                          <td bgcolor="#006404" height="20">

<table border="0" width="400" cellpadding="0" cellspacing="0"  align='center'>
                        <tr>
                          <td bgcolor="#006404" height="20">
						  <table width='100%' colspan='3' border='0' cellpadding='0' > <tr><td width='5' bgcolor='#F4C300'>
						  
						  </td><td width='380'>&nbsp;
							<font color="#FFFFFF"><b>Password/User Id Lost?</b></font>
						 </td></tr>
						 </table>
			
							</td>
                        </tr>
                        <tr>
                          <td height="13" bgcolor="#F4C300" colspan="3" rowspan="3">
							  <table border="0" width="100%" id="AutoNumber5" cellpadding="2" bgcolor="#F1F1F1">
								<tr>
								  <td width="100%" colspan="3" rowspan="3" align="left">
								  <p class=policy>Have you lost your Password or User Id? If so, 
								  please insert your email address below and click 
								  on &quot;submit&quot;.<br>
								  <br>
								  Please use the same email address you previously 
								  registered with us.<br>
						 <form method="POST" action="login.php">
						 <INPUT TYPE="hidden" name="ACTION" value="Reset">
					 <p style="text-align: center">
					  <b>Email Address:</b><input type="text" name="email" size="38" class="logtxt" style="border: 1px solid #999; width:300px;padding:2px;" /><br/>
					  <br>
					  <input type="submit" value="Submit"  style="width:80px;background:#006404;color:#fff;border:0;padding:5px;margin-bottom:16px;">
					</form>
								  </td>
								</tr>
				  </table>
		</td></tr></table>
</td></tr></table>	

<? include("footer.ini.php"); ?>
