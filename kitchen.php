<?php 
	require ('session/mysql_connection.php');
	session_start() ;
	// REDIRECIONAR CASO NÃO ESTEJA LOGIN
	if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
	require ( 'session/login_functions.php' ) ; load() ; }

	$player_id = $_SESSION[ 'player_id' ];
	include ( 'includes/getNeeds.php' );
	include ( 'includes/saveTime.php' ) ;


	if(isset($_POST["newValue"]) && isset($_POST["itemID"]) && isset($_POST["hygieneValue"])){
		$newValue = $_POST["newValue"];
		$itemID = $_POST["itemID"];
		$hygieneValue = $_POST["hygieneValue"];

		$q = ("UPDATE pet SET Hunger = ".$newValue." WHERE player_id = ".$player_id."");
		$result = @mysqli_query($dbcon, $q);

		$q1 = ("UPDATE inventory SET quantity = quantity - 1 WHERE player_id = ".$player_id." and item_id = ".$itemID."");
		$result1 = @mysqli_query($dbcon, $q1);

		$q2 = ("UPDATE pet SET Hygiene = ".$hygieneValue."  WHERE player_id = ".$player_id."");
		$result2 = @mysqli_query($dbcon, $q2);

		$q3 = ("UPDATE pet SET experience = experience + 1.5  WHERE player_id = ".$player_id."");
		$result3 = @mysqli_query($dbcon, $q3);
	  }


	$query_items =("SELECT Quantity, item.Item_Id, inventory.player_id, category, item.Value, ImagePath FROM inventory inner join item on inventory.Item_Id = item.Item_Id WHERE category = 'Food' and player_id=".$player_id."");
	$queryResult_items= @mysqli_query($dbcon, $query_items);
	
    $itemsIdsF = array();
    $itemsValueF = array();
	$itemsPathF = array();
	$itemsQuantF = array();

    $index_itemsF = 0;

    while($row = mysqli_fetch_array($queryResult_items, MYSQLI_ASSOC)){
            $itemsIdsF[$index_itemsF] = $row['Item_Id'];
            $itemsValueF[$index_itemsF] = $row['Value']; 
			$itemsPathF[$index_itemsF] = $row['ImagePath']; 
			$itemsQuantF[$index_itemsF] = $row['Quantity']; 
            $index_itemsF++;
    }
?>

<!doctype html>
<html lang=en>
	<?php include ('includes/head.php'); ?>		
	<body>
		<div id='container'>
		<?php 
		include ( 'includes/header.php' ) ;
		include ( 'sketch/kitchen_sketch.php' ) ;
		include ( 'includes/secretIDs.php' );?>
	</div>
	</body>
	<?php include ( 'includes/footer.php' ) ; ?>
</html>