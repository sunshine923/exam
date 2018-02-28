<?php
include '../db.php';
$uid = $_POST['uid'];
$user = $_POST['user'];
$cname = $_POST['cname'];
$mysql->query("update student set user ='{$user}',cname = '{$cname}' where uid = $uid");

if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
