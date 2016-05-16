<?php

$java_ = 0;

include("function.ini.php");
include("bettingadvice-class.php");

page_header("Betting Advice");

$bettingadvice->addcount($_GET['id']);
$bettingadvice->getbettingadvice($_GET['id']);

$no = $_GET["no"];



?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title><?php echo $bettingadvice->question;?></title>

	<link rel="stylesheet" type="text/css" href="css/style_v4.css" media="screen" />

</head>

<body style='background:#fff;'>
<div style='float:right;padding-right:20px;'><a target='_blank' class='sbar' href='javascript:window.print()'>Print</a> </div>

<div class='clear'></div>

<!-- startprint -->

<div class='faq-detail'>
	<?php 
		if ($no==1){
	?>
		<h1><?php echo $bettingadvice->question;?></h1>
	
	<?php }else{ ?>
		
		<h1><?php echo $bettingadvice->rank . ".&nbsp;&nbsp;" . $bettingadvice->question;?></h1>
		
	<?php }?>	
	
	<?php echo $bettingadvice->answer;?>
</div>

<!-- stopprint -->




</body>
</html>