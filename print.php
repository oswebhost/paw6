<?php


ob_flush();
ob_clean();
session_start();
//print_r($_SESSION);

$strCookie = 'PHPSESSID=' .session_id();
 
session_write_close();

// Initialize the cURL session
$ch = curl_init();

//* Set the URL of the page or file to download.

//echo $_SERVER[HTTP_REFERER]; 


curl_setopt($ch, CURLOPT_URL,$_SERVER[HTTP_REFERER]);

//* Ask cURL to return the contents in a variable  instead of simply echoing them to the browser.


curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt( $ch, CURLOPT_COOKIE, $strCookie ); 

// Execute the cURL session

$contents = curl_exec ($ch);

//echo $contents;

//  Close cURL session
curl_close ($ch);



if (isset($img)): $stripImages = $img; else: $stripImages = "no"; endif; //yes/no
$stripHref   = "yes"; //yes/no

$value = $contents ;

$startingpoint = "<!-- startprint -->";
$endingpoint = "<!-- stopprint -->";

//echo $value;


//echo $refpage ;

//$value = file_get_contents($refpage); 




$start= strpos($value, "$startingpoint"); 
$finish= strpos($value, "$endingpoint"); 
$length= $finish-$start;
$value=substr($value, $start, $length);
$value = preg_replace("/100%/","60%",$value);

//echo $value;


function i_denude($variable)
{
	return(preg_replace("/<img(?!).*$/", "", $variable));
}

function i_denudef($variable)
{
	return(preg_replace("/<font[^>]*>/", "", $variable));
}


function i_href($variable)
{
    return(preg_replace("/<a [^>]*>/", "", $variable));
}


$PHPrint = ("$value"); 

if ($stripImages == "yes") {
	$PHPrint = i_denude("$PHPrint");
}
if ($stripHref == "yes") {
	$PHPrint = i_href("$PHPrint");
}

$PHPrint = preg_replace("/display: none;/", "display:block", $PHPrint);

$PHPrint = stripslashes("$PHPrint"); 

?>

<html>

	<head>
		<link rel="stylesheet" type="text/css" href="css/style_v4.css" />
	</head>


<!-- onload="window.print();" -->

<body onload="window.print();">
<center>
<div style="width:850px;margin:auto auto;text-align:center;" >

	<h1>Soccer Predictions</h1>
	
	  <h3 style="text-align:center;border-bottom:0px solid;color:bule;font-size:15px;">
			<?php echo $msg ; ?>
	  </h3>
		
	<?php echo $PHPrint; ?> 
</div>

<br/><br/>

<div align="center">
	<font face="verdana" size="1">
	&copy; Soccer-Predictions.com - A Great Place For Soccer Predictions<br /> 
	Printed on: <? echo date("d-M-Y H:s A") ?> </font>
	<br />
	<br />
	<br />
	
	<a class="blue" href="javascript:close()">Close this window</a> <br />
</div>



</body>
</html>