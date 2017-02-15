<?php



//注意，含有$this的不能放在function.php中，只能放在BaseController中
//因为$this不能存在于函数中，只能存在于类中
function salt()
{
    $str = 'ele@!$#$uw754%$&^%32';
    return substr(str_shuffle($str), 0, 8);
}

//发送邮件
//import('@.ORG.Mail');
//$res = sendMail('2277313121@qq.com','测试','what the bug!!!<a href="https://www.baidu.com">众里寻他千百度，蓦然回首，那人却在灯火阑珊处</a>');
function sendMail($to,$subject = "",$body = ""){

    //$to 表示收件人地址 $subject 表示邮件标题 $body表示邮件正文
    //error_reporting(E_ALL);
    error_reporting(E_STRICT);
    date_default_timezone_set("Asia/Shanghai");//设定时区东八区
    require_once('./Public/PHPMailer_v5.1/class.phpmailer.php');  //注意设置！！！
    include('./Public/PHPMailer_v5.1/class.smtp.php');
    $mail = new PHPMailer(); //new一个PHPMailer对象出来
    $body = eregi_replace("[\]",'',$body); //对邮件内容进行必要的过滤
    $mail->CharSet ="UTF-8";//设定邮件编码，默认ISO-8859-1，如果发中文此项必须设置，否则乱码
    $mail->IsSMTP(); // 设定使用SMTP服务
    $mail->SMTPDebug = 1; // 启用SMTP调试功能
    // 1 = errors and messages
    // 2 = messages only
    $mail->SMTPAuth = true; // 启用 SMTP 验证功能
    $mail->Host = "smtp.163.com"; // SMTP 服务器
    $mail->Port = 25;// SMTP服务器的端口号
    $mail->Username = "zwtchn"; // SMTP服务器用户名
    $mail->Password = "163smtp"; // SMTP服务器密码
    $mail->SetFrom('zwtchn@163.com', '发件人');
    $mail->AddReplyTo("zwtchn@163.com","收件人");
    $mail->Subject = $subject;
//    $mail->AltBody = "To view the message, please use an HTML compatible email viewer! - From www.jiucool.com"; // optional, comment out and test
    $mail->MsgHTML($body);
    $address = $to;
    $mail->AddAddress($address, "收件人");
    //$mail->AddAttachment("images/phpmailer.gif"); // attachment
    //$mail->AddAttachment("images/phpmailer_mini.gif"); // attachment
    if(!$mail->Send()) {
        echo "Mailer Error: " . $mail->ErrorInfo;
        return false;
    } else {
        echo "Message sent!恭喜，邮件发送成功！";
        return true;
    }
}




//function sendMail($to, $title, $content)
//{
//    require_once('./Public/PHPMailer_v5.1/class.phpmailer.php');
//    $mail = new PHPMailer();
//    $mail->SMTPDebug = true;
//    // 设置为要发邮件
//    $mail->IsSMTP();
//    // 是否允许发送HTML代码做为邮件的内容
//    $mail->IsHTML(TRUE);
//    // 是否需要身份验证
//    $mail->SMTPAuth=TRUE;
////    $mail->CharSet='UTF-8';
//
//    $mail->CharSet = "GB2312"; // 字符设置
//    $mail->Encoding = "base64"; //编码方式
//    /*  邮件服务器上的账号是什么 */
//    $mail->From=C('MAIL_ADDRESS');
//    $mail->FromName=C('MAIL_FROM');
//    $mail->Host=C('MAIL_SMTP');
//    $mail->Username=C('MAIL_LOGINNAME');
//    $mail->Password=C('MAIL_PASSWORD');
//
//    // 发邮件端口号默认25
//    $mail->Port = 25; //645
//    // 收件人
//    $mail->AddAddress($to);
//    // 邮件标题
//    $mail->Subject=$title;
//    // 邮件内容
//    $mail->Body=$content;
//    return($mail->Send());
//}


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
//$res = uploadOne('logo', 'Brand', array(
//    array(600, 600),
//    array(300, 300),
//    array(100, 100),
//));
//返回值：
//if ($res['status'] == 1) {
//    $data['logo'] = $res['images'][0];
//    $data['thumb_logo1'] = $res['images'][1];
//    $data['thumb_logo2'] = $res['images'][2];
//    $data['thumb_logo3'] = $res['images'][3];
//} else {
//    $this->error("图片添加失败", U('Brand/brandAdd'), 1);
//}
//出错可能是因为.html文件中是name=img[]数组，而不是name=img


function uploadOne($imgName, $dirName, $thumb = array())
{
    // 上传LOGO

    if (isset($_FILES[$imgName]) && $_FILES[$imgName]['error'] == 0) {

        $rootPath = './Uploads/'; // 设置附件上传根目录
        $upload = new \Think\Upload();// 实例化上传类
        $upload->maxSize = 3145728;// 设置附件上传大小
        $upload->exts = array('jpg', 'gif', 'png', 'jpeg');// 设置附件上传类型
        //$upload->rootPath = './Uploads/'; // 设置附件上传根目录
        $upload->savePath = $dirName . '/'; // 设置附件上传（子）目录
        //$upload->saveName = array('date','Y-m-d');         // 采用时间戳命名
        $upload->saveName = 'time';
        $upload->autoSub = false;            // 关闭子目录保存，否则会有一个以日期命名的子目录


        // 上传文件
        // 上传时指定一个要上传的图片的名称，否则会把表单中所有的图片都处理，之后再想其他图片时就再找不到图片了
        $info = $upload->upload(array($imgName => $_FILES[$imgName]));
        if (!$info) {
            return array(
                'status' => 0,
                'error' => ($upload->getError()),
            );
        } else {
            $res['status'] = 1;
            $res['images'][0] = $logoName = $rootPath . $info[$imgName]['savepath'] . $info[$imgName]['savename'];
            // 判断是否生成缩略图
            if ($thumb) {
                $image = new \Think\Image();
                // 循环生成缩略图
                foreach ($thumb as $k => $v) {
                    $res['images'][$k + 1] = $rootPath . $info[$imgName]['savepath'] . 'thumb_' . $k . '_' . $info[$imgName]['savename'];
                    // 打开要处理的图片
                    $image->open( $logoName);
                    $image->thumb($v[0], $v[1])->save($res['images'][$k + 1]);
                }
            }
            return $res;
        }
    }


}

