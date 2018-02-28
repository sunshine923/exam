<?php
include '../db.php';
$tid = $_POST['tid'];
$data = $mysql->query("select * from test where tid = $tid")->fetch_assoc();
echo json_encode($data);
