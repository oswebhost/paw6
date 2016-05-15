<?
$show_key =1 ;
    session_start(); 
	

    if ($_GET['ref']=='YM'){
        $_SESSION['ref'] = $_GET['ref'];
    }

	if (!isset($_SESSION['db'])){  // EU off season
		$_SESSION['db'] = "eu";
	}	

    
    
    
    include("config.ini.php");
    include("function.ini.php");
    include("reguser.php");
    
    $show_key= meta_index() . meta_football() . meta_freepred() ;
    $show_key2 = 1;
    $page_title = "Free Soccer Predictions Data";
    
    include("header.ini.php");


/*  
    Updated: 27-mar-2013
    
    Page 1 Alternatives rev 09 (27Feb13)
    page 7
    27-feb-2013
*/



$tmp = $sa->prepare('select week_begin from setting');
$tmp->execute();
$ddd = $tmp->fetch();
$week_perid = $ddd['week_begin'];



?>

     
	
<div class="salespage" style="margin-top:2px;">

<?php include("hypes/2014-2015/main-msg.html"); ?>






<table border="0">

	<tr>
		<td colspan='3'> <a class='none' href="javascript:bigwin('<?php echo $domain;?>/soccer-predictions-analysis-tool.php?<?php echo $toolurl;?>')"><img src='images/new_big_SoccerPat01.jpg' border='0' alt="Soccer Selections Analysis Tool"></a> </td>
	</tr>

	<tr>
	   
		<td valign="top" colspan='3'>
		   
		<div style="padding-left: 0px;padding-top:16px;">
		  <iframe width="580" height="310" src="//www.youtube.com/embed/DljZBuWIgEA" frameborder="0" allowfullscreen></iframe>
		</div>
		
		<div style="padding-left: 0px;padding-top:16px;">
		  <iframe width="580" height="310" src="//www.youtube.com/embed/Y42pJ0Z0hFw" frameborder="0" allowfullscreen></iframe>
		</div>
		</td>
	  
	</tr>
	<tr>	
		<td colspan='3' style ="padding-top:16px;"> </td>
	</tr>
	<tr>
		<td valign="top" style='width:280px;border:0px solid #ccc;background:#f4f4f4;padding:3px;'>
			<!-- <iframe src="mynews2.php" style="border:0;height:280px;width:270px"></iframe> --?>
		
		</td>
		
		<td style='width:20px'>&nbsp;&nbsp;</td>
		<td valign="top" style='width:280px;border:1px solid #ccc;background:#f4f4f4;padding:3px;'>	    
			<!-- <iframe src="mynews-sa2.php" style="border:0;height:280px;width:270px"></iframe> -->
		</td>
		
	   </tr>
   
</table>


<div class="clear"></div>




</div>

<p style='margin-top:1px;padding-top:0'>&nbsp;&nbsp;</p>


<?php //include("freeprediction-index.php"); ?>



<? 


 include("footerv5.ini.php"); 
 
 	
function show_odd($value)
{
  if ($value>0): 	return "$value" ; else: 	return '';  endif;
}
?>