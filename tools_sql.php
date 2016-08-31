<?php

    static $global_sql=null;

    function get_sql()
    {
        global $global_sql;

        if($global_sql)
            return $global_sql;

        $global_sql=new mysqli($_SESSION["DB_ADDRESS"],$_SESSION["DB_USERNAME"],$_SESSION["DB_PASSWORD"],$_SESSION["DB_NAME"]);

        if($global_sql->connect_error)
        {
            echo "Connection Database error: ".$sql->connect_error;
            return null;
        }

        $global_sql->query("SET NAMES 'utf8'");
        $global_sql->query("USE ".$_SESSION["DB_NAME"]);

        return $global_sql;
    }

    function get_field_list($table_name)
    {
    	$sql=get_sql();

    	if($sql==null)return null;

    	$sql_result=$sql->query("DESC ".$table_name);

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

        $sql_string="SELECT";

        if($field_list==null)
        {
        	$sql_string=$sql_string." * FROM ".$table_name;
        }
        else
        {
	        for($i=0;$i<count($field_list);$i++)
	            if($i==0)
	                $sql_string=$sql_string.' '.$field_list[$i];
	            else
	                $sql_string=$sql_string.','.$field_list[$i];

        	$sql_string=$sql_string." FROM ".$table_name;
        }

        if($where!=null&&strlen($where)>3)
        	$sql_string=$sql_string." WHERE ".$where;

        if($count!=0)$sql_string=$sql_string." LIMIT ".$start.",".$count;

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

        $sql_string="SELECT ".$field." FROM ".$table_name." WHERE ".$where;

        $sql_result=$sql->query($sql_string);

        if(!$sql_result)
        	return null;

        $row=$sql_result->fetch_object();

        $sql_result->close();
        return $row;
    }

    /**
    * 向一个表中插入数据，使用array的kv模式表示字段和数据
    */
    function sql_insert()//$table_name,$data_array)
    {
    	$sql=get_sql();

    	if($sql==null)return null;

    	$table_name=func_get_arg(0);
    	$data_array=func_get_arg(1);

    	if(func_num_args()==3)
            $resultmode=func_get_arg(2);
        else
            $resultmode=MYSQLI_STORE_RESULT;

    	$sql_string="INSERT INTO ".$table_name." SET";

    	$count=0;

    	foreach($data_array as $field=>$value)
    	{
    		if($count==0)
    			$sql_string=$sql_string.' '.$field.'="'.$value.'"';
    		else
    			$sql_string=$sql_string.','.$field.'="'.$value.'"';

    		++$count;
    	}

//    	echo 'SQLString: '.$sql_string;
    	return $sql->query($sql_string);
    }

    /**
    * 向一个表中插入数据，字段数据来自于post
    */
    function sql_insert_by_post()//$table_name,$field_array [,$resultmode=MYSQLI_STORE_RESULT])
    {
        $sql=get_sql();

        if($sql==null)return null;

        $data_array=array();

    	$table_name=func_get_arg(0);
    	$field_array=func_get_arg(1);

    	if(func_num_args()==3)
            $resultmode=func_get_arg(2);
        else
            $resultmode=MYSQLI_STORE_RESULT;

        foreach($field_array as $field)
            $data_array[$field]=$_POST[$field];

        return sql_insert($table_name,$data_array,$resultmode);
    }
?>
