<?php
include '../db.php';
session_start();
$author = $_SESSION['user'];
$pname = $_POST['pname'];
$cid = $_POST['cid'];
$mysql->query("insert into paper  (pname,cid,author) VALUES ('{$pname}',$cid,'{$author}')");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
