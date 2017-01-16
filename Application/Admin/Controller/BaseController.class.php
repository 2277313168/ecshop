<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/11/30
 * Time: 9:09
 */
namespace Admin\Controller;
use Think\Controller;


class BaseController extends Controller{

    public function __construct()
    {
        parent::__construct();
        if(!session('admin')){
            $this->error('请先登录',U('Login/login'),1);
        }
        $admin = session('admin');
  //      var_dump(MODULE_NAME.'/'.CONTROLLER_NAME.'/'.ACTION_NAME);
        //若为超级管理员，则拥有所有权限
        if($admin['admin_id'] == 1){
            return ;
        }


        //若为index控制器，则所有管理员都有访问权限
        if(CONTROLLER_NAME == 'Index'){ //记得加双引号
//            var_dump('index');
//            var_dump($admin);
//            $this->display('Index/index');
              return ;
        }


        //若为普通管理员，判断其权限数据库里是否有这条权限
        //SELECT e.* FROM `cz_admin` a LEFT JOIN `cz_admin_role` b ON a.admin_id=b.admin_id LEFT JOIN `cz_role`c ON b.role_id = c.role_id
        // LEFT JOIN `cz_role_auth` d ON c.role_id = d.role_id LEFT JOIN `cz_auth` e ON d.auth_id=e.auth_id WHERE a.admin_id=1
        $condition['a.admin_id'] = $admin['admin_id'];
//        $condition['a.admin_id'] =1;
        $condition['e.controller_name'] = CONTROLLER_NAME;
        $condition['e.action_name'] =ACTION_NAME;
        $authJudge =  M('admin')->alias('a')->field('e.controller_name,e.action_name')->join('LEFT JOIN `cz_admin_role` b ON a.admin_id=b.admin_id LEFT JOIN `cz_role`c ON b.role_id = c.role_id LEFT JOIN `cz_role_auth` d ON c.role_id = d.role_id LEFT JOIN `cz_auth` e ON d.auth_id=e.auth_id ')
            ->where($condition)->find();
 //       var_dump($authJudge);
        if(empty($authJudge)){
            $this->error('抱歉，您没有访问权限',U(),1);
        }



    }

    public function headerFooter($title1,$title2){
        $this->assign('title1',$title1);
        $this->assign('title2',$title2);
    }

}