<?php

    function echo_html_header($title)
    {
        echo '<html>
                <head>
                    <title>'.$title.'</title>
                    <meta charset="utf-8">
                    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
                    <meta name="viewport" content="initial-scale=1.0, user-scalable=yes, minimum-scale=0.25, maximum-scale=5.0, width=device-width" />
                    <script src="http://cdn.alloyui.com/3.0.1/aui/aui-min.js"></script>
                    <link href="http://cdn.alloyui.com/3.0.1/aui-css/css/bootstrap.min.css" rel="stylesheet"/></link>
                </head>
                <body>
                ';
    }

    function echo_title()
    {
    	echo '<center><h1 style="margin-top: 10px">Enterprise Resource Management System</h1></center>';
    }

    function echo_page_header($header,$subtext)
    {
        echo '<div class="page-header" style="margin-bottom: 0px; padding-bottom: 0px; margin-top: 0px;"><h1>'.$header.'<small>'.$subtext.'</small></h1></div>';
    }

    function echo_html_end()
    {
        echo '
			</body></html>';
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

    function echo_alert($style,$text)
    {
    	echo '<div class="alert alert-'.$style.'" role="alert">'.$text.'</div>';
    }
?>
