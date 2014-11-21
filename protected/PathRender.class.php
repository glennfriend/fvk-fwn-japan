<?php
/*
    path    表示實際的位置      如 /var/www/project1/js
    url     表示網站完整位置    如 http://localhost/project1/js
    uri     表示網站資源位置    如 /project1/js
    link    表示路徑與檔案名稱  如 /project1/js/file.jpg
*/
class PathRender
{
    protected $appDir;
    protected $groupKey;

    public function __construct( $appDir, $groupKey )
    {
        $this->appDir = $appDir;
        $this->groupKey = $groupKey;
    }

    public function fromPath( $name=null )
    {
        $path = realpath("{$this->appDir}/../media/{$this->groupKey}");
        if ( $name ) {
            return $path.'/'.$name;
        }
        return $path;
    }

    public function fromUri( $name=null )
    {
        $path = "../media/{$this->groupKey}";
        if ( $name ) {
            return $path.'/'.$name;
        }
        return $path;
    }

    public function toPath( $name=null )
    {
        $path = "../media/tmp/{$this->groupKey}";
        if ( $name ) {
            return $path.'/'.$name;
        }
        return $path;
    }

    public function toUri( $name=null )
    {
        $path = "../media/tmp/{$this->groupKey}";
        if ( $name ) {
            return $path.'/'.$name;
        }
        return $path;
    }

}

//