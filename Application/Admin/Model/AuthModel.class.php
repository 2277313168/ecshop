<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/27
 * Time: 15:29
 */
namespace Admin\Model;
use Think\Model;

class AuthModel extends Model
{

    protected $_validate = array(
        array('auth_name', 'require', '请输入权限名称！'), //默认情况下用正则进行验证
//        array('auth_name', '', '该权限名称已存在', 0, 'unique', 1) // 在新增的时候验证name字段是否唯一
    );


    public function tree($arr,$pid = 0,$level=0){
        static $res = array();
        foreach($arr as $v){
            if($v['auth_pid'] == $pid){
                $v['level'] = $level;
                $res[] = $v;
                $this->tree($arr,$v['auth_id'],$level+1);
            }
        }
        return $res;
    }


    public function getTree(){
        $auth = $this->select();
        return $this->tree($auth,0,0);

    }


}