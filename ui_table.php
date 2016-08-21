<?php

    require_once "tools_sql.php";

    class UITable
    {
        private $title="";
        protected $columns=null;
        protected $columns_label=array();      //即使用label来显示列头

        private $row_out=0;
        private $col_out=0;

        public function __construct1($name)
        {
            $this->title=$name;
        }

        public function __construct2($name,$field_list)
        {
        	$this->title=$name;
        	$this->columns=$field_list;
        }

        public function set_cols($name)
        {
        	$this->columns=$name;
        }

        public function add_col($name,$label=null)
        {
            if($this->columns==null)
            	$this->columns=array();

           	if(is_array($name))
           	{
           		for($i=0;$i<count($name);$i++)
           			$this->columns[]=$name[$i];
           	}
           	else
           	{
               	$this->columns[]=$name;         //增加$name到columns数组中去,不需要返回值的情况下比array_push快(PHP.net官网说的)

               	if($label!=null)
                    $this->columns_label[$name]=$label;
           	}
        }

        public function set_col_label($name,$label)
        {
            if($name!=null&&$label!=null)
                $this->columns_label[$name]=$label;
        }

        public function echo()
        {
            echo '<div id="'.$this->title.'"></div>';
        }

        private function echo_col($index)
        {
            $name=$this->columns[$index];

            if(array_key_exists($name,$this->columns_label))
                echo '{ key: "'.$name.'", label: "'.$this->columns_label[$name].'"}';
            else
                echo $name;
        }

        public function start()
        {
            echo "<script>
                  YUI().use(
                    'aui-datatable',
                    function(Y)
                    {
                        var columns = [";

            echo "'";$this->echo_col(0);echo "'";

            for($i=1;$i<count($this->columns);$i++)
            {
                echo ",'";$this->echo_col($i);echo "'";
            }

            echo "];

            var data=[";
        }

        public function start_row()
        {
            if($this->row_out!=0)
                echo ',
                {';
            else
                echo '{';

            $this->col_out=0;
        }

        public function out_col($contact)
        {
            echo $this->columns[$this->col_out]." : '".$contact."'";

            ++$this->col_out;

            if($this->col_out<count($this->columns))
                echo ',';
            else
            {
                echo '}';
                ++$this->row_out;
            }
        }

        public function end()
        {
            echo "];

                    new Y.DataTable.Base(
                    {
                        columnset: columns,
                        recordset: data
                    }
                    ).render('#".$this->title."');
                }
            );

            </script>";
        }
    };//class UITable

    class UISQLTable extends UITable
    {
    	private $sql_result=null;
    	private $bool_text=array();

    	public function __construct($label,$sql_table_name,$field_list,$where)
    	{
    		parent::__construct2($label,$field_list);

    		if($field_list==null)
    		{
    			$field_list=get_field_list($sql_table_name);

    			$this->set_cols($field_list);

    			$this->sql_result=select_table($sql_table_name,null,$where,0,0);
    		}
    		else
    		{
    			$this->set_cols($field_list);

    			$this->sql_result=select_table($sql_table_name,$field_list,$where,0,0);
    		}
    	}

    	public function SetBoolText($field,$true_text,$false_text)
    	{
    		$this->bool_text[$field]=array($false_text,$true_text);
    	}

    	public function get_sql_result()
    	{
    		return $this->sql_result;
    	}

	    public function echo()
	    {
	    	parent::echo();

	    	$this->start();

	    	for($r=0;$r<count($this->sql_result);$r++)
	    	{
	    		$row=$this->sql_result[$r];

	    		$this->start_row();
	    		for($c=0;$c<count($row);$c++)
	    		{
	    			if(array_key_exists($this->columns[$c],$this->bool_text))
	    			{
	    				$this->out_col($this->bool_text[$this->columns[$c]][$row[$c]]);
	    			}
	    			else
	    			{
	    				$this->out_col($row[$c]);
	    			}
	    		}
	    	}

	    	$this->end();
	    }
    };//class UISQLTable
?>
