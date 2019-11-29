<?php
function load($page = 'login.php')
{
    $url = 'http://' . $_SERVER['HTTP_HOST'] . dirname($_SERVER['PHP_SELF']);
    $url = rtrim($url, '/\\');
    $url .= '/' . $page;
    header("Location: $url");
    exit();
}
// verificar username e password
function validate($dbcon, $username = '', $p = '')
{
    $errors = array();
    // nome de utilizador foi inserido?
    if (empty($username)) {
        $errors[] = 'You forgot to enter your user name';
    } else {
        $username = mysqli_real_escape_string($dbcon, trim($username));
    }
    // password inserida?
    if (empty($p)) {
        $errors[] = 'Enter your password.';
    } else {
        $p = mysqli_real_escape_string($dbcon, trim($p));
    }
    // selecionar o player_id e username da tabela player se tudo correr bem
    if (empty($errors)) {
        $q      = "SELECT player_id, username FROM player WHERE username='$username' AND psword=SHA1('$p')";
        $result = mysqli_query($dbcon, $q);
        if (@mysqli_num_rows($result) == 1) {
            $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
            return array(
                true,
                $row
            );
        }else {
            $errors[] = 'The user name and password do not match our records.';
        }
    }
    //mostrar mensagens de erro
    return array(
        false,
        $errors
    );
}