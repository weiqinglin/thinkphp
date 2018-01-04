<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/1
 * Time: 11:11
 */
namespace Think\Pay\Driver;



class WxPay{

    public function goPay($sdf){
        $notify = new NativePay();
        $input = new \Think\Weixin\Driver\WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://192.168.110.128/my/thinkphp/index.php/Home/Index/notify");
        $input->SetTrade_type("MWEB");
        $input->SetProduct_id("123456789");
        $result = $notify->GetPayUrl($input);
        $url2 = $result["code_url"];
        return $url2;
    }

    public function jsApiPay($sdf){
        $tools = new JsApiPay();
        $openId = $tools->GetOpenid();

        $input = new WxPayUnifiedOrder();
        $input->SetBody("test");
        $input->SetAttach("test");
        $input->SetOut_trade_no(WxPayConfig::MCHID.date("YmdHis"));
        $input->SetTotal_fee("1");
        $input->SetTime_start(date("YmdHis"));
        $input->SetTime_expire(date("YmdHis", time() + 600));
        $input->SetGoods_tag("test");
        $input->SetNotify_url("http://paysdk.weixin.qq.com/example/notify.php");
        $input->SetTrade_type("JSAPI");
        $input->SetOpenid($openId);
        $order = WxPayApi::unifiedOrder($input);

        $jsApiParameters = $tools->GetJsApiParameters($order);
        //获取共享收货地址js函数参数
        $editAddress = $tools->GetEditAddressParameters();
        return array('Paramters'=>$jsApiParameters,'Address'=>$editAddress);
    }

    public function orderQuery($data){
        $input = new \Think\Weixin\Driver\WxPayOrderQuery();
        if(isset($data['transaction_id']) && $data['transaction_id'] != ''){
            $input->SetTransaction_id($data['transaction_id']);
        }elseif (isset($data['out_trade_no']) && $data['out_trade_no'] != ''){
            $input->SetOut_trade_no($data['out_trade_no']);
        }else{
            return false;
        }
        return WxPayApi::orderQuery();
    }
}