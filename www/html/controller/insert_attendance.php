<?php
require_once '../conf/const.php';
require_once '../model/db.php';

$dbh = get_db_connect();
$user = strval($_COOKIE['id']);
//出勤か退社か
$card = strval($_POST['card']);
//現在地
$place= strval($_POST['place']);
//時間
$time = strval($_POST['time']);

insert_shift($card, $place, $time, $user, $dbh);

$shift = get_shift($card, $user, $dbh);

echo json_encode($shift);

?>