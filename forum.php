<?php
session_start() ;
// Redirect if not logged in.
if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
require ( 'session/login_functions.php' ) ; load() ; }
?>
<!doctype html>
<html lang=en>
	<head>
		<title>Eggou</title>
		<meta charset=utf-8>
		<link rel="stylesheet" type="text/css" href="eggou.css">
	</head>
	<body>
		<div id='container'>
		<?php include ( 'includes/header.php' ) ;?>


		<?php include ( 'includes/footer.php' ) ; ?>
	</div>
	</body>
</html>