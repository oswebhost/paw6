<?php
  session_start();   
  ob_end_clean();    
  ob_start();


if (!isset($_SESSION['fullname']) or !isset($_SESSION['userid'])):
	header('Location: login.php');
	exit;
endif;

if (!isset($per_page)): $per_page=60; endif;

 include("config.ini.php");  
include("function.ini.php");

 $page_title="Payment History";



include("header.ini.php");

$userid = $_SESSION['userid'] ;
?>

<? echo page_header('Payment History');?>


<div style="padding-left:18px;padding-bottom:5px;padding-top:5px;">

</div>			
<div style='padding-left:10px;'>
	<a href='userinfo.php' class='sbar'>« Back</a>
</div>
<BR>
<div align='center'>


 <? echo $pageNav?>



 <table border="1" cellspacing="0" cellpadding="5" style="border-collapse: collapse" bordercolor="#0057C1" width="95%" >
  <tr bgcolor="#f4f4f4" height='25'>
	<td width="20%" class='ctd'><b>Date</b></td>
	<td width="30%" class='ctd'><b>Trans. Id</b></td>
	<td width="30%" class='ctd'><b>Comments</b></td>
	<td width="20%" class='ctd'><b>Amount</b></td>
  </tr>

<?

$query="SELECT userid,amount, currency, reference_no, date_format(paidon,'%d-%b-%Y') as paidon,comments from net_banx where userid='$userid' order by paidon desc";
$temp = $eu->prepare($query);
$temp->execute();

while ($row = $temp->fetch() ){
 $number++;
 $total += $row['amount'];
 $cur = $row['currency'] ;

?>
  <tr <?echo rowcol($number);?>>
	<td class='ctd' style='font-family:verdana;'><?echo $row['paidon'] ;?></td>
	<td class='ctd' style='font-family:verdana;'><?echo $row['reference_no'] ;?></td>
	<td class='ctd' style='font-family:verdana;'><?echo $row['comments'] ;?></td>
	<td class='ctd' style='font-family:verdana;'><?echo $cur ;?> <?echo num2($row['amount']) ;?></td>
  </tr>

<?}?>

 <tr bgcolor='#f4f4f4'>
	 <td class='rtd' colspan='3'><span class='credit'>T o t a l :</span></td>
	 <td class='rtd'><span class='credit'><?echo $cur ;?> <?echo num2($total); ?></span></td>
 </tr>



</table>

</div>	


<? include("footer.ini.php"); ?>