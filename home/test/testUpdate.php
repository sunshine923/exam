<?php
include '../db.php';
$sid = $_REQUEST['sid'];
$type = $_REQUEST['type'];
$tid = $_REQUEST['tid'];
$title = $_REQUEST['title'];
$answer = $_REQUEST['answer'];
$exp = $_REQUEST['exp'];
$score = $_REQUEST['score'];
$sql="update test set sid=$sid,type = $type,title = '{$title}',answer = '{$answer}',exp='{$exp}',score = $score where tid = $tid";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
    exit();
}
