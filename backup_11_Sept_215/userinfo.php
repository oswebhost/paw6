<?	session_start();   

if (!isset($_SESSION['userid']) ) :
		header("location: authorization.php");
       //$weekno=$lastweek-1;
endif;

    $page_title="My Account Details";

	global $logout;
	$logout = '<a class="rm" href="logout.php">»Logout</a>';
	
	include("config.ini.php");




 // include("reguser.php");
include("function.ini.php");
include("header.ini.php");




page_header("My Account Details") ;



?>


<center>
<BR>

<table border="0" width="80%" cellspacing="0" cellpadding="5" bgcolor="#F1F1F1" 
style="border:1px solid #F4C300;">
<tr>
	<td colspan='2' style="background:#F4C300;" class="credit"><span class=credit>Welcome</span></td>
</tr>

<tr>
<td width="70%" align="left" height="130" valign='top'  class="credit">
Hi <b><font color="#0000FF"><? echo ucwords($userid) ; ?></font><br><br>
</b>Welcome to <b><font color="#0000FF">Soccer Predictions</font><br></b>
<br>
<table width="100%" border='0' cellpadding='5'>

<tr>
	<td align='right' width='200'  class="credit"> No of Logins: </td>
	<td  class="credit" width='200'> <b><? echo $_SESSION["logcount"] ?></b> </td>
</tr>

<tr>
	<td align='right'  class="credit"> Member Since: </td>
	<td  class="credit"> <b><? echo $_SESSION["date_reg"] ?></b> </td>
</tr>
				
<!--
<tr>
	<td align='right'> Valid up to: </td>
	<td > <b><? echo $_SESSION["validupto"] ?></b> </td>
</tr>
-->


</table>
</td>
</tr>
</table>

<br />


<br />

<div style='text-align:center;width:450px; margin:auto auto;border:1px solid #23488C;background:#E9EFFF;padding:5px;font-size:13px;padding:10px 0'>
	   <a class='sales' href='get8rules.php'><b>8 GOLDEN RULES for SUCCESSFUL SOCCER BETTING</b></a> <br/>
</div>

<br />

<table cellspacing='0' width='460' border='0' cellpadding='10' style="border:2px solid #f4c300;background:#666;">
<tr>
<!--
	<td  width='30%' >
			<a class="toplink"  href="historypayment.php"><span class='credit'>Payment History</span></a>
	</td>
-->
	<td  width='30%' >
		<a class='toplink' href="http://www.freetellafriend.com/tell/" onclick="window.open('http://www.freetellafriend.com/tell/?option=manual&title='+encodeuricomponent(document.title)+'&url='+encodeuricomponent('predictawin.com'), 'freetellafriend', 'scrollbars=1,menubar=0,width=617,height=530,resizable=1,toolbar=0,location=0,status=0,screenx=210,screeny=100,left=210,top=100'); return false;" title="tell a friend" target="_blank"><span class='credit'>Tell-A-Friend</span></a>
	</td>

	<td  width='36%' align='center' >
		<a class='toplink' href="changepassword.php"><span class='credit'>Change Password</span></a>
	</td>
</tr>
</table>




<br /><br />

<div class='error_div' style='width:150px;'><a class="sbar" href="logout.php">*** L o g o u t  ***</a></div>
<br />




</center>

<? include("footer.ini.php"); ?>