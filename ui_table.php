<?php

    require_once "tools_sql.php";

    class UITable
    {
        private $heading=null;
        private $heading_style="default";
        private $body=null;
        protected $fields=null;
        private $table_style="striped";

        public function set_heading($h)
        {
            $this->heading=$h;
        }

        public function set_heading_style($hs)
        {
            $this->heading_style=$hs;
        }

        public function set_body_text($bt)
        {
            $this->body=$bt;
        }

        public function set_fields($f)
        {
            $this->fields=$f;
        }

        public function set_table_style($ts)
        {
            $this->table_style=$ts;
        }

        public function start()
        {
            echo '<div class="panel panel-'.$this->heading_style.'">';

            if($this->heading!=null)
                echo '<div class="panel-heading">'.$this->heading.'</div>';

            if($this->body!=null)
                echo '<div class="panel-body"><p>'.$this->body.'</p></div>';

            if($this->table_style)
                echo '<table class="table table-'.$this->table_style.'">';
            else
                echo '<table class="table">';

            if($this->fields!=null)
            {
                echo '<tr>';
                    foreach($this->fields as $field)
                        echo '<th>'.$field.'</th>';
                echo '</tr>';
            }
        }

        public function start_row   (){echo '<tr>';}
        public function end_row     (){echo '</tr>';}

        public function start_col   (){echo '<td>';}
        public function end_col     (){echo '</td>';}

        public function echo_col    ($text){echo '<td>'.$text.'</td>';}

        public function echo_row    ($text_list)
        {
            start_row();

                foreach($text_list as $text)
                    echo_col($text);

            end_row();
        }

        public function end()
        {
            echo '</table>
                </div>';
        }
    };//class UITable

    class UISQLTable extends UITable
    {
    	private $sql_result=null;
    	private $bool_text=array();
    	private $enum_text=array();

    	public function __construct()//$sql_table_name,$field_list,$where,$start,$count)
    	{
            $sql_table_name=func_get_arg(0);

            if(func_num_args()>1)$field_list=func_get_arg(1);else $field_list=null;
            if(func_num_args()>2)$where     =func_get_arg(2);else $where=null;
            if(func_num_args()>3)$start     =func_get_arg(3);else $start=null;
            if(func_num_args()>4)$count     =func_get_arg(4);else $count=null;

    		if($field_list==null)
    		{
    			$field_list=get_field_list($sql_table_name);

                parent::set_fields($field_list);


    			$this->sql_result=select_table($sql_table_name,null,$where,$start,$count);
    		}
    		else
    		{
                parent::set_fields($field_list);

    			$this->sql_result=select_table($sql_table_name,$field_list,$where,$start,$count);
    		}
    	}

    	public function SetBoolText($field,$true_text,$false_text)
    	{
    		$this->bool_text[$field]=array($false_text,$true_text);
    	}

    	public function SetEnumText($field,$text_array)
    	{
            $this->enum_text[$field]=$text_array;
    	}

    	public function get_sql_result()
    	{
    		return $this->sql_result;
    	}

	    public function out_html()
	    {
	    	parent::start();

	    	for($r=0;$r<count($this->sql_result);$r++)
	    	{
	    		$row=$this->sql_result[$r];

	    		parent::start_row();
	    		for($c=0;$c<count($row);$c++)
	    		{
                    parent::start_col();

	    			if(array_key_exists($this->fields[$c],$this->bool_text))
	    			{
	    				echo $this->bool_text[$this->fields[$c]][$row[$c]];
	    			}
	    			else
	    			if(array_key_exists($this->fields[$c],$this->enum_text))
	    			{
                        echo $this->enum_text[$this->fields[$c]][$row[$c]];
	    			}
	    			else
	    			{
	    				echo $row[$c];
	    			}

	    			parent::end_col();
	    		}
	    		parent::end_row();
	    	}

	    	parent::end();
	    }
    };//class UISQLTable
?>
