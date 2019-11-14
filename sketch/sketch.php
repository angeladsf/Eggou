
<script>

//Canvas
canvasWidth = window.innerWidth;
canvasHeight = window.innerHeight * 0.8;

//Variáveis das Necessidades
let player_id = "<?php echo $player_id; ?>";
let fome = "<?php echo $fome; ?>";
let energia = "<?php echo $energia; ?>";
let higiene = "<?php echo $higiene; ?>";
let saude = "<?php echo $saude; ?>";
let felicidade = "<?php echo $felicidade; ?>";
let nome = "<?php echo $nome; ?>";

//Cores
let green = '#50c936'
let yellow = '#f1eb07'
let red = '#f22727'


let necWidth = canvasWidth / 11;
let necHeight = canvasHeight / 9;

let necPosY = canvasHeight - canvasHeight/5;

function setup() {
  createCanvas(canvasWidth, canvasHeight);
  necFelicidade = new necessidade(necWidth, necPosY, necWidth , necHeight, 'red', 'Happiness', felicidade);
  necHigiene = new necessidade(necWidth*3, necPosY, necWidth , necHeight, 'red', 'Hygiene', higiene);
  necFome = new necessidade(necWidth*5, necPosY, necWidth , necHeight, 'red', 'Hunger', fome);
  necEnergia = new necessidade(necWidth*7, necPosY, necWidth , necHeight, 'red', 'Energy', energia);
  necSaude = new necessidade(necWidth*9, necPosY, necWidth , necHeight, 'red', 'Health', saude);
}


function draw() {
  background(220);
  necFelicidade.draw_necessidade();   
  necHigiene.draw_necessidade();
  necFome.draw_necessidade();
  necEnergia.draw_necessidade();
  necSaude.draw_necessidade();
}

class necessidade{
    
    constructor(posX, posY, width,height, color, name, value){
      this.posX = posX;  
      this.posY = posY; 
      this.height = height; 
      this.width = width; 
      this.color = color;
      this.name = name;
      this.value = value;
    }
  
    draw_necessidade(){
      fill('#bbb');
      rect(this.posX, this.posY, this.width, this.height);
      fill(this.color);
      rect(this.posX, this.posY, (this.value*this.width/100), this.height);
      fill('#fff');
      textSize(14);
      textStyle(BOLD);
      text(this.name, this.posX + this.width/5, this.posY + this.height/2);

      if(this.value >= 71){
        this.color = green;
      }
      else if(this.value >= 36 && 71 > this.value){
        this.color = yellow;
      }
      else if( 36 > this.value){
        this.color = red;
      }
    }
  }

</script>
