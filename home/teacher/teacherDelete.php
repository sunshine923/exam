<?php
include '../db.php';
$tid = $_POST['tid'];
$mysql->query("delete from teacher where tid = $tid");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}