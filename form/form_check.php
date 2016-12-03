<?php

    function create_check($name,$value,$text)
    {
        echo '<input type="checkbox" name="'.$name.'" value="'.$value.'">'.$text;
    }
