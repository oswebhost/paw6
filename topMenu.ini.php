    <div style="width: 920px;  margin:auto auto;background: url(<?php echo $domain?>/images/v5/menu-middle.png) repeat-x;height:35px;">

        <div style="width: 910px; margin:auto auto;">
        			
            			

		<div style=' float:left;'>

				<ul id="menuTop">
				<?php if (!isset($_SESSION["userid"])) { ?>	
				 	<li><a style='padding-right:18px;padding-left:15px;' href="<?php echo $domain?>/index.php">Home</a></li>
				 <?php }else{ ?>
				 	<li><a style='padding-right:18px;padding-left:15px;' href="<?php echo $domain?>/index.php">Home</a></li>
				 <?php } ?>
				 <li><a href="<?php echo $domain?>/aboutus.php">About Us</a></li>
				 <li><a href="#" onClick="return clickreturnvalue()" onMouseover="dropdownmenu(this, event, 'forsale')">Services Info</a></li>
                 
              					 
				 
                 <li><a href="<?php echo $domain?>/payment_options.php">Subscribe</a></li>
				 <li><a href="<?php echo $domain?>/faq.php">FAQs</a></li>
				<!-- <li><a href="<?php echo $domain?>/soccer-news.php" title='Online News From Teamtalk.com'>Headlines</a></li> -->
				 <li><a href="<?php echo $domain?>/soccer-reviews.php" title='Tweets for Blog Postings'>Site News</a></li>
        		 <li><a href="<?php echo $domain?>/free-soccer-predictions-history.php?shownow=0" title='Home Screen Weekly "Freebies" Report'>Freestory</a></li>  
                 <li><a href="<?php echo $domain?>/contactus.php">Contact Us</a></li>
				 <li><a href="<?php echo $domain?>/userinfo.php">My Account</a></li>

				   <?php if (!isset($_SESSION["userid"])) { ?>
					<li><a href="<?php echo $domain?>/loginfree.php">Login</a></li>
				   <?php }else{ ?>
				   
					<li><a href="<?php echo $domain?>/logout.php">Logout</a></li>
				   <?php } ?>
                   
			  </ul>
		</div>
		
        								
	
		</div>		
    </div>

<div id="news" class="anylinkcssTop">
  <a href="<?php echo $domain?>/soccer-news.php">Latest soccer Headlines</a>
</div>
			  
<div id="forsale" class="anylinkcssTop">
	<a href="<?php echo $domain?>/about-predictawin-services.php" >About Our Services</a>
	<a href="<?php echo $domain?>/predictions-data.php" >Predictions Data</a>
	<a href="<?php echo $domain?>/soccer-predictions-analysis-tool-info.php" >Soccer Predictions Analysis Tool</a>
	<a href="<?php echo $domain?>/general-data.php" >General Data</a>
	<a href="<?php echo $domain?>/downloadables.php" >Downloadables</a>
	<a href="<?php echo $domain?>/jackpot-calculator-info.php" >Jackpot Calculator</a>
	
	<a href="<?php echo $domain?>/about-posting.php" >Postings (Dates/Times/Content)</a>
	<a href="<?php echo $domain?>/aboutodds.php" >About Our Odds Postings</a>
	<a href="<?php echo $domain?>/thepic.php" >Performance Indicator Chart (PIC)</a>  
	<a href="<?php echo $domain?>/pic-compilation.php" >PIC Compilation</a>
	<a href="<?php echo $domain?>/upic.php" >Utilising the PIC Backup Data</a>
	
	<a href="<?php echo $domain?>/ease-detailed-explanation.php" >"EASE 6" Detailed Explanation</a>
	
	<a href="<?php echo $domain?>/using-the-blank-ease-spreadsheets.php">Using the "Blank" EASE Spreadsheet</a>
	<a href="<?php echo $domain?>/paw.php" >About the PaW Program</a>
	<a href="<?php echo $domain?>/aboutfaqs.php" >About Our FAQs</a>
    <a href="<?php echo $domain?>/betting-advice.php" >Betting Advice</a>
</div>