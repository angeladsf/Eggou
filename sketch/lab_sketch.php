<?php include ( 'canvas_method.php' ) ; ?>
<?php include ( 'info_method.php' ) ; ?>

<script>
function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();
}

function draw() {
    background('#f9a3a3');
    drawNeedsIcons();
    iconLoja.draw_roomIcon();
    lab.draw_room();

    decreaseAllNeeds('lab.php');
}

function mouseClicked() {
    whereIsMouseX = mouseX;
    whereIsMouseY = mouseY;

    if (whereIsMouseX > iconLoja.posX && whereIsMouseY > iconLoja.posY &&
        whereIsMouseX < (iconLoja.posX + iconLoja.sizeX) && whereIsMouseY < (iconLoja.posY + iconLoja.sizeY)) {
        window.open('store.php', '_self');
    } else if (whereIsMouseX > kitchen.posX && whereIsMouseY > kitchen.posY &&
        whereIsMouseX < (kitchen.posX + kitchen.size) && whereIsMouseY < (kitchen.posY + kitchen.size)) {
        window.open('bedroom.php', '_self');
    } else if (whereIsMouseX > kitchen.posX + 200 && whereIsMouseY > kitchen.posY &&
        whereIsMouseX < (kitchen.posX + kitchen.size + 200) && whereIsMouseY < (kitchen.posY + kitchen.size)) {
        window.open('kitchen.php', '_self');
    }

}
</script>