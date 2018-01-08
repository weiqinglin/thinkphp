<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/28
 * Time: 20:40
 */
namespace Think\File\Driver;

use Think\File\Driver\Key;
class File extends Key{
    public function __construct($prefix)
    {
        $this->prefix = $prefix;
        $this->header_length = strlen($this->prefix);
        if(!defined('FILEPATH')){
            trigger_error('FILEPATH未定义',E_USER_WARNING);
        }
    }

    public function stroe($key, $value, $ttl = 0){
        $this->check_dir();
        $data = array();
        $data['value'] = $value;
        $data['ttl'] = $ttl;
        $data['dateline'] = time();
        $org_file = $this->get_store_file($key);
        $tmp_file = $org_file . '.' . str_replace(' ', '.', microtime()) . '.' . mt_rand();
        if(file_put_contents($tmp_file,$this->prefix.serialize($data))){
            if(copy($tmp_file,$org_file)) {
                @unlink($tmp_file);
                return true;
            }
        }
        return false;
    }

    /**
     * 文件中取值
     * @param $key
     * @return bool
     */
    public function fetch($key){
        $file = $this->get_store_file($key);
        if(file_exists($file)){
            $data = unserialize(substr(file_get_contents($file),$this->header_length));
            if(!isset($data['dateline'])) $data['dateline'] = filemtime($file);
            if($data['ttl'] == 0 || ($data['dateline'] + $data['ttl'] > time())){
                return $data['value'];
            }
            return false;
        }

    }

    public function delete($key){
        $file = $this->get_store_file($key);
        if(file_exists($file)){
            @unlink($file);
            return true;
        }
        return true;
    }

    private function check_dir()
    {
        if(!is_dir(FILEPATH.$this->prefix)){
            mkdir(FILEPATH.$this->prefix,777,true);

        }
    }//End Function
    private function get_store_file($key){
        return FILEPATH.$this->prefix.'/'.$this->creak_key($key).'.php';
    }
}