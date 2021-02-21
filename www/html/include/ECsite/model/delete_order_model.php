<?php
    
//対応するカートの商品を削除
    function delete_ec_cart($dbh,$item_id,$ec_id){
        $sql='DELETE FROM ec_cart WHERE id=:ec_id AND item_id=:item_id;';
        $params=[':ec_id'=>$ec_id, 'item_id'=>$item_id];
        $stmt = $dbh->prepare($sql);
        $stmt ->execute($params);
    }
?>