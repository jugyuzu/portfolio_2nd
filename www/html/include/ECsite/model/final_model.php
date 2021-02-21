<?php

//ec_cartを削除
    function delete_ec_cart($dbh,$user,$data){
        foreach($data as $value){
            try{
                $item_id = '';
                $item_id = $value['item_id'];
                $sql = 'DELETE FROM ec_cart WHERE item_id=:id AND user_id=:user;';
                $params=[':id'=>$item_id, ':user'=>$user];
                execute_query($sql,$dbh,$params);

            }catch(PDOException $e){
                $e->getMessage();
            }
        }
    }
                        
//在庫数を減らす
    function update_ec_stock($dbh,$data,$date){
        foreach($data as $value){
            try{
                $item_id ='';
                $amount='';
                $item_id = $value['item_id'];
                $amount=$value['amount'];
                
                $sql = 'UPDATE ec_item_stock SET update_datetime=:date, stock= stock - :amount WHERE item_id=:id;';
                $params=[':date'=>$date, ':id'=>$item_id, ':amount'=>$amount];
                execute_query($sql,$dbh,$params);

            }catch(PDOException $e){
                $e->getMessage();
            }
        }
    }
    
//履歴を取得して、最後のlog_idに１を足す
    function get_history($dbh,$id){
        $log='';
        try {
            $sql = 'SELECT h.log_id FROM history_data AS h ORDER BY h.create_datetime DESC LIMIT 1';
            
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();
            $log = $stmt->fetch(PDO::FETCH_COLUMN);
        } catch (PDOException $e) {
            throw $e;
        }
        
        $log++;
        return $log;
    }    
    
//購入履歴を挿入
    function insert_history($dbh,$data,$user,$date,$log){
        $h_id=array();
        foreach($data as $value){
            try{
                $item_id ='';
                $amount='';
                $item_id = $value['item_id'];
                $amount=$value['amount'];
                $sql = 'INSERT INTO history_data(item_id,user_id,amount,create_datetime,log_id) VALUES(:item_id,:user_id,:amount,:date,:log);';
                $params=[':date'=>$date, ':item_id'=>$item_id, ':user_id'=>$user, ':amount'=>$amount, ':log'=>$log];
                $h_id[]=execute_query($sql,$dbh,$params);

            }catch(PDOException $e){
                $e->getMessage();
            }
        }
            return $h_id;
    }
//sqlを実行
    function execute_query($sql,$dbh,$params){
        $id='';
        try{
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute($params);
            
        } catch (PDOException $e) {
            throw $e;
        }
        $id = $dbh->lastInsertId();
        return $id;
    }
    
//購入したものを取得
    function select_history_item($dbh,$id,$h_id){
        $data=array();
        foreach($h_id as $row){
            for($i=0; $i<count($row); $i++){
                try {
                    $sql = 'SELECT m.name, m.price, m.img, m.url, m.item_id, h.amount FROM history_data AS h INNER JOIN ec_item_master AS m ON h.item_id=m.item_id WHERE h.user_id=:user AND h.history_id=:h ORDER BY h.create_datetime DESC;';
                    $params=[':user'=>$id,':h'=>$row[$i]];
                    $stmt = $dbh -> prepare($sql);
                    $stmt -> execute($params);
                    $data[] = $stmt->fetchAll(PDO::FETCH_ASSOC);
                
                } catch (PDOException $e) {
                throw $e;
                }
            }
        }
        return $data;
    }
?>