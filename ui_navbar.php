<?php

    //参考：http://www.w3schools.com/bootstrap/bootstrap_navbar.asp

    class MenuItem
    {
        private $text=null;
        private $link=null;
        private $sub_menu=null;

		public function __construct()
		{
			$a = func_get_args();
			$i = func_num_args();

			if (method_exists($this,$f='__construct'.$i))
				call_user_func_array(array($this,$f),$a);
		}

		public function __construct1($s)
        {
            $this->sub_menu=$s;
        }

        public function __construct2($t,$l)
        {
            $this->Set($t,$l);
        }

        public function __construct3($t,$l,$s)
        {
            $this->Set($t,$l);
            $this->sub_menu=$s;
        }

        public function Set($t,$l)
        {
            $this->text=$t;
            $this->link=$l;
        }

        public function IsSeparator()
        {
            if($this->text==null
             &&$this->link==null)
                return(true);
            else
                return(false);
        }

        public function SetSubMenu($sm)
        {
            $this->sub_menu=$sm;
        }

        public function GetText()
        {
            return $this->text;
        }

        public function GetLink()
        {
            return $this->link;
        }

        public function GetSubMenu()
        {
            return $this->sub_menu;
        }
    };//class MenuItem

    class UINavBar
    {
        private $style="navbar-default";
        private $fix_top=true;
        private $brand=null;
        private $brand_link=null;
        private $menu=null;
        private $active=null;

        public function __construct($m,$a)
        {
            $this->menu=$m;
            $this->active=$a;
        }

        public function set_style($s)
        {
            if($s==null||strlen($s)<=0)
                $this->style="";
            else
                $this->style="navbar-".$s;
        }

        /**
        * @b 标题文本
        * @l 标题链接
        */
        public function set_brand($b,$l)
        {
            $this->brand=$b;
            $this->brand_link=$l;
        }

        private function echo_menu($m)
        {
            if($m==null)return;

            foreach($m as $mi)
            {
                $sub_menu=$mi->GetSubMenu();

                if($sub_menu!=null)     //子菜单
                {
                    echo '<li class="dropdown">
                            <a class="dropdown-toggle" data-toggle="dropdown" href="'.$mi->GetLink().'" role="button" aria-haspopup="true" aria-expanded="false">'.$mi->GetText().'
                                <span class="caret"></span></a>
                                    <ul class="dropdown-menu">';
                        $this->echo_menu($sub_menu);
                    echo '</ul>
                        </li>';
                }
                else
                {
                    if($mi->IsSeparator())
                    {
                        echo '<li role="separator" class="divider"></li>';
                    }
                    else
                    {
                        if($this->active==$mi->GetLink())
                            echo '<li class="active">';
                        else
                            echo '<li>';

                        echo '<a href="'.$mi->GetLink().'">'.$mi->GetText().'</a></li>';
                    }
                }
            }
        }

        public function out_html()
        {
            echo '<nav class="navbar '.$this->style.'">
                    <div class="container-fluid">';

            if($this->brand!=null&&strlen($this->brand)>0)
            {
                echo '<div class="navbar-header">';

                if($this->brand_link!=null&&strlen($this->brand_link)>0)
                    echo '<a class="navbar-brand" href="'.$this->brand_link.'">'.$this->brand.'</a>';
                else
                    echo '<font class="navbar-brand">'.$this->brand.'</font>';

                echo '</div>';
            }

            echo '<div class="navbar-collapse">
                    <ul class="nav navbar-nav">';

            if($this->menu!=null)
                $this->echo_menu($this->menu->GetSubMenu());

            echo '</ul>
                </div>
              </div>
            </nav>';
        }
    };//class UINavBar
