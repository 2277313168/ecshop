<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/11/30
 * Time: 9:23
 */

namespace Admin\Model;
use Think\Model;



class AdminModel extends Model{

    public function checkAdmin($name,$psw){
        $condition['admin_name']=$name;
        $condition['password'] = md5($psw);
        if($admin = $this->where($condition)->find()){
              session('admin',$admin);
            //session(name,value,有效时间)  设置session
            //session(name)         获取session
            //session(name,null)    删除指定session
            //session(null)         删除全部session
            //cookie操作同上，把session换成cookie即可
            return true;
        }
        else{
            return false;
        }
    }



}