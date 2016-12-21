<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/9
 * Time: 10:36
 */
namespace Home\Controller;

use Think\Controller;

class GoodsController extends BaseController
{

    public function index()
    {
        $goodsId = I('id');
        $goods = M('goods')->find($goodsId);
        $this->assign('goods', $goods);

        $condition['goods_id'] = $goodsId;
        $goodsAttr = M('goods_attr')->where($condition)->select();
        $this->assign('goodsAttr', $goodsAttr);

        //浏览历史
        $this->history($goods);
        $this->assign('history',array_reverse(session('history')));


        $this->display('Goods/goods');
    }

    //浏览历史
    public function history($goods)
    {
//        $history = array();
        //有history这个session，则把里头的内容赋值给$history;没有，则新建数组
        $history = session('?history') ? session('history') : array();

        //若浏览历史中已有该商品，清除；否则该商品会覆盖原来的，浏览顺序就不对了
        if (isset($history[$goods['goods_id']])) {
            unset($history[$goods['goods_id']]);
        }

        //浏览历史数目不超过3个
        if (count($history) > 3) {
            $key = key($history);//第一个元素的键
            unset($history[$key]);
            //此处不能用array_shift，因为array_shift移除第一个元素，并且会把数字索引置为0开始
        }

        $history[$goods['goods_id']] = array(
            //选择$g中需要的部分，以免cookie中内容过多
            "goods_name" => $goods['goods_name'],
            'shop_price' => $goods['shop_price'],
            'goods_img' => $goods['goods_img'],
        );

        session('history', $history);
//        var_dump(session('history'));
//        session('history',null);
    }


}