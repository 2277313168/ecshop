<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/1/17
 * Time: 11:02
 */
return array(
    //'配置项'=>'配置值'
    //一直等待localhost响应，说明文件没有配置好
    'DB_TYPE' => 'mysql',     // 数据库类型
    'DB_HOST' => 'localhost', // 服务器地址
    'DB_NAME' => 'shopcz',          // 数据库名
    'DB_USER' => 'root',      // 用户名
    'DB_PWD' => '110',          // 密码
    'DB_PORT' => '3306',        // 端口    !!!!!!!!!!!
    'DB_PREFIX' => 'cz_',    // 数据库表前缀
//    'DB_FIELDTYPE_CHECK'    =>  false,       // 是否进行字段类型检查 3.2.3版本废弃
//    'DB_FIELDS_CACHE'       =>  true,        // 启用字段缓存
//    'DB_CHARSET'            =>  'utf8',      // 数据库编码默认采用utf8

    'SALT' => 'DSG@#$#%$!)&',

    //================文件上传相关设置=================
    'maxSize' => 3145728,
    'exts' => array('jpg', 'gif', 'png', 'jpeg'),
    'rootPath' => "./Uploads/",
    'savePath' => './',
    //==============修改I函数底层过滤使用的函数==============
    'DEFAULT_FILTER' => 'trim,removeXSS',

    //======================静态缓存===================
    'HTML_CACHE_ON' => true, // 开启静态缓存
    'HTML_CACHE_TIME' => 60,   // 全局静态缓存有效期（秒）
    'HTML_FILE_SUFFIX' => '.html', // 设置静态缓存文件后缀

    //可以为每个页面单独配置
    'HTML_CACHE_RULES' => array(  // 定义静态缓存规则
        // 定义格式1 数组方式
        'Index:index' => array('index', '3600'),

      //======================发送邮件相关配置=============
//        'MAIL_ADDRESS' => 'zhangwtchn@163.com',   // 发货人的email
//        'MAIL_FROM' => 'sunflower',      // 发货人姓名
//        'MAIL_SMTP' => 'smtp.163.com',      // 邮件服务器的地址
//        'MAIL_LOGINNAME' => 'zhangwtchn',       //邮件账号
//        'MAIL_PASSWORD' => '163smtp',      //邮件密码

    )


);