<?php

if ($_POST['gowhere']==2){
	header("location: subscribe.php");
	exit;
}elseif ($_POST['gowhere']==1) {
	header("location: register.php");
	exit;
}

include("reguser.php");

$logerr='';



$page_title ="Join Us Option";

include("function.ini.php");
include("header.ini.php");

?>



<? page_header("Join Us Option"); ?>
<BR>

<div style='text-align:center;width:490px; margin:auto auto;border:1px solid #006600;background:#F7FFE6;padding:5px;font-size:13px;line-height:140%'>

		Every New Member (whether a Registered or Susbcribing Member) will be given access to our updated version of "<b>8 GOLDEN RULES for
		SUCCESSFUL SOCCER BETTING</b>", which will be available for downloading immediately after joining.  
</div>

<br/>
<div style='margin:auto auto;width:480px;padding:10px;border:1px solid #2E61BC;background:#EFF3FF;font-size:14px;font-weight:bold;text-align:center;'>

 <form method='post' action='login-option.php'>

 	<div style='margin:auto auto;width:480px;text-align:left;'>
 		I wish to join as: <br /><br />
 		<input type='radio' name='gowhere' value='1' /><span class='credit'>Registered Member Only</span>
 			<div style='padding-left:80px;padding-bottom:20px;font-weight:normal;'>(non-paying, limited access)</div>


  		<input type='radio' name='gowhere' value='2' /><span class='credit'>Subscribing Member</span><br>
 			<div style='padding-left:80px;padding-bottom:20px;font-weight:normal;'>(paying - with unrestricted access <span class='bluei'>for less than 
 				&pound;1 per week</span>)</div>
 	</div>
	<input type='submit' value='Submit' class='bt'/>

 </form>

</div>

<? include("footer.ini.php"); ?>

