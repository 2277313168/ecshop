<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/2/21
 * Time: 10:22
 */
namespace Home\Model;
use Think\Model;

class CommentModel extends Model{

    protected $_validate = array(
        array('content','require','评论内容不能为空！'), //默认情况下用正则进行验证

    );


}