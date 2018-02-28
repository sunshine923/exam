<?php
include '../db.php';
$tids = $_REQUEST['ids'];
$answer = $_REQUEST['answer'];
$pid = $_REQUEST['pid'];
/*
 *  title0 A
 *  title1 B
 *  title2 ['A','B','C']
 *
 *
 * */
session_start();
$str = "";
for($i=0;$i<count($tids);$i++){
    $str .= "(" . $tids[$i] .",";
    if(is_array($answer['title'.$i])){
        $s = implode(',',$answer['title'.$i]);
        $str .="'" . $s ."',";
    }else{
        $str .="'" . $answer['title'.$i] ."',";
    }
    $str .= $pid . ",'" . $_SESSION['uid'] ."'),";
}
$str = substr($str,0,-1);
$sql = "insert into record (tid,answers,pid,name) values $str";
$mysql->query($sql);
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
    exit();
}