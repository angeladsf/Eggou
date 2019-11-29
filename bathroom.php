<?php require ('session/mysql_connection.php');
session_start() ;
// REDIRECIONAR CASO NÃO O LOGIN NÃO TENHA SIDO FEITO
if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
require ( 'session/login_functions.php' ) ; load() ; }
$player_id = $_SESSION[ 'player_id' ] ;


if(isset($_POST["newValue"])){
  $newValue = $_POST["newValue"];
  
  $q = ("UPDATE pet SET Hygiene = $newValue WHERE player_id = $player_id");
  $result = @mysqli_query($dbcon, $q);

  $q3 = ("UPDATE pet SET experience = experience + 0.05  WHERE player_id = ".$player_id."");
  $result3 = @mysqli_query($dbcon, $q3);
}

if(isset($_POST["money"])){
	$money = $_POST["newValue"];
  
	$q = ("UPDATE player SET coins = $money WHERE player_id = $player_id");
	$result = @mysqli_query($dbcon, $q);
}

include ( 'includes/getNeeds.php' );
include ( 'includes/saveTime.php' ) ;
?>

<!doctype html>
<html lang=en>
<?php include ( 'includes/head.php' ); ?>
	<body>
		<div id='container'><?php 
		include ( 'includes/header.php' );
		include ( 'sketch/bathroom_sketch.php' ) ;
		include ( 'includes/secretIDs.php' );?>
	</div>
	</body>
	<?php include ( 'includes/footer.php' ) ; ?>
</html>