<?php

$page_title="Computerised Soccer Predictions";
include("config.ini.php");
include("function.ini.php");

include("header.ini.php");
$PAGE_TITLE="About the PaW Program";
?>
<!-- startprint -->
<?php
page_header($PAGE_TITLE);	

?>

<p>Our "Predict-A-Win" Program ("PaW" Program) is written in a high level database language (FoxPro), and it has been running effectively for many years now. For every season commencing in 2003 we have been using that Program to prepare predictions for posting on the Internet. It is extremely comprehensive and provides many different avenues of approach to creating predictions, and we are forever improving it and/or adding entirely new modules.  </p>
  
<p>Our Program employs 9 very distinct "base" Prediction Methods together with 5 derivative Prediction Methods, and tracks and records many different aspects of the reliability of their outputs. The 5 derivative modules each identify &#822; in separate ways &#822; the best Prediction Method for the two specific teams involved in each particular match, based on the respective reliabilities for both the Result Type and the Correct Scores predictions. As a final step, in order to identify the very best betting selections for the week, the Program sorts the predictions into prioritised lists, based on a combination of the highest reliabilities.</p>


<p>Being structured as a database, our Program gives us the ability to create an endless variety of Reports, limited only by our own imagination. We have been fortunate that many of our Members have inventive minds and have made many suggestions for our Reports that we have taken on board.</p>


<p>As and when we establish further refinements in the Program's processes that will produce even better results than we are currently obtaining, we will utilise that version for compiling the data we post on the website. Refining the Program is an ongoing project, where the sky is the limit when it comes to new ideas, and we still have many good proposals in the pipeline.</p>  

<!-- stopprint -->
<?php
	$ptopic="ggexplained.php"; $ntopic="compilingpic.php";
	$msg=$PAGE_TITLE;
	include("icons.ini.php"); 
	include("footer.ini.php");
?>

