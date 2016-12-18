<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/9
 * Time: 11:12
 */
namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller{

    public function __construct()//构造方法，用于初始化
    {
        parent::__construct();//如果没有，则父类Controller中的construct会被自定义的construct覆盖，从而丢失一些东西
        $catList = D('category')->catTree();
        $this->assign('catList',$catList);

        $this->assign('flag',false);//标志是否为首页，默认为不是首页;在indexController中将flag置为1

    }

}