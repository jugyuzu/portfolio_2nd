<?php

//データベースからlog_idに応じて取得
    function get_item_history($dbh,$log,$user){
        try {
            $sql='SELECT m.name, m.price, m.img, m.url, m.item_id, h.amount FROM history_data AS h INNER JOIN ec_item_master AS m ON h.item_id=m.item_id WHERE h.user_id=:user AND h.log_id=:log';
            $params=[':user'=>$user,':log'=>$log];
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute($params);
            $data=$stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
        return $data;
        
    }
?>