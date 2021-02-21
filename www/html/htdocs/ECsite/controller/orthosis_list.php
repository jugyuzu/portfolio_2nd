<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/orthosis_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

$orthosis_data=array();
$error =array();
$img_dir   ="./img/";
$date      =date('Y-m-d H:i:s');

session_start();

    
        try {
            $dbh = get_db_connect();
            
            if(isset($_GET['id'])){
                $get=$_GET['id'];
                if($get == "orthosis"){
                    $orthosis_data = get_orthosis_list($dbh);
                    
                }else if($get == "arm"){
                    $orthosis_data = get_orthosis_arm_list($dbh);
                    
                }else if($get == "foot"){
                    $orthosis_data = get_orthosis_foot_list($dbh);
                    
                }else if($get == "waist"){
                    $orthosis_data = get_orthosis_waist_list($dbh);
                    
                }else if($get == "cover"){
                    $orthosis_data = get_orthosis_cover_list($dbh);
                    
                }
            }else if(isset($_SESSION['orthosis_data'])){
                $orthosis_data=$_SESSION['orthosis_data'];
                
            }
            //var_dump($orthosis_data);
            if($_SERVER['REQUEST_METHOD'] === 'POST'){
                //$paramt =$_POST['name'];
                $id     =$_POST['item_id'];
                $user_id=$_SESSION['user_id'];
                $amount =1;
                $data=get_cart_data($dbh,$user_id);
                
                //カートに同じ商品がないか確認
                check_cart($data,$id);
                if(count($error) == 0){
                    insert_ec_cart($dbh,$id,$user_id,$amount,$date,$date);
                }
            }    
            //順番を変える場合はchange_list_orderでselectする
            $time ="new";
            $price="all";
            //selectした時にvalueをセッションにれるのでそれを受け取る
            if(empty($_SESSION['select_time']) === FALSE && empty($_SESSION['select_price']) === FALSE){
                $time = $_SESSION['select_time'];
                $price = $_SESSION['select_price'];
            }
            $_SESSION['select_time']='';
            $_SESSION['select_price']='';
        } catch (PDOException $e) {
            $e->getMessage();
        }
    

// 商品一覧テンプレートファイル読み込み
include_once __DIR__ . '/../../../include/ECsite/view/orthosis_view.php';
exit;
?>