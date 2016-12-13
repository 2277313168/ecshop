<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/5
 * Time: 11:01
 */
namespace Admin\Controller;

use Think\Controller;

class GoodsController extends BaseController
{

    public function goodsIndex()
    {
        $goodsList = M('goods')->select();
        $this->assign('goodsList',$goodsList);
        $brandList = M('brand')->select();
        $this->assign('brandList',$brandList);
        $catList =D('category')->catTree();
        $this->assign('catList',$catList);
        $this->display('Goods/goods_index');
        return;
    }

    public function goodsAdd()
    {
        if (IS_POST) {
            $data['goods_sn'] = I('goods_sn');
            $data['goods_name'] = I('goods_name');
            $data['goods_brief'] = I('goods_brief');
            $data['goods_desc'] = I('goods_desc');
            $data['cat_id'] = I('cat_id');
            $data['brand_id'] = I('brand_id');
            $data['market_price'] = I('market_price');
            $data['shop_price'] = I('shop_price');
            $data['promote_price'] = I('promote_price');
            $data['promote_start_time'] = I('promote_start_time', 0, 'strtotime');
            $data['promote_end_time'] = I('promote_end_time', 0, 'strtotime');
            //$data['goods_img'] = I('goods_img');
            $data['goods_thumb'] = I('goods_thumb');
            $data['goods_number'] = I('goods_number');
            $data['click_count'] = I('click_count');
            $data['type_id'] = I('type_id');
            $data["is_best"] = I('is_best');
            $data['is_new'] = I('is_new');
            $data['is_hot'] = I('is_hot');
            $data['is_onsale'] = I('is_onsale');
            $data['add_time'] = time();


            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize   =     3145728 ;// 设置附件上传大小
            $upload->exts      =     array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath  =     './Uploads/'; // 设置附件上传根目录
            $upload->savePath  =     './'; // 设置附件上传（子）目录
            // 上传文件
            $info   =   $upload->uploadOne($_FILES['goods_img']);
//            $info   =   $upload->upload();
            if($info) {// 上传错误提示错误信息
                $data['goods_img']= $info['savepath'].$info['savename'];

            }


            $goods = D('goods');
            if ($goods->create($data)) {
                if ($goodsId = $goods->add()) {
                    $attrIds = I('attr_id_list');//数组
                    $attrValues = I('attr_value_list');
                    $attrPrices = I('attr_price_list');
                    $goodsAttrs = array();//二维数组的遍历
                    if (!empty($attrIds)) {
                        foreach ($attrIds as $k => $v) {
                            $goodsAttrs[] = array(
                                'goods_id' => $goodsId,
                                'attr_id' => $k,
                                'attr_value' => $attrValues[$k],
                                'attr_price' => $attrPrices[$k]
                            );
                        }

                    }

                    M('goods_attr')->addAll($goodsAttrs);

                    $this->success('添加商品成功', U('Goods/goodsAdd'), 1);
                } else {
                    $this->error('添加商品失败', U('Goods/goodsAdd'), 1);
                }

            } else {
                $this->error(getError(), U('Goods/goodsAdd'), 1);
            }

            return;
        }
        $typeList = M('goods_type')->select();
        $catList = D('category')->catTree();
        $brandList = M('brand')->select();
        $this->assign('typeList', $typeList);
        $this->assign('catList', $catList);
        $this->assign('brandList', $brandList);
        $this->display('Goods/goods_add');
        return;
    }

    public function goodsEdit()
    {
        if (IS_POST) {

            return;
        }
        $this->display('Goods/goods_edit');
        return;
    }

    public function goodsDelete()
    {

        return;
    }

}