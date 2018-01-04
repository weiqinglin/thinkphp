<?php
namespace Home\Controller;
use Think\Controller;
use Think\Crypt\Driver\Think;

class IndexController extends Controller {
    public function index(){
        $obj = new \Think\Pay('ailpay');
        $sdf = array();
        $data = $obj->goPay($sdf);
        echo "<pre>";print_r($data);die();
        echo $obj->getQrcode($data);
    }
    public function notify(){
        $obj = new \Think\Weixin\Driver\WxPayNotify();
        $obj->Handle();
    }

    public function jsApi($sdf){
        $obj = new \Think\Pay('weixin');
        $data = $obj->jsApiPay($sdf);
        $this->assign['jsApiParameters'] = $data['Paramters'];
        $this->assign['editAddress'] = $data['Address'];
        $this->display('jsApi');
    }
}
