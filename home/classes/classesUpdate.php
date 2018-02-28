<?php
include '../db.php';
$cid = $_POST['cid'];
$cname = $_POST['cname'];
$sid = $_POST['sid'];
$did = $_POST['did'];

$mysql->query("update classes set cname ='{$cname}',did = $did,sid = $sid  where cid = $cid");

if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
