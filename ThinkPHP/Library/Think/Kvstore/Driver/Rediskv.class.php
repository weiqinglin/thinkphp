<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/28
 * Time: 19:55
 */
namespace Think\Kvstore\Driver;

use Think\File\Driver\Key;

class Rediskv extends Key {
    static $handle;
    public function __construct()
    {

        if(!isset(self::$handle) ){
            if(defined('KVSTROE_REDIS')){
                $data = explode(':',KVSTROE_REDIS);
            }else{
                $data = array('127.0.0.1','6379');
            }
            $redis = new \Redis();
             $redis->connect($data['0'],$data['1']);
            self::$handle = $redis;
            if(!self::$handle){
                trigger_error('Redis连接失败',E_COMPILE_ERROR);
            }
        }

    }

    public function store($key, $value, $ttl = 0)
    {
        $data['value'] = $value;
        $data['ttl'] = $ttl;
        $data['dateline'] = time();
        if(self::$handle->set($this->creak_key($key),json_encode($data))){
            return true;
        }
        return false;
        // TODO: Implement store() method.
    }
    public function fetch($key)
    {
        $data = json_decode(self::$handle->get($this->creak_key($key)),true);
        if($data['ttl'] == 0 || ($data['ttl'] + $data['dateline']) > time()){
            return $data['value'];
        }
        return false;
        // TODO: Implement fetch() method.
    }
    public function delete($key)
    {
        // TODO: Implement delete() method.
    }
    public function recovery($record)
    {
        // TODO: Implement recovery() method.
    }

}