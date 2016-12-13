<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/9
 * Time: 10:36
 */
namespace Home\Controller;
use Think\Controller;

class GoodsController extends BaseController{

    public function index(){
        $goodsId = I('id');
        $goods = M('goods')->find($goodsId);
        $this->assign('goods',$goods);

        $condition['goods_id'] =$goodsId;
        $goodsAttr = M('goods_attr')->where($condition)->select();
        $this->assign('goodsAttr',$goodsAttr);

        $this->display('Goods/goods');

    }

}