<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/2/9
 * Time: 10:15
 */
namespace Home\Controller;

use Think\Controller;

class RegisterController extends HomeBaseController
{

    public function register()
    {
//        import('@.ORG.Mail');
//        $res = sendMail('2277313121@qq.com', '测试', 'what the bug!!!<a href="https://www.baidu.com">众里寻他千百度，蓦然回首，那人却在灯火阑珊处</a>');
//        var_dump($res);


        if (IS_POST) {
           // var_dump(I('mustClick'));die;
            $data['mustClick'] = I('mustClick');
            $data['email'] = I('email');
            $data['password'] = I('password');
            $data['cpassword'] = I('cpassword');
            $data['checkCode'] = I('checkCode');
            $data['reg_time'] = time();
            $data['user_name'] = I('user_name');


            $verify = new \Think\Verify();
            if (!($verify->check($data['checkCode']))) {
                $this->error('验证码错误', U('Register/register'), 1);
            }


            $userModel = D('user');
            //检验确认密码是否正确也是用create里的东东
            if ($userModel->create($data)) {

                unset($data['mustClick']);
                unset($data['cpassword']);
                unset($data['checkCode']);
                $data['password'] = md5(I('password').C('SALT'));

               if( $userModel->add($data)){

                   $this->success('注册成功，请登录邮箱完成邮箱验证！',U('Index/index'),1);
               }


                //生成邮件验证码，并通过邮件的超链接传回来
                $data['emailCode'] = md5(uniqid());

                //通过验证则发送邮件
                import('@.ORG.Mail');
                //heredoc语法
                $content = <<<HTML
<p>欢迎成为本站会员，请点击以下链接完成email认证</p> ;
<p><a href="http://localhost:8/shop/ecshop/index.php/Home/User/emailchk/code/{$data['emailCode']}">点此完成验证</a></p>;
HTML;
                $res = sendMail('2277313121@qq.com', '测试', $content);



            } else {
                $this->error($userModel->getError(), U('Register/register'), 1);
            }
            return;


        }
        $this->display('Login/register');
    }


    public function login(){
        if(IS_POST){
            $data['email'] = I('email');
            $data['password'] =I('password');
            $data['chkcode'] = I('chkcode');

            $verify = new \Think\Verify();
            if (!($verify->check($data['chkcode'] ))) {
                $this->error('验证码错误', U('Register/login'), 1);
            }

            $userModel = D('user');
            $condition['email'] = I('email');
            $user = $userModel->where($condition)->find();
            if(empty($user)){
                $this->error('用户名不存在', U('Register/login'), 1);
            }
            if($user['password'] ==  md5($data['password'].C('SALT')) ){
                session('user_id',$user['user_id']);
                session('user_name',$user['user_name']);

                if(session('url')){
                    redirect(session('url'));
                    session('url',null);
                }else{
                    $this->success('登陆成功',U('Index/index'),1);
                }

            }else{
                $this->error('密码错误，请重新登录', U('Register/login'), 1);
            }


            return;
        }


        $this->display('Login/login');
    }


    public function logout(){
        session(null);
        $this->redirect('Index/index');
    }




    public function checkCode()
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

    public function emailchk(){
        $code = I('code');
        $condition['code'] = I('code');
        $user = M('user')->where($condition)->find();
        if($user){
            $this->success('邮箱验证成功，请登录',U('Register/login'),1);
        }
    }

    public function logInfoAjax(){
        if(session('user_id')){
            $arr = array(
                'ok' => 1,
                'userName'=> session('user_name'),
            );
        }else{
            $arr = array(
                'ok'=> 0,
            );
        }


        echo json_encode($arr); //不能是return

    }

}