<?php
// Was the form submitted?
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Connect to the database .
    require('mysql_connection.php');
    // Load the validation functions.
    require('login_functions.php');
    // Check the login data
    list($check, $data) = validate($dbcon, $_POST['username'], $_POST['psword']);
    // If successful, set session data and display the forum.php page
    if ($check) {
        // Access the session details
        session_start();
        $_SESSION['player_id'] = $data['player_id'];
        $_SESSION['username']  = $data['username'];
        
        $player_id = $_SESSION['player_id'];
        
        $query    = ("SELECT pet_id FROM pet WHERE pet.player_id=$player_id");
        $row      = @mysqli_query($dbcon, $query);
        $num_rows = mysqli_num_rows($row);
        

        if ($num_rows > 0) {
            include ("updateNeeds.php");
            load('../kitchen.php');
        } else {
            load('../choice.php');
        }
    }
    // If it fails, set the error messages
    else {
        $errors = $data;
    }
    // Close the database connection.
    mysqli_close($dbcon);
}
// If it unsuccessful continue to display the login page
include ('login.php');
?>