<?php include ( 'methods.php' ) ; ?>

<script>
function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();
}


function draw_game(posX, posY, width, height, name, color){
    fill(color);
    rect(posX, posY, width, height);
    fill(255);
    textSize(17);
    text(name, posX + 65, posY + 30);
}


function draw() {
    background(playgroundBG);
    nHappiness.draw_need();
    nHygiene.draw_need();
    nHunger.draw_need();
    nEnergy.draw_need();
    drawMoney(250, 25, coinIcon, 40, 40, money);
    nHealth.draw_need();
    iconStore.draw_roomIcon();
    iconHouse1.draw_roomIcon();
    currentLevel.draw_level();
    petName.draw_pet();
    decreaseAllNeeds('playground.php');

    draw_game(canvasWidth * 0.2, 200, 180, 60, "Hop", "#864bf3");
    draw_game(canvasWidth * 0.6, 200, 180, 60, "2048", "#f67373");
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
    }

}
</script>