<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/11/30
 * Time: 18:58
 */
namespace Admin\Controller;

use Think\Controller;

class BrandController extends BaseController
{

    public function brandIndex()
    {

//=========================搜索=============================
        $searchName = I('searchName');

        $condition['brand_name'] = array('like', "%$searchName%");//注意是双引号

//        查询介于a，b之间的东东
//        $a = I('a');
//        $b = I('b');
//        if($a && $b){
//            $condition['price'] = array('EGT',$a);
//            $condition['price'] = array('ELT',$b);
//        }else if($a){
//            $condition['price'] = array('EGT',$a);
//        }else if($b){
//            $condition['price'] = array('ELT',$b);
//        }


//========================翻页================================

        $User = M('brand'); // 实例化User对象
        $count = $User->where($condition)->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count, 3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();// 分页显示输出

// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->where($condition)->order('sort_order asc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('brandList', $list);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出


//        $brandList = M('brand')->select();
//        $this->assign('brandList', $brandList);
        $this->headerFooter('商品品牌', '添加商品');
        $this->display('Brand/brand_index');
        return;
    }


    public function brandAdd()
    {


        if (IS_POST) {
            $data['brand_name'] = I('brand_name');
            $data['brand_desc'] = I('brand_desc');
            $data['url'] = I('url');
            $data['sort_order'] = I('sort_order');
            $data['is_show'] = I('is_show');

            /*
            // if( !$_FILES['logo']['tmp_name']=''){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = C('maxSize');// 设置附件上传大小
            $upload->exts = C('exts');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
            $upload->savePath = './'; // 设置附件上传（子）目录
            // 上传文件
            $info = $upload->upload();

            // $info = $upload->uploadOne($_FILES['logo']);

            //}

//            if (!$info) {// 上传错误提示错误信息，即没有文件上传
//                $this->error($upload->getError());
//            }
            if ($info) {// 上传成功
                foreach ($info as $file) {
//                    var_dump($file);
//                    exit(0);
                    $data['logo'] = $file['savepath'] . $file['savename'];


//                    $image = new \Think\Image();
//                    $image->open("./Uploads/{$data['logo']}");
//
//                    $thPath = "./Uploads/{$file['savepath']}thumb_{$file['savename']}";// 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
//                    $image->thumb(50, 50)->save($thPath);


//                }
//                $data['logo'] = $info['savepath'] . $info['savename'];
            }*/
            $res = uploadOne('logo', 'Brand', array(array(200, 200), array(100, 100)));

            if($res['status'] == 1){
                $data['logo'] = $res['images'][0];
                $data['thumb_logo1'] = $res['images'][1];
                $data['thumb_logo2'] = $res['images'][2];
            }else{

//               $this->error( "图片添加失败" , U('Brand/brandAdd'),TRUE);
            }


           // $data['logo'] = $res[images][0];


            $brand = D('brand');
            if (!$brand->create($data)) {
                $this->error($brand->getError(), U('Brand/brandAdd'), TRUE);
            }


            if ($brand->add()) {
                $this->success("添加成功", U('Brand/brandIndex'), TRUE);
            } else {
                $this->error("添加失败", U('Brand/brandAdd'), TRUE);
            }
            return;
        }
        $this->display('Brand/brand_add');
        return;
    }


    public function brandEdit()
    {
        $data['brand_id'] = I('id');
        if (IS_POST) {
            $data['brand_name'] = I('brand_name');
            $data['brand_desc'] = I('brand_desc');
            $data['url'] = I('url');
            $data['sort_order'] = I('sort_order');
            $data['is_show'] = I('is_show');

            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
            $upload->savePath = './'; // 设置附件上传（子）目录


            $info = $upload->uploadOne($_FILES['logo']);       // 上传文件

            if ($info) {
                $data['logo'] = $info['savepath'] . $info['savename'];

                //删除原图片
                $logo = M('brand')->field('logo')->find(I('id'));
                $path = './Uploads' . $logo['logo'];
                unlink($path);//删除图片
            }

            $brand = M('brand');

            //save方法返回的是影响的记录数，如果没有修改任何值，返回的是0，如果修改失败返回FALSE
            if (FALSE !== $brand->save($data)) {
                $this->success("修改成功", U('Brand/brandIndex'), 1);
            } else {
                $this->error("修改失败", U('Brand/brandEdit'), 1);
            }
            return;
        }
        $brand = M('brand')->find($data['brand_id']);
        $this->assign('brand', $brand);
        $this->display("Brand/brand_edit");
        return;

    }

    public function brandDelete()
    {
        $id = I('id');
        $p = I('p');

        if (D('brand')->delete($id)) {
            $this->success("删除成功！", U("Brand/brandIndex", "p=$p"), 1);
        } else {
            $this->error("删除失败", U("Brand/brandIndex", "p=$p"), 1);
        }

    }

}