<?php
session_start();	

include("config.ini.php");
include("function.ini.php");


$toolurl = "db=eu&season=2013-2014&weekno=42&DIV=0&BETTING=1&SORTBY=10&ordered=1&PERIOD=2&CALL=1&min_odd=1.60&max_odd=1.90&limitedto=6&PROPTION=2&CALLPARAM=0&B1=View+Data";

$PAGE_TITLE = "Free Soccer Predictions Data Europe";

$br = strtolower($_SERVER['HTTP_USER_AGENT']); // what browser they use. 
//echo $br;

if (strlen($show_key)<10){
    $show_key= meta_index();
}
if (strlen($desc)<5){
    $desc  = "Quality Soccer Predictions Data &amp; Online Interactive Analysis Tool using sophisticated computer Program; Team Performance Data, Charts &amp; Tables, Bookies Odds, Over-Round data, League Tables, Results Matrices and much more.";
}

// pic details //

$pic_id = 314;
$pic_db = "sa";
$pictitle  ="04-Jun-2014<br/>CA Bragantino v Fortaleza 1-2";
$pic_alt = "04-Jun-2014 - CA Bragantino v Fortaleza 1-2";
$pic_url = "team-performance-chart.php?id=$pic_id&amp;site=$pic_db";

$tmp = $sa->prepare('select week_begin from setting');
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

<link rel="stylesheet" type="text/css" href="<?=$domain?>/css/men.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?=$domain?>/css/style_v4.css" media="screen">
<link rel="stylesheet" type="text/css" href="<?=$domain?>/css/anylink.css" media="screen">
<script type="text/javascript" src="<?=$domain?>/javas/anylink.js"></script>


<title><?= $PAGE_TITLE; ?></title>

<script type="text/javascript">
function tell(url)
	{

		window.open(url,"","toolbar=no,location=no,left=100,top=40,directories=no,status=yes,menubar=no,resizable=yes,scrollbars=yes,width=710,height=520");
	}
</script>
</head>


    <body style="background: #E9EFFF  url(<?=$domain?>/images/v5/page-bgwally56.jpg)repeat-x;">


	<div style="margin:auto auto;width:840px;padding-top:5px;padding-bottom:5px;height:116px;">
		<a href="<? echo $domain?>"><img src="<?=$domain?>/images/logo.png" border="0"  alt='European/American Soccer Predictions'></a>
	</div>


    <div style="width: 860px;  margin:auto auto;background: url(<?=$domain?>/images/v5/menu-middle.png) repeat-x;height:35px;">

        <div style="width: 870px; margin:auto auto;">
        			
            			

		<div style=' float:left;'>

				<ul id="menuTop">
				 <li><a style='padding-right:18px;padding-left:15px;' href="<?=$domain?>/index.php">Home</a></li>
				 <li><a href="<?=$domain?>/ba/aboutus.php">About Us</a></li>
				 <li><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, 'forsale')">Services Information</a></li>
                 
                 <? if (!isset($_SESSION["userid"])) { ?>
				    <li><a href="<?=$domain?>/register.php">Register</a></li>
                 <? }?>
						 
				 
                 
				 <li><a href="<?=$domain?>/faq.php">FAQs</a></li>
				 <li><a href="<?=$domain?>/soccer-news.php">Headlines</a></li>
				 <li><a href="<?=$domain?>/soccer-reviews.php">Site News</a></li>
         <li><a href="<?=$domain?>/free-soccer-predictions-history.php?shownow=1">History</a></li>  
                 <li><a href="<?=$domain?>/contactus.php">Contact Us</a></li>
				 <li><a href="<?=$domain?>/userinfo.php">My Account</a></li>

				   <? if (!isset($_SESSION["userid"])) { ?>
					<li><a href="<?=$domain?>/loginfree.php">Login</a></li>
				   <?}else{?>
				   
					<li><a style="background: none;" href="<?=$domain?>/logout.php">Logout</a></li>
				   <?}?>
                   
			  </ul>
		</div>
		
        								
	
		</div>		
</div>

<div id="news" class="anylinkcssTop">
  <a href="<?=$domain?>/soccer-news.php">Latest soccer Headlines</a>
</div>
			  
<div id="forsale" class="anylinkcssTop">
	<a href="<?=$domain?>/ba/about-predictawin-services.php" >About Our Services</a>
	<a href="<?=$domain?>/ba/about-posting.php" >Postings (Dates/Times/Content)</a>
	<a href="<?=$domain?>/ba/thepic.php" >Performance Indicator Chart (PIC)</a>  
	<a href="<?=$domain?>/ba/pic-compilation.php" >PIC Compilation</a>
	<a href="<?=$domain?>/ba/upic.php" >Utilising the PIC Backup Data</a>
	



	<a href="<?=$domain?>/ba/using-the-blank-ease-spreadsheets.php">Using the "Blank" EASE Spreadsheet</a>
	<a href="<?=$domain?>/ba/aboutodds.php" >About Our Odds Postings</a>
	

	<a href="<?=$domain?>/ba/paw.php" >About the PaW Program</a>
	<a href="<?=$domain?>/ba/aboutfaqs.php" >About Our FAQs</a>
    <a href="<?=$domain?>/ba/bettingadvice.php" >Betting Advice</a>
</div>


<div class="clear"></div>
    
<div style="width:873px;margin:auto auto;">

<div style="padding: 3px;"></div>
    <div><img src="<?=$domain?>/images/v4/mid-top.png" border="0"  alt='soccer successes'></div>
	
<div style="background:url(<?=$domain?>/images/v4/mid-mid.png) repeat-y;padding-left:14px; padding-right:14px;">

     


 <?php $mmm=1; if ($mmm=='1'){ ?>
  
    <div class="middle_colv3" style="width: 540px; border:0px solid #ccc;">
    
 <?}else{ ?>
    
    <div class="middle_colv3" >
    
 <?}?>

<?php include("hypes/2014-2015/season1415.html"); ?>

<div style="background:#F3F6FA;padding:8px;margin-top:10px;border:1px solid #85ADAD;width:524px;">

<p class='newp'>This website is aimed at those people who <span class='bb'>take soccer betting seriously</span>. If you are one of those people who doesn't care about "form" and wants to "<span class='red'>bet from the heart</span>", then this website is <span class='red'>NOT</span> for you. <span class='bb'>We strive hard to help people win from betting!</span></p>	

<p class='newp'>We post soccer predictions throughout the entire year, covering <span class='bb'>10 countries across Europe</span> (England, France, Holland, Germany, Greece, Italy, Portugal, Scotland, Spain and Turkey), plus north/south America (Brazil & USA).</p>


<p class='newp'>Our predictions are generated using our own <span class='bb'>specialist in-house software</span>, which allows us to post a vast array of soccer data essential for making good betting decisions, and which would <span class='bb'>save you countless hours of research work each week!</span></p>
 
<p class='newp'>To give you an example of the data we provide you with <span class='bb'>for each and every League match</span>, take a look at the <span class='bb'>free soccer predictions postings</span> below.  If you click on the blue date/time link shown against each match you will see <span class='bb'>a truly amazing - and very colourful - array of useful data</span> (Team Peformance Records).</p>

</div>

<?php include("freeprediction-index.php"); ?>


<div style="background:#F3F6FA;padding:8px;margin-top:10px;border:1px solid #85ADAD;width:524px;">

<p class='newp'>We have also developed a <span class='bb'>unique online Soccer Predictions Analysis Tool</span> ("<span class='bb' style='color:maroon;'>SoccerPAT</span>") to help you easily identify the best betting opportunities. Whether you are an expert or a novice, <span class='bb'>you will find it indispensable</span> once you have grasped just how powerful it is!</p>

<p class='newp'>If you want proof about how useful our <span class='bb' style='color:maroon'>SoccerPAT</span> is, take a look also at the result of just <span class='bb'>two different ways we made money with it last season</span> (2013-2014) especially on the accumulators: <a href='#' class='sbar' style='font-size:13px;'>Odds Determined</a> / <a href='#' class='sbar' style='font-size:13px;'>Probabilities Determined</a>.  Now, isn't that exactly what you want to be able to <span class='bb'>start beating the Bookies?</span></p>

<p class='newp'>If you want to see a <span class='bb'>quick tutorial</span> of how to use <span class='bb' style='color:maroon;'>SoccerPAT</span>, you can check out our <a  class='sbar' style='font-size:13px;' href='soccerpat-video-tutorial.php'>YouTube Video</a>.</p>

<p class='newp' style='padding-bottom:0;margin-bottom:0'>And if you want to be able to get the benefit of <span class='bb'>all the powerful data</span> we can supply you with, all you need to do is register with us to <span class='bb'>get free access</span> to everything we have to offer!
</p>



<div class="reg_botton" style="margin-top: 0px;padding-top:0">
	<a title='Get Soccer Predictions Data Now!' href="register.php">
	<img src='images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!'></a>
</div>
			

			
<p class='newp' style='margin-top:0;padding-top:0'><i><b>If you first want to see what it is that we actually post on this website, then please feel free to <a class='sales' href='main.php'><b>click here</b></a>.  Don't be alarmed by the large list of menus you will see there, because our "Services Information" section (see top menu bar) explains absolutely EVERYTHING.  And if you need any further explanation about ANYTHING AT ALL on this website, we answer all valid questions!</b></i>    			
</p>

</div>

<p class='newplist'>The Divisions we cover are: English Barclays Premiership, Sky Bet Championship, Sky Bet League 1, Sky Bet League 2, Skrill Premier (Conference), Isthmian Premier, English Southern Premier, English Northern Premier, Scottish Premier, Scottish Championship, Scottish League 1, Scottish League 2, French Ligue 1, German Bundesliga, Greek Super League, Dutch Eredivisie, Italian Serie A, Poruguese Liga, Spanish Primera Liga, Turkish Super Lig, Brazil Serie A & B, and USA MLS.			
</p>





<?php include("footernew.ini.php"); 

function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}



?>