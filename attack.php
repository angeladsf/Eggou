<?php 
    require ('session/mysql_connection.php');
    session_start() ;
    $name = $_SESSION[ 'pet_name' ];
    $player_id = $_SESSION[ 'player_id' ];

    $q = ("UPDATE inventory set quantity = 0 where player_id = $player_id");
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
            <h2>Your pet was attacked!</h2><br>
            <h3>It seems <?php echo $name?> was left alone for too much time and was attacked by a 
            tribe.</h3> 
            <h3><?php echo $name?> is fine, but all items stored on the inventory got stolen.</h3>
            <a href="kitchen.php"><button class="index_button">Continue</button></a>
        </div>
    </body>
    <?php include ( 'includes/footer.php' ) ;?>
</html>