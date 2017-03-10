<?php

//     XXX         HP  MP  AP
//
//     3000    |        ___/
//     2000    |    ___/
//     1000    |___/
//        0    +---+---+---+---
//             A   B   C   D

    class ChartData
    {
        public $name;               //数据名称阵列(参加注释图中的HP/MP/AP)
        public $type;               //类型
        public $value;              //数据阵列
        public $stack=null;         //堆叠属性
        public $area_style=null;    //区域风格

        /**
        * @param n 数据名称
        * @param cols_value 列数据
        * @param t 数据类型
        **/
        public function __construct($n,$t,$cols_value)
        {
            $this->name=$n;
            $this->type=$t;
            $this->value=$cols_value;
        }
    };//class ChartData

    class Chart
    {
        private $id;
        private $width,$height;

        private $title=null;

        private $category='x';              //分类位置
        private $item_name=null;            //数据项名称

        private $save_as_image=false;

        private $data_list=array();

        /**
        * @param n 名称(用于显示)
        * @param i id
        * @param w 宽
        * @param h 高
        **/
        public function __construct($n,$i,$w,$h)
        {
            $this->title=$n;
            $this->id=$i;
            $this->width=$w;
            $this->height=$h;
        }

        public function set_title($t)
        {
            $this->title=$t;
        }

        public function set_save_as_image($sai)
        {
            $this->save_as_image=$sai;
        }

        public function set_category($c,$in)
        {
            $this->category=$c;
            $this->item_name=$in;
        }

        public function add_data($name,$type,$data)
        {
            $cd=new ChartData($name,$type,$data);
            array_push($this->data_list,$cd);
            return $cd;
        }

        private function echo_legend()  //输出标题头
        {
            echo 'legend: { data:[';

            $first=true;
            foreach($this->data_list as $obj)
            {
                if($first==false)
                    echo ',';

                echo '"'.$obj->name.'"';
                $first=false;
            }

            echo ']},';
        }

        private function echo_grid()
        {
            echo '  grid:
                    {
                        containLabel:true
                    },';
        }

        private function echo_toolbox() //输出工具箱
        {
            echo 'toolbox:
                  {
                    feature:
                    {
                        saveAsImage:{}
                    }
                  },';
        }

        private function echo_category()
        {
            echo '  type:"category",';
            echo '  data:[';

            $first=true;
            foreach($this->item_name as $name)
            {
                if($first==false)
                    echo ',';
                else
                    $first=false;

                echo '"'.$name.'"';
            }

            echo ']';
        }

        private function echo_value()
        {
            echo '  type:"value"';
        }

        private function echo_axis($dir)
        {
            echo $dir.'Axis:[
                  {';

            if($this->category==$dir)       //如果分类在X
            {
                $this->echo_category();
            }
            else
            {
                $this->echo_value();
            }

            echo '}],';
        }

        private function echo_series()
        {
            echo 'series: [';

            $first=true;

            foreach($this->data_list as $obj)
            {
                if($first==false)
                    echo ',';
                else
                    $first=false;

                echo '{
                        name:"'.$obj->name.'",
                        type:"'.$obj->type.'",';

                if($obj->stack)
                echo '  stack:"'.$obj->stack.'",';

                if($obj->area_style)
                echo '  areaStyle:{'.$obj->area_style.'},';

                echo '  data:[';

                $value_first=true;
                foreach($obj->value as $value)
                {
                    if($value_first==false)
                        echo ','.$value;
                    else
                    {
                        echo $value;
                        $value_first=false;
                    }
                }

                echo ']
                    }';
            }

            echo ']';
        }

        public function draw()
        {
            echo '<div id="'.$this->id.'" style="width:';

            if($this->width==0)
                echo '100%;height:';
            else
                echo $this->width.'px;height:';

            if($this->height==0)
                echo '100%;"></div>';
            else
                echo $this->width.'px;"></div>';

            echo '<script type="text/javascript">

                    var myChart=echarts.init(document.getElementById("'.$this->id.'"));

                    var option =
                    {
                    ';

            if($this->title)
            echo 'title:{text:"'.$this->title.'"},
                  tooltip:{},';

            $this->echo_grid();
            $this->echo_legend();

            if($this->save_as_image)
                $this->echo_toolbox();

            $this->echo_axis('x');
            $this->echo_axis('y');

            $this->echo_series();

            echo '};
                myChart.setOption(option);
                </script>';
        }
    };//class Chart
