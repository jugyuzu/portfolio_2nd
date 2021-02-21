<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/cart_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

$date      =date('Y-m-d H:i:s');
$img_dir   ="./img/";
$cart_data = array();
$sum       ="";
$item_id   =array();
$amount    =array();

session_start();
        
            try {
                    $dbh=get_db_connect();
                    //カートの中身を取得
                    $id = $_SESSION['user_id'];
                    $cart_data=get_cart_data($dbh,$id);
                    
                    //$cart_dataの[price]の合計を出す
                    $sum=cart_sum($cart_data);
                    
                    //注文を確定したらec_cartのupdate_datetimeに挿入
                    if($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['buy'])){
                        check_stock($dbh,$cart_data);
                        if(empty($error)){
                            $_SESSION["cart_data"] =$cart_data;
                            $_SESSION["sum"]       =$sum;
                            header('Location: ./final.php');
                        }
                    }
                    
            } catch (PDOException $e) {
                 $error[] = $e->getMessage();
            }
        
    
// 商品一覧テンプレートファイル読み込み
include_once __DIR__ . '/../../../include/ECsite/view/cart_view.php';

?>