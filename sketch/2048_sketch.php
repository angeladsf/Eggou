<?php include ( 'methods.php' ) ; ?>
<script>

let colorsSizes = {
  "2": {
    size: 64,
    color: "#FFF999"
  },
  "4": {
    size: 64,
    color: "#F35956"
  },
  "8": {
    size: 64,
    color: "#CCF9AA"
  },
  "16": {
    size: 64,
    color: "#9659A7"
  },
  "32": {
    size: 64,
    color: "#2494C1"
  },
  "64": {
    size: 64,
    color: "#49BB6C"
  },
  "128": {
    size: 36,
    color: "#9659A7"
  },
  "256": {
    size: 36,
    color: "#49BB6C"
  },
  "512": {
    size: 36,
    color: "#2494C1"
  },
  "1024": {
    size: 18,
    color: "#CCF9AA"
  },
  "2048": {
    size: 18,
    color: "#F1C500"
  }
}



let grid;
let score = 0;
let gridDup;


function setup() {
    setup_main();
    createCanvas(400, 400);
    noLoop();

    grid = blankGrid();
    gridDup = blankGrid();

    addNumber();
    addNumber();
    updateCanvas();
    
}


function updateCanvas() {
  background(255);
  
  drawGrid();
  
  select('#score').html("Pontuação: " + score);
  
  let gameover = isGameOver();
    if(gameover){
      drawText('Ooooh! \nPressione f5 para tentar de novo.',
		color(255),
		26,
		width / 2,
		height / 2 );

        updateNeeds();
        money = parseInt(money) + parseInt(score/100);
        exp = parseFloat(exp) + parseFloat(score/150);

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
    
    let gamewon = isGameWon();
    if(gamewon){
      drawText('Conseguiu 2048\r\nPressione [f5] para recomeçar.',
		color(255),
		26,
		width / 2,
		height / 2 );

        updateNeeds();
        money = parseInt(money) + 350;
        exp = parseFloat(exp) + parseFloat(score/150);

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
  
  
// atualizar necessidades quando o jogo acabar
function updateNeeds(){
    if(parseFloat(nHygiene.value -  score/150) > 0){
        nHygiene.value = parseFloat(nHygiene.value - score/150);
    }else{
        nHygiene.value = 0;
    }
    if(parseFloat(nEnergy.value - score/150) > 0){
        nEnergy.value = parseFloat(nEnergy.value - score/150);
    }else{
        nEnergy.value = 0;
    }
    if(parseFloat(nHunger.value - score/150) > 0){
        nHunger.value = parseFloat(nHunger.value - score/150);
    }else{
        nHunger.value = 0;
    }
    if(parseFloat(nHappiness.value + score/100) < 100){
        nHappiness.value = parseFloat(nHappiness.value + score/100);
    }else{
        nHappiness.value = 100;
    }
}  

function drawText(msg, inkColor, size, x, y) {
	textAlign(CENTER, CENTER);
	textSize(size);
	fill(inkColor);
	noStroke();
	text(msg, x, y);
}



function blankGrid(){
  return [[0,0,0,0],
          [0,0,0,0],
          [0,0,0,0],
          [0,0,0,0]];
}

//para adicionar um numero 2 ou um 4 sempre que seja feito um movimento e duas posições se juntem numa
function addNumber(){
  let options = [];
  for(let i=0; i<4; i++){
    for(let j = 0; j<4; j++){
      if(grid[i][j] === 0){
        options.push({
          x: i,
          y: j
        });
      }
    }
  }
  
  if(options.length > 0){
    let spot = random(options);
    let r = random(1);
    grid[spot.x][spot.y] = r > 0.1 ? 2:4;
    gridDup[spot.x][spot.y] = 1;
  }
}

function copyGrid(grid){
  let extra = blankGrid();
  
  for(let i=0; i<4; i++){
    for(let j = 0; j<4; j++){
      extra[i][j] = grid[i][j];
    }
  }
  return extra;
}

//inverte a matriz para permitir a jogabilidade das teclas up e down
function flipGrid(grid){
  for(let i=0; i<4; i++){
    grid[i].reverse();
  }
  return grid;
}

//roda a matriz para permitir a jogabilidade das teclas left e right
function rotateGrid(grid){
  let newGrid = blankGrid();
  for(let i=0; i<4; i++){
    for(let j=0; j<4; j++){
      newGrid[i][j] = grid[j][i];
    }
  }
  return newGrid;
}


function compare(a,b){
  for(let i=0; i<4; i++){
    for(let j = 0; j<4; j++){
      if (a[i][j] !== b[i][j]){
        return true;
      }
    }
  }
  return false;
}



let complete = false;

function isGameWon(){
  for(let i=0; i<4; i++){
    for(let j = 0; j<4; j++){
      if(grid[i][j] == 2048){
        return true;
      }
    }
  }
  return false;
}

function isGameOver(){
  
  for(let i=0; i<4; i++){
    for(let j = 0; j<4; j++){
      if(grid[i][j] == 0){
        return false;
      }
      
      if(i !== 3 && grid[i][j] === grid[i + 1 ][j]){
        return false;
      }
      
      if(j !== 3 && grid[i][j] === grid[i][j+1]){
        return false;
      }
    }
  }
  return true;
}

//para definir as teclas jogáveis
function keyPressed(){
  let flipped = false;
  let rotated = false;
  let played = true;
  if(keyCode === DOWN_ARROW){
    //Do nothing
  }else if(keyCode === UP_ARROW){
    grid = flipGrid(grid);
    flipped = true;
  } else if(keyCode === RIGHT_ARROW){
    grid = rotateGrid(grid);
    rotated = true;
  } else if(keyCode === LEFT_ARROW){
    grid = rotateGrid(grid);
    grid = flipGrid(grid);
    rotated = true;
    flipped = true;
  }else{
    played = false;
  }
  
  if(played){
    
    let past = copyGrid(grid);
    
    for(let i=0; i<4; i++){
      grid[i] = operate(grid[i]);
    }
    let changed = compare(past,grid);
    
  
    if(flipped){
      grid = flipGrid(grid); 
    }
  
    if(rotated){
      grid = rotateGrid(grid);
      grid = rotateGrid(grid);
      grid = rotateGrid(grid);
    }
    
    if(changed){
      addNumber();
    }
    updateCanvas();
    
  
  }
}
 //para juntar os números 
function operate(row){
  row = slide(row);
  row = combine(row);
  row = slide(row);
  return row;
}

function slide(row){
  let arr = row.filter(val => val);
  let missing = 4 - arr.length;
  let zeros = Array(missing).fill(0);
  arr = zeros.concat(arr);
  return arr;
  
}

function combine(row){
  for(let i=3; i>=1; i--){
    let a = row[i];
    let b = row[i - 1];
    if(a == b){
      row[i] = a + b;
      score += row[i];
      row[i - 1] = 0;
    }
  }
  return row;
}



function drawGrid(){
  
  let w = 100;
  for(let i=0; i<4; i++){
    for(let j = 0; j<4; j++){
      noFill();
      strokeWeight(2);
      let val = grid[i][j];
      let s =val.toString();
      stroke(0);
      if(gridDup[i][j] === 1){
        stroke(200,0,200);
        strokeWeight(6);
        gridDup[i][j] =0;
      } else{
        stroke(0);
      }
      if(val != 0){
        fill(colorsSizes[s].color);
      } else{
        noFill();
      }
      rect(i*w, j*w, w,w,20);
      if(grid[i][j] !==0){
        textAlign(CENTER,CENTER);
        noStroke();
        fill(0);
        textSize(colorsSizes[s].size);
        text(val, i*w + w/2, j*w + w/2);
    }
  }
}
}

</script>