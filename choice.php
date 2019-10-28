<?php
session_start() ;
// Redirect if not logged in.
if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
require ( 'session/login_functions.php' ) ; load() ; }
?>
<!doctype html>
<html lang=en>
	<head>
		<title>Choose an egg</title>
		<meta charset=utf-8>
		<link rel="stylesheet" type="text/css" href="eggou.css">
	</head>

	<body>
		<div id="container">
		<?php include("includes/header.php"); ?>
		<div id="content"><!--Start of the page-specific content-->
		<div id="after_choice">
			<h1>Choose an egg</h1><br>
			<h2>Click on one of these eggs to get your pet!</h2>
            <a href = "./name.php?specie=Dragon"><img class = 'egg' src="assets/egg_dragon.png"></a>
            <a href = "./name.php?specie=Dinosaur"><img class = 'egg' src="assets/egg_dino.png"></a>
		</div></div></div>

		<?php include ('includes/footer.php'); ?>

	</body>
</html>