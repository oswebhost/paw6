<?php
 if ($_Blog_id>0){
 	$qry = "select * from blog_post where post_posted='1' and rid='$_Blog_id'";	
 }else{
 	$qry = "select * from blog_post where post_posted='1'  order by rid desc limit 1";
 }		
 
 
 $temp= $eu->prepare($qry);
 $temp->execute();
 
 

?>






	<?php 
		while ($data = $temp->fetch()){
			$main_blogid = $data['rid'];
			$img = trim($data['post_image']);
			
			$jp = substr($img,strlen($img)-4);
			$img= substr($img,0, strlen($img)-4);	
			
	?>		
		<div class='indexblog' style='padding:0px;width:578px;'>
			<img src='blog_images/<?php echo $img ."_01". $jp;?>' border='0'  align='left' style='margin-right:15px;width:160px;height:141px;' alt='<?php echo stripslashes($data['post_title']); ?>'>
			<h1><a href='blogdetail.php?blogid=<?php echo $data['rid']; ?>'><?php echo stripslashes($data['post_title']); ?></a></h1>
			<p style='padding:5px;line-height:140%;text-align:left;'><?php echo stripslashes($data['post_short']); ?>&nbsp;<b><a href='blogdetail.php?blogid=<?php echo $data['rid']; ?>'>more...</a></b></p>
			
			<div class='clear'></div>
		</div>
		
	<?php }?>
	


