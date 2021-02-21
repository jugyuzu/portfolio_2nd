<?php

//ユーザー名とパスワードが半角英数字6文字以上か確認
    function check_admin($str,$text){
        global $error;
        $pattern = '/^([a-zA-Z0-9]{6,})$/';
        if(preg_match($pattern, $str) !== 1){
            $error[] = $text . 'は半角英数字6文字以上です';
        }
    }

//文字列変換
    function entity_str($str) {
        return htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
    }

//ec_userに登録
    function insert_ec_user($dbh,$name,$psw,$date,$update){
        $sql = 'INSERT INTO ec_user (user_name,password,create_datetime,update_datetime) VALUES(:name, :psw, :date, :update);';
        $params=[':name'=>$name,':psw'=>$psw,':date'=>$date,':update'=>$update];
        execute_query($sql,$dbh,$params);
        
    }
    
//データベースに挿入
function execute_query($sql,$dbh,$params){
    try {
    $stmt = $dbh -> prepare($sql);
    $stmt -> execute($params);
    
    } catch (PDOException $e) {
            throw $e;
        }
}

//ec_userの名前を取得
    function check_name($name,$dbh){
        $sql='SELECT user_name FROM ec_user;';
        $data=execute_query_select($sql,$dbh);
        foreach($data as $row){
            global $error;
            if($row['user_name'] == $name){
                $error[] = '同じ名前のユーザーがいます。別の名前を入力してください';
            }
        }
    }

//データベースから参照
    function execute_query_select($sql,$dbh){
        try {
            $stmt = $dbh -> prepare($sql);
            $stmt -> execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $data;
        } catch (PDOException $e) {
            $e->getMessage();
        }
}
?>