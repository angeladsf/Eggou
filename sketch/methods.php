<?php
    //VARIÁVEIS DAS NECESSIDADES
    $q_nec = ("SELECT hunger, energy, health, happiness, hygiene, name, experience FROM pet where player_id = $player_id");
    $queryNec = @mysqli_query($dbcon, $q_nec);
    $rowNec = mysqli_fetch_array ( $queryNec, MYSQLI_ASSOC ) ;
    $hunger = $rowNec['hunger'];
    $energy = $rowNec['energy'];
    $health = $rowNec['health'];
    $happiness = $rowNec['happiness'];
    $hygiene = $rowNec['hygiene'];
    $name = $rowNec['name'];
    $xp = $rowNec['experience'];

    //VARIÁVEIS DO JOGADOR
    $q_jog = ("SELECT coins FROM player where player_id = ".$player_id."");
    $queryJog = @mysqli_query($dbcon, $q_jog);
    $rowJog = mysqli_fetch_array ( $queryJog, MYSQLI_ASSOC ) ;
    $money = $rowJog['coins'];

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
  animalIMG = loadImage('../eggou/assets/dino.png');
  treeIMG = loadImage('../eggou/assets/tree.png');
  backgroundIMG = loadImage('../eggou/assets/back.png');
}

//Variáveis do Jogador
let money = "<?php echo $money; ?>";
let exp = "<?php echo $xp; ?>";
let player_id = "<?php echo $player_id; ?>";

//Variáveis das needs
let hunger = "<?php echo $hunger; ?>";
let energy = "<?php echo $energy; ?>";
let hygiene = "<?php echo $hygiene; ?>";
let health = "<?php echo $health; ?>";
let happiness = "<?php echo $happiness; ?>";

let name = "<?php echo $name; ?>";


//Ícone da loja e playground
class room_icon {
    constructor(posX, posY, icon, sizeX, sizeY) {
        this.posX = posX;
        this.posY = posY;
        this.sizeX = sizeX;
        this.sizeY = sizeY;
        this.icon = icon;
    }
    draw_roomIcon() {
        image(this.icon, this.posX, this.posY, this.sizeX, this.sizeY);
    }
}



class pet {
    constructor(name, posX, posY) {
        this.posX = posX;
        this.posY = posY;
        this.name = name;
    }
    draw_pet() {
        fill(134,75,243, 80)
        rect(this.posX - 20, this.posY - 30, 140, 50, 40);
        fill(0);
        text(this.name, this.posX, this.posY);
    }
}


//Ícone e quantidade de dinheiro
function drawMoney(posX, posY, icon, sizeX, sizeY, money){
    image(icon, posX, posY, sizeX, sizeY);
    fill('#000');
    text(money, (posX + sizeX), (posY + sizeY / 1.5));
}


//Trocar de quartos
class room {
    constructor(posX, posY, name) {
        this.posX = posX;
        this.posY = posY;
        this.name = name;
        this.left = lArrowIcon;
        this.right = rArrowIcon;
        this.size = 30;
    }
    draw_room() {
        image(this.left, this.posX, this.posY, this.size, this.size);
        color('#000')
        textSize(16);
        text(this.name, this.posX + 70, this.posY + 20);
        image(this.right, this.posX + 200, this.posY, this.size, this.size);
    }
}

//desenhar o retângulo do inventário
function drawInventory(posX, posY, width, height){
    fill(90, 50, 90, 100);
    rect(posX, posY, width, height, 10);
}


//item do inventário (comida ou medicamento)
class inventoryItem{
    constructor(value, ID, path, posX, posY, quant) {
        this.value = value;
        this.ID = ID;
        this.path = path;
        this.posX = posX;
        this.posY = posY;
        this.quant = quant;
        this.icon = loadImage(this.path);
    }
    draw_inItem() {
        image(this.icon, this.posX, this.posY, 55, 55);
    }
}


class level {
    constructor(posX, posY, width, height, exp) {
        this.posX = posX;
        this.posY = posY;
        this.width = width;
        this.height = height;
        this.exp = exp;
        this.level = level;
    }

    draw_level(){
        let array_level = [0, 50];
        let j = 0.2;
        let z = 1;

        // calcular o nível a partir da experiência
        for(let i = 0; i < 30; i++ ){
            array_level.push( (int) (50 + 50 * j *z) );
            j+= 0.2;
            z+= 0.1;
            i++;
        }

        for(let i = 0; i < 30; i++ ){
            if(this.exp >= array_level[i-1] && this.exp < array_level[i]){
                this.level = i;
            }

            // saber a idade
            if (this.level >= 0 && this.level <= 3){
                this.age = "Baby";
            }else if(this.level >= 4 && this.level <= 10){
                this.age = "Junior";
            }else if(this.level >= 11 && this.level <= 25){
                this.age = "Adult";
            }else if(this.level >= 26 && this.level <= 30){
                this.age = "Senior";
            }


            // acabar o jogo no nível 31
            if(this.level >= 31){
                window.open('gameover.php/?name=' + name, '_self');
            }
        }
        fill(255, 255, 255, 80);
        rect(this.posX - 20, this.posY-20, this.width, this.height);
        fill(0);
        text("Level: "+ this.level, this.posX, this.posY);
        text(this.age, this.posX + 70, this.posY);
    }

}

// necessidades
class need {
    constructor(posX, posY, width, height, color, name, value) {
        this.posX = posX;
        this.posY = posY;
        this.height = height;
        this.width = width;
        this.color = color;
        this.name = name;
        this.value = value;
    }
    draw_need() {
        fill('#bbb');
        rect(this.posX, this.posY, this.width, this.height);
        fill(this.color);
        rect(this.posX, this.posY, this.value, this.height);
        fill('#fff');
        textSize(14);
        textStyle(BOLD);
        text(this.name, this.posX + this.width / 5, this.posY + this.height / 2);

        if (this.value >= 71) {
            this.color = green;
        } else if (this.value >= 36 && 71 > this.value) {
            this.color = yellow;
        } else if (36 > this.value) {
            this.color = red;
        }

    }
}

//Setup de objetos
function setup_main() {
    nHappiness = new need(needWidth * 2.5, needPosY, needWidth, needHeight, 'red', 'Happiness', happiness);
    nHygiene = new need(needWidth * 4, needPosY, needWidth, needHeight, 'red', 'Hygiene', hygiene);
    nHunger = new need(needWidth * 5.5, needPosY, needWidth, needHeight, 'red', 'Hunger', hunger);
    nEnergy = new need(needWidth * 7, needPosY, needWidth, needHeight, 'red', 'Energy', energy);
    nHealth = new need(needWidth * 8.5, needPosY, needWidth, needHeight, 'red', 'Health', health);
    iconStore = new room_icon(100, 20, storeIcon, 50, 50);
    iconHouse = new room_icon(100, 20, houseIcon, 50, 50);
    iconHouse1 = new room_icon(1200, 20, houseIcon, 50, 50);
    iconPlayground = new room_icon(1200, 25, playgroundIcon, 50, 50);
    kitchen = new room(550, 50, 'Kitchen');
    currentLevel = new level(900, 50, 150, 30, exp);
    bathroom = new room(550, 50, 'Bathroom');
    bedroom = new room(550, 50, 'Bedroom');
    lab = new room(550, 50, 'Lab');
    petName = new pet(name, 90, needPosY + 25);
}


// desenhar os icons principais nos quartos da casa
function drawNeedsIcons() {
    drawInventory(canvasWidth * 0.85, canvasHeight * 0.17, canvasWidth * 0.1, canvasHeight * 0.65);
    nHappiness.draw_need();
    nHygiene.draw_need();
    nHunger.draw_need();
    nEnergy.draw_need();
    drawMoney(250, 25, coinIcon, 40, 40, money);
    nHealth.draw_need();
    iconStore.draw_roomIcon();
    currentLevel.draw_level();
    petName.draw_pet();
}


// diminuir as necessidades em função do tempo
function decrease_need(needs, secretIDs, link) {
    setTimeout(function() {

        for(let i = 0; i< needs.length; i++){
        if(needs[i].value > 0){
          needs[i].value = parseFloat(needs[i].value) - 0.001;
          $(secretIDs[i]).text(needs[i].value);
          $(secretIDs[i]).hide();
          $.post({
            url: link,
            type: "post",
            data: {
              newHygiene: needs[0].value, 
              newHunger: needs[1].value,
              newEnergy: needs[2].value,
              newHappiness: needs[3].value,
              newHealth: needs[4].value,
            }
          },
          function(data, status){   
          });
        }
        }
      }, 5000);//milisegundos
}


function decreaseAllNeeds(room) {
    var arrayN = [nHygiene, nHunger, nEnergy, nHappiness, nHealth];
    var arrayS = ['#secretHygiene', '#secretHunger', '#secretEnergy', '#secretHappiness', '#secretHealth']
    decrease_need(arrayN, arrayS, room);
}

</script>