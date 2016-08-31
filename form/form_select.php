<?php

    function create_select()//$label,$name,$selected,$items)
    {
    	$label     =func_get_arg(0);
    	$name      =func_get_arg(1);
    	$selected  =func_get_arg(2);
    	$items     =func_get_arg(3);

        echo '<div class="form-group">
                <label class="control-label col-sm-2">'.$label.'</label>
                <div class="col-sm-10">';

        echo '<select name="'.$name.'">';

            foreach($items as $value=>$text)
            {
                if($selected==$value)
                    echo '<option value="'.$value.'" selected="selected">'.$text.'</option>';
                else
                    echo '<option value="'.$value.'">'.$text.'</option>';
            }

        echo '</select>';

    	if(func_num_args()==5)
    	{
            $right_label=func_get_arg(4);
            echo '<label class="control-label">'.$right_label.'</label>';
        }

        echo '</div></div>';
    }
?>
