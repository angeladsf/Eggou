<?php include ( 'methods.php' ) ; 

?>

<script>

let trainingA = false;
let trainingB = false;
let trainingC = false;

let skill_A = "<?php echo $a; ?>";
let skill_B = "<?php echo $b; ?>";
let skill_C = "<?php echo $c; ?>";

let prices = [20, 40, 60, 80, 100];

function getCookie(name) {
  var value = "; " + document.cookie;
  var parts = value.split("; " + name + "=");
  if (parts.length == 2) return parts.pop().split(";").shift();
}

function setup() {
    createCanvas(canvasWidth, canvasHeight);
    setup_main();

    if(specie == "Dragon"){
        skillA = new skill(canvasWidth * 0.2, 100, 180, 60, "Flight", "#8cb8e4", skill_A, prices);
        skillB = new skill(canvasWidth * 0.6, 100, 180, 60, "Reproduction", "#ba96fd", skill_B, prices);
        skillC = new skill(canvasWidth * 0.4, 100, 180, 60, "Fire Breathing", "#f67373", skill_C, prices);
    }
    else{
        skillA = new skill(canvasWidth * 0.2, 100, 180, 60, "Strength", "#8cb8e4", skill_A, prices);
        skillB = new skill(canvasWidth * 0.6, 100, 180, 60, "Reproduction", "#ba96fd", skill_B, prices);
        skillC = new skill(canvasWidth * 0.4, 100, 180, 60, "Speed", "#f67373", skill_C, prices);
    }
}


class skill{

    constructor(posX, posY, width, height, name, color, level, prices){
        this.posX = posX;
        this.posY = posY;
        this.width = width;
        this.height = height;
        this.name = name;
        this.color = color;
        this.level = level;
        this.prices = prices;
        if(prices[level] != null){
            this.cost = prices[level];
        }else{
            this.cost = 50;
        }
    }


    draw_skill(){
        fill(this.color)
        rect(this.posX, this.posY, this.width, this.height);
        fill(255);
        textSize(17);
        text(this.name, this.posX + 20, this.posY + 30);
        textSize(14);
        fill(255, 255, 255, 150);
        let thisLevel;

        if(this.level >= 5){
            thisLevel = "max";
        }
        else{
            thisLevel = this.level;
            if(this.prices[this.level] != null){
                text(this.prices[this.level] + ' coins', this.posX + 95, this.posY + 45);
            }else{
                text('50 coins', this.posX + 95, this.posY + 45);
            }
        }
        text("Level: " + thisLevel, this.posX + 20, this.posY + 45);
    }

}


function getTime(){
    var date = new Date(); 

    date.setTime(date.getTime()+(120000));
    currentMonth = date.getMonth() + 1;
    currentMonth = ("0" + currentMonth).slice(-2);
    currentDay = date.getDate();
    currentDay = ("0" + currentDay).slice(-2);

    currentHours = date.getHours();
    currentHours = ("0" + currentHours).slice(-2);
    currentSeconds = date.getSeconds();
    currentSeconds = ("0" + currentSeconds).slice(-2);
    currentMinutes = date.getMinutes();
    currentMinutes = ("0" + currentMinutes).slice(-2);

    var datetime = date.getFullYear()+'/'+currentMonth+'/'+currentDay; 
    datetime += ' '+currentHours+':'+ currentMinutes +':'+currentSeconds; 

    return datetime;
}


function draw() {
    background(skillsbg);
    nHappiness.draw_need();
    nHygiene.draw_need();
    nHunger.draw_need();
    nEnergy.draw_need();
    drawMoney(250, 25, coinIcon, 40, 40, money);
    nHealth.draw_need();
    iconStore.draw_roomIcon();
    currentLevel.draw_level();
    decreaseAllNeeds('skills.php');
    iconPlayground.draw_roomIcon();
    
    let a = getCookie('skillA');
    let b = getCookie('skillB');
    let c = getCookie('skillC');

    skillA.draw_skill();
    skillB.draw_skill();
    skillC.draw_skill();

    fill(255, 255, 255, 255);
    if(a != null){
        text('Training...', canvasWidth * 0.2, 195);
        trainingA = true;
    }

    if(b != null){
        text('Training...', canvasWidth * 0.6, 195);
        trainingB = true;
    }
    
    if(c != null){
        text('Training...', canvasWidth * 0.4, 195);
        trainingC = true;
    }
}


function mouseClicked() {
    whereIsMouseX = mouseX;
    whereIsMouseY = mouseY;
    
    var expire = new Date();

    if (whereIsMouseX > iconStore.posX && whereIsMouseY > iconStore.posY &&
        whereIsMouseX < (iconStore.posX + iconStore.sizeX) && whereIsMouseY < (iconStore.posY + iconStore.sizeY)) {
        window.open('store.php', '_self');
    }else if (whereIsMouseX > iconPlayground.posX && whereIsMouseY > iconPlayground.posY &&
        whereIsMouseX < (iconPlayground.posX + iconPlayground.sizeX) && whereIsMouseY < (iconPlayground.posY + iconPlayground.sizeY)) {
        window.open('playground.php', '_self');
    }else if (whereIsMouseX > skillA.posX && whereIsMouseY > skillA.posY &&
        whereIsMouseX < (skillA.posX + skillA.width) && whereIsMouseY < skillA.posY + skillA.height) {

        if(money >= skillA.cost && skillA.level < 5 && trainingA == false){
            trainingA = true;
            money -= skillA.cost;
            $.post({
                url: 'skills.php',
                type: "post",
                data: {
                    coins: money, 
                }
            },
            function(data, status){   
            });

            expire.setTime(expire.getTime()+(24*60*60*1000));
            document.cookie = "skillA="+ getTime() +"; expires="+ expire.toGMTString() +"; path=/";

        }

        
    }else if (whereIsMouseX > skillB.posX && whereIsMouseY > skillB.posY &&
        whereIsMouseX < (skillB.posX + skillB.width) && whereIsMouseY < skillB.posY + skillB.height) {
       
            if(money >= skillB.cost && skillB.level < 5 && trainingB == false){
            trainingB = true;
            money -= skillB.cost;
            $.post({
                url: 'skills.php',
                type: "post",
                data: {
                    coins: money, 
                }
            },
            function(data, status){   
            });     
            
            expire.setTime(expire.getTime()+(24*60*60*1000));
            document.cookie = "skillB="+ getTime() +"; expires="+ expire.toGMTString() +"; path=/";

        }
        
    }else if (whereIsMouseX > skillC.posX && whereIsMouseY > skillC.posY &&
        whereIsMouseX < (skillC.posX + skillC.width) && whereIsMouseY < skillC.posY + skillC.height) {
        
            if(money >= skillC.cost && skillC.level < 5 && trainingC == false){
            trainingC = true;
            money -= skillC.cost;
            $.post({
                url: 'skills.php',
                type: "post",
                data: {
                    coins: money, 
                }
            },
            function(data, status){   
            });

            expire.setTime(expire.getTime()+(24*60*60*1000));
            document.cookie = "skillC="+ getTime() +"; expires="+ expire.toGMTString() +"; path=/";
        }
    }
}
</script>