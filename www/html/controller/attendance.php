<?php
require_once '../conf/const.php';
require_once '../model/db.php';


if(empty($_COOKIE['id'])){
    session_start();
    $session_id = session_id();
    setcookie('id',$session_id,time()+60*60*24*2);
}
$dbh = get_db_connect();
$user = $_COOKIE['id'];

include '../view/attendance_view.php';