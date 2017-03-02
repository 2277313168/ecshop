<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/2/23
 * Time: 15:45
 */
namespace Home\Controller;
use Think\Controller;

class CartController extends HomeBaseController{

    public function add(){
        $goods_id = I('goods_id');
        $goods_num = I('goods_num');
        $goods_attr_id = 1 ;
        D('Cart')->addToCart($goods_id,$goods_attr_id,$goods_num) ;



        redirect(U("Home/Index/goods/id/$goods_id"));
    }

    public function index(){
        $cartList = D('cart')->index();


        $this->assign('cartList',$cartList);
        $this->display('Cart/cart_index');
    }

    public function ajaxUpdate(){
        $id = I('id');
        $num = I('num');

        D('cart')->update($id,$num);

    }


    public function order(){

        $userId = session('user_id') ;
        if($userId == FALSE){ //未登录，跳到登录页面
            //$url = U('order');
            //var_dump($url);die;
            session('url', U('order'));
            redirect(U('Register/login'));
        }
        D('cart')->addToDb();


        // 加锁-> 高并发下单时，库存量会出现混乱的问题，加锁来解决
        $fp = fopen('./order.lock','r');
        flock($fp,LOCK_EX);

        //取出购物车内商品，并判断库存量够不够
        $cartList  = D('Cart')->index() ;
        foreach($cartList as $k=>$v ){
            $goodspd =  M('goods')->field('goods_number')->find($v['goods_id']);
            if($goodspd['goods_number']<$v['goods_num']){
                $this->error("库存不足，无法下单",U("Cart/index"),1);
                return;
            }
        }

        $this->assign('cartList',$cartList);

        //取出该用户的地址
        $where['user_id'] = $userId ;
        $addrList = M('address')->where($where)->order('address_id ASC')->select();
        $this->assign('addrList',$addrList);



        if(IS_POST){
            // 启用事务
//            mysql_query('START TRANSACTION');

            //如果用了新地址，把地址写入数据库中
            if( !empty(I('newAddress'))){
                $dataAddr['user_id'] = $userId ;
                $dataAddr['consignee'] = I('consignee');
                $dataAddr['province'] = I('province') ;
                $dataAddr['city'] = I('city');
                $dataAddr['area'] =I('area') ;
                $dataAddr['street'] = I('street');
                $dataAddr['zipcode'] = I('zipcode');
                $dataAddr['telephone'] = I('telephone');

                $addressModel = M('address');

                if($addressModel->create($dataAddr)){
                    $addressId = $addressModel->add($dataAddr);
                }else{
                   $this->error($addressModel->error(),U('Cart/order'),1);
                    return;
                }
            }else{
                $addressId = I('addressId');
            }


            //添加数据到order表
            $dataOrder['user_id'] = $userId ;
            $dataOrder['address_id'] = $addressId;
            $dataOrder['order_status'] = 1;
            $dataOrder['shipping_id'] = I('shipping_id');
            $dataOrder['pay_id'] = I('pay_id');
            $dataOrder['goods_amount'] =I('goods_amount');
            $dataOrder['order_amount'] =I('goods_amount');
            $dataOrder['order_time'] = time();


            $orderId = M('order')->add($dataOrder);

            //添加数据到订单商品表，并清除购物车表中的数据
            //商品库存量减少，删除购物车中的数据
            foreach ( $cartList as $k=>$v) {
                $dataOg['order_id'] = $orderId ;
                $dataOg['goods_id'] = $v['goods_id'] ;
                $goods = M('goods')->find($v['goods_id']);
                $dataOg['goods_name'] = $goods['goods_name'];
                $dataOg['goods_img'] = $goods['goods_img'];
                $dataOg['shop_price'] = $goods['shop_price'];
                $dataOg['goods_num'] = $v['goods_num'] ;
                $dataOg['goods_attr'] = 1 ;
                $dataOg['subtotal'] = $v['goods_num']*$goods['shop_price'];


                if(M('order_goods')->add($dataOg)){
                    $where2['goods_id'] = $v['goods_id'] ;
                    M('goods')->where($where2)->setDec('goods_number',$v['goods_num'] );

                    M('cart')->delete($v['cart_id']);
                }
            }

            //关闭锁
            flock($fp,LOCK_UN);
            fclose($fp);

            redirect(U("Home/Pay/aliPay/id/$orderId"));

        }



        $this->display('Cart/order');
    }


}