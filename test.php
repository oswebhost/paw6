<?php
include("config.ini.php");

$filename = "tmp_" . time() ;
$xx = "CREATE TABLE " . $filename . "(rid int, u_name varchar(20))";
    
$temp = $eu->prepare($xx) ;
$xx = $temp->execute();

echo "$xx $filname";
?>