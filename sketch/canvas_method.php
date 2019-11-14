<?php

    //VARIÁVEIS DAS NECESSIDADES
    $q_nec = ("SELECT hunger, energy, health, happiness, hygiene, name FROM pet where player_id = $player_id");
    $queryNec = @mysqli_query($dbcon, $q_nec);
    $rowNec = mysqli_fetch_array ( $queryNec, MYSQLI_ASSOC ) ;
    $fome = $rowNec['hunger'];
    $energia = $rowNec['energy'];
    $saude = $rowNec['health'];
    $felicidade = $rowNec['happiness'];
    $higiene = $rowNec['hygiene'];
    $nome = $rowNec['name'];

    //VARIÁVEIS DO JOGADOR
    $q_jog = ("SELECT experience, coins FROM player where player_id = $player_id");
    $queryJog = @mysqli_query($dbcon, $q_jog);
    $rowJog = mysqli_fetch_array ( $queryJog, MYSQLI_ASSOC ) ;
    $moeda = $rowJog['coins'];
    $xp = $rowJog['experience'];

    //VARIÁVEIS DA LOJA
    $q_store = ("SELECT name, item_id, price, value, category FROM item");
    $queryStore = @mysqli_query($dbcon, $q_store);
    $rowStore = mysqli_fetch_array ($queryStore, MYSQLI_ASSOC) ;
    $nameLoja = $rowStore['name'];
    $idLoja = $rowStore['item_id'];
    $priceLoja = $rowStore['price'];
    $valueLoja = $rowStore['value'];
    $catLoja = $rowStore['category'];

    global $fome, $energia, $saude, $felicidade, $higiene, $nome, $moeda, $xp;

?>

<script>
//Canvas
canvasWidth = window.innerWidth;
canvasHeight = window.innerHeight * 0.80;

//Cores
let green = '#50c936'
let yellow = '#f1eb07'
let red = '#f22727'


let necWidth = 100;
let necHeight = canvasHeight / 12;
let necPosY = canvasHeight - canvasHeight/6;

function preload() {
  storeIcon = loadImage('../eggou/assets/store.png');
  coinIcon = loadImage('../eggou/assets/coin.png');
  rArrowIcon = loadImage('../eggou/assets/right_arrow.png');
  lArrowIcon = loadImage('../eggou/assets/left_arrow.png');
  showerIcon = loadImage('../eggou/assets/shower.png');
  lampIcon = loadImage('../eggou/assets/idea.png');
  playgroundIcon = loadImage('../eggou/assets/playground.png');
}

</script>