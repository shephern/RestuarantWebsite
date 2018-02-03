<?php
//Returns users uid if logged in
//Else wise returns "", in this case, pass $redirectIfNeeded = true to force login
//Copied by NES, from scaffidc 1/29/16
function checkAuth($redirectIfNeeded) {
    //Is user already logged in
    if (isset($_SESSION["uid"]) && $_SESSION["uid"] != "") {
        //yes, already logged in?
        return $_SESSION["uid"];
    } else if ($redirectIfNeeded) {
        //User is not logged in and needs to do so
        //Send to login page

        //Passes $pageURL so that we can come back after login
        $currentURL = currentURL();

        //rawurlencode converts the string so it's safe to pass as a URL GET parameter
        $urlOfLogin = "http://web.engr.oregonstate.edu/~shephern/rest/Rate/notLogged.php";

        //scaffidc says:
            # use a JavaScript redirect; FYI, there's also an http header (Location:) that 
            # can be used to redirect, but that MUST be sent before any HTML, and this 
            # function (checkAuth) might be called after some HTML is sent
        echo "<script>location.replace('$urlOfLogin');</script>";
        return "";
    } else {
        //User is not logged in, but whoever called the function doesn't care
        return "";
    }
}
?>