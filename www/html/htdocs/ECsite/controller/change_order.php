<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/change_order_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';
try {
    if($_SERVER['REQUEST_METHOD'] === 'POST'){
    //データベース接続
    $dbh=get_db_connect();
    
    //postのamount,item_id,ec_cartのidを取得
    $amount =$_POST['amount'];
    $item_id=$_POST['item_id'];
    $ec_id  =$_POST['cart_id'];
    
    //対応するカートの商品の数量を変更
    update_ec_cart($dbh,$amount,$item_id,$ec_id);
    }
} catch (PDOException $e) {
    throw $e;
}

header('Location: ./cart.php')
?>