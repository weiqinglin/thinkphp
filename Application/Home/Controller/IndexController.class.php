<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    static private $access_token;
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
        $tmp = implode('',$tmp);
        $tmp = sha1($tmp);
        if($tmp == $signature){
            return true;
        }else{
            return false;
        }
    }

    public function getAccessToken(){
        if(isset(self::$access_token)){
            return self::$access_token;
        }else{
            $this->requestToken();
        }
    }
    public function requestToken(){
        $APPID = C('AppID');
        $APPSECRET = C('AppSecret');
        $url = "https://api.weixin.qq.com/cgi-bin/token?grant_type=client_credential&appid={$APPID}&secret={$APPSECRET}";
        $res = $this->curlRequest($url);
        if(!isset($res['errcode'])){
            setcookie('ACCESS_TOKEN',$res['access_token'],$res['expires_in']);
            self::$access_token = $res['access_token'];
            return self::$access_token;
        }else{
            print_r($res['errmsg']);
        }
    }
    public function curlRequest($url,$method='get',$data=''){
        $ch = curl_init();
        curl_setopt($ch,CURLOPT_URL,$url);
        curl_setopt($ch,CURLOPT_HEADER,0);
        curl_setopt($ch,CURLOPT_RETURNTRANSFER,1);
        curl_setopt($ch,CURLOPT_TIMEOUT,1000);
        if($method == 'post'){
            curl_setopt($ch,CURLOPT_POST,1);
            curl_setopt($ch,CURLOPT_POSTFIELDS,$data);
        }
        $res = curl_exec($ch);
        $res = json_decode($res,true);
        return $res;
    }
}