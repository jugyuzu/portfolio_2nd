<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/delete_curious_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';
session_start();
try{
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //データベース接続
    $dbh=get_db_connect();
    
    //idを取得
    $item_id=$_POST['item_id'];
    $user_id =$_SESSION['user_id'];
   
    //対応するカートの商品を削除
    delete_curious($dbh,$item_id,$user_id);
    }
} catch (PDOException $e) {
    throw $e;
}
header('Location: ./acaunt.php')
?>