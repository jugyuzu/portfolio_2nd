<?php

//1か0か確認
    function check_status($num, $text){
        if($num == 1 || $num == 0){
        }else{
            $_SESSION['error'] =$text . 'に規定値以外の値がセットされています。公開（１）か非公開（０）を入力して下さい';
        }
    }
    
//ec_item_masterをupdate
    function update_po($dbh,$id,$po,$date){
        $sql='UPDATE `ec_item_master` SET `po`=:po,`update_datetime`=:date WHERE item_id=:id;';
        $params=[':po'=>$po,':date'=>$date,':id'=>$id];
        $stmt = $dbh->prepare($sql);
        $stmt ->execute($params);
    }

?>