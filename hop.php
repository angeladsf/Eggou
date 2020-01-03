<?php 
	require ('session/mysql_connection.php');
	session_start() ;
	// REDIRECIONAR CASO NÃO O LOGIN NÃO TENHA SIDO FEITO
	if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
	require ( 'session/login_functions.php' ) ; load() ; }

	$player_id = $_SESSION[ 'player_id' ] ;

    if(isset($_POST["hygiene"]) && isset($_POST["happiness"]) && isset($_POST["hunger"]) &&
    isset($_POST["energy"]) && isset($_POST["xp"]) && isset($_POST["coins"])){
        $hygiene = $_POST["hygiene"];
        $happiness = $_POST["happiness"];
        $hunger = $_POST["hunger"];
        $energy = $_POST["energy"];
        $xp = $_POST["xp"];
        $coins = $_POST["coins"];


        $q1 = ("UPDATE pet SET hunger =".$hunger." WHERE player_id = ".$player_id."");
        $result1 = @mysqli_query($dbcon, $q1);

        $q2 = ("UPDATE pet SET Energy =".$energy." WHERE player_id = ".$player_id."");
        $result2 = @mysqli_query($dbcon, $q2);

        $q3 = ("UPDATE pet SET hygiene = ".$hygiene." WHERE player_id = ".$player_id."");
        $result3 = @mysqli_query($dbcon, $q3);

        $q4 = ("UPDATE pet SET happiness =".$happiness." WHERE player_id = ".$player_id."");
        $result4 = @mysqli_query($dbcon, $q4);

        $q5 = ("UPDATE pet SET experience =".$xp." WHERE player_id = ".$player_id."");
        $result5 = @mysqli_query($dbcon, $q5);

        $q6 = ("UPDATE player SET coins =".$coins." WHERE player_id = ".$player_id."");
        $result6 = @mysqli_query($dbcon, $q6);

	}	
	include ( 'includes/getNeeds.php' );
?>
<!doctype html>
<html lang=en>
    <?php include ( 'includes/head.php' ); ?>
    
    <style>

        body{
            text-align:center;
        }

        a .game_button {
            padding: 1% 3%;
            font-size: 13pt;
            background-color: #50c936;
            border: none;
            color:white;
            margin-top: 5%;
        }

        a:last-child .game_button {
            background-color: #639eda;
        }

        a .game_button {
            text-decoration: none;
            color: white;
            font-weight: bold;
        }

        #container{
            margin-bottom: 30%;
        }

    </style>
	<body>
		<div id='container'>
        <?php 
		include ( 'includes/header.php' );
		include ( 'sketch/hop_sketch.php' ) ;
		include ( 'includes/secretIDs.php' );?>
        <a href="hop.php"><button class="game_button">Restart</button></a>
        <a href="playground.php"><button class="game_button">Go Back</button></a>
     </div>
	</body>
	<?php include ( 'includes/footer.php' ) ; ?>
</html>