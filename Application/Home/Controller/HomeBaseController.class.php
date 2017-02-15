<?php
// 本类由系统自动生成，仅供测试用途
namespace Home\Controller;
use Think\Controller;
class HomeBaseController extends Controller
{
	public function __construct()
    {
        parent::__construct();

        //默认折叠，首页覆盖为展开
        $this->assign('fold',true);

        //分类树数据
        $catList = S('catListS');
        if(empty($catList) ){
            $catList = D('category')->getTree();
            S('catListS',$catList);
        }

        $this->assign('catTree',$catList);


    }
}