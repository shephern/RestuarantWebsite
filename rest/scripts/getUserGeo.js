//*********************
// Written by Nathan Shepherd
// Function:  Get users address, store it in the session
//*********************
function getLocation() {
	if(navigator.geolocation) {
		navigator.geolocation.getCurrentPosition(storePosition);
	} else {
		$('#location').html('Not supported.');
	}		
}

function storePosition(pos) {
	var lat = pos.coords.latitude;
	var long = pos.coords.longitude;
	$('#location').html('Processing...');
	$.ajax({
		type: "post",
		url: "http://web.oregonstate.edu/~shephern/rest/Login/storeGeo.php",
		data: {'lat':lat, 'long':long},
		cache: false,
		success: function(html){
			$('#location').html(html);
		}
	});
}