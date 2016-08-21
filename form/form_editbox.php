<?php

	class UIEditBox
	{
		private $type=null;
		private $id=null;
		private $size=null;

		public function __construct($t,$i,$s)
		{
			$this->type=$t;
			$this->id=$i;
			$this->size=$s;
		}

		public function echo()
		{
			echo '<input type="'.$this->type.'" class="form-control" name="'.$this->id.'" size="'.$this->size.'">';
		}
	};//class UIEditBox

	class UIInputGroup extends UIEditBox
	{
		private $addon_front=null;
		private $addon_back=null;

		public function __construct($t,$i,$s)
		{
			parent::__construct($t,$i,$s);
		}

		public function SetAddonFront($text)
		{
			$this->addon_front='<span class="input-group-addon">'.$text.'</span>';
		}

		public function SetAddonBack($text)
		{
			$this->addon_back='<span class="input-group-addon">'.$text.'</span>';
		}

		public function echo()
		{
			echo '<div class="input-group">';
				echo $this->addon_front;
					parent::echo();
				echo  $this->addon_back;
			echo '</div>';
		}
	};//class UIInputGroup

	function CreateInputGroup($type,$id,$label,$size)
	{
		$but=new UIInputGroup($type,$id,$size);
		$but->SetAddonFront($label);
		$but->echo();

		return $but;
	}
?>
