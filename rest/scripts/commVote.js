//******************
//Written by Nathan Shepherd
//Combined from programming at kstark and Isaac Price
//Function:  Sends request to recieveVote.php which saves
//           it in the database
//Input: 	 Number of comment id, direction of vote
//Output: 	 Sends JSON encoded post request to recieveVote.php
//******************
function ajaxVote(num, direction) {		
	var direc = '';
	if(direction == 1) {
		direc = 'Up';
	} else {
		direc = 'Down';
	}
	
	$('#msg'+direc+num).html('...');
	$.ajax({
		type:"post",
		url: "recieveVote.php",
		data: {'commid':num, 'direc':direction},
		cache: false,
		success: function(html){
			$('#msg'+direc+num).html(html);
			$('#buttonUp'+num).attr("disabled", true);
			$('#buttonDown'+num).attr("disabled", true);
		}
	});

	return false;
	}
