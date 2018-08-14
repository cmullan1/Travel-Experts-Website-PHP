<!-- CPRG 210 Exercise 9 Rev 2
     Corinne Mullan
	 May 24, 2018 
	 index.php          -->
	 
<html>
	<head>
		<title>Welcome to Travel Experts</title>
		<link rel="stylesheet" type="text/css" href="reset.css">
		<link rel="stylesheet" type="text/css" href="style.css">
		<link href="https://fonts.googleapis.com/css?family=Kavivanar" rel="stylesheet">
		<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
		
		<script>
		
			/*  The following functions are used to load and display a series of images and
			descriptions and display them in a table.  The three arrays used for the image, descriptions 
			and associated URLs are declared as global variables so they can be accessed by all functions.  */
			var arrImages = new Array();
			var arrDescs = new Array();
			var arrURLs = new Array();
				
			/* Load the image files, descriptions and associated URLs that will appear in the table on the 
			main page.  Don't bother using a loop here, since the image files names and descriptions 
			must be entered individually.  */
			function loadImages() {
				
				arrImages[0] = new Image();
				arrImages[0].src = "images/stonehenge.png";
				
				arrImages[1] = new Image();
				arrImages[1].src = "images/paris.png";
				
				arrImages[2] = new Image();
				arrImages[2].src = "images/hawaii.png";
				
				arrImages[3] = new Image();
				arrImages[3].src = "images/safari.png";

				// Load the image descriptions
				arrDescs[0] = "England";
				arrDescs[1] = "Paris";
				arrDescs[2] = "Hawaii";
				arrDescs[3] = "Africa";
				
				// Load the associated URLs
				arrURLs[0] = "http://www.english-heritage.org.uk/visit/places/stonehenge/";
				arrURLs[1] = "https://en.parisinfo.com/";
				arrURLs[2] = "https://www.hawaii-guide.com/";
				arrURLs[3] = "https://www.go2africa.com/tours-safaris";
			}
			
			// Build and display the table with the photos and descriptions
			function displayPhotoTable() {
			
				// First load the images and their descriptions and urls into the arrays
				loadImages();
			
				tablediv = document.getElementById("destinations");
				
				// Create the table and header row
				var tbl = document.createElement("table");
				var thdr1 = document.createElement("th");
				var thdr1_txt = document.createTextNode("Image");
				var thdr2 = document.createElement("th");
				var thdr2_txt = document.createTextNode("Description");
					
				thdr1.appendChild(thdr1_txt);
				tbl.appendChild(thdr1);
				thdr2.appendChild(thdr2_txt);
				tbl.appendChild(thdr2);
				
				/* Create each row of the table, and append child element to their parent.
				Use the length of the arrDescs array to determine how many rows to add to the table.
				This assumes that the number of images in arrImages and the number of URLs in arrURLs matches the 
				number of descriptions in arrDescs. */
				for (var i = 0; i < arrDescs.length; i++) {
					var trow = document.createElement("tr");
					
					/* Create a cell in the table.  The cell will display the image, and will have a an event handler
					to handle mouse clicks.  The event handler is named openNewPage as it will open a new web page.  It
					is called as < ... onclick = "openNewPage(i)" ... > where i is the index of the row in the table.
					For example, openNewPage(this, 1) calls the openNewPage function for the second row in the table.  */
					var tdata1 = document.createElement("td");
					tdata1.innerHTML = "<div onclick='openNewPage(" + i + ")'><img class='tbl_img' src= '" + arrImages[i].src + "'></div>";

					var tdata2 = document.createElement("td");
					var tdata2_txt = document.createTextNode(arrDescs[i]);
	
					tbl.appendChild(trow);
					trow.appendChild(tdata1);
					tdata2.appendChild(tdata2_txt);
					trow.appendChild(tdata2);
				}
				
				tablediv.appendChild(tbl);
			}
			
			/* The openNewPage(this, i) function is invoked when image in the (i+1)th row of the table is clicked.  This
			function will open the web page associated with the image in a new window (i.e., new browser tab), by using the 
			URL stored in the array element arrURLs[i].  The new window will close after 5 seconds = 5000 milliseconds.  Although
			this would not be desired behaviour in a real website, it illustrates the use of the setTimeout JavaScript function.  */
			function openNewPage(i) {
				var newWindow = window.open(arrURLs[i]);
				
				// Bug:  newWindow.close() seems to work in Firefox and Chrome but not IE
				var timer = setTimeout(function(){newWindow.close();}, 5000);
			}

		</script>
		
	</head>
	
	<body onload="displayPhotoTable()";>

		<?php include("header.php"); ?>
		<?php include("menu.php"); ?>
		
		<div id="destinations">
		
			<!-- Create a custom welcome banner depending on the time of day.  The time zone must
			first be changed to "America/Edmonton" from the default of Europe/Berlin in the file
			c:\xampp\php\php.ini.  (Or php.ini could be modified.)  -->
			<?php
				# First set the time zone
				date_default_timezone_set("America/Edmonton");
				
				# Return the time as an associative array
				$time_assoc_arr = (localtime(time(), true));

				# Obtain the hours.  Hours < 12 indicates morning, 12 <= hours < 17 indicates afternoon,
				# and hours >= 17 indicates night.
				if ($time_assoc_arr["tm_hour"] < 12) {
					echo "<h2>Good morning!</h2>";
				}
				elseif ($time_assoc_arr["tm_hour"] >= 12 && $time_assoc_arr["tm_hour"] < 17) {
					echo "<h2>Good afternoon!</h2>";
				}
				else {
					echo "<h2>Good evening!</h2>";
				}
			?>
	
			<h2>Some of our destinations...</h2>
			<br>
			
		</div>

		<br>
		<br>
		
		<?php include("footer.php"); ?>
		
	</body>
	

</html>