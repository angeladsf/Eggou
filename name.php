<?php require ('session/mysql_connection.php');
session_start() ;
// Redirect if not logged in.
if ( !isset( $_SESSION[ 'player_id' ] ) ) { 
require ( 'session/login_functions.php' ) ; load() ; }

if(isset($_GET["specie"])){
        $specie = $_GET["specie"];
    }

	$player_id = $_SESSION['player_id'];

    $result = mysqli_query($dbcon, "SELECT Pet_Id as id FROM Pet ORDER BY Pet_id DESC LIMIT 1");
	$row = mysqli_fetch_array($result);
	$pidmax=$row['id'];
	$new_id = $pidmax + 1;

	if ($_SERVER['REQUEST_METHOD'] == 'POST') {
		$errors = array(); // Start an errors array
		// Trim the username
		$name = trim($_POST['name']);
		// Strip HTML tags and apply escaping
		$stripped = mysqli_real_escape_string($dbcon, strip_tags($name));
		// Get string lengths
		$strLen = mb_strlen($stripped, 'utf8');
		// Check stripped string
		if( $strLen < 1 ) {
			$errors[] = 'You forgot to enter the name of your pet.';
		}else{
			$name = $stripped;
		}
			//Set the email variable to FALSE
			$e = FALSE;									
			// Check that an email address has been entered				
			
			if (empty($errors)) { // If there are no errors. register the user in the database
				// Make the query
				$q = "INSERT INTO pet(Hygiene, Hunger, Name, Happiness, Health, Energy, Pet_Id, Specie, Player_ID, Experience) VALUES (50,50,'$name',50,50,50,$new_id,'$specie',$player_id, 0)";		
				$result = @mysqli_query($dbcon, $q); // Run the query
				
				
				$q1 = "INSERT INTO skill (type, experience, pet_id) VALUES ('a', 0, $new_id);
				INSERT INTO skill (type, experience, pet_id) VALUES ('b',0, $new_id);
				INSERT INTO skill (type, experience, pet_id) VALUES ('c',0, $new_id);";		
				$result1 = @mysqli_query ($dbcon, $q1); 
				
				
				if ($result) { // If the query ran OK
					header ("location: kitchen.php"); 
					exit();
				} else { // If there was a problem
					// Error message
					echo '<h2 class = "title_error">System Error</h2>
					<p class="error">This operation is not possible due to a system error. We apologize for any inconvenience.</p>'; 
					// Debugging message:
					echo '<p>' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
				} // End of if ($result)
				mysqli_close($dbcon); // Close the database connection
				// Include the footer and quit the script
				include ('includes/footer.php'); 
				exit();
			} else { // Display the errors
				echo '<h2>Error!</h2>
				<p class="error">The following error(s) occurred:<br>';
				foreach ($errors as $msg) { // Display each error
					echo " - $msg<br>\n";
				}
				echo '</p><h3>Please try again.</h3><p><br></p>';
			}// End of if (empty($errors))
		} // End of the main Submit conditionals
		?>

<!doctype html>
<html lang=en>
	<head>
		<title>Give it a name</title>
		<meta charset=utf-8>
		<link rel="stylesheet" type="text/css" href="eggou.css">
	</head>

	<body>

		<style>
			#ok{
				padding: 1% 2%;
				font-size: 12pt;
				background-color: #639eda;
				color: white;
				font-weight: bold;
				border: none;
			}
			#content{
				padding: 8% 0;
			}

			#name{
				padding: 7px 10px;
				margin: 8px 0;
				display: inline-block;
				border: 1px solid #ccc;
				border-radius: 4px;
				box-sizing: border-box;
			}

		</style>

		<div id="container">
		<?php include("includes/header.php"); ?>
		<div id="content"><!--Start of the page-specific content-->
		<div id="after_choice">
			<h1>It's a <?php echo $specie; ?>!</h1><br>
			<h2>Now give it a name and you're ready to play!</h2>
			<br><br>
            <form action="name.php?specie=<?php echo $specie?>" method = 'post'>
                <span>Name: <span><input id = "name" type="text"id="name" name = "name" size = '50' maxlength = '20' value="<?php if (isset($_POST['name'])) echo $_POST['name']; ?>"> 
                <br><br>
				<input id = "ok" type = 'submit' value = 'OK'>
            </form>

		</div></div></div>

		<?php include ('includes/footer.php'); ?>

	</body>
</html>