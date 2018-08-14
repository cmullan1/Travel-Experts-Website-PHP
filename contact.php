<!-- CPRG 210 Exercise 9 Rev 2
     Corinne Mullan
	 May 24, 2018 
	 contact.php        -->
	 
<html>
	<head>
		<title>Contact</title>
		<link rel="stylesheet" type="text/css" href="reset.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Kavivanar" rel="stylesheet"> 
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
	</head>
	
	<body>
	
		<?php include("header.php") ?>
		<?php include("menu.php"); ?>
		
		<section>
			<h2>Travel Experts Main Office</h2>
			<p>123 4<sup>th</sup> Avenue N.W.
			<br>Calgary, Alberta
			<br>T2N 1A1
			</p>
			<p>(403)555-1230</p>
		
			<br>
			
			<h2>Agents</h2>
			<ul>
				<li>Alice Smith
						<ul class="list_nobullets">
							<li>Phone (403)555-1234</li>
							<li>Email <a href="mailto:alice.smith@travelexperts.com">alice.smith@travelexperts.com</a></li>
						</ul>
				</li>
				<br>
				<li>Bob Cooper
					<ul class="list_nobullets">
						<li>Phone (403)555-1235</li>
						<li>Email <a href="mailto:bob.cooper@travelexperts.com">bob.cooper@travelexperts.com</a></li>
					</ul>
				</li>
				<br>
				<li>Charlotte Johnson
					<ul class="list_nobullets">
						<li>Phone (403)555-1236</li>
						<li>Email <a href="mailto:charlotte.johnson@travelexperts.com">charlotte.johnson@travelexperts.com</a></li>
					</ul>
				</li>
				<br>
			</ul>
		</section>
		
		<aside>
			<br><br>
			<iframe id="mapframe" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d40367.35770790337!2d-114.09855891997458!3d51.04517363398867!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x53716fb793ff22d1%3A0x754eda88b44fa0cc!2s4+Ave+NW%2C+Calgary%2C+AB!5e0!3m2!1sen!2sca!4v1526415001846" width="400" height="300" allowfullscreen></iframe>
			<br><br>
		</aside>
		
		<?php include("footer.php") ?>
		
	</body>
	

</html>