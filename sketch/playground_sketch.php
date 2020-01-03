<?php include ( 'methods.php' ) ; ?>

<script>
function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();
}


function draw_game(posX, posY, width, height, name, color, pos){
    fill(color);
    rect(posX, posY, width, height);
    fill(255);
    textSize(17);
    text(name, posX + pos, posY + 30);
}


function draw() {
    background(playgroundBG);
    fill(255,255,255, 100);
    noStroke();
    rect(0, canvasHeight - 95, canvasWidth, 100);
    stroke(0);
    strokeWeight(1);
    nHappiness.draw_need();
    nHygiene.draw_need();
    nHunger.draw_need();
    nEnergy.draw_need();
    nHealth.draw_need();
    noStroke();
    drawMoney(250, 25, coinIcon, 40, 40, money);
    nHealth.draw_need();
    iconStore.draw_roomIcon();
    iconHouse1.draw_roomIcon();
    currentLevel.draw_level();
    textSize(20);
    text(name, canvasWidth * 0.06, canvasHeight * 0.9);
    decreaseAllNeeds('playground.php');

    if(currentLevel.level >= 5){
        iconSkill.draw_roomIcon();
    }

    draw_game(canvasWidth * 0.2, 200, 180, 60, "Hop", "#864bf3", 65);
    draw_game(canvasWidth * 0.6, 200, 180, 60, "Golden Dragon", "#f67373", 25);
}

function mouseClicked() {
    whereIsMouseX = mouseX;
    whereIsMouseY = mouseY;

    if (whereIsMouseX > iconStore.posX && whereIsMouseY > iconStore.posY &&
        whereIsMouseX < (iconStore.posX + iconStore.sizeX) && whereIsMouseY < (iconStore.posY + iconStore.sizeY)) {
        window.open('store.php', '_self');
    }else if (whereIsMouseX > iconHouse1.posX && whereIsMouseY > iconHouse1.posY &&
        whereIsMouseX < (iconHouse1.posX + iconHouse1.sizeX) && whereIsMouseY < (iconHouse1.posY + iconHouse1.sizeY)) {
        window.open('kitchen.php', '_self');
    }else if (whereIsMouseX > canvasWidth * 0.2 && whereIsMouseY > 200 &&
        whereIsMouseX < (canvasWidth * 0.2 + 200) && whereIsMouseY < 260) {
        window.open('hop.php', '_self');
    }else if (whereIsMouseX > canvasWidth * 0.6 && whereIsMouseY > 200 &&
        whereIsMouseX < (canvasWidth * 0.6 + 200) && whereIsMouseY < 260) {
        window.open('2048.php', '_self');
    }else if (whereIsMouseX > iconSkill.posX && whereIsMouseY > iconSkill.posY &&
        whereIsMouseX < (iconSkill.posX + iconSkill.sizeX) && whereIsMouseY < (iconSkill.posY + iconSkill.sizeY)) {
        window.open('skills.php', '_self');
    }

}
</script>