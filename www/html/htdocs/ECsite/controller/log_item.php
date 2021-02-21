<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/log_item_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

$img_dir   ="./img/";
$item_data =array();

session_start();
    
        try {
            $dbh=get_db_connect();
            
            if(isset($_GET['id']) === TRUE){
                //idの内容を取得
                $log  =$_GET['id'];
                
                $user=$_SESSION['user_id'];
                //idに応じて購入履歴から取得
                $item_data=get_item_history($dbh,$log,$user);
                
            }
            
        } catch (PDOException $e) {
            $e->getMessage();
        }
    
// 商品一覧テンプレートファイル読み込み
include_once __DIR__ . '/../../../include/ECsite/view/log_item_view.php';
exit;
?>