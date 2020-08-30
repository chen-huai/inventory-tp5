<?php
/**
 * User: Frank
 * Date: 2020/02/10
 */

namespace app\admin\controller;

use think\Controller;


class Base extends Controller
{
    public function _initialize()
    {
         if (!session('username')) {
             $this->error('请先登录系统', 'Index/login');
         }
    }
}