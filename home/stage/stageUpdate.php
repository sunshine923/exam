<?php
include '../db.php';
$sid = $_POST['sid'];
$sname = $_POST['sname'];
$did = $_POST['did'];
$mysql->query("update stage set sname ='{$sname}',did = $did  where sid = $sid");

if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
