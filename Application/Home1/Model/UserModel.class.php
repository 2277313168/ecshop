<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/18
 * Time: 9:54
 */
namespace Home\Model;

use Think\Model;

class UserModel extends Model
{

    protected $_validate = array(
        //用user_name而非userName
        array('user_name', '1,9', '请输入1-9位长度的用户名！',1,'length'), //默认情况下用正则进行验证
        array('user_name', '', '用户名称已经存在！', 0, 'unique', 1), // 在新增的时候验证name字段是否唯一
        array('email', 'email', '请输入正确的邮箱！'),
        array('password', '3,9', '请输入3-9位长度的密码！',1,'length'),
        array('repwd', 'password', '确认密码不正确', 0, 'confirm'), // 验证确认密码是否和密码一致

//       array('password','checkPwd','密码格式不正确',0,'function'), // 自定义函数验证密码格式
    );

}