<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/change_part_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';
$date=date('Y-m-d H:i:s');

session_start();
try {
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $dbh = get_db_connect();
        
        //item_idとpart_changeをpostで受け取る
        $id   =$_POST['item_id'];
        $part=$_POST['part_change'];
        
        //部位が選択されているかチェック
        check_part($part,"部位");
        
        if(empty($_SESSION['error'])){
            update_part($dbh,$id,$part,$date);
            $_SESSION['msg'] = '部位の変更が完了しました';
        }
    }
    
} catch (PDOException $e) {
    throw $e;
    $_SESSION['error'] = '部位の変更に失敗しました';
}
header('Location: ./ec_tool.php');
exit;
?>