<?php
    $query_items =("SELECT * FROM item");
    $queryResult_items= @mysqli_query($dbcon, $query_items);
    
    $itemsNameF = array(); 
    $itemsPriceF = array();
    $itemsIdsF = array();
    $itemsValueF = array();
    $itemsPathF = array();

    $itemsNameM = array(); 
    $itemsPriceM = array();
    $itemsIdsM = array();
    $itemsValueM = array();
    $itemsPathM = array();

    $index_itemsF = 0;
    $index_itemsM = 0;

    while($row = mysqli_fetch_array($queryResult_items, MYSQLI_ASSOC)){
        if($row['Category'] == 'Food'){ // loop para guardar dados num array
            $itemsNameF[$index_itemsF] = $row['Name']; 
            $itemsPriceF[$index_itemsF] = $row['Price']; 
            $itemsIdsF[$index_itemsF] = $row['Item_Id'];
            $itemsValueF[$index_itemsF] = $row['Value']; 
            $itemsPathF[$index_itemsF] = $row['ImagePath']; 
            $index_itemsF++;
        }
        if($row['Category'] == 'Medicine'){ // loop para guardar dados num array
            $itemsNameM[$index_itemsM] = $row['Name']; 
            $itemsPriceM[$index_itemsM] = $row['Price']; 
            $itemsIdsM[$index_itemsM] = $row['Item_Id'];
            $itemsValueM[$index_itemsM] = $row['Value']; 
            $itemsPathM[$index_itemsM] = $row['ImagePath']; 
            $index_itemsM++;
        }
    }
?>