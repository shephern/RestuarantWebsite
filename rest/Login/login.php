<?php
 //This file is akin to scaffidc/skele4/login 
   $pagetitle = "Login/Register ";
   include '../header.php';
?>

<?php
$usernameErr = $passwordErr = $password2Err = $errorMsg = $success = "";
$username = $password = $password2 = "";
$loginErr = "";
$errorMsg = "";
$sendBackTo = isset($_REQUEST["sendBackTo"]) ? $_REQUEST["sendBackTo"] : "../index.php";
//Where is the user trying to get back to, after login
if(isset($_POST['action']) && $_POST['action'] == "login") {
    
    $loginErr = "";

    if (isset($_POST["username"]) && isset($_POST["password"])) {
        //User is trying to log in; if valid then redirect back to original page
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hashedPassword = base64_encode(hash('sha256',$password . $username));

        $query = $mysqli->prepare("SELECT uid FROM users WHERE username = ? and password = ?");
        $query->bind_param("ss", $username, $hashedPassword);
        if ($query->execute()) {
            $query->bind_result($uid);
            while($query->fetch()){
                //If any rows come back than login is valid
                $_SESSION["uid"] = $uid;
                $_SESSION["username"] = $username;
                $_SESSION["rates"] = 10;
                echo "<script>location.replace(".json_encode($sendBackTo).");</script>";
                exit();
            }
            $query->close();
        }
        $loginErr = "Invalid Login";
    }

} else if(isset($_POST['action']) && $_POST['action'] == "register") {
    
    if(empty($_POST["username"])) {
        $usernameErr = "Username is required";
    } else {
        $username = testInput($_POST["username"]);
        if(!preg_match("/^[a-zA-Z ]*$/", $username)){
            $usernameErr = "Only letters and spaces allowed";
            $errorMsg = "Please try again";
        }
    }

    if(empty($_POST["password"])) {
        $passwordErr = "Password is required";
        $errorMsg = "Please try again";
    } else {
        $password = testInput($_POST["password"]);
    }

    if($usernameErr == "" && $passwordErr == ""){
        $quer = $mysqli->prepare("SELECT uid FROM users WHERE username = ?");
        $quer->bind_param("s", $username);

        if($quer->execute()){
            $quer->bind_result($uid);
            if($quer->fetch()){
                $errorMsg = "That username is already taken";
                $usernameErr = "Please choose another";
            }
            $quer->close();
        }
    }

    if($errorMsg == "") {
        //Username is valid, insert into record
        $hashedPassword = base64_encode(hash('sha256', $password . $username));
        if( $stmt = $mysqli->prepare("INSERT INTO users (username, password) VALUES(?,?)")) {
            $stmt->bind_param("ss", $username, $hashedPassword);
            $stmt->execute();
            $stmt->close();
            $success = '<p>Created... You may now log in.</p>';
        } else {
            printf("Error: %s\n", $mysqli->error);
        }
    }
}

?>

<html>
<article class="border">
    <section>
        <div id="space1" class="border" style="background-color: rgba(250,245,107,.30)">
       <h3>&nbsp&nbspLog in</h3>
    	<form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="inform" autocomplete="off">
            <ul> 
            <li><label>Username:</label><br>
            <input type="text" name="username" placeholder="Username" size=8 maxlength=64>
            <li><label>Password:</label><br>
            <input type="password" name="password" placeholder="********" size=8 maxlength=64>
            <li><input type="hidden" name="action" value="login">
            <li><input type="submit" class="button1" value="Login">
            <span class="error"><?php echo $loginErr; ?></span>
            <br><br><br>
            </ul>

            <input type="hidden" name="sendBackTo" value="<?= htmlspecialchars($sendBackTo) ?>">
        </form>
    </div>

    <div id="space2" class="border" style="background-color: rgba(250,245,107,.30)">
        <h3>&nbsp&nbspRegister</h3>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" class="inform" autocomplete="off">
        <ul>
        <li><label>Username:</label><br>
        <input type="text" name="username" placeholder="Username" size=8 maxlength=64><span class="error"> <?php echo $usernameErr;?></span>
        <li><label>Password:</label><br>
        <input type="password" name="password" placeholder="********" size=8 maxlength=64><span class="error"> <?php echo $passwordErr;?></span>
        <li><label>Verify Password:</label><br>
        <input type="password" name="password2" placeholder="*********" size=8 maxlength=64><span class="error"><?php echo $password2Err;?></span>
        <li><input type="hidden" name="action" value="register">
        <li><input class="button1" type="submit" value="Register">
        <?php echo $success;?>
        <span class="error"><?php echo $errorMsg; ?></span>
        <br>
        </ul>
        </form>
    </div>
    

    </section>
</article>




<?php include '../footer.php'; ?>