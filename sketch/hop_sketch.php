<?php include ( 'methods.php' ) ; ?>
<script>

class Animal{
  constructor(){
    this.r = 150;
    this.x = 50;
    this.y = height - this.r;
    this.velocity = 0;
    this.gravity = 0.5;
    
  }
  
  jump(){
    this.velocity = -12;
  }
  
  
  move(){
    this.y += this.velocity;
    this.velocity += this.gravity;
    this.y = constrain(this.y, 10, height -this.r);
  }
  
  show(){
    image(animalIMG,this.x, this.y, 145,120);
  }
  
  hits(tree){
    let x1= this.x + this.r * 0.1;
    let y1 = this.y + this.r * 0.1;
    let x2 = tree.x +tree.r *0.1;
    let y2 = tree.y + tree.r *0.1;
    
    return collideCircleCircle(x1,y1,this.r, x2,y2,tree.r, tree.r);
  }
  
}

class Tree {
   constructor(){
     this.r = 80;
     this.x = width;
     this.y = height-this.r;
   }
  
  show(){
    image(treeIMG, this.x, this.y, this.r, this.r);
  }
  
  move(){
    this.x -= 7 ;
  }
}


let animal;
let animalIMG;
let backgroundIMG;
let treeIMG;
let trees = [];
let speed;
let score;
let hit = false;
let x1 = 0;
let x2;
let ScrollSpeed = 2;


function setup() {
  setup_main();
  createCanvas(700, 400);
  dino = new Animal();
  textAlign(CENTER);
  speed = 1;
  score = 0;
  x2 = width;
}


function keyPressed() {
  if((key == ' ' || keyCode === UP_ARROW) && hit == false){
    dino.jump();
    score++;
  }
}

function draw() {
  

  if(random(1) <0.01){
    trees.push(new Tree());
  }
  
  image(backgroundIMG, x1, 0, width, height);
  image(backgroundIMG, x2, 0, width, height);
  
  x1 -= ScrollSpeed;
  x2 -= ScrollSpeed;
  
  if (x1 < -width){
    x1 = width;
  }
  if (x2 < -width){
    x2 = width;
  }
  
  for(let t of trees){
    t.move();
    t.show();

    if(dino.hits(t)){
      textSize(30);
      text("Game over!", width/2, height/2);
      /*button = createButton("Novo jogo");
      button.position(310, 215);
      button.mousePressed(resetSketch);*/
      textSize(15);
      text("Pressiona f5 para recomeçar!", width/2,215);
     
      if(parseFloat(nHygiene.value -  score/2) > 0){
        nHygiene.value = parseFloat(nHygiene.value - score/2);
      }else{
        nHygiene.value = 0;
      }
      if(parseFloat(nEnergy.value - score/2) > 0){
        nEnergy.value = parseFloat(nEnergy.value - score/2);
      }else{
        nEnergy.value = 0;
      }
      if(parseFloat(nHunger.value - score/2) > 0){
        nHunger.value = parseFloat(nHunger.value - score/2);
      }else{
        nHunger.value = 0;
      }
      if(parseFloat(nHappiness.value) + score < 100){
        nHappiness.value = parseFloat(nHappiness.value) + score;
      }else{
        nHappiness.value = 100;
      }
      money = parseInt(money) + parseInt(score);
      exp = parseFloat(exp) + parseFloat(score/2);

      $.post({
            url: "hop.php",
            type: "post",
            data: {
                hygiene: nHygiene.value,
                energy: nEnergy.value,
                hunger: nHunger.value,
                happiness: nHappiness.value,
                coins: money,
                xp: exp,
            }
        },
        function(data, status) {
        });
      noLoop();


    }
  }
  
  if(frameCount % 30){
    speed *= 1.1;
  }
  
  dino.show();
  dino.move();
  
  textSize(20);
  text("Pontuação: " + score, width/2, 20);
}
</script>