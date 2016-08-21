<?php

    $cmi_sql=null;

    function get_sql()
    {
        global $cmi_sql;

        if($cmi_sql)
            return $cmi_sql;

        $cmi_sql=new mysqli("localhost","root","123456","CMI_ERP");

        if($cmi_sql->connect_error)
        {
            echo "Connection mysql error: ".$sql->connect_error;
            return null;
        }

        $cmi_sql->query("SET NAMES 'utf8'");
        $cmi_sql->query("use CMI_ERP");

        return $cmi_sql;
    }

    function get_field_list($table_name)
    {
    	$sql=get_sql();

    	if($sql==null)return null;

    	$sql_result=$sql->query("desc ".$table_name);

    	if(!$sql_result)
    		return null;

    	$field_list=array();
    	while ($row = $sql_result->fetch_object())
    		$field_list[] = $row->Field;

    	return $field_list;
    }

    function select_table($table_name,$field_list,$where,$start,$count)
    {
        $sql=get_sql();

        if($sql==null)return;

        $sql_string="select";

        if($field_list==null)
        {
        	$sql_string=$sql_string." * from ".$table_name;
        }
        else
        {
	        for($i=0;$i<count($field_list);$i++)
	            if($i==0)
	                $sql_string=$sql_string.' '.$field_list[$i];
	            else
	                $sql_string=$sql_string.','.$field_list[$i];

        	$sql_string=$sql_string." from ".$table_name;
        }

        if($where!=null&&strlen($where)>3)
        	$sql_string=$sql_string." where ".$where;

        if($count!=0)$sql_string=$sql_string." limit ".$start.",".$count;

        $sql_result=$sql->query($sql_string);

        $result=array();
        $index=0;

        while($row=$sql_result->fetch_row())
        {
            $result[$index]=$row;
            $index++;
        }

        $sql_result->close();

        return $result;
    }

    function select_field($table_name,$field,$where)
    {
        $sql=get_sql();

        if($sql==null)return;

        $sql_string="select ".$field." from ".$table_name." where ".$where;

        $sql_result=$sql->query($sql_string);

        if(!$sql_result)
        	return null;

        $row=$sql_result->fetch_object();

        $sql_result->close();
        return $row;
    }

    function sql_insert($table_name,$data_array)
    {
    	$sql=get_sql();

    	if($sql==null)return;

    	$sql_string="insert into ".$table_name." SET";

    	$count=0;

    	foreach($data_array as $field=>$value)
    	{

    		if($count==0)
    			$sql_string=$sql_string.' '.$field.'="'.$value.'"';
    		else
    			$sql_string=$sql_string.','.$field.'="'.$value.'"';

    		++$count;
    	}

    	echo 'SQLString: '.$sql_string;
    	$sql->query($sql_string);
    }
?>
