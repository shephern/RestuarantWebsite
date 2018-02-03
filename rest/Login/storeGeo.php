<?php
session_start();

$lat = $_POST['lat'];
$long = $_POST['long'];
$geo = $lat.','.$long;
if(isset($_SESSION['uid']) && $_SESSION['uid'] != ""){
	if(isset($lat) && isset($long)){
		if($lat != "" && $long != "") {
			// Valid lat and longitude
			$_SESSION['geo'] = $geo;
			echo 'Complete';
		}
	}
} else {
	echo 'Must login first.<br><button class="button1" type="button" onclick="return getLocation();">Locate</button>';
}
?>