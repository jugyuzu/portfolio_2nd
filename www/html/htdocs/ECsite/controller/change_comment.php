<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/change_comment_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';
$date=date('Y-m-d H:i:s');

session_start();
try {
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $dbh = get_db_connect();
        
        //item_idとpart_changeをpostで受け取る
        $id   =$_POST['item_id'];
        $comment=$_POST['comment'];
        
        //コメントが入力されているかチェック
        check_input($comment,"コメント");
        
        //コメントが200文字以内かチェック
        check_comment($comment,"コメント");
        
        if(empty($_SESSION['error'])){
            $comment=entity_str($comment);
            update_comment($dbh,$id,$comment,$date);
            $_SESSION['msg']='コメントの変更が完了しました';
        }
    }
    
} catch (PDOException $e) {
    throw $e;
    $_SESSION['error']='コメントの変更に失敗しました';
}
header('Location: ./ec_tool.php');
exit;
?>