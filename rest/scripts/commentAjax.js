//*****************
//Written by Nathan Shepherd
//Function:   Sends request to recieveComment.php
//			  which saves it in the database
//*****************
function ajaxComm(num, uid){
	$('#comButton'+num).html('Processing...');
	var text = document.getElementById('text'+num).value;
	if( text === ""){
		$('#comButton'+num).html('Please leave a comment.<button class="commButton" type="button" onClick="return ajaxComm('+num+','+uid+');">Here</button>')
		return false;
	} else {
		$.ajax({
			type: "post",
			url: "recieveComment.php",
			data: {'rid':num, 'uid':uid, 'comment': text},
			cache: false,
			success: function(html){
				$('#form'+num).html(html);
			}
		});
	}
	return false;
}
