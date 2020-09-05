<?php


namespace app\admin\controller;




use app\admin\controller\Base;
use think\Session;
use think\Image;

class User extends Base
{

    public function index()
    {
        $power = Session::get('power');
        $this->assign('power', $power);
        return $this->fetch();
    }
    function scerweima($url='你好'){
        Vendor('phpqrcode.phpqrcode');
        $qrcode = new \QRcode();
        $value = $url;         //二维码内容
        $errorCorrectionLevel = 'L';  //容错级别
        $matrixPointSize = 5;      //生成图片大小
        //生成二维码图片
        $filename = 'public/erweima/'.microtime().'.png';
        $qrcode->png($value,$filename , $errorCorrectionLevel, $matrixPointSize, 2);
        $QR = $filename;        //已经生成的原始二维码图片文件
        $QR = imagecreatefromstring(file_get_contents($QR));
        //输出图片
        imagepng($QR, 'qrcode.png');
        imagedestroy($QR);
        return '<img src="qrcode.png" alt="使用微信扫描支付">';
    }

}