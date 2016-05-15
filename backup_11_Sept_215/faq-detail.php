<?php
include("function.ini.php");
include("faq-class.php");

page_header("FAQs");

$faq->addcount($_GET['id']);
$faq->getfaq($_GET['id']);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
	<meta http-equiv="content-type" content="text/html; charset=iso-8859-1" />
	<title><?php echo $faq->question;?></title>

	<link rel="stylesheet" type="text/css" href="css/style_v4.css" media="screen" />

</head>

<body style='background:#fff;'>

<div style='float:right;padding-right:20px;'><a target='_blank' class='sbar' href='javascript:window.print()'>Print</a> </div>

<div class='clear'></div>

<!-- startprint -->

<div class='faq-detail'>
	<h1><?php echo $faq->question;?></h1>
	<?php echo $faq->answer;?>
</div>


<!-- stopprint -->


</body>
</html>