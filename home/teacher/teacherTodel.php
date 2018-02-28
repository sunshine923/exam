<?php
include '../db.php';
$ids = $_POST['ids'];
$tid = implode(',',$ids);

$mysql->query("delete from teacher where tid in ($tid)");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}