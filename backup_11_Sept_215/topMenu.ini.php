<?php

?>

    <div style="width: 860px;  margin:auto auto;background: url(<?=$domain?>/images/v5/menu-middle.png) repeat-x;height:35px;">

        <div style="width: 870px; margin:auto auto;">
        			
            			

		<div style=' float:left;'>

				<ul id="menuTop">
				<? if (!isset($_SESSION["userid"])) { ?>	
				 	<li><a style='padding-right:18px;padding-left:15px;' href="<?=$domain?>/index.php">Home</a></li>
				 <?}else{?>
				 	<li><a style='padding-right:18px;padding-left:15px;' href="<?=$domain?>/index.php">Home</a></li>
				 <?}?>
				 <li><a href="<?=$domain?>/ba/aboutus.php">About Us</a></li>
				 <li><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, 'forsale')">Services Info</a></li>
                 
                 <? if (!isset($_SESSION["userid"])) { ?>
				    <li><a href="<?=$domain?>/register.php">Register</a></li>
                 <? }?>
						 
				 
                 <li><a href="<?=$domain?>/payment_step1.php">Subscribe</a></li>
				 <li><a href="<?=$domain?>/faq.php">FAQs</a></li>
				<!-- <li><a href="<?=$domain?>/soccer-news.php" title='Online News From Teamtalk.com'>Headlines</a></li> -->
				 <li><a href="<?=$domain?>/soccer-reviews.php" title='Tweets for Blog Postings'>Site News</a></li>
        		 <li><a href="<?=$domain?>/free-soccer-predictions-history.php?shownow=0" title='Home Screen Weekly "Freebies" Report'>Freestory</a></li>  
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

	<a href="<?=$domain?>/ba/predictions-data.php" >Predictions Data</a>
	<a href="<?=$domain?>/ba/soccer-predictions-analysis-tool.php" >Soccer Predictions Analysis Tool</a>
	<a href="<?=$domain?>/ba/general-data.php" >General Data</a>
	<a href="<?=$domain?>/ba/downloadables.php" >Downloadables</a>
	<a href="<?=$domain?>/ba/jackpot-calculator.php" >Jackpot Calculator</a>
	
	<a href="<?=$domain?>/ba/about-posting.php" >Postings (Dates/Times/Content)</a>
	<a href="<?=$domain?>/ba/aboutodds.php" >About Our Odds Postings</a>
	<a href="<?=$domain?>/ba/thepic.php" >Performance Indicator Chart (PIC)</a>  
	<a href="<?=$domain?>/ba/pic-compilation.php" >PIC Compilation</a>
	<a href="<?=$domain?>/ba/upic.php" >Utilising the PIC Backup Data</a>
	
	<a href="<?=$domain?>/ba/ease-detailed-explanation.php" >"EASE 6" Detailed Explanation</a>
	
	<a href="<?=$domain?>/ba/using-the-blank-ease-spreadsheets.php">Using the "Blank" EASE Spreadsheet</a>
	<a href="<?=$domain?>/ba/paw.php" >About the PaW Program</a>
	<a href="<?=$domain?>/ba/aboutfaqs.php" >About Our FAQs</a>
    <a href="<?=$domain?>/ba/bettingadvice.php" >Betting Advice</a>
</div>