//***************************
// Written by Nathan Shepherd
// Function:  Load more comments for a specific rid
// Input:     Offset set to each 10, rid of restaurant
// Output:    On button click, changes div moreOffset to next group of comments
//***************************
function getMore(offset, rid) {
	$('#'+rid+'more'+offset).html('Loading...');
	$.ajax({
		type: "post",
		url: "get.php",
		data: {'offset':offset, 'rid':rid},
		cache: false,
		success: function(html){
			$('#'+rid+'more'+offset).html(html);
		} 
	});
	return false;
}
