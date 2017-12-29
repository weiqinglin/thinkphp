<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends Controller {
    public function index(){
        $this->display('first/index');
    }
    public function aside(){
        $this->display('first/aside');
    }
}