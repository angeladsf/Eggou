<?php
// o formulário foi submetido?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // conectar à base de dados
    require('mysql_connection.php');
    // carregar funções de validação
    require('login_functions.php');
    // confirmar dados do login
    list($check, $data) = validate($dbcon, $_POST['username'], $_POST['psword']);
    // se for com sucesso, criar variáveis de sessão
    if ($check) {
        session_start();
        $_SESSION['player_id'] = $data['player_id'];
        $_SESSION['username']  = $data['username'];
        
        $player_id = $_SESSION['player_id'];
        
        $query    = ("SELECT pet_id FROM pet WHERE pet.player_id=$player_id");
        $_SESSION['pet_id']  = $data['pet_id'];
        $pet_id = $_SESSION['pet_id'];
        $row      = @mysqli_query($dbcon, $query);
        $num_rows = mysqli_num_rows($row);
        
        // já tem animal de estimação?
        if ($num_rows > 0) {
            include ("updateNeeds.php");
            load('../kitchen.php');
        } else {
            load('../choice.php');
        }
    }
    // caso houver algum erro
    else {
        $errors = $data;
    }
    // fechar conexão com base de dados
    mysqli_close($dbcon);
}
// continuar na página do login caso o login não seja efetuado com sucesso
include ('login.php');
?>