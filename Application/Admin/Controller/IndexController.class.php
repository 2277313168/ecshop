<?php
namespace Admin\Controller;
use Think\Controller;


class IndexController extends BaseController {
    public function index1(){
     $this->display('Index/index');
    }

    public function top1(){
        $this->display('Index/top');
    }

    public function drag1(){
        $this->display("Index/drag");
    }

    public function menu1(){
        $admin= session('admin');
        $roleId = $admin['role_id'];
        $role= M('role')->find($roleId);
        $authIds = $role['role_auth_ids'];

        $ac = CONTROLLER_NAME."-".ACTION_NAME;
        var_dump($ac);

//        var_dump($authIds);
//        $authList = array();
//        foreach ( (explode(",",$authIds)) as $vo){
//            var_dump($vo);
//            $authList[] .= M('auth')->find($vo);
//            var_dump(M('auth')->find($vo));
//        }
//
//
//
//        var_dump($authList);


        $this->display('Index/menu');
    }
}