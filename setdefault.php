<?php
	session_start();
	
	$db = $_GET['db'];
	$url = $_GET['file']. "?db=$db";
	
	
	
	
	$_SESSION['db'] = $db;
	
	header("location: $url");
	

?>