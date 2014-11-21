<?php

class Config
{
    public static function get( $key )
    {
        $data = array(
            'imagePath'     => '../media/japan2010',
            'tmpImagePath'  => '../media/tmp/japan2010',
            'portal'        => 'main.php',
            'title'         => '::2010年日本自由行::',
            'imageFolder'   => 'japan2010',
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
                'topic' => '火曜日',
            ),
            'day2' => Array(
                'topic' => '水曜日',
            ),
            'day3' => Array(
                'topic' => '木曜日',
            ),
            'day4' => Array(
                'topic' => '金曜日',
            ),
            'day5' => Array(
                'topic' => '土曜日',
            ),
            'store' => Array(
                'topic' => '便利商店特集',
            )
        );
    }

}
