<?php

    //参考：http://www.w3schools.com/bootstrap/bootstrap_navbar.asp

    function create_separator_menu()
    {
        return "-";
    }

    function create_menu($text)
    {
        return array("text"=>$text);
    }

    function create_menu_link($text,$link)
    {
        return array("text"=>$text,"link"=>$link);
    }

    function create_menu_sub($text,$sub_menu)
    {
        return array("text"=>$text,"sub_menu"=>$sub_menu);
    }

    class UINavBar
    {
        private $style="navbar-default";
        private $fix_top=true;
        private $brand=null;
        private $brand_link=null;
        private $menu=null;
//        private $active=null;

        public function __construct($m)//,$a)
        {
            $this->menu=$m;
//             $this->active=$a;
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
                if(!is_array($mi)&&$mi=="-")
                {
                    echo '<li role="separator" class="divider"></li>';
                    continue;
                }

                if(array_key_exists("sub_menu",$mi))        //有子菜单
                {
                    echo '<li class="dropdown">';


                    echo '  <a class="dropdown-toggle" data-toggle="dropdown" ';

                    if(array_key_exists("link",$mi))
                        echo 'href="'.$mi["link"].'" ';

                        echo 'role="button" aria-haspopup="true" aria-expanded="false">'.$mi["text"].'
                                <span class="caret"></span></a>
                                <ul class="dropdown-menu">';

                        $this->echo_menu($mi["sub_menu"]);

                    echo '</ul>
                        </li>';
                }
                else
                {
//                         if($this->active==$mi->GetLink())
//                             echo '<li class="active">';
//                         else
                        echo '<li>';

                        if(array_key_exists("link",$mi))
                            echo '<a href="'.$mi["link"].'">'.$mi["text"].'</a></li>';
                        else
                            echo '<a>'.$mi["text"].'</a></li>';
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
                $this->echo_menu($this->menu);

            echo '</ul>
                </div>
              </div>
            </nav>';
        }
    };//class UINavBar
