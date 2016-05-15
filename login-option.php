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



$page_title ="Login Option";

include("function.ini.php");
include("header.ini.php");

?>



<? page_header("Log In Option"); ?>
<BR>



					
<table width="400" cellpadding="1" cellspacing="0" style='border:0px solid #006404;margin:auto auto;background:#fff;'>
 <tr>
	<td class='ctd' style='padding-top:10px;'>

		
	<div style='padding:13px 0px;text-align:center;'>
		<a class='md' href='loginfree.php'><img src='images/freelogin.gif' border='0' alt='' /></a>
	</div>

		<br/>
		<br/>
		<br/>
	<div style='padding:13px 0px;text-align:center;'>
		<a class='md' href='login.php'><img src='images/memlogin.gif' border='0' alt=''/></a>
	</div>

	</td>
	
 </tr>
</table>
		


<script type="text/javascript">
 document.myform.userid.focus();
</script>


<br/>
<br/>
<br/>

<div style='margin:auto auto;width:380px;padding:10px;border:1px solid #FFAAAA;background:#FFF4F4;font-size:12px;font-weight:bold;text-align:center;'>
<span class='credit bb'>NOT A MEMBER YET?</span> <br/><br/>
 

 <form method='post' action='login-option.php'>

 	<div style='margin:auto auto;width:320px;text-align:left;'>
 		I wish to become: <br /><br />
 		<input type='radio' name='gowhere' value='1' /><span class='credit'>a Registered Member (non-paying)</span> <br /><br />
 		<input type='radio' name='gowhere' value='2' /><span class='credit'> a Subscribing Member (paying)</span> <br /><br />
 	</div>
	<input type='submit' value='Submit' class='greenbt'/>

 </form>

</div>

<? include("footer.ini.php"); ?>
