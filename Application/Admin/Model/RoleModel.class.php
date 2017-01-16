<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/28
 * Time: 18:46
 */
namespace Admin\Model;
use Think\Model\RelationModel;

class RoleModel extends RelationModel{

//    protected $_link = array(
//        'Rel1'=>array(
//            'mapping_type'      => self::MANY_TO_MANY,
//            'class_name'        => 'goods_type',
//            'foreign_key'       =>'type_id',
//            'as_fields'    =>'type_name'
//
//        ),
//    );

    protected $_validate = array(
        array('role_name', 'require', '请输入角色名！'), //默认情况下用正则进行验证
        array('role_name', '', '该角色已存在', 1, 'unique', 3) // 验证name字段是否唯一
    );

}

