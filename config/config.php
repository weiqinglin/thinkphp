<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2017/12/28
 * Time: 20:44
 */

define('KVSTORE_STORAGE','\\Think\\Kvstore\\Driver\\Filesystem()');
#define('KVSTORE_STORAGE','\\Think\\Driver\\Memcache');
#define('KVSTORE_STORAGE','\\Think\\Kvstore\\Driver\\Rediskv()');
define('KVSTROE_REDIS','127.0.0.1:6379');
define('FILEPATH',ROOT_DIR.'/Data/Kvstore/FileSystem/');

/**
 * TODO: 修改这里配置为您自己申请的商户信息
 * 微信公众号信息配置
 *
 * APPID：绑定支付的APPID（必须配置，开户邮件中可查看）
 *
 * MCHID：商户号（必须配置，开户邮件中可查看）
 *
 * KEY：商户支付密钥，参考开户邮件设置（必须配置，登录商户平台自行设置）
 * 设置地址：https://pay.weixin.qq.com/index.php/account/api_cert
 *
 * APPSECRET：公众帐号secert（仅JSAPI支付的时候需要配置， 登录公众平台，进入开发者中心可设置），
 * 获取地址：https://mp.weixin.qq.com/advanced/advanced?action=dev&t=advanced/dev&token=2005451881&lang=zh_CN
 * @var string
 */
define('APPID','wx426b3015555a46be');
define('MCHID','1900009851');
define('KEY','8934e7d15453e97507ef794cf7b0519d');
define('APPSECRET','7813490da6f1265e4901ffb80afaa36f');
//=======【证书路径设置】=====================================
/**
 * TODO：设置商户证书路径
 * 证书路径,注意应该填写绝对路径（仅退款、撤销订单时需要，可登录商户平台下载，
 * API证书下载地址：https://pay.weixin.qq.com/index.php/account/api_cert，下载之前需要安装商户操作证书）
 * @var path
 */
define('SSLCERT_PATH','./cert/apiclient_cert.pem');
define('SSLKEY_PATH','./cert/apiclient_key.pem');
//=======【curl代理设置】===================================
/**
 * TODO：这里设置代理机器，只有需要代理的时候才设置，不需要代理，请设置为0.0.0.0和0
 * 本例程通过curl使用HTTP POST方法，此处可修改代理服务器，
 * 默认CURL_PROXY_HOST=0.0.0.0和CURL_PROXY_PORT=0，此时不开启代理（如有需要才设置）
 * @var unknown_type
 */
define('CURL_PROXY_HOST','0,0,0,0');
define('CURL_PROXY_PORT',0);
//=======【上报信息配置】===================================
/**
 * TODO：接口调用上报等级，默认紧错误上报（注意：上报超时间为【1s】，上报无论成败【永不抛出异常】，
 * 不会影响接口调用流程），开启上报之后，方便微信监控请求调用的质量，建议至少
 * 开启错误上报。
 * 上报等级，0.关闭上报; 1.仅错误出错上报; 2.全量上报
 * @var int
 */
define('REPORT_LEVENL',1);

/**************************支付宝************************/
//应用ID,您的APPID。
define('app_id', "APP_ID");

		//商户私钥
define('merchant_private_key', "merchant_private_key");

		//异步通知地址
define('notify_url', "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/notify_url.php");

		//同步跳转
define('return_url', "http://外网可访问网关地址/alipay.trade.page.pay-PHP-UTF-8/return_url.php");

		//编码格式
define('charset',"UTF-8");

		//签名方式
define('sign_type',"RSA2");

		//支付宝网关
define('gatewayUrl',"https://openapi.alipay.com/gateway.do");

		//支付宝公钥,查看地址：https://openhome.alipay.com/platform/keyManage.htm 对应APPID下的支付宝公钥。
define('alipay_public_key',"alipay_public_key");