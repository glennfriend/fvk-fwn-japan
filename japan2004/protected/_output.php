<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="X-UA-Compatible" content="IE=EmulateIE7" />
<head>
<title><?php echo Config::get('title'); ?></title>


    <script type="text/javascript" src="../dist/jquery/jquery-1.11.1.js"></script>

    <!-- bootstrap theme -->
    <link rel="stylesheet" type="text/css" href="../dist/bootstrap-3.2.0-dist/css/bootstrap.min.css">

    <!-- images slide information -->
    <link rel="stylesheet" type="text/css" href="../dist/styles/image_captions/style.css">

    <!-- theme -->
    <link rel="stylesheet" type="text/css" href="../dist/styles/default/style.css">

    <!-- qtip -->
    <link rel="stylesheet" type="text/css" href="../dist/jquery/qtip/jquery.qtip.css">
    <script type="text/javascript" src='../dist/jquery/qtip/jquery.qtip.min.js'></script>

    <!-- images shadowbox -->
    <link rel="stylesheet" type="text/css" href="../dist/shadowbox/shadowbox.css">
    <script type="text/javascript" src='../dist/shadowbox/shadowbox.js'></script>

</head>
<body>
<div>

    <?php if (function_exists('TemplateBreadcrumb')) { echo TemplateBreadcrumb(); } ?>

    <?php
        $request = new Request();
        $key = trim($request->getQuery('key'));
        $content = '';
        
        if ( array_key_exists($key, Config::getMenus()) ) {
            $file = 'protected/'.$key.'.tpl';
            if( file_exists($file) ) {
                $content = file_get_contents($file);
            }
        }

        if ( $content ) {
            foreach ( explode("\n",$content) as $line ) {
                
                preg_match_all("/\{\{(.*)\}\}/isU", $line, $allFormat);
                if ( $allFormat && $allFormat[0] && $allFormat[1] ) {
                    // print_r($allFormat);
                    foreach( $allFormat[1] as $index => $format ) {
                        $result = Match::render($format);
                        $content = str_replace( $allFormat[0][$index], $result, $content);
                    }
                }
                
            }
            
            echo $content;
        }
    ?>

    <?php if (function_exists('TemplateBreadcrumb')) { echo TemplateBreadcrumb(); } ?>

</div>


<script type="text/javascript">
"use strict";

    $(function() {
        Shadowbox.init({
            language: 'zh-TW',
            players:  ['img']
        });
    });

    $(function() {
        $('.description_content_right').each(function() {
            $(this).qtip({
                content: $(this).next('.exif'),
                position: {
                    at: 'right bottom',
                    my: 'left bottom',
                    adjust: {
                        method: 'shift none'
                    }
                },
                style: {
                    classes: 'qtip-light'
                }

            });
        });
    });

    $(window).load(function(){

        $('div.description').each(function(){
            var width = $(this).siblings('img').width() + 1 ;
            $(this)
                .css('opacity', 0 )
                .css('width', width )           // 這裡+1 是因為每張圖片都加了 1px 的 border 
                .parent()
                .css('width', width )           //...get the parent (the wrapper) and set it's width same as the image width... '
                .css('display', 'block' );
        });

        // mouse hover & out about images
        $('div.wrapper').hover(function(){
            // when mouse hover over the wrapper div
            // get it's children elements with class descriptio
            // and show it using fadeTo
            $(this).children('.description').stop().fadeTo(500, 0.7);
        },function(){
            // when mouse out of the wrapper div
            // use fadeTo to hide the div
            $(this).children('.description').stop().fadeTo(500, 0);
        });


    });


</script>

</body>
</html>