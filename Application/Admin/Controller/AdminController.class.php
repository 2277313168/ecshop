<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/27
 * Time: 11:41
 */

namespace Admin\Controller;

use Think\Controller;

class AdminController extends BaseController
{

    public function adminIndex()
    {

        //SELECT a.admin_id,a.admin_name,GROUP_CONCAT(c.role_name) role_name FROM `cz_admin` a LEFT JOIN `cz_admin_role` b ON a.admin_id = b.admin_id LEFT JOIN `cz_role` c ON b.role_id=c.role_id GROUP BY a.admin_id

        $adminList = M('admin')->alias('a')->FIELD('a.*,GROUP_CONCAT(c.role_name) role_name')
            ->JOIN('LEFT JOIN `cz_admin_role` b ON a.admin_id = b.admin_id LEFT JOIN `cz_role` c ON b.role_id=c.role_id')
            ->GROUP('a.admin_id')->select();
        //var_dump($adminList);die;
        $this->assign('adminList', $adminList);

        $this->assign('admin', session('admin'));
        $this->display('Admin/admin_index');


    }

    public function adminAdd()
    {
        if (IS_POST) {
            $data['admin_name'] = I('admin_name');
            $data['password'] = I('psw');
            $data['repsw'] = I('repsw');
            $data['add_time'] = strtotime(date('y-m-d h:i:s', time()));
            //$data['add_time'] = time();
            $data['is_use'] = I('is_use');

            $adminModel = D('admin');

            if (($adminModel->create($data)) === FALSE) {
                $this->error($adminModel->getError(), U('admin/adminAdd'), 1);
            }
            //密码加盐
            $data['password'] = md5(I('psw') . C('SALT'));

            unset($data['repsw']);

            //超级管理员一定是启用的
            if (($adminModel->create($data)) === 1) {
                $data['is_use'] = 1;
            }

            $adminId = $adminModel->add($data);

            if ($adminId === FALSE) {
                $this->error("添加失败", U('admin/adminAdd'), 1);
            } else {
                //添加关联表
                $roles = I('roleIds');
                $arModel = M('admin_role');
                foreach ($roles as $k => $v) {
                    $data1['admin_id'] = $adminId;
                    $data1['role_id'] = $v;
                    $arModel->add($data1);
                }
                $this->success("添加成功", U("admin/adminIndex"), 1);
            }
            return;

        }
        $roleList = M('role')->select();
        $this->assign('roleList', $roleList);
        $this->display('Admin/admin_add');
    }

    public function adminEdit()
    {
        $data['admin_id'] = I('id');
        //普通管理员只能修改自己的信息
        $adminS = session('admin');

        if (($adminS['admin_id'] > 1) && (I('id') != $adminS['admin_id'])) {
            $this->error("抱歉，您没有修改权限", U('Admin/adminIndex'), 1);
        }

        if (IS_POST) {

            $data['admin_name'] = I('admin_name');
            $data['password'] = I('psw');
            $data['repsw'] = I('repsw');
            $data['add_time'] = strtotime(date('y-m-d h:i:s', time()));
            $data['is_use'] = I('is_use');

            $adminModel = D('admin');

            if (empty($data['password'])) {//密码为空，代表不修改
                unset($data['password']);
            }


            if ($adminModel->create($data) === FALSE) {
                $this->error($adminModel->getError(), U('Admin/adminIndex'), 1);
            }
            unset($data['repsw']);

            if (isset($data['password'])) {
                $data['password'] = md5(I('psw') . C('SALT'));
            }

            //超级管理员一定是启用的
            if (I('id') == 1) {
                $data['is_use'] = 1;
            }

            if ($adminModel->save($data) === FALSE) {
                $this->error('修改失败', U('Admin/adminIndex'), 1);
            } else {
                //修改关联表，删除原来的关联关系，添加现在的关联关系
                $armodel = M('admin_role');
                $roles = I('roleIds');
                $condition1['admin_id'] = I('id');
                $armodel->where($condition1)->delete();

                foreach ($roles as $k => $v) {
                    $data2['admin_id'] = I('id');
                    $data2['role_id'] = $v;
                    $armodel->add($data2);
                }

                $this->success('修改成功', U('Admin/adminIndex'), 1);
            }
            return;
        }
        $condition['a.admin_id'] = I('id');
        $admin = M('admin')->alias('a')->FIELD('a.*,GROUP_CONCAT(c.role_id) role_ids')
            ->JOIN('LEFT JOIN `cz_admin_role` b ON a.admin_id = b.admin_id LEFT JOIN `cz_role` c ON b.role_id=c.role_id')
            ->GROUP('a.admin_id')->where($condition)->find();

        $this->assign('admin', $admin);

//        var_dump(I('id'));
//        var_dump($admin);
//        die;
        $roleList = M('role')->select();
        $this->assign('roleList', $roleList);
        $this->display('Admin/admin_edit');
    }


    public function adminDelete()
    {
        $id = I('id');
        $arModel = M('admin_role');
        $condition['admin_id'] = $id;
        $arModel->where($condition)->delete();

        if (M('admin')->delete($id) === FALSE) {
            $this->error('删除失败', U('Admin/adminIndex'), 1);
        } else {
            $this->success('删除成功', U('Admin/adminIndex'), 1);
        }

    }


    public function ajaxIsUse()
    {
        $adminId = I('id');
        $admin = M('admin')->find($adminId);
        //echo $adminId;//不能用 return

        if ($adminId == 1) {
            $this->ajaxReturn(2);
        } else if ($admin['is_use'] == 0) {
            $admin['is_use'] = 1;
            M('admin')->save($admin);
            $this->ajaxReturn(0);
        } else {
            $admin['is_use'] = 0;
            M('admin')->save($admin);
            $this->ajaxReturn(1);
        }


    }

}