<?php

class ImageHelper
{

    private $_im;

    public function __construct()
    {
        $this->_im = new magick();
    }

    /*
        縮圖程式
    */
    function thumbnailHeight( $from, $to , $height )
    {
        //縮圖的檔案如果不否存在
        if ( !file_exists($to) ) {

            //如果原圖也不存在
            if ( !file_exists($from) ) {
                return false;
            }

            //檢查縮圖的目錄是否存在,不存在就建立縮圖目錄.
            $this->_mkdir( dirname($to) );

            //建立縮圖檔案
            $msg = $this->_im->resizeHeight( $from, $to, $height );
            if (!$msg) {
                //銳利、清析化圖片
                $this->_im->sharpen( $to, $to );
            }

            //如果縮圖還是不存在
            if ( !file_exists($to) ) {
                return false;
            }
        }
        return true;
    }

    // ================================================================================
    // private 
    // ================================================================================

    /*
        建立目錄
    */
    private function _mkdir( $directory )
    {
        if(!is_dir($directory)) {
            if('winnt'==strtolower(PHP_OS)) {
                mkdir(str_replace('/', '\\', $directory),0777,true);
            } else {
                mkdir($directory,0755,true);
            }
        }
    }

} // class


//