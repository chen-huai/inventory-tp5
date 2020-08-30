<?php
namespace app\index\controller;

use think\Controller;
use think\Db;
use think\Model;

class Index extends Controller
{
    public function index()
    {   
        $country = Db::query('SELECT DISTINCT country FROM supplier');
        $productType = Db::query('SELECT DISTINCT productType FROM supplierproduct');
     
        $this->assign([
            'country' => $country
            ,'productType' => $productType
        ]);

        return $this->fetch();
    }
//    public function getData()
//    {
//        $data = input('post.');
//        dump($data);
//        die;
//    }
//    public function getResult()
//    {
////        $data = UserModel::order('id','asc')->select();
//        $data = Db::name('r_supplierproduct')->order('id','asc')->select();
//        dump($data);
//        die;
//        return $this->fetch();
//    }
}
