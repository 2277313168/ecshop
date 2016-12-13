<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/2
 * Time: 10:37
 */

namespace Admin\Model;

use Think\Model;

class CategoryModel extends Model
{

    protected $_validate = array(
        array('cat_name','require','分类名称不能为空！'), //默认情况下用正则进行验证
    );

    public function catTree(){
        $cat = $this->select();
        return $this->tree($cat);
    }

    public function tree($arr,$pid=0,$level=0){
        static  $res = array();
        foreach($arr as $v){
            if($v['parent_id'] == $pid){
                $v['level'] = $level;
                $res[] = $v;
                $this->tree($arr,$v['cat_id'],$level+1);
            }
        }
        return $res;
    }


    public function getSubIds($id){
        $res = array();
        $catList = $this->select();
        $tree = $this->tree($catList,$id);
        $res[] = $id;
         foreach($tree as $v){
            $res[] = $v['cat_id'];
        }
        return $res;
    }


}