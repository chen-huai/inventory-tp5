<?php
/**
 * User: Frank
 * Date: 2020/02/10
 */
namespace app\admin\controller;
use think\Controller;
use app\admin\modle\Permissions;
use app\admin\modle\User;
use app\admin\modle\UserPermissionsRelationship;
use app\validate\User as loginVi;
use think\Db;


class Index extends Controller
{
    public function index()
    {
        return $this->fetch();
    }
    public function userData()
    {
        $user = new User();
        $user->save([
            'username' => '李白',
            'password' => '123456',

        ]);
    }
    public function permissionsData()
    {
        $user = new Permissions();
        $user->save([
            'permissionsName'=> '管理员',
        ]);
    }
    public function userPermissionsRelationship()
    {
        $user = new UserPermissionsRelationship();
        $user->save([
            'user_id'=> '1',
            'permissions_id'=> '3',
        ]);
    }
    public function search()
    {
//        $res = Db::table('inventory_user')
//            ->select();
//        return json($res);
        return json(User::select());
        return json(User::select(2)->UserPermissionsRelationship);
    }
    public function searchMany()
    {
//       return json(User::find(1)->permissions);
//       return json(User::find(1)->permissions()->select());


        $user = User::find(2);
        $role = $user -> permissions;
        return json($role);
//        $user = User::alias('u')->field(['username','password'])->select();
//        return json($user);
//        return json(User::count());

    }
    public function verify()
    {
        $user = array(
            'username' => '',
            'password' => '123456',
        );
        try {
            validate(loginVi::class)->batch(true)->check(
                $user
            );
        } catch (ValidateException $e) {
            dump($e->getError());
        }
    }
    public function sessionTest()
    {
        $res = session('power');
        if($res){
            foreach ($res as $r){
                dump($r['permissionsName']);
            };
        }else{
            return json('session已清空');
        }
}
}