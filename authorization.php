<?php

session_start();

if (!isset($_SESSION['userid'])){
	header('Location: loginfree.php');
	exit;
}


									 // check the date here...
if ( isset($_SESSION['userid']) and $_SESSION['validupto'] < date('d-m-Y') ){
	$errlog = "Expired." ;
	
	include("header.ini.php");
	echo "<div style='margin-left:55px;margin-right:55px;margin-top:110px;padding:10px;border:1px solid #FFAAAA;background:#FFF4F4;font-size:14px;font-family:tahoma;font-weight:bold;text-align:center;'>";
	echo "$errlog</div>\n";
	include("footer.ini.php");
	exit;

}elseif ( isset($_SESSION['userid']) and $_SESSION['expire']>=$_SESSION['cur_week'] ){
	// do nothing
}else{
	//header("location: notauthorize.php");
	exit;
}


?>