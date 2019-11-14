<script>

//Loja
let nomeProd = "<?php echo $nameLoja; ?>";
let idProd = "<?php echo $idLoja; ?>";
let priceProd = "<?php echo $priceLoja; ?>";
let valorProd = "<?php echo $valueLoja; ?>";
let catProd = "<?php echo $catLoja; ?>";

//Variáveis do Jogador
let moedas = "<?php echo $moeda; ?>";
let exp = "<?php echo $xp; ?>";


//Ícone da loja
class loja_icon{
    constructor(posX, posY, icon, sizeX, sizeY){
        this.posX = posX;
        this.posY = posY;
        this.sizeX = sizeX;
        this.sizeY = sizeY;
        this.icon = icon;
    }
    draw_shop(){
        image(this.icon, this.posX, this.posY, this.sizeX, this.sizeY);
    }   
}

//Ícone e quantidade de moedas
class money_icon{
    constructor(posX, posY, icon, sizeX, sizeY, money){
        this.posX = posX;
        this.posY = posY;
        this.sizeX = sizeX;
        this.sizeY = sizeY;
        this.icon = icon;
        this.money = money;
    }
    draw_money(){
        image(this.icon, this.posX, this.posY, this.sizeX, this.sizeY);
        fill('#000');
        text(this.money, (this.posX + this.sizeX),(this.posY + this.sizeY/1.5));
    }   
}


class playground_icon{
    constructor(posX, posY, icon, sizeX, sizeY){
        this.posX = posX;
        this.posY = posY;
        this.sizeX = sizeX;
        this.sizeY = sizeY;
        this.icon = icon;
    }
    draw_playground(){
        image(this.icon, this.posX, this.posY, this.sizeX, this.sizeY);
    }   
}


//Trocar de quartos
class room{
    constructor(posX, posY, name){
        this.posX = posX;
        this.posY = posY;
        this.name = name;
        this.left = lArrowIcon;
        this.right = rArrowIcon;
        this.size = 30;
    }
    draw_room(){
        image(this.left, this.posX, this.posY, this.size, this.size);
        textSize(16);
        text(this.name, this.posX + 70, this.posY + 20);
        image(this.right, this.posX + 200, this.posY, this.size, this.size);
    }
}


class inventory{
    constructor(posX, posY, width, height){
        this.posX = posX;
        this.posY = posY;
        this.width = width;
        this.height = height;
        this.border = 10;
        this.size = 80;
    }

    draw_inventory(){
        fill(90,50,90, 100);
        rect(this.posX, this.posY, this.width, this.height, this.border);
    }       
}

class level{
    constructor(posX, posY, width, height, exp){
        this.posX = posX;
        this.posY = posY;
        this.width = width;
        this.height = height;
        this.exp = exp;
    }
}


//Setup de objetos
function setup_main(){
    necFelicidade = new necessidade(necWidth*2.5, necPosY, necWidth , necHeight, 'red', 'Happiness', felicidade);
    necHigiene = new necessidade(necWidth*4, necPosY, necWidth , necHeight, 'red', 'Hygiene', higiene);
    necFome = new necessidade(necWidth*5.5, necPosY, necWidth , necHeight, 'red', 'Hunger', fome);
    necEnergia = new necessidade(necWidth*7, necPosY, necWidth , necHeight, 'red', 'Energy', energia);
    necSaude = new necessidade(necWidth*8.5, necPosY, necWidth , necHeight, 'red', 'Health', saude);
    iconLoja = new loja_icon(100, 20, storeIcon, 50,50);
    iconMoney = new money_icon(250, 25, coinIcon, 40,40, moedas);
    iconPlayground = new playground_icon(1200, 25, playgroundIcon, 50,50);
    kitchen = new room(550, 50, 'Kitchen' );
    bathroom = new room(550, 50, 'Bathroom' );
	bedroom = new room(550, 50, 'Bedroom' );
	lab = new room(550, 50, 'Lab' );
    inventory = new inventory(canvasWidth*0.85, canvasHeight*0.2, canvasWidth * 0.1, canvasHeight * 0.65);
}


function decrease_necessidade(necessidades, secretIDs, link){
      setTimeout(function() {

        for(let i = 0; i< necessidades.length; i++){
        if(necessidades[i].value > 0){
          necessidades[i].value = parseFloat(necessidades[i].value) - 0.001;
          $(secretIDs[i]).text(necessidades[i].value);
          $(secretIDs[i]).hide();

          $.post({
            url: link,
            type: "post",
            data: {
              higiene: necessidades[0].value, 
              fome: necessidades[1].value,
              energia: necessidades[2].value,
              felicidade: necessidades[3].value,
              saude: necessidades[4].value,
            }
          },
          function(data, status){
              
          });
        }
        }
      }, 5000);//milliseconds
    }


function decrease_tudo(room){
    var necessidades = [necHigiene, necFome, necEnergia, necFelicidade, necSaude];
    var secrets = ['#secretHigiene', '#secretFome', '#secretEnergia', '#secretFelicidade', '#secretSaude']

    decrease_necessidade(necessidades, secrets , room);
}

</script>