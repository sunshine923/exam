<?php
include '../db.php';
$tid = $_POST['tid'];
$mysql->query("delete from test where tid = $tid");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}