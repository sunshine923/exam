<?php
include '../db.php';
$pid = $_POST['pid'];
$mysql->autocommit(false);
$mysql->query("delete from paper where pid = $pid");
$mysql->query("delete from paperextra where pid = $pid");
if($mysql->affected_rows){
    $mysql->commit();
    echo 'ok';
    exit();
}else{
    $mysql->rollback();
    echo 'error';
}