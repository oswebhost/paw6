<?	

include("config.ini.php");

include("function.ini.php");

$page_title="Blog Posting";
include("header.ini.php");

page_header("Blog Posting");


$temp = $eu->prepare("SELECT rid,date_format(date_posted,'%d-%b-%y') as dated,post_title from blog_post ORDER BY rid desc"); //ORDER BY rid desc limit 1");
$temp->execute();
$counts = $temp->rowCount();
$__row=0;


while ($dq = $temp->fetch()){
	$__row++;

	echo "<div style='padding:5px;font-size:12px;'>";
	echo $dq['dated'] ."&nbsp;&nbsp;&nbsp;<a class='sales' href='blogdetail.php?blogid=" . $dq['rid'] ."'>". stripslashes($dq['post_title']) . "</a>";
	echo "</div>";
	
}
?>





<? include("footer.ini.php"); ?>
	


