
<?php
    $my_date = date('Y-m-d H:i:s');
    $qDate = ("UPDATE player set close_date = '".$my_date."' where player_id = ".$player_id."");
    $queryDate = mysqli_query($dbcon, $qDate);
?>   
