<?php


namespace app\admin\controller;




use app\admin\controller\Base;
use think\Session;
class User extends Base
{

    public function index()
    {
        $power = Session::get('power');
        $this->assign('power', $power);
        return $this->fetch();
    }
}