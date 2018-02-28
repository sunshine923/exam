<?php
include '../db.php';
$cname = $_POST['cname'];
$did = $_POST['did'];
$sid = $_POST['sid'];

$mysql->query("insert into classes  (cname,did,sid) VALUES ('{$cname}',$did,$sid)");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
