<!-- CPRG 210 Exercise 12
     Corinne Mullan
	 May 28, 2018 
	 menu.php          -->

<nav>
	<script>
		function menuIconClick() {
			var menu_el = document.getElementById("menu");
			if (menu_el.className === "navmenu") {
				menu_el.className += " responsive";
			} else {
				menu_el.className = "navmenu";
			}
		}
	</script>
	
	<ul class="navmenu" id="menu">
		<li><a href="index.php">Home</a></li>
		<li><a href="contact.php">Contact</a></li>		
		<li><a href="register.php">Register</a></li>
		<li><a href="links.php">Links</a></li>
		<li><a href="login.php">Login</a></li>
	</ul>
	<a href="javascript:void(0);" class="navmenu icon" onclick="menuIconClick();"><i class="fa fa-bars"></i></a>

</nav>

<hr class="hline">