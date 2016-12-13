<?php
namespace Home\Controller;
use Think\Controller;

class IndexController extends BaseController {

    public function index(){

        $bestGoods = D('goods')->getBest();
        $this->assign('bestGoods',$bestGoods);
        $this->assign('flag',true);

        $this->display("Index/index");
    }

}