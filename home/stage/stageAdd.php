<?php
include '../db.php';
$sname = $_POST['sname'];
$did = $_POST['did'];
$mysql->query("insert into stage  (sname,did) VALUES ('{$sname}',$did)");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
