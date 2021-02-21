<?php

//新着５件、装具をデータベースから取得
    function get_orthosis_data($dbh){
        $sql = '
            SELECT 
                `item_id`, 
                `name`, 
                `img`,
                `url`
            FROM 
                `ec_item_master` 
            WHERE status=1 AND po=0 
            ORDER BY 
                create_datetime DESC 
            LIMIT 5';
        $data=execute_query_select($sql,$dbh,$params);
        return $data;
}

//新着５件、義足部品をデータベースから取得
    function get_prothesis_data($dbh){
        //$sql = 'SELECT RANK() OVER(ORDER BY create_datetime DESC) AS rank, item_id, name, price, url FROM ec_item_master WHERE po=0 AND status=1 AND rank<=5;';
        $sql ='
            SELECT 
                `item_id`, 
                `name`, 
                `img`,
                `url`
            FROM 
                `ec_item_master` 
            WHERE 
                status=1 AND po=1 
            ORDER BY 
                create_datetime DESC 
            LIMIT 5;';
        $data=execute_query_select($sql,$dbh,$params);
        return $data;
    }
    
//データベースから参
    function execute_query_select($sql,$dbh, $params = array()){
        try {
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute($params);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
            
        } catch (PDOException $e) {
            $e->getMessage();
        }
    }
    function insert_user_id($dbh,$user){
        $sql = '
            INSERT INTO 
                `ec_user`(`user_name`) 
            VALUES 
                (:user)
            limit
                1
        ';
        $params = ['user'=>$user];
        execute_query($sql, $params, $dbh);
    }

    function select_user($dbh,$user){
        $sql ='
            SELECT 
                `user_id` 
            FROM 
                `ec_user` 
            WHERE 
                user_name = :user;
        ';
        $params = [':user'=>$user];
        return execute_query_select($sql,$dbh,$params);
    }

    function execute_query($sql, $params, $dbh){
        try {
            $stmt =$dbh->prepare($sql);
            $stmt->execute($params);
        } catch (PDOException $e) {
            throw $e;
        }
    }
?>
