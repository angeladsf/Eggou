<?php include ( 'canvas_method.php' ) ; ?>
<?php include ( 'necessidade.php' ) ; ?>
<?php include ( 'info_method.php' ) ; ?>

<script>
function setup() {
  createCanvas(canvasWidth, canvasHeight);
  setup_main();
}

let x = canvasWidth * 0.88;
let y = 200;
let initialX = canvasWidth * 0.88;
let initialY = 200;
let s= 70;
var dragging = false; // Is the object being dragged?
var rollover = false; // Is the mouse over the ellipse?
var offsetX, offsetY;  


function draw() {
  background('#8cb8e4');
  necFelicidade.draw_necessidade();   
  necHigiene.draw_necessidade();
  necFome.draw_necessidade();
  necEnergia.draw_necessidade();
  necSaude.draw_necessidade();
  iconLoja.draw_shop();
  iconMoney.draw_money();
  bathroom.draw_room();
  inventory.draw_inventory();
  iconPlayground.draw_playground();
  shower = image(showerIcon,x , y, s, s);
  decrease_tudo('bathroom.php');


  // Is mouse over object
  if (mouseX > x && mouseX < x + s && mouseY > y && mouseY < y + s) {
    rollover = true;
  } 
  else {
    rollover = false;
  }
  
  // Adjust location if being dragged
  if (dragging) {
    x = mouseX + offsetX;
    y = mouseY + offsetY;
  }
  setTimeout(function() {
    if(x + s < 1000 && necHigiene.value <=100){
      necHigiene.value = parseInt(necHigiene.value) + 1;

      $.post({
        url: "bathroom.php",
        type: "post",
        data: {
          newValue: necHigiene.value 
        }
      },
      function(data, status){
        
      });
    }
  }, 1000);//milliseconds 

}


function mousePressed(){
  let whereIsMouseX = mouseX;
  let whereIsMouseY = mouseY;

  if(whereIsMouseX > iconLoja.posX && whereIsMouseY > iconLoja.posY
  && whereIsMouseX < (iconLoja.posX + iconLoja.sizeX) && whereIsMouseY < (iconLoja.posY + iconLoja.sizeY)){
    window.open('store.php', '_self');
  }

  else if(whereIsMouseX > kitchen.posX && whereIsMouseY > kitchen.posY
  && whereIsMouseX < (kitchen.posX + kitchen.size) && whereIsMouseY < (kitchen.posY + kitchen.size)){
    window.open('kitchen.php', '_self');
  }

  else if(whereIsMouseX > kitchen.posX + 200 && whereIsMouseY > kitchen.posY
  && whereIsMouseX < (kitchen.posX + kitchen.size + 200) && whereIsMouseY < (kitchen.posY + kitchen.size)){
    window.open('bedroom.php', '_self');
  }  


  if(whereIsMouseX > x && whereIsMouseY > y && whereIsMouseX < x+s && whereIsMouseY < y+s && necHigiene.value < 100){
      dragging = true;
      // If so, keep track of relative location of click to corner of rectangle
      offsetX = x-mouseX;
      offsetY = y-mouseY;
  }
}

function mouseReleased() {
  // Quit dragging
  dragging = false;
  x = initialX;
  y = initialY;
}
</script>

