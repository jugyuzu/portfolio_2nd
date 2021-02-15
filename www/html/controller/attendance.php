<?php
session_start();
$session_id = session_id();
setcookie('id',$session_id,time()+60*60*24*2);
include_once '../view/attendance_view.php';