<?php include ( 'canvas_method.php' ) ; ?>
<?php include ( 'necessidade.php' ) ; ?>
<?php include ( 'info_method.php' ) ; ?>

<script>


let x = canvasWidth * 0.88;
let y = 200;
let s= 70;
let isVisible = true;

function setup() {
  createCanvas(canvasWidth, canvasHeight);
  setup_main();
}

function draw() {
  
  background('#ba96fd');

  necFelicidade.draw_necessidade();   
  necHigiene.draw_necessidade();
  necFome.draw_necessidade();
  necEnergia.draw_necessidade();
  necSaude.draw_necessidade();
  iconLoja.draw_shop();
  iconMoney.draw_money();
  bedroom.draw_room();
  inventory.draw_inventory();
  iconPlayground.draw_playground();
  lamp = image(lampIcon,x , y, s, s);
  decrease_tudo('bedroom.php');

  if(!isVisible){
    rect(0, 0, canvasWidth, canvasHeight, 25)
  }

  setTimeout(function() {
    if((isVisible == false) && necEnergia.value <=100){
      necEnergia.value = parseFloat(necEnergia.value) + 0.02;

      $.post({
        url: "bedroom.php",
        type: "post",
        data: {
          newValue: necEnergia.value 
        }
      },
      function(data, status){
        
      });
    }
  }, 1000);//milliseconds 

}

function mouseClicked(){
  whereIsMouseX = mouseX;
  whereIsMouseY = mouseY;

  if(whereIsMouseX > iconLoja.posX && whereIsMouseY > iconLoja.posY
  && whereIsMouseX < (iconLoja.posX + iconLoja.sizeX) && whereIsMouseY < (iconLoja.posY + iconLoja.sizeY)){
    window.open('store.php', '_self');
  }

  else if(whereIsMouseX > kitchen.posX && whereIsMouseY > kitchen.posY
  && whereIsMouseX < (kitchen.posX + kitchen.size) && whereIsMouseY < (kitchen.posY + kitchen.size)){
    window.open('bathroom.php', '_self');
  }

  else if(whereIsMouseX > kitchen.posX + 200 && whereIsMouseY > kitchen.posY
  && whereIsMouseX < (kitchen.posX + kitchen.size + 200) && whereIsMouseY < (kitchen.posY + kitchen.size)){
    window.open('lab.php', '_self');
  }

  if(whereIsMouseX > x && whereIsMouseY > y && whereIsMouseX < x+s && whereIsMouseY < y+s){
    isVisible = !isVisible;
  }

}
</script>