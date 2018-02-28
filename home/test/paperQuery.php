<?php
include '../db.php';
$pid = $_POST['pid'];
$data = $mysql->query("select * from paper where pid = $pid")->fetch_assoc();
echo json_encode($data);
