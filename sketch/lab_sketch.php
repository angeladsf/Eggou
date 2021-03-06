<?php include ( 'methods.php' ) ; ?>

<script>

let medValue =<?php echo json_encode($itemsValueM);?>;
let medId =<?php echo json_encode($itemsIdsM);?>;
let medPath =<?php echo json_encode($itemsPathM);?>;
let medQuant =<?php echo json_encode($itemsQuantM);?>;

let allItems;

let arrayMed = [];
let w = canvasWidth * 0.86;
let h = canvasHeight * 0.20;
let w2 = w + 60;
widthStore = [w, w, w, w, w2, w2, w2, w2];
heightStore = [h, h+70, h+140, h+210, h, h+70, h+140, h+210];
let dragging = [];
let x = canvasWidth * 0.88;
let y = 200;

let release = false;

var rollover = false; // Is the mouse over the ellipse?
var offsetX, offsetY;


function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();

    // adicionar os medicamentos a um array
    for(i=0; i<medValue.length; i++){
        for(k = 0; k - 1 < medQuant[i]; k++){
            j = new inventoryItem(medValue[i], medId[i],medPath[i], parseInt(widthStore[i]), parseInt(heightStore[i]), k);
            arrayMed.push(j);
            let a = false;
            dragging.push(a);
        }
    }

}

function draw() {
    image(mountain, 0, 100, canvasWidth, canvasHeight-100);
    background(	249, 163, 163, 200);
    drawNeedsIcons();
    iconPlayground.draw_roomIcon();
    lab.draw_room();
    decreaseAllNeeds('lab.php');

    // desenhar um item j vazes (j é a quantidade no inventário)
    for(i=0; i< arrayMed.length; i++){
        let j = 0;
        if(arrayMed[i].quant > j){
            arrayMed[i].draw_inItem();
            j++;
        }

        // Se o rato estiver em cima do item
        if (mouseX > arrayMed[i].posX && mouseX < arrayMed[i].posX + 55 && mouseY > arrayMed[i].posY && mouseY < arrayMed[i].posY + 55) {
            rollover = true;
        } else {
            rollover = false;
        }

        // ajustar a posição do item enquanto estiver a ser arrastado
        if (dragging[i]) {
            arrayMed[i].posX = mouseX + offsetX;
            arrayMed[i].posY = mouseY + offsetY;
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
        window.open('bedroom.php', '_self');
    } else if (whereIsMouseX > kitchen.posX + 200 && whereIsMouseY > kitchen.posY &&
        whereIsMouseX < (kitchen.posX + kitchen.size + 200) && whereIsMouseY < (kitchen.posY + kitchen.size)) {
        window.open('kitchen.php', '_self');
    }else if (whereIsMouseX > 1200 && whereIsMouseY > 25 &&
        whereIsMouseX < 1250 && whereIsMouseY < 75) {
        window.open('playground.php', '_self');
    }

    for(let i= 0; i< arrayMed.length; i++){
        if (whereIsMouseX > arrayMed[i].posX && whereIsMouseY > arrayMed[i].posY && whereIsMouseX < arrayMed[i].posX + 55 && whereIsMouseY < arrayMed[i].posY + 55) {
            dragging[i] = true;
            offsetX = arrayMed[i].posX - mouseX;
            offsetY = arrayMed[i].posY - mouseY;
            break;
        }
    }
}

function mouseReleased() {
    // Parar dragging
    for(let i= 0; i< arrayMed.length; i++){
        dragging[i] = false;

        if (arrayMed[i].posX < 1000 && nHealth.value <= 100) {
            arrayMed[i].posX = 100000;

            if ((parseFloat(nHealth.value) + parseInt(arrayMed[i].value)) < 100){
                nHealth.value = parseFloat(nHealth.value)+ parseInt(arrayMed[i].value);
            }else{
                nHealth.value = 100;
            }

            $.post({
                    url: "lab.php",
                    type: "post",
                    data: {
                        newValue: nHealth.value,
                        itemID: arrayMed[i].ID,
                    }
                },
                function(data, status) {
                });
        }
    }
}

</script>