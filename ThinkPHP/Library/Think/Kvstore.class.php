<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/28
 * Time: 19:48
 */
namespace Think;


class Kvstore {

    static $kvobj;

    public function __construct()
    {
        if(defined('KVSTORE_STORAGE')){
            if(KVSTORE_STORAGE == '\Think\Kvstore\Driver\Rediskv()'){
                self::$kvobj = new \Think\Kvstore\Driver\Rediskv();
            }elseif(KVSTORE_STORAGE == '\Think\Kvstore\Driver\Filesystem()'){
                self::$kvobj = new \Think\Kvstore\Driver\Filesystem();
            }
        }else{
            self::$kvobj = new \Think\Kvstore\Driver\Filesystem();
        }
    }
    public function store($key, $value, $ttl = 0)
    {
        return self::$kvobj->store($key, $value, $ttl);
        // TODO: Implement store() method.
    }
    public function fetch($key)
    {
        return self::$kvobj->fetch($key);
        // TODO: Implement fetch() method.
    }
    public function delete($key)
    {
        return self::$kvobj->delete($key);
        // TODO: Implement delete() method.
    }
    public function recovery($record)
    {
        return self::$kvobj->recovery($record);
        // TODO: Implement recovery() method.
    }
}