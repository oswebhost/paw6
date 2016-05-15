<?php

error_reporting(0);

#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-Win.com/us/co.uk  ##
############################################################

$hostname = "localhost" ;
$dbase    = "paw0910";
$username = "root";
$password = "root";

$hostname2 = "localhost" ;
$dbase2    = "sa_1011";
$username2 = "root";
$password2 = "root";

/*
$hostname3 = "localhost";
$dbase3    = "soccer_predictions";
$username3 = "root";
$password3 = "";
*/

/*
$hostname = "pawimran_7819337t" ;
$dbase    = "pawimran_paw1011";
$username = "pawimran_7819337";
$password = "cq8?}z(-AL_W";


$hostname2 = "pawimran_7819337" ;
$dbase2    = "pawimran_sa1011";
$username2 = "pawimran_7819337";
$password2 = "cq8?}z(-AL_W";

*/

$domain = "http://soccer-predictions.com" ;

$domain ="http://localhost/paw6" ;

try
{
   $eu  = new PDO("mysql:host=$hostname;dbname=$dbase", $username, $password); // European databse
   $eu->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

   $sa  = new PDO("mysql:host=$hostname2;dbname=$dbase2", $username2, $password2); // american database
   $eu->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    
}
catch (PDOException $e)
{
    echo $e->getMessage();
}


/*
define("SERVER",$hostname,TRUE);
define("USERID",$username,TRUE);
define("PWD",$password,TRUE);
define("DATABASE",$dbase,TRUE);

$link = mysql_connect(SERVER, USERID, PWD)or die( mysql_error() ); 
mysql_select_db(DATABASE) or die( mysql_error() ); 





$eu  = new PDO("mysql:host=$hostname;dbname=$dbase", $username, $password); // European databse
$sa  = new PDO("mysql:host=$hostname2;dbname=$dbase2", $username2, $password2); // american database
//$sp  = new PDO("mysql:host=$hostname3;dbname=$dbase3", $username3, $password3); // betting advice database
*/



define("EVENROW","#DDEAF4",TRUE);
define("ODDROW","#EFF5FA",TRUE);

$W_P=3;
$D_P=1;

$java_ = 0;
$show_key = 0;
$desc = 0  ;
$mmm = 0 ;

$picpath="http://www.predictawin.com/pic/";
$path = dirname(__FILE__);



?>