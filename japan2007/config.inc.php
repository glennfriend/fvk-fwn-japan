<?php

class Config
{
    public static function get( $key )
    {
        $data = array(
            'imagePath'     => '../media/japan2007',
            'tmpImagePath'  => '../media/tmp/japan2007',
            'portal'        => 'main.php',
            'title'         => '::2007年1月日本東北行::',
            'imageFolder'   => 'japan2007',
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
                'topic' => '1日目',
            ),
            'day2' => Array(
                'topic' => '2日目',
            ),
            'day3' => Array(
                'topic' => '3日目',
            ),
            'day4' => Array(
                'topic' => '4日目',
            ),
            'day5' => Array(
                'topic' => '5日目',
            ),
            'day6' => Array(
                'topic' => '6日目',
            ),
            'day7' => Array(
                'topic' => '7日目',
            )
        );
    }

}
