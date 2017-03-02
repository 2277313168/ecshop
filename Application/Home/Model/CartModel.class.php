<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/2/23
 * Time: 15:54
 */
namespace Home\Model;

use Think\Model;

class CartModel extends Model
{

    public function addToCart($goods_id, $goods_attr_id, $goods_num = 1)
    {

        if (session('user_id')) {//若登录，放入数据库中
            $cartModel = M('Cart');
            $data['goods_id'] = $goods_id;
            $data['goods_attr_id'] = $goods_attr_id;
            $data['user_id'] = session('user_id');
            //$data['goods_num'] = $goods_num;
            $goods = $cartModel->where($data)->find();
            if ($goods) { //商品存在，则数量加
                //$goods->setInc('goods_num',$goods_num); 不是这么用的
                $cartModel->where($data)->setInc('goods_num', $goods_num);
            } else {
                $data['goods_num'] = $goods_num;
                $cartModel->add($data);
            }

        } else { //若未登录，放入cookie中
            $goodsCookie = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
            $k = $goods_id . '-' . $goods_attr_id;
            if (isset($goodsCookie[$k])) {//商品存在，则数量加
                $goodsCookie[$k] += $goods_num;
            } else { //否则
                $goodsCookie[$k] += $goods_num;
            }
            $aMonth = 30 * 24 * 3600;
            setcookie('cart', serialize($goodsCookie), time() + $aMonth, '/');
        }


    }

    public function index()
    {
        $userId = session('user_id');
        if ($userId) { //若登录，从数据库中取出数据
            $where['user_id'] = $userId;
            $cartList = M('cart')->where($where)->select();

        } else { //若未登录，从cookie中取出数据
            $cartC = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
            //把cookie中序列化的一维数组转化为二维数组后
            //与数据库中格式一致，然后统一处理
            $cartList = array();
            $i = 0;
            foreach ($cartC as $k => $v) {
                $k = explode('-', $k);
                $cartList[$i]['user_id'] = $userId;
                $cartList[$i]['goods_id'] = $k[0];
                $cartList[$i]['goods_attr_id'] = 1;
                $cartList[$i]['goods_num'] = $v;
                $i++;
            }
        }

        //统一添加商品名、价格、图片等信息
        $goodsModel = M('goods');
        foreach ($cartList as $k => $v) {
            $goodsId = $cartList[$k]['goods_id'];
            $goods = $goodsModel->field('goods_name,goods_number,shop_price,goods_img')->find($goodsId);
            $cartList[$k]['goods_name'] = $goods['goods_name'];
            $cartList[$k]['shop_price'] = $goods['shop_price'];
            $cartList[$k]['goods_img'] = $goods['goods_img'];
            $cartList[$k]['goods_kucun'] = $goods['goods_number'];
        }
        return $cartList;

    }

    //将cookie中的数据添加到数据库中,并清空COOKIE中的数据
    public function addToDb()
    {
        $cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();

        foreach ($cart as $k => $v) {
            $kArr = explode('-', $k);
            $data['goods_id'] = $kArr[0];
            $data['goods_attr_id'] = 1;
            $data['user_id'] = session('user_id');
            $data['goods_num'] = $v;

            $this->addToCart($data['goods_id'],1,$data['goods_num']);
        }
        //并清空COOKIE中的数据
        setcookie('cart', '', time()-1, '/');

    }

    public function update($id, $num)
    {
        $userId = session('user_id');
        if ($userId == FALSE) { //未登录，更改cookie中的数据
            $cart = isset($_COOKIE['cart']) ? unserialize($_COOKIE['cart']) : array();
            $goods_attr_id = 1;
            $k = $id . '-' . $goods_attr_id;
            if ($num == 0) { //若为0，则删除该记录
                unset($cart[$k]);
            } else { //否则，更改商品数量
                //判断库存量够不够
                $cart[$k] = $num;
            }

            setcookie('cart', serialize($cart), time() + 30 * 3600 * 24, '/');
        } else { //更改数据库中的数据
            $where['goods_id'] = $id;
            $where['user_id'] = $userId;
            if ($num == 0) { //若为0，则删除该记录
                M('cart')->where($where)->delete();
            } else { //否则，更改商品数量
                M('cart')->where($where)->setField('goods_num', $num);
            }

        }

    }


}