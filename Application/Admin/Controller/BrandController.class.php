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
        $User = M('brand'); // 实例化User对象
        $count = $User->count();// 查询满足要求的总记录数
        $Page = new \Think\Page($count, 3);// 实例化分页类 传入总记录数和每页显示的记录数(25)
        $Page->setConfig('prev', '上一页');
        $Page->setConfig('next', '下一页');
        $show = $Page->show();// 分页显示输出

// 进行分页数据查询 注意limit方法的参数要使用Page类的属性
        $list = $User->order('sort_order asc')->limit($Page->firstRow . ',' . $Page->listRows)->select();
        $this->assign('brandList', $list);// 赋值数据集
        $this->assign('page', $show);// 赋值分页输出


//        $brandList = M('brand')->select();
//        $this->assign('brandList', $brandList);
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

            // if( !$_FILE['logo']['tmp_name']=''){
            $upload = new \Think\Upload();// 实例化上传类
            $upload->maxSize = 3145728;// 设置附件上传大小
            $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
            $upload->rootPath = './Uploads/'; // 设置附件上传根目录
            $upload->savePath = './'; // 设置附件上传（子）目录
            // 上传文件
           $info   =   $upload->upload();

           // $info = $upload->uploadOne($_FILES['logo']);

            //}

//            if (!$info) {// 上传错误提示错误信息，即没有文件上传
//                $this->error($upload->getError());
//            }
            if ($info) {// 上传成功
                foreach($info as $file){
//                    var_dump($file);
//                    exit(0);
                    $data['logo'] = $file['savepath'].$file['savename'];


                    $image = new \Think\Image();
                    $image->open("./Uploads/{$data['logo']}");
                    // 按照原图的比例生成一个最大为150*150的缩略图并保存为thumb.jpg
                    $thPath = "./Uploads/{$file['savepath']}thumb_{$file['savename']}";
                    $image->thumb(50, 50)->save($thPath);


                }
//                $data['logo'] = $info['savepath'] . $info['savename'];
            }

            $brand = D('brand');
            if (!$brand->create($data)) {
                $this->error(($brand->getError()), U('Brand/brandAdd'), 1);
            }


            if ($brand->add()) {
                $this->success("添加成功", U('Brand/brandIndex'), 1);
            } else {
                $this->error("添加失败", U('Brand/brand_Add'), 1);
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
            }

            $brand=M('brand');

            if ($brand->save($data)) {
                $this->success("修改成功", U('Brand/brandIndex'), 1);
            } else {
                $this->error("修改失败", U('Brand/brandEdit'), 1);
            }
            return;
        }
        $brand=M('brand')->find($data['brand_id']);
        $this->assign('brand',$brand);
        $this->display("Brand/brand_edit");
        return;

    }

    public function brandDelete()
    {
        $id=I('id');
        if(M('brand')->delete($id)){
            $this->success("删除成功！",U('Brand/brandIndex'),1);
        }else{
            $this->error("删除失败",U('Brand/brandIndex'),1);
        }

    }

}