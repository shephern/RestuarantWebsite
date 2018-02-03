<?php 
session_start();
    //Start cookie
    $restaurantIDomg =$_GET['restRid'];
    setcookie("ID",$restaurantIDomg, time()+3600);
     // Include php functions
    include 'scripts/currentUrl.php';
    include 'scripts/checkAuth.php';
    include 'scripts/connectdb.php';
    include 'scripts/getHost.php';
    include 'scripts/testInput.php';

?>

<!doctype html>
<html>

<head>
   <meta charset="utf-8"> 
   <?php 
     $sitename="Corvallis Cuisine"; 
     $sitedescription="";
     $sitepath="http://web.engr.oregonstate.edu/~shephern/rest/";
     $author="Peter Dorich, Michael Gillett, Andrew Rose, Drake Seifert, Nathan Shepherd";

    
  ?>
   <title><?php echo $pagetitle.$sitename.", ".$sitedescription; ?></title>

   <meta name="description" content="<?php echo $sitedescription; ?>">
   <meta name="author" content="<?php $author; ?>" />
   <meta name="keywords" content="" />

   <meta name="viewport" content="width=device-width, middle"/>

   <link rel="stylesheet" href="<?php echo $sitepath;?>scripts/Magnific-Popup/magPopup.css">
   <link rel="stylesheet" href="<?php echo $sitepath;?>main.css"/>
   <link href="https://fonts.googleapis.com/css?family=Limelight|Merriweather" rel="stylesheet" type="text/css"/>
   <link href='https://fonts.googleapis.com/css?family=Merriweather|Miltonian+Tattoo|Playfair+Display+SC:400,900' rel='stylesheet' type='text/css'/>
   <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet" />
   
</head>

<body>
<main>
  
<header>
  
<article id="top" class="border">
  <?php 
  $loggedinas = "";
  if((!isset($_SESSION["username"]) || !isset($_SESSION["uid"])) ||
  ($_SESSION["username"] == "" || $_SESSION["uid"] == "")) {
    $loggedinas = "";
  } else {
    $loggedinas = "Logged in as... ";
    $loggedinas .= $_SESSION["username"];
    $loggedinas .= ".";
  }
  echo "<p class='user'>$loggedinas</p>";
  ?>
  <img src="http://web.engr.oregonstate.edu/~shephern/rest/images/CC4.png" class="bannerImage">
  
</article>
<?php
 if(!isset($_SESSION['uid']) || $_SESSION['uid'] == "") {
  echo '<a href="'.$sitepath.'Login/login.php" class="login border">Login</a>';
} else {
  echo '<a href="" class="login border" id="location">Locate</a>';
  echo '<a href="'.$sitepath.'Logout/logout.php" class="login border">Logout</a>';
}
?>
<nav>
 
        <ul>
            <li><a href="<?php echo $sitepath;?>index.php" class="border navigation" data-speed="700">Home</a></li>
            <li><a href="<?php echo $sitepath;?>CommentsPage/index.php" class="border navigation" data-speed="600">Ratings/Comments</a></li>
        </ul>
</nav>

</header>


