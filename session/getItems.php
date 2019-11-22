<?php
$query_inventory ="SELECT * FROM inventory where player_id = $player_id";
$queryResult_inventory= mysql_query($dbcon, $query_items);

$inventoryList = array(); // make a new array to hold all your data
$index_inventory = 0;

while($row = mysql_fetch_assoc($queryResult_inventory)){ // loop to store the data in an associative array.
    $inventoryList[$index_inventory] = $row;
    $index_inventory++;
}
?>