<?php
include '../db.php';
$id = $_POST['id'];
$data = $mysql->query("select * from `type` where id = $id")->fetch_assoc();
echo json_encode($data);
