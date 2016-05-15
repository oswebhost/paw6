<?php

$page_title="About Soccer Predictions";

include("config.ini.php");
include("function.ini.php");
include("header.ini.php");


$page_title="About Us";

?>


<div class='hypebox'  style='width:582px;margin:0px auto 0 auto;'>
  <div class='div_top520'></div>
    <div class='div_mid520' style="line-height: 140%;">
	<font style="font-size:18px;color:blue;"><strong>Spend Some Xmas Money On Yourself!</strong></font> 
	<div class='spacer'></div>
	<div style='width:40px;float:left;'>
		<img src='images/Hourglass_rotates.gif' border='0' alt='Xmas Money' height='70' >
	</div>
	 <div style="padding-top:0px;padding-left:80px; padding-right:20px;text-align:justify;font-size:15px;">
Please be reminded that you will only be able to get free access to our Services until <b>31 December 2015</b>, after which you will be required to pay. We are offering an <span class='bb'>Early Bird discount</span>, and if you wish to take advantage of this then please visit our <a href="payment_options.php" class="bb">Subscribe Page</a> now to see what is on offer.
<div class='spacer'></div>

	</div>
    <div class='div_bottom520'></div>
</div>
</div>





<?php include("footernew.ini.php"); 

function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}



?>