<?php

	class UIButton
	{
		private $style='class="btn"';
		private $text="";
		private $onclick="";

		public function SetText($t)
		{
			$this->text=$t;
		}

		public function SetGlyph($g)
		{
			$this->text='<span class="glpyhicon glyphicon-'.$g.'"></span>';
		}

		public function SetStyle($bs)
		{
			if($bs==null)
				$this->style='class="btn"';
			else
				$this->style='class="btn btn-'.$bs.'"';
		}

		public function SetCircleStyle($bs)
		{
			if($bs==null)
				$this->style='class="btn btn-circle"';
			else
				$this->style='class="btn btn-'.$bs.' btn-circle"';
		}

		public function SetOnClick($js)
		{
			$this->onclick='onclick="'.$js.'"';
		}

		public function SetOpenWindow($link)
		{
			$this->onclick='onclick="javascript:window.open(\''.$link.'\')"';
		}

		public function SetLocalLink($link)
		{
			$this->onclick='onclick="javascript:location.href=\''.$link.'\'"';
		}

		public function out_html()
		{
			echo '<button '.$this->style.' '.$this->onclick.'>'.$this->text.'</button>';
		}
	};//class UIButton

	function create_js_button($text,$js_func)
	{
		echo '<button type="button" onclick="'.$js_func.'" class="btn btn-primary">'.$text.'</button>';
	}
?>
