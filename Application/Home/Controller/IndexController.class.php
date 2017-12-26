<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->__checkSignature();
    }

    /**
     * 检查signature
     */
    private function __checkSignature(){
        $signature = $_GET["signature"];
        $nonce = $_GET["nonce"];
        $token = 'weixin';
        $timestamp = $_GET['timestamp'];
        $echostr = $_GET['echostr'];
        $tmp = array($token,$timestamp,$nonce);
        sort($tmp,SORT_STRING);
        $tmp = implode($tmp);
        $tmp = sha1($tmp);
        if($tmp == $echostr){
            return true;
        }else{
            return false;
        }
    }
}