<?php
include '../db.php';
$tid = $_POST['tid'];
$result = $mysql->query("select * from classes")->fetch_all(1);
$data = $mysql->query("select * from teacher where tid = $tid")->fetch_assoc();
echo json_encode($a=[$result,$data]);
