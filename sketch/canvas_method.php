<?php

    //VARIÁVEIS DAS NECESSIDADES
    $q_nec = ("SELECT hunger, energy, health, happiness, hygiene, name FROM pet where player_id = $player_id");
    $queryNec = @mysqli_query($dbcon, $q_nec);
    $rowNec = mysqli_fetch_array ( $queryNec, MYSQLI_ASSOC ) ;
    $hunger = $rowNec['hunger'];
    $energy = $rowNec['energy'];
    $health = $rowNec['health'];
    $happiness = $rowNec['happiness'];
    $hygiene = $rowNec['hygiene'];
    $name = $rowNec['name'];

    //VARIÁVEIS DO JOGADOR
    $q_jog = ("SELECT experience, coins FROM player where player_id = $player_id");
    $queryJog = @mysqli_query($dbcon, $q_jog);
    $rowJog = mysqli_fetch_array ( $queryJog, MYSQLI_ASSOC ) ;
    $money = $rowJog['coins'];
    $xp = $rowJog['experience'];

    //VARIÁVEIS DA LOJA
    $q_store = ("SELECT name, item_id, price, value, category FROM item");
    $queryStore = @mysqli_query($dbcon, $q_store);
    $rowStore = mysqli_fetch_array ($queryStore, MYSQLI_ASSOC) ;
    $nameStore = $rowStore['name'];
    $idItem = $rowStore['item_id'];
    $priceItem = $rowStore['price'];
    $incrItem = $rowStore['value'];
    $catItem = $rowStore['category'];

    global $hunger, $energy, $health, $happiness, $hygiene, $name, $money, $xp;

?>

<script>
//Canvas
canvasWidth = window.innerWidth;
canvasHeight = window.innerHeight * 0.80;

//Cores
let green = '#50c936'
let yellow = '#f1eb07'
let red = '#f22727'

let needWidth = 100;
let needHeight = canvasHeight / 12;
let needPosY = canvasHeight - canvasHeight/6;

function preload() {
  storeIcon = loadImage('../eggou/assets/store.png');
  houseIcon = loadImage('../eggou/assets/house.png');
  coinIcon = loadImage('../eggou/assets/coin.png');
  rArrowIcon = loadImage('../eggou/assets/right_arrow.png');
  lArrowIcon = loadImage('../eggou/assets/left_arrow.png');
  showerIcon = loadImage('../eggou/assets/shower.png');
  lampIcon = loadImage('../eggou/assets/idea.png');
  playgroundIcon = loadImage('../eggou/assets/playground.png');
  playgroundBG = loadImage('../eggou/assets/playgroundBG.png');
}

</script>