<?php

	class UIRadio
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

		public function option($value)
		{
			echo '<input type="radio" name="'.$this->name.'" value="'.$value.'"';

			if($this->selected==$value)
				echo ' checked="checked"';

			echo '/>';
		}
	}
?>
