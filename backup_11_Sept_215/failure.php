<?php	
session_start();

include("config.ini.php");

include("function.ini.php");

include("header.ini.php");



page_header("Sorry!") ;
	echo "<center> <br><br><br><br><br> 
	
			<div class='error_div'>
				  <font size='+1'>Transactions failed.</font>
			</div>
		  </center>";



include("footer.ini.php"); 


?>
