<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends HomeBaseController
{
    public function index()
    {
        //获取猜你喜欢商品
        $condition['is_best'] = 1;
        $goodsLike = M('Goods')->field('goods_id,goods_name,shop_price,market_price,goods_img')->where($condition)->select();
        $this->assign('goodsLike',$goodsLike);


        $this->assign('page_title','京东首页'); //除系统常量外，其它常量及字符串都要加引号
        $this->assign('fold',false);
    	$this->display('Index/index');
    }





}