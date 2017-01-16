<?php
/**
 * Created by PhpStorm.
 * User: zwt
 * Date: 2016/12/27
 * Time: 11:25
 */
namespace Admin\Controller;

use Think\Controller;

class AuthController extends BaseController
{

    public function authIndex()
    {
        $auth = D('auth')->getTree();
        $this->assign('authList', $auth);

        $this->display('Auth/auth_index');
    }

    public function authAdd()
    {
        if (IS_POST) {
            $data['auth_name'] = I('auth_name');
            $data['auth_pid'] = I('auth_pid');
            $data['module_name'] = I('module_name');
            $data['controller_name'] = I('controller_name');
            $data['action_name'] = I('action_name');

            $auth = D('auth');

            if($auth->create() ===FALSE ){
                $this->error($auth->getError(), U('Auth/authAdd'), 1);
            }else{
                if ($auth->add($data) !== FALSE) {
                    $this->success("添加成功", U('Auth/authIndex'), 1);
                } else {
                    $this->error('添加失败', U('Auth/authAdd'), 1);
                }
            }

            return;
        }

        $authList = D('auth')->getTree();
        $this->assign('authList', $authList);

        $this->display('Auth/auth_add');
    }

    public function authEdit()
    {
        $data['auth_id'] = I('id');
        if (IS_POST) {

            $data['auth_name'] = I('auth_name');
            $data['auth_pid'] = I('auth_pid');
            $data['module_name'] = I('module_name');
            $data['controller_name'] = I('controller_name');
            $data['action_name'] = I('action_name');


            $auth = D('auth');
            if ($auth ->create()) {

                if ( (M('auth')->save($data) ) !== FALSE) {
                    $this->success("修改成功", U('Auth/authIndex'), 1);
                } else {
                    $this->error('修改失败', U('Auth/authEdit'), 1);
                }
            } else {
                $this->error($auth->getError(), U('Auth/authIndex'), 1);
            }
            return;
        }


        $auth = M('auth')->find(I('id'));
        $this->assign('auth', $auth);

        $authList = D('auth')->getTree();
        $this->assign('authList', $authList);

        $this->display('Auth/auth_edit');
    }


    public function authDelete()
    {
        $id = I('id');
        if (M('auth')->delete($id)) {
            $this->success('删除成功', U('Auth/authIndex'), 1);
        } else {
            $this->error('删除失败', U('Auth/authIndex'), 1);
        }
        return;

    }


}