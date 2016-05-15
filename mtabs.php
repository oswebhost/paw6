<?php 

include("config.ini.php");
include("function.ini.php");
include("header.ini.php");

?>

<ul id="countrytabs" class="shadetabs" style='margin:0px;padding:0'>
	<li><a href="#" rel="#default" class="selected">Single</a></li>
	<li><a href="ltable-rank-home.php?t_url=<?=$t_url;?>" rel="countrycontainer">Double</a></li>
	<li><a href="ltable-rank-away.php?t_url=<?=$t_url;?>" rel="countrycontainer">Triple</a></li>
	<li><a href="ltable-rank-away.php?t_url=<?=$t_url;?>" rel="countrycontainer">Quadruple</a></li>
	<li><a href="ltable-rank-away.php?t_url=<?=$t_url;?>" rel="countrycontainer">Quintuple</a></li>
	<li><a href="ltable-rank-away.php?t_url=<?=$t_url;?>" rel="countrycontainer">Sextuple</a></li>
	
</ul>



<script type="text/javascript">
	var countries=new ddajaxtabs("countrytabs", "countrydivcontainer")
	countries.setpersist(false)
	countries.setselectedClassTarget("link") //"link" or "linkparent"
	countries.init()
</script>
	   
	   
<? include("footer.ini.php"); ?>