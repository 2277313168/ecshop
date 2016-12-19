<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/14
 * Time: 10:06
 */
namespace Home\Controller;

use Think\Controller;

class UserController extends BaseController
{

    public function register()
    {
        if (IS_POST) {

            $data['user_name'] = I('userName');
            $data['password'] = I('pwd');
            $data['repwd'] = I('repwd');
            $data['email'] = I('email');
            $data['reg_time'] = time();

            $code = I('code');

            $verify = new \Think\Verify();
            if (!($verify->check($code))) {
                $this->error('验证码错误', U('User/register'), 1);
            }

            $userModel = D('user');
            if (!$userModel->create($data)) {
                $this->error($userModel->getError(), U('User/register'), 1);
            }

            //密码加盐
            $salt = $this->salt();
            $userModel->salt = $salt;
            $userModel->password = md5($data['password'] . $salt);

            if ($userModel->add()) {
                $this->success('注册成功', U('Index/index'), 1);
                session('userName', $data['user_name']);
            } else {
                $this->error('注册失败', U('User/register'), 1);
            }

            return;
        }

        $this->display('User/register');
    }

    public function login()
    {
        if (IS_POST) {
            $userName = I('userName');
            $pwd = I('pwd');
            $code = I('code');

            $verify = new \Think\Verify();
            if (!($verify->check($code))) {
                $this->error('验证码错误', U('User/login'), 1);
            }

            $condition['user_name'] = $userName;
            $user = M('user')->where($condition)->find();

            if (!empty($user)) {
                if ($user['password'] == md5($pwd . $user['salt'])) {
                    cookie('userName', $user['user_name']);
                    cookie('pwd',$user['password']);
                    $cookieJm = md5( $user['user_name'].$user['password'].C('SALT'));//C('SALT')为配置文件config.php中的常量
                    cookie('cookieJm',$cookieJm);
                    $this->success('登陆成功', U('Index/index'), 1);
                    return;
                }
            }

            $this->error('用户名或密码错误', U('User/login'), 1);
            return;

        }

        $this->display('User/login');
    }

    public function logout(){
        cookie('userName',null);
        cookie('pwd',null);
        cookie('cookieJm',null);
        $this->display('User/login');

    }

    public function member()
    {

        $this->display('User/member');
    }

    public function memInfo()
    {

        $this->display('User/member_info');
    }


//生成验证码
    public function createCode()
    {
        $config = array(
            'fontSize' => 30,    // 验证码字体大小
            'length' => 3,     // 验证码位数
            'useNoise' => false, // 关闭验证码杂点
            'codeSet' => '0123456789', // 设置验证码字符为纯数字
        );
        $Verify = new \Think\Verify($config);
        $Verify->entry();
    }

    public function salt()
    {
        $str = 'ele@!$#$uw754%$&^%32';
        return substr(str_shuffle($str), 0, 8);
    }

}