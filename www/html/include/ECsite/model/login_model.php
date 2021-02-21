<?php

//ユーザー名とパスワードが半角英数字6文字以上か確認
    function check_admin($str,$text){
        global $error;
        $pattern = '/^([a-zA-Z0-9]){6,}$/';
        if(preg_match($pattern, $str) !== 1){
            $error[] = $text . 'は半角英数字6文字以上です';
        }
    }

//文字列変換
    function entity_str($str) {
        $str = htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
        return $str;
    }

//ユーザーが存在がするか
    function check_user($dbh,$name,$psw){
        global $error;
        try {
            $sql  = 'SELECT u.user_id, u.user_name, u.password FROM ec_user AS u WHERE user_name=?;';
            $stmt = $dbh->prepare($sql);
            $stmt ->bindParam(1, $name, PDO::PARAM_STR);
            $stmt ->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            if(empty($data) === FALSE){
                check_psw($data,$psw);
            }else {
                $error[]= 'ユーザー名またはパスワードが間違っています';
            };
        } catch (PDOException $e) {
            throw $e;
        }
            return $data;
    }
//パスワードを確認
    function check_psw($data,$psw){
        global $error;
        if($data[0]['password'] != $psw){
            $error[]='ユーザー名またはパスワードが間違っています。';
        }
    }

?>