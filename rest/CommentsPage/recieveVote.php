<?php
include '../scripts/connectdb.php';

$commentId = $_POST['commid'];
$direction = $_POST['direc'];


if(isset($commentId) && isset($direction)) {
	if(is_numeric($commentId) && is_numeric($direction)){
		if($direction == 1){
			$stmt = $mysqli->prepare("UPDATE comments SET upVotes = upVotes+1 WHERE cid = ?");
			$stmt->bind_param("i", $commentId);
			$stmt->execute();
			$stmt->close();
			$upResult = $mysqli->query("SELECT upVotes FROM comments WHERE cid=$commentId limit 1");
            $ups = $upResult->fetch_object();
            echo htmlspecialchars($ups->upVotes);
		} else if($direction == 0){
			$stmt = $mysqli->prepare("UPDATE comments SET downVotes = downVotes+1 WHERE cid = ?");
			$stmt->bind_param("i", $commentId);
			$stmt->execute();
			$stmt->close();
			$downResult = $mysqli->query("SELECT downVotes FROM comments WHERE cid=$commentId limit 1");
			$downs = $downResult->fetch_object();
			echo htmlspecialchars($downs->downVotes);
		} else {
			echo 'No vote made<br>';
		}
	}
}

?>