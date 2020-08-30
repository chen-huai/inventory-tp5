<?php
namespace app\index\controller;


use think\Controller;
use think\Db;

class Supplierproduct2 extends Controller
{
    public function index()
    {
        return $this->fetch();
    }

    public function queryresult()
    {   
        $queryData = input('get.');

        $data = Db::table('supplier')
        ->alias('s')
        ->join(['supplierproduct'=> 'p'], 's.id = p.supplierID')
        ->field(['productID','supplierID','refproductid','supplierName','address','country','productName','productType','verifiedContentClaim'])
//         ->where([
//             'supplierName' => $queryData['supplierName']
//         ])
        ->where('supplierName','LIKE',"%".$queryData['supplierName']."%") 
        ->select();

        $arr = array(
            'code' => 0,
            'msg' => '',
            'count' => count($data),
            'data' => $data
        );

        file_put_contents('tabledata.json', json_encode($arr));

        $param = input('get.');
        $this->assign('originParam', $param);
        return $this->fetch();
    }

    public function getQueryData() 
    {
      if(input('?get.supplierName')) {

        $queryData = input('get.');

        $data = Db::table('supplier')
        ->alias('s')
        ->join(['supplierproduct'=> 'p'], 's.id = p.supplierID')
        ->field(['productID','supplierID','refproductid','supplierName','address','country','productName','productType','verifiedContentClaim'])
    //         ->where([
    //             'supplierName' => $queryData['supplierName']
    //         ])
        ->where('supplierName','LIKE',"%".$queryData['supplierName']."%")
        ->select();

        $arr = array(
            'code' => 0,
            'msg' => '',
            'count' => count($data),
            'data' => $data
        );

        return $arr;

      } 
        return json_decode(file_get_contents('tabledata.json'));
        
    }


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

    public function putSearchID()
    {
        //return json(Supplierproduct::searchID(7))   ;
        //return json(Supplierproduct::getID(1))   ;
        $childID= json(Supplierproduct2::searchID(6))   ;
//        $childID= json(Supplierproduct2::getID(7))   ;
        return $childID;
//        $parentID= json(Supplierproduct::getID(7))   ;
//        return array_combine($childID,$parentID) ;
//        print_r( array($childID,$parentID));

    }

    public function searchID($productID,$leavel=0)
    {
        static  $id_arr = array();
        $leavel= $leavel+1;
        //通过传入的ID执行数据库查询
        $data= Db::table('supplierproduct')
       ->field(['refproductid'])
       ->where(['productID' => $productID])
       ->select();

       foreach($data as $d){
           array_push($id_arr,array("$productID",$d['refproductid'],"$leavel",'N'));
           Supplierproduct2::searchID($d['refproductid'],$leavel);
       }
       
       return $id_arr;

    }
    public function getID($refproductid,$leavel=0)
    {
        static $arr= array();
        //通过传入的ID执行数据库查询
        $data= Db::table('supplierproduct')
       ->field(['productID','refproductID'])
       ->where(['refproductid' => $refproductid])
       ->select();
       $leavel= $leavel+1;
       $leavelID = array();
       foreach($data as $d){
           if(!empty($d['productID']))
           {
               $leavelID =array($d['productID'],$d['refproductID'],$leavel,'N');
               array_push($arr,$leavelID);
           }
           Supplierproduct2::getID($d['productID'],$leavel);
       }
       return $arr;
    }
  
    
    function test()
    {
 
        $data=  Supplierproduct2::searchID(7);       
       
        $i=0;       //i变量通过循环比较赋值，取出最大的层
        $mid="";    //mid 代表主线ID，通过循环获取最末层主线ID
        foreach ($data as $d){
            if ($d[1]>$i) {
                $i=$d[1];
                $mid=$d[0];   
            }            
        }
        return $i;

    }
    
    function get_childs( $productID = array(), $level = 0 ){
        
        static  $id_arr = array();
        $id_arr= Db::table('supplierproduct')
                ->field(['refproductid'])
                ->where(['productID' => $productID])
                ->select();

        if (!empty($id_arr)) {
            $level++;
            $id_arr=array_merge($id_arr,Supplierproduct2::get_childs($id_arr,$level));
        }
        return $id_arr;
        
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

//    数据库查询
    public function getLevel($data,$levelNum,$mid){
        static $newData=array();
        if($levelNum>0)
        {
            $level=$levelNum-1;
            foreach ($data as $d)
            {
                if ($d[2]=$level) {
                    $searchData= Db::table('supplierproduct')
                        ->field(['refproductid'])
                        ->where([
                            'productID' => $mid,
                            'refproductid'=>$d[0]
                        ])
                        ->select();
                    if(count($searchData)>0)
                    {
                        $d[3]='Y';
                        array_push($newData,$d);
                    }
                    else
                    { array_push($newData,$d);}
                }
                Supplierproduct::getLevel($data,$level,$d[0]);

            }
            return $newData;
        }
    }


 

}


