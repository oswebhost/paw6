		

    
  </div>
<div class="right_col">


<?php 
   
   if ( $_SESSION['full_menu']=='YES' or strlen($_SESSION['userid'])>3)  {
		include("$path/leftmv5.ini.php");
   }else{
	   include("$path/leftmv5.ini.php");
   }
?>
	
	
</div>




<div style="clear:both;padding-top:00px;"></div>

<div style='text-align:center;'>
	
	<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
		<!-- Home_bot -->
		<ins class="adsbygoogle"
			 style="display:inline-block;width:728px;height:90px"
			 data-ad-client="ca-pub-5098673027102346"
			 data-ad-slot="7527065116"></ins>
	<script>
		(adsbygoogle = window.adsbygoogle || []).push({});
	</script>
	
</div>

<div style="clear:both;padding-top:10px;"></div>
</div>

<div style="background: url(<?php echo $domain?>/images/v4/mid-bottom.png)no-repeat;height:100px;padding-top: 5px;">
    



<table border='0' cellpadding="0" cellspacing="0" style="auto auto;width:98%;">
<tr>
		<td style="width:100%;text-align:center;">
			
           
	
        <a class="sbar" href="<?php echo $domain?>/disclaimer.php" style='padding-left:5px;'>Legal/Disclaimer</a>&nbsp;&nbsp;|&nbsp;&nbsp; 
		<a class="sbar" href="<?php echo $domain?>/privacy.php" style='padding-left:5px;'>Privacy Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		
		<a class="sbar" href="<?php echo $domain?>/commenting-rules.php" style='padding-left:5px;'>Commenting Rules</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a class="sbar" href="<?php echo $domain?>/copyright.php" style='padding-left:5px;'>Copyright</a>
		&nbsp;&nbsp;|&nbsp;&nbsp;
		<a class="sbar" href="<?php echo $domain?>/refund.php" style='padding-left:5px;'>Refund Policy</a>&nbsp;&nbsp;|&nbsp;&nbsp;
		<a class="sbar"  href="<?php echo $domain?>/sitemap.php" >Site Map</a>
          
            
		<div style="padding-top:5px;">
		Last Updated: 
		<?php
			$temp = $eu -> prepare("select lastupdate from setting");
			$temp -> execute();
			$d = $temp -> fetch();
			echo $d["lastupdate"];
		?>
		</div>
		<div style="padding-top:5px;color:blue;">
		 Soccer-Predictions.com: Powered by Predict-A-Win Program &copy; BetWare Ltd    
		</div>
</td>
</tr>
</table>

<p class='newplist2' style='width:880px;padding:15px 10px 0 15px;'><span class='red'>Privacy Laws</span> - This website employs "cookies" to let you get access to our data, but online privacy laws require us to inform you about that, and by continuing you are deemed to have agreed to our use of cookies. To find out more, please read the appropriate section of our <a class='sbar' href='privacy.php'>Privacy Policy</a>.</p>
</div>


</div>




</body>
</html>

<?php
  $eu = null;
  $sa = null;
  $sp = null;
  //mysql_close($link);
?>