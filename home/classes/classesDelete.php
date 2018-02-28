<?php
include '../db.php';
$cid = $_POST['cid'];
$mysql->query("delete from classes where cid = $cid");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}