<?php

include("config.ini.php");
include("function.ini.php");

$id = $_GET['blogid'];

$qry = "select * from blog_post where rid='$id'";
$main_blogid = $id;

$temp= $eu->prepare($qry);
$temp->execute();
$data = $temp->fetch();
 
$page_title = stripslashes($data['post_title']);

$img = strtolower(trim($data['post_image']));

include("header.ini.php");
page_header($page_title);


if (strlen($img)>0){
	
	echo "<center><img src='blog_images/$img' border='0'></center>";
}

?>

<style>
	.myexplain p {font-family: 'times new roman'; font-size:16px; line-height:130%}
</style>




<p class='newp'><?php echo stripslashes($data['post_full']); ?></p>

<div class='post_bar'>
	
</div>

<div id="fb-root"></div>
<script src="http://connect.facebook.net/en_US/all.js#xfbml=1"></script>



<div class="fb-comments" data-href="http://soccer-predictions.com/blogdetail.php?blogid=<?php echo $id;?>" data-numposts="10" data-colorscheme="light"></div>
	
<? include("footer.ini.php"); ?>