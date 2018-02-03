<?php
//Function taken from philfreo on stackoverflow --> -->
//Parses  URL to display domain and host
function getHost($Address) {
  $parseUrl = parse_url(trim($Address));
  $returned = $domain = "";
  if(isset($parseUrl['host'])) {
    $returned = $parseUrl['host'];
  } else {
    $domain = explode('/', $parseUrl['path'], 2);
    $domain = array_shift($domain);
    $returned = $domain;
  }
  return $returned;
}
?>