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
    public function calendar(){
        $data = M('menus')->order(array('order1'=>'asc','id'=>'asc'))->select();
        $this->assign('menus',$data);
        $html = $this->fetch('first/weixin/menu');
        $this->ajaxReturn(array('status'=>'success','data'=>$html));
    }
    function setMenu(){
        $data = $_POST['data'];
        $data = explode(',',trim($data,','));
        $count = count($data);
        $menuObj = M('menus');
        for ($i = 0; $i < $count; $i++){
            $update['order1'] = $i;
            $map['id'] = $data[$i];
            $menuObj->where($map)->save($update);
//                $msg = array('status'=>'failed');
//                echo json_encode($msg);exit;
            unset($update);
            unset($map);
        }
        $msg = array('status'=>'success');
        echo  json_encode($msg);
    }
}