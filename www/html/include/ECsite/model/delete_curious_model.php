<?php
   
//対応するカートの商品を削除
    function delete_curious($dbh,$item,$user){
        $sql='DELETE FROM curious_data WHERE item_id=:item AND user_id=:user;';
        $params=[':item'=>$item, ':user'=>$user];
        $stmt = $dbh->prepare($sql);
        $stmt ->execute($params);
    }
?>