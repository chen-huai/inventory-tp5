<?php
namespace app\admin\controller;
use think\Controller;
use app\admin\controller\Base;
use app\admin\model\Users as UserModel;
use app\admin\validate\Users as UserValidate;

class Users extends Base
{
    // public function index()
    // {
    //     return $this->fetch();
    // }

    //用户管理页面
    public function userlist()
    {
        return $this->fetch();
    }
    
    //用户列表数据
    public function userListData()
    {   
        $listData = input('get.');
        $count = count(UserModel::order('id')->select());

        $data = UserModel::order('id','asc')
            ->limit(($listData['page'] - 1) * $listData['limit'], $listData['limit'])
            ->select();
        // $count = count($data);
        $arr = array(
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data' => $data
        );
        return $arr;
    }

    /*
     *新增、修改管理员的弹出窗口
     */
    public function user_operate()
    {
        $opFlag = 'edit';

        if(!input('?get.userID')) {
            $opFlag = 'add';
            $this->assign('opFlag', $opFlag);
            return $this->fetch();
        }
        // TODO: Why not?
        // $user = new UserModel();
        // // 查询单个数据
        // $user->where('id', '$id')
        //     ->find();
  
        $userID = input('get.userID');
        $user = UserModel::get($userID);
        $this->assign([
            'opFlag' => $opFlag
            ,'user' => $user
        ]);

        return $this->fetch();
    }

    /*
     *新增、修改管理员的方法
     */
    public function operate()
    {
        $data = input('post.');
        // dump($data);
        // die;
        $data['password'] = md5($data['password']);
        $data['repassword'] = md5($data['repassword']);
        $val = new UserValidate();
        $arr = array(
            'flag' => 0
            ,'msg' => ''
        );

        // $inputData = array(
        //     'id' => $data['id']
        //     ,'username' => $data['username']
        // );

        //验证是否符合规则  
        if (!$val->check($data)) {
            $arr['msg'] = $val->getError();
            return json_encode($arr);
        } 

        if($data['opFlag'] == 'add') {
            $user = new UserModel($data);
            $res = $user->allowField(true)->save();

            if ($res) {
                $arr['flag'] = $res;
                $arr['msg'] = '新增客户成功';
            } else {
                $arr['msg'] = '新增客户失败';
            }

        } else {
            $user = new UserModel();
            //$data的属性命名要与user表的列名相同
            $res = $user->allowField(true)->save($data, ['id' => $data['id']]);

            if ($res) {
                $arr['flag'] = $res;
                $arr['msg'] = '更新客户成功';
            } else {
                $arr['msg'] = '用户信息未更新';
            };
            
            
        }

        return json_encode($arr);
    }

    /*
     * 删除管理员的方法
     * */
    public function delete(){

        $id = input('get.id');

        //TODO: 未实现软删除
        $res = UserModel::destroy($id, true);

        return $res;

    }

    /*
     * 新增管理员的方法
     * */
    /*public function insert()
    {
        $data = input('post.');
        $val = new UserValidate();

        // //验证是否为空
        // if ( $data['userID'] == '' ) {
        //     $this->error('用户ID不能为空');
        //     return $this;

        // }

        // if ( $data['username'] == '' ) {
        //     $this->error('用户名不能为空');
        //     return $this;
        // }

        //验证是否符合规则  
        if (!$val->check($data)) {
            $this->error($val->getError());
            return $this;
        }        

        $user = new UserModel($data);
        $res = $user->allowField(true)->save();
        
        if ($res) {
            $this->success('新增客户成功');
        } else {
            $this->error('新增客户失败');
        }

        return $this;

    }*/

    //提交用户信息更新
    /*public function update()
    {
        $data = input('post.');
        $id = input('post.id');
        $val = new UserValidate();
        if (!$val->check($data)) {
            $this->error($val->getError());
            exit();
        }
        $user = new UserModel();
        $ret = $user->allowField(true)->save($data, ['id' => $id]);
        if ($ret) {
            $this->success('修改客户信息成功', 'Users/userlist');
        } else {
            $this->error('修改客户信息失败');
        }
    }*/

    //删除用户信息
 /*   public function delete()
    {
        //实现软删除的方法

        $id = input('get.id');
        $ret = UserModel::destroy($id);
        if ($ret) {
            $this->success('删除客户成功', 'Users/userlist');
        } else {
            $this->error('删除客户失败');
        }*/

        //实现真实删除的方法
        /*
        $id = input('get.id');
        $ret = UserModel::destroy($id, true);
        if ($ret) {
            $this->success('删除用户成功', 'User/userlist');
        } else {
            $this->error('删除用户失败');
        }
    }*/



    
}