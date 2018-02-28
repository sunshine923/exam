<?php
include '../db.php';
$pid = $_REQUEST['pid'];
$sql = "select test.*,paperextra.*,record.answers from test,paperextra,record where paperextra.tid = test.tid and paperextra.pid = $pid and paperextra.pid = record.pid and paperextra.tid = record .tid ";
$data = $mysql->query($sql)->fetch_all(1);
echo json_encode($data);

