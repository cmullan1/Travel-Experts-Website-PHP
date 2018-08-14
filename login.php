<!-- CPRG 210 Exercise 13
     Corinne Mullan
	 May 29, 2018
	 enteragent.php       -->

<?php
	# Add the session_start() function before any HTML.  $_SESSION["loggedin"] is set below upon successful login.
	session_start();
?>

<html>
	<head>
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="reset.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Kavivanar" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<script>
			// Whenever the user or password input text boxes have focus, clear any error message that may have been displayed
			function inputFocus() {
				err_el = document.getElementById("msg");
				if(err_el) {
					err_el.style.display = "none";
				}
			}
		</script>
		
	</head>

	<body>

		<?php include("header.php") ?>
		<?php include("menu.php"); ?>
			
		<div id="formdiv">

			<h2>Enter Login Credentials</h2>

			<form method="post" action="login.php">	

				<?php
					# This is the php script for handling the login submission.  
					if (isset($_POST["login"])) {
						
						# Open the users.txt file that contains the user ids and hashed passwords.  Catch any errors (e.g., file does
						# not exist) and generate an error message.
						try {
							if (!file_exists("users.txt")) {
								throw new Exception("Could not open the users.txt file!");
							}
							
							$userfile = fopen("users.txt", "r");
							if (!$userfile) {
								throw new Exception("Could not open the users.txt file!");
							}
						}
						catch (Exception $e) {
							die("<p id = 'msg' class='fail'>Error (File: " . $e->getFile() . ", line " . $e->getLine()."): " . $e->getMessage() . "</p>");
						}
						
						# Test code for generating hashed passwords to put in the users.txt file
						#echo password_hash($_POST["password"], PASSWORD_DEFAULT);
		
						# Loop through the users.txt file and load the user ids and passwords into the "credentials" associative array.
						# User ids and hashed passwords (generated previously using the password_hash("pwd", PASSWORD_DEFAULT) function) 
						# are stored in subsequent lines in the file.  Use the trim() function to ensure any  whitespace/new line characters 
						# have been stripped off.
						$credentials = array();
						while(!feof($userfile)) {
							$temp[0] = trim(fgets($userfile));
							$temp[1] = trim(fgets($userfile));
							$credentials[$temp[0]] = $temp[1];
						}
						
						# Check the user id and password submitted by the user against the valid user id/hashed password combinations
						# in the associative array.  Use the built-in php function password_verify().
						# Ensure that the password and username, both as entered by the user and as read from the file, are set/exist.  Use the
						# trim() function to ensure any whitespace (including new line characters) is ignored.
						if (isset($_POST["username"]) && isset($_POST["password"]) && array_key_exists($_POST["username"], $credentials) && password_verify($_POST["password"], $credentials[$_POST["username"]])) {

							# Set a $_SESSION variable to indicate that the user is logged in
							$_SESSION["loggedin"] = true;
							
							# Redirect the user to the enteragent.php page
							header('Location: enteragent.php');	
						}
						else {
							$_SESSION["loggedin"] = false;
							echo "<p id='msg' class='fail'>Invalid username or password!</p><br>";
						}
									
						# Close the file
						fclose($userfile);
					}
				
				?>			

				<label for="username">Username</label>
				<input type="text" name="username" id="user" size="15" maxlength="15" required="required">
				<br><br>
				
				<label for="password">Password</label>
				<input type="password" name="password" id="pword" size="15" maxlength="15" required="required">
				<br><br>

				<input type="submit" name="login" value="Login">
				
				<script>
					// Add onfocus event listeners to each user input element on the form.
					var inputElement = document.getElementById("user");
					inputElement.addEventListener("focus", inputFocus);
					
					inputElement = document.getElementById("pword");
					inputElement.addEventListener("focus", inputFocus);
				</script>

			</form>
			
		</div>
			
		<?php include("footer.php"); ?>

	</body>

</html>
