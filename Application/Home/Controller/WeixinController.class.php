<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/27
 * Time: 20:36
 */
namespace Home\Controller;

use \Think\Controller;

class WeixinController extends Controller{
    private $_msgTpl = array(
        'text'=>'<xml> <ToUserName>< ![CDATA[%s] ]></ToUserName> <FromUserName>< ![CDATA[%s] ]></FromUserName> <CreateTime>%s</CreateTime> <MsgType>< ![CDATA[text] ]></MsgType> <Content>< ![CDATA[%s] ]></Content> </xml>',
        'image'=>'<xml><ToUserName>< ![CDATA[%s] ]></ToUserName><FromUserName>< ![CDATA[%s] ]></FromUserName><CreateTime>%s</CreateTime><MsgType>< ![CDATA[image] ]></MsgType><Image><MediaId>< ![CDATA[%s] ]></MediaId></Image></xml>',
        'voice'=>'<xml><ToUserName>< ![CDATA[%s] ]></ToUserName><FromUserName>< ![CDATA[%s] ]></FromUserName><CreateTime>%s</CreateTime><MsgType>< ![CDATA[voice] ]></MsgType><Voice><MediaId>< ![CDATA[%s] ]></MediaId></Voice></xml>',
        'video'=>'<xml><ToUserName>< ![CDATA[%s] ]></ToUserName><FromUserName>< ![CDATA[%s] ]></FromUserName><CreateTime>%s</CreateTime><MsgType>< ![CDATA[video] ]></MsgType><Video><MediaId>< ![CDATA[%s] ]></MediaId><Title>< ![CDATA[%s] ]></Title><Description>< ![CDATA[%s] ]></Description></Video> </xml>',
        'music'=>'<xml><ToUserName>< ![CDATA[%s] ]></ToUserName><FromUserName>< ![CDATA[%s] ]></FromUserName><CreateTime>%s</CreateTime><MsgType>< ![CDATA[music] ]></MsgType><Music><Title>< ![CDATA[%s] ]></Title><Description>< ![CDATA[%s] ]></Description><MusicUrl>< ![CDATA[%s] ]></MusicUrl><HQMusicUrl>< ![CDATA[%s] ]></HQMusicUrl><ThumbMediaId>< ![CDATA[%s] ]></ThumbMediaId></Music></xml>',
    );
    public function getWeixinIp(){

    }
    /**
     * 检查signature
     */
    public function checkSignature(){
        $signature = $_GET["signature"];
        $nonce = $_GET["nonce"];
        $token = 'weixin';
        $timestamp = $_GET['timestamp'];
        $echostr = $_GET['echostr'];
        $tmp = array($token,$timestamp,$nonce);
        sort($tmp,SORT_STRING);
        $tmp = implode('',$tmp);
        $tmp = sha1($tmp);
        if($tmp == $signature && $echostr){
            echo $echostr;exit;
        }else{
            $this->responseMsg();
        }
    }
    function responseMsg(){
        $postStr  = $GLOBALS["HTTP_RAW_POST_DATA"] == '' ? file_get_contents('php://input') : $GLOBALS["HTTP_RAW_POST_DATA"] ;
        $postObj = simplexml_load_string($postStr,'SimpleXMLElement', LIBXML_NOCDATA);
        switch (strtolower($postObj->MsgType)){
            case 'text':
                $this->msgText($postObj);
                break;
            case 'image':
                $this->msgImage($postObj);
                break;
            case 'voice':
                $this->msgVoice($postObj);
                break;
            case 'video':
                $this->msgVideo($postObj);
                break;
            case 'shortvideo':
                $this->msgShortvideo($postObj);
                break;
            case 'link':
                $this->msgLink($postObj);
                break;
            case 'event':
                $this->eventMsg($postObj);
        }
    }
    function msgText($postObj){
        $content = trim($postObj->Content);
        if($content != ''){
            $content = '您输入的内容为'.$content;
        }else{
            $content = '小主很懒什么都不想说';
        }
        $msg = sprintf($this->_msgTpl['text'],$postObj->FromUserName,$postObj->ToUserName,time(),$content);
        echo $msg;exit;
    }
    function msgImage(){

    }
    function msgVoice(){

    }
    function msgVideo(){

    }
    function msgShortvideo(){

    }
    function msgLink(){

    }
    function eventMsg($postObj){
        if(strtolower($postObj->Event) == 'subscribe'){
            $msg = sprintf($this->_msgTpl['text'],$postObj->FromUserName,$postObj->ToUserName,time(),'感谢关注，我很少说话哦');
            echo $msg;exit;
        }elseif(strtolower($postObj->Event) == 'click'){
            echo '';exit;
        }elseif(strtolower($postObj->VIEW) == 'view'){
            echo '';exit;
        }
    }
}