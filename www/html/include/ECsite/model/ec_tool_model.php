<?php

//入力されているかチェック
    function check_input($str,$text){
        global $error;
        if(mb_strlen($str) == 0){
            $error[]=$text. 'を入力してください';
        }
    }
//コメントが200文字以内かチェック
    function check_comment($str,$text){
        global $error;
        if(mb_strlen($str) >= 201){
            $error[]=$text. 'は200文字以内です';
        }
    }
//整数かチェック
    function check_int($num,$text){
        global $error;
        if((ctype_digit($num)) && $num >= 0){

        }else{
            $error[]=$text.'に0以上の整数を入力してください';
        }
    }

//1か0か確認
    function check_status($num, $text){
        global $error;
        if($num == 1 || $num == 0){
        }else{
            $error[] =$text . 'に規定値以外の値がセットされています。公開（１）か非公開（０）を入力して下さい';
        }
    }
    
//部位が選択されているか確認
    function check_part($part,$str){
        global $error;
        if($part=="arm" || $part=="foot" || $part=="waist" || $part=="cover"){
            
        }else{
            $error[]=$str.'に規定値以外が選択されています。正し部位を選んでください';
        }
    }
//画像を保存
    function file_controller($item_img,$img_dir){
        global $error;
        $new_img_filename='';
        if(is_uploaded_file($_FILES[$item_img]['tmp_name']) === TRUE){
            $extension= pathinfo($_FILES[$item_img]['name'], PATHINFO_EXTENSION);
                if($extension === 'jpg' || $extension === 'jpeg' || $extension === 'png' || $extension === 'JPG' || $extension === 'JPEG' || $extension === 'PNG'){
                    $new_img_filename = sha1(uniqid(mt_rand(),true)) . '.' . $extension;
                    if(is_file($img_dir . $new_img_filename) !== TRUE){
                        if(move_uploaded_file($_FILES[$item_img]['tmp_name'], $img_dir . $new_img_filename) !== TRUE){
                            $error[] = 'ファイルの移動に失敗しました';
                        }
                    }else{
                        $error[] = 'ファイルがすでに存在しています';
                    }
                }else{
                    $error[] = 'jpgファイルかpngファイルをアップロードしてください';
                }
        }else {
            $error[] = 'ファイルを選択してください';
        }
        return $new_img_filename;
    }
    
//html変換
    function entity_str($str) {

        $str = htmlspecialchars($str, ENT_QUOTES, HTML_CHARACTER_SET);
        return $str;
    }
    
//ファイル作成
    function new_page($name){
        global $error;
        $file_name = '../page/' . $name . '.php';
        
        if(file_exists($file_name) !== TRUE){
            touch ($file_name);
            //includeで./temp_item.phpを読み込ませる
            include_html($file_name);
            return $file_name;
        }else{
            $error[] = '同じ商品名が存在します。';
        }
    }
    
//ファイルに挿入
    function include_html($file){
        global $error;
        $text = "<?php include('./temp_item.php'); ?>";
        if(($fp = fopen($file, 'a')) !== FALSE){
            if((fwrite($fp, $text)) === FALSE){
                $error[] = 'ファイル書き込み失敗';
            }
        }fclose($fp);
    }
    
//ec_item_masterに挿入準備
    function insert_master($dbh, $name, $price, $img, $status, $po, $part, $url, $comment, $date, $update){
        $sql = 'INSERT INTO ec_item_master(name, price, img, status, po, part, url, comment, create_datetime, update_datetime) VALUES(:name, :price, :img, :status, :po, :part, :url, :comment, :date, :update);';
        $params=[':name'=>$name, ':price'=>$price, ':img'=>$img, ':status'=>$status, ':po'=>$po, ':part'=>$part, ':url'=>$url, ':comment'=>$comment, ':date'=>$date, ':update'=>$update];
        $id=execute_query($sql,$dbh,$params);
        return $id;
    }
//ec_item_stockに挿入準備
    function insert_stock($dbh, $id, $stock, $date, $update){
        $sql = 'INSERT INTO ec_item_stock(item_id, stock, create_datetime, update_datetime) VALUES(:id, :stock, :date, :update);';
        $params=[':id'=>$id, ':stock'=>$stock, ':date'=>$date, ':update'=>$update];
        execute_query($sql,$dbh,$params);
    }
//データベースに挿入
    function execute_query($sql, $dbh, $params){
        try {
            $stmt = $dbh->prepare($sql);
            $stmt ->execute($params);
        } catch (PDOException $e) {
            $e->getMessage();
            //var_dump($e);
        }
        $id = $dbh -> lastInsertId();
        return $id;
    }
//データベースから商品一覧を取得
    function select_db($dbh){
        try {
            
            $sql = 'SELECT m.item_id, m.name, m.price, m.img, m.status, m.po, m.part, m.url, m.comment, s.stock FROM ec_item_master AS m INNER JOIN ec_item_stock AS s ON m.item_id=s.item_id';
            $stmt = $dbh->prepare($sql);
            $stmt ->execute();
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
        } catch (PDOException $e) {
             $e->getMessage();
        }
            return $data;
    }

?>