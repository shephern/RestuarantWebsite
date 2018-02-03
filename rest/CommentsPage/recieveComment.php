<?php
include '../scripts/connectdb.php';

$curRest = $_POST['rid'];
$userId = $_POST['uid'];
$text = $_POST['comment'];
$reply = "";
$err = 0;
if(isset($curRest) && isset($userId)) {
	if($checkResult = $mysqli->query("SELECT uid FROM commentsCheck WHERE rid=$curRest")) {
		while($checkObj = $checkResult->fetch_object()) {
			if($userId == $checkObj->uid) {
				//User has already entered comment
				$reply = '<center>You have already entered<br>a comment.</center>';
				$err = 1;
				break;
			}
		}
	}
	//User has not entered comment
	if($err === 0) {
		$err = 0;
		//Clean it
		$text = trim($text);
		$text = stripslashes($text);
		$text = htmlspecialchars($text);
		$curRest = htmlspecialchars($curRest);
		$userId = htmlspecialchars($userId);
	//Enter it into the database
		//Enter check into database, for double commenters
		if($checkstmt = $mysqli->prepare("INSERT INTO commentsCheck (rid, uid) VALUES (?,?)")) {
			$checkstmt->bind_param("ii", $curRest, $userId);
			$checkstmt->execute();
			$checkstmt->close();
		} else {
			$err = 1;
		}
		//Increment restaurant commNum
		if($commstmt = $mysqli->prepare("UPDATE restaurants SET commNum = commNum + 1 WHERE rid= ?")) {
			$commstmt->bind_param("i", $curRest);
			$commstmt->execute();
			$commstmt->close();
		} else {
			$err = 1;
		}
		//Enter it into actual comment database
		if($stmt = $mysqli->prepare("INSERT INTO comments (rid, upVotes, downVotes, uid, comment) VALUES (?,?,?,?,?)")) {
			$stmt->bind_param("iiiis", $curRest, $votes, $votes, $userId, $text);
			$votes = 0;
			$stmt->execute();
			$stmt->close();
		} else {
			$err = 1;
		}

		if($err === 0){
			$reply = '<center>Thanks for your<br>contribution.</center>';
		} else {
			$reply = '<center>There was an unforseen error.</center>';
		}
		
	}
}
echo $reply;
?>