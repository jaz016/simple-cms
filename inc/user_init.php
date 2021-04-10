<?php


	$current_user = new User();


	// if there's an active user session
	if(isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		// get name and access level
		$query = "SELECT firstname, lastname, access_level
				  FROM users
				  WHERE id = '".$_SESSION['user_id']."'";
		$row = array_shift($GLOBALS['db']->get_data($query));
		$current_user->is_logged_in = true;
		$current_user->set_details($_SESSION['user_id'], $row['firstname'] . " " . $row['lastname'], $row['access_level']);
	} else {
		$current_user->is_logged_in = false;
	}
	

?>