<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/4
 * Time: 10:00
 */
namespace Admin\Model;
use Think\Model\RelationModel;

class AttributeModel extends RelationModel{

    protected $_validate = array(
        array('attr_name','require','请输入属性名称！'), //默认情况下用正则进行验证
        array('type_id','require','请选择商品类型'), //默认情况下用正则进行验证
//        array('attr_name','','属性名称已存在',0,'unique',1) // 在新增的时候验证name字段是否唯一
    );

    protected $_link = array(
        'Rel1'=>array(
            'mapping_type'      => self::BELONGS_TO,
            'class_name'        => 'goods_type',
            'foreign_key'       =>'type_id',
            'as_fields'    =>'type_name'

            ),
        );


    public function getAttrsForm($type_id){
        $condition['type_id'] = $type_id;
        $attrList = $this->where($condition)->select();

        $res = '<table width="100%" id="attrTable">';
        $res .= '<tbody>';
        foreach ($attrList as $vo){

            $res .= '<tr>';
//            $res .= '<td class="label">{$vo.attr_name}</td>';
//            单双引号不能反着用，单引号中的变量不能被解析
//            $res .= '<td class="label">{$vo["attr_name]}</td>';
            $res .= "<td class='label'>{$vo['attr_name']}</td>";
            $res .= '<td>';
            $res .= '<input type="hidden" name="attr_id_list[]" value=" '.$vo["attr_id"].' ">';
            $res .= '<input type="hidden" name="attr_price_list[]" value="">';
            if($vo['attr_input_type'] == 0){
                $res .= " <input name='attr_value_list[]' type='text' value='".$vo["attr_value"]."' size='40'>";
            }else if($vo['attr_input_type'] == 1){
                $res .= '<select name="attr_value_list[]">';
                $res .= '<option value="">请选择...</option>';
                $opts = explode(PHP_EOL,$vo['attr_value']);
                foreach ($opts as $opt){
                    $res .= "<option value='$opt'>$opt</option>";
                }
                $res .= '</select>';

            }else{
                $res .= '<textarea rows="5" cols="6">{$vo.attr_value}</textarea>';

            }
            $res .= '</td>';
            $res .= '</tr>';
        }
        $res .= '</tbody>';
        $res .= '</table>';
        return $res;
    }




}