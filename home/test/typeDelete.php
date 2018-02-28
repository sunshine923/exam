<?php
include '../db.php';
$id = $_POST['id'];
$mysql->query("delete from `type` where id = $id");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}