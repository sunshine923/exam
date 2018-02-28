<?php
include '../db.php';
session_start();
$uid = $_SESSION['uid'];
$cname = $_SESSION['cname'];
$user = $_SESSION['user'];
$sql = "select cid from classes where cname = '{$cname}'";
$cid = $mysql->query($sql)->fetch_assoc()['cid'];
$sql1 = "select * from (select * from paper where cid = $cid) as wff where pid in (select  DISTINCT  pid from record where name = $uid)";
$data = $mysql->query($sql1)->fetch_all(1);
$result = [$cname,$data,$user];
echo json_encode($result);