<?php

//購入履歴の件数を取得
    function history_count($dbh,$user){
        try {
            $sql = 'SELECT COUNT( DISTINCT log_id) FROM history_data WHERE user_id=:user';
            $params=[':user'=>$user];
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute($params);
            $data = $stmt->fetch(PDO::FETCH_COLUMN);
            return $data;
        } catch (PDOException $e) {
            throw $e;
        }
        
    }
?>