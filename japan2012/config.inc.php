<?php

class Config
{
    public static function get( $key )
    {
        $data = array(
            'imagePath'     => '../media/japan2012',
            'tmpImagePath'  => '../media/tmp/japan2012',
            'portal'        => 'main.php',
            'title'         => '::2012年日本京阪奈六日自由行::',
            'imageFolder'   => 'japan2012',
        );
        if ( isset($data[$key]) ) {
            return $data[$key];
        }
    }

    public static function getMenus()
    {
        return array(
            'day0' => Array(
                'topic' => '序',
            ),
            'day1' => Array(
                'topic' => '到日本'
            ),
            'day2' => Array(
                'topic' => '二日目'
            ),
            'day3' => Array(
                'topic' => '三日目'
            ),
            'day4' => Array(
                'topic' => '四日目'
            ),
            'day5' => Array(
                'topic' => '五日目'
            ),
            'day6' => Array(
                'topic' => '六日目'
            ),
            'nara' => Array(
                'topic' => '奈良'
            )
        );
    }

}
