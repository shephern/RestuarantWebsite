<?php
	session_start();
	include '../scripts/connectdb.php';

	$offset = $_POST['offset'];
	$rid = $_POST['rid'];
	$next = 10  + $offset;
	$itt = 0;
	if(isset($offset) && isset($rid)) {
		$commResult = $mysqli->query("SELECT cid, rid, upVotes, downVotes, uid, comment FROM comments WHERE rid=$rid ORDER BY upVotes DESC LIMIT $offset, 10");
		while($commObj = $commResult->fetch_object()) {
       		echo '<div id="'.htmlspecialchars($commObj->cid).'">';
        	$commenterId = htmlspecialchars($commObj->uid);
           	$nameResult = $mysqli->query("SELECT username FROM users WHERE uid=$commenterId limit 1");
           	$commenter = $nameResult->fetch_object();
           	$cid = htmlspecialchars($commObj->cid);
   	       	echo '<strong>'.htmlspecialchars($commenter->username).':</strong><br>';
           	echo '<span style="white-space: normal";>'.htmlspecialchars($commObj->comment).'</span>';
           	if(isset($_SESSION["uid"]) && $_SESSION["uid"] != ""){
              	echo '<br><button type="button" onClick="return ajaxVote('.$cid.',1);" class="upButton" id="buttonUp'.$cid.'">';
              	echo '<div id="msgUp'.$cid.'">'.htmlspecialchars($commObj->upVotes).'</div></button>';
	       		echo '<button type="button" onClick="return ajaxVote('.$cid.', 0);" class="downButton" id="buttonDown'.$cid.'">';
              	echo '<div id="msgDown'.$cid.'">'.htmlspecialchars($commObj->downVotes).'</div></button>';
              	echo '<div id="msgErr'.$cid.'"></div>';
           }
           echo '</div><hr>';
           $itt++;
       	}
       	$commResult->close();
			}
	if($itt == 10) {
		echo '<div id="'.$rid.'more'.$next.'"><center><button type="button" onclick="return getMore('.$next.','.$rid.');">Show More</button></center><br></div>';
	}
  
?>