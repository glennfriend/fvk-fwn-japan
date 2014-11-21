<?php

    /**
     *  match & parse template
     */
    class Match
    {
        static $imageHelper;
        static $pathRender;

        static public function setPathRender( $pathRender )
        {
            self::$pathRender = $pathRender;
        }

        static public function setImageHelper( $imageHelper )
        {
            self::$imageHelper = $imageHelper;
        }

        static public function render( $format )
        {
            // return '['.$format.']';
            $params = explode(',', $format);
            $params = array_map("trim", $params);
            if ( !$params || !$params[0] || !$params[1] ) {
                return $format;
            }

            // custom parse
            $result = null;
            switch ( $params[0] ) {
                case 'height':  $result = self::parseHeight($params);   break;
            }
            if ($result) {
                return $result;
            }
            return '['.$format.']';
        }

        static public function parseHeight( $params )
        {
            $file   = $params[1];
            $height = isset($params[2])
                            ? (int) $params[2]
                            : 300 ;
            if ( $height < 10 ) {
                return;
            }

            $from = self::$pathRender->fromPath( $file );
            $to   = self::$pathRender->toPath( 'h'. $height .'/'. $file );

            // 縮圖
            $result = self::$imageHelper->thumbnailHeight( $from, $to, $height );
            if ( $result !== true ) {
                $show = basename($file);
                return "[{$show} 檔案不存在]<br/>\n";
            }

            $fromUri = self::$pathRender->fromUri( $file );
            $toUri   = self::$pathRender->toUri( 'h'. $height .'/'. $file );

            // 產生出輸
            $exif = templateExif($from);
            $show = templateHeight($from, $to, $fromUri, $toUri, $height, $exif);
            return $show;
        }

    }

//