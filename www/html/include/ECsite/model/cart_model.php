<?php
 
//カートの中身を取得
    function get_cart_data($dbh,$id){
        try{
            $sql = 'SELECT e.id, m.item_id, e.amount, m.img, m.name, m.price, m.url, s.stock FROM ec_cart AS e INNER JOIN ec_item_master AS m ON e.item_id=m.item_id INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE user_id=:id AND e.create_datetime=e.update_datetime';
            $params=[':id'=>$id];
            $data=execute_query_select($sql,$dbh,$params);
            return $data;
        } catch (PDOException $e) {
            throw $e;
        }
    }

//カートの商品の合計を出す
    function cart_sum($data){
        $sum=0;
        foreach($data as $value){
            $price=$value['price']*$value['amount'];
            $sum += $price;
        }
            return $sum;
    }

//カートの商品の在庫があるか確認
    function check_stock($dbh,$data){
        global $error;
        foreach($data as $value){
            try{
                $param = '';
                $param = $value['item_id'];
                $sql = 'SELECT s.stock FROM ec_item_stock AS s WHERE s.item_id=:id;';
                $params=[':id'=>$param];
                $data=execute_query_select($sql,$dbh,$params);
                if($data[0]['stock'] == 0){
                    $error[]= $value['name'].'は現在在庫がありません';
                }
            }catch(PDOException $e){
                $e->getMessage();
            }
        }
    }
//データベースから参照
    function execute_query_select($sql,$dbh,$params){
        try{
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute($params);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw $e;
        }
        return $data;
    }

//ec_cartもupdate_datetimeを変更
    function update_ec_cart($dbh,$id,$date){
        try{
            $sql='UPDATE ec_cart SET update_datetime=:date WHERE user_id = :id;';
            $params=[':id'=>$id,':date'=>$date];
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute($params);
        } catch (PDOException $e) {
        throw $e;
    }
    }
?>