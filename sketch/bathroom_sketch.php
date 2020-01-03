<?php include ( 'methods.php' ) ; ?>

<script>
function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();
}

let x = canvasWidth * 0.88;
let y = 200;
let initialX = canvasWidth * 0.88;
let initialY = 200;
let s = 70;
var dragging = false; // objeto não está a ser arrastado
var rollover = false; // rato não está em cima do objeto
var offsetX, offsetY;


function setup(){
    createCanvas(canvasWidth, canvasHeight);
    setup_main();
}

function draw() {
    image(mountain, 0, 100, canvasWidth, canvasHeight-100);
    background(	140, 184, 228, 200);
    drawNeedsIcons();
    iconPlayground.draw_roomIcon();
    bathroom.draw_room();
    shower = image(showerIcon, x, y, s, s);
    
    decreaseAllNeeds('bathroom.php');

    // se o rato estiver no item
    if (mouseX > x && mouseX < x + s && mouseY > y && mouseY < y + s) {
        rollover = true;
    } else {
        rollover = false;
    }

    // ajustar a localização caso o item esteja a ser arrastado
    if (dragging) {
        x = mouseX + offsetX;
        y = mouseY + offsetY;
    }
    setTimeout(function() {
        if (x + s < 1000 && nHygiene.value <= 100) {
            nHygiene.value = parseInt(nHygiene.value) + 1;

            $.post({
                    url: "bathroom.php",
                    type: "post",
                    data: {
                        newValue: nHygiene.value
                    }
                },
                function(data, status) {

                });
        }
    }, 1000); //milisegundos 

}


function mousePressed() {
    let whereIsMouseX = mouseX;
    let whereIsMouseY = mouseY;

    if (whereIsMouseX > iconStore.posX && whereIsMouseY > iconStore.posY &&
        whereIsMouseX < (iconStore.posX + iconStore.sizeX) && whereIsMouseY < (iconStore.posY + iconStore.sizeY)) {
        window.open('store.php', '_self');
    } else if (whereIsMouseX > kitchen.posX && whereIsMouseY > kitchen.posY &&
        whereIsMouseX < (kitchen.posX + kitchen.size) && whereIsMouseY < (kitchen.posY + kitchen.size)) {
        window.open('kitchen.php', '_self');
    } else if (whereIsMouseX > kitchen.posX + 200 && whereIsMouseY > kitchen.posY &&
        whereIsMouseX < (kitchen.posX + kitchen.size + 200) && whereIsMouseY < (kitchen.posY + kitchen.size)) {
        window.open('bedroom.php', '_self');
    }else if (whereIsMouseX > 1200 && whereIsMouseY > 25 &&
        whereIsMouseX < 1250 && whereIsMouseY < 75) {
        window.open('playground.php', '_self');
    }


    if (whereIsMouseX > x && whereIsMouseY > y && whereIsMouseX < x + s && whereIsMouseY < y + s && nHygiene.value < 100) {
        dragging = true;
        offsetX = x - mouseX;
        offsetY = y - mouseY;
    }
}

function mouseReleased() {
    // parar o drag
    dragging = false;
    x = initialX;
    y = initialY;
}
</script>