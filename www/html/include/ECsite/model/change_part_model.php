<?php 

  
//部位が選択されているか確認
    function check_part($part,$str){
        if($part=="arm" || $part=="foot" || $part=="waist" || $part=="cover"){
            
        }else{
            $_SESSION['error']=$str.'に規定値以外が選択されています。正し部位を選んでください';
        }
    }
    
//ec_item_masterをupdate
    function update_part($dbh,$id,$part,$date){
        $sql='UPDATE `ec_item_master` SET `part`=:part,`update_datetime`=:date WHERE item_id=:id;';
        $params=[':part'=>$part,':date'=>$date,':id'=>$id];
        $stmt = $dbh->prepare($sql);
        $stmt ->execute($params);
    }

?>