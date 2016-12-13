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
        $this->checkLogin();

    }

    public function checkLogin(){
        if(!$_SESSION['admin']){
            $this->error('请先登录',U('Login/login'),1);
        }
    }
}