<?php

    class ChartData
    {
        public $name;
        public $cols;
        public $value;

        /**
        * @param n 数据名称
        * @param cols_data 列数据名称
        * @param cols_value 列数据
        **/
        public function __construct($n,$cols_data,$cols_value)
        {
            $this->name=$n;

            $this->cols=$cols_data;
            $this->value=$cols_value;
        }
    };//class ChartData

    class Chart
    {
        private $id;
        private $width,$height;

        private $title=null;

        private $type=null;

        private $data_list=array();

        /**
        * @param n 名称(用于显示)
        * @param i id
        * @param w 宽
        * @param h 高
        * @param t 类型
        **/
        public function __construct($n,$i,$w,$h,$t)
        {
            $this->title=$n;
            $this->id=$i;
            $this->width=$w;
            $this->height=$h;
            $this->type=$t;
        }

        public function set_title($t)
        {
            $this->title=$t;
        }

        public function set_type($t)
        {
            $this->type=$t;
        }

        public function add_data($data)
        {
            array_push($this->data_list,$data);
        }

        public function draw()
        {
            echo '<div id="'.$this->id.'" style="width:'.$this->width.'px;height:'.$this->height.'px;"></div>';

            echo '<script type="text/javascript">

                    var myChart=echarts.init(document.getElementById("'.$id.'"));

                    var option =
                    {
                    ';

            if($this->title)
            echo 'title:{text:"'.$this->title.'"},
                  tooltip:{},';

            echo 'legend: { data:[';

            $first=true;
            foreach($data_list as $obj)
            {
                if($first==false)
                    echo ',';

                echo '"'.$obj->name.'"';
                $first=false;
            }

            echo ']},
                xAxis:
                {';

            $first=true;
            foreach($data_list as $obj)
            {
                if($first==false)
                    echo ',';

                echo 'data:[';

                $col_first=true;
                foreach($obj->cols as $cols_name)
                {
                    if($col_first==false)
                        echo ',';

                    echo '"'.$cols_name.'"';

                    $col_first=false;
                }

                echo ']';
                $first=false;
            }

            echo '},
                yAxis:{},

                series:[';

            $first=true;
            foreach($data_list as $obj)
            {
                if($first==false)
                    echo ',';

                echo '{';

                echo 'name: "'.$obj->name.'",';
                echo 'type: "'.$this->type.'",';

                echo 'data:[';

                $col_first=true;
                foreach($obj->value as $value)
                {
                    if($col_first==false)
                        echo ',';

                    echo $value;

                    $col_first=false;
                }

                echo '}';
                $first=false;
            }

            echo ']
            };

            myChart.setOption(option);
            </script>';
        }
    };//class Chart
