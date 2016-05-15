<?php
session_start();

include("config.ini.php");
include("function.ini.php");

$active_mtab = 2 ;

if (check_season('eu')=='1' and check_season('sa')=='1' ){ header('Location: commences.php'); exit; }

$page_title= 'Blank "EASE" Spreadsheet';

include("header.ini.php");




$errlog = "You will only be able to see the current week's data if you are <B><font color='blue'>logged in</font></B>.<br><B>To be able to <B>log in</B> you must be a fully subscribed member</B>.";

$sql ="select weekno, week_begin from setting"; 
$temp=$eu->prepare($sql);
$temp->execute();
$d2  =$temp->fetch();

page_header($page_title); 

//EASE BLANK Downloadables Wording 01Oct09.docx


  if (!isset($_SESSION["userid"])){ ?>
  
    <div class='errordiv' style='width:470px;margin:auto auto;text-align:center;border:1px solid #004E9B;'>
    <?    
        echo limited_asscess_message('eu');
        echo "</div>\n";
    } 
    
 

?>

<div style="padding-bottom:10px"></div>

<center>



<table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse" bordercolor="#004E9B" width="85%" >
<tr>
    <td colspan="2" bgcolor='#ECECFF' class="credit ctd"><?echo site('eu');?></td>
</tr>
<tr>
	<td width='30%' bgcolor='#ECECFF' align='center'  style='font-size:14px;height:40px;'>
	 <b><font color='blue'>Week <?php echo $d2["weekno"];?></font>  	
		<font size='1'><br><?php echo $d2["week_begin"];?></font></b>  
	</td>  
	
	<td width='70%' align='center'>
	<? if (isset($_SESSION["userid"])){ 
	    if (strlen($d2["weekno"])<2){
          $_week = "0" . $d2["weekno"];
       }else{
        $_week =  $d2["weekno"];
       }
       
    ?>
		 <b><a class='sbar' href='ease/eu/EASE-Blank_Week_<?php echo $_week ;?>.zip'><img src='images/download.jpg' border='0' alt='Download Excel File' /></a></b>
	<?}else{ ?>
		
		<b><a class='sbar' href="javascript:tell('old_ease.php');"><img src='images/download.jpg' border='0' alt='Download Excel File' /></a></b>

	<?}?>
	</td>
 </tr>
</table>

 
<br/>


<?php

	if (!isset($_SESSION["userid"])){ ?>
  
    <div class='errordiv' style='width:470px;margin:auto auto;text-align:center;border:1px solid #004E9B;'>
    <?    
        echo limited_asscess_message('sa');
        echo "</div>\n";
    } 
    
    
    
 	$chk_season=1;
    
    
    if (!isset($_SESSION["userid"])){ 
          if($chk_season==0){
                echo "<div class='errordiv' style='width:470px;margin:auto auto;text-align:center;border:1px solid #004E9B;'>";  
                echo limited_asscess_message('sa');
                echo "</div>\n";
        }
        
    }
    ?>
  


<div style="padding-bottom:10px"></div>


<?
$sql ="select weekno, week_begin from setting"; 
$temp=$sa->prepare($sql);
$temp->execute();
$d2  =$temp->fetch();
?>
<table border="1" cellpadding="6" cellspacing="0" style="border-collapse: collapse" bordercolor="#004E9B" width="85%" >
  <tr>
    <td colspan="2" bgcolor='#ECECFF' class="credit ctd"><?echo site('sa');?></td>
</tr>
<tr>
<?php 

	
    if($chk_season==0){ ?>
	
	<td class='ctd padd'>

		<b><a class='sbar' href="javascript:tell('old_ease_sa.php');"><img src='images/download.jpg' border='0' alt='Download Excel File' /></a></b>
		<br /> <br />
		<b></b> 
	</td>

<?}else{?>
  

	<td width='30%' bgcolor='#ECECFF' align='center'  style='font-size:14px;height:40px;'>
	<b><font color='blue'> <?php echo "Week " . $d2["weekno"];?></font> 	
		<font size='1'><br><?php echo $d2["week_begin"];?></font></b>  
	</td>  
	
	<td width='70%' align='center'>
	<? if (isset($_SESSION["userid"])){
	   
       if (strlen($d2["weekno"])<2){
          $_week = "0" . $d2["weekno"];
       }else{
        $_week =  $d2["weekno"];
       }
       
    ?>
		<b><a class='sbar' href='ease/sa/EASE-Blank_Week_<?php echo $_week;?>.zip'><img src='images/download.jpg' border='0' alt='Download Excel File' /></a></b> 
         
         
	<?}else{ ?>
		
		<b><a class='sbar' href="javascript:tell('old_ease_sa.php');"><img src='images/download.jpg' border='0' alt='Download Excel File' /></a></b>

	<?}?>
	</td>
<?}?>
 </tr>
</table>	
	
	

<p>Each of the spreadsheets found in this section is called the <span class='bb'>BLANK</span> "<B>EASE</B>" <B>Spreadsheet</B>, but they are anything but empty! </p>

<p>On the contrary, each spreadsheet contains a ton of data that is in fact the primary output from our Predict-A-Win computer Program's prediction run for the current week. That output data is precisely the same base material we use to make our selections for the Website postings "Segregated Selections" postings.</p>

<p>The purpose of the BLANK "EASE" Spreadsheet is simply to give you the chance to see, for 
	<B>any 6 matches of your choosing</B>, how the PaW Program's "Anticipated Score-Line" (ASL) as 
	posted on the Website is adjusted through "projecting" it to compensate for where (and to the extent that) 
	the performance of the 2 teams in each match has been found not to conform to the output from the 
	PaW Program's original algorithms.</p>

<p>From a comparison between the original ASL and the "Projected" score-line, and taking into account other key data readily visible on the spreadsheets, you can establish for yourself those 6 matches in which you have the greatest confidence about the final outcome.</p>

<p>The beauty of the BLANK "EASE" Spreadsheet is that you can try out any 6 match selections you prefer, and keep changing them until you have found the ones you are most comfortable with. </p>

<p>In effect then, if you use the BLANK "EASE" Spreadsheet properly, it will be very much like owning your own computer Program, except that we do all the hard work for you to keep it updated and maintained each week.</p>

<p>We provide the following guidance notes so you can see precisely how to get the most out of the BLANK "EASE" Spreadsheet:</p>


<div style="padding-top:15px;text-align:center;">

<a href="<?=$domain?>/ba/using-the-blank-ease-spreadsheets.php" class="prv">Using the "Blank" EASE Spreadsheet</a>

</div>


</center>

<? include("footer.ini.php");	


