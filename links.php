<!-- CPRG 210 Exercise 13
     Corinne Mullan
	 May 29, 2018 
	 links.php          -->
	 
<html>
	<head>
		<title>Links</title>
		<link rel="stylesheet" type="text/css" href="reset.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Kavivanar" rel="stylesheet"> 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<?php
			# Include the php file that defines the $travel_destinations array containing URLs for various
			# travel destinations
			include_once("variables.php");
		?>
	</head>
	
	<body>
		<?php include("header.php"); ?>
		<?php include("menu.php"); ?>
		
		<div>
			<h2>Click the following links for more information...</h2>
		</div>
		
		<br>
		
		<?php
		
			# Create a table with six rows and two columns
			print("<table>");

			$i = 0;
			foreach ($travel_destinations as $key => $value) {
				print("<tr>");
					print("<td id='linkscell'>" . ++$i . "</td>");
					print("<td id='linkscell'><a href='" . $key . "'>" . $value . "</a></td>");
				print("</tr>");
			}
						
			print("</table>");
			
		?>
		
		<br><br>
		
		<?php include("footer.php"); ?>
		
	</body>

</html>