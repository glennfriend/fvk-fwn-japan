<?php

/*
    取得目錄下所有指定的檔案
    預設是取得常用的圖形檔案
*/
function get_files_by_directory( $dir='./*', $allowTypes=Array(), $hasPath=false )
{
    setlocale(LC_ALL, 'en_US.UTF-8');

    if(!$allowTypes) {
        $allowTypes = Array('jpg','jpeg','png','gif');
    }

    $files = glob( $dir, GLOB_MARK);
    if(!$files) {
        return Array();
    }

    $allowFiles = Array();
    foreach( $files as $file ) {
        $extensionName = pathinfo($file, PATHINFO_EXTENSION);
        if( in_array( strtolower($extensionName), $allowTypes) ) {
            $allowFiles[] = $file;
        }
    }

    // remove path
    if(!$hasPath) {
        $files = $allowFiles;
        $allowFiles = Array();
        foreach( $files as $file ) {
            $allowFiles[] = pathinfo($file, PATHINFO_BASENAME);
        }
    }

    /*
    echo '<pre>';
    print_r($allowFiles);
    echo '</pre>';
    */

    return $allowFiles;

}

/**
 * Laravel array_get
 *
 * Get an item from an array using "dot" notation.
 *
 * @param  array   $array
 * @param  string  $key
 * @param  mixed   $default
 * @return mixed
 */
function array_get($array, $key, $default = null)
{
    if (is_null($key)) {
        return $array;
    }
    if (isset($array[$key])) {
        return $array[$key];
    }

    foreach (explode('.', $key) as $segment) {
        if ( ! is_array($array) or ! array_key_exists($segment, $array)) {
            return $default;
        }
        $array = $array[$segment];
    }

    return $array;
}

/**
 *  
 */
function getUrl( $key )
{
    $baseUrl = Config::get('portal');
    // 網址開頭請保留 "http:" 而成為 "http://"
    return 'http://' . $_SERVER['SERVER_NAME'] . dirname($_SERVER['SCRIPT_NAME']) .'/'. $baseUrl.'?key='. trim($key);
}

//