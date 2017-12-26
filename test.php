<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/26
 * Time: 14:56
 */
$signature = $_GET["signature"];
$nonce = $_GET["nonce"];
$token = 'weixin';
$timestamp = $_GET['timestamp'];
$echostr = $_GET['echostr'];
$tmp = array($token,$timestamp,$nonce);
sort($tmp,SORT_STRING);
$tmp = implode($tmp);
$tmp = sha1($tmp);
if($tmp == $signature){
    return true;
}else{
    return false;
}