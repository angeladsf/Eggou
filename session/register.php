<!doctype html>
<html lang=en>
	<head>
		<title>Registration page</title>
		<meta charset=utf-8>
		<link rel="stylesheet" type="text/css" href="../eggou.css">
	</head>

	<body>
		<div id="container">
			<?php include("../includes/header_register.php"); ?>
		<div id="content">
		<?php
		require ('mysql_connection.php');
		
		if ($_SERVER['REQUEST_METHOD'] == 'POST') {
			$errors = array(); // Começar um array de erros

			$unme = trim($_POST['username']);
			$stripped = mysqli_real_escape_string($dbcon, strip_tags($unme));
			// comprimento do nome
			$strLen = mb_strlen($stripped, 'utf8');

			if( $strLen < 1 ) {
				$errors[] = '<p id="err_msg">You forgot to enter your secret username.</p>';
			}else{
				$username = $stripped;
			}

			$e = FALSE;									
			// verificar se email foi introduzido			
			if (empty($_POST['email'])) {
				$errors[] = '<p id="err_msg">You forgot to enter your email address.</p>';
			}
			//Remover espaços no início/fim
			if (filter_var((trim($_POST['email'])), FILTER_VALIDATE_EMAIL)) {	
				$e = mysqli_real_escape_string($dbcon, (trim($_POST['email'])));
			}else{									
				$errors[] = '<p id="err_msg">Your email is not in the correct format.</p>';
			}
			// verificar e confirmar password
			if (empty($_POST['psword1'])){
				$errors[] ='<p id="err_msg">Please enter a valid password.</p>';
			}
			if(!preg_match('/^\w{8,16}$/', $_POST['psword1'])) {
				$errors[] = '<p id="err_msg">Invalid password, use 8 to 12 characters and no spaces.</p>';
			}
			if(preg_match('/^\w{8,16}$/', $_POST['psword1'])) {
				$psword1 = $_POST['psword1'];
			}
			if($_POST['psword1'] == $_POST['psword2']) {
				$p = mysqli_real_escape_string($dbcon, trim($psword1));
			}else{
				$errors[] = '<p id="err_msg">Your two password do not match.</p>';
			}
			if (empty($errors)) { // registar caso não existam erros
				$result = mysqli_query($dbcon, "SELECT Player_Id as id FROM Player ORDER BY Player_Id DESC LIMIT 1");
				$row = mysqli_fetch_array($result);
				$pidmax=$row['id'];
				$new_id = $pidmax + 1;

				$date = date("Y-m-d h:i:sa");
				$sqlDate = date('Y-m-d h:i:sa', strtotime($date));
				$q = "INSERT INTO player (player_id, username, email, psword, coins, close_date) VALUES ($new_id, '$username', '$e', SHA1('$p'), 20, '$sqlDate')";		
				$result = @mysqli_query ($dbcon, $q); 

			
				if ($result) { // se a query correu
					header ("location: ../choice.php"); 
					exit();
				} else {
					echo '<h3 class = "title_err">System Error</h3>
					<p id="err_msg">You could not be registered due to a system error. We apologize for any inconvenience.</p>'; 
					// mensagem de debug
					echo '<p id="err_msg">' . mysqli_error($dbcon) . '<br><br>Query: ' . $q . '</p>';
				} 
				mysqli_close($dbcon); // fechar conexão à base de dados

				include ('../includes/footer.php'); 
				exit();
			} else { // mostrar erros
				echo '<h3 class = "title_err">Error!</h3>
				<p id="err_msg">The following error(s) occurred:<br>';
				foreach ($errors as $msg) {
					echo '<p id = "err_msg">- $msg<br>\n</p>';
				}
				echo '</p><h3 class = "title_err">Please try again.</h3><p><br></p>';
			}
		}
		?>

			<div id="midcol" class = 'register_form'>
				<h2>Membership Registration</h2><br>
				<h5>All the fields must be filled out.</h5>
				<h5>If your register is successful, you will be redirected to the Login page.</h5><br>
				<form action="register.php" method="post">
				
				<div class = "row">
				<div class = "left-col">
					<label class="label" for="username">Username: </label>
					<input  minlength= '8' required id="username" type="text" name="username" size="16" maxlength="16" value="<?php if (isset($_POST['username'])) echo $_POST['username']; ?>">
					<br><br><label class="label" for="psword1">Password: </label>
					<input minlength= '8' required id="psword1" type="password" name="psword1" size="16" maxlength="16" value="<?php if (isset($_POST['psword1'])) echo $_POST['psword1']; ?>" >
				
				</div><div class = "right-col">
					
				<label class="label" for="email">Email Address: </label>
					<input required id="email" type="text" name="email" size="16" maxlength="32" value="<?php if (isset($_POST['email'])) echo $_POST['email']; ?>" >
					
					<br><br><label class="label" for="psword2">Confirm Password: </label>
					<input required id="psword2" type="password" name="psword2" size="16" maxlength="16" value="<?php if (isset($_POST['psword2'])) echo $_POST['psword2']; ?>" >
					</div>
				</div>
					<br><p><input id="submit" type="submit" name="submit" value="Register"></p>
				
				</form>

		</div></div></div>

		<?php include ('../includes/footer.php'); ?>

	</body>
</html>