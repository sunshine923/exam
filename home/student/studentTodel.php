<?php
include '../db.php';
$ids = $_POST['ids'];
$uid = implode(',',$ids);

$mysql->query("delete from student where uid in ($uid)");

if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}