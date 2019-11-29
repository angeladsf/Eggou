<?php
    session_start() ;
    // Redirecionar o utilizador
    if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
    require ('login_functions.php' ) ; load() ; 
    }
?>

<!doctype html>
<html lang=en>
    <head>
    <title>Logout</title>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="../eggou.css">
    </head>
    
    <body>
        <div id='index_container'>
            <?php 
            // Remover as variáveis de sessão da sessão
            $_SESSION = array() ;
            // Destruir a sessão
            session_destroy() ;
            ?>
            <img class = 'big_logo' src="../assets/LOGO.png">
            <h2>Thank you for playing Eggou!</h2><br>
            <h3>We hope you had fun</h3>
            <button class="index_button"><a href="../index.php">HomePage</a></button>
        </div>
        <?php include ('../includes/footer.php'); ?>
    </body>
</html>