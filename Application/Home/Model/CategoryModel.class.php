<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2017/1/17
 * Time: 10:35
 */
namespace Home\Model;
use Think\Model;

class CategoryModel extends Model{

    public function getTree(){
        $model = $this->select();
        return $this->tree($model,$pid=0);
    }

    public function tree($arr,$pid){
        $res = array();
        foreach ($arr as $k=>$v) {
            if($v['parent_id'] == $pid){
                $v['child'] = $this->tree($arr,$v['cat_id']);
                $res[] = $v;
            }

        }
        return $res;
    }



}