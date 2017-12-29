<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/28
 * Time: 21:31
 */
namespace Think\File\Driver;
abstract class Key{
    function creak_key($key){
        return md5($key);
    }
}