<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/31
 * Time: 11:39
 */
namespace Think;

use Think\Pay\Driver;

class Pay{
    /**
     * Pay constructor.
     * @param $pay_wap 支付方式  weixin,ailpay等
     */
    private $pay;

    public function __construct($pay_way)
    {
        switch ($pay_way){
            case 'weixin':
                $this->pay = new Pay\Driver\WxPay();
                break;
            case 'ailpay':
                $this->pay = new Pay\Driver1\AliPay();
                break;
            default:
                return false;
        }
    }

    public function goPay($sdf){
        return $this->pay->goPay($sdf);
        
    }
    public function jsApiPay($sdf){
        return $this->pay->jsApiPay($sdf);
    }

    public function getQrcode($data){
        return \QRcode::png($data);
    }

    public function queryOrder($data){
        return $this->pay->queryOrder($data);
    }
}
