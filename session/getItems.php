<?php
$query_inventory ="SELECT * FROM inventory where player_id = $player_id";
$queryResult_inventory= mysql_query($dbcon, $query_items);

$inventoryList = array(); // array para guardar todos os itens do array
$index_inventory = 0;

while($row = mysql_fetch_assoc($queryResult_inventory)){
    $inventoryList[$index_inventory] = $row;
    $index_inventory++;
}
?>