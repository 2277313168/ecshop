<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/14
 * Time: 10:06
 */
namespace Home\Controller;
use Think\Controller;

class UserController extends BaseController{

    public function register()
    {

        $this->display('User/register');
    }

    public function login(){

        $this->display('User/login');
    }

    public function member(){

        $this->display('User/member');
    }

    public function memInfo(){

        $this->display('User/member_info');
    }


}