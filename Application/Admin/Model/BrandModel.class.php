<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/11/30
 * Time: 19:36
 */
namespace Admin\Model;

use Think\Model;

class BrandModel extends Model
{

    protected $_validate = array(
        array('brand_name', 'require', '请输入品牌名！'), //默认情况下用正则进行验证
        array('brand_name', '', '该品牌已存在', 0, 'unique', 1) // 在新增的时候验证name字段是否唯一
    );


}