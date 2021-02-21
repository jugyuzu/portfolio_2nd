<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/front_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';
$data='';
session_start();
    try {
        $user=$_SESSION['user_id'];
        $front=$_GET['id'];
        $dbh=get_db_connect();
        
        //購入履歴全体の件数をlog_idごとに集計
        $data=history_count($dbh,$user);
        $count=$data-$front; 
        if($count == $data){
            $_SESSION['page'] =$front;
            $_SESSION['next'] =$front + 12;
            $_SESSION['front']="none";
        }else if($count >= 12){
            $_SESSION['page'] =$front;
            $_SESSION['next'] =$front + 12;
            $_SESSION['front']=$front - 12;
        }
    } catch (PDOException $e) {
            throw $e;
    }
header('Location: ./history_data.php');
exit;
?>