<?php 
   $pagetitle = "Locales: ";
   include '../header.php'; 
?>


<div class="dropdown border">
  <button onclick="myFunction()" class="dropbtn">Restaurants</button>
  <div id="myDropdown" class="dropdown-content">
    <?php
    	if($result = $mysqli->query("SELECT rid, name FROM restaurants ORDER BY name")) {
    		while($obj = $result->fetch_object()) {
    			echo "<a href=".'"#rest'.htmlspecialchars($obj->rid).'">'.htmlspecialchars($obj->name)."</a>";
    		}
    	}
    ?>
  </div>
</div>

<article class="upHome border" align="middle">
<a href="#top" class="commentNav"><i class="material-icons">keyboard_arrow_up</i></a>
<a href="<?php echo $sitepath;?>index.php" class="commentNav"><i class="material-icons">home</i></a>
<a href="<?php echo $sitepath;?>Login/login.php" class="commentNav"><i class="material-icons">contacts</i></a>

</article>

<?php
$curRest = "";
$commenter = "";
$commenterId = "";
$restName = "";
if($result = $mysqli->query("SELECT rid, name, phone, hours, street, city, state, zipCode, geoNorth, geoWest, URL, picURL, genre, rate, service, quality, price, ServiceNum, QualityNum, PriceNum, rateNum, commNum FROM restaurants ORDER BY name")) {
    while($obj = $result->fetch_object()) {
        $curRest = $obj->rid;
        $restName = htmlspecialchars($obj->name);
		echo '<article id='.'"rest'.htmlspecialchars($obj->rid).'"'.' class="border commentsArticle">';
		echo '<section class="border comment1" style="height: 98%;">';
        
        echo '<div id="space1">';
        echo '<div style="width: 100%; height: 40%;">';
        echo '<img src='.'"../images/Restaurant_Pictures/'.$curRest.'.jpg" style="height: 100%; float: left;">';
        echo '</div>';
        echo '<pre>';
	if($obj->ServiceNum + $obj->QualityNum + $obj->PriceNum === 0) {
		echo 'No ratings <br>have been made.<br><a href="../NewRate/index.php?ridNumber='.$restName.'&rid='.$curRest.'">Rate here!</a>';
	} else {
		$avgSer = $obj->service/$obj->ServiceNum;
		$avgQua = $obj->quality/$obj->QualityNum;
		$avgPri = $obj->price/$obj->PriceNum;
		$avg = $avgSer + $avgQua + $avgPri;
		$avg = $avg/3;
		echo ' Rate:    '.round(htmlspecialchars($avg), 2).'<br>'; 
 		echo ' Service: '.round(htmlspecialchars($avgSer), 2).'<br>';
        echo ' Quality: '.round(htmlspecialchars($avgQua), 2).'<br>';
		echo ' Price:   '.round(htmlspecialchars($avgPri), 2).'<br>';
        echo '<a href="../NewRate/index.php?ridNumber='.$restName.'&rid='.$curRest.'">Rate here!</a>';
	}
		echo '<br>';
		echo htmlspecialchars($obj->street).'<br>';
		echo htmlspecialchars($obj->city).",".htmlspecialchars($obj->state).'<br>';
		echo htmlspecialchars($obj->zipCode).'<br>';	
		echo '</pre></div>';
		echo '<div id="space2">';
		echo '<pre>';
        echo '<span style="white-space: normal";><strong>'.htmlspecialchars($obj->name).'</strong></span><br>';
		echo htmlspecialchars($obj->genre).'<br>';
		echo htmlspecialchars($obj->hours).'<br>';
		echo '<a href="'.htmlspecialchars($obj->URL).'" title="'.htmlspecialchars(getHost($obj->URL)).'" target="_blank">';
        echo 'Website Here</a><br>';
		echo htmlspecialchars($obj->phone).'<br>';
        if(isset($_SESSION["geo"])) {
		  echo '<br>'.'<a class="pop'.$curRest.'" href="https://maps.google.com/maps?&amp;t=m&amp;saddr='.htmlspecialchars($_SESSION["geo"]).'&amp;daddr='.htmlspecialchars($obj->name).'&amp;">Map</a>'.'<br>';
        } else {
          echo '<br>'.'<a class="pop'.$curRest.'" href="https://maps.google.com/maps?&amp;t=m&amp;q='.htmlspecialchars($obj->name).'&amp;">Map</a>'.'<br>';
        }
		echo '</pre></div></section>';
        echo '<section class="border comment2" style="height: 98%;">';
        if(!isset($_SESSION["uid"]) || $_SESSION["uid"] == "") {
        	echo '<h3><center><a href="../Login/login.php">Log in</a> to rate<br>and comment.</center></h3><hr>';
        } else {
            $nameComm = $_SESSION["username"];
            echo '<div id="form'.$curRest.'">';
            echo '<strong><u>'.htmlspecialchars($nameComm).':</u></strong><br>';
            echo '<textarea name="comment" rows="4" cols="44" id="text'.$curRest.'"></textarea><br>';
            echo '<div id="comButton'.$curRest.'">';
            echo '<button class="commButton" type="button" onClick="return ajaxComm('.$curRest.','.$_SESSION["uid"].');">Comment</button></div>';
            echo '</div>';
            echo '<hr>';
        }
        $commResult = $mysqli->query("SELECT cid, rid, upVotes, downVotes, uid, comment FROM comments WHERE rid=$curRest ORDER BY upVotes DESC LIMIT 10");
		if($obj->commNum != 0) {
            while($commObj = $commResult->fetch_object()) {
            	echo '<div id="'.htmlspecialchars($commObj->cid).'">';
                $commenterId = htmlspecialchars($commObj->uid);
                $nameResult = $mysqli->query("SELECT username FROM users WHERE uid=$commenterId limit 1");
                $commenter = $nameResult->fetch_object();
                $cid = htmlspecialchars($commObj->cid);
                if(isset($_SESSION["uid"]) && $_SESSION["uid"] == $commenterId) {
                    echo '<strong><u>'.htmlspecialchars($commenter->username).':</u></strong><br>';
                    // Add a delete button if user wants to delete their comment.
                } else {
                    echo '<strong>'.htmlspecialchars($commenter->username).':</strong><br>';
                }
                $nameResult->close();
                echo '<span style="white-space: normal";>'.htmlspecialchars($commObj->comment).'</span>';
                if(isset($_SESSION["uid"]) && $_SESSION["uid"] != ""){
                	echo '<br><button type="button" onClick="return ajaxVote('.$cid.',1);" class="upButton" id="buttonUp'.$cid.'">';
                	echo '<div id="msgUp'.$cid.'">'.htmlspecialchars($commObj->upVotes).'</div></button>';
		        	echo '<button type="button" onClick="return ajaxVote('.$cid.', 0);" class="downButton" id="buttonDown'.$cid.'">';
                	echo '<div id="msgDown'.$cid.'">'.htmlspecialchars($commObj->downVotes).'</div></button>';
                	echo '<div id="msgErr'.$cid.'"></div>';
                }
                echo '</div><hr>';
            }
            $commResult->close();
            echo '<div id="'.$curRest.'more10"><center><button type="button" onClick="return getMore(10,'.$curRest.');">Show More</button><center><br></div>';
        }
        
        echo '</section>';
		echo '</article>';

	}
    $result->close();
}

?>

<?php include '../footer.php'; ?>