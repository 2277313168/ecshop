<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/7
 * Time: 10:55
 */
namespace Admin\Model;
use Think\Model\RelationModel;

class GoodsModel extends RelationModel{

    protected $_validate = array(
        array('goods_name','require','请输入商品名称！'), //默认情况下用正则进行验证
        array('cat_id','0','请选择商品分类！',0 ,'notequal'), //默认情况下用正则进行验证
    );

    protected $_link = array(
        'rel1'=>array(
            'mapping_type'      => self::HAS_ONE,
            'class_name'        => 'goods_attr',
            'foreign_key '  => 'goods_id',
            'as_fields' => 'attr_id',
            'as_fields' => 'attr_value',
            'as_fields' => 'attr_price',

            ),
        );


}