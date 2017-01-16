<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/27
 * Time: 11:31
 */
namespace Admin\Controller;
use Think\Controller;

class RoleController extends BaseController
{

    public function roleIndex()
    {
        $roleList = M('role')->field("a.*,GROUP_CONCAT(c.auth_name) auth_name")->alias('a')
            ->JOIN('LEFT JOIN `cz_role_auth` b ON a.role_id = b.role_id LEFT JOIN `cz_auth` c ON b.auth_id = c.auth_id')->group("a.role_id") ->select();


        $this->assign('roleList',$roleList);
        $this->display('Role/role_index');
    }

    public function roleAdd()
    {
        if (IS_POST) {

            $data['role_name'] = I('role_name');
            $roleModel= D('role');
            if($roleModel->create($data)){
                if($roleId = $roleModel->add($data)){
                    //添加关联数据到关联表
                    $auths = I('auths');

                    if($auths){
                        $roleAuth = M('role_auth');

                        foreach ($auths as $k=>$v){
//                            $roleAuth->add( array(
//                                    'role_id'=> $roleId,
//                                    'auth_id'=>$v,
//
//                                )
//                            );
                            $data1['role_id'] = $roleId;
                            $data1['auth_id'] = $v;
                            $roleAuth->add($data1);
                           //发现数据怎么都加不进去，原来是role_auth表没有设置主键自增

                        }
                    }

                    $this->success('添加角色成功',U('Role/roleIndex'),1);

                }else{
                    $this->success('添加角色失败',U('Role/roleAdd'),1);
                }

            }else{
                $this->error($roleModel->getError(),U('Role/roleAdd'),1);
            }
            return;
        }
        $authList = D('auth')->getTree();
        $this->assign('authList',$authList);

        $this->display('Role/role_add');
    }

    public function roleEdit()
    {
        $id = I('id');
        if (IS_POST) {
            $data['role_name'] = I('role_name');
            $data['role_id'] = $id;
            $roleModel = D('role');
            if( $roleModel->create($data) === FALSE ){
                $this->error($roleModel->getError(),U('Role/roleIndex'),1);
            }else{
                if($roleModel->save($data) !== FALSE){
                    //先删除原来的role_auth关联，再把新的关联写入
                    $raModel = M('role_auth');
                    $raModel->where("role_id = $id")->delete();
                    $authPost = I('auths');//不能用auths[]
                    foreach ($authPost as $k=>$v){
                        $raModel->add(array(
                                "role_id" => $id,
                                "auth_id" => $v,
                        )
                        );
                    }
                    $this->success("修改角色成功",U('Role/roleIndex'),1);
                }else{
                    $this->error('修改角色失败',U('Role/roleIndex'),1);
                }

            }
            return;

        }
        $role = M('role')->find($id);

        $this->assign('role',$role);
        $auths = M('role_auth')->field('GROUP_CONCAT(auth_id) auth_id')->WHERE("role_id = $id")->find();//find返回二维数组，select返回一维数组
        $this->assign('auths',$auths);

        $authList = D('auth')->getTree();
        $this->assign('authList',$authList);
        $this->display('Role/role_edit');
    }


    public function roleDelete()
    {
        $id = I('id');
        $condition['role_id']=$id;
        $cnt = M('admin_role')->where($condition)->count();
        if($cnt >0){
            $this->error("该角色下有管理员，不能删除",U('Role/roleIndex'),1);
        }else{
            //先删除关联表，再删除role
            $raModel = M('role_auth');
            $condition['role_id'] =$id;
            $raModel->where($condition)->delete();
            M('role')->delete($id);
            if( M('role')->delete($id) === FALSE){
                $this->error("删除失败",U('Role/roleIndex'),1);
            }else{
                $this->success("删除成功",U('Role/roleIndex'),1);
            }

        }


    }

}