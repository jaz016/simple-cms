<?php 

	class Portfolio extends Content {

		protected $text;
		protected $date_posted;


		public function fetch_all() {

			
			if($rows = $GLOBALS['db']->get_data("SELECT * FROM portfolio_items")) {
				foreach ($rows as $row) {


					$this_object              = new self;
					$this_object->id          = $row['id'];
					$this_object->title       = $row['name'];
					$this_object->image       = $row['portfolio_img'];
					$this_object->text        = $row['description'];
					$this_object->date_posted = $row['date_posted'];
					$results[]                = $this_object;

				}

				return $results;

			} else
				return false;


		}


		public function get_date_posted() {

			return $this->date_posted;

		}


		public function get_content() {

			return $this->text;

		}

	}

?>