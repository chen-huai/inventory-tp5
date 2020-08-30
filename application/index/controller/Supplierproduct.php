<?php
namespace app\index\controller;


use think\Controller;
use think\Db;

class Supplierproduct extends Controller
{
    public function queryresult()
    {   
        //获取传参数据
        $queryData = input('get.');

        //判断是否传参
        if(!input('?get.')){
            $queryData['country'] ='';
            $queryData['supplierName'] ='';
            $queryData['productName'] ='';
            $queryData['productType'] ='';
            $queryData['productStyle'] ='';
            $queryData['verifyNo'] ='';
        }

        //获取下选列表
        $country = Db::query('SELECT DISTINCT country FROM supplier');
        $productType = Db::query('SELECT DISTINCT productType FROM supplierproduct');

        //获取Table数据
        $arr = Supplierproduct::getTableData($queryData);

        //将Table数据转为JSON格式 并存储
        file_put_contents('tabledata.json', json_encode($arr));

        //传参给当前页
        $this->assign([
            'originParam' => $queryData
            ,'country' => $country
            ,'productType' => $productType
        ]);

        //渲染页面
        return $this->fetch();
    }

    public function getQueryData()
    {
      if( input('?get.supplierName') || input('get.page') != 1) {

        $queryData = input('get.');

        if( !input('?get.supplierName') ){
            $queryData['country'] ='';
            $queryData['supplierName'] ='';
            $queryData['productName'] ='';
            $queryData['productType'] ='';
            $queryData['productStyle'] ='';
            $queryData['verifyNo'] ='';
        }

        return Supplierproduct::getTableData($queryData);
      }
        return json_decode(file_get_contents('tabledata.json'));
    }

    private function getTableData($queryData) {

        $count = Db::table('supplier')
        ->alias('s')
        ->join(['supplierproduct'=> 'p'], 's.id = p.supplierID')
        ->field('productID')
        ->where('country','LIKE',"%".$queryData['country']."%")
        ->where('supplierName','LIKE',"%".$queryData['supplierName']."%")
        ->where('productName','LIKE',"%".$queryData['productName']."%")
        ->where('productType','LIKE',"%".$queryData['productType']."%")
        ->where('productStyleNo','LIKE',"%".$queryData['productStyle']."%")
        ->where('verificationStatementNo','LIKE',"%".$queryData['verifyNo']."%")
        ->count();

        if (!isset($queryData['page'])) {
            $queryData['page'] = 1;
            $queryData['limit'] = 10;
        }

        if($count <= ($queryData['page'] - 1) * $queryData['limit']) {
            $queryData['page'] = 1;
        }

        $data = Db::table('supplier')
        ->alias('s')
        ->join(['supplierproduct'=> 'p'], 's.id = p.supplierID')
        ->field(['productID','supplierID','refproductid','supplierName','address','country','productName','productType','verifiedContentClaim','verifieStatus'])
        ->where('country','LIKE',"%".$queryData['country']."%")
        ->where('supplierName','LIKE',"%".$queryData['supplierName']."%")
        ->where('productName','LIKE',"%".$queryData['productName']."%")
        ->where('productType','LIKE',"%".$queryData['productType']."%")
        ->where('productStyleNo','LIKE',"%".$queryData['productStyle']."%")
        ->where('verificationStatementNo','LIKE',"%".$queryData['verifyNo']."%")
        ->limit(($queryData['page'] - 1) * 10, 10)
        ->select();

        $arr = array(
            'code' => 0,
            'msg' => '',
            'count' => $count,
            'data' => $data
        );

        return $arr;
    }

  /*  public function putSearchID()
    {
        $searchID = input('get.');

//        up为向上查询，down为向下查询

        $upData = Supplierproduct::upID(1);
//        return json($upData);
        $downData=Supplierproduct::downID(1,'','N');
//        return json($downData);


//        获取upLevel的主线关系
        $upLev=0;       //i变量通过循环比较赋值，取出最大的层
        $upMid="";    //mid 代表主线ID，通过循环获取最末层主线ID
        $upRid="";
        foreach ($upData as $d){
            if ($d[2]>$upLev) {
                $upMid=$d[0];
                $upRid=$d[1];
                $upLev=$d[2];
            }
        }
        $upLevel = Supplierproduct::upLevel($upData,$upLev,$upMid);

        for($i=0; $i<count($upData);$i++)
        {
            if($upData[$i][0]==$upMid && $upData[$i][1]==$upRid && $upData[$i][2]==$upLev)
            {
                $upData[$i][3]="Y";
            }
            foreach ($upLevel as $n){
                if ($n[0]==$upData[$i][0] && $n[1]==$upData[$i][1] && $n[2]==$upData[$i][2]) {
                    $upData[$i][3]=$n[3];
                }
            }
        }
        $dataLevel = array();
        foreach($upData as $u){
            $dataLevel[0][$u[2]][]=$u;
        }

//        return json($upData);

//      获取downLevel的主线关系
        $lev=0;       //i变量通过循环比较赋值，取出最大的层
        $mid="";    //mid 代表主线ID，通过循环获取最末层主线ID
        $rid="";
        foreach ($downData as $d){
            if ($d[2]>$lev) {
                $mid=$d[0];
                $rid=$d[1];
                $lev=$d[2];
            }
        }
        $downLevel = Supplierproduct::downLevel($downData,$lev,$rid);
//        后续添加最底层数据操作
        for($i=0; $i<count($downData);$i++)
        {
            if($downData[$i][0]==$mid && $downData[$i][1]==$rid && $downData[$i][2]==$lev)
            {
                $downData[$i][3]="Y";
            }
            foreach ($downLevel as $n){
                if ($n[0]==$downData[$i][0] && $n[1]==$downData[$i][1] && $n[2]==$downData[$i][2]) {
                    $downData[$i][3]=$n[3];
                }
            }
        }
        foreach($downData as $d){
            $dataLevel[1][$d[2]][]=$d;
        }
        echo '';
        dump($dataLevel);

    }

    public function upID($productID,$leavel=0)
    {
        static $arr = array();
        $leavel= $leavel+1;
        //通过传入的ID执行数据库查询
        $data= Db::table('supplierproduct')
            ->field(['refproductid','verifieStatus'])
            ->where(['productID' => $productID])
            ->select();

        foreach($data as $d){
            array_push($arr,array("$productID",$d['refproductid'],"$leavel",'N',$d['verifieStatus']));
            Supplierproduct::upID($d['refproductid'],$leavel);
        }
        return $arr;
    }
//    第5和id1传进来
    public function upLevel($data,$levelNum,$mid){
        static $upLevel = array();
        if($levelNum>0) {
            $level = $levelNum - 1;
            foreach ($data as $d) {
                if ($d[2] == $level) {
                    if ($d[1] == $mid) {
                        $d[3] = 'Y';
                        array_push($upLevel, $d);
                        Supplierproduct::upLevel($data, $level, $d[0]);
                    }
                }

            }
            return $upLevel;
        }
    }

    public function downID($productID,$refid,$verifieStatus,$leavel=0)
    {
        static  $arr = array();
        $leavel= $leavel+1;
        if(!empty($productID))
        {
            $leavelID =array("$productID","$refid","$leavel","N","$verifieStatus");
            array_push($arr,$leavelID);
        }
        //通过传入的ID执行数据库查询
        $data= Db::table('supplierproduct')
       ->field(['productID','refproductID','verifieStatus'])
       ->where(['refproductid' => $productID])
       ->select();
       foreach($data as $d){
           Supplierproduct::downID($d['productID'],$d['refproductID'],$d['verifieStatus'],$leavel);
       }
       return $arr;

    }
    public function downLevel($data,$levelNum,$rid){
        static $downLevel = array();
        if($levelNum>0)
        {
            $level = $levelNum - 1;
            foreach ($data as $d)
            {
                if($d[2]==$level)
                {
                    if($d[0]==$rid){
                        $d[3]='Y';
                        array_push($downLevel,$d);
                        Supplierproduct::downLevel($data,$level,$d[1]);
                    }
                }

            }
            return $downLevel;
        }
    }


    function test()
    {
        $data= Supplierproduct::searchID(7);
        
        return $data;
//         foreach ($data as $v){
//             return $v[1];
//         }
      //return json( Supplierproduct::get_childs(array(6)));
      
        
//         $a = array(
//             "one" => array(1,2,3,4),
//             "two" => array(5,6,7,8),
//             "three" => array('a','b','c','d')
//         );
//         foreach ($a as $k => $v) {
//             echo $k . '<br>';
//             print_r($v);
//             echo '<br>';
//             foreach ($a[$k] as $index => $value) {
//                 echo $k . '<br>';
//                 echo $index . '<br>';
//                 echo $value . '<br>';
//             }
//         }
    }
    
    function get_childs( $parent_id = array(), $level = 0 ){
        
        static  $id_arr = array();
        $id_arr= Db::name('supplierproduct')->where('productID','in',$parent_id)->column('refproductid');

        if (!empty($id_arr)) {
            $level++;
            $id_arr=array_merge($id_arr,Supplierproduct::get_childs($id_arr,$level));
        }
        return $id_arr;
        
        
//         foreach($arrCat as $key => $value)
//         {
            
//         }
    }
    
    //获取向上ID
//     public  function getParent( $pid ,$array=[]) {
        
//         static $level = 1;
//         $is_parent = Db::name( 'supplierproduct')->where(["refproductid"=>$pid])->find();
        
//         $array[] = $is_parent;
//         if ( $is_parent["reid"] ) {
//             $level++;
//             return $this->getParent( $is_parent['reid'],$array);
//         }
        
        
//         return $array;
        
//     }

//     public function getData()
//     {

//         //$searchData = input('post.');
//         //$searchId = input('post.id');
//         //$searchCountry = input('post.country');

// //         $supplierID = $_POST["supplierID"];
// //         $supplierName=$_POST["supplierName"];

// //          $data= Db::table('supplier')
// //         ->alias('s')
// //         ->join(['supplierproduct'=> 'p'], 's.id = p.supplierID')
// //         ->field(['productID','supplierID','refproductid','supplierName','address','country','productName','productType','verifiedContentClaim'])
// //         ->where([
// //             'supplierID' => $supplierID
// //         ])
// //         ->where('supplierName','LIKE',"%".$supplierName."%")
// //         ->select();

// //         $arr = array(
// //             'code' => 0,
// //             'msg' => '',
// //             'count' => count($data),
// //             'data' => $data
// //         );

// //         file_put_contents('tabledata.json', json_encode($arr));
// //         return $this->fetch('queryresult');

//         $data= Db::table('supplier')
//         ->alias('s')
//         ->join(['supplierproduct'=> 'p'], 's.id = p.supplierID')
//         ->field(['productID','supplierID','refproductid','supplierName','address','country','productName','productType','verifiedContentClaim'])
//         ->select();


//         $arr = array(
//             'code' => 0,
//             'msg' => '',
//             'count' => count($data),
//             'data' => $data
//         );

//         return $arr;

//     }


 */

}


