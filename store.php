<?php 
	require ('session/mysql_connection.php');
	session_start() ;
	// REDIRECIONAR CASO NÃO O LOGIN NÃO TENHA SIDO FEITO
	if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
	require ( 'session/login_functions.php' ) ; load() ; }

	$player_id = $_SESSION[ 'player_id' ] ;

    $query_items =("SELECT * FROM item");
    $queryResult_items= @mysqli_query($dbcon, $query_items);


    if(isset($_POST["coins"]) && isset($_POST["itemID"])){
        $coins = $_POST["coins"];
        $item_id = $_POST["itemID"];
        
        $q = ("UPDATE player SET coins = ".$coins." WHERE player_id = ".$player_id."");
        $result = @mysqli_query($dbcon, $q);
        
        $check_rows = ('SELECT quantity FROM inventory where item_id = '.$item_id.' and player_id = '.$player_id.'');
        $check_result = @mysqli_query($dbcon, $check_rows);

        if (@mysqli_num_rows($check_result) > 0) {
            $query = ('UPDATE inventory SET quantity = quantity + 1 WHERE item_id = '.$item_id.' and player_id = '.$player_id.'');
            $final = @mysqli_query($dbcon, $query);
        }  
        else{
            $query = ("INSERT INTO inventory(Quantity, Player_ID, Item_ID) VALUES (1, ".$player_id.", ".$item_id.")");
            $final = @mysqli_query($dbcon, $query);
        }
    }
    
    include ( 'includes/getItems.php' ); 
	include ( 'includes/getNeeds.php' );
?>
<!doctype html>
<html lang=en>
	<?php include ( 'includes/head.php' ); ?>
	<body>
		<div id='container'><?php 
		include ( 'includes/header.php' );
		include ( 'sketch/store_sketch.php' ) ;
		include ( 'includes/secretIDs.php' );?>
        <span id = 'coins'></span>
	</div>
	</body>
	<?php include ( 'includes/footer.php' ) ; ?>
</html>