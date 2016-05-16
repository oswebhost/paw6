<?php

session_start();
include("config.ini.php");
include("reguser.php");
include("function.ini.php");

$page_title = "Change Passwrod";

include("header.ini.php");

$emailerr ="";

if ($_POST['ACTION']=="ChgPassword"){
 
    if (strlen($_POST['pwd'])<=0){
		$emailerr ='<b><FONT COLOR="#FF3300">Error:&nbsp;</font><br>Password Require.</b>';
    
    }elseif (strlen($_POST['pwd'])<6 or strlen($_POST['pwd'])>12){
		$emailerr ='<b><FONT COLOR="#FF3300">Error:&nbsp;</font><br><font size="1">Password must be 6-12 Character long.</font></b>';
    
    }else{
		// Change Password here...
		 $ok=chg_pwd_by_user($_SESSION["userid"],$_POST['pwd']);

		if ($ok=="YES"){
			 $emailerr='<b><FONT COLOR="#FF3300">Status:&nbsp;</font><br>Password reset successfully.</b>';
		}else{
			 $emailerr='<b><FONT COLOR="#FF3300">Error:&nbsp;</font><br>Cannot reset Password.</b>';
		}
	}
}


 page_header("Change Password") ; 
 
 ?>


<center>
<?php 
	if (strlen($emailerr)>10){

		echo "<div class='errordiv' style='text-align:center;width:350px;'>$emailerr</div>";
	}
?>
<BR>&nbsp;<BR>&nbsp;<BR>
<table border="0" width="60%"  style="border:1px solid #F4C300;" bgcolor="#F6F6F6" cellspacing="1" cellpadding="5">
<tr>
  <td width="100%" align="center" height="30"><BR>
  <form method="POST" action="<?php echo $PHP_SELF?>">
	<INPUT TYPE="hidden" name='ACTION' value='ChgPassword'>
	<b>Change Password:<br>
	</b>
	<input type="password" name="pwd" size="30" maxlength="12" class="logtxt">
	<br><BR>
	<input type="submit" value="Submit" class='bt' style="padding:5px 20px;border:1px solid #ccc;">
 
  </td> </form>
</tr>
</table>


</center>
	
<div style='padding-left:10px;'>
	<a href='userinfo.php' class='sbar'>« Back</a>
</div>
<BR>

<?php
	include("footer.ini.php");
?>

