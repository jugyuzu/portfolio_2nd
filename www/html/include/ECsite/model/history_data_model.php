<?php

//購入履歴を12件取得
    function get_history_data($dbh,$user,$page){
        try {
            $sql = 'SELECT m.img, m.url, h.log_id, h.create_datetime FROM history_data AS h INNER JOIN ec_item_master AS m ON m.item_id=h.item_id WHERE h.user_id=:id ORDER BY h.create_datetime DESC LIMIT 12 OFFSET :page';
            $params=[':id'=>$user, ':page'=>$page];
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute($params);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            throw $e;
        }
        
    }
?>