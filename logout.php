<?php
#############################################################
## Written by: Imran Khan (imran@1os.us)                   ## 
## Company: BetWare Ltd,1os.us,Predict-a-Win.com/us/co.uk  ##
#############################################################
session_start();
//ob_end_clean();
ob_start();
session_destroy();
echo "";
@header("Location: index.php") ;
?>
