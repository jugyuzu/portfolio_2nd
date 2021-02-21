<?php
  
//全ての装具を取得
    function get_orthosis_list($dbh){
            $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=0 ORDER BY m.create_datetime DESC;';
            $data=execute_db($sql,$dbh);
            return $data;
    }

//全ての上肢装具を取得
    function get_orthosis_arm_list($dbh){
            $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status = 1 AND m.part="arm" AND m.po=0 ORDER BY m.create_datetime DESC;' ;
            $data=execute_db($sql,$dbh);
            return $data;
    }

//全ての下肢装具を取得
    function get_orthosis_foot_list($dbh){
            $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status = 1 AND m.part="foot" AND m.po=0 ORDER BY m.create_datetime DESC;' ;
            $data=execute_db($sql,$dbh);
            return $data;
    }
    
//全ての腰椎装具を取得
    function get_orthosis_waist_list($dbh){
            $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status = 1 AND m.part="waist" AND m.po=0 ORDER BY m.create_datetime DESC;' ;
            $data=execute_db($sql,$dbh);
            return $data;
    }

//sql実行
    function execute_db($sql,$dbh){
        try{
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        }catch (PDOException $e){
            $e->getMessage();
        }
    }

//同じ商品がカートに入っていないか確認
    function get_cart_data($dbh,$user){
        try {
            $sql='SELECT c.item_id FROM ec_cart AS c WHERE c.user_id=? AND c.create_datetime=c.update_datetime;';
            $stmt = $dbh -> prepare($sql);
            $stmt -> bindValue(1, $user, PDO::PARAM_STR);
            $stmt ->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($data)){
                return 0;
            }else{
                return $data;
            }
        } catch (PDOException $e) {
            throw $e;
        }
    }

//データベースに挿入
    function insert_ec_cart($dbh,$id,$user,$amount,$date,$update){
        $sql   = 'INSERT INTO ec_cart(user_id,item_id,amount,create_datetime,update_datetime) VALUES(:user,:id,:amount,:date,:update);';
        $params=[':user'=>$user, ':id'=>$id, ':amount'=>$amount, ':date'=>$date, 'update'=>$update];
        execute_query($sql,$dbh,$params);
    }
    
        function execute_query($sql,$dbh,$params){
        try{
            $stmt =$dbh->prepare($sql);
            $stmt->execute($params);
            
        }catch (PDOException $e){
            $e->getMessage();
        }
        return $id = $dbh -> lastInsertId();
    }

//カートに同じ商品がないか確認
    function check_cart($data,$id){
        global $error;
        if(empty($data)){
            return;
        }
        for($i=0; $i<count($data); $i++){
            if($data[$i]['item_id'] == $id){
                $error[]='カートに同じ商品が入っています';
            }
        }
    }
    ?>