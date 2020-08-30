<?php
namespace app\index\controller;


use think\Controller;
use think\Db;

class Detail extends Controller
{
    public function detail()
    {   
        $keyID = input('get.productID');

        $data = Db::table('supplier')
        ->alias('s')
        ->join(['supplierproduct'=> 'p'], 's.id = p.supplierID')
        ->field(['supplierName','address','country','productName','productType','productStyleNo','verifiedContentClaim','verifieStatus','verifiedProductAmount','verificationStatementNo'])
        ->where('productID', $keyID)
        ->select()[0];

        $this->assign('data', $data);

        return $this->fetch();
    }

    //获取供应链数据
    public function getTreeData()
    {
        $searchID = input('get.');
        $getTreeData = array();

        // up为向上查询，down为向下查询
        $upData = Detail::upSearch($searchID['productID']);    
        $downData = Detail::downSearch($searchID['productID']); 
        
/*        //标定主线
        $getTreeData[] = Detail::markMainLine($upData);
        $getTreeData[] = Detail::markMainLine(array_reverse($downData));*/

        $getTreeData['keyID'] = $searchID['productID'];
        if ($downData==NULL) {
            $getTreeData['data'] = array_reverse(Detail::markMainLine($upData));
        }
        else
        {
            $getTreeData['data'] = array_reverse(array_merge(Detail::markMainLine(array_reverse($downData)), Detail::markMainLine($upData)));
        }

        return json($getTreeData);
    }


    private function upSearch($productID, $level = - 1)
    {
        static $arr = array();
        $level= $level + 1;
        
        //通过传入的ID执行数据库查询
//         $data= Db::table('supplierproduct')
//             ->field(['refproductid','verifieStatus','productName','supplierName'])
//             ->where(['productID' => $productID])    
//             ->select();
        
        $data = Db::table('supplier')
            ->alias('s')
            ->join(['supplierproduct'=> 'p'], 's.id = p.supplierID')
            ->field(['productID','refproductid','verifieStatus','productName','supplierName'])
            ->where(['productID' => $productID]) 
            ->select();

        foreach($data as $d){
            $arr[$level][] = array(
                "productID" => $productID
               ,"refProductID" => $d['refproductid']
               ,"productName" => $d['productName']
               ,"supplierName" => $d['supplierName']
               ,"level" => $level
               ,"mainLine" => 'N'
               ,"verifyStatus" => $d['verifieStatus']
            );

            if(empty($d['refproductid'])) {
                continue;
            }
            
            if($level<=50)
            {
                Detail::upSearch($d['refproductid'], $level);
            }
           
        }
        return $arr;
    }

    private function downSearch($ProductID, $level = - 1)
    {
        static  $arr = array();

        $level= $level + 1;

        //通过传入的ID执行数据库查询
//         $data = Db::table('supplierproduct')
//         ->field(['productID','refproductid','verifieStatus','productName','supplierName'])
//         ->where(['refproductid' => $ProductID])
//         ->select();

        $data = Db::table('supplier')
        ->alias('s')
        ->join(['supplierproduct'=> 'p'], 's.id = p.supplierID')
        ->field(['productID','refproductid','verifieStatus','productName','supplierName'])
        ->where(['refproductid' => $ProductID])
        ->select();

        if(count($data) == 0) {
            return;
        }

        foreach($data as $d){

             $arr[$level][] = array(
                 "productID" => $d['productID']
                ,"refProductID" => $d['refproductid']
                ,"productName" => $d['productName']
                ,"supplierName" => $d['supplierName']
                ,"level" => $level
                ,"mainLine" => 'N'
                ,"verifyStatus" => $d['verifieStatus']
             );
            
             if($level<=50)
             {
                 Detail::downSearch($d['productID'], $level);
             }             
        }

       return $arr;
    }

    private function markMainLine($data)
    {
        $maxLevel = count($data) - 1;
        $maxProductID = $data[$maxLevel][0]['productID'];
        $maxRefID = $data[$maxLevel][0]['refProductID'];
        
        //标定首个数据
        $data[$maxLevel][0]['mainLine'] = 'Y';

        //标定剩余数据，并返回
        return Detail::markRest($data, $maxLevel, $maxProductID, $maxRefID);
    }

    private function markRest($data, $originLevel, $originProductID, $originRefID)
    {
        static $arr = array();

        if($originLevel == 0) {
            $arr = $data;
            return $data; 
        }

        $level = $originLevel - 1;

        foreach($data[$level] as $k => $d) {

            if ($d['refProductID'] != $originProductID) continue;

            $data[$level][$k]['mainLine'] = 'Y';
            
            $markedData = Detail::markRest($data, $level, $d['productID'], $d['refProductID']);

            if(empty($arr)) {
                $arr = $markedData;
            }

            break;
        }

        return $arr;
    }


   /* //获取主线数组
    public function getLevel($data, $maxLevel, $maxProductID, $maxRefID, $flag)
    {
        static $getLevel = array();

        if($maxLevel == 1) { return $data; }

        $level = $maxLevel - 1;

        foreach ($data as $d) {

            if ($d['level'] == $level) {

                if ($flag == 'u') {
                    if ($d['refProductID'] == $maxProductID) {
                        $d['mainLine'] = 'Y';
                        array_push($getLevel, $d);
                        Detail::getLevel($data, $level, $d['productID'], $d['refProductID'], $flag);
                    }
                } else {
                    if ($d['productID'] == $maxRefID) {
                        $d['mainLine'] = 'Y';
                        array_push($getLevel, $d);
                        Detail::getLevel($data, $level, $d['productID'], $d['refProductID'], $flag);
                    }
                }
            }
        }
        return $getLevel;
    }*/


   /* public function transferData($data, $flag)
    {   

        $maxLevel = count($data);
        $maxProductID = $data[$maxLevel][0]['productID'];
        $maxRefID = $data[$maxLevel][0]['refproductid'];



        // 获取upLevel的主线关系
        // $maxLevel = 0;       //i变量通过循环比较赋值，取出最大的层
        // $maxProductID= "";    //mid 代表主线ID，通过循环获取最末层主线ID
        // $maxRefID = "";

        //获取最大level对应的数据
        foreach ($data as $d){
            if ($d['level'] > $maxLevel) {
                $maxProductID = $d['productID'];
                $maxRefID = $d['refProductID'];
                $maxLevel = $d['level'];
            }
        }

        $getLevel = Detail::getLevel($data, $maxLevel, $maxProductID, $maxRefID, $flag);

        foreach($data as $d) {

        }


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
    }*/



    /*//    第5和id1传进来
    public function upLevel($data,$levelNum,$mid){
        static $upLevel = array();

        if($levelNum>0) {

            $level = $levelNum - 1;

            foreach ($data as $d) {

                if ($d[2] == $level) {

                    if ($d[1] == $mid) {
                        $d[3] = 'Y';
                        array_push($upLevel, $d);
                        Detail::upLevel($data, $level, $d[0]);
                    }
                }

            }
            return $upLevel;
        }
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
                        Detail::downLevel($data,$level,$d[1]);
                    }
                }

            }
            return $downLevel;
        }
    }*/


    /*public function putSearchID()
    {
        $searchID = input('get.');

//        up为向上查询，down为向下查询
        $upData = Detail::upID($searchID['productID']);
        // $downData = Detail::downID($searchID['productID']);              
        $downData = Detail::downID($searchID['productID'], $searchID['refProductID'],$searchID['verifieStatus']);


        // 获取upLevel的主线关系
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
        $upLevel = Detail::upLevel($upData,$upLev,$upMid);

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
        $downLevel = Detail::downLevel($downData,$lev,$rid);
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

        return $dataLevel;

    }

    public function upID($productID,$level=0)
    {
        static $arr = array();
        $level= $level+1;
        //通过传入的ID执行数据库查询
        
        $data= Db::table('supplierproduct')
            ->field(['refproductid','verifieStatus'])
            ->where(['productID' => $productID])
            ->select();

        foreach($data as $d){
            array_push($arr,array("$productID",$d['refproductid'],"$level",'N',$d['verifieStatus']));
            Detail::upID($d['refproductid'],$level);
        }
        return $arr;
    }

    public function downID($productID,$refid,$verifieStatus,$level=0)
    {
        static  $arr = array();
        $level= $level+1;
        if(!empty($productID))
        {
            $levelID =array("$productID","$refid","$level","N","$verifieStatus");
            array_push($arr,$levelID);
        }
        //通过传入的ID执行数据库查询
        $data= Db::table('supplierproduct')
       ->field(['productID','refproductID','verifieStatus'])
       ->where(['refproductid' => $productID])
       ->select();
       foreach($data as $d){
           Detail::downID($d['productID'],$d['refproductID'],$d['verifieStatus'],$level);
       }
       return $arr;

    }*/


  /*  function test()
    {
        $data= Detail::searchID(7);
        
        return $data;
    }*/
    
/*    function get_childs( $parent_id = array(), $level = 0 ){
        
        static  $id_arr = array();
        $id_arr= Db::name('Detail')->where('productID','in',$parent_id)->column('refproductid');

        if (!empty($id_arr)) {
            $level++;
            $id_arr=array_merge($id_arr,Detail::get_childs($id_arr,$level));
        }
        return $id_arr;
    }*/
}
