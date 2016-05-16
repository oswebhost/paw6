<?php

require_once("config.ini.php");
require_once("function.ini.php");

$page_title = 'Have Your Say!';



require_once("header.ini.php");
page_header($page_title);


?>
<p style="margin-bottom:20px;padding-bottom:20px;border-bottom:1px solid #ccc;">
This page is where our Registered Members can speak their minds on any topic, provided that they keep it clean and follow the <a href='commenting-rules.php' class='bb'>Commenting Rules</a>.  All comments will be subject to scrutiny at some point, although we cannot be held responsible for the content of any comments posted here.
</p>


<div id="fb-root"></div>

<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/en_GB/sdk.js#xfbml=1&version=v2.4&appId=1672312956326213";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));

</script>




<div class="fb-comments" data-href="http://soccer-predictions.com/haveyoursay.php" data-numposts="20"></div>	
	
<?php require_once("footer.ini.php"); ?>