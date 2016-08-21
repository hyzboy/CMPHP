<?php

	require_once "tools.php";
	require_once "tools_session.php";

	class UISideBar
	{
		private $active="";

		public function __construct($a)
		{
			$this->active=$a;
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
			init_session();

			echo_html_header("CMI MoneyCabinet");

			echo_title();

			echo '<center><p><h5>';

			echo_span_label("primary",$_SESSION['service_hall_fullname']);echo' ';
			echo_span_label("Warning",$_SESSION['usercode']);echo' ';
			echo_span_label("default",$_SESSION['name']);echo' ';
			echo_span_label("danger",$_SESSION['currency']);

			echo '</h5></p>
				  </center>';

			echo_hr();
		}

		public function start()
		{
			$this->echo_header();

			echo '<div class="col-xs-2 bs-docs-sidebar">
					<div class="list-group bs-docs-sidenav affix-top">';

			$this->echo_item("main",					"现金总览"	);
			$this->echo_item("main_money_cabinet",		"钱柜"		);
			$this->echo_item("main_service_hall",		"营业厅"		);
			$this->echo_item("main_staff",				"工作人员"	);
			$this->echo_item("main_customer",			"客户总览"	);
			$this->echo_item("main_customer_currency",	"客户详情"	);
			$this->echo_item("main_deposit",			"存款"		);
			$this->echo_item("main_teller",				"取款"		);
			$this->echo_item("main_exchange",           "存款兑换"   );
			$this->echo_item("main_cash_exchange",		"现金兑换"	);
			$this->echo_item("main_transfer",			"汇款"		);
			$this->echo_item("main_transfer_to_bank",	"汇至银行"	);
			$this->echo_item("main_transfer_from_bank",	"银行入帐"	);

			echo '</div>
				</div>
					<div div class="col-xs-10">';
		}

		public function end()
		{
			echo '</div>';

			echo_html_end();
		}
	};//class UISideBar
?>
