<?php 
	require ('session/mysql_connection.php');
	session_start() ;
	// REDIRECIONAR CASO NÃO O LOGIN NÃO TENHA SIDO FEITO
	if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
	require ( 'session/login_functions.php' ) ; load() ; }

	$player_id = $_SESSION[ 'player_id' ] ;
	include ( 'includes/getNeeds.php' );



	if(isset($_POST["newValue"]) && isset($_POST["itemID"])){
		$newValue = $_POST["newValue"];
		$itemID = $_POST["itemID"];

		$q = ("UPDATE pet SET Health = ".$newValue." WHERE player_id = ".$player_id."");
		$result = @mysqli_query($dbcon, $q);

		$q1 = ("UPDATE inventory SET quantity = quantity - 1 WHERE player_id = ".$player_id." and item_id = ".$itemID."");
		$result1 = @mysqli_query($dbcon, $q1);

		$q3 = ("UPDATE pet SET experience = experience + 1.5  WHERE player_id = ".$player_id."");
		$result3 = @mysqli_query($dbcon, $q3);

	  }



	$query_items =("SELECT Quantity, item.Item_Id, inventory.player_id, category, item.Value, ImagePath FROM inventory inner join item on inventory.Item_Id = item.Item_Id WHERE category = 'Medicine' and player_id=".$player_id."");
	$queryResult_items= @mysqli_query($dbcon, $query_items);
	
    $itemsIdsM = array();
    $itemsValueM = array();
	$itemsPathM = array();
	$itemsQuantM = array();

    $index_itemsM = 0;

    while($row = mysqli_fetch_array($queryResult_items, MYSQLI_ASSOC)){
            $itemsIdsM[$index_itemsM] = $row['Item_Id'];
            $itemsValueM[$index_itemsM] = $row['Value']; 
			$itemsPathM[$index_itemsM] = $row['ImagePath']; 
			$itemsQuantM[$index_itemsM] = $row['Quantity']; 
            $index_itemsM++;
    }

?>
<!doctype html>
<html lang=en>
	<?php include ('includes/head.php'); ?>
	<body>
		<div id='container'>
		<?php 
		include ( 'includes/header.php' ) ;
		include ( 'sketch/lab_sketch.php' ) ;
		include ( 'includes/secretIDs.php' );?>
	</div>
	</body>
	<?php include ( 'includes/footer.php' ) ; ?>
</html>