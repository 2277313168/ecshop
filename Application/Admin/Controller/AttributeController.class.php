<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/4
 * Time: 9:38
 */
namespace Admin\Controller;
use Think\Controller;

class AttributeController extends BaseController {

    public function attrIndex(){
        $type_id = I('id',0,'int');
        $condition['type_id'] =$type_id;

        if($type_id ==0){
            $attr = D('attribute')->relation(true)->select();
        }else{
            $attr = D('attribute')->relation(true)->where($condition)->select();
        }
        $this->assign('attrList',$attr);

        $typeList = M('goods_type')->select();
        $this->assign('type_id',$type_id);
        $this->assign('typeList',$typeList);
        $this->display('Attribute/attribute_index');
        return;
    }

    public function attrAdd(){
        if(IS_POST){
            $data['attr_name']=I('attr_name');
            $data['attr_type'] = I('attr_type');
            $data['attr_input_type'] = I('attr_input_type');
            $data['attr_value'] = I('attr_value');
            $data['type_id']=I('type_id');

            $attr = D('attribute');
            if($attr->create($data)){
                if($attr->add()){
                    $this->success('添加属性成功',U('Attribute/attrIndex'),1);
                }else{
                    $this->error('添加属性失败',U('Attribute/attrIndex'),1);
                }
            }else{
                $this->error($attr->getError(),U('Attribute/attrIndex'),1);
            }

            return;
        }
        $typeList = M('goods_type')->select();
        $this->assign('typeList',$typeList);

        $this->display('Attribute/attribute_add');
        return;
    }



    public function attrEdit(){
        $data['attr_id']=I('id');
        if(IS_POST){
            $data['attr_name']=I('attr_name');
            $data['attr_type'] = I('attr_type');
            $data['attr_input_type'] = I('attr_input_type');
            $data['attr_value'] = I('attr_value');
            $data['type_id']=I('type_id');

            $attr = M('attribute');
            if($attr->create($data)){
                if($attr->save()){
                    $this->success('修改属性成功',U('Attribute/attrIndex'),1);
                }else{
                    $this->error('修改属性失败',U('Attribute/attrIndex'),1);
                }
            }else{
                $this->error($attr->getError(),U('Attribute/attrIndex'),1);
            }

            return;
        }
        $attr = M('attribute')->find($data['attr_id']);
        $this->assign('attr',$attr);

        $typeList = M('goods_type')->select();
        $this->assign('typeList',$typeList);
        $this->display('Attribute/attribute_edit');
        return;
    }


    public function attrDelete(){
        $id = I('id');
        if(M('attribute')->delete($id)){
            $this->success('删除属性成功！',U('Attribute/attrIndex'),1);
        }else{
            $this->error('删除属性失败',U('Attribute/attrIndex'),1);
        }

        return;
    }



    public function getAttrs(){
        $type_id = I('type_id');
        $attrs = D('attribute')->getAttrsForm($type_id);
        $this->ajaxReturn($attrs,'eval');
    }

}