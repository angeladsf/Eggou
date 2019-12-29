<?php 
	require ('session/mysql_connection.php');
	session_start() ;
	$player_id = $_SESSION[ 'player_id' ];

	include ( 'includes/getNeeds.php' );
	include ( 'includes/saveTime.php' ) ;

	$q= ("SELECT pet_id from pet where pet.player_id = $player_id");
	$query = @mysqli_query($dbcon, $q);
	while($row = mysqli_fetch_array( $query, MYSQLI_ASSOC )){
		$pet_id = $row['pet_id'];
	}

	$q_a = ("SELECT experience FROM skill where pet_id = ".$pet_id." and type = 'a'");
	$queryA = @mysqli_query($dbcon, $q_a);
	while($row = mysqli_fetch_array( $queryA, MYSQLI_ASSOC )){
		$a = $row['experience'];
	}

	$q_b = ("SELECT experience FROM skill where pet_id = ".$pet_id." and type = 'b'");
	$queryB = @mysqli_query($dbcon, $q_b);
	while($row = mysqli_fetch_array ( $queryB, MYSQLI_ASSOC )){
		$b = $row['experience'];
	}

	$q_c = ("SELECT type, experience, pet_id FROM skill where pet_id = ".$pet_id." and type = 'c'");
	$queryC = @mysqli_query($dbcon, $q_c);
	while($row = mysqli_fetch_array ( $queryC, MYSQLI_ASSOC )){
		$c = $row['experience'];
	}

	if(isset($_POST["coins"])){
		$coins = $_POST["coins"];
		
		$q = ("UPDATE player SET coins = ".$coins." WHERE player_id = ".$player_id."");
        $result = @mysqli_query($dbcon, $q);
    }

	global $a, $b, $c;
?>

<!doctype html>
<html lang=en>
	<?php include ('includes/head.php'); ?>		
	<body>
		<div id='container'>
		<?php 
		include ( 'includes/header.php' ) ;
		include ( 'sketch/skills_sketch.php' ) ;
		include ( 'includes/secretIDs.php' );?>
	</div>
	</body>
	<?php include ( 'includes/footer.php' ) ; ?>
</html>