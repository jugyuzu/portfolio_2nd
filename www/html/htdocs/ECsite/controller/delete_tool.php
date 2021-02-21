<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/delete_tool_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';
session_start();
try{
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //データベース接続
    $dbh=get_db_connect();
    $_SESSION['msg']='';
    $_SESSION['error']='';
    
    //idを取得
    $item_id=$_POST['item_id'];
   
    //対応するカートの商品を削除
    delete_item($dbh,$item_id);
    $_SESSION['msg'] = '削除が完了しました';
    }
} catch (PDOException $e) {
    throw $e;
    $_SESSION['error'] = '削除に失敗しました';
}

header('Location: ./ec_tool.php');
exit;
?>