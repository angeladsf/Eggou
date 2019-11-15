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
?>