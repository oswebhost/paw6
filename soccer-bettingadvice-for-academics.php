<?php

require_once("config.ini.php");
require_once("function.ini.php");
require_once("bettingadvice-class.php");

$page_title = "Betting Advice For Academics";
$show_key= meta_bettingadvice();
$desc = "This section is written especially for those interested in the theoretical side of making predictions for gambling purposes and who wish to exercise their brains in the process.";
$active_mtab = 1;

require_once("header.ini.php");
page_header($page_title);

?>
<header>
	<script type="text/javascript" src="javas/fancybox/lib/jquery-1.8.2.min.js"></script>
	<script type="text/javascript" src="javas/fancybox/source/jquery.fancybox.js?v=2.1.1"></script>
	<link type="text/css" rel="stylesheet" href="javas/fancybox/source/jquery.fancybox.css?v=2.1.1" media="screen" />

	<script type="text/javascript">
		$(document).ready(function() {
		$(".various").fancybox({
			maxWidth	: 700,
			maxHeight	: 600,
			fitToView	: false,
			width		: '70%',
			height		: '70%',
			autoSize	: false,
			closeClick	: false,
			openEffect	: 'none',
			closeEffect	: 'none'
		});
	});
	</script>
</header>


<div style='float:right;width:555px;padding:2px;border:1px solid #ccc;background:#f3f3f3;margin-bottom:20px;height:34px;'>

	<form method='post' action='bettingadvice-for-advanced-bettors.php'>
			<div style='float:left;width:450px;margin-top:3px;'>
				<font size='2'>Search:</font>
				<input type='text' style='width:380px;padding:3px;border:1px solid #ccc;' name='searchfor' value='<?php echo $_POST['searchfor'];?>' />
			</div>
			<div style='float:right;width:85px;margin-top:2px;'>
				<input type='submit' value='Search' class='bt' style='padding:2px 8px' />
			</div>
	</form>
</div>

<div class='clear'></div>


<div class='faq'>

<?php if (!isset($_POST['searchfor'])){  ?>



	<?php
		
		$catid = 3; //betting-advice-for Academics
	?>
		<ol>
			<?php 
			$tempQ = $eu->prepare("SELECT * FROM bettingadvice WHERE catid='$catid' ORDER BY rank");
			$tempQ->execute();
			while ($dq = $tempQ->fetch()){
			?>

			<li><a data-fancybox-type="iframe" class='various' href='bettingadvice-detail.php?id=<?php echo $dq['rid'];?>'><?php echo stripslashes($dq['question']);?></a></li>				

			<?php
			}
			?>	
		</ol>

<?php
}else{

		$string = '%' . trim($_POST['searchfor']) .'%';
		$temp = $eu->prepare("SELECT * FROM bettingadvice where question like '$string' or answer like '$string' ORDER BY question");
		$temp->execute();
		
		if ($temp->rowCount()>0){
			echo "<ol>\n";

			while ($d = $temp->fetch())	{
			?>

					<li><a data-fancybox-type="iframe" class='various' href='bettingadvice-detail.php?id=<?php echo $d['rid'];?>'><?php echo stripslashes($d['question']);?></a></li>				

			<?php
			}
			echo "</ol>\n";
			
		}else{
			
			echo "<div class='errordiv' style='text-align:center;width:200px;margin:auto auto;'>No match found.</div>\n";
		}		
			
	
} 

?>

</div>



<?php
	require_once("footer.ini.php"); 
?>