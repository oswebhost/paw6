<?php
session_start();

if (!$_SESSION['ref']){
	$_SESSION['ref'] = 'PaW';
}else{
	$_SESSION['ref']= $_GET['ref'];
}

if (isset($_SESSION['userid'])){
	include("subscribe-old.php");
}else{
	include("subscribe-new2.php");

}
exit();
?>



<div style="line-height:150%;font-size:14px;padding:20px 0; margin:50px auto 0 auto; border:1px solid #FF5353; text-align:center; background:#FFEAEA;">

<h2 style="padding:0;margin:0;font-size:1.3em;color:black;font-weight:normal;font-family:verdana;">
    We will not be accepting subscriptions until<br>mid-September 2010.<br><br>
	Although we aren't charging for our services just yet,<br>
	please register with us now so that we can notify you by<br>
	email when we have everything ready to go. 
</h2>

</div>

<div class="reg_botton">
  <a title='Register Now' href="register-aweber.php">
    <img src='images/joinnow2.png' border='0' alt='Join Now'></a>
</div>

<?

include("footer.ini.php");


?>