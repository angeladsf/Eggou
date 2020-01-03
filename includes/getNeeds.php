<?php
if(isset($_POST["newHygiene"]) && isset($_POST["newEnergy"]) && isset($_POST["newHunger"]) && isset($_POST["newHappiness"]) && isset($_POST["newHealth"])){
	$hygiene = $_POST["newHygiene"];
	$energy = $_POST["newEnergy"];
	$happiness = $_POST["newHappiness"];
	$health = $_POST["newHealth"];
	$hunger = $_POST["newHunger"];
	
	$q = ("UPDATE pet SET Hygiene = $hygiene, Energy = $energy, Happiness = $happiness, Health = $health, Hunger = $hunger WHERE player_id = $player_id");
	$result = @mysqli_query($dbcon, $q);
}


$q1= ("SELECT pet_id from pet where pet.player_id = $player_id");
	$query1 = @mysqli_query($dbcon, $q1);
	while($row = mysqli_fetch_array( $query1, MYSQLI_ASSOC )){
		$pet_id = $row['pet_id'];
}

$countA = 0;
$countB = 0;
$countC = 0;


if(isset($_COOKIE["skillB"])){
	if (strval($_COOKIE["skillB"]) <= strval(date("Y/m/d H:i:s", strtotime('-1 hour'))) && $countB == 0) {
		setcookie("skillB", "", time() - 6000, '/');
		$countB++;
		$q = ("UPDATE skill SET experience = experience + 0.5 WHERE pet_id = $pet_id and type = 'b'");
		$result = @mysqli_query($dbcon, $q);
	}
}

if(isset($_COOKIE["skillA"])){
	if (strval($_COOKIE["skillA"]) <= strval(date("Y/m/d H:i:s", strtotime('-1 hour'))) && $countA == 0) {
		setcookie("skillA", "", time() - 6000, '/');
		$countA++;
		$q = ("UPDATE skill SET experience = experience + 0.5 WHERE pet_id = $pet_id and type = 'a'");
		$result = @mysqli_query($dbcon, $q);
	}
}

if(isset($_COOKIE["skillC"])){
	if (strval($_COOKIE["skillC"]) <= strval(date("Y/m/d H:i:s", strtotime('-1 hour'))) && $countC == 0) {
		setcookie("skillC", "", time() - 6000, '/');
		$countC++;
		$q = ("UPDATE skill SET experience = experience + 0.5 WHERE pet_id = $pet_id and type = 'c'");
		$result = @mysqli_query($dbcon, $q);
	}
}

?>