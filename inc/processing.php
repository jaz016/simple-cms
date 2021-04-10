<?php

	session_start();
	include '../classes/autoloader.php';
	include 'connection.php';


	// login script
	if(isset($_POST['login'])) {


		// sanitize inputs
		$username = htmlspecialchars($_POST['username']);
		$username = $GLOBALS['db']->escape_string($username);
		$password = htmlspecialchars($_POST['password']);
		$password = $GLOBALS['db']->escape_string($password);



		// check if user credentials exists
		if($row = array_shift($GLOBALS['db']->get_data("SELECT id, username, password FROM users WHERE username = '$username'"))) {
			if(password_verify($password, $row['password'])) {
				$_SESSION['logged_in'] = true;
				$_SESSION['user_id'] = $row['id'];
				echo "success";
			}
		}
	}





	// add/edit slide script
	if(isset($_POST['process-slide'])) {


		$image = microtime() . "_" . $_FILES['slide-image']['name'];
		$caption = htmlspecialchars($_POST['slide-caption']);
		$caption = $GLOBALS['db']->escape_string($caption);
		$file_type = strtolower(pathinfo($image, PATHINFO_EXTENSION));
		$target_file = "../uploads/".$image;
		$slide_no = htmlspecialchars($_POST['slide-no']);
		$slide_no = $GLOBALS['db']->escape_string($slide_no);
		$action = htmlspecialchars($_POST['slide-action']);
		$action = $GLOBALS['db']->escape_string($action);;



		// check if file is a valid image file type
		switch ($file_type) {
			case 'jpg':
			case 'jpeg':
			case 'png':



				// if $action is 'add', insert the slide info in db
				if($action == "add") {
					$GLOBALS['db']->execute("INSERT INTO slides 
											 (slide_image, slide_caption) 
										 	 VALUES ('$image', '$caption')");
				// else if 'edit', update the slide info in db
				} else if($action == "edit") {
					$GLOBALS['db']->execute("UPDATE slides 
											 SET slide_image = '$image',
											 slide_caption = '$caption'
											 WHERE id = '$slide_no'");
				}

				echo "success";
				move_uploaded_file($_FILES['slide-image']['tmp_name'], $target_file);
				break;
			
			default:
				echo "error";
				break;
		}
	}



	// delete slide script
	if(isset($_POST['delete-slide'])) {
		$slide_no = htmlspecialchars($_POST['slide-no']);
		$slide_no = $GLOBALS['db']->escape_string($slide_no);

		$slide = new Content();
		$slide->set_id($slide_no);
		$slide->delete();
	}




	// fetch post categories script
	if(isset($_POST['fetch-post-categories'])) {


		 $blog_post = new BlogPost();
		 $category_array = $blog_post->fetch_categories();
		 if(!$category_array)
		 	echo "false";
		 else {
		 	echo "<ul>";
		 	foreach ($category_array as $category) :
		 	?>
	
			<li><?php echo $category['category_name']; ?><a href="#" class="delete-category" data-category-no="<?php echo $category['id']; ?>"><i class="fa fa-times"></i></a></li>
	
		 	<?php
		 	endforeach;
		 	echo "</ul>";
		 }


	}


	// add post category script
	if(isset($_POST['add-category'])) {
		$category = htmlspecialchars($_POST['category-name']);
		$category = $GLOBALS['db']->escape_string($category);


		// if category doesn't exist, insert it
		if(!$row = $GLOBALS['db']->get_data("SELECT id FROM blog_post_categories WHERE category_name = '$category'")) {


			$GLOBALS['db']->execute("INSERT INTO blog_post_categories (category_name) VALUES ('$category')");
			echo "success";

		}

	}



	// delete category script
	if(isset($_POST['delete-category'])) {
		$category_no = htmlspecialchars($_POST['category-no']);
		$category_no = $GLOBALS['db']->escape_string($category_no);
		$GLOBALS['db']->execute("DELETE FROM blog_post_categories WHERE id = '$category_no'");
	}


	// publish blog post script
	if(isset($_POST['publish-post'])) {
		$post_title = htmlspecialchars($_POST['post-title']);
		$post_title = $GLOBALS['db']->escape_string($post_title);
		$post_content = htmlspecialchars($_POST['post-content']);
		$post_content = $GLOBALS['db']->escape_string($post_content);	
		$post_category = htmlspecialchars($_POST['post-category']);
		$post_category = $GLOBALS['db']->escape_string($post_category);



		if(isset($_FILES['post-image']['name']) && $_FILES['post-image']['name'] != "") {
			$post_image = microtime() . "_" . $_FILES['post-image']['name'];
			$file_type = strtolower(pathinfo($post_image, PATHINFO_EXTENSION));
			$target_file = "../uploads/".$post_image;	
		} else {
			$post_image = "";
			$file_type = "";
		}


		// check if file is a valid image file type
		switch ($file_type) {
			case 'jpg':
			case 'jpeg':
			case 'png':
			case '':


				$GLOBALS['db']->execute("INSERT INTO blog_posts
							  		    (category_id, title, content, post_img, author_id, date_posted, date_modified, comments_allowed)
							            VALUES
							  		    ('$post_category','$post_title','$post_content','$post_image','".$_SESSION['user_id']."',NOW(),NOW(),1)");

				if($post_image != "")
					move_uploaded_file($_FILES['post-image']['tmp_name'], $target_file);


				echo "success";
				break;


			default:
				echo "error";
				break;
		}


	}


	// delete post script
	if(isset($_POST['delete-post'])) {
		$post_no = htmlspecialchars($_POST['post-no']);
		$post_no = $GLOBALS['db']->escape_string($post_no);

		$post = new BlogPost();
		$post->set_id($post_no);
		$post->delete();
	}





	// publish portfolio script
	if(isset($_POST['publish-portfolio'])) {
		$portfolio_title = htmlspecialchars($_POST['portfolio-title']);
		$portfolio_title = $GLOBALS['db']->escape_string($portfolio_title);
		$portfolio_content = htmlspecialchars($_POST['portfolio-content']);
		$portfolio_content = $GLOBALS['db']->escape_string($portfolio_content);	



		if(isset($_FILES['portfolio-image']['name']) && $_FILES['portfolio-image']['name'] != "") {
			$portfolio_image = microtime() . "_" . $_FILES['portfolio-image']['name'];
			$file_type = strtolower(pathinfo($portfolio_image, PATHINFO_EXTENSION));
			$target_file = "../uploads/".$portfolio_image;	
		} else {
			$portfolio_image = "";
			$file_type = "";
		}


		// check if file is a valid image file type
		switch ($file_type) {
			case 'jpg':
			case 'jpeg':
			case 'png':
			case '':


				$query = "INSERT INTO portfolio_items
				  		  (name, description, portfolio_img, date_posted, date_modified)
				          VALUES
				  		  ('$portfolio_title','$portfolio_content','$portfolio_image',NOW(),NOW())";

				$GLOBALS['db']->execute($query);

				if($portfolio_image != "")
					move_uploaded_file($_FILES['portfolio-image']['tmp_name'], $target_file);


				echo "success";
				break;


			default:
				echo "error";
				break;
		}
	}



	// delete portfolio script
	if(isset($_POST['delete-portfolio'])) {
		$portfolio_no = htmlspecialchars($_POST['portfolio-no']);
		$portfolio_no = $GLOBALS['db']->escape_string($portfolio_no);

		$portfolio = new Portfolio();
		$portfolio->set_id($portfolio_no);
		$portfolio->delete();
	}


	// add user script
	if(isset($_POST['add-user'])) {
		$firstname = htmlspecialchars($_POST['firstname']);
		$firstname = $GLOBALS['db']->escape_string($firstname);
		$lastname = htmlspecialchars($_POST['lastname']);
		$lastname = $GLOBALS['db']->escape_string($lastname);
		$username = htmlspecialchars($_POST['username']);
		$username = $GLOBALS['db']->escape_string($username);
		$password = htmlspecialchars($_POST['password']);
		$password = $GLOBALS['db']->escape_string($password);
		$access_level = htmlspecialchars($_POST['role']);
		$access_level = $GLOBALS['db']->escape_string($access_level);



		// check if username exists
		if(!$row = $GLOBALS['db']->get_data("SELECT username FROM users WHERE username = '$username'")) {
			$user = new User();
			$user->add_new($firstname, $lastname, $username, $password, $access_level);
			echo "success";
		} else
			echo "error";

		
	}
	

?>