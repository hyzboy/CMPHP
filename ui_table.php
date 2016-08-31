﻿<?php

    require_once "tools_sql.php";

    class UITable
    {
        private $heading=null;
        private $heading_style="default";
        private $body=null;
        private $fields=null;

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

        public function start()
        {
            echo '<div class="panel panel-'.$this->heading_style.'">';

            if($this->heading!=null)
                echo '<div class="panel-heading">'.$this->heading.'</div>';

            if($this->body!=null)
                echo '<div class="panel-body"><p>'.$this->body.'</p></div>';

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

//     class UISQLTable extends UITable
//     {
//     	private $sql_result=null;
//     	private $bool_text=array();
//
//     	public function __construct($label,$sql_table_name,$field_list,$where)
//     	{
//     		parent::__construct2($label,$field_list);
//
//     		if($field_list==null)
//     		{
//     			$field_list=get_field_list($sql_table_name);
//
//     			$this->set_cols($field_list);
//
//     			$this->sql_result=select_table($sql_table_name,null,$where,0,0);
//     		}
//     		else
//     		{
//     			$this->set_cols($field_list);
//
//     			$this->sql_result=select_table($sql_table_name,$field_list,$where,0,0);
//     		}
//     	}
//
//     	public function SetBoolText($field,$true_text,$false_text)
//     	{
//     		$this->bool_text[$field]=array($false_text,$true_text);
//     	}
//
//     	public function get_sql_result()
//     	{
//     		return $this->sql_result;
//     	}
//
// 	    public function echo()
// 	    {
// 	    	parent::echo();
//
// 	    	$this->start();
//
// 	    	for($r=0;$r<count($this->sql_result);$r++)
// 	    	{
// 	    		$row=$this->sql_result[$r];
//
// 	    		$this->start_row();
// 	    		for($c=0;$c<count($row);$c++)
// 	    		{
// 	    			if(array_key_exists($this->columns[$c],$this->bool_text))
// 	    			{
// 	    				$this->out_col($this->bool_text[$this->columns[$c]][$row[$c]]);
// 	    			}
// 	    			else
// 	    			{
// 	    				$this->out_col($row[$c]);
// 	    			}
// 	    		}
// 	    	}
//
// 	    	$this->end();
// 	    }
//     };//class UISQLTable
?>
