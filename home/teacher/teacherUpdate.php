<?php
include '../db.php';
$tid = $_POST['tid'];
$user = $_POST['user'];
$cname = $_POST['cname'];
$mysql->query("update teacher set user ='{$user}',cname = '{$cname}'  where tid = $tid");

if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
