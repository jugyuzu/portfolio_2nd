<?php


//入力されているかチェック
    function check_input($str,$text){
        if(mb_strlen($str) == 0){
            $_SESSION['error']=$text. 'を入力してください';
        }
    }

//整数かチェック
    function check_int($num,$text){
        if((ctype_digit($num)) && $num >= 0){

        }else{
            $_SESSION['error']=$text.'は0以上の整数を入力してください';
        }
    }

//html変換
    function entity_str($str) {
        $str = htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
        return $str;
    }

//ec_item_stockをupdate
    function update_stock($dbh,$stock,$id,$date){
        $sql='UPDATE `ec_item_stock` SET `stock`=:stock,`update_datetime`=:date WHERE item_id=:id;';
        $params=[':stock'=>$stock,':date'=>$date,':id'=>$id];
        $stmt = $dbh->prepare($sql);
        $stmt ->execute($params);
    }

?>