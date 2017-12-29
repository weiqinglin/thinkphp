<?php
/**
 * Ecos Platform
 *
 * @author     Supser
 * @copyright  Copyright (c) 2005-2014 ShopEx Technologies Inc. (http://www.shopex.cn)
 * @license    http://ecos.shopex.cn/ ShopEx License
 */
namespace Home\Controller;

use \Think\Controller;

class NewsController extends Controller{

    function index(){
        $this->display('first/gallery');
    }
}