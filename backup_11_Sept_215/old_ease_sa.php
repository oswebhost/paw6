<?php
include("config.ini.php");
include("function.ini.php");

$sea = curseason('sa');
$id = $_GET["id"] ;

$errlog = "You will only be able to see the current week's data (the topmost file) if you are <B><font color='blue'>logged in</font></B>.<br><B>To be able to <B>log in</B> you must be a fully subscribed member</B>.";


?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
"http://www.w3.org/TR/html4/loose.dtd"> 


<html>

<head>

<link rel="shortcut icon" href="images/betware.ico" />
<meta http-equiv="Content-Language" content="en-us" />
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<meta name="title" content="Soccer Predictions" />
<link rel="stylesheet" type="text/css" href="css/style_v4.css" media="screen" />

<title>Blank "EASE" Spreadsheet</title>

</head>
<body>
<? page_header("Blank \"EASE\" Spreadsheet") ; ?>

<div class="report_blue_heading" style="width: 530px;margin:0 auto 5px auto;"><?echo site('sa');?></div>

<div class='errordiv' style='width:520px;margin:auto auto;text-align:center;border:1px solid #004E9B;'><?php echo $errlog; ?></div>

<p style="color: red;padding-left:88px;padding-right:88px;">
If you are not a fully subscribed member and the season is still ongoing, 
then you will only be able to download those files you see beneath the topmost file.  
After the season has been concluded you will be able to download the topmost file also.  
</p>
 
<div style="padding-bottom:10px"></div>

<table border="0" cellpadding="4" cellspacing="0" style="border-collapse: collapse;margin:auto auto" bordercolor="#004E9B" width="55%" >

<?
$dir =  "./ease/sa/";
$dir_handle = opendir($dir) or die("Unable to open $path");    // Loop through the files    

while ($file = readdir($dir_handle)) 
{  
	if($file == "." || $file == ".." || $file =='index.html' || $file =='signup_log.txt')       
		continue;      
	 $x++; 
	$_file = $dir . $file ;
	$_type = substr($_file,strlen($_file)-3);
	
	if   (filetype($_file) != "dir"  && $_type == "zip" ) :
		$files[] = $_file;
	endif;
}    
// Close    
closedir($dir_handle);

rsort($files);

for ($i=0; $i<count($files); $i++){
	if ($i==0){ // his should be 0 zero in ongoing season.
		echo "<tr>\n<td ><a class='sbar' href='#' onClick=\"alert('You must be logged in if you wish to download the current week\'s file.');return false\">".  substr($files[$i],6) . "</a></td>\n</tr>\n";
	}else{
		echo "<tr>\n<td ><a class='sbar' href=\"$files[$i]\">".  substr($files[$i],6) . "</a></td>\n</tr>\n";
	}
}
?>



</table>



<div style="width:150px;margin:auto auto;text-align:center;margin-top:15px;padding:8px;border:1px solid #ccc;font-size:13px;color:#0000ff;background:#fff;">
		<a class='sbar' href='javascript:window.close();'>Close Window</a>
	
	</div>


</body>

</html>

