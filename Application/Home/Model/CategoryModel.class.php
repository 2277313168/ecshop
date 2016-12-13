<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/8
 * Time: 11:37
 */

namespace Home\Model;
use Think\Model;

class CategoryModel extends Model{

    public function treeArray($arr,$pid){
        $res = array();
        foreach ($arr as $v){
            if($v['parent_id'] == $pid){
                $v['child'] = $this->treeArray($arr,$v['cat_id']);
                $res[] = $v;
            }
        }
        return $res;
    }

    public function catTreeArray(){
        $catList = $this->select();
        return $this->treeArray($catList,$pid=0);
    }


    public function getParents($cat_id){
        $res = array();
        while($cat_id){
            $cat = $this->find($cat_id);
            $res[]=array(
                'cat_id'=>$cat['cat_id'],
                'cat_name' => $cat['cat_name']
            );
            $cat_id = $cat['parent_id'];
        }

        return array_reverse($res);
    }


}