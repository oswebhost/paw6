<?php





	$url = "https://www.pilipinaselectionresults2016.com/#/er/0/NIR/4500/4501/4501001/45010096";

	echo $url;

	$head = get_data($url);



	echo "<pre>";
	print_r($head);
	echo "</pre>";

	$keywords = array();
	$domain = array($url);
	$doc = new DOMDocument;
	$doc->preserveWhiteSpace = FALSE;
	foreach ($domain as $key => $value) {
	    @$doc->loadHTMLFile($value);
	    $anchor_tags = $doc->getElementsByTagName('a');
	    foreach ($anchor_tags as $tag) {
	        $keywords[] = strtolower($tag->nodeValue);
	    }
	}

	print_r($keywords);


function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}
?>