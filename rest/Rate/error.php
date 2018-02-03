<?php 
   $pagetitle = "Error";
   include '../header.php'; 
?>

<?php
$rid=$_GET['rid'];
?>
<article>
	<section>
		You've already left a rating for this restaurant. Multiple ratings are not allowed.
		<?php
		echo '<a href="http://web.engr.oregonstate.edu/~shephern/rest/CommentsPage/index.php#rest'.$rid.'">Return to Restaurant</a>';
		?>
	</section>
</article>

<?php include '../footer.php'; ?>
