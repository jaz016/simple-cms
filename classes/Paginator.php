<?php 

	class Paginator {


		private $data;
		private $page;
		private $last_page;
		private $limit;
		private $total;


		public function __construct($results, $page, $limit) {
			$this->data = $results;
			$this->total = count($results);
			$this->limit = $limit;
			$this->last_page = (int)ceil($this->total/$this->limit);
			
			if($page > $this->last_page)
				$this->page = $this->last_page;
			else
				$this->page = $page;
		}

		public function get_data() {
			$page_items = array();
			for ($i=($this->page-1)*$this->limit; $i<($this->page)*$this->limit; $i++) {
				if(array_key_exists($i, $this->data))
					$page_items[] = $this->data[$i];
				else
					break;
			}
			return $page_items;
		}


		public function create_links() {

			$html = "<ul class='pagination'>";

			// previous links
			$html .= ($this->page == 1) ? "" : "<li><a href='?page=1'>&laquo;</a></li>";
			$html .= ($this->page == 1) ? "" : "<li><a href='?page=".($this->page-1)."'>&lt;</a></li>";


			// preceding links
			for($i=4;$i>=1;$i--) {
				if($this->page-$i >= 1)
					$html .= "<li><a href='?page=".($this->page-$i)."'>".($this->page-$i)."</a></li>";
				else
					continue;
			}

			// current page
			$html .= "<li class='active'><a>".$this->page."</a></li>";

			// succeeding pages
			for($i=1;$i<=4;$i++) {
				if($this->page+$i <= $this->last_page)
					$html .= "<li><a href='?page=".($this->page+$i)."'>".($this->page+$i)."</a></li>";
				else
					break;
			}


			// next links
			$html .= ($this->page == $this->last_page) ? "" : "<li><a href='?page=".($this->page+1)."'>&gt;</a></li>";
			$html .= ($this->page == $this->last_page) ? "" : "<li><a href='?page=".($this->last_page)."'>&raquo;</a></li>";


			$html .= "</ul>";


			echo $html;

		}
	}

?>