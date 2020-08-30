<?php


namespace app\admin\controller;



use think\App;
use think\Controller;
use think\exception\HttpResponseException;
use think\Session;


class Base extends Controller
{
    public function _initialize()
    {
        if (!session('username')) {
            $this->error('请先登录系统', 'login/login');
        }else {
            $menu = session('menu');
            $this->assign('menu', $menu);
        }
    }

}