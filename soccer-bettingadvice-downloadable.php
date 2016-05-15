<?php

require_once("config.ini.php");
require_once("function.ini.php");
require_once("faq-class.php");

$page_title = "Downloadable Excel Files";
$active_mtab = 2 ;


require_once("header.ini.php");
page_header("Downloadable Excel Files");

?>



<div class='clear'></div>

<div class='faq' style="text-align: center;font-size:20px;padding-top:20px;">

<div class='faq-xlsdw'><a href='downloadxls/reinvesting_winnings.xlsx'>Reinvesting Winnings</a></div>


<div class='faq-xlsdw'><a href='downloadxls/Exotic_Betting_Downloadable_Spreadsheet_121015_Ver01.xls'>Exotic Betting Spreadsheets</a></div>

<div class='faq-xlsdw'><a href='downloadxls/Plateau_Staking_Calculations_25Oct12.xls'>Plateau Staking Plan</a></div>

</div>



<?php
	
	require_once("footer.ini.php"); 

?>