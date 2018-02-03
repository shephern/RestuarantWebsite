<?php 
   $pagetitle = "Index ";
   include 'header.php';
?>

<article class="border">
    <h3 align="middle">Restaurants of Corvallis</h3>
    <section class="border">
        <table class="sortable">
            <caption></caption>
            <?php
            echo '<thead><tr><th>Restaurant</th><th>Rating</th><th>Service Rating</th><th>Quality Rating</th><th>Price Rating</th></tr><thead>';
            echo '<tbody>';
                if($result1 = $mysqli->query("SELECT rid, name, rate, service, quality, price, ServiceNum, QualityNum, PriceNum FROM restaurants ORDER BY name")) {
                    while($obj = $result1->fetch_object()){
                        echo '<tr align="middle">';
                        echo '<th><a href="'.$sitepath.'CommentsPage/#rest'.htmlspecialchars($obj->rid).'" class="restLinks">';
                        if($obj->ServiceNum + $obj->QualityNum + $obj->PriceNum === 0) {
                        	$avg = $avgSer = $avgQua = $avgPri = 0;
                        } else {
                        	$avgSer = $obj->service/$obj->ServiceNum;
							$avgQua = $obj->quality/$obj->QualityNum;
							$avgPri = $obj->price/$obj->PriceNum;
							$avg = $avgSer + $avgQua + $avgPri;
							$avg = $avg/3;
						}
                        echo htmlspecialchars($obj->name).'</a></th>';
                        echo '<td>'.round(htmlspecialchars($avg), 2).'</td>';
                        echo '<td>'.round(htmlspecialchars($avgSer), 2).'</td>';
                        echo '<td>'.round(htmlspecialchars($avgQua), 2).'</td>';
                        echo '<td>'.round(htmlspecialchars($avgPri), 2).'</td>';
                        echo '</tr>';
                    }
                    $result1->close();
                }
            echo '</tbody>';
            ?>
        </table>
    </section>
</article>





<?php include 'footer.php'; ?>