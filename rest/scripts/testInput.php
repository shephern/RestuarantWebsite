<?php
//Function taken from w3schools for data validation
//This just does simple escapes for malicious input
//Does not confirm type or size
function testInput($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>