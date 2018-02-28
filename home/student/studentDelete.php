<?php
include '../db.php';
$uid = $_POST['uid'];
$mysql->query("delete from student where uid = $uid");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}