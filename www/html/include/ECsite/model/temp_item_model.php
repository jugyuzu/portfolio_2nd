<?php 

//データベースから情報を取得
    function get_item_data($dbh,$id){
        try{
            $sql = 'SELECT m.item_id, m.name, m.img, m.price, m.comment, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.item_id=? AND m.status=1;' ;
            $stmt = $dbh -> prepare($sql);
            $stmt ->bindValue(1, $id, PDO::PARAM_STR);
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
            $sql='
                SELECT 
                    c.item_id 
                FROM 
                    ec_cart AS c 
                WHERE 
                    c.user_id=? AND c.create_datetime=c.update_datetime;';
            $stmt = $dbh -> prepare($sql);
            $stmt -> bindValue(1, $user, PDO::PARAM_STR);
            $stmt ->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            //var_dump($data);
            if(empty($data)){
                return 0;
            }else{
                return $data;
            }
        } catch (PDOException $e) {
            throw $e;
        }
    }

//同じ気になる商品がないかデータベースから気になる商品を取得
    function get_curious_data($dbh,$user){
        try{
            $sql = 'SELECT c.item_id FROM curious_data AS c WHERE c.user_id =?;';
            $stmt = $dbh -> prepare($sql);
            $stmt ->bindValue(1, $user, PDO::PARAM_STR);
            $stmt -> execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(empty($data)){
                return 0;
            }else{
                return $data;
            }

        }catch (PDOException $e){
            throw $e;
        }
    }
//カートに同じ商品がないか確認
function check_cart($data,$id){
    global $error;
    for($i=0; $i<count($data); $i++){
        if($data[$i]['item_id'] == $id){
            $error[]='カートに同じ商品が入っています';
        }
    }
}

function check_curious($data,$id){
    global $error;
    if(empty($data)){
        return;
    }
    for($i=0; $i<count($data); $i++){
        if($data[$i]['item_id'] == $id){
            $error[]='すでに気になるボタンが押してあります';
        }
    }
}
    
//データベースに挿入
    function insert_ec_cart($dbh,$id,$user,$amount,$date,$update){
        $sql   = 'INSERT INTO ec_cart(user_id,item_id,amount,create_datetime,update_datetime) VALUES(:user,:id,:amount,:date,:update);';
        $params=[':user'=>$user, ':id'=>$id, ':amount'=>$amount, ':date'=>$date, 'update'=>$update];
        execute_query($sql,$dbh,$params);
    }
    
    function insert_curious_data($dbh,$id,$user,$date){
    $sql   = 'INSERT INTO curious_data(item_id,user_id,create_datetime) VALUES(:id, :user, :date);';
    $params=[':id'=>$id,':user'=>$user,':date'=>$date];
        execute_query($sql,$dbh,$params);
    }
    
    function execute_query($sql,$dbh,$params){
        try{
            $stmt =$dbh->prepare($sql);
            $stmt->execute($params);
            
        }catch (PDOException $e){
            $e->getMessage();
        }
        $id = $dbh -> lastInsertId();
        return $id;
    }
?>