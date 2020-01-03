<?php include ( 'methods.php' ) ; ?>

<script>

let x = canvasWidth * 0.875;
let y = 200;
let s = 70;
let isVisible = true;

function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();
}


function draw() {
    image(mountain, 0, 100, canvasWidth, canvasHeight-100);
    background(186,	150, 253, 200);
    drawNeedsIcons();
    bedroom.draw_room();
    iconPlayground.draw_roomIcon();
    lamp = image(lampIcon, x, y, s, s);
    decreaseAllNeeds('bedroom.php');

    // escurecer o ecrã se a luz estiver apagada
    if (!isVisible) {
        fill(20,20,20,70);
        rect(0, 0, canvasWidth, canvasHeight, 0);
    }

    setTimeout(function() {
        if ((isVisible == false) && nEnergy.value <= 100) {
            nEnergy.value = parseFloat(nEnergy.value) + 0.02;

            $.post({
                    url: "bedroom.php",
                    type: "post",
                    data: {
                        newValue: nEnergy.value
                    }
                },
                function(data, status) {

                });

        }
    }, 1000);
}

function mouseClicked() {
    whereIsMouseX = mouseX;
    whereIsMouseY = mouseY;

    if (whereIsMouseX > iconStore.posX && whereIsMouseY > iconStore.posY &&
        whereIsMouseX < (iconStore.posX + iconStore.sizeX) && whereIsMouseY < (iconStore.posY + iconStore.sizeY)) {
        window.open('store.php', '_self');
    } else if (whereIsMouseX > kitchen.posX && whereIsMouseY > kitchen.posY &&
        whereIsMouseX < (kitchen.posX + kitchen.size) && whereIsMouseY < (kitchen.posY + kitchen.size)) {
        window.open('bathroom.php', '_self');
    } else if (whereIsMouseX > kitchen.posX + 200 && whereIsMouseY > kitchen.posY &&
        whereIsMouseX < (kitchen.posX + kitchen.size + 200) && whereIsMouseY < (kitchen.posY + kitchen.size)) {
        window.open('lab.php', '_self');
    }else if (whereIsMouseX > 1200 && whereIsMouseY > 25 &&
        whereIsMouseX < 1250 && whereIsMouseY < 75) {
        window.open('playground.php', '_self');
    }

    // apagar/ acender a luz
    if (whereIsMouseX > x && whereIsMouseY > y && whereIsMouseX < x + s && whereIsMouseY < y + s) {
        isVisible = !isVisible;
    }
}
</script>