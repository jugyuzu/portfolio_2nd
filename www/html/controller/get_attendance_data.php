<?php
require_once '../conf/const.php';
require_once '../model/db.php';

$dbh = get_db_connect();
$user = $_COOKIE['id'];
$data[] = get_arrive_data($user,$dbh);
$data[] = get_leave_data($user,$dbh);
echo json_encode($data);