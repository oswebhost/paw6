<?php $domain = "http://soccer-predictions.com"; ?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd"> 


<html>

<head>
<link rel="stylesheet" type="text/css" href="css/style_v4.css" media="screen">
<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js"></script>
<script type="text/javascript" src="http://soccer-predictions.com/javas/jquery.easynews.js"></script>



<script language="JavaScript" type="text/javascript">

	$(document).ready(function(){
	var newsoption1 = {
	  firstname: "mynews",
	  secondname: "showhere",
	  thirdname:"news_display",
	  fourthname:"news_button",
	  newsspeed:'9000',
	  imagedir:"http://soccer-predictions.com/javas/",
	}
	$.init_news(newsoption1);


var myoffset=$('#news_button').offset();

var mytop=myoffset.top-1;

$('#news_button').css({top:mytop});

});
</script>
</header>

<body>
<?php
//SA News
$url = "http://www.teamtalk.com/rss/12878"; 

//EU News
//$url = "http://www.teamtalk.com/rss/1765"; 


$res = file_get_contents($url);

$res = str_replace("<![CDATA[","", $res);
$res = str_replace("]]>","", $res);
$res = str_replace("&","and", $res);


$xml = simplexml_load_string($res);

$ncount = count($xml->channel->item);

?>

<div style="width:270px;font-size:10px;">


<div id="mynews" class='mynews'> 



<?php

$nid=0;
for ($i=0; $i<$ncount; $i++){

	
  $image= $xml->channel->item[$i]->enclosure;
  $image= ereg_replace("/84/","/402x210/", $image);

  $nid++;
  echo "<div id='news$nid'  class='news_style'>";
  echo "<img src='$image' border='0' width='260' height='150' align='left' vspace='2' hspace='4' alt='". trim($xml->channel->item[$i]->title) ."'>";
  $url = "<center><a class='newstitle' href='" . trim($xml->channel->item[$i]->link) . "' target='_blank'>";
  echo $url . trim($xml->channel->item[$i]->title) . "</a></center><br>";
  echo trim($xml->channel->item[$i]->description);
  echo "</div>\n\n";

  

}



?>
</div>

  
<div align="left" id="mynewsdis">

    
    <div id="showhere" class="news_show" style='height:240px;overflow:hide;'></div>
 
	<div class='clear'></div>	
    <div class="buttondiv" id="news_button" style='margin-top:5px;padding-left:180px;'>
    <img src="<?=$domain?>/javas/prev.gif" align="MIDDLE" alt='Previous' id="news_prev">
    <img src="<?=$domain?>/javas/pause.gif" align="MIDDLE" alt='Pause' id="news_pause">
    <img src="<?=$domain?>/javas/next.gif" align="MIDDLE" alt='Next' id="news_next">
    </div>
</div>



</div>
</body>
</html>