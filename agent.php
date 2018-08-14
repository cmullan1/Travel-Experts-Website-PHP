<!-- CPRG 210 Exercise 13
     Corinne Mullan
	 May 29, 2018 
	 agent.php          
	 This file defines the Agent class -->
	 
<?php

	class Agent {
		
		# The properties have the same names as the database fields in the agents table
		private $AgentId;
		private $AgtFirstName;
		private $AgtMiddleInitial;
		private $AgtLastName;
		private $AgtBusPhone;
		private $AgtEmail;
		private $AgtPosition;
		private $AgencyId;
		
		# Constructor to create an Agent object based on the input values from the form on enteragent.php,
		# as contained in $_POST.  Note that $_POST does not include an AgentId, as this is set to AUTOINCREMENT
		# in the agents table, and will be generated automatically by the database.  Here, set AgentId to null
		# as a placeholder.
		public function __construct($postarr) {
			$this->AgentId = "";
			$this->AgtFirstName = $postarr["firstname"];
			$this->AgtMiddleInitial = $postarr["initial"];
			$this->AgtLastName = $postarr["lastname"];
			$this->AgtBusPhone = $postarr["phone"];
			$this->AgtEmail = $postarr["agent_email"];
			$this->AgtPosition = $postarr["position"];
			$this->AgencyId = $postarr["agency"];
		}
		
		# Get methods for each property
		public function getAgentId() {
			return $this->AgentId;
		}
		public function getAgtFirstName() {
			return $this->AgtFirstName;
		}
		public function getAgtMiddleInitial() {
			return $this->AgtMiddleInitial;
		}
		public function getAgtLastName() {
			return $this->AgtLastName;
		}
		public function getAgtBusPhone() {
			return $this->AgtBusPhone;
		}
		public function getAgtEmail() {
			return $this->AgtEmail;
		}
		public function getAgtPosition() {
			return $this->AgtPosition;
		}
		public function getAgencyId() {
			return $this->AgencyId;
		}
		
		# Set methods for each property 
		public function setAgentId($id) {
			$this->AgentId = $id;
		}
		public function setAgtFirstName($fname) {
			$this->AgtFirstName = $fname;
		}
		public function setAgtMiddleInitial($mi) {
			$this->AgtMiddleInitial = $mi;
		}
		public function setAgtLastName($lname) {
			$this->AgtLastName = $lname;
		}
		public function setAgtBusPhone($phone) {
			$this->AgtBusPhone = $phone;
		}
		public function setAgtEmail($email) {
			$this->AgtEmail = $email;
		}
		public function setAgtPosition($position) {
			$this->AgtPosition = $position;
		}
		public function setAgencyId($agencyid) {
			$this->AgencyId = $agencyid;
		}
		
		# The toString() method takes the values of all the properties and concatenates them into a comma delimited string, 
		# in the same order as the order of the fields in the agents database table.  Place single quotes around each value,
		# as required in the SQL statement to insert the values into the database.
		public function toString() {
			$valuestring = "'" . $this->AgentId . "', ";
			$valuestring = $valuestring . "'" . $this->AgtFirstName . "', ";
			$valuestring = $valuestring . "'" . $this->AgtMiddleInitial . "', ";
			$valuestring = $valuestring . "'" . $this->AgtLastName . "', ";
			$valuestring = $valuestring . "'" . $this->AgtBusPhone . "', ";
			$valuestring = $valuestring . "'" . $this->AgtEmail . "', ";
			$valuestring = $valuestring . "'" . $this->AgtPosition . "', ";
			$valuestring = $valuestring . "'" . $this->AgencyId . "'";
			
			return $valuestring;
		}
	}
	
?>