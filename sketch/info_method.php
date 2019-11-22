<script>

//Loja
let nameStore = "<?php echo $nameStore; ?>";
let idItem = "<?php echo $idItem; ?>";
let priceItem = "<?php echo $priceItem; ?>";
let incrItem = "<?php echo $incrItem; ?>";
let catItem = "<?php echo $catItem; ?>";

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

//Ícone e quantidade de dinheiro
class money_icon {
    constructor(posX, posY, icon, sizeX, sizeY, money) {
        this.posX = posX;
        this.posY = posY;
        this.sizeX = sizeX;
        this.sizeY = sizeY;
        this.icon = icon;
        this.money = money;
    }
    draw_money() {
        image(this.icon, this.posX, this.posY, this.sizeX, this.sizeY);
        fill('#000');
        text(this.money, (this.posX + this.sizeX), (this.posY + this.sizeY / 1.5));
    }
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


class inventory {
    constructor(posX, posY, width, height) {
        this.posX = posX;
        this.posY = posY;
        this.width = width;
        this.height = height;
        this.border = 10;
        this.size = 80;
    }

    draw_inventory() {
        fill(90, 50, 90, 100);
        rect(this.posX, this.posY, this.width, this.height, this.border);
    }
}


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
    }
}

// needs
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
    iconMoney = new money_icon(250, 25, coinIcon, 40, 40, money);
    iconPlayground = new room_icon(1200, 25, playgroundIcon, 50, 50);
    kitchen = new room(550, 50, 'Kitchen');
    bathroom = new room(550, 50, 'Bathroom');
    bedroom = new room(550, 50, 'Bedroom');
    lab = new room(550, 50, 'Lab');
    inventory = new inventory(canvasWidth * 0.85, canvasHeight * 0.17, canvasWidth * 0.1, canvasHeight * 0.65);
}


function drawNeedsIcons() {
    nHappiness.draw_need();
    nHygiene.draw_need();
    nHunger.draw_need();
    nEnergy.draw_need();
    nHealth.draw_need();
    iconStore.draw_roomIcon();
    iconMoney.draw_money();
}


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
      }, 5000);//milliseconds
}


function decreaseAllNeeds(room) {
    var arrayN = [nHygiene, nHunger, nEnergy, nHappiness, nHealth];
    var arrayS = ['#secretHygiene', '#secretHunger', '#secretEnergy', '#secretHappiness', '#secretHealth']
    decrease_need(arrayN, arrayS, room);
}

</script>