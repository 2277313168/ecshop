<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/2/9
 * Time: 11:00
 */
namespace Home\Model;
use Think\Model;

class UserModel extends Model{

    //注册验证
    protected $_validate = array(
        array('mustClick','require','必须同意注册协议才能注册！'), //默认情况下用正则进行验证
        array('user_name','require','用户名必须！'), //默认情况下用正则进行验证
        array('email','require','邮箱必须！'), //默认情况下用正则进行验证
        array('password','require','密码必须！'), //默认情况下用正则进行验证
        array('cpassword','require','确认密码必须！'), //默认情况下用正则进行验证
        array('checkCode','require','验证码必须！'), //默认情况下用正则进行验证
        array('email','email','email格式错误'),

        array('email','','该邮箱已被注册！',0,'unique',1), // 在新增的时候验证name字段是否唯一
        array('password','2,20','密码必须是3-20位！',2,'length'), // 当值不为空的时候判断是否在一个范围内
        array('cpassword','password','确认密码不正确',0,'confirm'), // 验证确认密码是否和密码一致
        array('password','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式
    );



}