<?php
// 設定ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/conf/const.php';
// 関数ファイル読み込み
require_once __DIR__ . '/../../../include/ECsite/model/change_list_prohesis_model.php';
require_once __DIR__ . '/../../../include/ECsite/model/common_model.php';

session_start();
if($_SERVER['REQUEST_METHOD'] === 'POST'){
    $time=$_POST['select_time'];
    $price=$_POST['select_price'];
    $dbh = get_db_connect();
    //postで受け取ったselect_timeがnewで
    if($time == "new"){
        $_SESSION['select_time']="new";
        //select_priceがallなら新着順で全ての金額
        if($price == "all"){
            $prothesis_data = get_prothesis_list($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="all";
            
        //select_priceがprice10000なら新着順で10000円まで    
        }else if($price == "price10000"){
            $prothesis_data = get_prothesis_price10000($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="price10000";
            
        //select_priceがprice50000なら新着順で50000円まで    
        }else if($price == "price50000"){
            $prothesis_data = get_prothesis_price50000($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="price50000";
            
        //select_priceがprice100000なら新着順で100000円まで    
        }else if($price == "price100000"){
            $prothesis_data = get_prothesis_price100000($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="price100000";
        }
    
    //postで受け取ったselect_timeがprice_upで    
    }else if($time == "price_up"){
        $_SESSION['select_time']="up";
        
        //select_priceがallなら価格が高い順で全ての金額
        if($price == "all"){
            $prothesis_data = get_prothesis_price_up($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="all";
            
        //select_priceがprice10000なら価格が高い順で10000円まで    
        }else if($price == "price10000"){
            $prothesis_data = get_prothesis_price_up_price10000($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="price10000";
        
        //select_priceがprice50000なら価格が高い順で50000円まで    
        }else if($price == "price50000"){
            $prothesis_data = get_prothesis_price_up_price50000($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="price50000";
        
        //select_priceがprice100000なら価格が高い順で100000円まで    
        }else if($price == "price100000"){
            $prothesis_data = get_prothesis_price_up_price100000($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="price100000";
        }
    
    //postで受け取ったselect_timeがprice_downで    
    }else if($time == "price_down"){
        $_SESSION['select_time']="down";
        
        //select_priceがallなら価格が安い順で全ての金額
        if($price == "all"){
            $prothesis_data = get_prothesis_price_down($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="all";
            
        //select_priceがprice10000なら価格が安い順で10000円まで    
        }else if($price == "price10000"){
            $prothesis_data = get_prothesis_price_down_price10000($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="price10000";
        
        //select_priceがprice50000なら価格が安い順で50000円まで    
        }else if($price == "price50000"){
            $prothesis_data = get_prothesis_price_down_price50000($dbh);
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="price50000";
        
        //select_priceがprice100000なら価格が安い順で100000円まで    
        }else if($price == "price100000"){
            $prothesis_data = get_prothesis_price_down_price100000($dbh); 
            $_SESSION['prothesis_data']=$prothesis_data;
            $_SESSION['select_price']="price100000";
        }    
    }
}
header('Location: ./prothesis_list.php');
?>