<?php
include '../db.php';
$cid = $_REQUEST['cid'];
$pid = $_REQUEST['pid'];
$pname = $_REQUEST['pname'];
$sql="update paper set cid=$cid,pname='{$pname}' where pid = $pid";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
    exit();
}
