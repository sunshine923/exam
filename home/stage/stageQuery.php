<?php
include '../db.php';
$sid = $_POST['sid'];
$result = $mysql->query("select * from direction")->fetch_all(1);
$data = $mysql->query("select * from stage where sid = $sid")->fetch_assoc();
echo json_encode($a=[$result,$data]);
