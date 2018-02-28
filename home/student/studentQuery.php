<?php
include '../db.php';
$uid = $_POST['uid'];
$result = $mysql->query("select * from classes")->fetch_all(1);
$data = $mysql->query("select * from student where uid = $uid")->fetch_assoc();
echo json_encode($a=[$result,$data]);
