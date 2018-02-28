<?php
include '../db.php';
$pass = md5($_REQUEST['pass']);
$newPass = md5($_REQUEST['newPass']);
session_start();
$user = $_SESSION['user'];
$sql="select * from teacher where user = '{$user}'";
$data = $mysql->query($sql)->fetch_assoc();
if($data['pass']==$pass){
    $mysql->query("update teacher set pass = '{$newPass}' where user = '{$user}'");
    if($mysql->affected_rows){
        echo '2';
        exit();
    }else{
        echo '3';
        exit();
    }
}else{
    echo '1';
}

