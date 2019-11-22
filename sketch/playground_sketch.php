<?php include ( 'canvas_method.php' ) ; ?>
<?php include ( 'info_method.php' ) ; ?>

<script>
function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();
}

function draw() {
    background(playgroundBG);
    drawNeedsIcons();
    iconHouse1.draw_roomIcon();

    decreaseAllNeeds('lab.php');
}

function mouseClicked() {
    whereIsMouseX = mouseX;
    whereIsMouseY = mouseY;

    if (whereIsMouseX > iconStore.posX && whereIsMouseY > iconStore.posY &&
        whereIsMouseX < (iconStore.posX + iconStore.sizeX) && whereIsMouseY < (iconStore.posY + iconStore.sizeY)) {
        window.open('store.php', '_self');
    }else if (whereIsMouseX > 1200 && whereIsMouseY > 25 &&
        whereIsMouseX < 1250 && whereIsMouseY < 75) {
        window.open('kitchen.php', '_self');
    }

}
</script>