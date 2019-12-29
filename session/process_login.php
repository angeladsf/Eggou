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


        $query    = ("SELECT pet_id, pet.name as pname FROM pet WHERE pet.player_id=$player_id");
        $result = @mysqli_query($dbcon, $query);
       
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
            $_SESSION['pet_id']  = $query['pet_id'];
            $_SESSION['pet_name']  = $query['pname'];
        }
       
        $pet_id = $_SESSION['pet_id'];
        $row      = @mysqli_query($dbcon, $query);
        $num_rows = mysqli_num_rows($row);


        $getDate  = ("SELECT UNIX_TIMESTAMP() - UNIX_TIMESTAMP(close_date) as diff from player where Player_ID = ".$player_id."");
        $result1 = @mysqli_query($dbcon, $getDate);

        while($row = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
            if(abs($row['diff']) > 60*60*24*3){
                // se não entar na conta há mais de 3 dias
                load('../attack.php');
            }else{
                // já tem animal de estimação?
                if ($num_rows > 0) {
                    include ("updateNeeds.php");
                    load('../kitchen.php');
                } else {
                    load('../choice.php');
                }
            }
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