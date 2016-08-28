<?php

	require_once "tools.php";
	require_once "tools_session.php";

	class UISideBar
	{
		private $active;

		private $screen_width;
		private $screen_height;

		private $sidebar_width;			//bootstarp中屏幕被分为12列宽，我们在PC桌面宽度环境，导航栏宽度设为1。手机/平板纵屏中，导航栏宽度设为2

		public function __construct($a)
		{
			$this->active=$a;

			init_session();

			$this->screen_width	=$_SESSION["screen_width"	];
			$this->screen_height=$_SESSION["screen_height"	];

			if($this->screen_width>$this->screen_height)		//横向布局
			{
				$this->sidebar_width=1;
			}
			else									//纵向布局
			{
				$this->sidebar_width=2;
			}
		}

		private function echo_item($link,$text)
		{
			echo '<a class="list-group-item';

			if($link==$this->active)
				echo ' active';

			echo '" href="'.$link.'.php">'.$text.'</a>';
		}

		private function echo_header()
		{
			echo_html_header("ChinaMall ERP System");

			//echo_hr();
		}

		public function start()
		{
			$this->echo_header();

			echo '<div class="col-xs-'.$this->sidebar_width.' bs-docs-sidebar" style="padding-top: 15px;">
					<div class="list-group bs-docs-sidenav affix-top">';

            foreach($_SESSION["side_bar"] as $link => $text)
                $this->echo_item($link,$text);

			echo '</div>
				</div>
					<div div class="col-xs-'.(12-$this->sidebar_width).'" style="padding-left: 0px;">';
		}

		public function end()
		{
			echo '</div>';

			echo_html_end();
		}
	};//class UISideBar
?>
