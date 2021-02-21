<?php
function get_db_connect(){
    // MySQL用のDSN文字列
    $dsn = 'mysql:dbname='. DB_NAME .';host='. DB_HOST .';charset='.DB_CHARSET;
   
    try {
      // データベースに接続
      $dbh = new PDO($dsn, DB_USER, DB_PASS, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES utf8mb4'));
      $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
      $dbh->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
      $dbh->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
      exit('接続できませんでした。理由：'.$e->getMessage() );
    }
    return $dbh;
  }

function insert_shift($card, $place, $time, $user, $dbh){
  if($card === 'arrive'){
    insert_arrive($place, $time, $user, $dbh);
  }else{
    insert_leave($place, $time, $user, $dbh);
  }
}
function insert_arrive($place, $time, $user, $dbh){
  $sql = "
        INSERT INTO 
          shift_arrive(
            `user_name`, 
            `arrive_place`, 
            `create_datetime`
            ) 
        VALUES(
          :user,
          :place,
          :time
          );";
  $params = [':user' => $user, ':place' => $place, 'time' => $time];
  return execute_query($dbh, $sql, $params);
}

function insert_leave($place, $time, $user, $dbh){
  $sql = "
        INSERT INTO 
          shift_leave(
            `user_name`, 
            `leave_place`, 
            `leave_time`
            ) 
        VALUES(
          :user,
          :place,
          :time
          );";
  $params=[':user' => $user, ':place' => $place, 'time' => $time];
  return execute_query($dbh, $sql, $params);
}
// function check_card($card){
//   if($card === 'arrive'){
//     return "shift_arrive";
//   }else{
//     return "shift_leave";
//   }
// }

function get_shift($card, $user, $dbh){
  if($card === 'arrive'){
    return get_arrive($user, $dbh);
  }else{
    return get_leave($user, $dbh);
  }
}

function get_arrive($user, $dbh){
  $sql = "
          SELECT 
            arrive_place AS place, create_datetime AS date
          FROM 
            shift_arrive
          WHERE 
            `user_name` = :user
          ORDER BY 
            create_datetime DESC 
          LIMIT 1
        ";
        //var_dump($sql);
          //9daa40cd6c172006652a460e86ca8597
  $params=[':user' => $user];
  return fetch_query($sql, $params, $dbh);
}

function get_leave($user, $dbh){
  $sql = "
          SELECT 
            leave_place AS place, leave_time AS date
          FROM 
            shift_leave
          WHERE 
            user_name = :user
          ORDER BY 
            leave_time DESC
          LIMIT 1
          ";
  $params=[':user'=>$user];
  return fetch_query($sql, $params, $dbh);
}

function get_arrive_data($user,$dbh){
  $sql = '
        SELECT 
          `arrive_place`, 
          `create_datetime` 
        FROM 
          `shift_arrive` 
        WHERE 
          user_name = :user;
  ';
  $params=[':user'=>$user];

  return fetch_all_query($sql,$params,$dbh);
}
function get_leave_data($user,$dbh){
  $sql = '
        SELECT 
          `leave_place`, 
          `leave_time` 
        FROM 
          `shift_leave` 
        WHERE 
          user_name = :user;
  ';
  $params=[':user'=>$user];

  return fetch_all_query($sql,$params,$dbh);
}

function fetch_all_query($sql,$params=array(),$dbh){
  try {
    $statement = $dbh->prepare($sql);
    $statement->execute($params);
    return $statement->fetchAll();
  } catch (PDOException $e) {
    throw $e;
  }
}

function fetch_query($sql, $params = array(), $dbh){
  try {
    $statement = $dbh->prepare($sql);
    $statement->execute($params);
    return $statement->fetch();
  } catch (PDOException $e) {
    throw $e;
  }
}

function execute_query($dbh, $sql, $params = array()){
  try {
    $statement = $dbh->prepare($sql);
    return $statement->execute($params); 
  } catch (PDOException $e) {
    throw $e;
  }
}
?>