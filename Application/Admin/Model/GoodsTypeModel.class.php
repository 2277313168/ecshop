<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/3
 * Time: 22:20
 */
namespace Admin\Model;
use Think\Model;

class GoodsTypeModel extends Model{

    protected $_validate = array(
        array('type_name','require','请输入类型名称！'), //默认情况下用正则进行验证
        array('type_name','','该类型已存在',0,'unique',1) // 在新增的时候验证name字段是否唯一
    );

}