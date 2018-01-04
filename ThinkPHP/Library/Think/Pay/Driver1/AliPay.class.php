<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2018/1/3
 * Time: 0:51
 */
namespace Think\Pay\Driver1;


class AliPay{

    public function gopay($sdf){
        $payRequestBuilder = new \Think\Alipay\Driver\AliPay();
        $payRequestBuilder->setBody($sdf['body']);
        $payRequestBuilder->setSubject($sdf['subject']);
        $payRequestBuilder->setTotalAmount($sdf['total_amount']);
        $payRequestBuilder->setOutTradeNo($sdf['out_trade_no']);

        $aop = new AlipayTradeService();
        $response = $aop->pagePay($payRequestBuilder);
        return $response;
    }

    public function jsApiPay($sdf){

    }

    public function queryOrder($sdf){
        $RequestBuilder = new \Think\Alipay\Driver\AliQuery();
        $RequestBuilder->setOutTradeNo($sdf['out_trade_no']);
        $RequestBuilder->setTradeNo($sdf['trade_no']);

        $aop = new AlipayTradeService();
        $aop->Query($RequestBuilder);

    }
}