<?php

    function include_jquery()
    {
        echo '<script src="3rdpty/jquery-3.1.0.js"></script>
             ';
    }

    function include_font_awesome()
    {
        echo '<link rel="stylesheet" href="3rdpty/font-awesome/css/font-awesome.min.css">';
    }

    function include_bootstrap()
    {
        echo   '<link rel="stylesheet" href="3rdpty/bootstrap/css/bootstrap.css">
                <link rel="stylesheet" href="3rdpty/bootstrap/css/bootstrap-theme.css">
                <script src="3rdpty/bootstrap/js/bootstrap.js"></script>
               ';
    };

    function include_jsgird()
    {
        echo '<link type="text/css" rel="stylesheet" href="3rdpty/jsgrid/jsgrid.css" />
              <link type="text/css" rel="stylesheet" href="3rdpty/jsgrid/jsgrid-theme.css" />
              <script type="text/javascript" src="3rdpty/jsgrid/jsgrid.js"></script>
             ';
    }

    function echo_html_header($title)
    {
        echo '<html>
                <head>
                    <title>'.$title.'</title>
                    <meta charset="utf-8">
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes, minimum-scale=0.25, maximum-scale=5.0, width=device-width" />
                ';

        include_jquery();
        include_font_awesome();
        include_bootstrap();
        //include_jsgird();

        echo    '
                </head>
                <body>
                ';
    }

    function echo_page_header($header,$subtext)
    {
        echo '<div class="page-header" style="margin-bottom: 0px; padding-bottom: 0px; margin-top: 0px;"><h1>'.$header.'<small> '.$subtext.'</small></h1></div>';
    }

    function echo_html_end()
    {
        echo '
			</body></html>';
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

    function echo_span_glyph($glyph)
    {
    	echo '<span class="glyphicon glyphicon-'.$glyph.'"></span>';
    }

    function echo_span_label($style,$text)
    {
    	echo '<span class="label label-'.$style.'">'.$text.'</span>';
    }

    function get_icon_html($name)
    {
        return '<i class="fa fa-'.$name.'" aria-hidden="true"></i>';
    }

    function echo_icon($name)
    {
        echo get_icon_html($name);
    }

    function echo_alert($style,$text)
    {
    	echo '<div class="alert alert-'.$style.'" role="alert">'.$text.'</div>';
    }
?>
