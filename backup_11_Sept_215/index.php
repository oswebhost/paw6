<?php
session_start();	

$_SESSION['db'] = 'eu';




include("config.ini.php");
include("function.ini.php");



$toolurl = "db=eu&season=2014-2015&weekno=2&DIV=0&BETTING=1&SORTBY=7&ordered=2&PERIOD=1&CALL=1&min_odd=0.00&max_odd=0.00&limitedto=6&PROPTION=2&CALLPARAM=0&B1=View+Data";



$PAGE_TITLE = "Free Soccer / Football Predictions Site";

$br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use. 
//echo $br;

if (strlen($show_key)<10){
    $show_key= meta_index();
}

if (strlen($desc)<5){
    $desc  = "Quality Soccer Predictions Data &amp; Online Interactive Analysis Tool using sophisticated computer Program; Team Performance Data, Charts &amp; Tables, Bookies Odds, Over-Round data, League Tables, Results Matrices and much more.";
}


$tmp = $eu->prepare('select week_begin from setting');
$tmp->execute();
$ddd = $tmp->fetch();
$week_perid = $ddd['week_begin'];


?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 

<html>
<head>

<link rel="shortcut icon" href="<?=$domain?>/images/betware.ico">
<meta http-equiv="Content-Language" content="en-us">
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252">
<meta name="title" content="<?echo $PAGE_TITLE ?>">


<meta name="description" content="<?php echo $desc;?>">

<meta name="keywords" content="<?php echo $show_key;?>">



<meta name="document-distribution" content="Global">
<meta name="robots" content="index,follow">
<meta name="revisit-after" content="7 days">
<meta http-equiv="pragma" content="no-cache">

<link rel="stylesheet" type="text/css" href="<?=$domain?>/css/style_v4.css" media="screen">


<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="<?=$domain?>/javas/anylink.js"></script>
<script type="text/javascript" src="<?=$domain?>/javas/anylinkvertical.js"></script>

<header>
	<!-- <script type="text/javascript" src="javas/fancybox/lib/jquery-1.8.2.min.js"></script> -->
	<script type="text/javascript" src="javas/fancybox/source/jquery.fancybox.js?v=2.1.1"></script>
	<link type="text/css" rel="stylesheet" href="javas/fancybox/source/jquery.fancybox.css?v=2.1.1" media="screen" />

	<script type="text/javascript">
		$(document).ready(function() {
			$(".various").fancybox({
				maxWidth	: 700,
				maxHeight	: 600,
				fitToView	: false,
				width		: '70%',
				height		: '70%',
				autoSize	: false,
				closeClick	: false,
				openEffect	: 'none',
				closeEffect	: 'none'
			});
		});
	</script>
</header>


<link rel="stylesheet" href="tips/jquery.cluetip.css" type="text/css">
<script type="text/javascript" src="tips/jquery.cluetip.js"></script>
<script type="text/javascript" src="tips/demo/demo.js"></script>


<title><?= $PAGE_TITLE; ?></title>

<script type="text/javascript">
function tell(url){

	window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=710,height=520");
}



function bigwin(url)
{
	window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=1100,height=650");
}


</script>
</head>


 <body style="background: #E9EFFF  url(<?=$domain?>/images/v5/page-bgwally56.jpg)repeat-x;">
	
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_US/sdk.js#xfbml=1&version=v2.5";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));
</script>


	<div style="margin:auto auto;width:910px;padding-top:5px;padding-bottom:5px;height:116px;">
		<a href="<? echo $domain?>"><img src="<?=$domain?>/images/logo.png" border="0"  alt='European/American Soccer Predictions'></a>
	</div>
	
	<?php include("topMenu.ini.php"); ?>

	


    

    

<div class="clear"></div>
    
<div style="width:910px;margin:auto auto;">

<div style="padding: 3px;"></div>
    <div><img src="<?=$domain?>/images/v4/mid-top.png" border="0"  alt='soccer successes'></div>
	
<div style="background:url(<?=$domain?>/images/v4/mid-mid.png) repeat-y;padding-left:0px; padding-right:14px;">




 <?php $mmm=1; if ($mmm=='1'){ ?>
  
    <div class="middle_colv3" style="width: 580px; margin-left:34px; border:0px solid #ccc;">
   
 <?}else{ ?>
    
    <div class="middle_colv3" style="width: 580px; border:0px solid #ccc;">
    
 <?}?>

 
<div class='hypebox'  style='width:582px;margin:0px auto 0 auto;'>
  <div class='div_top520'></div>
    <div class='div_mid520' style="line-height: 140%;">
	<font style="font-size:18px;color:blue;"><strong>Spend Some Xmas Money On Yourself!</strong></font> 
	<div class='spacer'></div>
	<div style='width:40px;float:left;'>
		<img src='images/Hourglass_rotates.gif' border='0' alt='Xmas Money' height='70' >
	</div>
	 <div style="padding-top:0px;padding-left:80px; padding-right:20px;text-align:justify;font-size:15px;">
Please be reminded that you will only be able to get free access to our Services until <b>31 December 2015</b>, after which you will be required to pay. We are offering an <span class='bb'>Early Bird discount</span>, and if you wish to take advantage of this then please visit our <a href="payment_options.php" class="bb">Subscribe Page</a> now to see what is on offer.
<div class='spacer'></div>

	</div>
    <div class='div_bottom520'></div>
</div>

</div>

 
 
 <?php if (isset($_SESSION["userid"])) { ?>
	<video  style="margin-top:10px; margin-bottom:5px;" width="580" height="310" controls>
 <?php }else{ ?>
	<video  style="margin-top:10px; margin-bottom:5px;" width="580" height="310" controls>
 <?php } ?>
  <source src="Presentation1_ver_11_003.mp4" type="video/mp4">
</video>


<?php 
	//$toolurl = "db=eu&season=2014-2015&weekno=17&DIV=0&BETTING=5&SORTBY=41&ordered=2&PERIOD=2&CALL=1&min_odd=1.8&max_odd=2.20&ASL2GET=all&limitedto=6&PROPTION=1&CALLPARAM=0&B1=View+Data";
	
	//include("hypes/2014-2015/week_18sa.html");
	
	//include("hypes/2014-2015/week_27sa.html");
	
	include("hypes/2014-2015/week_17sa.html"); /// SoccerPAT Reverse Calls Doing Well!

	//include("hypes/2014-2015/week20151116.html");
	
	
	
	include("blogposting.php");
	//$main_blogid = 1000; // should be removed
?>

<table style='margin-top:10px;' border='0' width='100%'>
	<tr>
		<td width='33%'><a href='haveyoursay.php' title="Get Access to Post General Comments"><img src='images/gotinex.jpg' border='0' alt="Got something to say?" /></a></td>
		<td width='33%'> 
				<div class="reg_botton" style='padding:0;margin:0;width:170px;'>
					<a title='Get Soccer Predictions Data Now!' href="register.php">
					<img src='images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
				</div>
		</td>
		<td width='33%'style='padding-left:5px;'><a title="Link to Have Your Say Page" href='haveyoursay.php'><img src='images/sayindex.jpg' border='0' alt='Have your say now!' /></a></td>
	</tr>
</table>
		




<?php 
 
 

 
 include("freeprediction-index.php"); 
?>

<div style="background:#F3F6FA;padding:8px;margin-top:10px;border:1px solid #85ADAD;width:562px;">

<p class='newp'>This website is aimed at those who <span class='bb'>take their soccer/football betting seriously</span>. If you are one of those who doesn't care about "form" and simply wants to "<span class='red'>bet from the heart</span>", then this website is <span class='red'>definitely NOT</span> for you! That's because <span class='bb'>we strive hard to help people WIN from their betting</span> - <b>not LOSE their hard earned money!</b></p>


<p class='newp'>We post soccer predictions throughout the entire year, currently covering the Premier Football Leagues in <span class='bb'>10 soccer loving countries across Europe</span> (England, France, Holland, Germany, Greece, Italy, Portugal, Scotland, Spain and Turkey), and we also cover the full season for 3 Divisions in the Americas (the top 2 in Brazil and the USA's MSL), where their season extends across the European football "close season".   </p>


<p class='newp'>To enable us to generate worthwhile soccer predictions we utilise our own <span class='bb'>specially developed in-house software</span>, which ensures <span class='bb'>100% consistency of output</span> and allows us to post <b>a vast array of data</b> essential for making good betting decisions, and which <span class='bb'>saves you from having to carry out countless boring hours of research work each week!</span>  </p>

<p class='newp'>To give you just one example of the data we provide you with <span class='bb'>for each and every Football League match</span>, take a look at the <span class='bb'>Free Soccer Predictions postings above</span>. If you then <b>click on the blue Date/Time link</b> shown against each match you will see a <span class='bb'>truly amazing - and very colourful - array of useful data</span>  (the "<b>Team Performance Records</b>").</p>

</div>


<div style="background:#F3F6FA;padding:8px;margin-top:10px;border:1px solid #85ADAD;width:562px;">

<p class='newp'>


We have also developed <span class='bb'>a unique online Soccer Predictions Analysis Tool</span> (which we call "<a href="javascript:bigwin('<?php echo $domain;?>/soccer-predictions-analysis-tool.php?<?php echo $toolurl;?>')" class='sbar' style='font-size:13px;'><span class='bb' style='color:maroon;'>SoccerPAT</span></a>") to help you <b>easily identify the best betting opportunities!</b> It provides you with <span class='bb'>a completely "interactive" search experience</span> (totally under your control). Once you have grasped just how powerful it is <span class='bb'>you will find it indispensable</span>, <b>whether you are a betting expert or just a novice!</b>
</p>

<?php

$summaryURL1 = "javascript:tell('weekbyweeksummary.php?db=eu&season=2013-2014&weekno=42&DIV=0&BETTING=1&SORTBY=10&ordered=1&PERIOD=2&CALL=1&PROPTION=2&ASL2GET=all&limitedto=6&min_odd=1.60&max_odd=1.90&CALLPARAM=0&CALLAS=0&B1=View+Data')" ;


$summaryURL2 = "javascript:tell('weekbyweeksummary.php?db=eu&season=2013-2014&weekno=17&DIV=0&BETTING=1&SORTBY=8&ordered=1&PERIOD=1&CALL=1&PROPTION=2&ASL2GET=all&limitedto=6&min_odd=2.00&max_odd=2.50&CALLPARAM=0&CALLAS=0&B1=View+Data')" ;

//27Nov2015
$summaryURL3 = "javascript:tell('weekbyweeksummary.php?db=eu&season=2014-2015&weekno=17&DIV=1&BETTING=1&SORTBY=11&ordered=1&PERIOD=1&CALL=8&PROPTION=2&ASL2GET=all&limitedto=6&min_odd=3&max_odd=3.2&CALLPARAM=0&CALLAS=4&B1=View+Data')";

?>


<p class='newp'>


If you want proof about how useful our <a href="javascript:bigwin('<?php echo $domain;?>/soccer-predictions-analysis-tool.php?<?php echo $toolurl;?>')" class='sbar' style='font-size:13px;'><span class='bb' style='color:maroon;'>SoccerPAT</span></a> is, take a look at the result of just <span class='bb'>two different ways we made money with it</span> in the 2013-2014 season,  especially on the accumulators: "<a href="<?php echo $summaryURL1;?>" class='md2' style='font-size:13px;'><b>Odds-Based</b></a>" and "<a href="<?php echo $summaryURL2;?>" class='md2' style='font-size:13px;'><b>Probabilities-Based</b></a>".  With both "selection" routes <span class='bb'>we won on every single combination</span> (from "singles" to "sextuples"), making <span class='bb'>profit</span> ranging from a minimum of <span class='bb'>10.50% on singles to 230.74% on sextuples!</span> In 2014-2015, with our new REVERSE selections technique, we made good money there too - <a href="<?php echo $summaryURL3;?>" class='md2' style='font-size:13px;'><b>17.98% on the singles</b></a> and <span class='bb'>138.31% on the trebles</span> (and ridiculous percentages on the higher accumulators)! Now, doesn't that sound like exactly the sort of help you need so you can <span class='bb'>start beating the Bookies?</span></p>


<p class='newp'>
If you want to see a <span class='bb'>quick tutorial</span> of how to use <a href="javascript:bigwin('<?php echo $domain;?>/soccer-predictions-analysis-tool.php?<?php echo $toolurl;?>')" class='sbar' style='font-size:13px;'><span class='bb' style='color:maroon;'>SoccerPAT</span></a>, please check out our <a  class='md2' style='font-size:13px;' href='soccerpat-video-tutorial.php'>YouTube Video</a>. And if you want to get the benefit of all our <span class='bb'>powerful soccer predictions data</span>, all you need to do is register with us to get free access to everything we have to offer!  However, please note that this offer ends on <b>31 December 2015</b>, when we commence charging for our Services.</p>



<div class="reg_botton" style="margin-top: 0px;padding-top:12px">
	<a title='Get Soccer Predictions Data Now!' href="register.php">
	<img src='images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
</div>
			

			
<p class='newp' style='margin-top:0;padding-top:0'><i><b>This screen does not show the main menu we present for our Registered Members, so if you would like to see the full range of what we post on this website, then please feel free to <a class='sales' href='main.php'><b><u>click here</u></b></a>. There are dropdown menus under each of the big menu buttons, and our "Services Information" section (see top menu bar above) explains absolutely EVERYTHING about the content of the sub-menus. And if ever you need any further explanation about ANYTHING AT ALL on this website, we will answer all valid questions!</b></i>    			
</p>

</div>

<p class='newplist' style='width:568px;'>The Divisions we cover are: English Barclays Premiership, English Championship, English Leagues 1 & 2, National League (Conference), Isthmian Premier, English Northern & Southern Premiers, Scottish Premier, Scottish Championship, Scottish Leagues 1 & 2, French Ligue 1, German Bundesliga, Greek Super League, Dutch Eredivisie, Italian Serie A, Portuguese Liga, Spanish Primera Liga, Turkish Super Lig, Brazil Serie A & B, and USA MLS.			
</p>


<div style='text-align:center;margin-top:8px;margin-left:-4px;'>
       <img width='555px' src="images/8boxnew.gif" border="0" alt='Every New Registered Member will be given access to our specially prepared document "8 GOLDEN RULES for SUCCESSFUL SOCCER BETTING", which will be available for downloading immediately after completing registration.'>  
</div>


<?php include("footernew.ini.php"); 

function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}



?>