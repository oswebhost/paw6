<?php
include("config.ini.php");

if(isset($_GET["q"]) && $_GET["q"] != ''){
	$q=$_GET["q"];
	$temp = $eu->prepare("select * from userlist where userid='$q'");
    $temp->execute();
	if($temp->rowCount()){
		$output = "Userid existing. Please try another ID. ";
	}
	
}
else if(isset($_GET["email"]) && $_GET["email"] != ''){
	$q=$_GET["email"];
	$temp = $eu->prepare("select * from userlist where email='$q'");
	$temp->execute();
	if($temp->rowCount()){
		$output = "Email is used by another User. ";
	}
}
echo $output;
?>