<?php 

$filename = dirname((__FILE__)) . "/ease/cs/". $_GET['db'] . "/EASE6_CS_Week_" .$_GET["week"] . ".zip";

// required for IE, otherwise Content-disposition is ignored
if(ini_get('zlib.output_compression'))
  ini_set('zlib.output_compression', 'Off');

// 


$file_extension = strtolower(substr(strrchr($filename,"."),1));


switch( $file_extension )
{
  case "pdf": $ctype="application/pdf"; break;
  case "exe": $ctype="application/octet-stream"; break;
  case "zip": $ctype="application/zip"; break;
  case "doc": $ctype="application/msword"; break;
  case "xls": $ctype="application/vnd.ms-excel"; break;
  case "ppt": $ctype="application/vnd.ms-powerpoint"; break;
  case "gif": $ctype="image/gif"; break;
  case "png": $ctype="image/png"; break;
  case "jpeg":
  case "jpg": $ctype="image/jpg"; break;
  case "mp3" : $ctype = "audio/mp3"; break;
  case "aif" : $ctype = "audio/x-aiff "; break;
  case "aifc" : $ctype = "audio/x-aiff"; break;
  case "aiff" : $ctype = "audio/x-aiff"; break;
  case "ra" : $ctype = "audio/x-pn-realaudio"; break;
  case "m3u" : $ctype = "audio/x-mpegurl"; break;
  case "ram" : $ctype = "audio/x-pn-realaudio"; break;
  case "wav" : $ctype = "audio/x-wav"; break;
  case "txt" : $ctype = "text/plain"; break;
  case "mpeg":
  case "mpe":
  case "mpg": $ctype = "video/mpeg"; break ;
  case "qt" :
  case "mov" : $ctype = "video/quicktime"; break;
  default: $ctype="application/force-download";
}


	header("Pragma: public");
	header("Expires: 0");
	header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
	header("Cache-Control: private",false);

	header("Content-type:" . $filename['type']); 
	header("Content-Transfer-Encoding: Binary"); 
	header("Content-length: " . filesize($filename) ); 
	header("Content-disposition: attachment; filename=\"".basename($filename)."\";"); 
	readfile("$filename") or die ("No file");

?> 