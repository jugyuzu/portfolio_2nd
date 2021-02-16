<?php
require_once '../conf/const.php';
require_once '../model/db.php';

$dbh = get_db_connect();
$user = $_COOKIE['id'];

$card = $_GET['card'];
$place= $_GET['place'];
$time = $_GET['get_arrive'];
print json_encode($card);

?>