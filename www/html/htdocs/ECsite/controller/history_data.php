<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/history_data_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

$img_dir   ="./img/";
$page      ='';
$next      ='';
$front      ='';

session_start();
    
        try {
            $user=$_SESSION['user_id'];
            $dbh=get_db_connect();
            if(empty($_SESSION['page'])){
                $page=0;
                $front="none";
                $next =12;
            }else{
                $page =$_SESSION['page'];
                $next =$_SESSION['next'];
                $front=$_SESSION['front'];
                
            }
            //var_dump($page);
            //購入履歴を取得
            $history_data=get_history_data($dbh,$user,$page);
            if(count($history_data)<=12){
                $next="none";
            }
            $_SESSION['page'] ='';
            $_SESSION['next'] ='';
            $_SESSION['front']='';
        } catch (PDOException $e) {
            $e->getMessage();
        }
    
// 商品一覧テンプレートファイル読み込み
include_once __DIR__ . '/../../../include/ECsite/view/history_data_view.php';
exit;
?>