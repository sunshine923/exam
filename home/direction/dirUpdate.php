<?php
include '../db.php';
$did = $_POST['did'];
$dname = $_POST['dname'];
$mysql->query("update direction set dname ='{$dname}' where did = $did");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
