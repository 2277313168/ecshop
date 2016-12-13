<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/9
 * Time: 11:48
 */
namespace Home\Controller;
use Think\Controller;

class ListController extends BaseController{

    public function listIndex(){
        $id = I('id',0,'int');
        $breadList = D('category')->getParents($id);
        $this->assign('breadList',$breadList);


        $this->display('List/list');
    }

}