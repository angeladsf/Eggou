<!doctype html>
<html lang=en>

    <head>
    <title>Login page</title>
    <meta charset=utf-8>
    <link rel="stylesheet" type="text/css" href="../eggou.css">
    </head>

    <body>
    <div id='container'>
        <?php
            include ( '../includes/header_login.php' ) ;
            // Escrever mensagens de erro
            if ( isset( $errors ) && !empty( $errors ) ){
            echo '<p id="err_msg">A problem occurred:<br>' ;
            foreach ( $errors as $msg ) { echo " - $msg<br>" ; }
            echo '<p id="err_msg">Please try again or <a href="register.php">Register</a></p>' ;
            }
        ?>
        <!-- formulário do login -->
        <div class = 'login_form'>
            <h2>Login</h2><br>
            <h3>Enter your user data</h3><br>
            <form action="process_login.php" method="post">
                <p><label class="label" for="username">UserName: </label>
                <input required id="username" type="text" 
                name="username" size="16" maxlength="16" value="<?php if (isset($_POST['username']))
                echo $_POST['username']; ?>"></p>
                <br><p><label class="label" for="psword">Password: </label>
                <input required id="psword" 
                type="password" name="psword" size="16" maxlength="16" value="<?php if
                (isset($_POST['psword'])) echo $_POST['psword']; ?>" ></p>
                <br><p class="submit"><input id = 'submit' type="submit" value="Login" ></p>
            </form>
        </div>    
        <?php include ('../includes/footer.php'); ?>
    </body>
</html>