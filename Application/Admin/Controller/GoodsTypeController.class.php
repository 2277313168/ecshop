<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/3
 * Time: 21:53
 */
namespace Admin\Controller;

use Think\Controller;

class GoodsTypeController extends BaseController
{

    public function typeIndex()
    {


        $User = M('goods_type'); // 实例化User对象
        $count = $User->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count, 5);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $show = $Page->show();// 分页显示输出
// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->limit($Page->firstRow . ',' . $Page->listRows)->select();


        $this->assign('typeList', $list);
        $this->assign('page', $show);
        $this->display('GoodsType/type_index');
    }

    public function typeAdd()
    {
        if (IS_POST) {
            $data['type_name'] = I('type_name');
            $type = D('goods_type');
            if ($type->create($data)) {
                if ($type->add()) {
                    $this->success('添加类型成功', U('GoodsType/typeIndex'), 1);
                } else {
                    $this->error('添加类型失败', U("GoodsType/typeIndex"), 1);
                }

            } else {
                $this->error($type->getError(), U("GoodsType/typeAdd"), 1);
            }


            return;
        }
        $this->display('GoodsType/type_add');
    }

    public function typeEdit()
    {
        $data['type_id'] = I('id');
        if (IS_POST) {
            $data['type_name'] = I('type_name');

            $type = D('goods_type');
            if ($type->create($data)) {
                if ($type->save()) {
                    $this->success('修改成功', U("GoodsType/typeIndex"), 1);
                } else {
                    $this->error('修改失败', U("GoodsType/typeIndex"), 1);
                }
            } else {
                $this->error($type->getError(), U("GoodsType/typeIndex"), 1);
            }


            return;
        }
        $type = M('goods_type')->find(I('id'));
        $this->assign('type', $type);
        $this->display('GoodsType/type_edit');
        return;
    }


    public function typeDelete(){
        $id = I('id');
        if(M('goods_type')->delete($id)){
            $this->success('删除成功',U('GoodsType/typeIndex'),1);
        }else{
            $this->error('删除失败',U('GoodsType/typeIndex'),1);
        }
    }


}