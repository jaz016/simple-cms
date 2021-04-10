<?php  

	class Database {


		private $con;
		private $host 	  = "localhost";
		private $username = "root";
		private $password = "";
		private $db_name  = "simplecms";


		public function __construct() {
			$this->con = new mysqli($this->host, $this->username, $this->password, $this->db_name);

			if(!$this->con)
				return $this->con->connect_error;
			else
				return $this->con;

		}


		public function get_data($query) {

			$data = array();
			if(!$result = $this->con->query($query))
				return $this->con->error;
			else {
				if($result->num_rows > 0) {
					while($row = $result->fetch_assoc())
						$data[] = $row;
					return $data;
				} else
					return false;
			}

		}



		public function execute($query) {

			if(!$result = $this->con->query($query))
				return false;

		}


		public function escape_string($string) {

			$data = $this->con->real_escape_string($string);
			return $data;

		}

	}

?>