<?php 

//入力されているかチェック
    function check_input($str,$text){
        if(mb_strlen($str) == 0){
            $_SESSION['error']=$text. 'を入力してください';
        }
    }

//コメントが200文字以内かチェック
    function check_comment($str,$text){
        if(mb_strlen($str) >= 201){
            $_SESSION['error']=$text. 'は200文字以内です';
        }
    }
    
//html変換
    function entity_str($str) {

        $str = htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
        return $str;
    }

//ec_item_masterをupdate
    function update_comment($dbh,$id,$comment,$date){
        $sql='UPDATE `ec_item_master` SET `comment`=:comment,`update_datetime`=:date WHERE item_id=:id;';
        $params=[':comment'=>$comment,':date'=>$date,':id'=>$id];
        $stmt = $dbh->prepare($sql);
        $stmt ->execute($params);
    }
?>