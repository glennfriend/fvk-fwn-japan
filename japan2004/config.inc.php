<?php

class Config
{
    public static function get( $key )
    {
        $data = array(
            'imagePath'     => '../media/japan2004',
            'tmpImagePath'  => '../media/tmp/japan2004',
            'portal'        => 'main.php',
            'title'         => '::2004年北海道五日遊::',
            'imageFolder'   => 'japan2004',
        );
        if ( isset($data[$key]) ) {
            return $data[$key];
        }
    }

    public static function getMenus()
    {
        return array(
            'day1' => Array(
                'topic' => '第一天',
            ),
            'day2' => Array(
                'topic' => '第二天',
            ),
            'day3' => Array(
                'topic' => '第三天',
            ),
            'day4' => Array(
                'topic' => '第四天',
            ),
            'day5' => Array(
                'topic' => '第五天',
            ),
            'etc1' => Array(
                'topic' => '備註',
            ),
            'etc2' => Array(
                'topic' => '其它人在北海道的照片',
            )
        );
    }

}
