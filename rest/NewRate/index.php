<?php 
   $pagetitle = "Rate: ";
   include '../header.php'; 
?>

<?php
checkAuth(TRUE);
$restName = $_GET['ridNumber'];
$curRest = $_GET['rid'];

$conn = new mysqli( $hostname, $dbsevername, $dbpassword, $dbusername);
if($conn->connect_error){
      die("Connection failed: " . $conn->connect_error);
    }
$user=$_SESSION["uid"];

if($result = $mysqli->query("SELECT uid FROM ratingsCheck ORDER BY rid")) {
	while($obj = $result->fetch_object()) {
    $compUser=$obj->uid;
      	if($compUser==$user){
       		if($result = $mysqli->query("SELECT rid FROM ratingsCheck ORDER BY rid")) {
         		while($obj = $result->fetch_object()){
           		$compRest=$obj->rid;
           		if($compRest==$curRest){
         				$urlOfLogin = "http://web.engr.oregonstate.edu/~shephern/rest/Rate/error.php";
         				echo '<script>
         				window.location = "http://web.engr.oregonstate.edu/~shephern/rest/Rate/error.php?rid='.$curRest.'"
         				</script>';
    			}
  			}
			} 
		}
	}
}

if(isset($_POST['submit1'])){
$service=$_POST['rating-input-1'];
$quality=$_POST['rating-input-2'];
$price=$_POST['rating-input-3'];

$sql="UPDATE restaurants SET service=service+$service WHERE name='$restName'";
      if ($conn->query($sql) === TRUE) {
    echo "";
  } else {
    echo "fail" . $conn->error;
  }


 $sql="UPDATE restaurants SET ServiceNum=ServiceNum+1 WHERE name='$restName'";
    if ($conn->query($sql) === TRUE) {
    echo "";
} else {
  echo "fail" . $conn->error;

}

$sql="UPDATE restaurants SET quality=quality+$quality WHERE name='$restName'";
      if ($conn->query($sql) === TRUE) {
    echo "";
  } else {
    echo "" . $conn->error;
}

     $sql="UPDATE restaurants SET QualityNum=QualityNum+1 WHERE name='$restName'";
    if ($conn->query($sql) === TRUE) {
    echo "";
} else {
  echo "" . $conn->error;
}

    $sql="UPDATE restaurants SET price=price+$price WHERE name='$restName'";
      if ($conn->query($sql) === TRUE) {
    echo "";
  } else {
    echo "" . $conn->error;
  }

       $sql="UPDATE restaurants SET PriceNum=PriceNum+1 WHERE name='$restName'";
    if ($conn->query($sql) === TRUE) {
    echo "";
} else {
  echo "" . $conn->error;
}

$sql="INSERT INTO ratingsCheck (rid,uid) VALUES ('$curRest','$user')";
     if ($conn->query($sql) === TRUE) {

    echo "";
} else {
  echo "" . $conn->error;
}

mysqli_query($conn,"UPDATE restaurants SET rate=(service+quality+price)/(ServiceNum+QualityNum+PriceNum) WHERE name='$restName'");

echo "<article align=middle>Thanks for rating!!!</article>";
echo '<script type="text/javascript">
  window.setTimeout(function(){window.location = "http://web.engr.oregonstate.edu/~shephern/rest/CommentsPage/index.php"}, 3000);</script>';
          }
?>
<article>
  <section>
    <h1>Please provide a rating for each category.</h1>
<form name="subform" method="post" action="">

<span class="rating">
        <p>Service:  </p>    
        <input type="radio" class="rating-input"
            id="rating-input-1-5" name="rating-input-1" value="5">
        <label for="rating-input-1-5" class="rating-star"></label>
        <input type="radio" class="rating-input"
            id="rating-input-1-4" name="rating-input-1" value="4">
        <label for="rating-input-1-4" class="rating-star"></label>
        <input type="radio" class="rating-input"
            id="rating-input-1-3" name="rating-input-1" value="3">
        <label for="rating-input-1-3" class="rating-star"></label>
        <input type="radio" class="rating-input"
            id="rating-input-1-2" name="rating-input-1" value="2">
        <label for="rating-input-1-2" class="rating-star"></label>
        <input type="radio" class="rating-input"
            id="rating-input-1-1" name="rating-input-1" value="1">
        <label for="rating-input-1-1" class="rating-star"></label>
    </span>
<br>
<span class="rating">
        <p>Quality:  </p>  
        <input type="radio" class="rating-input2"
            id="rating-input-2-5" name="rating-input-2" value="5">
        <label for="rating-input-2-5" class="rating-star2"></label>
        <input type="radio" class="rating-input2"
            id="rating-input-2-4" name="rating-input-2" value="4">
        <label for="rating-input-2-4" class="rating-star2"></label>
        <input type="radio" class="rating-input2"
            id="rating-input-2-3" name="rating-input-2" value="3">
        <label for="rating-input-2-3" class="rating-star2"></label>
        <input type="radio" class="rating-input2"
            id="rating-input-2-2" name="rating-input-2" value="2">
        <label for="rating-input-2-2" class="rating-star2"></label>
        <input type="radio" class="rating-input2"
            id="rating-input-2-1" name="rating-input-2" value="1">
        <label for="rating-input-2-1" class="rating-star2"></label>
    </span>
<br>
<span class="rating">
        <p>Price:  </p>   
        <input type="radio" class="rating-input3"
            id="rating-input-3-5" name="rating-input-3" value="5">
        <label for="rating-input-3-5" class="rating-star3"></label>
        <input type="radio" class="rating-input3"
            id="rating-input-3-4" name="rating-input-3" value="4">
        <label for="rating-input-3-4" class="rating-star3"></label>
        <input type="radio" class="rating-input3"
            id="rating-input-3-3" name="rating-input-3" value="3">
        <label for="rating-input-3-3" class="rating-star3"></label>
        <input type="radio" class="rating-input3"
            id="rating-input-3-2" name="rating-input-3" value="2">
        <label for="rating-input-3-2" class="rating-star3"></label>
        <input type="radio" class="rating-input3"
            id="rating-input-3-1" name="rating-input-3" value="1">
        <label for="rating-input-3-1" class="rating-star3"></label>
    </span>
<br>
    <input id="rateSubmit" type="submit" name="submit1" value="Rate">

</form>





</section>

</article>

<?php include '../footer.php'; ?>