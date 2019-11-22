<?php 
	require ('session/mysql_connection.php');
	session_start() ;
	// REDIRECIONAR CASO NÃO ESTEJA LOGIN
	if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
	require ( 'session/login_functions.php' ) ; load() ; }

	$player_id = $_SESSION[ 'player_id' ];
	include ( 'includes/getNeeds.php' );
	include ( 'includes/saveTime.php' ) ;
?>

<!doctype html>
<html lang=en>
	<?php include ('includes/head.php'); ?>		
	<body>
		<div id='container'>
		<?php 
		include ( 'includes/header.php' ) ;
		include ( 'sketch/playground_sketch.php' ) ;
		include ( 'includes/secretIDs.php' );?>
	</div>
	</body>
	<?php include ( 'includes/footer.php' ) ; ?>
</html>