<?php include ( 'methods.php' ) ; ?>

<script>

let foodValue =<?php echo json_encode($itemsValueF);?>;
let foodId =<?php echo json_encode($itemsIdsF);?>;
let foodPath =<?php echo json_encode($itemsPathF);?>;
let foodQuant =<?php echo json_encode($itemsQuantF);?>;

let allItems;

let arrayFood = [];
let w = canvasWidth * 0.86;
let h = canvasHeight * 0.20;
let w2 = w + 60;
widthStore = [w, w, w, w, w2, w2, w2, w2];
heightStore = [h, h+70, h+140, h+210, h, h+70, h+140, h+210];
let dragging = [];
let x = canvasWidth * 0.88;
let y = 200;


var rollover = false;
var offsetX, offsetY;

function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();

    for(i=0; i<foodValue.length; i++){
        for(k = 0; k - 1 < foodQuant[i]; k++){
            j = new inventoryItem(foodValue[i], foodId[i],foodPath[i], parseInt(widthStore[i]), parseInt(heightStore[i]), k);
            arrayFood.push(j);
            let a = false;
            dragging.push(a);
        }

    }
}


function draw() {
    image(mountain, 0, 100, canvasWidth, canvasHeight-100);
    background(249, 247, 147, 200);
    drawNeedsIcons();
    iconPlayground.draw_roomIcon();
    kitchen.draw_room();
    decreaseAllNeeds('kitchen.php');
    
    for(i=0; i< arrayFood.length; i++){
        let j = 0;
        if(arrayFood[i].quant > j){
            arrayFood[i].draw_inItem();
            j++;
        }

        // se o rato estiver sobre o objeto
        if (mouseX > arrayFood[i].posX && mouseX < arrayFood[i].posX + 55 && mouseY > arrayFood[i].posY && mouseY < arrayFood[i].posY + 55) {
            rollover = true;
        } else {
            rollover = false;
        }

        if (dragging[i]) {
            arrayFood[i].posX = mouseX + offsetX;
            arrayFood[i].posY = mouseY + offsetY;
        }
    }

}

function mousePressed() {
    whereIsMouseX = mouseX;
    whereIsMouseY = mouseY;

    if (whereIsMouseX > iconStore.posX && whereIsMouseY > iconStore.posY &&
        whereIsMouseX < (iconStore.posX + iconStore.sizeX) && whereIsMouseY < (iconStore.posY + iconStore.sizeY)) {
        window.open('store.php', '_self');
    } else if (whereIsMouseX > kitchen.posX && whereIsMouseY > kitchen.posY &&
        whereIsMouseX < (kitchen.posX + kitchen.size) && whereIsMouseY < (kitchen.posY + kitchen.size)) {
        window.open('lab.php', '_self');
    } else if (whereIsMouseX > kitchen.posX + 200 && whereIsMouseY > kitchen.posY &&
        whereIsMouseX < (kitchen.posX + kitchen.size + 200) && whereIsMouseY < (kitchen.posY + kitchen.size)) {
        window.open('bathroom.php', '_self');
    }else if (whereIsMouseX > 1200 && whereIsMouseY > 25 &&
        whereIsMouseX < 1250 && whereIsMouseY < 75) {
        window.open('playground.php', '_self');
    }
    for(let i= 0; i< arrayFood.length; i++){
        if (whereIsMouseX > arrayFood[i].posX && whereIsMouseY > arrayFood[i].posY && whereIsMouseX < arrayFood[i].posX + 60 && whereIsMouseY < arrayFood[i].posY + 60) {
            dragging[i] = true;
            offsetX = arrayFood[i].posX - mouseX;
            offsetY = arrayFood[i].posY - mouseY;
            break;
        }
    }

}

function mouseReleased() {
    // parar dragging
    for(let i= 0; i< arrayFood.length; i++){
        dragging[i] = false;

        // ajustar valor da fome e higiene
        if (arrayFood[i].posX < 1000 && (parseFloat(nHunger.value))< 100) {
            arrayFood[i].posX = 100000;

            if (parseFloat(nHunger.value) + parseInt(arrayFood[i].value) < 100){
                nHunger.value = parseFloat(nHunger.value) + parseInt(arrayFood[i].value);
            }else {
                nHunger.value = 100;
            }

            if (parseFloat(nHygiene.value) - parseInt(arrayFood[i].value)/2 > 0){
                nHygiene.value = parseFloat(nHygiene.value) - (parseFloat(arrayFood[i].value)/2);
            }else{
                nHygiene.value = 0;
            }

            $.post({
                    url: "kitchen.php",
                    type: "post",
                    data: {
                        newValue: nHunger.value,
                        itemID: arrayFood[i].ID,
                        hygieneValue: nHygiene.value,
                    }
                },
                function(data, status) {
                });
        }
    }
}
</script>