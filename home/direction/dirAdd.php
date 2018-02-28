<?php
include '../db.php';
$dname = $_POST['dname'];
$mysql->query("insert into direction  (dname) VALUES ('{$dname}')");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
