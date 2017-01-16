<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/11/30
 * Time: 9:18
 */

namespace Admin\Controller;

use Think\Controller;

class LoginController extends Controller
{
    public function login()
    {
        if (IS_POST) {
            $name = I('username');
            $psw = I('password');
            $code = I('captcha');

            $verify = new \Think\Verify();
            if (!($verify->check($code))) {
                $this->error('验证码错误', U('Login/login'), 1);
            }


            $condition['admin_name'] = $name;
            $admin = M('admin')->where($condition)->find();

            if($admin['is_use'] == 0){
                $this->error('该账号已被禁用',U('Login/login'),1);
            }

            if(!empty($admin)){
                if($admin['password'] == md5( I('password'). C('SALT') )  ){ //. C('SALT')
                    //var_dump($admin);die;
                    session('admin',$admin);
                    $this->success('登陆成功',U('Index/index1'),1);
                    return;
                }
            }
            $this->error('用户名或密码错误',U('Login/login'),1);
            return;
        }
        $this->display('Login/login');
    }




    public function verifyCode()
    {
        $config = array(
            'fontSize' => 30,    // 验证码字体大小
            'length' => 3,     // 验证码位数
            'useNoise' => false, // 关闭验证码杂点
        );
        $Verify = new \Think\Verify($config);
        $Verify->codeSet = '0123456789';
        $Verify->entry();
    }

    public function logout(){
        session('admin',null);
        $this->success('注销成功',U('Login/login'),1);
    }

}