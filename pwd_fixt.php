<?php

/**
 * @author IM Khan
 * @copyright 2013
 */


include("config.ini.php");

$sql = "select uid,userid,email,pwd from userlist02";




$temp = $eu->prepare($sql) ;
$temp->execute();

echo $temp->rowCount();

while ($d = $temp->fetch()){
 
    $user_id = $d['userid'];
    $pwd_new = $d['pwd'];
    $email   = $d['email'];
    
        
    $sql1 = "update userlist set pwd = '$pwd_new' where userid='$user_id' and email='$email'";
    
     
    $d2 = $eu->prepare($sql1);
    $d2->execute();
    
     
}





?>