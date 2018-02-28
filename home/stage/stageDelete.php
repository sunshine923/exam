<?php
include '../db.php';
$sid = $_POST['sid'];
$mysql->query("delete from stage where sid = $sid");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}