<?php
include '../db.php';
$cid = $_POST['cid'];
$result = $mysql->query("select * from stage")->fetch_all(1);
$resultd = $mysql->query("select * from direction")->fetch_all(1);
$data = $mysql->query("select * from classes where cid = $cid")->fetch_assoc();
echo json_encode($a=[$result,$resultd,$data]);
