<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/change_po_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';
$date=date('Y-m-d H:i:s');

session_start();
try {
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $dbh = get_db_connect();

        //item_idとstock_changeをpostで受け取る
        $id   =$_POST['item_id'];
        $po=$_POST['po_change'];
        
        //規定値が入力されているかチェック
        check_status($po,"義肢装具");
        
        if(empty($_SESSION['error'])){
            update_po($dbh,$id,$po,$date);
            $_SESSION['msg']='種類の変更が完了しました。';
        }
    }
    
} catch (PDOException $e) {
    throw $e;
    $_SESSION['error']='種類の変更に失敗しました。';
}
header('Location: ./ec_tool.php');
exit;
?>