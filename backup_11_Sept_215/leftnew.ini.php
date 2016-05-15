<div id="google_translate_element" style='border:1px solid #32701D;background:#fff;padding:5px;margin-top:8px;'></div>
<script language="JavaScript" type="text/javascript">

function googleTranslateElementInit() {
  new google.translate.TranslateElement({
    pageLanguage: 'en'
  }, 'google_translate_element');
}
</script>

<script language="JavaScript" type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>



<div class="reg_botton" style="margin:0;padding:0;margin:10px 0">
	<a title='Current Soccer Predictions and SoccerPAT Access' href="main.php">
	<img src='images/predinfo6.jpg' border='0' alt='Current Soccer Predictions and SoccerPAT Access'></a>
</div>

<div title="Beat the Bookie Video" style="padding-left: 0px;padding:2px;margin-bottom:8px;font-size:12px;text-align:center;border:1px solid blue;background:url('images/newpng.gif') no-repeat bottom right; z-index:-100;height:220px;">
	
	<iframe  width="230" height="180" src="https://www.youtube.com/embed/DljZBuWIgEA" frameborder="0" allowfullscreen></iframe>
	<b>New SoccerPAT <font color="blue">"REVERSE"</font> Feature</b>
	
		
</div>

<div class="reg_botton" style="padding:0;padding-left:16px;margin:0;margin-top:8px;margin-bottom:10px;">
	<a title='Get Soccer Predictions Data Now!' href="register.php">
	<img src='images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!s'></a>
</div>


<a  class="custom-width mblue" rel="ajax3.html" title="<?= $pictitle?>" href="<?php echo $pic_url;?>" target="_blank" onMouseover="ddrivetip('Performance Indicator Chart - click to see full chart.', 150)"  onMouseout="hideddrivetip()"><img src="images/pics/<?php echo $pic_db;?>/<?php echo $pic_id;?>.gif" border="0" align="left" vspace="0" hspace="15" style="margin-left:-2px;" alt="<?= $pic_alt;?>"></a>



<div class="reg_botton" style="padding-left:16px;margin:0;margin-top:5px;margin-bottom:5px;">
	<a title='Get Soccer Predictions Data Now!' href="register.php">
	<img src='images/joinnow2.png' border='0' alt='Get Soccer Predictions Data Now!s' style='margin-top:5px;'></a>
</div>

	
 <div style='margin-bottom:12px;'>
  <a class='none' title="Link to Have Your Say Page" href="<?php echo $domain?>/haveyoursay.php"><img src='<?php echo $domain?>/images/gotsamethingtosay-index.jpg' border='0' alt='Got Samething To Say?'></a>
</div>

<img src='images/overtheline.jpg' border='0' alt='Blog'>
<div class='faq2' style='border:0px solid blue;' >

	<div style='font-size:13px;line-height:140%;'>
	<?php
		include("config.ini.php");
		
		
		
		$temp = $eu->prepare("SELECT * from blog_post where rid<$main_blogid order by rid desc limit 10"); //ORDER BY rid desc limit 1");
		$temp->execute();
		$counts = $temp->rowCount();
		$__row=0;
		while ($dq = $temp->fetch()){
			$__row++;
			
			echo "<div style='border:1px solid blue;margin-top:5px;width:236px;height:75px'>";
			echo "<div style='float:left;width:110px;'><img src='blog_images/" . strtolower(trim($dq['post_image'])) . "' border='0' style='width:110px;height:75px;border-right:0px solid blue;' ></div>";
			echo "<div style='float:right;padding-top:10px;padding-right:8px;width:108px;font-size:12px;font-weight:bold'>
				  <a class='sbar' href='blogdetail.php?blogid=" . $dq['rid'] ."'>". stripslashes($dq['post_title']) . "</a></div>";
			echo "</div>";
			
		}

			
	

		  $eu = null;
		  $sa = null;
		  $sp = null;
		  mysql_close($link);
		
	?>
		<div style='text-align:right;padding:5px;'><a class='sbar' href='bloglisting.php'>More Blog Postings >></a></div>
	</div>
	
	
	
</div>
<div style="padding-top:20px;text-align:center;">

<img name="facebox" src="<?=$domain?>/facebox.gif"  border="0" id="facebox" usemap="#m_facebox" alt="Social Media">

<map name="m_facebox" id="m_facebox">
<area shape="rect" coords="123,84,153,114" href="https://twitter.com/SoccPredictions" title="Follow us on Twitter" alt="Follow us on Twitter">
<area shape="rect" coords="54,84,84,114" href="http://www.facebook.com/pages/Soccer-Predictions/384175711609209?fref=ts" title="Facebook" alt="Facebook">
</map>                
 
</div>    

<script type="text/javascript" src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- Home_RHC -->
<ins class="adsbygoogle"
     style="display:inline-block;width:200px;height:200px"
     data-ad-client='ca-pub-5098673027102346'
     data-ad-slot="2038934716"></ins>
<script type="text/javascript">
(adsbygoogle = window.adsbygoogle || []).push({});
</script>


