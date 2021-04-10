<?php 

	class Content {



		protected $id;
		protected $title;
		protected $image;



		public function fetch_all() {

			
			if($rows = $GLOBALS['db']->get_data("SELECT * FROM slides")) {
				foreach ($rows as $row) {


					$this_object        = new self;
					$this_object->id    = $row['id'];
					$this_object->title = $row['slide_caption'];
					$this_object->image = $row['slide_image'];
					$results[]          = $this_object;

				}

				return $results;

			} else
				return false;


		}


		public function set_id($id) {
			$this->id = $id;
		}


		public function get_id() {
			return $this->id;
		}



		public function get_image() {
			return $this->image;
		}


		public function get_title() {
			return $this->title;
		}


		public function delete() {
			if(static::class == "Content") {
				$GLOBALS['db']->execute("DELETE FROM slides WHERE id = '".$this->id."'");
			} else if(static::class == "Portfolio") {
				$GLOBALS['db']->execute("DELETE FROM portfolio_items WHERE id = '".$this->id."'");
			} else if(static::class == "BlogPost") {
				$GLOBALS['db']->execute("DELETE FROM blog_posts WHERE id = '".$this->id."'");
			}
		}
	}

?>