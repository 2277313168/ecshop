<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/14
 * Time: 9:52
 */
namespace Home\Controller;
use Home\Controller;

class OrderController extends BaseController{

    public function order(){

        $this->display('Order/order');
    }

}