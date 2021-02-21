<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/acaunt_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

$curious_item ='';
$history_item ='';
$img_dir   ="./img/";

session_start();
   
        try {
                $dbh=get_db_connect();
                $id=$_SESSION['user_id'];
                //新着装具義足を５件ずつ取得
                $curious_item=get_curious_data($dbh,$id);
                $history_item=get_history_data($dbh,$id);
                //var_dump($history_item);
                if($_SERVER['REQUEST_METHOD'] === 'POST'){
                    insert_ec_cart($dbh,$_POST['item_id']);
                }
                
        } catch (PDOException $e) {
             $e->getMessage();
        }
    

// 商品一覧テンプレートファイル読み込み
include_once __DIR__ . '/../../../include/ECsite/view/acaunt_view.php';

?>