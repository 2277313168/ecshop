<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/9
 * Time: 9:39
 */
namespace Home\Model;
use Think\Model;

class GoodsModel extends Model{

    public function getBest(){
        $condition['is_onsale']= 1;
        $condition['is_best'] =1;
        return $this->where($condition)->order('goods_id desc')->limit(4)->select();
    }

    public function getClothes(){
        $condition['type_id'] = 26;
        return $this->where($condition)->select();
    }

}