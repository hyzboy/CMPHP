<?php

	class UITabView
	{
		private $title=null;
		private $active_page=null;

		public function __construct($name)
		{
			$this->title=$name;
		}

		public function tab_start($active)
		{
			echo '<div id="'.$this->title.'">
					<ul class="nav nav-tabs">';

			$this->count=0;
			$this->active_page=$active;
		}

		public function tab_add($label,$name)
		{
			if($this->active_page==$label)
				echo '<li class="active"><a href="#'.$label.'">'.$name.'</a></li>';
			else
				echo '<li><a href="#'.$label.'">'.$name.'</a></li>';
		}

		public function content_start()
		{
			echo '</ul>

				  <div class="tab-content">';
		}

		public function page_start($label)
		{
			if($this->active_page==$label)
				echo '<div id="'.$label.'">';
			else
				echo '<div id="'.$label.'" class="tab-pane">';
		}

		public function page_end()
		{
			echo '</div>';
		}

		public function tab_end()
		{
			echo '</div>
				  </div>';

			echo "<script>
					YUI().use(
				  'aui-tabview',
				  function(Y) {
				    new Y.TabView(
				      {
				        srcNode: '#".$this->title."'
				      }
				    ).render();
				  }
				);
        		</script>";
		}
	};//class UITabView
?>
