<?php

////対応するカートの商品の数量を変更    
 function update_ec_cart($dbh,$amount,$item_id,$ec_id){
     try {
         $sql = 'UPDATE ec_cart  AS c SET c.amount=:amount WHERE item_id=:item_id AND id=:ec_id;';
         $params=[':amount'=>$amount, ':item_id'=>$item_id, 'ec_id'=>$ec_id];
         $stmt = $dbh->prepare($sql);
         $stmt ->execute($params);
     } catch (PODException $e) {
         throw $e;
     }
 }   
?>