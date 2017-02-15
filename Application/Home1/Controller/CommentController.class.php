<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/22
 * Time: 19:46
 */
namespace Home\Controller;
use Think\Controller;

class CommentController extends BaseController {
    public function comment(){
        $this->display('Comment/comment');
    }


}