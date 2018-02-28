<?php
include '../db.php';
$user = $_POST['user'];
$cname = $_POST['cname'];
$mysql->query("insert into student  (user,cname,pass) VALUES ('{$user}','{$cname}',md5(123456))");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
