<!-- 	CPRG 210 Exercise 11
     	Corinne Mullan
	 	May 25, 2018
	 	register.php       -->

<html>
	<head>
		<title>Register</title>
		<link rel="stylesheet" type="text/css" href="reset.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Kavivanar" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

		<script>

			function inputFocus() {

				// The "this" pointer references the element that generated the event, and
				// this.id is the id of this element.  The appropriate text message and
				// its vertical position can be determined using this.id.

				hintEl = document.getElementById("hint");

				switch(this.id) {

					case "fn":
						hintEl.innerHTML = "Please enter your first name";
						hintEl.style.top = this.offsetTop - 5;
						hintEl.style.visibility = "visible";
						break;

					case "ln":
						hintEl.innerHTML = "Please enter your last name";
						hintEl.style.top = this.offsetTop - 5;
						hintEl.style.visibility = "visible";
						break;

					case "ad":
						hintEl.innerHTML = "Please enter your address";
						hintEl.style.top = this.offsetTop - 5;
						hintEl.style.visibility = "visible";
						break;

					case "ct":
						hintEl.innerHTML = "Please enter your city";
						hintEl.style.top = this.offsetTop - 5;
						hintEl.style.visibility = "visible";
						break;

					case "pv":
						hintEl.innerHTML = "Please select your province from the drop down menu";
						hintEl.style.top = this.offsetTop - 10;
						hintEl.style.visibility = "visible";
						break;

					case "pc":
						hintEl.innerHTML = "Please enter your postal code in the form A1A1A1";
						hintEl.style.top = this.offsetTop - 10;
						hintEl.style.visibility = "visible";
						break;

					case "cn":
						hintEl.innerHTML = "Please enter your country (Canada)";
						hintEl.style.top = this.offsetTop - 10;
						hintEl.style.visibility = "visible";
						break;

					case "e1":
						hintEl.innerHTML = "Please enter your email as (e.g.) name@xxx.com";
						hintEl.style.top = this.offsetTop - 10;
						hintEl.style.visibility = "visible";
						break;

					case "e2":
						hintEl.innerHTML = "Please re-enter your email to confirm";
						hintEl.style.top = this.offsetTop - 10;
						hintEl.style.visibility = "visible";
						break;

					case "ph":
						hintEl.innerHTML = "Please enter your phone number as a 10 digit number";
						hintEl.style.top = this.offsetTop - 10;
						hintEl.style.visibility = "visible";
						break;

					default:
						hintEl.innerHTML = "";
						hintEl.style.top = "0px";
						hintEl.style.visibility = "hidden";
				}
			}

			// Include the inputBlur function so that the help message is erased if none of the input
			// fields have focus
			function inputBlur() {
				hintEl = document.getElementById("hint");
				hintEl.style.top = "0px";
				hintEl.innerHTML = "";
				hintEl.style.visibility = "hidden";
			}

			function validateFormSubmission(form) {

				/* First confirm the submission with the user.  If the user clicks cancel,
				   return false to cancel the submission.*/

				var response = confirm("Are you sure you want to submit this form?");

				if (!response)
					return false;

				/* If the user wishes to sumbit, proceed to validate the data.  The "required" attribute
				   has been set on the first name, last name and email input fields, so here we just need to
				   confirm that the two email entries match, confirm that the postal code follows the
				   correct format, and confirm that the telephone number (if entered) is 10 digits.  */

				if (form.user_email1.value != form.user_email2.value) {
					alert("The entered emails do not match!");
					form.user_email1.focus();
					return false;
				}

				/*  The postal code is of the form XdXdXd where X is any letter (allow upper or lower case
				    and d is any single digit.  The field is only 6 characters long, so we do not need to allow
					for a space.  The code just checks for the required pattern, and does not check for specific
					letters that do not appear in valid Canadian postal codes.

					The postal code is not a required field, so it can also be empty. */
				var postalCodePattern = /^[A-Za-z]\d[A-Za-z]\d[A-Za-z]\d$/;
				if (!postalCodePattern.test(form.postalcode.value) && form.postalcode.value != "") {
					alert("Postal code format is incorrect!");
					form.postalcode.focus();
					return false;
				}

				// Verify the phone number is either null, or contains 10 digits
				var telPattern = /^[0-9]{10}$/;
				if (!telPattern.test(form.phone.value) && form.phone.value != "") {
					alert("Telephone number is incorrect!");
					form.phone.focus();
					return false;
				}

				// Otherwise return true to proceed with the submission.
				return true;

			}
		</script>

	</head>

	<body>

		<?php include("header.php") ?>
		<?php include("menu.php"); ?>

		<div id="formdiv">

			<h2>Enter Customer Data</h2>
			
			<p id="hint"></p>

			<form method="post" action="http://localhost/bouncer.php">	 <!-- the php file name is just a placeholder for now -->

				<label for="firstname">First Name</label>
				<input type="text" id="fn" name="firstname" size="15" maxlength="15" required="required">
				&nbsp;<sup>*</sup>&nbsp;Required<br><br>

				<label for="lastname">Last Name</label>
				<input type="text" id ="ln" name="lastname" size="15" maxlength="15" required="required">
				&nbsp;<sup>*</sup><br><br>

				<label for="address">Address</label>
				<input type="text" id="ad" name="address" size="30" maxlength="50"><br><br>

				<label for="city">City</label>
				<input type="text" id="ct" name="city" size="15" maxlength="15">&emsp;

				<select id="pv" name="province">
					<option value="Choose Province">Choose Province</option>
					<option value="AB">AB</option>
					<option value="BC">BC</option>
					<option value="MB">MB</option>
					<option value="NS">NS</option>
					<option value="NB">NB</option>
					<option value="NL">NL</option>
					<option value="NT">NT</option>
					<option value="NU">NU</option>
					<option value="ON">ON</option>
					<option value="PE">PE</option>
					<option value="QC">QC</option>
					<option value="SK">SK</option>
					<option value="YT">YK</option>
				</select>
				<br><br>

				<label for="postalcode">Postal Code</label>
				<input type="text" id="pc" name="postalcode" size="6" maxlength="6"><br><br>

				<label for="country">Country</label>
				<input type="text" id="cn" name="country" size="15" maxlength="15" value="Canada"><br><br>

				<label for="user_email1">Email</label>
				&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
				<input type="email" id="e1" name="user_email1" required="required">
				&nbsp;<sup>*</sup><br><br>

				<label for="user_email2">Re-enter email</label>
				<input type="email" id="e2" name="user_email2" required="required">
				&nbsp;<sup>*</sup><br><br>

				<label for="phone">Phone</label>
				<input type="tel" id="ph" name="phone" size="10" maxlength="10"><br><br><br>

				<input type="submit" value="Submit Form" onclick="return validateFormSubmission(this.form);">
				<input type="reset" value="Reset Form" onclick="return confirm('Are you sure you want to reset this form?');">

				<script>

					// Add event listeners to each user input element on the form, one for when the element
					// gets focus, and the other for when the element loses focus (blur)
					var inputElements = document.getElementsByTagName("input");

					for (var i=0; i < inputElements.length; i++) {
						if (inputElements[i].type == "text" || inputElements[i].type == "email" || inputElements[i].type == "tel") {
							inputElements[i].addEventListener("focus", inputFocus);
							inputElements[i].addEventListener("blur", inputBlur);
						}
					}

					// Also add the event listeners to the drop-down selector for the province
					var selectEl = document.getElementById("pv");
					selectEl.addEventListener("focus", inputFocus);
					selectEl.addEventListener("blur", inputBlur);

				</script>

			</form>

		</div>

		<?php include("footer.php") ?>

	</body>

</html>
