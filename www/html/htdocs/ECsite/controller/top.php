<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/top_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

$new_orthosis ='';
$new_prothesis='';
$img_dir   ="./img/";

session_start();
try {
        // $_SESSION['user_name']= session_id();
        // $session = $_SESSION['user_name'];
        $dbh=get_db_connect();
            //新着装具義足を５件ずつ取得
            if(empty($_COOKIE['id'])){
                $_SESSION['user_name']= session_id();
                $session = $_SESSION['user_name'];
                insert_user_id($dbh,$session);
                setcookie('id',$session,time()+60*60*24*2);
            }
            $session = $_COOKIE['id'];
            $_SESSION['name']=$_COOKIE['id'];
            $data = select_user($dbh,$session);
            $_SESSION['user_id']= $data[0]['user_id'];
            $new_orthosis=get_orthosis_data($dbh);
            $new_prothesis=get_prothesis_data($dbh);
        } catch (PDOException $e) {
             $e->getMessage();
        }
    
// 商品一覧テンプレートファイル読み込み
include_once __DIR__ . '/../../../include/ECsite/view/top_view.php';

?>