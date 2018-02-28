<?php
include '../db.php';
$name = $_POST['name'];
$mysql->query("insert into `type`  (name) VALUES ('{$name}')");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
