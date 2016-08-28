<?php

	require_once "tools.php";
	require_once "tools_session.php";

	class UISideBar
	{
		private $active;

		private $screen_width;
		private $screen_height;

		private $sidebar_width;			//bootstarp中屏幕被分为12列宽，我们在PC桌面宽度环境，导航栏宽度设为1。手机/平板纵屏中，导航栏宽度设为2

		public function __construct($a,$sw)
		{
			$this->active=$a;
			$this->sidebar_width=$sw;
		}

		private function echo_item($link,$text)
		{
			echo '<a class="list-group-item';

			if($link==$this->active)
				echo ' active';

			echo '" href="'.$link.'.php">'.$text.'</a>';
		}

		public function start($list)
		{
            echo '<div class="row" style="margin-left: 0px; margin-right: 0px;">';
			echo '<div class="col-xs-'.$this->sidebar_width.' bs-docs-sidebar" style="padding-top: 15px;">
					<div class="list-group bs-docs-sidenav affix-top">';

            foreach($list as $link => $text)
                $this->echo_item($link,$text);

			echo '</div>
				</div>
					<div div class="col-xs-'.(12-$this->sidebar_width).'" style="padding-left: 0px;">';
		}

		public function end()
		{
			echo '</div>
                </div>';
		}
	};//class UISideBar
?>
