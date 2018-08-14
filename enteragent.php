<!-- CPRG 210 Exercise 13
     Corinne Mullan
	 May 29, 2018
	 enteragent.php       -->

<?php
	# Add the session_start() function before any HTML.  Include this so that $_SESSION variables set in login.php can be
	# accessed from this page also
	session_start();
?>

<html>
	<head>
		<title>Enter Agent</title>
		<link rel="stylesheet" type="text/css" href="reset.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Kavivanar" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<?php 	# Include the Agent class declaration and addAgentData() function
			include_once("agent.php");
			include("functions.php"); 
		?>
		
		<script>
		
			function validateAgentData(form) {

				/* First confirm the submission with the user.  If the user clicks cancel,
				   return false to cancel the submission.*/

				var response = confirm("Are you sure you want to add a new agent to the database?");

				if (!response)
					return false;

				/* If the user wishes to sumbit, proceed to validate the data.  Do this on the client side to
				   minimize traffic between the client and servier.  */
				   
				/* The "required" attribute has been set all of the fields except the middle initial; however, the 
				   functionality of the "required" attribute seems to be browser-depended.  Repeat the checks here
				   and add a message if any of the required fields are blank.  */

				if ((form.firstname.value=="") || (form.lastname.value=="") || (form.phone.value=="") || (form.agent_email.value=="") || (form.agency.value=="")) {
					alert("Please enter data for all required fields!");
					return false;
				}
				   
				// Verify that the phone number is in the form (111) 222-3333.
				var phonePattern = /^\(\d{3}\) \d{3}-\d{4}$/;
				if (!phonePattern.test(form.phone.value)) {
					alert("Please enter the phone number in the correct format!");
					form.phone.focus();
					return false;
				}

				// Otherwise return true to proceed with the submission.
				return true;
			}
			
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
		<?php
			# Check to make sure the user has logged in, otherwise return to the login page
			if (!isset($_SESSION["loggedin"]) || !$_SESSION["loggedin"]) {
				header("Location: login.php");
			}
		?>

		<?php include("header.php") ?>
		<?php include("menu.php"); ?>
			
		<div id="formdiv">

			<h2>Enter New Agent Data</h2>

			<form method="post" action="enteragent.php#bottomOfPage">	

				<?php
					# This is the php script for handling the form submission.  Place here so that the field values are reset if
					# necessary before generating the form, and so the messages appear at the top of the form.
					if (isset($_POST['submitagent'])) {
					
						# Create a new Agent object with the data from $_POST
						$newagent = new Agent($_POST);

						$submitresult = addAgent($newagent);
					
						# On a successful submission, clear all the field values so the user can enter data for another
						# new agent.  Retain the old values for an unsuccessful submission, so the user can try again.
						if ($submitresult) {
							echo "<p id='msg' class ='success'>Agent added successfully!</p></br>";
							unset($_POST["firstname"]);
							unset($_POST["initial"]);
							unset($_POST["lastname"]);
							unset($_POST["phone"]);
							unset($_POST["agent_email"]);
							unset($_POST["position"]);
							unset($_POST["agency"]);
						}
						else {
							echo "<p id='msg' class='fail'>Failed to add agent.  Please try again.</p></br>";
						}

					}
				
				?>			

				<!-- All of the initial form values are set to $_POST['fieldname'], if these are set.  These values are not set before
				the form is submitted, and are unset (cleared) after successfully adding data to the database.  The entered values are
				retained and displayed if the SQL insert query was unsuccessful.  -->
				<label for="firstname">First Name</label>
				<input type="text" name="firstname" size="15" maxlength="15" required="required" value=<?php echo isset($_POST['firstname']) ? "\"" . $_POST['firstname'] . "\"":""; ?>>
				<br><br>
				
				<label for="initial">Middle Initial</label>
				<input type="text" name="initial" size="2" maxlength="2" value=<?php echo isset($_POST['initial']) ? "\"" . $_POST['initial'] . "\"":""; ?>>&emsp;(Optional)
				<br><br>

				<label for="lastname">Last Name</label>
				<input type="text" name="lastname" size="15" maxlength="15" required="required" value=<?php echo isset($_POST['lastname']) ? "\"" . $_POST['lastname'] . "\"":""; ?>>
				<br><br>
				
				<label for="phone">Phone</label>
				<input type="tel" name="phone" size="14" maxlength="14" required="required" value=<?php echo isset($_POST['phone']) ? "\"" . $_POST['phone'] . "\"":""; ?>>
				&emsp;E.g., (403) 555-1234
				<br><br>
				
				<label for="agent_email">Email</label>
				<input type="email" name="agent_email" required="required" value=<?php echo isset($_POST['agent_email']) ? "\"" . $_POST['agent_email'] . "\"":""; ?>>
				<br><br>
				
				<label for="position">Position</label>
				<select name="position">
					<option value="Junior Agent" <?php if (isset($_POST['position']) && $_POST['position'] == "Junior Agent") echo "selected"; ?>>Junior Agent</option>
					<option value="Intermediate Agent" <?php if (isset($_POST['position']) && $_POST['position'] == "Intermediate Agent") echo "selected"; ?>>Intermediate Agent</option>
					<option value="Senior Agent" <?php if (isset($_POST['position']) && $_POST['position'] == "Senior Agent") echo "selected"; ?>>Senior Agent</option>	
				</select>
				<br><br>
	
				<label for="agency">Agency ID</label>
				<input type="text" name="agency" size="1" maxlength="1" required="required" value=<?php echo isset($_POST['agency']) ? "\"" . $_POST['agency'] . "\"":""; ?>>
				<br><br><br>				

				<input type="submit" name="submitagent" value="Add Agent" onclick="return validateAgentData(this.form);">

			</form>
			
			<script>
			
				// Add onfocus event listeners to each user input element on the form.
				var inputElements = document.getElementsByTagName("input");
				
				for (var i=0; i < inputElements.length; i++) {
					if (inputElements[i].type != "submit") {
						inputElements[i].addEventListener("focus", inputFocus);
					}
				}

			</script>
			
		</div>
			
		<!-- Mark the bottom of the page so that, when the page is reloaded after a submit, it reloads with the 
		bottom of the page and buttons showing.  Refer to action="" for the form above. -->
		<a name="bottomOfPage"></a>
			
		<?php include("footer.php"); ?>

	</body>

</html>
