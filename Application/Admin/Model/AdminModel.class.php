<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/11/30
 * Time: 9:23
 */

namespace Admin\Model;

use Think\Model;


class AdminModel extends Model
{

    protected $_validate = array(
        array('admin_name', 'require', '请输入角色名！'), //默认情况下用正则进行验证
        array('admin_name', '', '该管理员已存在', 0, 'unique'),// 在新增的时候验证name字段是否唯一
        array('repsw', 'password', '确认密码不正确', 0, 'confirm'), // 验证确认密码是否和密码一致
        array('password', '3,12', '请输入3-12位密码', 0, 'length'), // 自定义函数验证密码格式
    );

    public function checkAdmin($name, $psw)
    {
        $condition['admin_name'] = $name;
        $condition['password'] = md5($psw);
        if ($admin = $this->where($condition)->find()) {
            session('admin', $admin);
            //session(name,value,有效时间)  设置session
            //session(name)         获取session
            //session(name,null)    删除指定session
            //session(null)         删除全部session
            //cookie操作同上，把session换成cookie即可
            return true;
        } else {
            return false;
        }
    }


}