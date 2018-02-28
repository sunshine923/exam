<?php
include '../db.php';
$data = $mysql->query("select * from teacher ")->fetch_all(1);
echo json_encode($data);