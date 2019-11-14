<?php include ( 'canvas_method.php' ) ; ?>
<?php include ( 'necessidade.php' ) ; ?>
<?php include ( 'info_method.php' ) ; ?>

<script>

function setup() {
  createCanvas(canvasWidth, canvasHeight);
  setup_main();
}

function draw() {
  background('#f9f793');
  necFelicidade.draw_necessidade();   
  necHigiene.draw_necessidade();
  necFome.draw_necessidade();
  necEnergia.draw_necessidade();
  necSaude.draw_necessidade();
  iconLoja.draw_shop();
  iconMoney.draw_money();
  iconPlayground.draw_playground();
  kitchen.draw_room();

  decrease_tudo('kitchen.php');
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
    window.open('lab.php', '_self');
  }

  else if(whereIsMouseX > kitchen.posX + 200 && whereIsMouseY > kitchen.posY
  && whereIsMouseX < (kitchen.posX + kitchen.size + 200) && whereIsMouseY < (kitchen.posY + kitchen.size)){
    window.open('bathroom.php', '_self');
  }

}
</script>