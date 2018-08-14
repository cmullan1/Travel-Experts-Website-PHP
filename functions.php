<!-- CPRG 210 Exercise 13
     Corinne Mullan
	 May 29, 2018 
	 functions.php          -->
	 
<?php
	# Include the Agent class declaration
	include_once("agent.php");
	
	# The addAgentData() function inserts the agent data obtained in the associative array passed to the
	# function into the "agents" table in the "travelexperts" database.
	
	# No data validation is done as the data is obtained directly from test_functions.php
	# where the values are hard-coded.
	
	function addAgent($agt) {
		
		# Create a new mySQLi object to connect to the "travelexperts" database
		$dbconnection = new mysqli("localhost", "root", "", "travelexperts");
			
		if ($dbconnection->connect_error) {
			die("Connection failed: " . $dbconnection->connect_error);
		} 
		
		# Create the SQL statement using the data in the $agt Agent object.  The Agent object contains values for 
		# every field in the agents table, so the field names do not need to be specified.
		$sql = "INSERT INTO agents VALUES (" . $agt->toString() . ")";
		
		$result = $dbconnection->query($sql);
		
		# Log the SQL query and result to a log file, sqllog.txt.  This file will be created if it doesn't exist,
		# otherwise text will be appended to the end of the existing file.  "\r\n" creates a line break.
		$log = fopen("sqllog.txt", "a");
		fwrite($log, $sql . "\r\n");
		if ($result) {
			fwrite($log, "SUCCESS \r\n");
		}
		else {
			fwrite($log, "FAIL \r\n");
		}
		fclose($log);
		
		$dbconnection->close();
		
		# Return a boolean value.  $result is true if the insert query was successful and false if unsuccessful.
		return $result;
	}
?>