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
        $adminId = $admin['admin_id'];

        //不用联合5个表，3个表就ok啦
        //SELECT a.* FROM `cz_auth` a LEFT JOIN `cz_role_auth` b ON a.auth_id = b.auth_id
        // LEFT JOIN `cz_admin_role` c ON b.role_id = c.role_id where c.admin_id=1;
        $condition['c.admin_id'] = $adminId;
       $authMenu =  M('auth')->alias('a')->field('a.*')->group('a.auth_id')->join('LEFT JOIN `cz_role_auth` b ON a.auth_id = b.auth_id 
        LEFT JOIN `cz_admin_role` c ON b.role_id = c.role_id ')->where($condition)->select();

        $authMenu2 = array();
        foreach ($authMenu as $k => $v){
            if($v['auth_pid'] == 0){

                foreach ($authMenu as $k2 => $v2){
                    if($v['auth_id'] == $v2['auth_pid']){
                        $v['child'][] = $v2;
                    }
                }
                $authMenu2[] = $v;

            }
        }
//        var_dump($authMenu);
//        var_dump($authMenu2);
        $this->assign('authMenu',$authMenu2);
        $this->display('Index/menu');
    }
}