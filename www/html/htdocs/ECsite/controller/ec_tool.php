<?php 
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
//require_once '/home/ec2-user/environment/include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/ec_tool_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

$error     = array();
$msg       = array();
$img_dir   ="./img/";
$date      =date('Y-m-d H:i:s');
session_start();
try {
    $dbh = get_db_connect();
    
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
        $name   =trim($_POST['name']);
        $price  =trim($_POST['price']);
        $stock  =trim($_POST['stock']);
        $part   =trim($_POST['part']);
        $status =trim($_POST['status']);
        $po     =trim($_POST['po']);
        $comment=trim($_POST['comment']);
    
    //名前、値段、在庫が入力されているかチェック
        check_input($name,"名前");
        check_input($price,"値段");
        check_input($stock,"在庫");
        check_input($comment,"コメント");
    
    //コメントが200文字以内かチェック
        check_comment($comment,"コメント");
        
    //値段が整数で入力されているかチェック
    //在庫数が整数で入力されているかチェック
        check_int($price,"値段");
        check_int($stock,"在庫");
    
    //ステータスが0か１で入力されているかチェック
    //義足か装具か選択されているかチェック
        check_status($status,"ステータス");
        check_status($po,"義肢装具");
    
    //部位が選択されているかチェック
        check_part($part,"部位");
    
    //画像がが入力されているかチェック
        $new_file_img=file_controller('item_img', $img_dir);
    
    //$errorがなければhtml変換とファイル作成
        if(count($error) == 0){
            //html変換
            $name=entity_str($name);
            $price=entity_str($price);
            $stock=entity_str($stock);
            $comment=entity_str($comment);
            
            //ファイルを作成
            $url=new_page($name);
                if(count($error) == 0){
                    $dbh->beginTransaction();
                    try{
                        $id=insert_master($dbh,$name,$price,$new_file_img,$status,$po,$part,$url,$comment,$date,$date);
                        insert_stock($dbh,$id,$stock,$date,$date);
                        $msg[]="商品登録完了";
                        $dbh->commit();
                    }catch (PDOException $e){
                        $dbh->rollback();
                        $e->getMessage();
                        $error[] = "登録失敗";
                    }
                }
        }
    
    }
    //データベースから商品一覧を取得item_id,name,price,img,status,po,url
        $data = select_db($dbh);
        if(isset($_SESSION['msg'])){
            $msg[] = trim($_SESSION['msg']);    
        }
        if(isset($_SESSION['error'])){
            $error[] = trim($_SESSION['error']);
        }
        $_SESSION['msg'] = '';
        $_SESSION['error'] = '';
} catch (PDOException $e) {
    $e->getMessage();
}
    
 // 商品一覧テンプレートファイル読み込み
include_once __DIR__ . '/../../../include/ECsite/view/ec_tool_view.php';
exit;
?>