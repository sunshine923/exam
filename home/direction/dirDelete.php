<?php
include '../db.php';
$did = $_POST['did'];
$mysql->query("delete from direction where did = $did");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}