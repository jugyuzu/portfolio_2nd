<?php
    
//対応するカートの商品を削除
    function delete_item($dbh,$id){
        $sql='DELETE FROM ec_item_master WHERE item_id=:id;';
        $params=['id'=>$id];
        $stmt = $dbh->prepare($sql);
        $stmt ->execute($params);
    }
?>