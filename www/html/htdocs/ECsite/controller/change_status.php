<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/change_status_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';
$date=date('Y-m-d H:i:s');

session_start();
try {
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $dbh = get_db_connect();
        
        //item_idとstock_changeをpostで受け取る
        $id   =$_POST['item_id'];
        $status=$_POST['status_change'];
        
        //規定値が入力されているかチェック
        check_status($status,"ステータス");
        
        if(empty($_SESSION['error'])){
            update_status($dbh,$id,$status,$date);
            $_SESSION['msg'] = 'ステータスの変更が完了しました';
        }
    }
    
} catch (PDOException $e) {
    throw $e;
    $_SESSION['error'] = 'ステータスの変更に失敗しました';
}
header('Location: ./ec_tool.php');
exit;
?>