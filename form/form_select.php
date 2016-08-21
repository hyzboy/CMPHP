<?php

	class UISelect
	{
		private $name;
		private $selected;

		public function __construct1($n)
		{
			$this->name=$n;
			$this->selected=null;
		}

		public function __construct2($n,$s)
		{
			$this->name=$n;
			$this->selected=$s;
		}

		public function SetSelected($s)
		{
			$this->selected=$s;
		}

		public function start()
		{
			echo '<select name="'.$this->name.'">';
		}

		public function option($value,$text)
		{
			if($this->selected==$value)
				echo '<option value="'.$value.'" selected="selected">'.$text.'</option>';
			else
				echo '<option value="'.$value.'">'.$text.'</option>';
		}

		public function end()
		{
			echo '</select>';
		}
	}
?>
