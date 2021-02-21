<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/prothesis_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

$prothesis_data=array();
$error         =array();
$data          =array();
$img_dir       ="./img/";
$date          =date('Y-m-d H:i:s');

session_start();
    
        try {
            $dbh = get_db_connect();
            
            if(isset($_GET['id'])){
                $get=$_GET['id'];
                if($get == 'prothesis'){
                    $prothesis_data = get_prothesis_list($dbh);
                    
                }else if($get == 'arm'){
                    $prothesis_data = get_prothesis_arm_list($dbh);
                    
                }else if($get == 'foot'){
                    $prothesis_data = get_prothesis_foot_list($dbh);
                    
                }else if($get == 'cover'){
                    $prothesis_data = get_prothesis_cover_list($dbh);
                    
                }
            }else if(isset($_SESSION['prothesis_data'])){
                $prothesis_data=$_SESSION['prothesis_data'];
                
            }
            
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
include_once __DIR__ . '/../../../include/ECsite/view/prothesis_view.php';

?>