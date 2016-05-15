<? //session_start();
$stripImages = "yes"; 
$stripHref   = "yes"; //yes/no

//$baseURL="http://localhost/final/" ; 
$baseURL="http://predictawin.com/"; 
$refpage1 = (phpversion() > "4.1.0") ? $_SERVER[HTTP_REFERER] : $HTTP_SERVER_VARS[HTTP_REFERER];

//$refpage1 = "review.php" ;

$refpage = $baseURL . $refpage1 ;//;. "&ACTION=PRINT";
$startingpoint = "<!-- startprint -->";
$endingpoint = "<!-- stopprint -->";
error_reporting(0);
//$read = fopen($refpage, "rb") ... may work better if you're using NT and images
$read = fopen($refpage, "rb") or die ("Can not open file............");
//error_reporting(0);

$value = "";
while(!feof($read)){
     $value .= fread($read, 16000); 
}
fclose($read);
$start= strpos($value, "$startingpoint"); 
$finish= strpos($value, "$endingpoint"); 
$length= $finish-$start;
$value=substr($value, $start, $length);
$value = ereg_replace("100%","60%",$value);

function i_denude($variable)
{
return(eregi_replace("<img [^>]*>", "", $variable));
}
//<img src=[^>]*>

function i_denudef($variable)
{
return(eregi_replace("<font[^>]*>", "", $variable));
}

function i_href($variable)
{
return(eregi_replace("<a [^>]*>", "", $variable));
}

$PHPrint = ("$value"); 

if ($stripImages == "yes") {
$PHPrint = i_denude("$PHPrint");
}
if ($stripHref == "yes") {
$PHPrint = i_Href("$PHPrint");
}

$PHPrint = i_denudef("$PHPrint");
$PHPrint = eregi_replace( "</font>", "", $PHPrint );
$PHPrint = stripslashes("$PHPrint"); 

// 
echo "<html><head>";
echo '<link rel="stylesheet" type="text/css" href="style.css">';
echo '<title>Print</title>';
echo "</head><body>";
echo '<div align=center>';
echo '<IMG SRC="images/paweuro.gif" BORDER=0 ALT="">';
echo "<br>";
for ($i=0; $i<=100; $i++):
	echo "=";
endfor;
echo "</div> ";
echo "<br><B><FONT SIZE=3 face=Arial>$msg</FONT></B>";
echo "<br><p>$PHPrint</p>";

echo '<div align=center>' ;
for ($i=0; $i<=140; $i++):
	echo "-";
endfor;

echo '<font face="arial" size="1"><b>'; 

echo '<BR>Copyright&nbsp;&copy; BetWare Ltd (Hong Kong)<br>';
echo "http://www.Predict-a-Win.com<BR>File:$refpage<BR>";
echo "Date: " . date("d-M-Y"). "</font></b>";
echo "</div></div></body></html>";
?>