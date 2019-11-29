<?php 
$name = echo $_GET['name']; 
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
            <h3>With your arrival at level 31, <?php echo $name?> has reached the end of 
            its life span. But this isn't the end of your journey!</h3>
            <button class="index_button"><a href="session/login.php">Start over</a></button>
        </div>
    </body>
    <?php include ( 'includes/footer.php' ) ;?>
</html>