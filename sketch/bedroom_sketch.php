<?php include ( 'canvas_method.php' ) ; ?>
<?php include ( 'info_method.php' ) ; ?>

<script>

let x = canvasWidth * 0.88;
let y = 200;
let s = 70;
let isVisible = true;

function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();
}

function draw() {
    background('#ba96fd');
    drawNeedsIcons();
    bedroom.draw_room();
    iconPlayground.draw_roomIcon();
    inventory.draw_inventory();
    lamp = image(lampIcon, x, y, s, s);
    decreaseAllNeeds('bedroom.php');

    if (!isVisible) {
        rect(0, 0, canvasWidth, canvasHeight, 0)
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
    }, 1000); //milliseconds 
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

    if (whereIsMouseX > x && whereIsMouseY > y && whereIsMouseX < x + s && whereIsMouseY < y + s) {
        isVisible = !isVisible;
    }
}
</script>