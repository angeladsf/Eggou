<?php require ('session/mysql_connection.php');
session_start() ;
// REDIRECIONAR CASO NÃO ESTEJA LOGIN
if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
require ( 'session/login_functions.php' ) ; load() ; }

$player_id = $_SESSION[ 'player_id' ] ;

if(isset($_POST["newValue"])){
	$newValue = $_POST["newValue"];
	
	$q = ("UPDATE pet SET Energy = $newValue WHERE player_id = $player_id");
	$result = @mysqli_query($dbcon, $q);
  }
  
if(isset($_POST["higiene"]) && isset($_POST["energia"]) && isset($_POST["fome"]) && isset($_POST["felicidade"]) && isset($_POST["saude"])){
	$hygiene = $_POST["higiene"];
	$energy = $_POST["energia"];
	$happiness = $_POST["felicidade"];
	$health = $_POST["saude"];
	$hunger = $_POST["fome"];
  
	$q = ("UPDATE pet SET Hygiene = $hygiene, Energy = $energy, Happiness = $happiness, Health = $health, Hunger = $hunger WHERE player_id = $player_id");
	$result = @mysqli_query($dbcon, $q);
}  
?>

<!doctype html>
<html lang=en>
	<head>
		<title>Eggou</title>
		<meta charset=utf-8>
		<link rel="stylesheet" type="text/css" href="eggou.css">
		<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.9.0/p5.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.9.0/addons/p5.dom.min.js"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/p5.js/0.9.0/addons/p5.sound.min.js"></script>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="utf-8" />
	</head>
	<body>
		<div id='container'><?php 
		include ( 'includes/header.php' );
		include ( 'sketch/bedroom_sketch.php' ) ;?>
		<span id = 'secretHigiene'></span>
		<span id = 'secretFome'></span>
		<span id = 'secretEnergia'></span>
		<span id = 'secretFelicidade'></span>
		<span id = 'secretSaude'></span>
	</div>
	</body>
	<?php include ( 'includes/footer.php' ) ; ?>
</html>