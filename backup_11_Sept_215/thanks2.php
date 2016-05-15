<?php
session_start();
$userid = $_GET['name']; 		
session_destroy(); 

include("config.ini.php");
include("function.ini.php");

$page_title =  "Thank You " ;

include("header.ini.php");


page_header("Thank You");  
?>


<div class="salespage2" style="margin-top:2px;padding-left:25px;padding-right:20px;">




<p style="font-size:14px;;margin-top:10px"><br><br>


Your membership is comfirmed now.  <br/><br/>


 If you haven't white-listed "admin@soccer-predictions.com" as an acceptable email address, then our message may be in your junk box.



<br/>
<br/>
Many thanks,<br>
Woz Salmon

</div>


<?php include("footer.ini.php"); ?>