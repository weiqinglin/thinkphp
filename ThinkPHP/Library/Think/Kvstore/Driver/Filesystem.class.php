<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/28
 * Time: 19:56
 */
namespace Think\Kvstore\Driver;

use \Think\Kvstroe;
use \Think\File\Driver\File;


class Filesystem  {
    static $handle;
    public function __construct($prefix='default')
    {

        if(!isset(self::$handle)){
            self::$handle = new File($prefix);
        }

    }

    public function store($key, $value, $ttl = 0)
    {
        return self::$handle->stroe($key, $value, $ttl = 0);
        // TODO: Implement store() method.
    }

    public function fetch($key, &$value, $ttl = 0)
    {
        return self::$handle->fetch($key, $value, $ttl = 0);
        // TODO: Implement fetch() method.
    }

    public function delete($key)
    {
        return self::$handle->delete($key);
        // TODO: Implement delete() method.
    }

    public function recovery($record)
    {
        // TODO: Implement recovery() method.
    }
}