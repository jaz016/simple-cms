<?php 

	class BlogPost extends Portfolio {


		private $category;
		private $author;
		public $is_comments_allowed;



		public function fetch_all() {

			
			if($rows = $GLOBALS['db']->get_data("SELECT bp.id, bp.title, bp.post_img, bp.content, bpc.category_name,
														u.firstname, u.lastname, bp.date_posted, bp.comments_allowed
												 FROM blog_posts as bp
												 INNER JOIN blog_post_categories as bpc
												 ON bp.category_id = bpc.id
												 INNER JOIN users as u
												 ON bp.author_id = u.id")) {
				foreach ($rows as $row) {


					$this_object              = new self;
					$this_object->id          = $row['id'];
					$this_object->title       = $row['title'];
					$this_object->image       = $row['post_img'];
					$this_object->text        = $row['content'];
					$this_object->category    = $row['category_name'];
					$this_object->author      = $row['firstname'] . " " . $row['lastname'];
					$this_object->date_posted = $row['date_posted'];
					$results[]                = $this_object;

				}

				return $results;

			} else
				return false;


		}



		public static function fetch_one($id) {

			if($rows = $GLOBALS['db']->get_data("SELECT bp.id, bp.title, bp.post_img, bp.content, bpc.category_name,
														u.firstname, u.lastname, bp.date_posted, bp.comments_allowed
												 FROM blog_posts as bp
												 INNER JOIN blog_post_categories as bpc
												 ON bp.category_id = bpc.id
												 INNER JOIN users as u
												 ON bp.author_id = u.id
												 WHERE bp.id = $id")) {
				foreach ($rows as $row) {


					$this_object              		  = new self;
					$this_object->id          		  = $row['id'];
					$this_object->title       		  = $row['title'];
					$this_object->image       		  = $row['post_img'];
					$this_object->text        		  = $row['content'];
					$this_object->category    		  = $row['category_name'];
					$this_object->author      		  = $row['firstname'] . " " . $row['lastname'];
					$this_object->date_posted 		  = $row['date_posted'];
					$this_object->is_comments_allowed = $row['comments_allowed'] ? true : false;
					$result                	  		  = $this_object;

				}

				return $result;

			} else
				return false;

		}



		public static function fetch_categories() {
			$rows = $GLOBALS['db']->get_data("SELECT * FROM blog_post_categories");
			return $rows;
		}

		public function get_id() {
			return $this->id;
		}


		public function get_author() {
			return $this->author;
		}



		public function get_category() {
			return $this->category;
		}


	}

?>