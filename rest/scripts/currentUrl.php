<?php
//Collects the current url
//returns it in a char string
//Copied by NES, from scaffidc 1/29/16
function currentUrl(){
    $pageURL = 'http';

    if (isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] == "on"){
        $pageURL .= "s";
    }
    $pageURL .= "://";
    if ($_SERVER["SERVER_PORT"] != "80") {
        $pageURL .= $_SERVER["SERVER_NAME"].":".$_SERVER["SERVER_PORT"].$_SERVER["SCRIPT_NAME"];
    } else {
        $pageURL .= $_SERVER["SERVER_NAME"].$_SERVER["SCRIPT_NAME"];
    }
    return $pageURL;
}
?>