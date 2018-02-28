<?php
include '../db.php';
$sql = "select paper.pname,test.title,paperextra.*  from paper,test,paperextra where paper.pid = paperextra.pid and test.tid = paperextra.tid";
$data = $mysql->query($sql)->fetch_all(1);
echo json_encode($data);