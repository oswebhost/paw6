<?php

$url = "http://www.teamtalk.com/rss/12878";


$res = file_get_contents($url);

$res = str_replace("<![CDATA[","", $res);
$res = str_replace("]]>","", $res);
$res = str_replace("&","and", $res);


$xml = simplexml_load_string($res);

$ncount = count($xml->channel->item);

?>




<div id="mynews2"> 



<?php

$nid=0;
for ($i=0; $i<$ncount; $i++){

	
  $image= $xml->channel->item[$i]->enclosure;
  $image= ereg_replace("/84/","/402x210/", $image);

  $nid++;
  echo "<div id='newssa$nid'  class='news_style'>";
   echo "<img src='$image' border='0' width='183' height='110' align='left' vspace='2' hspace='4' alt='". trim($xml->channel->item[$i]->title) ."'>";
 
  $url = "<center><a class='newstitle' href='" . trim($xml->channel->item[$i]->link) . "' target='_blank'>";
  echo $url . trim($xml->channel->item[$i]->title) . "</a></center><br>";
  echo trim($xml->channel->item[$i]->description);
  echo "</div>\n\n";
}


?>
</div>

  
<div align="left" id="mynewsdis2">

    
    <div id="showhere2" class="news_show" style='height:214px;overflow:hide;'></div>
 
	<div class='clear'></div>	
    <div class="buttondiv" id="news_button2">
     <img src="<?=$domain?>/javas/prev.gif" align="MIDDLE" alt='Previous' id="news_prev">
    <img src="<?=$domain?>/javas/pause.gif" align="MIDDLE" alt='Pause' id="news_pause">
    <img src="<?=$domain?>/javas/next.gif" align="MIDDLE" alt='Next' id="news_next">
   </div>
    

</div>
