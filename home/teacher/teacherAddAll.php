<?php
include '../db.php';
$data = $_REQUEST['data'];
$str = '';
$str.='(';
for($i=0;$i<count($data);$i++){
    for($j=0;$j<count($data[$i]);$j++){
        $str.="'{$data[$i][$j]}'".',';
    }
    $str.="'".md5('123456')."'";
    $str.='),(';
}
$str = substr($str,0,-2);
$mysql->query("insert into teacher  (user,cname,pass) VALUES $str");
if($mysql->affected_rows){
    echo 'ok';
    exit();
}else{
    echo 'error';
}
