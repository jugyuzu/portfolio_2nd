<?php

//気になるボタンを押した商品を取得
    function get_curious_data($dbh,$id){
        $sql = 'SELECT m.item_id, m.name, m.img, m.url FROM ec_item_master AS m INNER JOIN curious_data AS c ON m.item_id=c.item_id WHERE c.user_id=:id ORDER BY c.create_datetime DESC LIMIT 5';
        $params=[':id'=>$id];
        $data=execute_query_select($sql,$dbh,$params);
        return $data;
    }
//購入履歴を表示
    function get_history_data($dbh,$id){
        $sql = "SELECT m.img, m.url, h.log_id, h.create_datetime FROM history_data AS h INNER JOIN ec_item_master AS m ON m.item_id=h.item_id WHERE h.user_id=:id ORDER BY h.create_datetime DESC LIMIT 5";//'SELECT m.img, m.url, h.log_id, h.create_datetime FROM history_data AS h INNER JOIN ec_item_master AS m ON m.item_id=h.item_id WHERE h.user_id=:id GROUP BY h.create_datetime ORDER BY h.create_datetime DESC LIMIT 5';
        $params=[':id'=>$id];
        $data=execute_query_select($sql,$dbh,$params);
        return $data;
    }
    
//データベースから参照
    function execute_query_select($sql,$dbh,$params){
        try {
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute($params);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
            
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
?>