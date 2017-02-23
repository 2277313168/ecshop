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
        $keyword = I('keyword');
        $condition['goods_name'] = array('like', "%$keyword%");


        $goodsList = M('goods')->where($condition)->select();
        $this->assign('goodsList', $goodsList);
        $brandList = M('brand')->select();
        $this->assign('brandList', $brandList);
        $catList = D('category')->catTree();
        $this->assign('catList', $catList);
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
            $data['goods_img'] = I('goods_img');
            //$data['goods_thumb'] = I('goods_thumb');
            $data['goods_number'] = I('goods_number');
            $data['click_count'] = I('click_count');
            $data['type_id'] = I('type_id');
            $data["is_best"] = I('is_best');
            $data['is_new'] = I('is_new');
            $data['is_hot'] = I('is_hot');
            $data['is_onsale'] = I('is_onsale');
            $data['add_time'] = time();


            $data['attr_id'] = I('attr_id');
            $data['attr_value'] = I('attr_value');



            $res = uploadOne('goods_img', 'Goods', array(array(60, 60)));
            if ($res['status'] == 1) {
                $data['goods_img'] = $res['images'][0];
                $data['goods_thumb'] = $res['images'][1];
            } else {
                $this->error("图片添加失败", U('Goods/goodsAdd'), 1);
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
                                'attr_id' => $v,
                                'attr_value' => $attrValues[$k],
                                'attr_price' => $attrPrices[$k]
                            );
                        }

                    }

                    M('goods_attr')->addAll($goodsAttrs);


                    //=========添加图片================
                    // var_dump($_FILES);
                    //把$_FILES转化为二维数组
                    $imgs = array();

                    foreach ($_FILES['goods_album']['name'] as $k => $v) {
                        // var_dump($v);
                        if ($_FILES['goods_album']['error'][$k] == 0) {
                            $imgs[] = array(
                                'name' => $v,
                                'type' => $_FILES['goods_album']['type'][$k],
                                'tmp_name' => $_FILES['goods_album']['tmp_name'][$k],
                                'error' => $_FILES['goods_album']['error'][$k],
                                'size' => $_FILES['goods_album']['size'][$k],
                            );
                        }

                    }

                    $_FILES = $imgs;


                    $imgsModel = M('goods_imgs');

                    foreach ($imgs as $k => $v) {
                        $res = uploadOne($k, 'GoodsAlbum', array(array(60, 60)));

                        if ($res['status'] == 1) {
                            $data_imgs['img'] = $res['images'][0];
                            $data_imgs['thumb'] = $res['images'][1];
                            $data_imgs['goods_id'] = $goodsId;
                            $imgsModel->add($data_imgs);

                        } else {
//                            var_dump($res);
//                            die;
                            $this->error("图片添加失败", U('Goods/goodsAdd'), 1);
                        }
                    }


                    $this->success('添加商品成功', U('Goods/goodsAdd'), 1);
                } else {
                    $this->error('添加商品失败', U('Goods/goodsAdd'), 1);
                }

            } else {
                $this->error($goods->getError(), U('Goods/goodsAdd'), 1);
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
        $data['goods_id'] = I('id');
        if (IS_POST) {

            return;
        }
        $goods = M('goods')->find(I('id'));
        $this->assign('goods', $goods);
        $typeList = M('goods_type')->select();
        $catList = D('category')->catTree();
        $brandList = M('brand')->select();
        $this->assign('typeList', $typeList);
        $this->assign('catList', $catList);
        $this->assign('brandList', $brandList);
        $this->display('Goods/goods_edit');
        return;
    }

    public function goodsDelete()
    {

        return;
    }

}