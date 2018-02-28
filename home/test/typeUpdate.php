<?php
include '../db.php';
$id = $_POST['id'];
$name = $_POST['name'];
$mysql->query("update `type` set name ='{$name}' where id = $id");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
