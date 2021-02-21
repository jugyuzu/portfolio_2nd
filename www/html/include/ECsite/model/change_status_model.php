<?php

//1か0か確認
    function check_status($num, $text){
        global $error;
        if($num == 1 || $num == 0){
        }else{
            $_SESSION['error'] =$text . 'に規定値以外の値がセットされています。公開（１）か非公開（０）を入力して下さい';
        }
    }
    
//ec_item_stockをupdate
    function update_status($dbh,$id,$status,$date){
        $sql='UPDATE `ec_item_master` SET `status`=:status,`update_datetime`=:date WHERE item_id=:id;';
        $params=[':status'=>$status,':date'=>$date,':id'=>$id];
        $stmt = $dbh->prepare($sql);
        $stmt ->execute($params);
    }

?>