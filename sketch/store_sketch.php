<?php include ( 'methods.php' ) ; 

//VARIÁVEIS DA LOJA
$q_store = ("SELECT name, item_id, price, value, category FROM item");
$queryStore = @mysqli_query($dbcon, $q_store);
$rowStore = mysqli_fetch_array ($queryStore, MYSQLI_ASSOC) ;
$nameStore = $rowStore['name'];
$idItem = $rowStore['item_id'];
$priceItem = $rowStore['price'];
$incrItem = $rowStore['value'];
$catItem = $rowStore['category'];

?>

<script>
let foodName =<?php echo json_encode($itemsNameF);?>;
let foodPrice =<?php echo json_encode($itemsPriceF);?>;
let foodValue =<?php echo json_encode($itemsValueF);?>;
let foodId =<?php echo json_encode($itemsIdsF);?>;
let foodPath =<?php echo json_encode($itemsPathF);?>;

let medicineName =<?php echo json_encode($itemsNameM);?>;
let medicinePrice =<?php echo json_encode($itemsPriceM);?>;
let medicineValue =<?php echo json_encode($itemsValueM);?>;
let medicineId =<?php echo json_encode($itemsIdsM);?>;
let medicinePath =<?php echo json_encode($itemsPathM);?>;

let idItem = "<?php echo $idItem; ?>";
let priceItem = "<?php echo $priceItem; ?>";
let incrItem = "<?php echo $incrItem; ?>";
let catItem = "<?php echo $catItem; ?>";

let w = canvasWidth*0.2;
let widthStore = [w, w + 130, w + 260, w + 390, w + 520];

let arrayFood = [];
let arrayMedicine = [];

let food = true;

class item{
    constructor(name, price, value, ID, path, posX, posY) {
        this.name = name;
        this.price = price;
        this.value = value;
        this.ID = ID;
        this.path = path;
        this.posX = posX;
        this.posY = posY;
        this.icon = loadImage(this.path);
    }

    draw_item() {
        fill('#ffece1');
        rect(this.posX+10, this.posY+10, canvasWidth*0.1 - 20, canvasHeight * 0.35 - 20, 10);
        image(this.icon, this.posX + 30, this.posY + 35, 70, 70);
        fill('#000')
        text(this.name, this.posX+ 40, this.posY + 120);
        text(String(this.price) + ' coins', this.posX + 40, this.posY + 30);
        fill(green)
        text('+' + String(this.value), this.posX+ 40, (this.posY + 135));
        fill('#fffdf2');
        rect(this.posX+40, this.posY+140, 50, 20, 5);
        fill('#000');
        text('Buy', this.posX+50, this.posY+155 )

    }

}

function buy_item(price, ID){
    // comprar item caso exista dinheiro suficiente
    if(money >= price){
        money -= price;
        $.post({
            url: 'store.php',
            type: "post",
            data: {
                coins: money, 
                itemID: ID,
            }
        },
        function(data, status){   
        });
    }
}


function draw_store(){
    fill('#fff')
    rect(canvasWidth*0.2, canvasHeight*0.15, canvasWidth* 0.6 , canvasHeight * 0.7, 20);

    fill('#ecffe9')
    rect(canvasWidth * 0.40, canvasHeight*0.05, 70, 25, 10);
    fill('#000');
    text('Food',canvasWidth * 0.40+16, canvasHeight*0.05+17);

    fill('#e9ecff')
    rect(canvasWidth * 0.50, canvasHeight*0.05, 90, 25, 10);
    fill('#000');
    text('Medicine',canvasWidth * 0.50+16, canvasHeight*0.05+17);
    
}


function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();  

    // criar itens  
    for(i=0; i< foodName.length; i++){
        j = new item(foodName[i],parseInt(foodPrice[i]), foodValue[i], foodId[i], foodPath[i], widthStore[i], canvasHeight*0.15 );
        arrayFood.push(j);
    }
    for(i=0; i< medicineName.length; i++){
        j = new item(medicineName[i], parseInt(medicinePrice[i]), medicineValue[i], medicineId[i], medicinePath[i], widthStore[i], canvasHeight*0.15 );
        arrayMedicine.push(j);
    }
}


function draw() {
    background('#ffe9ec');
    textStyle('bold')
    draw_store();
    iconHouse.draw_roomIcon();
    textSize(14);
    drawMoney(250, 25, coinIcon, 40, 40, money);
    iconPlayground.draw_roomIcon();
    decreaseAllNeeds('store.php');
    if (food){
        for (let i = 0; i < arrayFood.length; i++) {
            arrayFood[i].draw_item();
        }
    }else{
        for (let i = 0; i < arrayMedicine.length; i++) {
            arrayMedicine[i].draw_item();
        }
    }
}

function mouseClicked() {
    whereIsMouseX = mouseX;
    whereIsMouseY = mouseY;

    if (whereIsMouseX > iconStore.posX && whereIsMouseY > iconStore.posY &&
        whereIsMouseX < (iconStore.posX + iconStore.sizeX) && whereIsMouseY < (iconStore.posY + iconStore.sizeY)) {
        window.open('kitchen.php', '_self');
    }

    // secção de alimentos 
    if (whereIsMouseX > canvasWidth * 0.40 && whereIsMouseY > canvasHeight*0.05 &&
        whereIsMouseX < (canvasWidth * 0.40 + 70) && whereIsMouseY < (canvasHeight*0.05 + 25)) {
        food = true;
    }//secção de medicamentos
    else if (whereIsMouseX > canvasWidth * 0.50 && whereIsMouseY > canvasHeight*0.05 &&
        whereIsMouseX < (canvasWidth * 0.50 + 90) && whereIsMouseY < (canvasHeight*0.05 + 25)) {
        food = false;
    }else if (whereIsMouseX > 1200 && whereIsMouseY > 25 &&
        whereIsMouseX < 1250 && whereIsMouseY < 75) {
        window.open('playground.php', '_self');
    }

    // comprar item (botão buy)
    for (let i = 0; i < arrayFood.length; i++) {
        if (food && whereIsMouseX > arrayFood[i].posX+40 && whereIsMouseY > arrayFood[i].posY+140 && whereIsMouseX < arrayFood[i].posX+70 && whereIsMouseY < arrayFood[i].posY+160) {
            buy_item(arrayFood[i].price, arrayFood[i].ID);
        }
        if (!food && whereIsMouseX > arrayFood[i].posX+40 && whereIsMouseY > arrayFood[i].posY+140 && whereIsMouseX < arrayFood[i].posX+70 && whereIsMouseY < arrayFood[i].posY+160) {
            buy_item(arrayMedicine[i].price, arrayMedicine[i].ID);
        }
    }
}

</script>