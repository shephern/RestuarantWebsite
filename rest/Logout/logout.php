<?php 
   $pagetitle = "Logout ";
   include '../header.php'; 
?>

<?php
	$success = "";
	if(isset($_POST['action']) && $_POST['action'] == 'logout') {
		$_SESSION['uid'] = "";
		$success = "You are logged out. Thank you.";
	}
?>

<article class="border">
    <section class="border">
    <ul>
    	<h4>Logout</h4>
    	<p>Are you ready to logout?</p>
    	<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method='post' class="inform">
    		<input type="hidden" name="action" value="logout">
    		<input type="submit" class="button1" value="Logout">
    	</form> 
    	<br>
    	<?php echo $success;?>
    	<br>
    </ul>
    </section>
</article>




<?php include '../footer.php'; ?>