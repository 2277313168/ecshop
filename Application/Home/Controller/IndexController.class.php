<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class IndexController extends HomeBaseController
{
    public function index()
    {
        //获取猜你喜欢商品
        $condition1['is_best'] = 1;
        $goodsLike = M('Goods')->field('goods_id,goods_name,shop_price,market_price,goods_img')->where($condition1)->select();
        $this->assign('goodsLike',$goodsLike);

        //获取热卖商品
        $condition2['promote_start_time'] = array('LT' ,time());
        $condition2['promote_end_time'] = array('GT' ,time());
        $condition2['is_hot'] = 1;
        $goodsHot = M('Goods')->field('goods_id,goods_name,shop_price,market_price,goods_img,promote_start_time,promote_end_time')->where($condition2)->select();
        $this->assign('goodsHot',$goodsHot);

        $this->assign('page_title','京东首页'); //除系统常量外，其它常量及字符串都要加引号
        $this->assign('fold',false);
    	$this->display('Index/index');
    }

    public function goods(){
        $id = I('id');
        $goods = M('goods')->find($id);

        $condition['goods_id'] = $id;
        $goodsAlbum = M('goods_imgs')->where($condition)->select();


        $this->assign('goodsAlbum',$goodsAlbum);
        $this->assign('goods',$goods);



        //==============================最近浏览===========================
        $history = isset($_COOKIE['history'] )? unserialize($_COOKIE['history']):array();
        array_unshift($history,$id);
        array_unique($history);
        if(count($history) > 10){
            array_slice($history,0,10);
        }
        setcookie('history',serialize($history),time()+30*24*3600,'/');
        //第三个参数设置cookie有效时间为30天，第4个参数设置cookie可以跨目录访问


        $this->display('Index/goods');
    }

    public function ajaxHistory(){

        $history = isset($_COOKIE['history']) ? unserialize($_COOKIE['history']): array();
        $historyStr = implode(',',$history);
        $where['goods_id'] = array('IN',$history);
        $goodsArr = M('goods')->field("goods_id,goods_img,goods_name")->where($where)->order("INSTR( ',$historyStr,',CONCAT(',',goods_id,',') )")->select();

//        var_dump($goodsArr);die;
        echo json_encode($goodsArr);
    }

    public function ajaxComment(){

        if(session('user_id')){
            echo json_encode(1);
        }else{
            echo json_encode(0);
        }
    }

    public function ajaxLogin(){
        session('url',$_SERVER['HTTP_REFERER']);
    }


    public function ajaxShopPrice(){
        $id = I('id');
        $shopPrice = M('goods')->field('shop_price')->find($id);
        echo $shopPrice['shop_price'];  //整数就不需要json_encode啦
    }










}