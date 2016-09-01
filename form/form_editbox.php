<?php

	function CreateInputGroup()
	{
    	$type  =func_get_arg(0);
    	$id    =func_get_arg(1);
    	$label =func_get_arg(2);
    	$size  =func_get_arg(3);

        echo '<div class="form-group">
                <label class="control-label col-sm-2">'.$label.'</label>
                <div class="col-sm-10">
                    <input type="'.$type.'" class="form-control" id="'.$type.'" size="'.$size.'">';

    	if(func_num_args()==5)
    	{
            $right_label=func_get_arg(4);
            echo '<span class="help-block">'.$right_label.'</span>';
        }

        echo '</div></div>';
	}
?>
