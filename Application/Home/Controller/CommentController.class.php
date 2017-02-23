<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/2/20
 * Time: 20:36
 */
namespace Home\Controller;
use Think\Controller;

class CommentController extends HomeBaseController {

    public function ajaxAddComment(){
        if(IS_POST){
            $data['goods_id'] = I('goods_id');
            $data['user_id'] = session('user_id');
            $data['content'] = I('content');
            $data['star'] = I('star');
           // $data['pubtime'] = date('Y-m-d H:i');
            $data['pubtime'] = time();

            //处理印象表
            $yx = I('yx');
            $yx = str_replace('，', ',', $yx );
            $arr = explode(',',$yx);

            $yxModel = M('impression') ;
            foreach($arr as $k=>$v){
                if(!empty($v)){
                    $where['title'] = $v ;
                    $where['goods_id'] = $data['goods_id'] ;
                   $impression = $yxModel->field('count')->where($where)->find();
                    if( $impression == FALSE){
                        $yxData['goods_id'] =  $data['goods_id'];
                        $yxData['title'] = $v;
                        $yxData['count'] = 1;
                        $yxModel->add($yxData);

                    }else{
                        //$impression['count'] = 2;
                        //只有上面这一句是不行的，因为只修改了数据，没有把数据重新添加到数据库
                        $yxModel->field('count')->where($where)->setInc('count');
                    }
                }
            }





            //处理评论表
            $commentModel = D('comment');
            if($commentModel->create($data)){
                if($commentModel->add($data)){
                    //取出用户姓名、头像，并返回
                    $user = M('user')->field('user_name,user_img')->find($data['user_id']);
                    $res['user_name'] = $user['user_name'];
                    if(empty($user['user_img'])){
                        $res['user_img'] = '.\Uploads\UserImg\defaultUserImg.jpg';
                    }else{
                        $res['user_img'] = $user['user_img'];
                    }
                    //取出评论内容
                    $res['content'] = $data['content'];
                    $res['pubtime'] = date('Y-m-d H:i',$data['pubtime']) ;
                    $res['star'] = $data['star'] ;
                    $res['ok'] = 1;


                    echo json_encode($res);
                    return;
                }
            }else{
                $res['ok'] = 0;
                $res['error'] = $commentModel->getError() ;
                echo json_encode($res);
            }

        }

    }



    public function ajaxGetComment(){
        $goodsId = I('id');
        $page = I('page');
        $perpage = 5;
        $offset = $perpage*($page - 1);

        $where['goods_id'] = $goodsId;

        //SELECT a.*,b.user_name,b.user_img,COUNT(c.reply_id) FROM `cz_comment` a LEFT JOIN `cz_user` b ON a.user_id=b.user_id
        // LEFT JOIN `cz_comment_reply` c ON a.comment_id = c.comment_id GROUP BY a.comment_id ORDER BY a.comment_id DESC

        $res = M('comment')->alias('a')->field('a.*,b.user_name,b.user_img,COUNT(c.reply_id) reply_cnt')
            ->JOIN('LEFT JOIN `cz_user` b ON a.user_id=b.user_id LEFT JOIN `cz_comment_reply` c ON a.comment_id = c.comment_id')
            ->GROUP(' a.comment_id')->where($where)->limit("$offset,$perpage")->order('a.comment_id DESC')->select();
        //注意where($where)不加双引号，limit("$offset,$perpage")要加双引号

        foreach ($res as $k=>$v){
            if(empty($v['user_img'])){
                //不能用$v['user_img'] = './Uploads/UserImg/defaultUserImg.jpg'
                $res[$k]['user_img'] = './Uploads/UserImg/defaultUserImg.jpg'  ;
            }
        }

        echo json_encode($res);

    }
}