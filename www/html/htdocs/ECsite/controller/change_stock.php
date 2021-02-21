<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/change_stock_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';
$date=date('Y-m-d H:i:s');

session_start();
try {
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $dbh = get_db_connect();
        
        //item_idとstock_changeをpostで受け取る
        $id   =$_POST['item_id'];
        $stock=trim($_POST['stock_change']);
        
        //入力されているか
        check_input($stock,"在庫数");
        //整数かチェック
        check_int($stock,"在庫数");
        
        //エラーがなければhtml変換ec_item_stockをupdate
        if(empty($_SESSION['error'])){
            $stock=entity_str($stock);
            update_stock($dbh,$stock,$id,$date);
            $_SESSION['msg']='在庫数の変更が完了しました';
        }
    }
    
} catch (PDOException $e) {
    throw $e;
    $_SESSION['error']='在庫数の変更に失敗しました';
}

header('Location: ./ec_tool.php');
exit;
?>