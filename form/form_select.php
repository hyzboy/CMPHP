<?php

	class UISelect
	{
		private $name;
		private $selected;
		private $items;

		public function __construct($n,$s,$i)
		{
			$this->name=$n;
			$this->selected=$s;
			$this->items=$i;
		}

		public function SetSelected($s)
		{
			$this->selected=$s;
		}

		public function out_html()
		{
			echo '<select name="'.$this->name.'">';

                foreach($this->items as $value=>$text)
                {
                    if($this->selected==$value)
                        echo '<option value="'.$value.'" selected="selected">'.$text.'</option>';
                    else
                        echo '<option value="'.$value.'">'.$text.'</option>';
                }

			echo '</select>';
		}
	}

    function create_select($n,$s,$i)
    {
        $ui=new UISelect($n,$s,$i);

        $ui->out_html();
        return;
    }
?>
