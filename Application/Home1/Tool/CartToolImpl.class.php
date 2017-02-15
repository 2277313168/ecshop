<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/22
 * Time: 9:18
 */
namespace Home\Tool;

abstract class CartTool{
    /**
     * 向购物车中添加1个商品
     * @param $goods_id int 商品id
     * @param $goods_name String 商品名
     * @param $shop_price float 价格
     * @return boolean
     */
    abstract public function add($goods_id, $goods_name, $shop_price, $goods_img);

    /**
     * 减少购物中1个商品的数量, 如果减至0, 则从购物车删除此商品
     * @param $goods_id int 商品id
     */
    abstract public function dec($goods_id);


    /**
     * 从购物车删除某商品
     * @param $goods_id 商品id
     */
    abstract public function del($goods_id);


    /**
     * 列出购物车所有的商品
     * @return Array
     */
    abstract public function items();

    /**
     * 返回购物车中有几种商品
     * @return int
     */
    abstract public function calcType();

    /**
     * 返回购物中商品的个数
     * @return int
     */
    abstract public function calcCnt();

    /**
     * 返回购物车中商品的总价格
     * @return float
     */
    abstract public function calcMoney();


    /**
     * 清空购物车
     * @return void
     */
    abstract public function clear();

}

class CartToolImpl extends CartTool
{
    public $item = array();
    public static $instance = null;

    //php单例模式
    //self与$this的功能极其相似
    //self是引用静态类的类名，而$this是引用非静态类的实例名
    public static function getInstance(){
        if(self::$instance == null){
            self::$instance = new self();
        }
        return self::$instance;
    }


    final protected function __construct(){
        $this->item = session('?cart')?session('cart'):array();
    }




    /**
     * 向购物车中添加1个商品
     * @param $goods_id int 商品id
     * @param $goods_name String 商品名
     * @param $shop_price float 价格
     * @return boolean
     */
    public function add($goods_id, $goods_name, $shop_price,$goods_img)
    {
        if (isset($this->item[$goods_id])) {
            $this->item[$goods_id]['num'] += 1;
        } else {
            $this->item[$goods_id] = array(
                'num' => 1,
                'goods_name' => $goods_name,
                'shop_price' => $shop_price,
                'goods_img'    => $goods_img,
            );

        }
    }

    /**
     * 减少购物中1个商品的数量, 如果减至0, 则从购物车删除此商品
     * @param $goods_id int 商品id
     */
    public function dec($goods_id)
    {
        $this->item[$goods_id]['num'] -= 1;
        if ($this->item[$goods_id]['num'] == 0) {
            $this->del($goods_id);
        }
    }


    /**
     * 从购物车删除某商品
     * @param $goods_id 商品id
     */
    public function del($goods_id)
    {
      unset($this->item[$goods_id] );
    }


    /**
     * 列出购物车所有的商品
     * @return Array
     */
    public function items(){
        return $this->item;
    }

    /**
     * 返回购物车中有几种商品
     * @return int
     */
    public function calcType(){
        return count($this->item);
    }

    /**
     * 返回购物中商品的个数
     * @return int
     */
    public function calcCnt(){
        $cnt = 0;
        foreach ( $this->item as $k=>$v ){
            $cnt += $v['num'];
        }
        return $cnt;
    }

    /**
     * 返回购物车中商品的总价格
     * @return float
     */
    public function calcMoney(){
        $money = 0 ;
        foreach ($this->item as $k=>$v){
            $money += $v['shop_price'] * $v['num'];
        }
        return $money;
    }


    /**
     * 清空购物车
     * @return void
     */
    public function clear(){
        $this->item = array();
    }


    public function __destruct()
    {
        // TODO: Implement __destruct() method.
        session('cart',$this->item);
    }

}