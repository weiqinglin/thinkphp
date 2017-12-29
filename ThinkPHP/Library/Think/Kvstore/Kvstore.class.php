<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/28
 * Time: 19:59
 */
namespace Think\Kvstroe;

interface Kvstroe{
    public function store($key, $value, $ttl=0);
    public function fetch($key, &$value, $timeout_version=null);
    public function delete($key);
    function recovery($record);
}