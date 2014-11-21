<?php
//--------------------------------------------------------------------------------
// default setting
//--------------------------------------------------------------------------------
    define('APP_DIR', __DIR__ );
    include_once('config.inc.php');
    set_time_limit(600);  // 10 min * 60 sec= 600 sec

//--------------------------------------------------------------------------------
// init
//--------------------------------------------------------------------------------
    include_once('../protected/request.class.php');
    include_once('../protected/ImageHelper.class.php');
    include_once('../protected/tool.function.php');
    include_once('../protected/magick.class.php');
    include_once('../protected/PathRender.class.php');

    $imageHelper = new ImageHelper();
    $imagePath = new PathRender( APP_DIR, Config::get('imageFolder') );

    include_once('Match.class.php');
    Match::setImageHelper($imageHelper);
    Match::setPathRender($imagePath);

//--------------------------------------------------------------------------------
// output
//--------------------------------------------------------------------------------
    include_once 'protected/_output.php';
    exit;

//--------------------------------------------------------------------------------
// template
//--------------------------------------------------------------------------------

    function templateHeight( $from, $to, $fromUri, $toUri, $height, $exif )
    {

        //如果原圖、縮圖都存在, 表示會先顯示縮圖, 因此, 在點擊之後, 顯示大圖
        $showOriginImage = '';
        if( $from && $to ) {
            $showOriginImage = '<a rel="shadowbox;options={handleOversize:\'drag\'}" href="'. $fromUri .'">Zoom</a>';
        }

        $content = '';
        if( $showOriginImage || $exif ) {
            $content = <<<EOD
                <div class="description_content">
                    <span class="description_content_left">
                        {$showOriginImage}
                    </span>
                    <span class="description_content_right">
                        <a href="javascript:'">EXIF</a>
                    </span>
                    <span style="display:none;" class="exif">
                        {$exif}
                    </span>
                </div>
EOD;
        }

        //display
        return <<<EOD
            <div class="wrapper" style="margin:3px; float:left">
                <img src="{$toUri}" height="{$height}" />
                <div class="description">
                    {$content}
                </div>
            </div>
EOD;
    }

    function templateExif( $image )
    {
        if( !function_exists('exif_read_data') ) {
            return '';
        }

        ob_start();
            $exif = exif_read_data($image);
        ob_end_clean();

        if (isset($exif['Model'])) {

            //echo '<pre>';  print_r($exif); echo '</pre>'; //debug

            $iso        = array_get( $exif, 'ISOSpeedRatings'           );
            $fnumber    = array_get( $exif, 'COMPUTED.ApertureFNumber'  );
            $exposure   = array_get( $exif, 'ExposureTime'              );
            $make       = array_get( $exif, 'Make'                      );
            $model      = array_get( $exif, 'Model'                     );
            $datetime   = array_get( $exif, 'DateTime'                  );

            return <<<EOD
    <table border=0 cellpadding=0 cellspacing=0 >
        <tr><td>ISO     : </td><td>{$iso}                   </td></tr>
        <tr><td>F/A     : </td><td>{$fnumber} {$exposure}   </td></tr>
        <tr><td>Model   : </td><td>{$model}                 </td></tr>
        <tr><td>Time    : </td><td>{$datetime}              </td></tr>
    </table>
EOD;
        }

    }

    function TemplateBreadcrumb()
    {
        $request = new Request();
        $key = $request->getQuery('key');

        $output = '';
        foreach( Config::getMenus() as $keyword => $items ) {
            if( $key == $keyword ) {
                $tag = ' class="focus" ';
            }
            else {
                $tag = '';
            }

            $output .= '<li><a href="'. getUrl($keyword) .'" '. $tag .' >'. $items['topic'] .'</a></li>';
        }

        return '<ul class="custom-breadcrumb">'.$output.'</ul><br />';
    }

//