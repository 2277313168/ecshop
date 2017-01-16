<?php


function salt()
{
    $str = 'ele@!$#$uw754%$&^%32';
    return substr(str_shuffle($str), 0, 8);
}


function removeXSS($val)
{
    //实现了一个单例模式，这个函数调用多次时，只有第一次会生成一个对象，
    //之后再调用使用的是第一次生成的对象，使性能更好，占用内存更小
    static $obj = null;
    if ($obj === null) {
        require('./Public/HTMLPurifier/HTMLPurifier.includes.php');
        $config = HTMLPurifier_Config::createDefault();
        // 保留a标签上的target属性
        $config->set('HTML.TargetBlank', TRUE);
        $obj = new HTMLPurifier($config);
    }
    return $obj->purify($val);

    //使用方法：
    //修改配置文件，让I函数使用这个函数来过滤
    // 'DEFAULT_FILTER' => 'removeXSS',
}


//  上传图片并生成缩略图
//  用法：
//  $res = uploadOne('logo', 'Goods', array(
//  array(600, 600),
//  array(300, 300),
//  array(100, 100),
//  ));
//  返回值：
//  if($res['ok'] == 1)
//  {
//  $res['images'][0];   // 原图地址
//  $res['images'][1];   // 第一个缩略图地址
//  $res['images'][2];   // 第二个缩略图地址
//  $res['images'][3];   // 第三个缩略图地址
//  }
//  else
//  {
//  $this->error = $res['error'];
//  return FALSE;
//  }


function uploadOne($imgName, $dirName, $thumb = array())
{

    if (isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] == 0) {

        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = C('maxSize');// 设置附件上传大小
        $upload->exts = C('exts');// 设置附件上传类型
        $upload->rootPath = C('rootPath'); // 设置附件上传根目录
        $upload->savePath = $dirName . '/'; // 设置附件上传（子）目录
        // 上传文件
        $info = $upload->upload(array($imgName => $_FILES[$imgName]));


        if (!$info) {

            $res['status'] = 0;
            $res['error'] = $upload->getError();
            return $res;
        } else {
            $res['status'] = 1;
            $res['images'][0] = $info[$imgName]['savepath'] . $info[$imgName]['savename'];

            //是否生成缩略图
            if ($thumb) {
                $image = new\Think\Image();
                //循环生成缩略图
                foreach ($thumb as $k => $v) {

                    $image->open(C('rootPath') . $res['images'][0]);// 打开要处理的图片
                    $res['images'][$k + 1] = $info[$imgName]['savepath'] . 'thumb_' . $k . '_' . $info[$imgName]['savename'];
                    $image->thumb($v[0], $v[1])->save(C('rootPath') . $res['images'][$k + 1]);
                }
            }

            return $res;
        }

    }
}

