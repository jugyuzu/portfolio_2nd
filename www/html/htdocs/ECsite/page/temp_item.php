<?php 
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/temp_item_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

$error    =array();
$img_dir  ='../controller/img/';
$date     =date('Y-m-d H:i:s');
$item_data=array();
$data     =array();

//a herf='' id=item_idで送られてきたら
session_start();
    
        try {
            $dbh=get_db_connect();
            
            if(isset($_GET['id']) === TRUE){
                //idの内容を取得
                $id=$_GET['id'];
                //idに応じてデータベースから名前、値段、在庫,ステータスを取得
                $item_data=get_item_data($dbh,$id);
            }
            
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                $paramt =$_POST['button'];
                $id     =$_POST['item_id'];
                $user_id=$_SESSION['user_id'];
                $amount =1;
                //var_dump($paramt);
                if($paramt == "cart"){
                    //if POSTでカートに入れるボタンが押されたらデータベースに入れる
                    //同じ商品がカートに入っていない確認
                    //var_dump($user_id);
                    $data=get_cart_data($dbh,$user_id);

                    check_cart($data,$id);
                    if(count($error) == 0){
                        insert_ec_cart($dbh,$id,$user_id,$amount,$date,$date);
                    }
                }else if($paramt == "like"){
                    //ユーザーが同じ商品を気になるにしていないか確認
                    $data=get_curious_data($dbh,$user_id);
                    
                    check_curious($data,$id);
                    if(count($error) == 0){
                    //if POSTで気になるボタンが押されたらデータベースに入れる
                    insert_curious_data($dbh,$id,$user_id,$date);
                    }
                }
            }
        } catch (PDOException $e) {
            $e->getMessage();
        }
    

 // 商品一覧テンプレートファイル読み込み
include_once __DIR__ . '/../../../include/ECsite/view/temp_item_view.php';
?>