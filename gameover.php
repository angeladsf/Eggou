<?php 
require ('session/mysql_connection.php');
session_start() ;
$name = $_SESSION[ 'pet_name' ]; 
$player_id = $_SESSION[ 'player_id' ];

$q = ("DELETE from pet WHERE player_id = ".$player_id."");
$result = @mysqli_query($dbcon, $q);
?>
<!doctype html>
<html lang=en>
    <head>
        <title>Home Page</title>
        <meta charset=utf-8>
        <link rel="stylesheet" type="text/css" href="eggou.css">
    </head>
    <body>
        <div id='index_container'>
            <img class = 'big_logo' src="assets/LOGO.png">
            <h2>Game Over</h2><br>
            <h3>Unfortunately, <?php echo $name?> has reached the end of 
            its life span. Even dragons and dinosaurs die once they are too old or 
            have poor health. But this isn't the end of your journey!</h3>
            <a href="../session/login.php"><button class="index_button">Start over</button></a>
        </div>
    </body>
    <?php include ( 'includes/footer.php' ) ;?>
</html>