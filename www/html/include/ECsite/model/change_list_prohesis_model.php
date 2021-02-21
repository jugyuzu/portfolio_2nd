<?php
  
//新着順で全ての金額
    function get_prothesis_list($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 ORDER BY m.create_datetime DESC;';
        $data=execute_db($sql,$dbh);
        return $data;
}

//新着順で10000円まで
    function get_prothesis_price10000($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 AND price<=10000 ORDER BY m.create_datetime DESC';
        $data=execute_db($sql,$dbh);
        return $data;
    }

//新着順で50000円まで
    function get_prothesis_price50000($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 AND price<=50000 ORDER BY m.create_datetime DESC';
        $data=execute_db($sql,$dbh);
        return $data;
    }

//新着順で100000円まで
    function get_prothesis_price100000($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 AND price<=100000 ORDER BY m.create_datetime DESC';
        $data=execute_db($sql,$dbh);
        return $data;
    }
//価格が高い順で全ての金額
    function get_prothesis_price_up($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 ORDER BY m.price DESC';
        $data=execute_db($sql,$dbh);
        return $data;
    }
//価格が高い順で10000円まで
    function get_prothesis_price_up_price10000($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 AND price<=10000 ORDER BY m.price DESC';
        $data=execute_db($sql,$dbh);
        return $data;
    }

//価格が高い順で50000円まで
    function get_prothesis_price_up_price50000($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 AND price<=50000 ORDER BY m.price DESC';
        $data=execute_db($sql,$dbh);
        return $data;
    }

//価格が高い順で100000円まで
    function get_prothesis_price_up_price100000($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 AND price<=100000 ORDER BY m.price DESC';
        $data=execute_db($sql,$dbh);
        return $data;
    }

//価格が安い順で全ての金額
    function get_prothesis_price_down($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1  ORDER BY m.price';
        $data=execute_db($sql,$dbh);
        return $data;
    }
//価格が安い順で10000円まで
    function get_prothesis_price_down_price10000($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 AND price<=10000 ORDER BY m.price';
        $data=execute_db($sql,$dbh);
        return $data;
    }

//価格が安い順で50000円まで
    function get_prothesis_price_down_price50000($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 AND price<=50000 ORDER BY m.price';
        $data=execute_db($sql,$dbh);
        return $data;
    }

//価格が安い順で100000円まで
    function get_prothesis_price_down_price100000($dbh){
        $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.url, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id WHERE m.status=1 AND m.po=1 AND price<=100000 ORDER BY m.price';
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
?>