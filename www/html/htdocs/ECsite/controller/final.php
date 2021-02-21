<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/final_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

$date      =date('Y-m-d H:i:s');
$img_dir   ="./img/";
$msg       =array();
$item_id   =array();
$amount    =array();
$item_data =array();
$data      =array();
$items     =array();
$history_id=array();
$h_id      =array();
$i_data    =array();
$log       ='';
$id        ='';
$sum       ='';

session_start();
        
            try {
                $dbh=get_db_connect();
                    //受け取ったデータを表示ように代入
                    $get_data[]=$_SESSION['cart_data'];
                    $id       =$_SESSION['user_id'];
                    $sum      =$_SESSION["sum"];
                    foreach($get_data as $data){
                        foreach($data as $row){
                            $item_data[]=$row;
                        }
                    }
                    //var_dump($id,$sum,$item_data);
                    $dbh->beginTransaction();
                    try{    
                        //var_dump($sum);
                        //在庫数を減らす
                        update_ec_stock($dbh,$item_data,$date);
                        
                        //履歴を取得して、最後のlog_idに１を足す
                        $log=get_history($dbh,$id);
                        //var_dump($log);
                        //購入履歴を挿入
                        $history_id[]=insert_history($dbh,$item_data,$id,$date,$log);
                        
                        //ec_cartを削除
                        delete_ec_cart($dbh,$id,$item_data);
                        //購入したものを取得
                        $i_data[]=select_history_item($dbh,$id,$history_id);
                        
                        foreach($i_data as $item_data){
                             foreach($item_data as $rowdata){
                                 $items[] = $rowdata;
                             }
                        }
                        $dbh->commit();
                        $msg[]='購入ありがとうございました';
                        
                    }catch(PDOException $e){
                        $dbh->rollback();
                        $e->getMessage();
                    }
                    
            } catch (PODException $e) {
                throw $e;
            }
            
        

// 商品一覧テンプレートファイル読み込み
include_once __DIR__ . '/../../../include/ECsite/view/final_view.php';

?>