<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/2
 * Time: 9:50
 */
namespace Admin\Controller;
use Think\Controller;

class CategoryController extends BaseController {

    public function catIndex(){
        $catList = D('category')->catTree();
        $this->assign('catList',$catList);
        $this->display('Category/cat_index');
        return;
    }

    public function catAdd(){
        if(IS_POST){
            $data['cat_name'] = I('cat_name');
            $data['parent_id'] = I('parent_id',0,'int');//默认为0，传入id整形化
            $data['cat_desc'] = I('cat_desc');
            $data['unit'] =I('unit');
            $data['is_show'] = I('is_show');
            $data['sort_order'] = I('sort_order');

            $cat = D('category');
            if( $cat->create($data)){
                if($cat->add()){
                    $this->success("添加成功",U('Category/catIndex'),1);
                }else{
                    $this->error("添加失败",U('Category/catIndex'),1);
                }
            }else{
                $this->error($cat->getError(),U('Category/catAdd'),1);
            }



            return;
        }
        $cat=D('category')->catTree();
        $this->assign('catList',$cat);
        //var_dump($cat);
        $this->display('Category/cat_add');
        return;
    }


    public function catEdit(){
        $data['cat_id'] = I('id');
        if(IS_POST){
            $data['cat_name'] = I('cat_name');
            $data['parent_id'] = I('parent_id',0,'int');//默认为0，传入id整形化
            $data['cat_desc'] = I('cat_desc');
            $data['unit'] =I('unit');
            $data['is_show'] = I('is_show');
            $data['sort_order'] = I('sort_order');

            $cat = D('category');

            $subIds = $cat->getSubIds($data['cat_id']);
            //var_dump($subIds);
            if(in_array($data['parent_id'],$subIds)){
                $this->error('不能将当前节点设置为其子节点或本身',U('Category/catIndex'),1);
            }


            if($cat->create($data)){
                if($cat->save()){
                    $this->success('修改成功',U('Category/catIndex'),1);
                }else{
                    $this->error("修改失败",U('Category/catIndex'),1);
                }
            }else{
                $this->error($cat->getError(),U('Category/catEdit'),1);
            }

            return;
        }
        $catList = D('category')->catTree();
        $this->assign('catList',$catList);
        $cat = D('category')->find($data['cat_id']);
        $this->assign('cat',$cat);
        $this->display('Category/cat_Edit');
    }

    public function catDelete(){
        $id = I('id',0,'int');
         $subIds =D('category')->getSubIds($id);

        if(count($subIds) == 1){
            if(M('category')->delete($id)){
                $this->success("删除成功",U('category/catIndex'),1);
            }else{
                $this->error('删除失败',U('category/catIndex'),1);
            }
        }else{
            $this->error('请勿删除非叶子节点',U('category/catIndex'),1);
        }

        return;
    }


}