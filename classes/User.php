<?php  

	class User {

		public 	$is_logged_in;
		private $user_id;
		private $name;
		private $access_level;


		public function set_details($user_id, $name, $access_level) {
			$this->user_id = $user_id;
			$this->name = $name;
			$this->access_level = $access_level;
		}

		public function get_user_id() {
			return $this->user_id;
		}

		public function get_name() {
			return $this->name;
		}

		public function get_access_level() {
			return $this->access_level;
		}


		public function add_new($firstname, $lastname, $username, $password, $access_level) {
			$password = password_hash($password, PASSWORD_BCRYPT);
			$query = "INSERT INTO users
					  (firstname, lastname, username, password, access_level)
					  VALUES
					  ('$firstname','$lastname','$username','$password', '$access_level')";
			$GLOBALS['db']->execute($query);
		}
	}

?>