<?php
include '../db.php';
$pid = $_REQUEST['pid'];
$sql = "select test.*,paperextra.* from test,paperextra where paperextra.tid = test.tid and paperextra.pid = $pid ";
$data = $mysql->query($sql)->fetch_all(1);
echo json_encode($data);

