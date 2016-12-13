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

            if (D('admin')->checkAdmin($name, $psw)) {
                $this->success('登陆成功', U('Index/index'), 1);
            } else {
                $this->error('用户名或密码错误', U('Login/login'), 1);
            }
            return;
        } else {
            $this->display('Login/login');
            return;
        }
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
        session('[destroy]');
        $this->success('注销成功',U('Login/login'),1);
    }

}