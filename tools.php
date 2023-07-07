<?php

    function include_jquery()
    {
        echo '<script src="cm/3rdpty/jquery-3.7.0.min.js"></script>';
    }

    function include_font_awesome()
    {
        echo '<link rel="stylesheet" href="cm/3rdpty/fontawesome-free-6.4.0-web/css/fontawesome.min.css">';
    }

    function include_bootstrap()
    {
        echo '<link rel="stylesheet" href="cm/3rdpty/bootstrap-5.3.0-dist/css/bootstrap.min.css">';
        echo '<link rel="stylesheet" href="cm/3rdpty/bootstrap-5.3.0-dist/css/bootstrap.rtl.min.css">';
        echo '<link rel="stylesheet" href="cm/3rdpty/bootstrap-5.3.0-dist/css/bootstrap-grid.min.css">';
        echo '<link rel="stylesheet" href="cm/3rdpty/bootstrap-5.3.0-dist/css/bootstrap-grid.rtl.min.css">';
        echo '<link rel="stylesheet" href="cm/3rdpty/bootstrap-5.3.0-dist/css/bootstrap-reboot.min.css">';
        echo '<link rel="stylesheet" href="cm/3rdpty/bootstrap-5.3.0-dist/css/bootstrap-reboot.rtl.min.css">';
        echo '<link rel="stylesheet" href="cm/3rdpty/bootstrap-5.3.0-dist/css/bootstrap-utilities.min.css">';
        echo '<link rel="stylesheet" href="cm/3rdpty/bootstrap-5.3.0-dist/css/bootstrap-utilities.rtl.min.css">';

        echo '<link rel="stylesheet" href="cm/3rdpty/startbootstrap-sb-admin-2-gh-pages/css/sb-admin-2.min.css">';
        echo '<script src="cm/3rdpty/startbootstrap-sb-admin-2-gh-pages/js/sb-admin-2.min.js"></script>';

        echo '<script src="cm/3rdpty/bootstrap-5.3.0-dist/js/bootstrap.min.js"></script>';
        echo '<script src="cm/3rdpty/bootstrap-5.3.0-dist/js/bootstrap.bundle.min.js"></script>';
    }

    function include_echarts()
    {
        echo '<script src="cm/chart/echarts.min.js"></script>';
    }

    function echo_html_header($title)
    {
        echo '<!DOCTYPE html>
              <html lang="zh-CN">
                <head>
                    <meta charset="utf-8">
                    <title>'.$title.'</title>
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes, minimum-scale=0.25, maximum-scale=5.0, width=device-width" />';

        include_jquery();
        include_font_awesome();
        include_bootstrap();
        include_echarts();

        echo    '</head><body>';
    }

    function echo_page_header($header,$subtext)
    {
        echo '<div class="page-header" style="margin-bottom: 10px; padding-bottom: 0px; margin-top: 0px;"><h1 style="margin-top: 10px;">'.$header.'<small> '.$subtext.'</small></h1></div>';
    }

    function echo_html_end()
    {
        echo '</body></html>';
    }

    function echo_div($id)
    {
        echo '<div id="'.$id.'"></div>';
    }

    function echo_hr()
    {
    	echo '<hr size="1"/>';
    }

    function echo_include_script($filename)
    {
		echo '<script src="'.$filename.'"></script>';
    }

    function echo_autogoto($time,$page)
    {
        echo '<meta http-equiv="refresh" content="'.$time.';url='.$page.'">';
    }

    function echo_link($text,$link)
    {
        echo '<a href="'.$link.'">'.$text.'</a>';
    }

    function echo_span_glyph($glyph)
    {
    	echo '<span class="glyphicon glyphicon-'.$glyph.'"></span>';
    }

    function echo_span_hint_link($glyph,$text,$hint,$link)
    {
    	echo '<a href="'.$link.'" data-toggle="tooltip" data-placement="top" title="'.$hint.'">'.'<span class="glyphicon glyphicon-'.$glyph.'"></span>'.$text.'</a>';
    }

    function echo_icon_hint_link($icon,$text,$hint,$link)
    {
    	echo '<a href="'.$link.'" data-toggle="tooltip" data-placement="top" title="'.$hint.'">';
        echo_icon($icon);
        echo $text.'</a>';
    }

    function echo_icon_link($icon,$text,$link)
    {
    	echo '<a href="'.$link.'" data-placement="top">';
        echo_icon($icon);
        echo $text.'</a>';
    }

    function get_span_label_html($style,$text)
    {
        return '<span class="label label-'.$style.'">'.$text.'</span>';
    }

    function echo_span_label($style,$text)
    {
    	echo get_span_label_html($style,$text);
    }

    function get_icon_html()
    {
        $name=func_get_arg(0);

        if(func_num_args()>1)
        {
            $style=func_get_arg(1);

            return '<i class="fa fa-'.$name.' '.$style.'" aria-hidden="true"></i>';
        }
        else
        {
            return '<i class="fa fa-'.$name.'" aria-hidden="true"></i>';
        }
    }

    function echo_icon()
    {
        $name=func_get_arg(0);

        if(func_num_args()>1)
        {
            $style=func_get_arg(1);

            echo get_icon_html($name,$style);
        }
        else
        {
            echo get_icon_html($name);
        }
    }

    function get_badge_html()
    {
        $text=func_get_arg(0);

        if(func_num_args()>1)
            $style="badge badge-".func_get_arg(1);
        else
            $style="badge";

        return '<span class="'.$style.'">'.$text.'</span>';
    }

    function echo_badge($text)
    {
        echo get_badge_html($text);
    }

    function echo_alert($style,$text)
    {
    	echo '<div class="alert alert-'.$style.'" role="alert">'.$text.'</div>';
    }

    function get_button_link($text,$style,$link)
    {
        return '<a href="'.$link.'" class="btn btn-'.$style.'" role="button">'.$text.'</a>';
    }

    function echo_button_link($text,$style,$link)
    {
        echo get_button_link($text,$style,$link);
    }
?>
